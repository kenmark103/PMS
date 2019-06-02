<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payments;
use View;
use App\Models\room_payments;
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
        //
        $userPayments=room_payments::all();
        $items = array();
        $unpaidroom = array();
        foreach ($userPayments as $upayment) {
          //
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

        $totalMonthlyincome=array_sum($mnthlyitems);

        $totalUnpaidrooms = array_sum($unpaidroom);

        $expectedIncome=$totalMonthlyincome + $totalUnpaidrooms;



        return View::make('admin.finances.show',[
          'monthlyIncome'=>$totalMonthlyincome,
          'unpaidRooms'=>$totalUnpaidrooms,
          'expectedIncome'=>$expectedIncome,
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
            'amount'=>'required',
            'uniqueid'=>'required|min:6|unique:payments',
        ]);

        $data=$request->except('_token','_method');
        $newPayment= new Payments($data);
        $newPayment->save();

        return redirect()->back()->with('message','payment has been added');
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
