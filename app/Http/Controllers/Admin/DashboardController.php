<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
    	$this->middleware('admin');
    }
    public function index()
    {
    	$customers=User::all();

    	return view('admin.dashboard',[
    		'customers'=>$customers
    	]);

    }
}
