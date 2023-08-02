<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        return view('admin.trip.index');
    }

    public function create()
    {
        return view('admin.trip.form');
    }

    public function delete(Request $request, Trip $trip)
    {
        $trip->delete();
        session()->flash('successMsg', __('Trip data has been delete.'));
        return redirect('/trip');
    }
}
