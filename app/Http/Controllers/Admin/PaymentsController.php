<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartments;
use App\Models\Payments;
use View;
use App\Models\Tenant;
use App\Models\room_payments;
use App\Models\Rooms;
use App\User;
use carbon\carbon;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
   {
        $this->middleware('admin');
    }

    public function index()
    {

        //Occupied and Unoccupied rooms
        $rooms=Rooms::all()->pluck('price');
        $occupiedRooms=Tenant::all();
        $unoccupiedRooms=Rooms::doesntHave('users')->get();
        $unoccupiedRoomsCount=$rooms->count()-$occupiedRooms->count();
        //dd($unoccupiedRooms);
        //Account Statement
        $payments=Payments::all()->pluck('amount');
        $account=array();
        foreach ($payments as $userspayment => $up) {
           $account[]=$up;
        }

        //Maximum apartments returns
        $maxreturns = array();

        foreach ($rooms as $roomprices => $rp) {

          $maxreturns[]=$rp;
        }

        //Payments for room occupants
        $userPayments=room_payments::all();
        $mnthlyitems = array();
        $unpaidroom = array();
        foreach ($userPayments as $upayment) {
          $expirydate=Carbon::parse($upayment->expirydate);
          $datedeadline=Carbon::parse('first day of this month')->addDays(9);
          $datediff=$expirydate->diffInDays($datedeadline);
          if ($datediff > 0) {

            $mnthlyitems[]=(($upayment->payment->amount)/($upayment->periodofpayment));
          }
          else{

            $unpaidroom[] =$upayment->room->amount;
          }
        }
        //apartments
        $apartments = Apartments::with('rooms')->get();
        foreach ($apartments as $apartment => $ap) {
            # code...
            $revenue=array();
            foreach ($ap->tenants as $ap) {
                # code...
                $revenue[]=$ap->room->price;
            }
            $totalrevenue=array_sum($revenue);
        }

        //summations

        $totalMonthlyincome=array_sum($mnthlyitems);

        $totalUnpaidrooms = array_sum($unpaidroom);

        $expectedIncome=$totalMonthlyincome + $totalUnpaidrooms;

        $totalMaxReturns = array_sum($maxreturns);

        $accountStatement= array_sum($account);



        return View::make('admin.finances.show',[
          'monthlyIncome'=>$totalMonthlyincome,
          'unpaidRooms'=>$totalUnpaidrooms,
          'expectedIncome'=>$expectedIncome,
          'maxReturns'=>$totalMaxReturns,
          'aStatement' =>$accountStatement,
          'Orooms' =>$occupiedRooms,
          'Urooms' =>$unoccupiedRoomsCount,
          'rooms'=>$rooms,
          'apartments'=>$apartments,
          'totalrevenue'=>$totalrevenue,
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
            'users_id'=>'required',
            'amount'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'uniqueid'=>'required|min:6|alpha_num|unique:payments',
        ]);

        $data=$request->except('_token','_method');
        $newPayment= new Payments($data);
        $newPayment->save();

        return redirect()->route('admin.payments.show',auth('admin')->id())->with('message','payment has been added');
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
        $user=User::find($id);
        if (request()->has('q')) {
            $payments = Payments::search(request()->input('q'))->paginate(10);
        }
        else
        {
            $payments=Payments::orderBy('created_at','desc')->paginate(10);
        }
        return view('admin.finances.list',['payments'=>$payments]);
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
