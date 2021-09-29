<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //(loads our db facade into this class )

class ShowRoomsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // we need to build a json list of all rooms/data in our db
        // we'll use facades(helps to access common classes without worrying about it's loaded or what needs to be configured. ) to access the data
        $rooms = DB::table('rooms') ->get();
        if ($request->query('id') !== null){
            $rooms = $rooms->where('room_type_id', $request->query('id'));
        }
        // return response () -> json($rooms);
        return view('rooms.index', ['rooms'=>$rooms]);
    }
}
