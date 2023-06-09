@extends('layouts.app')

@section('content')
<div class="container" mt-2>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Laravel CRUD Example</h2>
        </div>
        <div>
            <a href="{{route('reserve.create')}}" class="btn btn-success mb-3">Reserve Room</a>
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
            @foreach($Reservation as $reserve)
            <tr>
                <td>{{$reserve->id}}</td>
                <td>{{$reserve->name}}</td>
                <td>{{$reserve->start_time}}</td>
                <td>{{$reserve->stop_time}}</td>
                <td>
                    <form action="{{route('reserve.destroy', $reserve->id)}}" method="post">
                        <a href="{{route('reserve.edit', $reserve->id)}}" class="btn btn-warning">EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!!$Reservation->links('pagination::bootstrap-5')!!}
    </div>
</div>
@endsection