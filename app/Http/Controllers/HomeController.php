<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Area;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {

        $areas = Area::select('id', 'name')->get();
        $categories = Category::withCount('categoryHostels')->take(5)->orderBy('id')->get();

        $hostels = Hostel::with(['area', 'hostelRooms' => function ($query) {
            $query->select('hostel_id', DB::raw('MIN(price) as min_price'))->groupBy('hostel_id');
        }])->take(3)->get();
        return view('index', compact('hostels', 'areas', 'categories'));
    }
}
