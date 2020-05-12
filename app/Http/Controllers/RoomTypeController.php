<?php

namespace App\Http\Controllers;

use App\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class RoomTypeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('is_admin', ['except' => ['index']]);
        $this->middleware('auth', ['only' => ['index']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypes = RoomType::get();
        return view('roomTypes.index')
        ->with('roomTypes', $roomTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roomTypes.create')
        ->with('roomType', (new RoomType()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('picture')) {
            $request->validate([
                'picture' => 'required|file|max:3024|mimes:jpeg,png',
            ]);
            $path = $request->file('picture')->store('public/roomTypes'); 
        } else {
            $path = "";
        }
         // dd($request->all());
         
        $roomType = RoomType::create(array_merge($request->all(), ['picture' => $path]));        
        return redirect()->action('RoomTypeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function show(RoomType $roomType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        return view('roomTypes.edit')
        ->with('roomType', $roomType);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomType $roomType)
    {
        $oldpath = $roomType->picture;        
        $roomType->fill($request->input());
        if ($request->hasFile('picture')) {
            $request->validate([
                'picture' => 'required|file|max:1024|mimes:jpg,png',
            ]);
            Storage::delete($oldpath);
            $roomType->picture=$request->file('picture')->store('public/roomTypes');
        }
        
        $roomType->save();
        return redirect()->action('RoomTypeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $roomType)
    {
        $path = $roomType->picture;
        Storage::delete($path);
        $roomType->delete();
        return redirect()->action('RoomTypeController@index');
    }
}
