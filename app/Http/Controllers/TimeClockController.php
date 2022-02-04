<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;

use App\Models\TimeClock;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;

use App\Http\Controllers\Controller;

class TimeClockController extends Controller
{
    public function clock()
    {
        $data = DB::table('clock_time_settings')->where('id', 1)->first();
        $cc = $data->clock_comment;
        $tz = $data->timezone;
        $tf = $data->time_format;
        $rfid = $data->rfid;

        return view('form.attendanceemployee', compact('cc', 'tz', 'tf', 'rfid'));
    }

    public function add(Request $request)
    {
      
            // if ($request->idno == NULL || $request->type == NULL) 
            // {
            //     return response()->json([
            //         "error" => trans("Please enter your ID.")
            //     ]);
            // }
    
            // if(strlen($request->idno) >= 20 || strlen($request->type) >= 20) 
            // {
            //     return response()->json([
            //         "error" => trans("Invalid Employee ID.")
            //     ]);
            // }
    
            // $idno = strtoupper($request->idno);
            // $type = $request->type;
            // $date = date('Y-m-d');
            // $time = date('h:i:s A');
            // $comment = strtoupper($request->clockin_comment);
            // $ip = $request->ip();
    
            // // clock-in comment feature
            // $clock_comment = TimeClockSettings::all()->value('clock_comment');
            // $tf = TimeClockSettings::all()->value('time_format');
            // $time_val = ($tf == 1) ? $time : date("H:i:s", strtotime($time)) ;
    
            // if ($clock_comment == "on") 
            // {
            //     if ($comment == NULL) 
            //     {
            //         return response()->json([
            //             "error" => trans("Please provide your comment!")
            //         ]);
            //     }
            // }
    
            // // ip resriction
            // $iprestriction = TimeClockSettings::all()->value('iprestriction');
            // if ($iprestriction != NULL) 
            // {
            //     $ips = explode(",", $iprestriction);
    
            //     if(in_array($ip, $ips) == false) 
            //     {
            //         $msge = trans("Whoops! You are not allowed to Clock In or Out from your IP address")." ".$ip;
            //         return response()->json([
            //             "error" => $msge,
            //         ]);
            //     }
            // }
            
            // $employee_id = DB::table('employees')->where('employee_id', $idno)->value('employee_id');
            // if($employee_id == null) {
            //     return response()->json([
            //         "error" => trans("You entered an invalid ID.")
            //     ]);
            // }

            // $emp = DB::table('employees')->where('employee_id', $idno)->first();
            // $lastname = $emp->lastname;
            // $firstname = $emp->name;
            // $mi = $emp->username;
            // $employee = mb_strtoupper($lastname.', '.$firstname.' '.$mi);

    
            // // $employee_id = table::companydata()->where('idno', $idno)->value('reference');
            // // if($employee_id == null) {
            // //     return response()->json([
            // //         "error" => trans("You enter an invalid ID.")
            // //     ]);
            // // }
    
            // // $emp = table::people()->where('id', $employee_id)->first();
            // // $lastname = $emp->lastname;
            // // $firstname = $emp->firstname;
            // // $mi = $emp->mi;
            // // $employee = mb_strtoupper($lastname.', '.$firstname.' '.$mi);
    
            // if ($type == 'timein') 
            // {
            //     $has = TimeClock::all()->where([['idno', $idno],['date', $date]])->exists();
    
            //     if ($has == 1) 
            //     {
            //         $hti = TimeClock::all()->where([['idno', $idno],['date', $date]])->value('timein');
            //         $hti = date('h:i A', strtotime($hti));
            //         $hti_24 = ($tf == 1) ? $hti : date("H:i", strtotime($hti)) ;
    
            //         return response()->json([
            //             "employee" => $employee,
            //             "error" => trans("You already Time In today at")." ".$hti_24,
            //         ]);
    
            //     } else {
            //         $last_in_notimeout = TimeClock::all()->where([['idno', $idno],['timeout', NULL]])->count();
    
            //         if($last_in_notimeout >= 1)
            //         {
            //             return response()->json([
            //                 "error" => trans("Please Clock Out from your last Clock In.")
            //             ]);
    
            //         } else {
    
            //             $sched_in_time = Schedule::all()->where([['idno', $idno], ['archive', 0]])->value('intime');
                        
            //             if($sched_in_time == NULL)
            //             {
            //                 $status_in = "Ok";
            //             } else {
            //                 $sched_clock_in_time_24h = date("H.i", strtotime($sched_in_time));
            //                 $time_in_24h = date("H.i", strtotime($time));
    
            //                 if ($time_in_24h <= $sched_clock_in_time_24h) 
            //                 {
            //                     $status_in = 'In Time';
            //                 } else {
            //                     $status_in = 'Late In';
            //                 }
            //             }
    
            //             if($clock_comment == "on" && $comment != NULL) 
            //             {
            //                 TimeClock::all()->insert([
            //                     [
            //                         'idno' => $idno,
            //                         'reference' => $employee_id,
            //                         'date' => $date,
            //                         'employee' => $employee,
            //                         'timein' => $date." ".$time,
            //                         'status_timein' => $status_in,
            //                         'comment' => $comment,
            //                     ],
            //                 ]);
            //             } else {
            //                 TimeClock::all()->insert([
            //                     [
            //                         'idno' => $idno,
            //                         'reference' => $employee_id,
            //                         'date' => $date,
            //                         'employee' => $employee,
            //                         'timein' => $date." ".$time,
            //                         'status_timein' => $status_in,
            //                     ],
            //                 ]);
            //             }
    
            //             return response()->json([
            //                 "type" => $type,
            //                 "time" => $time_val,
            //                 "date" => $date,
            //                 "lastname" => $lastname,
            //                 "firstname" => $firstname,
            //                 "mi" => $mi,
            //             ]);
            //         }
            //     }
            // }
      
            // if ($type == 'timeout') 
            // {
            //     $timeIN = TimeClock::all()->where([['idno', $idno], ['timeout', NULL]])->value('timein');
            //     $clockInDate = TimeClock::all()->where([['idno', $idno],['timeout', NULL]])->value('date');
            //     $hasout = TimeClock::all()->where([['idno', $idno],['date', $date]])->value('timeout');
            //     $timeOUT = date("Y-m-d h:i:s A", strtotime($date." ".$time));
    
            //     if($timeIN == NULL) 
            //     {
            //         return response()->json([
            //             "error" => trans("Please Clock In before Clocking Out.")
            //         ]);
            //     } 
    
            //     if ($hasout != NULL) 
            //     {
            //         $hto = TimeClock::all()->where([['idno', $idno],['date', $date]])->value('timeout');
            //         $hto = date('h:i A', strtotime($hto));
            //         $hto_24 = ($tf == 1) ? $hto : date("H:i", strtotime($hto)) ;
    
            //         return response()->json([
            //             "employee" => $employee,
            //             "error" => trans("You already Time Out today at")." ".$hto_24,
            //         ]);
    
            //     } else {
            //         $sched_out_time = Schedule::all()->where([['idno', $idno], ['archive', 0]])->value('outime');
                    
            //         if($sched_out_time == NULL) 
            //         {
            //             $status_out = "Ok";
            //         } else {
            //             $sched_clock_out_time_24h = date("H.i", strtotime($sched_out_time));
            //             $time_out_24h = date("H.i", strtotime($timeOUT));
                        
            //             if($time_out_24h >= $sched_clock_out_time_24h) 
            //             {
            //                 $status_out = 'On Time';
            //             } else {
            //                 $status_out = 'Early Out';
            //             }
            //         }
    
            //         $time1 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeIN); 
            //         $time2 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeOUT); 
            //         $th = $time1->diffInHours($time2);
            //         $tm = floor(($time1->diffInMinutes($time2) - (60 * $th)));
            //         $totalhour = $th.".".$tm;
    
            //         TimeClock::all()->where([['idno', $idno],['date', $clockInDate]])->update(array(
            //             'timeout' => $timeOUT,
            //             'totalhours' => $totalhour,
            //             'status_timeout' => $status_out)
            //         );
                    
            //         return response()->json([
            //             "type" => $type,
            //             "time" => $time_val, 
            //             "date" => $date,
            //             "lastname" => $lastname,
            //             "firstname" => $firstname,
            //             "mi" => $mi,
            //         ]);
            //     }
            // }
        
        if ($request->idno == NULL || $request->type == NULL) 
        {
            return response()->json([
                "error" => trans("Please enter your ID.")
            ]);
        }

        if(strlen($request->idno) >= 20 || strlen($request->type) >= 20) 
        {
            return response()->json([
                "error" => trans("Invalid Employee ID.")
            ]);
        }

        $idno = strtoupper($request->idno);
        $type = $request->type;
        $date = date('Y-m-d');
        $time = date('h:i:s A');
        $comment = strtoupper($request->clockin_comment);
        $ip = $request->ip();

        // clock-in comment feature
        $clock_comment = DB::table('clock_time_settings')->value('clock_comment');
        $tf = DB::table('clock_time_settings')->value('time_format');
        $time_val = ($tf == 1) ? $time : date("H:i:s", strtotime($time)) ;

        if ($clock_comment == "on") 
        {
            if ($comment == NULL) 
            {
                return response()->json([
                    "error" => trans("Please provide your comment!")
                ]);
            }
        }

        // ip resriction
        $iprestriction = DB::table('clock_time_settings')->value('iprestriction');
        if ($iprestriction != NULL) 
        {
            $ips = explode(",", $iprestriction);

            if(in_array($ip, $ips) == false) 
            {
                $msge = trans("Whoops! You are not allowed to Clock In or Out from your IP address")." ".$ip;
                return response()->json([
                    "error" => $msge,
                ]);
            }
        } 


        $employee_id = DB::table('employees')->where('employee_id', $idno)->value('employee_id');
        if($employee_id == null) {
            return response()->json([
                "error" => trans("You entered an invalid ID.")
            ]);
        }

        $emp = DB::table('employees')->where('employee_id', $idno)->first();
        $lastname = $emp->lastname;
        $firstname = $emp->name;
        $mi = $emp->username;
        $employee = mb_strtoupper($lastname.', '.$firstname.' '.$mi);

        if ($type == 'timein') 
        {
            $has = DB::table('time_clocks')->where([['idno', $idno],['date', $date]])->exists();

            if ($has == 1) 
            {
                $hti = DB::table('time_clocks')->where([['idno', $idno],['date', $date]])->value('timein');
                $hti = date('h:i A', strtotime($hti));
                $hti_24 = ($tf == 1) ? $hti : date("H:i", strtotime($hti)) ;

                return response()->json([
                    "employee" => $employee,
                    "error" => trans("You already Time In today at")." ".$hti_24,
                ]);

            } else {
                $last_in_notimeout = DB::table('time_clocks')->where([['idno', $idno],['timeout', NULL]])->count();

                if($last_in_notimeout >= 1)
                {
                    return response()->json([
                        "error" => trans("Please Clock Out from your last Clock In.")
                    ]);

                } else {

                    $sched_in_time = DB::table('schedules')->where([['idno', $idno], ['archive', 0]])->value('intime');
                    
                    if($sched_in_time == NULL)
                    {
                        $status_in = "Ok";
                    } else {
                        $sched_clock_in_time_24h = date("H.i", strtotime($sched_in_time));
                        $time_in_24h = date("H.i", strtotime($time));

                        if ($time_in_24h <= $sched_clock_in_time_24h) 
                        {
                            $status_in = 'In Time';
                        } else {
                            $status_in = 'Late In';
                        }
                    }

                    if($clock_comment == "on" && $comment != NULL) 
                    {
                        DB::table('time_clocks')->insert([
                            [
                                'idno' => $idno,
                                'reference' => $employee_id,
                                'date' => $date,
                                'employee' => $employee,
                                'timein' => $date." ".$time,
                                'status_timein' => $status_in,
                                'comment' => $comment,
                            ],
                        ]);
                    } else {
                        DB::table('time_clocks')->insert([
                            [
                                'idno' => $idno,
                                'reference' => $employee_id,
                                'date' => $date,
                                'employee' => $employee,
                                'timein' => $date." ".$time,
                                'status_timein' => $status_in,
                            ],
                        ]);
                    }

                    return response()->json([
                        "type" => $type,
                        "time" => $time_val,
                        "date" => $date,
                        "lastname" => $lastname,
                        "firstname" => $firstname,
                        "mi" => $mi,
                    ]);
                }
            }
        }
  
        if ($type == 'timeout') 
        {
            $timeIN = DB::table('time_clocks')->where([['idno', $idno], ['timeout', NULL]])->value('timein');
            $clockInDate = DB::table('time_clocks')->where([['idno', $idno],['timeout', NULL]])->value('date');
            $hasout = DB::table('time_clocks')->where([['idno', $idno],['date', $date]])->value('timeout');
            $timeOUT = date("Y-m-d h:i:s A", strtotime($date." ".$time));

            if($timeIN == NULL) 
            {
                return response()->json([
                    "error" => trans("Please Clock In before Clocking Out.")
                ]);
            } 

            if ($hasout != NULL) 
            {
                $hto = DB::table('time_clocks')->where([['idno', $idno],['date', $date]])->value('timeout');
                $hto = date('h:i A', strtotime($hto));
                $hto_24 = ($tf == 1) ? $hto : date("H:i", strtotime($hto)) ;

                return response()->json([
                    "employee" => $employee,
                    "error" => trans("You already Time Out today at")." ".$hto_24,
                ]);

            } else {
                $sched_out_time = DB::table('schedules')->where([['idno', $idno], ['archive', 0]])->value('outime');
                
                if($sched_out_time == NULL) 
                {
                    $status_out = "Ok";
                } else {
                    $sched_clock_out_time_24h = date("H.i", strtotime($sched_out_time));
                    $time_out_24h = date("H.i", strtotime($timeOUT));
                    
                    if($time_out_24h >= $sched_clock_out_time_24h) 
                    {
                        $status_out = 'On Time';
                    } else {
                        $status_out = 'Early Out';
                    }
                }

                $time1 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeIN); 
                $time2 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeOUT); 
                $th = $time1->diffInHours($time2);
                $tm = floor(($time1->diffInMinutes($time2) - (60 * $th)));
                $totalhour = $th.".".$tm;

                DB::table('time_clocks')->where([['idno', $idno],['date', $clockInDate]])->update(array(
                    'timeout' => $timeOUT,
                    'totalhours' => $totalhour,
                    'status_timeout' => $status_out)
                );
                
                return response()->json([
                    "type" => $type,
                    "time" => $time_val, 
                    "date" => $date,
                    "lastname" => $lastname,
                    "firstname" => $firstname,
                    "mi" => $mi,
                ]);
            }
        }

        // if ($request->idno == NULL || $request->type == NULL) 
        // {
        //     return response()->json([
        //         "error" => trans("Please enter your ID.")
        //     ]);
        // }

        // if(strlen($request->idno) >= 20 || strlen($request->type) >= 20) 
        // {
        //     return response()->json([
        //         "error" => trans("Invalid Employee ID.")
        //     ]);
        // }

        // $idno = strtoupper($request->idno);
        // $type = $request->type;
        // $date = date('Y-m-d');
        // $time = date('h:i:s A');
        // $comment = strtoupper($request->clockin_comment);
        // $ip = $request->ip();

        // // clock-in comment feature
        // $clock_comment = DB::table('clock_time_settings')->value('clock_comment');
        // $tf = DB::table('clock_time_settings')->value('time_format');
        // $time_val = ($tf == 1) ? $time : date("H:i:s", strtotime($time)) ;

        // if ($clock_comment == "on") 
        // {
        //     if ($comment == NULL) 
        //     {
        //         return response()->json([
        //             "error" => trans("Please provide your comment!")
        //         ]);
        //     }
        // }

        // // ip resriction
        // $iprestriction = DB::table('clock_time_settings')->value('iprestriction');
        // if ($iprestriction != NULL) 
        // {
        //     $ips = explode(",", $iprestriction);

        //     if(in_array($ip, $ips) == false) 
        //     {
        //         $msge = trans("Whoops! You are not allowed to Clock In or Out from your IP address")." ".$ip;
        //         return response()->json([
        //             "error" => $msge,
        //         ]);
        //     }
        // } 

        // // $employee_id = table::companydata()->where('idno', $idno)->value('reference');

        // $employee_id = table::companydata()->where('idno', $idno)->value('reference');
        // if($employee_id == null) {
        //     return response()->json([
        //         "error" => trans("You enter an invalid ID.")
        //     ]);
        // }

        // $emp = table::people()->where('id', $employee_id)->first();
        // $lastname = $emp->lastname;
        // $firstname = $emp->firstname;
        // $mi = $emp->mi;
        // $employee = mb_strtoupper($lastname.', '.$firstname.' '.$mi);

        // if ($type == 'timein') 
        // {
        //     $has = table::attendance()->where([['idno', $idno],['date', $date]])->exists();

        //     if ($has == 1) 
        //     {
        //         $hti = table::attendance()->where([['idno', $idno],['date', $date]])->value('timein');
        //         $hti = date('h:i A', strtotime($hti));
        //         $hti_24 = ($tf == 1) ? $hti : date("H:i", strtotime($hti)) ;

        //         return response()->json([
        //             "employee" => $employee,
        //             "error" => trans("You already Time In today at")." ".$hti_24,
        //         ]);

        //     } else {
        //         $last_in_notimeout = table::attendance()->where([['idno', $idno],['timeout', NULL]])->count();

        //         if($last_in_notimeout >= 1)
        //         {
        //             return response()->json([
        //                 "error" => trans("Please Clock Out from your last Clock In.")
        //             ]);

        //         } else {

        //             $sched_in_time = table::schedules()->where([['idno', $idno], ['archive', 0]])->value('intime');
                    
        //             if($sched_in_time == NULL)
        //             {
        //                 $status_in = "Ok";
        //             } else {
        //                 $sched_clock_in_time_24h = date("H.i", strtotime($sched_in_time));
        //                 $time_in_24h = date("H.i", strtotime($time));

        //                 if ($time_in_24h <= $sched_clock_in_time_24h) 
        //                 {
        //                     $status_in = 'In Time';
        //                 } else {
        //                     $status_in = 'Late In';
        //                 }
        //             }

        //             if($clock_comment == "on" && $comment != NULL) 
        //             {
        //                 table::attendance()->insert([
        //                     [
        //                         'idno' => $idno,
        //                         'reference' => $employee_id,
        //                         'date' => $date,
        //                         'employee' => $employee,
        //                         'timein' => $date." ".$time,
        //                         'status_timein' => $status_in,
        //                         'comment' => $comment,
        //                     ],
        //                 ]);
        //             } else {
        //                 table::attendance()->insert([
        //                     [
        //                         'idno' => $idno,
        //                         'reference' => $employee_id,
        //                         'date' => $date,
        //                         'employee' => $employee,
        //                         'timein' => $date." ".$time,
        //                         'status_timein' => $status_in,
        //                     ],
        //                 ]);
        //             }

        //             return response()->json([
        //                 "type" => $type,
        //                 "time" => $time_val,
        //                 "date" => $date,
        //                 "lastname" => $lastname,
        //                 "firstname" => $firstname,
        //                 "mi" => $mi,
        //             ]);
        //         }
        //     }
        // }
  
        // if ($type == 'timeout') 
        // {
        //     $timeIN = table::attendance()->where([['idno', $idno], ['timeout', NULL]])->value('timein');
        //     $clockInDate = table::attendance()->where([['idno', $idno],['timeout', NULL]])->value('date');
        //     $hasout = table::attendance()->where([['idno', $idno],['date', $date]])->value('timeout');
        //     $timeOUT = date("Y-m-d h:i:s A", strtotime($date." ".$time));

        //     if($timeIN == NULL) 
        //     {
        //         return response()->json([
        //             "error" => trans("Please Clock In before Clocking Out.")
        //         ]);
        //     } 

        //     if ($hasout != NULL) 
        //     {
        //         $hto = table::attendance()->where([['idno', $idno],['date', $date]])->value('timeout');
        //         $hto = date('h:i A', strtotime($hto));
        //         $hto_24 = ($tf == 1) ? $hto : date("H:i", strtotime($hto)) ;

        //         return response()->json([
        //             "employee" => $employee,
        //             "error" => trans("You already Time Out today at")." ".$hto_24,
        //         ]);

        //     } else {
        //         $sched_out_time = table::schedules()->where([['idno', $idno], ['archive', 0]])->value('outime');
                
        //         if($sched_out_time == NULL) 
        //         {
        //             $status_out = "Ok";
        //         } else {
        //             $sched_clock_out_time_24h = date("H.i", strtotime($sched_out_time));
        //             $time_out_24h = date("H.i", strtotime($timeOUT));
                    
        //             if($time_out_24h >= $sched_clock_out_time_24h) 
        //             {
        //                 $status_out = 'On Time';
        //             } else {
        //                 $status_out = 'Early Out';
        //             }
        //         }

        //         $time1 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeIN); 
        //         $time2 = Carbon::createFromFormat("Y-m-d h:i:s A", $timeOUT); 
        //         $th = $time1->diffInHours($time2);
        //         $tm = floor(($time1->diffInMinutes($time2) - (60 * $th)));
        //         $totalhour = $th.".".$tm;

        //         table::attendance()->where([['idno', $idno],['date', $clockInDate]])->update(array(
        //             'timeout' => $timeOUT,
        //             'totalhours' => $totalhour,
        //             'status_timeout' => $status_out)
        //         );
                
        //         return response()->json([
        //             "type" => $type,
        //             "time" => $time_val, 
        //             "date" => $date,
        //             "lastname" => $lastname,
        //             "firstname" => $firstname,
        //             "mi" => $mi,
        //         ]);
        //     }
        // }
    }
}
