@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>


<div class="container" mt-2>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Room</h2>
        </div>
        <div>
            <a href="{{route('room.create')}}" class="btn btn-success mb-3">Create Room</a>
        </div>
        @if ($message=Session::get('success'))
        <div class="alert alert-success">
            <p> {{$message}}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th width="280px">Action</th>
            </tr>
            @foreach($Room as $room)
            <tr>
                <td>{{$room->id}}</td>
                <td>{{$room->room_name}}</td>
                <td>
                    <form action="{{route('room.destroy', $room->id)}}" method="post">
                        <a href="{{ route('room.reserve', $room->id) }}" class="btn btn-info">RESERVE</a>
                        <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning">EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!!$Room->links('pagination::bootstrap-5')!!}
    </div>
    <div id='calendar'></div>
</div>
<script>
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            events: "{{route('room.calendar')}}",
            displayEventTime: false,
            editable: true,
            selectable: true,
            selectHelper: true,
            theme: true,
            themeSystem: 'bootstrap4',
        });
    });
</script>
@endsection