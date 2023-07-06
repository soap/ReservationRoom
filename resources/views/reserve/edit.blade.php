@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<!-- Select2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <h2>Convention Rreserve</h2>
        </div>
        <div>
            <a href="{{route('reserve.index')}}" class="btn btn-primary">Back</a>
        </div>
        <form action="{{route('reserve.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Reserve Title</strong>
                        <input type="text" name="title" value="{{$reserve->title}}" class="form-control" placeholder="Reserve Title">
                        @error('title')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Reserve Name</strong>
                        <input type="text" name="name" value="{{$reserve->name}}" class="form-control"
                            placeholder="Convention Room Name">

                        @error('name')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <h1>{{$reserve->room_id}}</h1>
                        <input type="hidden" name="room_id" value="{{$reserve->room_id}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Date</strong>
                        @php
                        $formatteddate = \Carbon\Carbon::parse($reserve->start_time)->format('Y-m-d');
                        @endphp
                        <strong>{{$formatteddate}}</strong><br>
                        <input type="date" value="{{$formatteddate}}" name="date" class="form-control"
                            placeholder="date" max="{{$formatteddate}}" min="{{$formatteddate}}">
                        @error('date')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Start time</strong>
                        <select class="form-select" id="startTime" name="start_time">
                            @php
                            $formattedStartTime = \Carbon\Carbon::parse($reserve->start_time)->format('H:i');
                            @endphp
                            <option value="08:00" @selected($formattedStartTime == '08:00')>8:00</option>
                            <option value="08:30" @selected($formattedStartTime == '08:30')>8:30</option>
                            <option value="09:00" @selected($formattedStartTime == '09:00')>9:00</option>
                            <option value="09:30" @selected($formattedStartTime == '09:30')>9:30</option>
                            <option value="10:00" @selected($formattedStartTime == '10:00')>10:00</option>
                            <option value="10:30" @selected($formattedStartTime == '10:30')>10:30</option>
                            <option value="11:00" @selected($formattedStartTime == '11:00')>11:00</option>
                            <option value="11:30" @selected($formattedStartTime == '11:30')>11:30</option>
                            <option value="12:00" @selected($formattedStartTime == '12:00')>12:00</option>
                            <option value="12:30" @selected($formattedStartTime == '12:30')>12:30</option>
                            <option value="13:00" @selected($formattedStartTime == '13:00')>13:00</option>
                            <option value="13:30" @selected($formattedStartTime == '13:30')>13:30</option>
                            <option value="14:00" @selected($formattedStartTime == '14:00')>14:00</option>
                            <option value="14:30" @selected($formattedStartTime == '14:30')>14:30</option>
                            <option value="15:00" @selected($formattedStartTime == '15:00')>15:00</option>
                            <option value="15:30" @selected($formattedStartTime == '15:30')>15:30</option>
                            <option value="16:00" @selected($formattedStartTime == '16:00')>16:00</option>
                            <option value="16:30" @selected($formattedStartTime == '16:30')>16:30</option>
                            <option value="17:00" @selected($formattedStartTime == '17:00')>17:00</option>
                            <option value="17:30" @selected($formattedStartTime == '17:30')>17:30</option>
                            <option value="18:00" @selected($formattedStartTime == '18:00')>18:00</option>
                            <option value="18:30" @selected($formattedStartTime == '18:30')>18:30</option>
                            <option value="19:00" @selected($formattedStartTime == '19:00')>19:00</option>
                            <option value="19:30" @selected($formattedStartTime == '19:30')>19:30</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="from-group">
                        <strong>Stop time</strong>
                        <select class="form-select" id="stopTime" name="stop_time">
                            @php
                            $formattedStopTime = \Carbon\Carbon::parse($reserve->start_time)->format('H:i');
                            @endphp
                            <option value="08:30" @selected($formattedStopTime == '08:30')>8:30</option>
                            <option value="09:00" @selected($formattedStopTime == '09:00')>9:00</option>
                            <option value="09:30" @selected($formattedStopTime == '09:30')>9:30</option>
                            <option value="10:00" @selected($formattedStopTime == '10:00')>10:00</option>
                            <option value="10:30" @selected($formattedStopTime == '10:30')>10:30</option>
                            <option value="11:00" @selected($formattedStopTime == '11:00')>11:00</option>
                            <option value="11:30" @selected($formattedStopTime == '11:30')>11:30</option>
                            <option value="12:00" @selected($formattedStopTime == '12:00')>12:00</option>
                            <option value="12:30" @selected($formattedStopTime == '12:30')>12:30</option>
                            <option value="13:00" @selected($formattedStopTime == '13:00')>13:00</option>
                            <option value="13:30" @selected($formattedStopTime == '13:30')>13:30</option>
                            <option value="14:00" @selected($formattedStopTime == '14:00')>14:00</option>
                            <option value="14:30" @selected($formattedStopTime == '14:30')>14:30</option>
                            <option value="15:00" @selected($formattedStopTime == '15:00')>15:00</option>
                            <option value="15:30" @selected($formattedStopTime == '15:30')>15:30</option>
                            <option value="16:00" @selected($formattedStopTime == '16:00')>16:00</option>
                            <option value="16:30" @selected($formattedStopTime == '16:30')>16:30</option>
                            <option value="17:00" @selected($formattedStopTime == '17:00')>17:00</option>
                            <option value="17:30" @selected($formattedStopTime == '17:30')>17:30</option>
                            <option value="18:00" @selected($formattedStopTime == '18:00')>18:00</option>
                            <option value="18:30" @selected($formattedStopTime == '18:30')>18:30</option>
                            <option value="19:00" @selected($formattedStopTime == '19:00')>19:00</option>
                            <option value="19:30" @selected($formattedStopTime == '19:30')>19:30</option>
                            <option value="20:00" @selected($formattedStopTime == '20:00')>20:00</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Participant</strong>
                        <select id="employeeSelect" class="form-control" name="participant[]" multiple>
                            @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if ($message=Session::get('time_error'))
                <div class="alert alert-danger">
                    <p> {{$message}}</p>
                </div>
                @elseif ($message=Session::get('success'))
                <div class="alert alert-success">
                    <p> {{$message}}</p>
                </div>
                @elseif (session('status'))
                <div class="alert alert-success">
                    {{ session('status')}}
                </div>
                @endif
                <div class="col-md-12">
                    <button type="submit" class="mt-3 btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#employeeSelect').select2({
            placeholder: 'Search employees',
            width: '100%'
        });
    });
</script>
@endsection