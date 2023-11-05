<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Area;
use App\Models\Category;

class LandingPageController extends Controller
{
    public function index()
    {

        $hostels = Hostel::take(3)->orderBy('created_at')->get();
        $areas = Area::select('id', 'name')->get();
        $categories = Category::withCount('categoryHostels')->take(5)->orderByDesc('category_hostels_count')->get();

        return view('index', compact('hostels', 'areas', 'categories'));
    }
}
