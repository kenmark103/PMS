<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

     use AuthenticatesUsers;

   protected $redirectTo = '/admin/dashboard';

     public function __construct(){

         $this->middleware('guest:admin')->except('adminLogout');
     }

     public function showLoginForm()
     {
         //}repetition!
         return view('auth.admin.login');
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
      public function login(Request $request)
      {
          //
          $this->validate($request, [
             'email' => 'required|email',
             'password' => 'required|string|min:5',
         ]);

         $details = $request->only('email', 'password');

         if (auth()->guard('admin')->attempt($details))
          {
             return redirect()
             ->intended(route('admin.dashboard'));
         }
             return redirect()
             ->back()
             ->withInput($request->only('email'));
   }

     public function adminLogout()
     {

         Auth::guard('admin')->logout();

         return redirect('/');
     }

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
