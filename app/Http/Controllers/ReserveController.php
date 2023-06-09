<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

        $room = new Reserve;
        $room->name = $request->name;
        $room->start_time = Carbon::parse($start_str)->format('Y-m-d H:i:s');
        $room->stop_time = Carbon::parse($stop_str)->format('Y-m-d H:i:s');
        $room->save();
        return redirect()->route('reserve.index')->with('success', 'Reserve has been created successfully.');
    }

    public function edit(Reserve $reserve){
        return view('reserve.edit', compact('reserve'));
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

        $room = Reserve::find($id);
        $room->name = $request->name;
        $room->start_time = Carbon::parse($start_str)->format('Y-m-d H:i:s');
        $room->stop_time = Carbon::parse($stop_str)->format('Y-m-d H:i:s');
        $room->save();
        return redirect()->route('reserve.index')->with('success', 'Reserve has been update successfully.');
    }

    public function destroy(Reserve $reserve){
        $reserve->delete();
        return redirect()->route('reserve.index')->with('success', 'Reserve has been delete successfully.');
    }

}
