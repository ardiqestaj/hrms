<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\BillingAddress;
use App\Models\Client;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use DB;



class LocationController extends Controller
{
    public function locationList()
    {
        $locations = DB::table('locations')->get();
        $clients = DB::table('clients')->get();
        return view('locations.locations' ,compact('clients', 'locations'));
    }

    public function locationProfile($id)
    {
        $locations = DB::table('locations')->where('id',$id)->first();
        return view('locations.locationprofile', compact('locations'));
        //
    }

   public function storeLocation(Request $request)
   {
       $request->validate([
            'location_name'             => 'required|string|max:255',
            'location_address'          => 'required|string|max:255',
            'location_email'            => 'required|string|email|max:255',
            'location_phone_number'     => 'required|string|max:255',
            'address_identifier'        => 'required|string|max:255',
            'firstname'                 => 'required|string|max:255',
            'lastname'                  => 'required|string|max:255',
            'street_address'            => 'required|string|max:255',
            'city'                      => 'required|string|max:255',
            'state'                     => 'required|string|max:255',
            'country'                   => 'required|string|max:255',
            'zip_code'                  => 'required|string|max:255',
            'phone_number'              => 'required|string|max:255',
            'email'                     => 'required|string|email|max:255',
       ]);


        Location::create([
            'rec_client_id'         =>$request->rec_client_id,
            'location_name'         =>$request->location_name,
            'location_address'      =>$request->location_address,
            'location_email'        =>$request->location_email,
            'location_phone_number' =>$request->location_phone_number,
        ]);

        $location = Location::latest('id')->first();

        BillingAddress::create([
            'location_id'           =>$location->id,
            'address_identifier'    =>$request->address_identifier,
            'firstname'             =>$request->firstname,
            'lastname'              =>$request->lastname,
            'street_address'        =>$request->street_address,
            'city'                  =>$request->city,
            'state'                 =>$request->state,
            'country'               =>$request->country,
            'zip_code'              =>$request->zip_code,
            'phone_number'          =>$request->phone_number,
            'email'                 =>$request->email,
        ]);
        Toastr::success('Create new location successfully :)','Success');
        return redirect('all/employee/card');
   }
}
