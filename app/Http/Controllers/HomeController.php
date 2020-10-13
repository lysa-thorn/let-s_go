<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $events = Event::all();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('events.explore_events', compact('events', 'categories', 'data'));

    }
}
