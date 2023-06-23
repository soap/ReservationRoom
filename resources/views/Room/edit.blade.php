@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit Convention Room</h2>
        </div>
        <div>
            <a href="{{route('room.index')}}" class="btn btn-primary">Back</a>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status')}}
        </div>
        @endif
        <form action="{{route('room.update', $room->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Reserve name</strong>
                        <input type="text" name="name" value="{{$room->name}}" class="form-control"
                            placeholder="Reserve Name">

                        @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Room color</strong>
                        <input type="color" name="color" class="form-control"placeholder="Convention Room Color">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Max participant</strong>
                        <input type="number" name="max_participant" class="form-control" placeholder="Convention Room max participant">
                    </div>
                </div>
                @if ($message=Session::get('error'))
                <div class="alert alert-danger col-md-12">
                    <p> {{$message}}</p>
                </div>
                @endif
                <div class="col-md-12">
                    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection