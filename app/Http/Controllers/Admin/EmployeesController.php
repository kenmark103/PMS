<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller
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
        $users= Admins::get()->all();
        return view('admin.employees.list', [
            'employees' => $users
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
        return view('admin.employees.create');
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
          'email'=>'string|email|required|unique:admins',
          'phonenumber'=>'string|min:10|required|unique:admins',
          'password'=>'string|required|min:6'
        ]);
        Admins::create([
         'name'=> $request->name,
         'email'=>$request->email,
         'phonenumber'=>$request->phonenumber,
         'password'=>bcrypt($request->password),
         'roles_id'=>$request->role,
        ]
        )->save();

        return redirect()->route('admin.employees.index');

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
        $employee = Admins::find($id);
        return view('admin.employees.show', ['employee' => $employee]);
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
        $employee = Admins::find($id);
        return view('admin.employees.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(UpdateEmployeeRequest $request, $id)
     {
         $this->updateEmployee($request, $id);
         $request->session()->flash('message', 'Update successful');
         return redirect()->route('admin.employees.edit', $id);
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy(int $id)
     {
         $employee=Admins::find($id);
         $employee->delete($id);
         request()->session()->flash('message', 'Delete successful');
         return redirect()->route('admin.employees.index');
     }

     /**
      * @param $id
      * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
      */
     public function getProfile($id)
     {
         $employee =Admins::find($id);
         return view('admin.employees.profile', ['employee' => $employee]);
     }

     /**
      * @param UpdateEmployeeRequest $request
      * @param $id
      * @return \Illuminate\Http\RedirectResponse
      */
     public function updateProfile(UpdateEmployeeRequest $request, $id)
     {
         $this->updateEmployee($request, $id);

         $request->session()->flash('message', 'Update successful');
         return redirect()->route('admin.employee.profile', $id);
     }

     /**
      * @param UpdateEmployeeRequest $request
      * @param $id
      */
     private function updateEmployee(UpdateEmployeeRequest $request, $id)
     {
         $employee = $this->employeeRepo->findEmployeeById($id);

         $update = new EmployeeRepository($employee);
         $update->updateEmployee($request->except('_token', '_method'));
     }
}
