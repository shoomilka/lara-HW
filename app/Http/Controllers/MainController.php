<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;
use App\Customer;
use App\Booking;

use Validator;
use Redirect;

use App\Cleaner;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cities = City::all()->pluck('name', 'id');
        return view('welcome', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, Customer::getValidationRules());
        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if($requestData['phone_number'] !== ''){
            $customer = Customer::where('phone_number', $requestData['phone_number'])->first();
        } else {
            $customer = Customer::where('last_name', $requestData['last_name'])
                                ->where('first_name', $requestData['first_name'])->first();
        }
        if(empty($customer)) {
            $customer = Customer::create($requestData);
        }

        $requestData['customer_id'] = $customer->id;
        $cleaner = Cleaner::searchCleaner($requestData);

        if(empty($cleaner)){
            return view('store', compact('customer'));
        }

        $requestData['cleaner_id'] = $cleaner->id;
        
        $validator = Validator::make($requestData, Booking::getValidationRules());
        if ($validator->fails()) {
            return redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $booking = Booking::create($requestData);

        return view('store', compact('cleaner', 'customer'));
    }
}
