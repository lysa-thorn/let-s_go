<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewExploreEvents()
    {
        $events = Event::all();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('events.explore_events', compact('events', 'categories', 'data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewYourEvents()
    {
        $events = Event::all();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('events.your_events', compact('events', 'categories', 'data'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('events.list_event', compact('events', 'categories', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('events.create_event', compact('categories', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->location = $request->city;
        $event->title = $request->title;
        $event->startDate = $request->startDate;
        $event->endDate = $request->endDate;
        $event->startTime = $request->startTime;
        $event->endTime = $request->endTime;
        $event->description = $request->description;
        $event->category_id = $request->categoryid;
        $event->organizer = auth::id();
        if ($request->hasfile('eventPicture')) {
            $file = $request->file('eventPicture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('images/', $filename);
            $event->eventPicture = $filename;
        }
        $event->save();
        return redirect('viewYourEvents');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $users = User::all();
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('events.detail_event', compact('event', 'categories','users', 'data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $categories = Category::all();
        $jsonString = file_get_contents(base_path('resources/cities.json'));
        $data = json_decode($jsonString, true);
        return view('events.edit_event', compact('event', 'categories', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->location = $request->city;
        $event->title = $request->title;
        $event->startDate = $request->startDate;
        $event->endDate = $request->endDate;
        $event->startTime = $request->startTime;
        $event->endTime = $request->endTime;
        $event->description = $request->description;
        $event->category_id = $request->categoryid;
        if ($request->hasfile('eventPicture')) {
            $file = $request->file('eventPicture');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . "." . $extension;
            $file->move('images/', $filename);
            $event->eventPicture = $filename;
        }
        $event->save();

        if(auth::user()->role == 1 && $event->organizer != auth::id()){
            return redirect('events');
        }else{
            return redirect('viewYourEvents');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return back();
    }

    /**
     * join event
     *
     * @param  \App\Event  $id
     * @return \Illuminate\Http\Response
     */
    public function joinEvent($id)
    {
        $event = Event::find($id);
        $event->numberOfMember = $event->numberOfMember + 1;
        $event->save();
        $event->users()->attach(auth::id());
        return back();
    }

    /**
     * Quit event from event that joined
     *
     * @param  \ get the specific id of event \\ $id
     * @return \Illuminate\Http\Response
     */

    public function quitEvent($id)
    {
        $event = Event::find($id);
        $event->numberOfMember = $event->numberOfMember - 1;
        $event->save();
        $event->users()->detach(auth::id());
        return back();
    }

    public function viewCalendar(){
        $events = Event::all();
        return view('events.view_calendar', compact('events'));
    }
}
