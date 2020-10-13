@extends('template')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h3>Your Events</h3>
            <a href="{{route('events.create')}}" class="btn btn-secondary float-right">Create</a>
        </div>
    </div>
    <div class="row">

        <div class="col-12">

            @foreach($events as $event)
            @if($event->organizer == auth::id())
            <div class="card mt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 mt-5">
                            @if($event->startTime < 12) <h3>{{\Carbon\Carbon::createFromFormat('H:i:s',$event->startTime)->format('h:i')}} AM</h3>
                            @else
                            <h3>{{\Carbon\Carbon::createFromFormat('H:i:s',$event->startTime)->format('h:i')}} PM</h3>
                            @endif
                            <p>{{\Carbon\Carbon::parse($event->startDate)->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-md-4 text-center mt-4">
                            <h5>{{$event->Category['name']}}</h5>
                            <h3>{{$event->title}}</h3>
                            <p>{{$event->numberOfMember}} Members going!</p>
                            <p>{{$event->location}}</p>
                        </div>
                        <div class="col-md-3">
                            <img src="{{asset('images/'.$event->eventPicture)}}" alt="No Image" class="img img-thumbnail m-3" style="width:150px; height:130px;">
                        </div>
                        <div class="col-md-3 mt-5">
                            <a href="{{route('events.edit', $event->id)}}" class="delete btn btn-secondary float-right mr-3">EDIT</a>
                            <form action="{{route('events.destroy', $event->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" onclick="return confirm('Are you sure want to delete?')" class="delete btn btn-danger float-right mr-3">CANCEL</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>

@endsection

