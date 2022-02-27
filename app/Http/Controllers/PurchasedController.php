<?php

namespace App\Http\Controllers;

use App\Purchased_Ticket;
use App\Ticket;
use App\Train;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PurchasedController extends Controller
{

    public function pushTicket(Request $request)
    {

//        return $request->train_id;

//        $purchased_train_id = $request->train_id;


        $Date = date('Y/m/d');
        $user = Auth::user();
//        return $request->id;


        $data = array('user_id' => $user->id, "user_name" => $user->name, "ticket_id" => $request->id, "journey_date" => date('Y/m/d', strtotime($Date. ' + 10 days')));
        DB::table('purchased__tickets')->insert($data);
        DB::table('tickets')
            ->where("tickets.id", '=', $request->id)
            ->update(['tickets.purchase_status' => 1]);

        $trainID = Ticket::select('train_id')->where('id', $request->id)->get();
        $trainID = $trainID[0]->train_id;

//        return $trainID;

        $ticket_count = Train::select('number_of_tickets')->where('id', $trainID)
            ->first();
//        return $ticket_count;
        $ticket_count_update = (int)$ticket_count->number_of_tickets - 1;
//        return $ticket_count_update;

        DB::table('trains')
            ->where("trains.id", '=', $trainID)
            ->update(['trains.number_of_tickets' => $ticket_count_update]);


//        $message = "Data Inserted Successfully!";
//        echo "<script type='text/javascript'>alert('$message');</script>";


//        $this->ticketDetails($request->train_id);

        return [
            'train_ID' => $trainID,
            'time' => $Date
        ];


//        return redirect('/history')->with("message", "Tickets have been bought!")->with( ['data' => $request->train_id] )->with( ['time' => $time] );
//        return redirect('/history')->with("message", "Tickets have been bought!")->with(['data' => $trainID])->with(['time' => $Date]);
//        return Redirect::back()->withErrors(['message', 'The Message']);

    }

    public function ticketDetails(Request $request)
    {

//        return $request->train_id;

        $data = Train::where('id', $request->train_id)->get();


        return response()->json(
            [
                'status' => 'success',
                'message' => 'data found',
                'data' => $data
            ]
        );
    }

    public function purchaseHistory(Request $request) // executing query for extract purchase history corresponding to specific id for purchase history button click
    {
//        $vv = 'SELECT users.id, users.name, tickets.name, tickets.from, tickets.to, tickets.real_price from users
//    JOIN
//    purchased__tickets ON purchased__tickets.user_id = users.id JOIN tickets ON t
//    ickets.id = purchased__tickets.ticket_id where users.id = 1;';
        $data = DB::table('users')
            ->join('purchased__tickets', 'purchased__tickets.user_id', '=', 'users.id')
            ->join('tickets', 'tickets.id', '=', 'purchased__tickets.ticket_id')
            ->where('users.id', $request->id)->get();


//        $data = Train::with('purhased')->get();
//        return $data;

        return response()->json(
            [
                'status' => 'success',
                'message' => 'data found',
                'data' => $data
            ]
        );
    }

    public function purchaseView()
    {
        return view('purchaseHistory');
    }

}
