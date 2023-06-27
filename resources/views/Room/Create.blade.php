@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <h2>Convention Rreserve</h2>
        </div>
        <div>
            <a href="{{route('room.index')}}" class="btn btn-primary">Back</a>
        </div>
        @if ($message=Session::get('success'))
        <div class="alert alert-success">
            <p> {{$message}}</p>
        </div>
        @endif
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status')}}
        </div>
        @endif
        <form action="{{route('room.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Reserve Name</strong>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                            placeholder="Convention Room Name">
                        @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Room color</strong>
                        <input type="color" name="color" class="form-control" placeholder="Convention Room Color">
                        @error('color')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Max participant</strong>
                        <input type="number" name="max_participant" class="form-control"
                            placeholder="Convention Room max participant">
                        @error('max_participant')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Image Convention room</strong>
                        <input type="file" class="form-control" name="image" @error('image') is-invalid @enderror>
                        @error('image')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Admin Permission</strong><br>
                        <input type="checkbox" class="form-check-input" name="admin_permission">
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