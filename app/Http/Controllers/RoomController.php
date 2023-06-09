<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

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
        $request->validate([
            'name'=> ['required','string'],
            'start_time' => ['required', 'date_format:Y-m-d H:i:s'],
            'stop_time' => ['required', 'date_format:Y-m-d H:i:s']
        ]);

        $room = new Room;
        $room->name = $request->name;
        $room->start_time = $request->start_time;
        $room->stop_time = $request->stop_time;
        $room->save();
        return redirect()->route('room.index')->with('success', 'ConventionRoom has been created successfully.');
    }

    public function edit(Room $room){
        return view('Room.edit', compact('room'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'start_time' => 'required', 'date_format:"Y-m-d H:i:s"',
            'stop_time' => 'required', 'date_format:"Y-m-d H:i:s"'
        ]);

        $room = Room::find($id);
        $room->name = $request->name;
        $room->start_time = $request->start_time;
        $room->stop_time = $request->stop_time;
        $room->save();
        return redirect()->route('room.index')->with('success', 'ConventionRoom has been update successfully.');
    }

    public function destroy(Room $room){
        $room->delete();
        return redirect()->route('room.index')->with('success', 'ConventionRoom has been delete successfully.');
    }
}
