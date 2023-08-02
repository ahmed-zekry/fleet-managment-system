<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        return view('admin.city.index');
    }

    public function create()
    {
        return view('admin.city.form');
    }

    public function delete(Request $request, City $city)
    {
        $city->delete();
        session()->flash('successMsg', __('City data has been delete.'));
        return redirect('/city');
    }
}
