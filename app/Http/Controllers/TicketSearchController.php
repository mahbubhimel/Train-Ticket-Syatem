<?php

namespace App\Http\Controllers;

use App\Train;
use http\Env\Request;

class TicketSearchController extends Controller
{

    public function getTrainListView(){
        return view('home');
    }

    public function getSearch(Request $request)
    {
        $data = DB::table('trains')->where('to', $request->to)->where('from', $request->from)->get();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'data found',
                'data' => $data
            ]
        );
    }
}
