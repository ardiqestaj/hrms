<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  Show Clients
    public function clients()
    {
        if (Auth::user()->role_name == 'Admin') {
            $clients = DB::table('clients')
                ->paginate(11);

            return view('clients.clients', compact('clients'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    /**
     * Show the clients in list form
     *
     * @return \Illuminate\Http\Response
     */
    public function clientsList()
    {
        if (Auth::user()->role_name == 'Admin') {

            $clients = DB::table('clients')
                ->get();
            return view('clients.clients-list', compact('clients'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }
    public function clientsListProfile()
    {
        if (Auth::user()->role_name == 'Admin') {
            $clients = DB::table('clients')
                ->get();
            return view('clients.clients-profile', compact('clients'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    // Save Clients
    public function saveRecordClient(Request $request)
    {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'client_address' => 'required|string|max:255',

        ]);

        DB::beginTransaction();
        try {
            $client = new Client;
            $client->client_name = $request->client_name;
            $client->contact_person = $request->contact_person;
            $client->client_address = $request->client_address;
            $client->client_email = $request->client_email;
            $client->client_mobile_phone = $request->client_mobile_phone;
            $client->client_fax_phone = $request->client_fax_phone;
            $client->save();

            DB::commit();
            Toastr::success('Create new Client successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Client fail :)', 'Error');
            return redirect()->back();
        }
    }

    // Edit Client
    public function editClient(Request $request)
    {
        DB::beginTransaction();

        try {
            $update = [
                'client_name' => $request->client_name,
                'contact_person' => $request->contact_person,
                'client_address' => $request->client_address,
                'client_email' => $request->client_email,
                'client_mobile_phone' => $request->client_mobile_phone,
                'client_fax_phone' => $request->client_fax_phone,
            ];

            Client::where('client_id', $request->id)->update($update);
            DB::commit();

            DB::commit();
            Toastr::success('Updated Client successfully :)', 'Success');
            return redirect()->back();
        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Update Client fail :)', 'Error');
            return redirect()->back();
        }
    }
// Delete Client
    public function deleteClient(Request $request)
    {
        try {

            Client::destroy($request->id);
            Toastr::success('Client deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {

            DB::rollback();
            Toastr::error('Client delete fail :)', 'Error');
            return redirect()->back();
        }
    }
    /**
     * Show the client's profile
     *
     * @return \Illuminate\Http\Response
     */
    public function clientProfile($client_id)
    {
        if (Auth::user()->role_name == 'Admin') {

            $client = DB::table('clients')->where('client_id', $client_id)->first();
            $client_list = DB::table('clients')->get();
            $clients = DB::table('clients')
                ->join('locations', 'clients.rec_client_id', '=', 'locations.rec_client_id')
                ->join('billing_addresses', 'locations.id', '=', 'billing_addresses.location_id')
                ->select('clients.*', 'locations.*', 'billing_addresses.*')
                ->where('clients.rec_client_id', $client->rec_client_id)
                ->paginate(7);
            $typeOfWorks = DB::table('clients')
                ->join('locations', 'clients.rec_client_id', '=', 'locations.rec_client_id')
                ->join('location_type_works', 'location_type_works.location_id', '=', 'locations.id')
                ->join('departments', 'departments.id', '=', 'location_type_works.type_work_id')
                ->where('client_id', $client_id)
                ->get();

            return view('clients.client-profile', compact('client', 'clients', 'client_list', 'typeOfWorks'));
        } else {
            return redirect()->route('em/dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
