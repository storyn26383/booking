<?php

namespace App\Http\Controllers;

use App\Room;
use App\Booking;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\Step2Request;
use App\Http\Requests\Step3Request;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\ConfirmRequest;

class BookingController extends Controller
{
    public function step1()
    {
        $bookings = Booking::where('date', '>=', Carbon::now())
                           ->where('date', '<=', Carbon::now()->addDays(28))
                           ->get()
                           ->groupBy('date')
                           ->map(function ($row) {
                                return $row->count();
                           });

        $rooms = Room::count();

        $datetime = Carbon::now();
        $calendar = [];
        $flag = 0;

        // 只能訂 28 天內的房間
        for ($i = 0; $i < 28; $i++) {
            if (0 === $datetime->dayOfWeek) {
                $flag++;
            }

            $calendar[$flag][$datetime->dayOfWeek] = (object) [
                'date' => clone $datetime,
                'canBooking' => ! isset($bookings[$datetime->format('Y-m-d')]) or $bookings[$datetime->format('Y-m-d')] < $rooms,
            ];

            $datetime->addDay();
        }

        return view('booking.step1', compact('calendar'));
    }

    public function step2(Step2Request $request)
    {
        $bookings = Booking::where('date', $request->date)
                           ->get()
                           ->pluck('room_id');

        $rooms = Room::all()->map(function ($room) use ($bookings) {
            $room->canBooking = ! $bookings->contains($room->id);

            return $room;
        });

        $date = $request->date;

        return view('booking.step2', compact('rooms', 'date'));
    }

    public function step3(Step3Request $request)
    {
        $room = $request->room;
        $date = $request->date;

        return view('booking.step3', compact('room', 'date'));
    }

    public function confirm(ConfirmRequest $request)
    {
        return view('booking.confirm', [
            'room' => Room::findOrFail($request->room),
        ] + $request->all());
    }

    public function booking(BookingRequest $request)
    {
        $room = Room::findOrFail($request->room);
        $date = $request->date;

        $booking = $room->bookings()->where('date', $date)->count();

        if ($booking > 0) {
            return view('booking.failure');
        }

        $room->booking($request->all());
    }
}
