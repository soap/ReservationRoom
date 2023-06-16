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
        window.location.assign(route('timeslots',moment(pickedDate,'DD/MM/YYYY').format('YYYY-MM-DD')));
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
    <div style="display: flex; flex-direction: column; width: 100%;">
        <div style="display: flex; flex-direction: row;">
            <div style="width: 150px; padding: 10px;background: rgb(57, 57, 255);color: white;font-size: 15px;" value="{{$date}}">
                {{$date}}
            </div>
            <div
                style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 12px;">
                00:00</div>
            @for ($i = strtotime('08:00') ; $i <= strtotime('19:00') ; $i = $i + 60*60)
            <div
                style="flex: 2; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 12px;" value="{{date('H:i A',$i)}}">
                {{date('H:i A',$i)}}</div>
            @endfor
            <div
                style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 12px;">
                20:00</div>
        </div>
        @foreach($Room as $room)
        <div>
            <div style="display: flex; flex-direction: row;" id="myTable">
                <div
                    style="width: 150px; padding: 10px;border: 2px solid rgb(57, 57, 255);background: rgb(224, 224, 255);font-size: 15px; "value="{{$room->room_name}}">
                    {{$room->room_name}}</div>
                <div
                    style="width: 50px; padding: 10px;border: 1px solid rgb(57, 57, 255);background: rgb(234, 82, 82);">
                </div>
                @for ($i = 0; $i < 24; $i++) <div class="cell">
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
    let prarmiter=[];

    cells.forEach(cell => {
        cell.addEventListener('mousedown', () => {
            isDragging = true;
            cell.classList.add('dragging');
            selectedCells.push(cell);
            // paramiter.push({'room': $room});
            // paramiter.push({'date' : $date});
            // paramiter.push({'start_time' : });
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
        window.location.assign(route('reserve/create',));

    });
</script>
@endsection