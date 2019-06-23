<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $room=Rooms::find($id);
        $firstImage=$room->images->first();
        return view('admin.rooms.show',[
          'room'=>$room,
          'images' => $room->images()->get(['source']),
          'firstImage'=>$firstImage,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
     public function showRoom($id)
    {
        $apartment=Apartments::find($id);
      $rooms=$apartment->rooms->load('tenants','tenants.user');
      return view('admin.rooms.list',[
        'apartment'=>$apartment,
        'rooms'=>$rooms,
    ]);


    }
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
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $room = Rooms::find($id);

        $data = $request->except('_token', '_method');

        $this->updateRoom($data, $room->id);

        $request->session()->flash('message', 'Update successful');
        return redirect()->route('admin.rooms.edit', $id);

    }

    public function updateRoom(array $params, int $id) : bool
    {
        $rm = Rooms::find($id);

        try {
            if (isset($params['images']) && is_array($params['images'])) {
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
     * @param  \App\Models\Rooms  $rooms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rooms $rooms)
    {
        //
    }
    public function removeThumbnail(Request $request)
    {
        $src=$request->input('source');
        $image=DB::table('rumimages')->where('source', $src);
        $image->delete();
        request()->session()->flash('message', 'Image delete successful');
        return redirect()->back();
    }
}
