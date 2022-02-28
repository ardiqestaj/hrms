<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Auth;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use Session;

class HolidayController extends Controller
{
    // holidays
    public function holiday()
    {

        $user = Auth::User();
        Session::put('user', $user);
        $user = Session::get('user');

        $holiday = Holiday::all();
        return view('form.holidays', compact('holiday'));
    }
    // save record
    public function saveRecord(Request $request)
    {
        $request->validate([
            'nameHoliday' => 'required|string|max:255',
            'holidayDate' => 'required|string|max:255',
        ]);
        $date = date('Y-m-d', strtotime($request->holidayDate));
        DB::beginTransaction();
        try {
            $holiday = new Holiday;
            $holiday->title = $request->nameHoliday;
            $holiday->start = $date;
            $holiday->end = $date;
            $holiday->save();

            DB::commit();
            Toastr::success('Create new holiday successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Add Holiday fail :)', 'Error');
            return redirect()->back();
        }
    }
    // update
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = $request->id;
            $holidayName = $request->holidayName;
            $holidayDate = date('Y-m-d', strtotime($request->holidayDate));
            $holidayDate2 = date('Y-m-d', strtotime($request->holidayDate));

            $update = [

                'id' => $id,
                'title' => $holidayName,
                'start' => $holidayDate,
                'end' => $holidayDate2,
            ];

            Holiday::where('id', $request->id)->update($update);
            DB::commit();
            Toastr::success('Holiday updated successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {
            DB::rollback();
            Toastr::error('Holiday update fail :)', 'Error');
            return redirect()->back();
        }
    }
    public function deleteRecord(Request $request)
    {
        try {

            Holiday::destroy($request->id);
            Toastr::success('Holiday deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception$e) {

            DB::rollback();
            Toastr::error('Holiday delete fail :)', 'Error');
            return redirect()->back();
        }
    }

}
