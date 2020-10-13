@extends('template')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header"><h4>Edit Event</h4></div>
                <div class="card-body">
                    <form action="{{route('events.update', $event->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="categoryid" required>
                                        <option value="" disabled selected></option>
                                        @foreach($categories as $category)
                                        <option <?php if($category->id == $event->category_id){ ?> selected="selected" <?php } ?> value={{$category->id}} required>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <div class="form-group">
                                   <input type="text" value="{{$event->title}}" placeholder="Title" required name="title" id="title" class="form-control mt-2">
                               </div>
                                <div class="form-group">
                                    <div class="row mt-2">
                                        <div class="col-7">
                                            <label for="">Start Date</label>
                                            <input type="date" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" value="{{$event->startDate}}" required name="startDate" class="form-control" placeholder="Start date">
                                        </div>
                                        <div class="col-5">
                                            <label for="">Start Time</label>
                                            <input type="time" value="{{$event->startTime}}" required name="startTime" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row mt-2">
                                        <div class="col-7">
                                            <lable>End Date</lable>
                                            <input type="date" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" value="{{$event->endDate}}" required name="endDate" class="form-control" placeholder="End date" >
                                        </div>
                                        <div class="col-5">
                                            <label for="">End Time</label>
                                            <input type="time" value="{{$event->endTime}}" required name="endTime" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="city" required class="form-control mt-2">
                                        <option selected disabled value=""></option>
                                        @foreach($data as $item)
                                        <option<?php if($item['cityCountry'] == $event->location){ ?> selected="selected" <?php } ?> value="{{$item['cityCountry']}}">{{$item['cityCountry']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <div class="form-group">
                                   <input type="file" class="form-control mt-2" id="eventPicture" name="eventPicture">
                               </div>
                               <div class="form-group">
                                   <textarea class="form-control mt-2" value="{{$event->description}}" name="description" placeholder="Description"></textarea>
                               </div>
                                @if(auth::user()->role == 1 && $event->organizer != auth::id())
                                    <a href="{{route('events.index')}}" class="btn btn-danger float-right">Cancel</a>
                                @else
                                    <a href="{{route('viewYourEvents')}}" class="btn btn-danger float-right">Cancel</a>
                                @endif
                                <button type="submit" class="btn btn-secondary">Edit</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
