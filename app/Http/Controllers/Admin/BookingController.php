<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index()
    {
        return view('admin.booking.index');
    }
}
