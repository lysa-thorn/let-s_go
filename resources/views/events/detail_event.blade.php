@extends('template')

@section('content')
<div class="container mt-3">
    <a href="{{route('viewExploreEvents')}}" class="btn btn-secondary float-right">Back</a>
    <div class="row">
                    <div class="col-6 mt-3 text-center">
                        <h4>Event Detail</h4>
                        <img id="imageDetail" src="{{asset('images/'.$event->eventPicture)}}" class="img img-thumbnail m-3" style="width:230px; height:180px;">
                    </div>

                    <div class="col-6 mt-3">
                        <p id="category">{{$event->category->name}}</p>
                        <b>
                            <h2 id="title">{{$event->title}}</h2>
                        </b>
                        <p><i class="material-icons float-left">location_on</i><span>{{$event->location}}</span></p>
                        <p><i class="material-icons float-left">location_on</i>
                            <span>@foreach($users as $user)
                                    @if($user->id == $event->organizer)
                                        {{$user->name}}
                                    @endif
                                @endforeach
                            </span>
                        </p>
                        <p><i class="material-icons float-left">people</i><span>{{$event->numberOfMember}} members</span></p>
                        <p><i class="material-icons float-left">date_range</i><span id="times_start">{{$event->startDate . "-" . $event->endDate}}</span></p>
                        <p><i class="material-icons float-left">timer</i><span>{{$event->startTime . "-" . $event->endTime}}</span></p>
                        <?php
                        $isJoin = false;
                        ?>
                        @if($event->users())

                        @foreach ($event->users as $user)
                        @if ($user->id == auth::id())
                        <?php $isJoin = true;?>
                        @break;
                        @else
                        <?php $isJoin = false; ?>
                        @endif

                        @endforeach
                        @else
                        <?php $isJoin = false; ?>
                        @endif

                        @if($isJoin == true)
                        <a href="{{ route('quitEvent', $event->id) }}" class="btn btn-danger mr-3"><span class="material-icons float-left">highlight_off</span> Quit</a>

                        @else
                        <form action="{{ route('joinEvent', $event->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-secondary mr-3"><span class="material-icons float-left">check_circle_outline</span> Join</button>
                        </form>
                        @endif
                        <div id="action" class="float-right">

                        </div>
                    </div>

                </div>
        </div>
    </div>
</div>

@endsection
