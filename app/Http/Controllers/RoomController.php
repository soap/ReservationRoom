<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $data['Room'] = Room::orderBy('id', 'asc')->paginate(5);
        return view('room.index', $data);
    }

    public function create()
    {
        return view('room.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=> ['required','string']
        ]);

        $room = new Room;
        $room->room_name = $request->name;
        $room->save();
        return redirect()->route('room.index')->with('success', 'Reserve has been created successfully.');
    }

    public function edit(Room $room){
        return view('Room.edit', compact('room'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=> ['required','string']
        ]);

        $room = Room::find($id);;
        $room->room_name = $request->name;
        $room->save();
        return redirect()->route('room.index')->with('success', 'Room has been update successfully.');
    }

    public function destroy(Room $room){
        $room->delete();
        return redirect()->route('room.index')->with('success', 'Room has been delete successfully.');
    }

    public function reserve(Room $room){
        return view('reserve.create');
    }
}
