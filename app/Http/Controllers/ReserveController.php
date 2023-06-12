<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Period\Period;
use Spatie\Period\Precision;
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

    public function store(Request $request){
        $start_str = Carbon::parse("{$request->date} {$request->start_time}")->format('Y-m-d H:i:s');
        $stop_str = Carbon::parse("{$request->date} {$request->stop_time}")->format('Y-m-d H:i:s');

        //check period from db
        $checkperiod = DB::select('select * from reserves');
        foreach ($checkperiod as $period) {
            $a = Period::make($period->start_time, $period->start_time, Precision::HOUR());
            $b = Period::make($start_str, $stop_str,Precision::HOUR());
            if (($a->overlapsWith($b))== true){
                return redirect()->route('reserve.create')->with('time_error', 'The selected time has already been reserved. please try again.');
            }
        }

        //validate input data
        $todayDate = date('m/d/Y');
        $request->validate([
            'name'=> ['required','string'],
            'date'=> ['date','after_or_equal:'.$todayDate],
            'start_time' => ['nullable','date_format:H:i'],
            'stop_time' => ['nullable','date_format:H:i','after:start_time']
        ]);

        //create data
        $reserve = new Reserve;
        $reserve->name = $request->name;
        $reserve->start_time = $start_str;
        $reserve->stop_time = $stop_str;
        $reserve->save();
        return redirect()->route('reserve.index')->with('success', 'Reserve has been created successfully.');
    }

    public function edit(Reserve $reserve){
        return view('reserve.edit', compact('reserve'));
    }

    public function update(Request $request, $id){
        $start_str = Carbon::parse("{$request->date} {$request->start_time}")->format('Y-m-d H:i:s');
        $stop_str = Carbon::parse("{$request->date} {$request->stop_time}")->format('Y-m-d H:i:s');

        //check period from db
        $checkperiod = DB::select('select * from reserves');
        foreach ($checkperiod as $period) {
            $a = Period::make($period->start_time, $period->start_time, Precision::HOUR());
            $b = Period::make($start_str, $stop_str,Precision::HOUR());
            if (($a->overlapsWith($b))== true){
                return redirect()->route('reserve.create')->with('time_error', 'The selected time has already been reserved. please try again.');
            }
        }

        //validate input data
        $todayDate = date('m/d/Y');
        $request->validate([
            'name'=> ['required','string'],
            'date'=> ['date','after_or_equal:'.$todayDate],
            'start_time' => ['nullable','date_format:H:i'],
            'stop_time' => ['nullable','date_format:H:i','after:start_time']
        ]);
        
        $reserve = Reserve::find($id);
        $reserve->name = $request->name;
        $reserve->start_time = Carbon::parse($start_str)->format('Y-m-d H:i:s');
        $reserve->stop_time = Carbon::parse($stop_str)->format('Y-m-d H:i:s');
        $reserve->save();
        return redirect()->route('reserve.index')->with('success', 'Reserve has been update successfully.');
    }

    public function destroy(Reserve $reserve){
        $reserve->delete();
        return redirect()->route('reserve.index')->with('success', 'Reserve has been delete successfully.');
    }

}
