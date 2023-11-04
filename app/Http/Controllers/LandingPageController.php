<?php

namespace App\Http\Controllers;

use App\Models\Hostel;

class LandingPageController extends Controller
{
    public function index()
    {

        $hostels = Hostel::with(['area', 'facilities', 'categories', 'created_by'])->get();

        return view('index', compact('hostels'));
    }
}
