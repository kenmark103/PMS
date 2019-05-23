<?php

namespace App\Http\Controllers\Admin;

use App\User;
use View;
use App\Models\Booking;
use App\Models\Rooms;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
          'users_id'=>'required|unique:bookings,users_id',
          'rooms_id'=>'unique:bookings,rooms_id'
        ]);

        $room=Rooms::find($request->rooms_id);
        $apartment=$room->apartment;
        $rooms=$apartment->rooms;

        $data=$request->except('_token','_method');
        $data['apartments_id']=$apartment->id;
        $booking=new Booking($data);
        $booking->save();
        return View::make('admin.rooms.list',compact($apartment,$rooms))
        ->with('success','user has been assigned new room');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $room=Rooms::find($id);
        $users=User::all();
        return view('admin.rooms.assign',[
          'users'=>$users,
          'room'=>$room,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
