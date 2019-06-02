<?php

namespace App\Http\Controllers\Admin;

use App\User;
use View;
use App\Models\Booking;
use App\Models\Tenant;
use App\Models\Apartments;
use App\Models\Rooms;
use App\Models\Payments;
use App\Models\room_payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

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
        if (isset($data)) {
            # code...
            $this->createRoomPayment($data);
        }

        return View::make('admin.rooms.list')
        ->with([
          'success'=>'user has been assigned new room',
          'apartment'=>$apartment,
          'rooms'=>$rooms,
        ]);

    }

    public function createRoomPayment(array $params)
      {
        

        $payment=Payments::where('users_id',$params['users_id'])->first();

        if (is_null($payment)) {
            # code...
            return redirect()->back()->with('error','user has no balance hence cannot be assigned room');
        }

        $room=Rooms::find($params['rooms_id']);
        $amountPaid=$payment->amount;
        $roomPrice=$room->price;

        if ($amountPaid >= $roomPrice) {
            # code...
            $periodofstay=$amountPaid/$roomPrice;
        }
        else{

            return redirect()->back()->with('error','amount paid is not enough for the specifed room');
        }
        $params['periodofpayment']=$periodofstay;
        $params['expirydate']=Carbon::now()->addMonths($periodofstay);
        $params['payments_id']=$payment->id;

        if (isset($params['payments_id'])) {
            # code...
            $payment->update(['status' => 0]);
        }
        try {
         $newroomPayment= new room_payments($params);
         $newroomPayment->save();

          $this->saveTenant($params);
        }
         catch (Exception $e) {
             throw new InvalidArgumentException($e->getMessage());
        }

         
      }

       private function saveTenant(array $params)
       {

        $tnt = new Tenant($params);
        $tnt->save();
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
        $room=Rooms::find($id);
        $newApartment=$room->apartment;
        //dd($newApartment);
        $tenant=Tenant::where('rooms_id',$id,true)->delete();
        return redirect()
        ->route('admin.rooms.show',$newApartment->id)
        ->with('message','room has been succesfully cleared');

    }
}
