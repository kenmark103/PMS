<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Shop\Tools\UploadableTrait;
use Illuminate\Http\UploadedFile;
use App\Models\Apartments;
use App\Models\roomImages;
use App\Models\Admins;
use Auth;

class ApartmentsController extends Controller
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
        //
        $admin=auth()->guard('admin')->user()->isSuperAdmin();
        $aprts=Apartments::all();
        return view('admin.apartments.list',['apartments'=>$aprts,'admin'=>$admin]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $user=Auth::guard('admin')->user();
        if ($user->isSuperAdmin()){
            $employees=Admins::all();
        }
        else
        {   
            return redirect()->back()->with('error',
                'you are not authorized!!');
        }
        return view('admin.apartments.create',[
        'employees'=>$employees,
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
          'name' =>'required|string',
          'description'=>'string',
          'cover'=>'required|file',
          'location'=>'required|string',
          'map'=>'file',
        ]);

        $data = $request->except('_token', '_method');
        $data['admins_id']=$request->caretaker;
        $data['slug'] = str_slug($request->input('name'));
        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $request->file('cover')->store('apartments', ['disk' => 'public']);
        }
        $this->createProduct($data);

        return redirect()->route('admin.apartments.index');

      }
      public function createProduct(array $params) : Apartments
      {
        try {
            $apt = new Apartments($params);
            $apt->save();


            if (isset($params['images']) && is_array($params['images'])) {
                $this->saveImages($params, $apt);
            }

            return $apt;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
      }

      private function saveImages(array $params, Apartments $apt): void
      {
        collect($params['images'])->each(function (UploadedFile $file) use ($apt) {
            $filename = $file->store('images', ['disk' => 'public']);
            $image = new roomImages(['source' => $filename]);
            $apt->roomImages()->save($image);
        });
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
        $images=roomImages::all()->where('apartments_id',$id);
        $apartment=Apartments::find($id);
        //dd($images);

        return view('admin.apartments.show',[
        'apartment'=>$apartment,
        'roomImages'=>$images
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
