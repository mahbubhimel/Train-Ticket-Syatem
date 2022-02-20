<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return 10;
    }

    public function getTicketListView()
    {
        return view('ticketsview');
    }

    public function getTicketListData(Request $request)
    {
        $per_page = 1;
        $current_page = 0;

        if($request->per_page && $request->current_page){
            $per_page = $request->per_page;
            $current_page= $request->current_page;

        }

        $skip = $current_page * $per_page;
        $data = Ticket::take($per_page)->skip($skip)->get();
//        $data = Ticket::all();

        foreach ($data as $obj) {
            $obj->total_price = $obj->getTotalPrice();
        }
        return response()->json(
            [
                'status' => 'success',
                'message' => 'data found',
                'data' => $data
            ]

        );
    }
}
