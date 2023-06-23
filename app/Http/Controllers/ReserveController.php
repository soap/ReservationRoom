<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Spatie\Period\Period;
use Spatie\Period\Precision;
use App\Http\Requests\ValidateReserve;
use Spatie\Period\Boundaries;

class ReserveController extends Controller
{
    public function index()
    {
        $data['Reservation'] = Reserve::orderBy('id', 'asc')->paginate(5);
        return view('reserve.index', $data);
    }

    public function create()
    {
        return view('reserve.create');
    }

    public function store(ValidateReserve $request)
    {
        $start_str = Carbon::parse("{$request->date} {$request->start_time}")->format('Y-m-d H:i:s');
        $stop_str = Carbon::parse("{$request->date} {$request->stop_time}")->format('Y-m-d H:i:s');
        $particapant = $request->input('particapant');
        $room = Room::find($request->room_id);
        // dd($room->max_participant);
        if(sizeof($particapant) > $room->max_participant){
            return redirect()->route('timeslots')->with('time_error', 'Too many participant for a convention room. please choose another convention room.');
        }
        $participant_str = join(',',$particapant);
        //check period from db
        $checkperiod = Reserve::where('room_id',$request->room_id)->get();
        foreach ($checkperiod as $period) {
            $a = Period::make($period->start_time, $period->stop_time, Precision::HOUR(), boundaries: Boundaries::EXCLUDE_END());
            $b = Period::make($start_str, $stop_str, Precision::HOUR(), boundaries: Boundaries::EXCLUDE_END());
            if (($a->overlapsWith($b)) == true) {
                return redirect()->route('timeslots')->with('time_error', 'The selected time has already been reserved. please try again.');
            }
        }

        //create data
        $reserve = new Reserve;
        $reserve->name = $request->name;
        $reserve->room_id = $request->room_id;
        $reserve->start_time = $start_str;
        $reserve->stop_time = $stop_str;
        $reserve->participant = $participant_str;
        $reserve->save();
        return redirect()->route('room.index')->with('success', 'Reserve has been created successfully.');
    }

    public function edit(Reserve $reserve)
    {
        return view('reserve.edit', compact('reserve'));
    }

    public function update(ValidateReserve $request, $id)
    {

        $start_str = Carbon::parse("{$request->date} {$request->start_time}")->format('Y-m-d H:i:s');
        $stop_str = Carbon::parse("{$request->date} {$request->stop_time}")->format('Y-m-d H:i:s');

        //check period from model
        $checkperiod = Reserve::where('room_id',$request->room_id)->get();
        foreach ($checkperiod as $period) {
            $a = Period::make($period->start_time, $period->stop_time, Precision::HOUR());
            $b = Period::make($start_str, $stop_str, Precision::HOUR());
            if (($a->overlapsWith($b)) == true) {
                return redirect()->route('timeslots')->with('time_error', 'The selected time has already been reserved. please try again.');
            }
        }

        $reserve = Reserve::find($id);
        $reserve->name = $request->name;
        $reserve->room_id = $request->room_id;
        $reserve->start_time =  $start_str;
        $reserve->stop_time = $stop_str;
        $reserve->save();
        return redirect()->route('reserve.index')->with('success', 'Reserve has been update successfully.');
    }

    public function destroy(Reserve $reserve)
    {
        $reserve->delete();
        return redirect()->route('reserve.index')->with('success', 'Reserve has been delete successfully.');
    }

    public function indextimeslot(Request $request, $date=null){
        if(is_null($date)){
            $date = Carbon::now();
        }else{
            $date = Carbon::parse($date);
        }
            $start = $date->startOfWeek(Carbon::MONDAY);
            $weekStartDate = $start->startOfWeek()->format('Y-m-d H:i');
        $tempdate=[];
        for($i=0;$i<5;$i++){
            $days_ago = gmdate("d-m-Y", strtotime("+$i days", strtotime($weekStartDate)));
            array_push($tempdate,$days_ago);
        }
        $start_time = $date->format('Y-m-d H:i:s');
        $stop_time = date('Y-m-d', strtotime($start_time .' +6 day'));
        $Reservations = Reserve::where('start_time' ,'>=', $start_time )->where('stop_time' ,'<=' , $stop_time)->get();
        $Days = $tempdate;
        $Rooms = Room::orderBy('id', 'asc')->get();

        return view('reserve.timeslot', compact('Reservations','Days','Rooms'));
    }
}