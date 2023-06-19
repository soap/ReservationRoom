@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

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
        background-color: yellow;
    }
</style>

<div class="container">
    <div class="datepicker date 
                input-group p-0 shadow-sm">
        <input id="reservationDate" type="text" placeholder="Choose a date" class="form-control py-4 px-4" />
        <div class="input-group-append">
            <span class="input-group-text px-4">
                <i class="fa fa-clock-o"></i>
            </span>
        </div>
    </div>
</div>
<div class="container">
    <p id="showdate"> No Date is Picked </p>
</div>

<script>

    $(".datepicker").datepicker({
        clearBtn: true,
        format: "dd/mm/yyyy",
    });
    $(".datepicker").on("change", function () {
        let pickedDate = $("input").val();
        $("#showdate").text(`You picked this ${pickedDate} Date`);
        window.location.assign(route('timeslots', moment(pickedDate, 'DD/MM/YYYY').format('YYYY-MM-DD')));
    });
</script>

<div class="container">
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
            Particapant</div>
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
    @foreach($Date as $date)
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
    @foreach($Room as $room)
    <div>
        <div style="display: flex; flex-direction: row;" id="myTable">
            <div style="width: 150px; padding: 10px;border: 2px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 15px; "
                value="{{$room->room_name}}" class="room">
                {{$room->room_name}}</div>
            <div style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(234, 82, 82);">
            </div>
            @for ($i = strtotime('08:30') ; $i <= strtotime('20:00') ; $i=$i + 30*60) <div class="cell"
                value="{{date('H:i',$i)}}">
        </div>
        @endfor
        <div style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(234, 82, 82);">
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
        });

        cell.addEventListener('mouseover', () => {
            if (isDragging && !selectedCells.includes(cell)) {
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
        if ((dataMousedown.room != dataMouseup.room) || dataMousedown.date != dataMouseup.date && isDragging == true) {
            alert('select same room or date');
            return false;
        }
        data.room = dataMousedown.room;
        data.date = dataMousedown.date;
        data.start_time = dataMousedown.start_time;
        data.stop_time = dataMouseup.stop_time;
        console.log(data);
        // window.location.assign(route('reserve/create',));
        //clear buffer
        dataMousedown = [];
        dataMouseup = [];
        data = [];
    });
</script>
@endsection