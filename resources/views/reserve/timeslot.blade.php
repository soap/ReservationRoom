@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>

<style>
    .mytable {
        display: grid;
        grid-template-columns: repeat(24, 1fr);
    }

    .cell {
        flex: 1;
        border: 1px solid rgb(57, 57, 255);
        ;
        padding: 10px;
    }

    .cell.dragging {
        background-color: rgb(255, 255, 0);
    }
</style>

<div class="container mb-3">
    <div class="d-flex justify-content-center">
        <div class="mr-4" onclick="handlePreviousWeek()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-chevron-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
            </svg>
        </div>
        <div class="w-20">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3"
                viewBox="0 0 16 16" id="datepicker-icon">
                <path
                    d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                <path
                    d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            </svg>
        </div>
        <input type="text" id="datepicker" onchange="handleDateChange()" min="@php echo date('Y-m-d'); @endphp"
            style="display: none;" />
        <div class="ml-4" onclick="handleNextWeek()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-chevron-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </div>
    </div>
</div>

<script>
    $('#datepicker-icon').click(function () {
        $('#datepicker').datepicker('show');
    });

    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        minDate: new Date() // Sets minimum date to today
    });

    function handleDateChange() {
        var selectedDate = $('#datepicker').val();
        window.location.assign(route('timeslots', selectedDate));
    }

    function handlePreviousWeek() {
        console.log("test previous is doing");
        let path = window.location.pathname;
        let arr_path = path.split("/");
        if (arr_path.length == 2) {
            arr_path[2] = new Date();
        } else {
            arr_path[2] = new Date(arr_path[2]);
        }
        arr_path[2].setDate(arr_path[2].getDate() - 7);
        arr_path[2] = arr_path[2].toJSON().slice(0, 10);
        window.location.assign(route('timeslots', arr_path[2]));
    }

    function handleNextWeek() {
        let path = window.location.pathname;
        let arr_path = path.split("/");
        if (arr_path.length == 2) {
            arr_path[2] = new Date();
        } else {
            arr_path[2] = new Date(arr_path[2]);
        }
        arr_path[2].setDate(arr_path[2].getDate() + 7);
        arr_path[2] = arr_path[2].toJSON().slice(0, 10);
        window.location.assign(route('timeslots', arr_path[2]));
    }
</script>

