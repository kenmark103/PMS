<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class CustomersController extends Controller
{

     public function __construct(){

        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users= User::get()->all();
        return view('admin.customers.list', [
            'customers' => $users
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
        return view('admin.customers.create');
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
          'email'=>'string|email|unique:users',
          'phonenumber'=>'string|min:10',
          'password'=>'string|min:6'
        ]);
        User::create([
         'name'=> $request->name,
         'email'=>$request->email,
         'phonenumber'=>$request->phonenumber,
         'password'=>Hash::make($request->password),
        ]
        )->save();

        return redirect()->route('admin.customers.index');
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
        $customer = User::find($id);
        return view('admin.customers.show', [
          'customer' => $customer,
          //'addresses' => $customer->addresses
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
        return view('admin.customers.edit',
        ['customer' => User::find($id)]);
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
        $customer = $this->customerRepo->find($id);

        $update = new CustomerRepository($employee);
        $data = $request->except('_method', '_token', 'password');

        if ($request->has('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        $update->updateCustomer($data);

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.customers.edit', $id);
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
         $customer=User::find($id);
         $customer->delete();
         request()->session()->flash('message', 'Delete successful');
         return redirect()->route('admin.customers.index');
    }

}
