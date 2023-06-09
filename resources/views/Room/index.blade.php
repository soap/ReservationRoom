@extends('layouts.app')

@section('content')
<div class="container" mt-2>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Laravel CRUD Example</h2>
        </div>
        <div>
            <a href="{{route('room.create')}}" class="btn btn-success mb-3">Reserve Room</a>
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
                <th>Start Time</th>
                <th>Stop Time</th>
                <th width="280px">Action</th>
            </tr>
            @foreach($ConventionRoom as $room)
            <tr>
                <td>{{$room->id}}</td>
                <td>{{$room->name}}</td>
                <td>{{$room->start_time}}</td>
                <td>{{$room->stop_time}}</td>
                <td>
                    <form action="{{route('room.destroy', $room->id)}}" method="post">
                        <a href="{{route('room.edit', $room->id)}}" class="btn btn-warning">EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!!$ConventionRoom->links('pagination::bootstrap-5')!!}
    </div>
</div>
@endsection