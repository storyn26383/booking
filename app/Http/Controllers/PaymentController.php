<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests;
use App\Payment\Pay2go;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function callback(Request $request, $hash)
    {
        $booking = $this->getBooking($hash);

        $pay2go = new Pay2go($booking);

        $pay2go->callback($request);

        return view('payment.success');
    }

    public function customer(Request $request, $hash)
    {
        $booking = $this->getBooking($hash);

        $pay2go = new Pay2go($booking);

        $pay2go->customer($request);

        return view('payment.wait');
    }

    public function notify(Request $request, $hash)
    {
        $booking = $this->getBooking($hash);

        $pay2go = new Pay2go($booking);

        $pay2go->notify($request);

        return view('payment.success');
    }

    protected function getBooking($hash)
    {
        return Booking::findOrFail(head(app('hashids')->decode($hash)));
    }
}
