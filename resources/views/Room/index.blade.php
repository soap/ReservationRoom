@extends('layouts.app')

@section('content')
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
</div>
@endsection