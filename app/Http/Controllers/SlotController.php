<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlotController extends Controller
{
    public function index(Request $request){
        $slots = Slot::where('user_id',Auth::id())->get();
        return view('slots.index',compact('slots'));
    }
    public function create(){
        return view('slots.create');
    }
    public function store(Request $request){
        $request->validate([
            'start_at'=>'required|date_format:H:i',
            'end_at'=>'required|date_format:H:i|after:start_at',
        ]);
        
        Slot::create([
            'start_at'=>$request->start_at,
            'end_at'=>$request->end_at,
            'user_id'=>Auth::id(),
        ]);
        return redirect()->route('slots.index');
    }
    
    public function edit(Slot $slot){
        return view('slots.edit',compact('slot'));
    }
    
    public function update(Request $request, Slot $slot){
        $request->validate([
            'start_at'=>'required|date_format:H:i',
            'end_at'=>'required|date_format:H:i',
        ]);
        $slot->update([
            'start_at'=>$request->start_at,
            'end_at'=>$request->end_at,
        ]);
        return redirect()->route('slots.index');
    }
    public function destroy(Slot $slot){
            $slot->delete();
        return redirect()->route('slots.index');
    }
    
}
