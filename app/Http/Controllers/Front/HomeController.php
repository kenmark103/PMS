<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Apartments;
use App\Models\Bookings;
use App\Models\Rooms;
use Illuminate\Http\Request;
use App\Models\room_payments;
use App\Models\Payments;
use Auth;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $apartments= Apartments::inRandomOrder()->take(4)->get();
        $freeApartments= Apartments::all();
        $user=auth()->user();
        if ($user->rooms) {
          $room = $user->rooms->first();
        }
        return view('front.homextends.dashboard',[
          'room'=>$room,
          'user'=>$user,
          'apartments'=>$apartments,
          'free'=>$freeApartments
        ]);
    }
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
      $this->validate($request,[
          'users_id'=>'required',
          'amount'=>'required|regex:/^\d+(\.\d{1,2})?$/',
          'uniqueid'=>'required|min:6|max:12|alpha_num|unique:payments',
      ]);

      $data=$request->except('_token','_method');
      $data['uniqueid']=strtoupper($request->uniqueid);
      $newPayment= new Payments($data);
      $newPayment->save();

      return redirect()->route('front.home.show',auth()->id())
      ->with('success','your payment has been added succesfully');


    }

    public function mpesapi(Request $request)
    {
        $this->validate($request,[
          'account'=>'required|min:8',
          'phone'=>'required|min:10',
          'amounta'=>'required|regex:/^\d+(\.\d{1,2})?$/',
          'pin'=>'required|min:4|int',
      ]);

      $data=$request->except('_token','_method');
      $data['users_id']=auth()->id();
      $data['uniqueid']=strtoupper('API'.Str::random(5));
      $data['amount']=$request->amounta;
      $newPayment= new Payments($data);
      $newPayment->save();
      return redirect()->route('front.home.show',auth()->id())
      ->with('success','your payment has been added succesfully');
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
        $userpayments = Payments::all()->where('users_id',$id);
        return view('front.homextends.payments',[
          'mypayments' =>$userpayments,
        ]);
    }

    public function showRoom($id)
    {
        //
        $userooms =room_payments::where('users_id',$id)->get();
        return view('front.homextends.rooms',[
          'myrooms' =>$userooms,
        ]);
    }

    public function notices()
    {
        //
        
        return view('front.homextends.notices',[
        ]);
    }

    public function services()
    {
        //
        $user=auth()->user();
        $room=$user->rooms->first();

        if ($room->apartment) 
        {
            # code...
            $services=$room->apartment->description;
            if (is_null($services)) {
                # code...
                $services='no services available';
            }
        }
        return view('front.homextends.services',[
         'services'=>$services, 
        ]);
    }

    public function get_by_apartment($id)
    {

         $rooms = Rooms::whereDoesntHave('tenants', function(Builder $query){
            $query->where('apartments_id',$id);})->get();
        return response()->json($rooms);
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
        //store user request
        $user_id=Auth::id();
        $room=Rooms::find($id);
        $room_id=$room->id;
        $apartment_id=$room->apartment->id;

        Bookings::Create([
          'users_id'=>$user_id,
          'rooms_id'=>$room_id,
          'apartments_id'=>$apartment_id,
        ])
        ->save();

        return redirect()->route('front.home.index')->with('message', 'your request was submitted succesfully');

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
