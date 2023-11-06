<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use App\Models\Area;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {

        $areas = Area::select('id', 'name')->get();
        $categories = Category::withCount('categoryHostels')->take(5)->orderBy('id')->get();

        $hostels = Hostel::with(['area', 'hostelRooms' => function ($query) {
            $query->select('hostel_id', DB::raw('MIN(price) as min_price'))->groupBy('hostel_id');
        }])->take(3)->get();

        return view('public.home', compact('hostels', 'areas', 'categories'));
    }
    public function categories()
    {
        $categories = Category::withCount('categoryHostels')->take(10)->orderBy('id')->get();
        return view('public.category', compact('categories'));
    }
    public function hostel()
    {
        $areas = Area::withCount('areaHostels')->get();
        $categories = Category::withCount('categoryHostels')->take(10)->orderBy('id')->get();
        $hostels = Hostel::with(['area', 'hostelRooms' => function ($query) {
            $query->select('hostel_id', DB::raw('MIN(price) as min_price'))->groupBy('hostel_id');
        }])->paginate(6);
        return view('public.hostel', compact('hostels', 'areas', 'categories'));
    }
    public function filterAjax(Request $request)
    {
        // Get filter criteria from the request
        $area = $request->input('area');

        // Perform filtering using Eloquent and retrieve filtered data
        $filteredHostels = Hostel::where('area', $area)->get();

        // Return the filtered data as JSON
        return view('public.hostel', compact('filteredHostels'));
    }

    public function showHostel(Hostel $hostel)
    {

        $hostel->load('area', 'facilities', 'categories', 'created_by', 'hostelRooms');
        $availableRooms = $hostel->hostelRooms->where('status', 'available');
        $minPrice = $hostel->hostelRooms->where('status', 'available')->min('price');

        return view('public.hostel-view', compact('hostel', 'minPrice', 'availableRooms'));
    }
    public function signup()
    {
        return view('public.signup');
    }
}
