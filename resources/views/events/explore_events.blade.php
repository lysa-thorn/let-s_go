@extends('template')

@section('content')

<div class="container mt-3">
    <div class="row">

        <div class="col-12">
            <h3 class="mb-3">Explore Events</h3>
            <div class="row">
                <div class="col-2 btn btn-group mb-3">
                    <a href="/home" class="btn btn-secondary" >Card</a>
                    <a href="{{route('viewCalendar')}}" class="btn btn-dark">Calendar</a>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <input type="text" id="searchEven" placeholder="Find Event Here" class="form-control">
                </div>
                <div class="col-4">
                    <select name="city" id="city" required class="form-control">
                        <option selected disabled value="">City</option>
                        <option value="">--</option>
                        @foreach($data as $item)
                        <option>{{$item['cityCountry']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <button class="btn btn-secondary float-right" id="search">Search</button>
                </div>
            </div>

            @foreach($events as $event)
            <?php
            $date = date('Y-m-d');
            ?>
            @if( $event->startDate >= $date)
            @if($event->organizer != auth::id())

            <div class="card mt-2">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-2 mt-5">
                            @if($event->startTime < 12) <h3>{{\Carbon\Carbon::createFromFormat('H:i:s',$event->startTime)->format('h:i')}} AM</h3>
                            @else
                            <h3>{{\Carbon\Carbon::createFromFormat('H:i:s',$event->startTime)->format('h:i')}} PM</h3>
                            @endif
                            <p>{{\Carbon\Carbon::parse($event->startDate)->format('d/m/Y')}}</p>
                        </div>
                        <div class="col-sm-6 col-md-4 text-center mt-4">
                            <h5>{{$event->Category['name']}}</h5>
                            <h3>{{$event->title}}</h3>
                            <p>{{$event->numberOfMember}} Members going!</p>
                            <p>{{$event->location}}</p>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <img src="{{asset('images/'.$event->eventPicture)}}" alt="No Image" class="img img-thumbnail m-3" style="width:150px; height:130px;">
                        </div>
                        <div class="col-sm-6 col-md-3 mt-5">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-secondary float-right mr-3">Detail</a>
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
                                <a href="{{ route('quitEvent', $event->id) }}" class="btn btn-danger float-right mr-3"><span class="material-icons float-left">highlight_off</span> Quit</a>

                            @else
                                <form action="{{ route('joinEvent', $event->id) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-secondary float-right mr-3"><span class="material-icons float-left">check_circle_outline</span> Join</button>
                                </form>
                            @endif


                        </div>


                    </div>
            </div>
        </div>
            @endif
            @endif
            @endforeach
    </div>
        <script>
            $(document).ready(function(){
                $('#search').on("click", function() {
                    var value = $("#searchEven").val().toLowerCase();
                    $(".card").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
                $('#search').on('click', function(){
                    var value = $('#city').val().toLowerCase();
                    $(".card").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                })
            });
        </script>
</div>

@endsection

