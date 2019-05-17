<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartments;
use App\Models\roomImages;

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
        $aprts=Apartments::all();
        return view('admin.apartments.list',['apartments'=>$aprts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.apartments.create');
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
        collect($params['images'])->each(function (UploadedFile $file) use ($product) {
            $filename = $file->store('images', ['disk' => 'public']);
            $image = new roomImages(['source' => $filename]);
            $apt->images()->save($image);
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
