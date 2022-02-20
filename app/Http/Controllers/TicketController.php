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
        $skip = $request->current_page * $request->per_page;
        $data = Ticket::take($request->per_page)->skip($skip)->get();

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
