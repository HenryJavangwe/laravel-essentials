<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // verify if route are matching/working. this will access db, dump data and die.
        // \DB::table('bookings')->get()->dd();
        $bookings = DB::table('bookings')->get();
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
        // get the list of users to find the user who booked 
        $users =  DB::table('users')->get() ->pluck('name','id')->prepend('none');
        // get the list of rooms
        $rooms =  DB::table('rooms')->get()->pluck('number','id');

        return view('bookings.create')
            ->with('users', $users)
            ->with('rooms', $rooms); //passing data we want in the view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $id =  DB::table('bookings')->insertGetId([
            'room_id'=> $request ->input('room_id'),
            'start'=> $request ->input('start'),
            'end'=> $request ->input('end'),
            'is_reservation'=> $request ->input('is_reservation', false),
            'is_paid'=> $request ->input('is_paid', false),
            'notes'=> $request ->input('notes'),
        ]);
        DB::table('bookings')->insertGetId([
            'booking_id'=> $id,
            'user_id'=> $request ->input('user_id'),
        ]);
        // return redirect() ->action(BookingController::class)
        return redirect()->action(
            [BookingController::class,'index']
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        // dd($booking);
        // return view('bookings.show', ['booking' => $booking]); ====> This is the first way to add data to our view
        return view('bookings.show')
            ->with('booking', $booking); //  ====> This is the second way to add data to our view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
