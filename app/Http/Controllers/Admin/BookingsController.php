<?php

namespace App\Http\Controllers\Admin;

use App\User;
use View;
use App\Models\Booking;
use App\Models\Tenant;
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
        $rules = [
          'users_id'=>'required|unique:tenants,users_id',
          'rooms_id'=>'unique:tenants,rooms_id'
        ];
        $customMessages = [
          'users_id.unique'=>'this user has an assigned room, clear user from rooms table',
          'rooms_id.unique'=>'this room is already assigned, clear room from rooms table'
        ];

         $this->validate($request, $rules, $customMessages);

        $room=Rooms::find($request->rooms_id);
        $apartment=$room->apartment;
        $rooms=$apartment->rooms;

        $data=$request->except('_token','_method');
        $data['apartments_id']=$apartment->id;
        $tenant=new Tenant($data);
        $tenant->save();
        return View::make('admin.rooms.list')
        ->with([
          'success'=>'user has been assigned new room',
          'apartment'=>$apartment,
          'rooms'=>$rooms,
        ]);

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
