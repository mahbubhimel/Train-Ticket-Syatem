<?php

namespace App\Http\Controllers;

use App\Train;
use Illuminate\Http\Request;


class TicketSearchController extends Controller
{

    public function getTrainListView()
    {
        return view('home');
    }

    public function getSearch(Request $request)
    {
        $data = Train::where([
            'from' => $request->from,
            'to' => $request->to
        ])
            ->get();



//        foreach ($data as $obj) {
//            $obj->number_of_tickets = $obj->getNumberofTickets();
//        }
        return response()->json(
        [
            'status' => 'success',
            'message' => 'data found',
            'data' => $data
            ]
        );
    }

    public function test($id){
        return $id;
    }
}
