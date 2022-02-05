<?php

namespace App\Http\Controllers;
use DB;
use Auth;

use App\Models\TimeClock;
use Brian2694\Toastr\Facades\Toastr;

use App\Http\Requests;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
   

    public function getPA(Request $request) 
    {
		$id = \Auth::user()->rec_id;
		$datefrom = $request->datefrom;
		$dateto = $request->dateto;
		
        if($datefrom == '' || $dateto == '' ) 
        {
             $data = DB::table('time_clocks')
             ->select('date', 'timein', 'timeout', 'totalhours', 'status_timein', 'status_timeout')
             ->where('idno', $id)
             ->get();
             
			return response()->json($data);

		} elseif ($datefrom !== '' AND $dateto !== '') {
            $data = DB::table('time_clocks')
            ->select('date', 'timein', 'timeout', 'totalhours', 'status_timein', 'status_timeout')
            ->where('idno', $id)
            ->whereBetween('date', [$datefrom, $dateto])
            ->get();

			return response()->json($data);
        }
	}
}

