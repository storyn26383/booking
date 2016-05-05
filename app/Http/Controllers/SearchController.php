<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Http\Requests;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showSearchForm(Request $request)
    {
        $bookings = $request->email?
            Booking::whereEmail($request->email)->orderBy('date')->get():
            null;

        return view('search.search', [
            'email' => $request->email,
            'bookings' => $bookings,
        ]);
    }
}
