<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function index()
    {
        $data['ConventionRoom'] = Room::orderBy('id', 'asc')->paginate(5);
        return view('Room.index', $data);
    }

    public function create()
    {
        return view('Room.create');
    }

    public function store(Request $request){
        $todayDate = date('m/d/Y');
        $request->validate([
            'name'=> ['required','string'],
            'date'=> ['date','after_or_equal:'.$todayDate],
            'start_time' => ['nullable','date_format:H:i'],
            'stop_time' => ['nullable','date_format:H:i','after:start_time']
        ]);
        $start_str = "{$request->date} {$request->start_time}";
        $stop_str = "{$request->date} {$request->stop_time}";

        $room = new Room;
        $room->name = $request->name;
        $room->start_time = Carbon::parse($start_str)->format('Y-m-d H:i:s');
        $room->stop_time = Carbon::parse($stop_str)->format('Y-m-d H:i:s');
        $room->save();
        return redirect()->route('room.index')->with('success', 'ConventionRoom has been created successfully.');
    }

    public function edit(Room $room){
        return view('Room.edit', compact('room'));
    }

    public function update(Request $request, $id){
        $todayDate = date('m/d/Y');
        $request->validate([
            'name'=> ['required','string'],
            'date'=> ['date','after_or_equal:'.$todayDate],
            'start_time' => ['nullable','date_format:H:i'],
            'stop_time' => ['nullable','date_format:H:i','after:start_time']
        ]);
        $start_str = "{$request->date} {$request->start_time}";
        $stop_str = "{$request->date} {$request->stop_time}";

        $room = new Room;
        $room->name = $request->name;
        $room->start_time = Carbon::parse($start_str)->format('Y-m-d H:i:s');
        $room->stop_time = Carbon::parse($stop_str)->format('Y-m-d H:i:s');
        $room->save();
        return redirect()->route('room.index')->with('success', 'ConventionRoom has been update successfully.');
    }

    public function destroy(Room $room){
        $room->delete();
        return redirect()->route('room.index')->with('success', 'ConventionRoom has been delete successfully.');
    }


}
