<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\BillingAddress;
use App\Models\Client;
use App\Models\department;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use DB;



class LocationController extends Controller
{
    public function location()
    {
        // $locations = DB::table('locations')->get();
        $clients = DB::table('clients')->get();
        // $billings = DB::table('billing_addresses')->get();
        $locations = DB::table('locations')
                        ->join('billing_addresses', 'locations.id', '=', 'billing_addresses.location_id')
                        ->select('locations.*', 'billing_addresses.*')
                        ->get();
        return view('locations.locations' ,compact('clients', 'locations'));
    }

    // Location Profile
    public function locationProfile($id)
    {
        $departments = DB::table('departments')->get();
        $locations = DB::table('locations')->where('id',$id)->first();
        $billings = DB::table('billing_addresses')->where('location_id', $id)->first();
        $locations_types = DB::table('location_type_works')
                        ->join('departments', 'location_type_works.type_work_id', '=', 'departments.id')
                        ->join('schedules', 'location_type_works.location_type_work_id', '=', 'schedules.idno')
                        ->select('location_type_works.number_of_employees','location_type_works.location_id', 'location_type_works.location_type_work_id as tid', 'departments.department', 'departments.id as did', 'schedules.*')
                        ->where('location_id',$id)->get();

        $assignments = DB::table('assignment_employees')
                        ->join('users', 'users.rec_id', '=', 'assignment_employees.employee_id')
                        ->select('assignment_employees.*', 'users.avatar', 'users.name')
                        ->get();
        // dd($assignments);
        return view('locations.locationprofile', compact('locations', 'departments', 'locations_types', 'billings', 'assignments'));

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
        return redirect('location/locations/profile/'. $location->id);
   }
    public function locationEdit(Request $request)
    {
        DB::beginTransaction();

        try {
            $update = [
            'location_name'         => $request->location_name,
            'location_address'      => $request->location_address,
            'location_email'        => $request->location_email,
            'location_phone_number' => $request->location_phone_number,
            ];

            $updateBilling = [
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
            ];

            Location::where('id',$request->id)->update($update);
            BillingAddress::where('location_id',$request->id)->update($updateBilling);
            DB::commit();

            // DB::commit();
            Toastr::success('Updated Client successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update Client fail :)','Error');
            return redirect()->back();
        }
    }

    public function locationDelete(Request $request)
    {
        try {

            Location::where('id',$request->id)->delete();
            BillingAddress::where('location_id',$request->id)->delete();

            Toastr::success('Client deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Client delete fail :)','Error');
            return redirect()->back();
        }
    }
    public function locationList()

    {
        $locations = DB::table('locations')
                        ->join('clients', 'locations.rec_client_id', '=', 'clients.rec_client_id')
                        ->join('billing_addresses', 'locations.id', '=', 'billing_addresses.location_id')
                        ->select('locations.*', 'clients.*', 'billing_addresses.*')
                        ->get();
        $clients = DB::table('clients')->get();

        return view('locations.locationlist', compact('locations', 'clients'));
        //
    }
}
