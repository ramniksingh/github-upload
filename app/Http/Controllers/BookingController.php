<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings= Booking::with('room')->paginate(5);
        return view('bookings.index')
        ->with('bookings', $bookings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')->get()->pluck('name','id')->prepend('none');
        $rooms = DB::table('rooms')->get()->pluck('number', 'id');
        return view('bookings.create')
        ->with('users', $users)
        ->with('booking', (new Booking()))
        ->with('rooms', $rooms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'start'=>'required|date',
            'end'=>'required|date',
            'room_id'=>'required|exists:rooms,id',
            'user_id'=>'required|exists:users,id',
            'is_paid'=>'nullable',
            'notes'=>'present',
            'is_reservation'=>'required'
        ]);

        $booking = Booking::create($validatedData);

        $booking->users()->attach($validatedData['user_id']);
        return redirect()->action('BookingController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('bookings.show', ['booking'=>$booking]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        $users = DB::table('users')->get()->pluck('name','id')->prepend('none');
        $rooms = DB::table('rooms')->get()->pluck('number', 'id');
        $bookingsUser = DB::table('bookings_users')->where('booking_id', $booking->id)->first();
        return view('bookings.edit')
        ->with('users', $users)
        ->with('rooms', $rooms)
        ->with('booking', $booking)
        ->with('bookingsUser', $bookingsUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        $validatedData = $request->validate([
            'start'=>'required|date',
            'end'=>'required|date',
            'room_id'=>'required|exists:rooms,id',
            'user_id'=>'required|exists:users,id',
            'is_paid'=>'nullable',
            'notes'=>'present',
            'is_reservation'=>'required'
        ]);

        $booking->fill($validatedData);
        $booking->save();

        $booking->users()->sync($validatedData['user_id']);
        return redirect()->action('BookingController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        $booking->users()->detach();

       $booking->delete();

        return redirect()->action('BookingController@index');
    }
}
