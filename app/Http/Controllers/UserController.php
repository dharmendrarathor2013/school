<?php

namespace App\Http\Controllers;

use App\SmUserLog;
use App\SmStudentLog;
use App\YearCheck;
use App\ApiBaseMethod;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
	{
        $this->middleware('PM');
        // User::checkAuth();
	}

    public function index(){
        try{
            return view('backEnd.systemSettings.user.user');
        }catch (\Exception $e) {
              Toastr::error('Operation Failed', 'Failed');
               return redirect()->back();
        }

    }
    public function create(){
        try{
			return view('backEnd.systemSettings.user.user_create');
		}catch (\Exception $e) {
		      Toastr::error('Operation Failed', 'Failed');
		       return redirect()->back();
		}
    }
    public function userLog(Request $request)
    {

        try {

            $user_logs = SmUserLog::where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->orderBy('id', 'desc')
                ->get();

            foreach ($user_logs as $key => $log_data) {
                if (!empty($log_data)) {
                    
                    $log_data->created_at = $log_data['created_at']->toDayDateTimeString();
                 
                        $user_data = DB::table('users')->select('users.*', 'roles.name as role')
                        ->join('roles', 'roles.id', '=', 'users.role_id')
                        ->where('users.id', $log_data->user_id)
                        ->first();

                    if (!empty($user_data)) {

                        $user_logs[$key]['report'] = json_decode(json_encode($user_data), true);
                    } else {
                        $user_logs[$key]['report'] = "";
                    }
                }
            }

            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($user_logs, null);
            }
            return view('backEnd.reports.report', compact('user_logs'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
	
	   public function studentLog(Request $request)
    {
		 
        try {

          $user_logs =  DB::table('sm_student_logs')
                ->groupBy('user_id')
                ->get();
			
			
			
		
             $user_data = array();
            foreach ($user_logs as $key => $log_data) {
                if (!empty($log_data)) {
                 $user_data[$key] = DB::table('sm_students')->select('sm_students.*', 'roles.name as role')
                        ->join('roles', 'roles.id', '=', 'sm_students.role_id')
                        ->where('sm_students.id', $log_data->user_id)
                        ->first();
	//echo "<pre>"; print_r( $user_data[$key]); die;
					
					// $user_data[$key]['ip_address'] = $log_data->ip_address;
					 $user_data[$key]->ip_address= $log_data->ip_address;
					 $user_data[$key]->logintime= $log_data->created_at;
					 $user_data[$key]->datetime= $log_data->datetime;
					 $user_data[$key]->user_agent= $log_data->user_agent;
					// $user_data[$key]->view= $log_data->view;
					
					 $user_data[$key]->log_type= $log_data->log_type;
					
					
					
//	echo "<pre>"; print_r( $user_data[$key]); die;
					
                }
            }
	//echo "<pre>"; print_r($user_data); die;
            if (ApiBaseMethod::checkUrl($request->fullUrl())) {
                return ApiBaseMethod::sendResponse($user_data, null);
            }
            return view('backEnd.reports.student_report', compact('user_data'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
   
    }
	
}
