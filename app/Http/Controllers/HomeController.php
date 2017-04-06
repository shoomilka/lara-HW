<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cleaner;
use App\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function cleanerShow($id){
        $booking = Cleaner::find($id)->hasMany('App\Booking', 'cleaner_id')->paginate(25);
        return view('cleaner.cabinet', compact('booking'));
    }

    public function customerShow($id){
        $booking = Customer::find($id)->hasMany('App\Booking', 'customer_id')->paginate(25);
        return view('customer.cabinet', compact('booking'));
    }
}
