@extends('template')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header"><h4>Create Event</h4></div>
                <div class="card-body">
                    <form action="{{route('events.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <select class="form-control" name="categoryid" required>
                                        <option class="btn text-primary" value="" disabled selected>Category<span >*</span></option>
                                        @foreach($categories as $category)
                                        <option value={{$category->id}} required>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <div class="form-group">
                                   <input type="text" placeholder="Title" required name="title" id="title" class="form-control mt-2">
                               </div>
                                <div class="form-group">
                                    <div class="row mt-2">
                                        <div class="col-7">
                                            <label for="">Start Date</label>
                                            <input type="date" min="{{Carbon\Carbon::now()->format('Y-m-d')}}" required name="startDate" class="form-control" placeholder="Start date">
                                        </div>
                                        <div class="col-5">
                                            <label for="">Start Time</label>
                                            <input type="time" required name="startTime" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row mt-2">
                                        <div class="col-7">
                                            <lable>End Date</lable>
                                            <input type="date" min="{{Carbon\Carbon::now()->format('Y-m-d')}}"  required name="endDate" class="form-control" placeholder="End date" >
                                        </div>
                                        <div class="col-5">
                                            <label for="">End Time</label>
                                            <input type="time" required name="endTime" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select name="city" required class="form-control mt-2">
                                        <option selected disabled value="">City</option>
                                        @foreach($data as $item)
                                        <option>{{$item['cityCountry']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <div class="form-group">
                                   <input type="file" class="form-control mt-2" id="eventPicture" placeholder="Image" name="eventPicture">
                               </div>
                               <div class="form-group">
                                   <label for="">Description</label>
                                   <textarea class="form-control mt-2" name="description" placeholder="Description"></textarea>
                               </div>
                                <button type="submit" class="btn btn-secondary">Create</button>
                                <a href="{{route('viewYourEvents')}}" class="btn btn-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
