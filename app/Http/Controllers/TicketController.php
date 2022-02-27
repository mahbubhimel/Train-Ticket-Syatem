<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function getTicketListView(Request $request)
    {
        $id = $request->id;
        return view('ticketsview',[
            'id' => $id
        ]);
    }

    public function getTicketListData(Request $request)
    {
        $data = Ticket::where('train_id',$request->id)->where('purchase_status',0)->get();

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
