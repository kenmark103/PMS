<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Shop\Tools\UploadableTrait;
use Illuminate\Http\UploadedFile;
use App\Models\Apartments;
use App\Models\Rooms;
use App\Models\rumimages;
use Auth;
use App\Models\Admins;
use App\User;
use App\Http\Requests\UpdateRoomRequest;

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
      

    }
    public function showRoom($id)
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
            'roomnumber'=>'required|unique:rooms,apartments_id,room_no',
            'type'=>'required',
            'price'=>'required'
        ]);

        $params = $request->except('_token', '_method');
        $params['apartments_id']=$request->apartment;
        $params['room_no']=$request->roomnumber;

        $room = new Rooms($params);
        $room->save();

        if (isset($params['images']) && is_array($params['images'])) {
                $this->saveRmImages($params, $room);
            }

        return redirect()->route('admin.rooms.showRoom',
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
        $room=Rooms::find($id);
        return view('admin.rooms.edit',[
          'room'=>$room,
          'images' => $room->images()->get(['source']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, $id)
    {
        //
        $room = Rooms::find($id);

        $data = $request->except('_token', '_method');

        $this->updateProduct($data, $room->id);

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.rooms.edit', $id);

    }

     public function updateProduct(array $params, int $id) : bool
    {
        $rm = Rooms::find($id);

        try {
            if (isset($params['image']) && is_array($params['image'])) {
                $this->saveRmImages($params, $rm);
            }
            return $this->update($params, $id);
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }


      private function saveRmImages(array $params, Rooms $rm): void
      {
        collect($params['images'])->each(function (UploadedFile $file) use ($rm) {
            $filename = $file->store('roomImages', ['disk' => 'public']);
            $image = new rumimages(['source' => $filename]);
            $rm->images()->save($image);
        });
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeThumbnail(Request $request)
    {
        $src=$request->input('source');
        $image=DB::table('rumimages')->where('source', $src);
        $image->delete();
        request()->session()->flash('message', 'Image delete successful');
        return redirect()->back();
    }
}
