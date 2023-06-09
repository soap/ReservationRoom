@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit Convention Room</h2>
        </div>
        <div>
            <a href="{{route('reserve.index')}}" class="btn btn-primary">Back</a>
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status')}}
        </div>
        @endif
        <form action="{{route('reserve.update', $reserve->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Reserve name</strong>
                        <input type="text" name="name" value="{{$reserve->name}}" class="form-control"
                            placeholder="Reserve Name">

                        @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Date</strong>
                        <input type="date" name="date" class="form-control" placeholder="date">
                        @error('date')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Start time</strong>
                        <select class="form-select" id="startTime" name="start_time">
                            <option selected>choose time..</option>
                            <option value="08:00">8:00</option>
                            <option value="08:30">8:30</option>
                            <option value="09:00">9:00</option>
                            <option value="09:30">9:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Stop time</strong>
                        <select class="form-select" id="stopTime" name="stop_time">
                            <option selected>choose time..</option>
                            <option value="08:00">8:00</option>
                            <option value="08:30">8:30</option>
                            <option value="09:00">9:00</option>
                            <option value="09:30">9:30</option>
                            <option value="10:00">10:00</option>
                            <option value="10:30">10:30</option>
                            <option value="11:00">11:00</option>
                            <option value="11:30">11:30</option>
                            <option value="12:00">12:00</option>
                            <option value="12:30">12:30</option>
                            <option value="13:00">13:00</option>
                            <option value="13:30">13:30</option>
                            <option value="14:00">14:00</option>
                            <option value="14:30">14:30</option>
                            <option value="15:00">15:00</option>
                            <option value="15:30">15:30</option>
                            <option value="16:00">16:00</option>
                            <option value="16:30">16:30</option>
                            <option value="17:00">17:00</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection