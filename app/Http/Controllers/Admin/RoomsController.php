<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\Apartments;
use App\Models\Rooms;
use Auth;
use App\Models\Admins;
use App\User;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){

    	$this->middleware('admin');

    }
    public function index()
    {

      $user=Auth::guard('admin')->user();
      $apartment=$user->apartment;
      if (!isset($apartment) && !$user->isSuperAdmin()) {
        // code...
        return redirect()->back()->with('error','no apartment assigned');
      }

    //  dd($apartment);

      if ($user->isSuperAdmin()){
        $apartments=Apartments::all();
        if (is_null($apartments)) {
          // code...
          return redirect()->back()->with('error','create new apartment');
        }
        return view ('admin.rooms.selectApartment',[
            'apartments'=>$apartments]);
      }
      else{
        $rooms=$apartment->rooms;
      }
        return view('admin.rooms.list',[
          'apartment'=>$apartment,
          'rooms'=>$rooms,
      ]);
    }

    public function show($id)
    {
      $apartment=Apartments::find($id);
      $rooms=$apartment->rooms->load('tenants','tenants.user');
      return view('admin.rooms.list',[
        'apartment'=>$apartment,
        'rooms'=>$rooms,
    ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $admin=auth('admin')->user()->isSuperAdmin();
        if ($admin) {
          $apartments=Apartments::all();
        }
        else
        {
          $apartments=auth('admin')->user()->apartment;
        }
        return view('admin.rooms.create',[
            'apartments'=>$apartments
        ]);
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
            'apartment'=>'required',
            'roomnumber'=>'required|unique:rooms,apartments_id',
            'type'=>'required',
            'price'=>'required'
        ]);

        Rooms::create([
            'apartments_id'=>$request->apartment,
            'room_no'=>$request->roomnumber,
            'type'=>$request->type,
            'price'=>$request->price,
        ])->save();

        return redirect()->route('admin.rooms.show',
        $request->apartment)
        ->with([
            'success'=>'your room has been added succesfully',
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
