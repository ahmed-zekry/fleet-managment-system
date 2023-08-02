<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        return view('admin.bus.index');
    }

    public function create()
    {
        return view('admin.bus.form');
    }

    public function delete(Request $request, Bus $bus)
    {
        $bus->delete();
        session()->flash('successMsg', __('Post data has been delete.'));
        return redirect('/bus');
    }
}
