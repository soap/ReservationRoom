@extends('layouts.app')

@section('content')
<div class="container" mt-2>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h2>Laravel CRUD Example</h2>
        </div>
        <div>
            <a href="{{route('reserve.create', 'room_id')}}" class="btn btn-success mb-3">Reserve Room</a>
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
                <th>room_id</th>
                <th>Start Time</th>
                <th>Stop Time</th>
                <th>Participant</th>
                <th>Permission Status</th>
                <th width="280px">Action</th>
            </tr>
            @foreach($Reservation as $reserve)
            <tr>
                <td>{{$reserve->id}}</td>
                <td>{{$reserve->name}}</td>
                <td>{{$reserve->room_id}}</td>
                <td>{{$reserve->start_time}}</td>
                <td>{{$reserve->stop_time}}</td>
                <td>{{$reserve->participant}}</td>
                <td>
                    <div class="form-check form-switch">
                        @if($reserve->permission_status == 1)
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                            checked>
                        @elseif($reserve->permission_status == 0)
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked"
                            disabled>
                        @endif
                        <label class="form-check-label" for="flexSwitchCheckChecked">Checked switch checkbox
                            input</label>
                    </div>
                </td>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#flexSwitchCheckChecked').on('change', function () {
            if ($(this).is(':not(:checked)')) {
                if (confirm("Press a button!") == true) {
                    window.location.href = '{{ route("updateReserveStatus", $reserve->id) }}';
                } else {
                    window.location.href = '{{ route("reserve.index") }}';
                }
            }
        });
    });
</script>
@endsection