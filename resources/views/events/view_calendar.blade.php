@extends('template')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.2.0/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.2.0/main.min.css">
<div class="container mt-3">
    <h3 class="mb-3">Explore Events Calendar</h3>
    <div class="row">
        <div class="col-2 btn btn-group mb-3">
            <a href="/home" class="btn btn-secondary" >Card</a>
            <a href="{{route('viewCalendar')}}" class="btn btn-dark">Calendar</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

            <div id="calendar"></div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'UTC',
            initialView: 'dayGridMonth',
            events:[
            @foreach($events as $event)
        {
            title: '{{$event->title}}: <?php $date = new DateTime($event->start_time); echo date_format($date, 'g:iA');?>',
                start: '{{$event->startDate}}',
            end: '{{$event->endDate}}'
        },
    @endforeach
    ] ,
        editable: true,
            selectable: true
    });
        calendar.render();
    });
</script>

@endsection