<div class="flex-container mx-5">
    @if ($message=Session::get('time_error'))
    <div class="alert alert-danger">
        <p> {{$message}}</p>
    </div>
    @endif
    <div style="display: flex; flex-direction: row; width: 100%;margin-bottom: 10px;" class="table table-bordered">
        <div
            style="background:white;flex-grow: 1;padding: 10px;margin-right: 2%;border: 2px solid black;border-radius: 10px;text-align: center;">
            Resevable</div>
        <div
            style="background:rgb(234, 82, 82);flex-grow: 1;padding: 10px;margin-right: 2%;color: white;border: 2px solid black;border-radius: 10px;text-align: center;">
            Unreservable</div>
        <div
            style="background:rgb(66, 135, 255);flex-grow: 1;padding: 10px;margin-right: 2%;color: white;border: 2px solid black;border-radius: 10px;text-align: center;">
            Reserved</div>
        <div
            style="background:rgb(0, 215, 133);flex-grow: 1;padding: 10px;margin-right: 2%;color: white;border: 2px solid black;border-radius: 10px;text-align: center;">
            My Reservation</div>
        <div
            style="background:rgb(189, 35, 255);flex-grow: 1;padding: 10px;margin-right: 2%;color: white;border: 2px solid black;border-radius: 10px;text-align: center;">
            Participant</div>
        <div
            style="background:rgb(255, 174, 0);flex-grow: 1;padding: 10px;margin-right: 2%;color: white;border: 2px solid black;border-radius: 10px;text-align: center;">
            Pending</div>
        <div
            style="background:rgb(118, 118, 118);flex-grow: 1;padding: 10px;margin-right: 2%;color: white;border: 2px solid black;border-radius: 10px;text-align: center;">
            Past</div>
        <div
            style="background:rgb(255, 205, 205);flex-grow: 1;padding: 10px;border: 2px solid black;border-radius: 10px;text-align: center;">
            Restricted</div>
    </div>
    @foreach($Days as $date)
    <div style="display: flex; flex-direction: column; width: 100%;" class="date" value="{{$date}}">
        <div style="display: flex; flex-direction: row; ">
            <div style="width: 150px; padding: 10px;background: rgb(57, 57, 255);color: white;font-size: 15px;">
                {{$date}}
            </div>
            <div
                style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 12px;">
                00:00</div>
            @for ($i = strtotime('08:00') ; $i <= strtotime('19:00') ; $i=$i + 60*60) <div
                style="flex: 2; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 12px;">
                {{date('H:i',$i)}}
        </div>
        @endfor
        <div
            style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 12px;">
            20:00</div>
    </div>
    @foreach($Rooms as $room)
    <div>
        <div style="display: flex; flex-direction: row;" id="myTable">
            <div style="width: 150px; padding: 10px;border: 2px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 15px; "
                value="{{$room->id}}" class="room" data-bs-toggle="modal" data-bs-target="#myModal{{$room->id}}">
                {{$room->room_name}}</div>
            <div style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(234, 82, 82);">
            </div>
            @for ($i = strtotime('08:30'); $i <= strtotime('20:00'); $i=$i + 30*60) <div class="cell"
                value="{{date('H:i',$i)}}" data-toggle="tooltip" data-placement="top" style="
                @php
                $dateTime = \Carbon\Carbon::parse($date . ' ' . date('H:i', $i));
                $cellStyle = '';
                $now = date('Y-m-d H:i',strtotime('+7 hours'));
                if($dateTime < $now) {
                    $cellStyle = 'background: rgb(118, 118, 118)';
                }
                $userId = Auth::id();
                $username = Auth::user()->name;
                foreach ($Reservations as $reservation) {
                    $array_participant = explode(',',$reservation->participant);
                    if($dateTime < $now) {
                        break;
                    }elseif (($dateTime > $reservation->start_time && $dateTime <= $reservation->stop_time) && $room->id == $reservation->room_id && $reservation->permission_status == 1) {
                        $cellStyle = 'background: rgb(255, 174, 0)';
                        break;
                    }elseif (($dateTime > $reservation->start_time && $dateTime <= $reservation->stop_time) && $room->id == $reservation->room_id && $username==$reservation->name) {
                        $cellStyle = 'background: rgb(0, 215, 133)';
                        break;
                    }elseif (($dateTime > $reservation->start_time && $dateTime <= $reservation->stop_time) && $room->id == $reservation->room_id && in_array($userId, $array_participant)) {
                        $cellStyle = 'background: rgb(189, 35, 255)';
                        break;
                    }elseif (($dateTime > $reservation->start_time && $dateTime <= $reservation->stop_time) && $room->id == $reservation->room_id) {
                        $cellStyle = 'background: rgb(66, 135, 255)';
                        break;
                    }
                }
                echo $cellStyle;
                @endphp
            " @php if ($cellStyle !='' && $cellStyle !='background: rgb(118, 118, 118)' ) { echo 'title="' .
                $reservation->title . '"';
                }
                @endphp >
        </div>
        @endfor
        <div style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(234, 82, 82);">
        </div>
    </div>
    <div class="modal" id="myModal{{$room->id}}">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">{{$room->room_name}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            @if($room->image)
                            <img src="{{ asset('storage/images/'.$room->image) }}" class="card-img" alt="Image">
                            @else
                            <span>No image found!</span>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Room Details</h5>
                                        <p class="card-text">
                                            Room ID: {{$room->id}}<br>
                                            Room Name: {{$room->room_name}}<br>
                                            Room Color: {{$room->color}}
                                        </p>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Reservation Settings</h5>
                                        <p class="card-text">
                                            Min reservation: 30 minutes<br>
                                            Max reservation: -<br>
                                            Approval required: No<br>
                                            Min Notice: 30 minutes<br>
                                            Max notice: -<br>
                                            Overlapped day reservation: No<br>
                                            Max participants: {{$room->max_participant}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endforeach
</div>
</div>

<script>
    const cells = document.querySelectorAll('.cell');
    let isDragging = false;
    let selectedCells = [];
    let dataMousedown = [];
    let dataMouseup = [];
    let data = [];

    cells.forEach(cell => {
        cell.addEventListener('mousedown', () => {
            if (window.getComputedStyle(cell).getPropertyValue('background-color') === 'rgba(0, 0, 0, 0)') {
                isDragging = true;
                cell.classList.add('dragging');
                selectedCells.push(cell);
                if (event.target.classList.contains("cell")) {
                    var cellValue = cell.getAttribute("value");

                    //get start time
                    const temptime = cellValue.split(':');
                    function convertToSeconds(temptime) {
                        return Number(temptime[0]) * 60 * 60 + (Number(temptime[1]) - 30) * 60;
                    }
                    console.log(convertToSeconds(temptime));
                    var date = new Date(null);
                    date.setSeconds(convertToSeconds(temptime));
                    var hhmmssFormat = date.toISOString().substr(11, 5);
                    console.log(hhmmssFormat);

                    var roomValue = cell.parentNode.parentNode.querySelector(".room").getAttribute("value");
                    var dateValue = cell.closest(".date").getAttribute("value");

                    dataMousedown.room = roomValue;
                    dataMousedown.date = dateValue;
                    dataMousedown.start_time = hhmmssFormat;

                    console.log(dataMousedown);
                }
            }
        });

        cell.addEventListener('mouseover', () => {
            if (isDragging && !selectedCells.includes(cell) && window.getComputedStyle(cell).getPropertyValue('background-color') === 'rgba(0, 0, 0, 0)') {
                cell.classList.add('dragging');
                selectedCells.push(cell);
            }
        });
    });

    document.addEventListener('mouseup', () => {
        isDragging = false;
        selectedCells = [];
        cells.forEach(cell => {
            cell.classList.remove('dragging');
        });
        //check mouse up in cell
        if (!event.target.classList.contains("cell")) {
            return false;
        }
        //check mouse up is no status
        const cellBackground = window.getComputedStyle(event.target).getPropertyValue('background-color');
        if (cellBackground !== 'rgba(0, 0, 0, 0)') {
            return false;
        }
        if (event.target.classList.contains("cell")) {
            var stop_time = event.target.getAttribute("value");
            var roomValue = event.target.parentNode.parentNode.querySelector(".room").getAttribute("value");
            var dateValue = event.target.closest(".date").getAttribute("value");

            dataMouseup.room = roomValue;
            dataMouseup.date = dateValue;
            dataMouseup.stop_time = stop_time;

            console.log(dataMouseup);
        }
        //check same date and room
        if (((dataMousedown.room != dataMouseup.room) || dataMousedown.date != dataMouseup.date) && isDragging == false) {
            alert('error your selected room or date');
            return false;
        }
        data.room = dataMousedown.room;
        data.date = dataMousedown.date;
        data.start_time = dataMousedown.start_time;
        data.stop_time = dataMouseup.stop_time;
        console.log(data);
        //check start before stop
        if (data.start_time >= data.stop_time) {
            alert("you can't select start time after stop time");
            return false;
        }
        window.location.assign(route("room.reserve", {
            room: data.room, _query: {
                date: data.date,
                start_time: data.start_time,
                stop_time: data.stop_time
            }
        }));
        // clear buffer
        dataMousedown = [];
        dataMouseup = [];
        data = [];
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    cells.forEach(cell => {
        const cellStyle = window.getComputedStyle(cell);
        if (cellStyle.backgroundColor == 'rgb(118, 118, 118)') {
            cell.style.pointerEvents = 'none';
        }
    });
</script>
@endsection