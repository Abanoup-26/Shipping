<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // client 
        $client = Client::where('user_id', auth()->user()->id)->with('clientClientFinancials')->first();

        // get total amount of financial
        $totalAmount = $client->calculateTotalClientFinancial();

        // get the sum of client financel   

        return view('frontend.dashboard', compact('totalAmount', 'client'));
    }
}
