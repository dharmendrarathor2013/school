<?php

namespace App\Http\Controllers\Admin\StudentInfo;

use App\SmStudentTimeline;
use App\User;
use App\SmClass;
use App\SmSection;
use App\SmRoute;
use App\SmStaff;
use App\SmParent;
use App\SmSchool;
use App\SmStudent;
use App\SmVehicle;
use App\SmExamType;
use App\SmBaseSetup;
use App\SmMarksGrade;
use App\ApiBaseMethod;
use App\SmAcademicYear;
use App\SmEmailSetting;
use App\SmExamSchedule;
use App\SmStudentGroup;
use App\SmDormitoryList;
use App\SmGeneralSettings;
use App\SmStudentCategory;
use App\Traits\CustomFields;
use Illuminate\Http\Request;
use App\Models\SmCustomField;
use App\Models\StudentRecord;
use App\StudentBulkTemporary;
use App\Imports\StudentsImport;
use Modules\Lead\Entities\Lead;
use Modules\Lead\Entities\Source;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Modules\Lead\Entities\LeadCity;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Crypt;
use App\Scopes\StatusAcademicSchoolScope;
use Illuminate\Support\Facades\Validator;
use App\Models\SmStudentRegistrationField;
use Modules\University\Entities\UnAcademicYear;
use Modules\SaasSubscription\Entities\SmPackagePlan;
use Modules\ParentRegistration\Entities\SmStudentField;
use Modules\ParentRegistration\Entities\SmStudentRegistration;
use App\Http\Requests\Admin\StudentInfo\SmStudentAdmissionRequest;
use Modules\University\Repositories\Interfaces\UnCommonRepositoryInterface;
use Modules\University\Repositories\Interfaces\UnDepartmentRepositoryInterface;
use Modules\University\Repositories\Interfaces\UnSemesterLabelRepositoryInterface;
use Modules\University\Repositories\Interfaces\UnSubjectRepositoryInterface;
use Jenssegers\Agent\Agent;
use App\SmUserLog;
use File;
use Carbon\Carbon;
//use Illuminate\Support\Facades\DB;
class SmStudentAdmissionController extends Controller
{
    use CustomFields;
    public $gClient;
    public function __construct()
    {
		//$is_mark_attendance = mart_attendance();
        $this->middleware('PM');
      $this->gClient = new \Google_Client();

        $this->gClient->setApplicationName('Web client 2'); // ADD YOUR AUTH2 APPLICATION NAME (WHEN YOUR GENERATE SECRATE KEY)
        $this->gClient->setClientId('669610207853-7b54lb5cmo0iefk1b158buf359b40afv.apps.googleusercontent.com');
        $this->gClient->setClientSecret('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');
      $this->gClient->setRedirectUri(url('google-backup'));
        $this->gClient->setDeveloperKey('AIzaSyD06RMeycyF3he2nf2i47Kdo0zfHpNzsG8');
        $this->gClient->setScopes(array(
            'https://www.googleapis.com/auth/drive.file',
            'https://www.googleapis.com/auth/drive'
        ));

        $this->gClient->setAccessType("offline");

        $this->gClient->setApprovalPrompt("force");
		
    }

    public function index(Request $request)
    {
       
        try {
			
			
            if (moduleStatusCheck('SaasSubscription') == true && moduleStatusCheck('Saas') == true) {

                $active_student = SmStudent::where('school_id', Auth::user()->school_id)->where('active_status', 1)->count();

                if (\Modules\SaasSubscription\Entities\SmPackagePlan::student_limit() <= $active_student) {

                    Toastr::error('Your student limit has been crossed.', 'Failed');
                    return redirect()->back();
                }
            }

           
			$data = $this->loadData();
            $data['max_admission_id'] = SmStudent::where('school_id', Auth::user()->school_id)->max('admission_no');
            $data['max_roll_id'] = SmStudent::where('school_id', Auth::user()->school_id)->max('roll_no');

            if (moduleStatusCheck('University')) {
                return view('university::admission.add_student_admission', $data);
            }
            return view('backEnd.studentInformation.student_admission', $data);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
	
	 public function googleBackup(Request $request)
        {
		 	  $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);
		
         if ($request->get('code')){
       
            $this->gClient->authenticate($request->get('code'));

            $request->session()->put('token', $this->gClient->getAccessToken());
        }
	
        if ($request->session()->get('token')){
            $this->gClient->setAccessToken($request->session()->get('token'));
        }
		
        if ($this->gClient->getAccessToken()){
            //FOR LOGGED IN USER, GET DETAILS FROM GOOGLE USING ACCES
			$id =  Auth::user()->id;
            $user = User::find($id);
		
            $user->access_token = json_encode($request->session()->get('token'));

            $user->save();

           // dd("Successfully authenticated");
        }
		 $message ="";
		 if ($this->gClient->isAccessTokenExpired()) {
		 $message ="true";
		 }
		   return view('backEnd.systemSettings.googleBackupSettings', compact('message'));
        }
	public function googleDriveAuth(Request $request)
	{
		
		//google authentication start
			
		 $google_oauthV2 = new \Google_Service_Oauth2($this->gClient);
		
         if ($request->get('code')){
       
            $this->gClient->authenticate($request->get('code'));

            $request->session()->put('token', $this->gClient->getAccessToken());
        }
	
        if ($request->session()->get('token')){
            $this->gClient->setAccessToken($request->session()->get('token'));
        }
		
        if ($this->gClient->getAccessToken()){
            //FOR LOGGED IN USER, GET DETAILS FROM GOOGLE USING ACCES
			$id =  Auth::user()->id;
            $user = User::find($id);
		
            $user->access_token = json_encode($request->session()->get('token'));

            $user->save();

           // dd("Successfully authenticated");
			
			

        } else{
					 
            // FOR GUEST USER, GET GOOGLE LOGIN URL
            $authUrl = $this->gClient->createAuthUrl();

            return redirect()->to($authUrl);
            //return view('backEnd.systemSettings.googleBackupSettings');
			
        }
		//google Authentication end
		
	}
	
	
	
	
	
    public function store(SmStudentAdmissionRequest $request)
    {
	
       
		//google drive file upload start
			
	      $destination = 'public/';
	      $google_uploads  = fileUpload($request->file('document_file_1'), $destination);
	      $img = 	substr($google_uploads,7);
		
		$school_id = Auth::user()->school_id;
		$school_name = DB::table('sm_schools')->select('school_name')->where('id', $school_id)->first();
			 $student = new SmStudent();
		if(!empty($request->rfid_no)){
		 $sm_row = SmStudent::where('rfid_no', $request->rfid_no)->first();
        
		
			if (empty($sm_row)) {
                $student->rfid_no = $request->rfid_no;
               
            } else {
                DB::rollback();
                Toastr::error('RFID Number is already exist', 'Failed');
                return redirect()->back();
            }
			}
	
		if(!empty($request->file('document_file_1'))){
			 $id =  Auth::user()->id;
		     $name =  Auth::user()->full_name;
             $user= User::find($id);
			
		  if (empty($user->access_token)) {
 			 return redirect(url('google-backup'));
			  //echo 'hello'; die;
	    	}
			else{
				
		$service = new \Google_Service_Drive($this->gClient);
			
        
	
        $this->gClient->setAccessToken(json_decode($user->access_token,true));
			//echo "<pre>"; print_r( $this->gClient);die;
	
        if ($this->gClient->isAccessTokenExpired()) {

            // SAVE REFRESH TOKEN TO SOME VARIABLE
            $refreshTokenSaved = $this->gClient->getRefreshToken();
			 
            // UPDATE ACCESS TOKEN
            $this->gClient->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

            // PASS ACCESS TOKEN TO SOME VARIABLE
            $updatedAccessToken = $this->gClient->getAccessToken();
              
            // APPEND REFRESH TOKEN
            $updatedAccessToken['refresh_token'] = $refreshTokenSaved;
  
            // SET THE NEW ACCES TOKEN
            $this->gClient->setAccessToken($updatedAccessToken);
			

         	$user->access_token=json_encode($updatedAccessToken);
           
            $user->save();
        }
			
			
        $fileMetadata = new \Google_Service_Drive_DriveFile(array(
           'name' => $school_name->school_name.'/'.$name.'('.$id.')',           // ADD YOUR GOOGLE DRIVE FOLDER NAME
           'mimeType' => 'application/vnd.google-apps.folder'));
			 
			 $folderName = $school_name->school_name.'/'.$name.$id; 
		//echo"Hello";	 echo "<pre>"; print_r($folderName);die;
				
		 	$folderDesc = 'School Data'; 
			$service = new \Google_Service_Drive($this->gClient);
			
			$files = $service->files->listFiles();
		    $found = false;
	 				 
			
				// Go through each one to see if there is already a folder with the specified name
			foreach ($files['files'] as $item) {
				if ($item['name'] == $folderName) {
					$found = true;
					$folder =  $item['id'];
					break;
				}
			}
			
			// If not, create one
	if ($found == false) {
		$folder = new \Google_Service_Drive_DriveFile();

		//Setup the folder to create
		$folder->setName($folderName);

		if(!empty($folderDesc))
			$folder->setDescription($folderDesc);

		$folder->setMimeType('application/vnd.google-apps.folder');

		//Create the Folder
		try {
			$createdFile = $service->files->create($folder, array(
				'mimeType' => 'application/vnd.google-apps.folder',
				));

			// Return the created folder's id
			return $createdFile->id;
		} catch (Exception $e) {
			print "An error occurred: " . $e->getMessage();
		}
	}	
		//echo"hiii";	 echo "<pre>"; print_r($folderName);die;
		if(isset($folderName)) {
		if(!empty($folderName)) {
 			  $file = new \Google_Service_Drive_DriveFile(array('name' => rand(11111,99999).'.jpg','parents' => array($folder)));
  
 		}
	}		
         // $folder = $service->files->create($fileMetadata, array('fields' => 'id'));
 
				//echo "Hello";die;	
			if(isset($img)){
			
             $result = $service->files->create($file, array(
			 'data' => file_get_contents(public_path($img)),
             'mimeType' => 'application/octet-stream',
             'uploadType' => 'media'
              ));
               // GET URL OF UPLOADED FILE
                $url='https://drive.google.com/open?id='.$result->id;
				if(isset($url)){
				$student->document_file_1 = $url;
				}
 			  }
		    //google drive upload end here
				   
			}
         }
		//echo '<pre>'; print_r($url); die;
        $validator = Validator::make($request->all(), $this->generateValidateRules("student_registration"));
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                Toastr::error(str_replace('custom f.', '', $error), 'Failed');
            }
            return redirect()->back()->withInput();
        }
		

        $parentInfo = ($request->fathers_name || $request->fathers_phone || $request->mothers_name || $request->mothers_phone || $request->guardians_email || $request->guardians_phone)  ? true : false;
        // add student record
        if ($request->filled('phone_number') || $request->filled('email_address')) {
			
            $user = User::where('school_id', auth()->user()->school_id)
                ->when($request->filled('phone_number') && !$request->email_address, function ($q) use ($request) {
                    $q->where(function ($q) use ($request) {
                        return $q->where('phone_number', $request->phone_number)->orWhere('username', $request->phone_number);
                    });
                })
                ->when($request->filled('email_address') && !$request->phone_number, function ($q) use ($request) {
                    $q->where(function ($q) use ($request) {
                        return $q->where('email', $request->email_address)->orWhere('username', $request->email_address);
                    });
                })
                ->when($request->filled('email_address') && $request->filled('phone_number'), function ($q) use ($request) {
                    $q->where('phone_number', $request->phone_number);
                })

                ->first();
            if ($user) {
                if ($user->role_id == 2) {
                    $studentRecord = StudentRecord::where('class_id', $request->class)
                        ->where('section_id', $request->section)
                        ->where('academic_id', $request->session)
                        ->where('student_id', $user->student->id)
                        ->where('school_id', auth()->user()->school_id)
                        ->first();
                    if (!$studentRecord) {
                        if ($request->edit_info == "yes") {
                            $this->updateStudentInfo($request->merge([
                                'id' => $user->student->id,
                            ]));
                        }

                        $this->insertStudentRecord($request->merge([
                            'student_id' => $user->student->id,

                        ]));
                        if (moduleStatusCheck('Lead') == true && $request->lead_id) {
                            Lead::where('id', $request->lead_id)->update(['is_converted' => 1]);
							 // start user log

                            $agent = new Agent();
                            $user_log = new SmUserLog();
                            $user_log->user_id = Auth::user()->id;
                            $user_log->role_id = Auth::user()->role_id;
                            $user_log->log_type = "student created";
                            $user_log->school_id = Auth::user()->school_id;
                            $user_log->ip_address = $request->ip();
                            $user_log->academic_id = getAcademicid() ?? 1;

                            $user_log->user_agent = $agent->browser() . ', ' . $agent->platform();
                            $user_log->save();

                            // end user log
                            Toastr::success('Operation successful', 'Success');
                            return redirect()->route('lead.index');
                        } else if ($request->has('parent_registration_student_id') && moduleStatusCheck('ParentRegistration') == true) {
                            $registrationStudent = \Modules\ParentRegistration\Entities\SmStudentRegistration::find($request->parent_registration_student_id);
                            if ($registrationStudent) {
                                $registrationStudent->delete();
                            }
							 // start user log

                            $agent = new Agent();
                            $user_log = new SmUserLog();
                            $user_log->user_id = Auth::user()->id;
                            $user_log->role_id = Auth::user()->role_id;
                            $user_log->log_type = "student created";
                            $user_log->school_id = Auth::user()->school_id;
                            $user_log->ip_address = $request->ip();
                            $user_log->academic_id = getAcademicid() ?? 1;

                            $user_log->user_agent = $agent->browser() . ', ' . $agent->platform();
                            $user_log->save();

                            // end user log
                            Toastr::success('Operation successful', 'Success');
                            return redirect()->route('parentregistration.student-list');
                        } else {
							 // start user log

                            $agent = new Agent();
                            $user_log = new SmUserLog();
                            $user_log->user_id = Auth::user()->id;
                            $user_log->role_id = Auth::user()->role_id;
                            $user_log->log_type = "student created";
                            $user_log->school_id = Auth::user()->school_id;
                            $user_log->ip_address = $request->ip();
                            $user_log->academic_id = getAcademicid() ?? 1;

                            $user_log->user_agent = $agent->browser() . ', ' . $agent->platform();
                            $user_log->save();

                            // end user log
                            Toastr::success('Operation successful', 'Success');
                            return redirect()->back();
                        }
                    } else {
                        Toastr::warning('Already Enroll', 'Warning');
                        return redirect()->back();
                    }
                }
            }
        }
        // end student record

        $destination = 'public/uploads/student/document/';
        $student_file_destination = 'public/uploads/student/';

        if ($request->relation == 'Father') {
            $guardians_photo = fileUpload($request->file('fathers_photo'), $student_file_destination);
        } elseif ($request->relation == 'Mother') {
            $guardians_photo = fileUpload($request->file('mothers_photo'), $student_file_destination);
        } else {
            $guardians_photo = fileUpload($request->file('guardians_photo'), $student_file_destination);
        }


        DB::beginTransaction();

        try {
          
            if (moduleStatusCheck('University')) {
                $academic_year = UnAcademicYear::find($request->un_academic_id);
            } else {
                $academic_year = SmAcademicYear::find($request->session);
            }


            $user_stu = new User();
            $user_stu->role_id = 2;
            $user_stu->full_name = $request->first_name . ' ' . $request->last_name;
            $user_stu->username = $request->phone_number ?: ($request->email_address ?: $request->admission_number);
            $user_stu->email = $request->email_address;
            $user_stu->phone_number = $request->phone_number;
            $user_stu->password = Hash::make(123456);
            $user_stu->school_id = Auth::user()->school_id;
            $user_stu->created_at = $academic_year->year . '-01-01 12:00:00';
            $user_stu->save();
            $user_stu->toArray();

            if ($request->parent_id == "") {
				
                $userIdParent = null;
                $hasParent = null;
                if ($request->filled('guardians_phone') || $request->filled('guardians_email')) {
                    $user_parent = new User();
                    $user_parent->role_id = 3;
                    $user_parent->username = $request->guardians_phone ? $request->guardians_phone : $request->guardians_email;
                    $user_parent->full_name = $request->fathers_name;
                    if (!empty($request->guardians_email)) {
                        $user_parent->username = $request->guardians_phone ? $request->guardians_phone : $request->guardians_email;
                    }
                    $user_parent->email = $request->guardians_email;
                    $user_parent->phone_number = $request->guardians_phone;
                    $user_parent->password = Hash::make(123456);
                    $user_parent->school_id = Auth::user()->school_id;
                    $user_parent->created_at = $academic_year->year . '-01-01 12:00:00';
                    $user_parent->save();
                    $user_parent->toArray();
                    $userIdParent = $user_parent->id;
                }
                if ($parentInfo) {
                    $parent = new SmParent();
                    $parent->user_id = $userIdParent;
                    $parent->fathers_name = $request->fathers_name;
                    $parent->fathers_mobile = $request->fathers_phone;
                    $parent->fathers_occupation = $request->fathers_occupation;
                    $parent->fathers_photo = fileUpload($request->file('fathers_photo'), $student_file_destination);
                    $parent->mothers_name = $request->mothers_name;
                    $parent->mothers_mobile = $request->mothers_phone;
                    $parent->mothers_occupation = $request->mothers_occupation;
                    $parent->mothers_photo = fileUpload($request->file('mothers_photo'), $student_file_destination);
                    $parent->guardians_name = $request->guardians_name;
                    $parent->guardians_mobile = $request->guardians_phone;
                    $parent->guardians_email = $request->guardians_email;
                    $parent->guardians_occupation = $request->guardians_occupation;
                    $parent->guardians_relation = $request->relation;
                    $parent->relation = $request->relationButton;
                    $parent->guardians_photo = $guardians_photo;
                    $parent->guardians_address = $request->guardians_address;
                    $parent->is_guardian = $request->is_guardian;
                    $parent->school_id = Auth::user()->school_id;
                    $parent->academic_id = $request->session;
                    $parent->created_at = $academic_year->year . '-01-01 12:00:00';
                    $parent->save();
                    $parent->toArray();
                    $hasParent = $parent->id;
                }
            } else {
                $parent = SmParent::find($request->parent_id);
                $hasParent = $parent->id;
            }
			
			
				//echo "<pre>"; print_r( $user_stu->id);die;
           
            $student->user_id = $user_stu->id;
			
            $student->parent_id = $request->parent_id == "" ? $hasParent : $request->parent_id;
            $student->role_id = 2;
            $student->admission_no = $request->admission_number;
            if ($request->roll_number) {
                $student->roll_no = $request->roll_number;
            }

            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->full_name = $request->first_name . ' ' . $request->last_name;
            $student->gender_id = $request->gender;
            $student->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $student->caste = $request->caste;
            $student->email = $request->email_address;
            $student->mobile = $request->phone_number;
            $student->admission_date = date('Y-m-d', strtotime($request->admission_date));
            $student->student_photo = fileUpload($request->photo, $student_file_destination);
            $student->bloodgroup_id = $request->blood_group;
            $student->religion_id = $request->religion;
            $student->height = $request->height;
            $student->weight = $request->weight;
         	
			$student->class_id = $request->class;
			$student->section_id = $request->section;
			$student->current_address = $request->current_address;
            $student->permanent_address = $request->permanent_address;
            $student->route_list_id = $request->route;
            $student->dormitory_id = $request->dormitory_name;
            $student->room_id = $request->room_number;
	     
            if (!empty($request->vehicle)) {
                $driver = SmVehicle::where('id', '=', $request->vehicle)
                    ->select('driver_id')
                    ->first();
                if (!empty($driver)) {
                    $student->vechile_id = $request->vehicle;
                    $student->driver_id = $driver->driver_id;
                }
            }
           
            $student->national_id_no = $request->national_id_number;
			
            $student->local_id_no = $request->local_id_number;
			
            $student->bank_account_no = $request->bank_account_number;
			
            $student->bank_name = $request->bank_name;
			
            $student->previous_school_details = $request->previous_school_details;
			
            $student->aditional_notes = $request->additional_notes;
			
            $student->ifsc_code = $request->ifsc_code;
            $student->document_title_1 = $request->document_title_1;
          
            
			
            
			
           // $student->document_file_1 = fileUpload($request->file('document_file_1'), $destination);
			
			// start upload in drive image
			
			//end upload in drive image
            $student->document_title_2 = $request->document_title_2;
            $student->document_file_2 = fileUpload($request->file('document_file_2'), $destination);
            $student->document_title_3 = $request->document_title_3;
            $student->document_file_3 = fileUpload($request->file('document_file_3'), $destination);
            $student->document_title_4 = $request->document_title_4;
            $student->document_file_4 = fileUpload($request->file('document_file_4'), $destination);
            $student->school_id = Auth::user()->school_id;
            $student->academic_id = $request->session;
            $student->student_category_id = $request->student_category_id;
            $student->student_group_id = $request->student_group_id;
            $student->created_at = $academic_year->year . '-01-01 12:00:00';
			
            if ($request->customF) {
                $dataImage = $request->customF;
                foreach ($dataImage as $label => $field) {
                    if (is_object($field) && $field != "") {
                        $dataImage[$label] = fileUpload($field, 'public/uploads/customFields/');
                    }
                }

                //Custom Field Start
                $student->custom_field_form_name = "student_registration";
                $student->custom_field = json_encode($dataImage, true);
                //Custom Field End
            }
            //add by abu nayem for lead convert to student
            if (moduleStatusCheck('Lead') == true) {
                $student->lead_id = $request->lead_id;
                $student->lead_city_id = $request->lead_city;
                $student->source_id = $request->source_id;
            }
            $student->save();
            //end lead convert to student
          
			// $call_rfid_function =  match_rfid_api($request->rfid_no);

			
			
            
			
		
            $student->toArray();
			
			  
          
			
            if (moduleStatusCheck('Lead') == true) {
                Lead::where('id', $request->lead_id)->update(['is_converted' => 1]);
            }
            // insert Into student record
            $this->insertStudentRecord($request->merge([
                'student_id' => $student->id,
                'is_default' => 1,
            ]));
            //end insert

            if ($student) {
                $compact['student_name'] = $request->first_name . ' ' . $request->last_name;
                $compact['user_email'] = $request->email_address;
                $compact['slug'] = 'student';
                $compact['id'] = $student->id;
                @send_mail($request->email_address, $request->first_name . ' ' . $request->last_name, "student_login_credentials", $compact);
                @send_sms($request->phone_number, 'student_admission', $compact);
            }
            if ($parentInfo) {
                if ($parent) {
                    $compact['user_email'] = $parent->guardians_email;
                    $compact['student_name'] = $request->first_name . ' ' . $request->last_name;
                    $compact['parent_name'] = $request->fathers_name;
                    $compact['father_name'] = $request->fathers_name;
                    $compact['slug'] = 'parent';
                    $compact['id'] = $parent->id;
                    @send_mail($parent->guardians_email, $request->fathers_name, "parent_login_credentials", $compact);
                    @send_sms($request->guardians_phone, 'student_admission_for_parent', $compact);
                }
            }
            //add by abu nayem for lead convert to student
            if (moduleStatusCheck('Lead') == true && $request->lead_id) {
                $lead = \Modules\Lead\Entities\Lead::find($request->lead_id);
                $lead->class_id = $request->class;
                $lead->section_id = $request->section;
                $lead->save();
            }
            //end lead convert to student
            DB::commit();
  
			
            if ($request->has('parent_registration_student_id') && moduleStatusCheck('ParentRegistration') == true) {

                $registrationStudent = \Modules\ParentRegistration\Entities\SmStudentRegistration::find($request->parent_registration_student_id);
                if ($registrationStudent) {
                    $registrationStudent->delete();
                }
				 // start user log

                            $agent = new Agent();
                            $user_log = new SmUserLog();
                            $user_log->user_id = Auth::user()->id;
                            $user_log->role_id = Auth::user()->role_id;
                            $user_log->log_type = "student created";
                            $user_log->school_id = Auth::user()->school_id;
                            $user_log->ip_address = $request->ip();
                            $user_log->academic_id = getAcademicid() ?? 1;

                            $user_log->user_agent = $agent->browser() . ', ' . $agent->platform();
                            $user_log->save();

                            // end user log
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('parentregistration.student-list');
            }
            if (moduleStatusCheck('Lead') == true && $request->lead_id) {
				 // start user log

                            $agent = new Agent();
                            $user_log = new SmUserLog();
                            $user_log->user_id = Auth::user()->id;
                            $user_log->role_id = Auth::user()->role_id;
                            $user_log->log_type = "student created";
                            $user_log->school_id = Auth::user()->school_id;
                            $user_log->ip_address = $request->ip();
                            $user_log->academic_id = getAcademicid() ?? 1;

                            $user_log->user_agent = $agent->browser() . ', ' . $agent->platform();
                            $user_log->save();

                            // end user log
                Toastr::success('Operation successful', 'Success');
                return redirect()->route('lead.index');
            } else {
				 // start user log

                            $agent = new Agent();
                            $user_log = new SmUserLog();
                            $user_log->user_id = Auth::user()->id;
                            $user_log->role_id = Auth::user()->role_id;
                            $user_log->log_type = "student created";
                            $user_log->school_id = Auth::user()->school_id;
                            $user_log->ip_address = $request->ip();
                            $user_log->academic_id = getAcademicid() ?? 1;

                            $user_log->user_agent = $agent->browser() . ', ' . $agent->platform();
                            $user_log->save();

                            // end user log
				//echo"<pre>"; print_r($student); die;
                Toastr::success('Operation successful', 'Success');
				return redirect('/student-admission');
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $data = $this->loadData();
            $data['student'] = SmStudent::with('sections')->select('sm_students.*')->find($id);
            $data['siblings'] = SmStudent::where('parent_id', $data['student']->parent_id)->whereNotNull('parent_id')->get();
            $data['custom_filed_values'] = json_decode($data['student']->custom_field);
            if (moduleStatusCheck('University')) {
                return view('university::admission.edit_student_admission', $data);
            }
            return view('backEnd.studentInformation.student_edit', $data);
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function updateStudentInfo($request)
    {


        $parentInfo = ($request->fathers_name || $request->fathers_phone || $request->mothers_name || $request->mothers_phone || $request->guardians_email || $request->guardians_phone)  ? true : false;
        $student_detail = SmStudent::find($request->id);
        $parentUserId = $student_detail->parents ? $student_detail->parents->user_id : null;
        // custom field validation start
        $validator = Validator::make($request->all(), $this->generateValidateRules("student_registration", $student_detail));
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                Toastr::error(str_replace('custom f.', '', $error), 'Failed');
            }
            return redirect()->back()->withInput();
        }
        // custom field validation End


        $destination = 'public/uploads/student/document/';
        $student_file_destination = 'public/uploads/student/';
        $student = SmStudent::find($request->id);
        if ($request->relation == 'Father') {
            $guardians_photo = fileUpdate(@$student->parents->guardians_photo, $request->fathers_photo, $student_file_destination);
        } elseif ($request->relation == 'Mother') {
            $guardians_photo = fileUpdate(@$student->parents->guardians_photo, $request->mothers_photo, $student_file_destination);
        } else {
            $guardians_photo = fileUpdate(@$student->parents->guardians_photo, $request->guardians_photo, $student_file_destination);
        }

        DB::beginTransaction();
        try {
            $user_parent = null;
            $parent = null;
            $username = $request->phone_number ? $request->phone_number : $request->admission_number;
            $phone_number = $request->phone_number;
            $user_stu = $this->add_user($student_detail->user_id, 2, $username, $request->email_address, $phone_number, $request->first_name . ' ' . $request->last_name);

            if (($request->sibling_id == 0 || $request->sibling_id == 1) && $request->parent_id == "") {
                $username = $request->guardians_phone ? $request->guardians_phone : $request->guardians_email;
                $phone_number = $request->guardians_phone;

                if ($request->guardians_phone || $request->guardians_email) {
                    $user_parent = $this->add_user($parentUserId, 3, $username, $request->guardians_email, $phone_number, $request->guardians_name);
                }
            } elseif ($request->sibling_id == 0 && $request->parent_id != "") {
                User::destroy($student_detail->parents->user_id);
            } elseif (($request->sibling_id == 2 || $request->sibling_id == 1) && $request->parent_id != "") {
            } elseif ($request->sibling_id == 2 && $request->parent_id == "") {
                $username = $request->guardians_phone ? $request->guardians_phone : $request->guardians_email;
                $phone_number = $request->guardians_phone;
                if ($request->guardians_phone || $request->guardians_email) {
                    $user_parent = $this->add_user(null, 3, $username, $request->guardians_email, $phone_number, $request->guardians_name);
                }
            }

            if ($request->sibling_id == 0 && $request->parent_id != "") {
                SmParent::destroy($student_detail->parent_id);
            } elseif (($request->sibling_id == 2 || $request->sibling_id == 1) && $request->parent_id != "") {
            } else {
                if ($parentInfo) {

                    if (($request->sibling_id == 0 || $request->sibling_id == 1) && $request->parent_id == "") {
                        // when find parent
                        if ($parentUserId) {
                            $parent = SmParent::find($student_detail->parent_id);
                        } else {
                            $parent = new SmParent();
                        }
                    } elseif ($request->sibling_id == 2 && $request->parent_id == "") {
                        $parent = new SmParent();
                    }
                    $parent->user_id = $user_parent ? $user_parent->id : null;
                    $parent->fathers_name = $request->fathers_name;
                    $parent->fathers_mobile = $request->fathers_phone;
                    $parent->fathers_occupation = $request->fathers_occupation;
                    $parent->fathers_photo = fileUpdate($parent->fathers_photo, $request->fathers_photo, $student_file_destination);
                    $parent->mothers_name = $request->mothers_name;
                    $parent->mothers_mobile = $request->mothers_phone;
                    $parent->mothers_occupation = $request->mothers_occupation;
                    $parent->mothers_photo = fileUpdate($parent->mothers_photo, $request->mothers_photo, $student_file_destination);
                    $parent->guardians_name = $request->guardians_name;
                    $parent->guardians_mobile = $request->guardians_phone;
                    $parent->guardians_email = $request->guardians_email;
                    $parent->guardians_occupation = $request->guardians_occupation;
                    $parent->guardians_relation = $request->relation;
                    $parent->relation = $request->relationButton;
                    $parent->guardians_photo = $guardians_photo;
                    $parent->guardians_address = $request->guardians_address;
                    $parent->is_guardian = $request->is_guardian;
                    $parent->school_id = auth()->user()->school_id;
                    $parent->academic_id = getAcademicId();
                    $parent->save();
                }
            }
            $student = SmStudent::find($request->id);
            if (($request->sibling_id == 0 || $request->sibling_id == 1) && $request->parent_id == "") {
                $student->parent_id = @$parent->id;
            } elseif ($request->sibling_id == 0 && $request->parent_id != "") {
                $student->parent_id = $request->parent_id;
            } elseif (($request->sibling_id == 2 || $request->sibling_id == 1) && $request->parent_id != "") {
                $student->parent_id = $request->parent_id;
            } elseif ($request->sibling_id == 2 && $request->parent_id == "") {
                $student->parent_id = $parent->id;
            }
            $student->user_id = $user_stu->id;
            $student->admission_no = $request->admission_number;
            if ($request->roll_number) {
                $student->roll_no = $request->roll_number;
            }
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->full_name = $request->first_name . ' ' . $request->last_name;
            $student->gender_id = $request->gender;
            $student->date_of_birth = date('Y-m-d', strtotime($request->date_of_birth));
            $student->age = $request->age;
            $student->caste = $request->caste;
            $student->email = $request->email_address;
            $student->mobile = $request->phone_number;
            $student->admission_date = date('Y-m-d', strtotime($request->admission_date));
            $student->student_photo = fileUpdate($student->student_photo, $request->photo, $student_file_destination);
            $student->bloodgroup_id = $request->blood_group;
            $student->religion_id = $request->religion;
            $student->height = $request->height;
            $student->weight = $request->weight;
            $student->current_address = $request->current_address;
			$student->rfid_no = $request->rfid_no;
            $student->permanent_address = $request->permanent_address;
            $student->student_category_id = $request->student_category_id;
            $student->student_group_id = $request->student_group_id;
            $student->route_list_id = $request->route;
            $student->dormitory_id = $request->dormitory_name;
            $student->room_id = $request->room_number;
            if (!empty($request->vehicle)) {
                $driver = SmVehicle::where('id', '=', $request->vehicle)
                    ->select('driver_id')
                    ->first();
                $student->vechile_id = $request->vehicle;
                $student->driver_id = $driver->driver_id;
            }
            $student->national_id_no = $request->national_id_number;
            $student->local_id_no = $request->local_id_number;
            $student->bank_account_no = $request->bank_account_number;
            $student->bank_name = $request->bank_name;
            $student->previous_school_details = $request->previous_school_details;
            $student->aditional_notes = $request->additional_notes;
            $student->ifsc_code = $request->ifsc_code;
            $student->document_title_1 = $request->document_title_1;
            $student->document_file_1 = fileUpdate($student->document_file_1, $request->file('document_file_1'), $destination);
            $student->document_title_2 = $request->document_title_2;
            $student->document_file_2 = fileUpdate($student->document_file_2, $request->file('document_file_2'), $destination);
            $student->document_title_3 = $request->document_title_3;
            $student->document_file_3 = fileUpdate($student->document_file_3, $request->file('document_file_3'), $destination);
            $student->document_title_4 = $request->document_title_4;
            $student->document_file_4 = fileUpdate($student->document_file_4, $request->file('document_file_4'), $destination);
            if ($request->customF) {
                $dataImage = $request->customF;
                foreach ($dataImage as $label => $field) {
                    if (is_object($field) && $field != "") {
                        $key = "";
                        $maxFileSize = generalSetting()->file_size;
                        $file = $field;
                        $fileSize = filesize($file);
                        $fileSizeKb = ($fileSize / 1000000);
                        if ($fileSizeKb >= $maxFileSize) {
                            Toastr::error('Max upload file size ' . $maxFileSize . ' Mb is set in system', 'Failed');
                            return redirect()->back();
                        }
                        $file = $field;
                        $key = $file->getClientOriginalName();
                        $file->move('public/uploads/customFields/', $key);
                        $dataImage[$label] = 'public/uploads/customFields/' . $key;
                    }
                }
                //Custom Field Start
                $student->custom_field_form_name = "student_registration";
                $student->custom_field = json_encode($dataImage, true);
                //Custom Field End               
            }
            if (moduleStatusCheck('Lead') == true) {
                $student->lead_city_id = $request->lead_city;
                $student->source_id = $request->source_id;
            }

            $student->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function update(SmStudentAdmissionRequest $request)
    {

        try {
            $this->updateStudentInfo($request);
            Toastr::success('Operation successful', 'Success');
			
			// start edit log
            $agent = new Agent();
            $user_log = new SmUserLog();
            $user_log->user_id = Auth::user()->id;
            $user_log->role_id = Auth::user()->role_id;
            $user_log->log_type = "edit student profile";
            $user_log->school_id = Auth::user()->school_id;
            $user_log->ip_address = $request->ip();
            $user_log->academic_id = getAcademicid() ?? 1;

            $user_log->user_agent = $agent->browser() . ', ' . $agent->platform();
            $user_log->save();

            // end edit log
			
            return redirect('student-list');
        } catch (\Throwable $th) {
            DB::rollback();
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    private function add_user($user_id, $role_id, $username, $email, $phone_number, $full_name)
    {
        try {
            $user = $user_id == null ? new User() : User::find($user_id);
            $user->role_id = $role_id;
            $user->username = $username;
            $user->full_name = $full_name;
            $user->email = $email;
            $user->phone_number = $phone_number;
            $user->save();
            return $user;
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }

    public function view(Request $request, $id)
    {
        try {
            $student_detail = SmStudent::withoutGlobalScope(StatusAcademicSchoolScope::class)->find($id);
            $records = studentRecords(null, $student_detail->id)->get();

            if ($student_detail->parent_id) {
                $siblings = SmStudent::where('parent_id', $student_detail->parent_id)->where('id', '!=', $id)->status()->withoutGlobalScope(StatusAcademicSchoolScope::class)->get();
            } else {
                $siblings = collect();
            }
            $exams = SmExamSchedule::where('class_id', $student_detail->class_id)
                ->where('section_id', $student_detail->section_id)
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $academic_year = SmAcademicYear::where('id', $student_detail->session_id)
                ->first();

            $grades = SmMarksGrade::where('active_status', 1)
                ->where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $max_gpa = SmMarksGrade::where('active_status', 1)
                ->where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->max('gpa');

            $fail_gpa = SmMarksGrade::where('active_status', 1)
                ->where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->min('gpa');

            $fail_gpa_name = SmMarksGrade::where('active_status', 1)
                ->where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->where('gpa', $fail_gpa)
                ->first();

            $timelines = SmStudentTimeline::where('staff_student_id', $id)
                ->where('type', 'stu')->where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->get();


            if (!empty($student_detail->vechile_id)) {
                $driver_id = SmVehicle::where('id', '=', $student_detail->vechile_id)->first();
                $driver_info = SmStaff::where('id', '=', $driver_id->driver_id)->first();
            } else {
                $driver_id = '';
                $driver_info = '';
            }

            $exam_terms = SmExamType::where('school_id', Auth::user()->school_id)
                ->where('academic_id', getAcademicId())
                ->get();

            $custom_field_data = $student_detail->custom_field;

            if (!is_null($custom_field_data)) {
                $custom_field_values = json_decode($custom_field_data);
            } else {
                $custom_field_values = null;
            }
            $sessions = SmAcademicYear::get(['id', 'year', 'title']);

            return view('backEnd.studentInformation.student_view', compact('student_detail', 'driver_info', 'exams', 'siblings', 'grades', 'academic_year', 'exam_terms', 'max_gpa', 'fail_gpa_name', 'custom_field_values', 'sessions', 'records', 'timelines'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function studentDetails(Request $request)
    {
        try {
            $classes = SmClass::where('active_status', 1)
                ->where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $students = SmStudent::where('academic_id', getAcademicId())
                ->where('school_id', Auth::user()->school_id)
                ->get();

            $sessions = SmAcademicYear::where('active_status', 1)
                ->where('school_id', Auth::user()->school_id)
                ->get();

            return view('backEnd.studentInformation.student_details', compact('classes', 'sessions'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function settings()
    {
        try {
            $student_settings = SmStudentRegistrationField::where('school_id', auth()->user()->school_id)->where('active_status', 1)->get();
            return view('backEnd.studentInformation.student_settings', compact('student_settings'));
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function statusUpdate(Request $request)
    {
        $field = SmStudentRegistrationField::where('school_id', auth()->user()->school_id)
            ->where('id', $request->filed_id)->first();
        if ($field) {
            if ($request->type == 'required') {

                $field->is_required = $request->field_status;
            }
            if ($request->type == 'student') {
                $field->student_edit = $request->field_status;
            }
            if ($request->type == 'parent') {
                $field->parent_edit = $request->field_status;
            }
            $field->save();
            session()->forget('SmStudentRegistrationField');
            return response()->json(['message' => 'Operation Success']);
        }
        return response()->json(['error' => 'Operation Failed']);
    }

    public function updateRecord(Request $request)
    {
        $this->insertStudentRecord($request);
    }

    public function recordStore(Request $request)
    {
        // return $request->all();
        try {
            if (moduleStatusCheck('University')) {
                $interface = App::make(UnCommonRepositoryInterface::class);
                $studentRecord = $interface->searchStudentRecord($request)->first();
            } else {
                $studentRecord = StudentRecord::where('class_id', $request->class)
                    ->where('section_id', $request->section)
                    ->where('academic_id', $request->session)
                    ->where('student_id', $request->student_id)
                    ->where('school_id', auth()->user()->school_id)
                    ->first();
            }
            if ($studentRecord) {
                Toastr::error('Already Assign', 'Failed');
                return redirect()->back();
            } else {
                $this->insertStudentRecord($request);
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function insertStudentRecord($request)
    {
        if (!$request->filled('is_default') || $request->is_default) {
            StudentRecord::where('academic_id', getAcademicId())->where('student_id', $request->student_id)->where('school_id', auth()->user()->school_id)->update([
                'is_default' => 0,
            ]);
        }
        if (generalSetting()->multiple_roll == 0 && $request->roll_number) {
            StudentRecord::where('student_id', $request->student_id)->where('school_id', auth()->user()->school_id)
                ->where('academic_id', getAcademicId())->update([
                    'roll_no' => $request->roll_number,
                ]);
        }
        if ($request->record_id) {
            $studentRecord = StudentRecord::find($request->record_id);
        } else {
            $studentRecord = new StudentRecord;
        }

        $studentRecord->student_id = $request->student_id;
        if ($request->roll_number) {
            $studentRecord->roll_no = $request->roll_number;
        }
        $studentRecord->is_promote = $request->is_promote ?? 0;
        $studentRecord->is_default = !$request->filled('is_default') || $request->is_default;

        if (moduleStatusCheck('Lead') == true) {
            $studentRecord->lead_id = $request->lead_id;
        }
        if (moduleStatusCheck('University')) {
            $studentRecord->un_academic_id = $request->un_academic_id;
            $studentRecord->un_session_id = $request->un_session_id;
            $studentRecord->un_department_id = $request->un_department_id;
            $studentRecord->un_faculty_id = $request->un_faculty_id;
            $studentRecord->un_semester_id = $request->un_semester_id;
            $studentRecord->un_semester_label_id = $request->un_semester_label_id == 0 ? null : $request->un_semester_label_id;
        } else {
			if($request->class_id && $request->section_id){
				$studentRecord->class_id = $request->class_id;
            $studentRecord->section_id = $request->section_id;
			}else{
				 $studentRecord->class_id = $request->class;
            $studentRecord->section_id = $request->section;
			}
           // $studentRecord->class_id = $request->class_id;
           // $studentRecord->section_id = $request->section_id;
			
			// $studentRecord->class_id = $request->class;
            //$studentRecord->section_id = $request->section;

            $studentRecord->roll_no = $request->roll_no;
            $studentRecord->session_id = $request->session;
        }
        $studentRecord->school_id = Auth::user()->school_id;
        $studentRecord->academic_id = $request->session;
        $studentRecord->save();
    }

    public function assignClass($id)
    {
        $data['schools'] = SmSchool::get();
        $data['sessions'] = SmAcademicYear::get(['id', 'year', 'title']);
        $data['student_records'] = StudentRecord::where('student_id', $id)
            ->when(moduleStatusCheck('University'), function ($query) {
                $query->whereNull('class_id');
            })->get();
        $data['student_detail'] = SmStudent::where('id', $id)->first();
        $data['classes'] = SmClass::get(['id', 'class_name']);
        $data['siblings'] = SmStudent::where('parent_id', $data['student_detail']->parent_id)->where('id', '!=', $id)->status()->withoutGlobalScope(StatusAcademicSchoolScope::class)->get();
        return view('backEnd.studentInformation.assign_class', $data);
    }

    public function recordEdit($student_id, $record_id)
    {

        $data['schools'] = SmSchool::get();
        $data['record'] = StudentRecord::where('id', $record_id)->first();
        $data['editData'] = $data['record'];
        $data['modelId'] = $data['record'];
        $request = [
            'semester_id' => $data['record']->un_semester_id,
            'academic_id' => $data['record']->un_academic_id,
            'session_id' => $data['record']->un_session_id,
            'department_id' => $data['record']->un_department_id,
            'faculty_id' => $data['record']->un_faculty_id,

        ];
        $unSemesterLebel = App::make(UnSemesterLabelRepositoryInterface::class);
        $unDepartment = App::make(UnSubjectRepositoryInterface::class);
        $data['editUnDepartments'] = $unDepartment->getDeptAjax(['un_faculty_id' => $data['record']->un_faculty_id])->pluck('name', 'id')
            ->prepend(__('university::un.select_department') . ' *', '')
            ->toArray();
        $data['unSemesterLebels'] = $unSemesterLebel->semesterLevel($request);
        $data['sessions'] = SmAcademicYear::get(['id', 'year', 'title']);
        $data['student_records'] = StudentRecord::where('student_id', $student_id)->get();
        $data['student_detail'] = SmStudent::where('id', $student_id)->first();
        $data['classes'] = SmClass::get(['id', 'class_name']);
        $data['siblings'] = SmStudent::where('parent_id', $data['student_detail']->parent_id)->where('id', '!=', $student_id)->status()->withoutGlobalScope(StatusAcademicSchoolScope::class)->get();
        return view('backEnd.studentInformation.assign_class_edit', $data);
    }

    public function recordUpdate(Request $request)
    {
        try {
            // return $request->all();
            $studentRecord = StudentRecord::where('class_id', $request->class)
                ->where('section_id', $request->section)
                ->where('academic_id', $request->session)
                ->where('student_id', $request->student_id)
                ->where('id', '!=', $request->record_id)
                ->where('school_id', auth()->user()->school_id)
                ->first();

            if ($studentRecord) {
                Toastr::error('Already Assign', 'Failed');
                return redirect()->back();
            } else {
                $this->insertStudentRecord($request);
            }
            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public function checkExitStudent(Request $request)
    {
        try {
            $email = $request->email;
            $phone = $request->phone;
            $student = null;
            if ($email || $phone) {
                $x_student = SmStudent::query();
                if ($email && $phone) {
                    $x_student->where('mobile', $phone);
                } else if ($email) {
                    $x_student->where('email', $email);
                } else if ($phone) {
                    $x_student->where('mobile', $phone);
                }
                $student = $x_student->first();
            }
            return response()->json(['student' => $student]);
        } catch (\Exception $e) {
            return response()->json("", 404);
        }
    }

    public function getSchool(Request $request)
    {
        try {
            $academic_years = SmAcademicYear::where('school_id', $request->school_id)->get();
            return response()->json([$academic_years]);
        } catch (\Exception $e) {
            return response()->json("", 404);
        }
    }

    public function deleteRecord(Request $request)
    {
        try {
            //code...
            $record = StudentRecord::where('id', $request->record_id)
                ->where('student_id', $request->student_id)
                ->first();
            if ($record) {
                $record->delete();
            }

            Toastr::success('Operation successful', 'Success');
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }

    public static function loadData()
    {
        $data['classes'] = SmClass::get(['id', 'class_name']);
        $data['religions'] = SmBaseSetup::where('base_group_id', '=', '2')->get(['id', 'base_setup_name']);
        $data['blood_groups'] = SmBaseSetup::where('base_group_id', '=', '3')->get(['id', 'base_setup_name']);
        $data['genders'] = SmBaseSetup::where('base_group_id', '=', '1')->get(['id', 'base_setup_name']);
        $data['route_lists'] = SmRoute::get(['id', 'title']);
        $data['dormitory_lists'] = SmDormitoryList::get(['id', 'dormitory_name']);
        $data['categories'] = SmStudentCategory::get(['id', 'category_name']);
        $data['groups'] = SmStudentGroup::get(['id', 'group']);
        $data['sessions'] = SmAcademicYear::get(['id', 'year', 'title']);
        $data['driver_lists'] = SmStaff::where([['active_status', '=', '1'], ['role_id', 9]])->where('school_id', Auth::user()->school_id)->get(['id', 'full_name']);
        $data['custom_fields'] = SmCustomField::where('form_name', 'student_registration')->where('school_id', Auth::user()->school_id)->get();
        $data['vehicles'] = SmVehicle::get();

        $data['lead_city'] = [];
        $data['sources'] = [];

        if (moduleStatusCheck('Lead') == true) {
            $data['lead_city'] = \Modules\Lead\Entities\LeadCity::where('school_id', auth()->user()->school_id)->get(['id', 'city_name']);
            $data['sources'] = \Modules\Lead\Entities\Source::where('school_id', auth()->user()->school_id)->get(['id', 'source_name']);
        }

        if (moduleStatusCheck('University') == true) {
            $data['un_session'] = \Modules\University\Entities\UnSession::where('school_id', auth()->user()->school_id)->get(['id', 'name']);
            $data['un_academic_year'] = \Modules\University\Entities\UnAcademicYear::where('school_id', auth()->user()->school_id)->get(['id', 'name']);
        }
        return $data;
    }

     public function studentBulkStore(Request $request)
    {

        $request->validate(
            [
                'session' => 'required',
                // 'class' => 'required',
                // 'section' => 'required',
                'file' => 'required'
            ],
            [
                'session.required' => 'Academic year field is required.'
            ]
        );


        $file_type = strtolower($request->file->getClientOriginalExtension());
        if ($file_type <> 'csv' && $file_type <> 'xlsx' && $file_type <> 'xls') {
            Toastr::warning('The file must be a file of type: xlsx, csv or xls', 'Warning');
            return redirect()->back();
        } else {
            try {
                DB::beginTransaction();
                $path = $request->file('file');
                Excel::import(new StudentsImport, $request->file('file'), 's3', \Maatwebsite\Excel\Excel::XLSX);

                $data1 = StudentBulkTemporary::where('user_id', Auth::user()->id)->get();
				
                

             //echo "<pre>"; print_r($data1); die;

                $data = [];
                $i = 0;
                $j = 0;
                foreach ($data1 as $key => $value) {
                    if ($i == 0) {
                        $j = $value['id'];
                    }

                    $temp_section_id = DB::table('sm_sections')->select('id')->where('section_name', $value['section_name'])->first();
					
					
	


                    $temp_class_id = DB::table('sm_classes')->select('id')->where('class_name', $value['class_name'])->first();
                     

                    
                    if ($temp_section_id == "") {
                        Toastr::error('Section does not exist');
                        return redirect()->back();
                        exit;
                    } else {
                        $value['section_id'] = $temp_section_id->id;
                    }

                    if ($temp_class_id == "") {
                        Toastr::error('Class does not exist');
                        return redirect()->back();
                        exit;
                    } else {
                        $value['class_id'] = $temp_class_id->id;
                    }





                    if ($value['admission_number'] == '' && $value['class_name'] == '' && $value['section_name'] == '' && $value['roll_no'] == '' && $value['first_name'] == '' && $value['last_name'] == '' && $value['date_of_birth'] == '' && $value['religion'] == '' && $value['gender'] == '' && $value['caste'] == '' && $value['mobile'] == '' && $value['email'] == '' && $value['blood_group'] == '' && $value['height'] == '' && $value['weight'] == '' && $value['father_name'] == '' && $value['father_phone'] == '' && $value['father_occupation'] == '' && $value['mother_name'] == '' && $value['mother_phone'] == '' && $value['mother_occupation'] == '' && $value['guardian_name'] == '' && $value['guardian_relation'] == '' && $value['guardian_email'] == '' && $value['guardian_phone'] == '' && $value['guardian_occupation'] == '' && $value['guardian_address'] == '' && $value['current_address'] == '' && $value['permanent_address'] == '' && $value['bank_account_no'] == '' && $value['bank_name'] == '' && $value['national_identification_no'] == '' && $value['local_identification_no'] == '' && $value['previous_school_details'] == '' && $value['rfid_no'] == '' && $value['note'] == '' && $value['id'] != '' && $value['admission_date'] != '' && $value['user_id'] != '' && $value['created_at'] != '' && $value['updated_at'] != '') 
					{
						//echo "if" ;die;
                    } else {
						
					//echo "else"; die;
                        $data[$i] = $value;


                        $data[$i]->id = $j;
                        $i++;
                        $j++;
                    }
                }


                
          



                $shcool_details = SmGeneralSettings::where('school_id', auth()->user()->school_id)->first();
                $school_name = explode(' ', $shcool_details->school_name);
                $short_form = '';
                foreach ($school_name as $value) {
                    $ch = str_split($value);
                    $short_form = $short_form . '' . $ch[0];
                }


                if (!empty($data)) {


                    foreach ($data as $key => $value) {






                        $users =  StudentBulkTemporary::where('user_id', Auth::user()->id)->get();
                        $usersUnique = $users->unique(['email']);
                        $userDuplicates = $users->diff($usersUnique);

                        $users1 =  StudentBulkTemporary::where('user_id', Auth::user()->id)->get();
                        $usersUnique1 = $users1->unique(['guardian_email']);
                        $userDuplicates1 = $users1->diff($usersUnique1);


                        $roll_no =  StudentBulkTemporary::where('user_id', Auth::user()->id)->get();
                        $numberUnique = $roll_no->unique(['roll_no']);
                        $numberDuplicates = $roll_no->diff($numberUnique);


                        $rno = StudentRecord::where('roll_no', $value['roll_no']);
                        $alredy_rno =  $rno->count();
                        //echo "<pre>"; print_r($value->class_id);die;


                        if ($alredy_rno > 0) {
                            Toastr::error('Roll No already exist');
                            return redirect()->back();
                            exit;
                        } elseif ($userDuplicates->toArray()) {
                            Toastr::error('Duplicate student Email not allowed');
                            return redirect()->back();
                            exit;
                        } elseif ($userDuplicates1->toArray()) {
                            Toastr::error('Duplicate guardian Email not allowed');
                            return redirect()->back();
                            exit;
                        } elseif ($numberDuplicates->toArray()) {
                            Toastr::error('Duplicate Roll no. not allowed');
                            return redirect()->back();
                            exit;
                        } else {


                            //echo "<pre>"; print_r($value); die;
                            if (moduleStatusCheck('SaasSubscription') == TRUE) {


                                $active_student = SmStudent::where('school_id', Auth::user()->school_id)->where('active_status', 1)->count();

                                if (\Modules\SaasSubscription\Entities\SmPackagePlan::student_limit() <= $active_student) {

                                    DB::commit();
                                    StudentBulkTemporary::where('user_id', Auth::user()->id)->delete();
                                    Toastr::error('Your student limit has been crossed.', 'Failed');
                                    return redirect('student-list');
                                }
                            }


                            $ad_check = SmStudent::where('admission_no', (int)$value->admission_number)->where('school_id', Auth::user()->school_id)->get();
                            //  return $ad_check;

                            if ($ad_check->count() > 0) {

                                if ($value->phone_number || $value->email) {
                                    $user = User::when($value->phone_number && !$value->email, function ($q) use ($value) {
                                        $q->where('phone_number', $value->phone_number)->orWhere('username', $value->phone_number);
                                    })
                                        ->when($value->email && !$value->phone_number, function ($q) use ($value) {
                                            $q->where('email', $value->email)->orWhere('username', $value->email);
                                        })
                                        ->when($value->email && $value->phone_number, function ($q) use ($value) {
                                            $q->where('email', $value->email);
                                        })
                                        ->first();
                                    if ($user) {


                                        if ($user->role_id == 2) {
                                            // echo "<pre>"; print_r( $value->class_id);
                                            // echo "<pre>"; print_r($value->section_id);
                                            // // echo "<pre>"; print_r($user->id);

                                            // echo "<pre>"; print_r(auth()->user()->school_id); exit;

                                            $studentRecord = StudentRecord::where('class_id', $value->class_id)
                                                ->where('section_id', $value->section_id)
                                                ->where('academic_id', $request->session)
                                                // ->where('student_id', $user->id)
                                                ->where('school_id', auth()->user()->school_id)
                                                ->first();

                                            // echo "<pre>"; print_r($studentRecord); exit;
                                            if (!$studentRecord) {
                                                $this->insertStudentRecord($request->merge([
                                                    'student_id' => $user->student->id,
                                                    'roll_no' => $value->roll_no,
                                                ]));
                                            }
                                        }
                                    }
                                }
                                DB::rollback();
                                StudentBulkTemporary::where('user_id', Auth::user()->id)->delete();
                                Toastr::error('Admission number should be unique.', 'Failed');
                                return redirect()->back();
                            }

                            if ($value->email != "") {

                                $chk = DB::table('sm_students')->where('email', $value->email)->where('school_id', Auth::user()->school_id)->count();
                                if ($chk >= 1) {
                                    DB::rollback();
                                    StudentBulkTemporary::where('user_id', Auth::user()->id)->delete();
                                    Toastr::error('Student Email address should be unique.', 'Failed');
                                    return redirect()->back();
                                }
                            }

                            if ($value->guardian_email != "") {
                                $chk = DB::table('sm_parents')->where('guardians_email', $value->guardian_email)->where('school_id', Auth::user()->school_id)->count();
                                if ($chk >= 1) {
                                    DB::rollback();
                                    StudentBulkTemporary::where('user_id', Auth::user()->id)->delete();
                                    Toastr::error('Guardian Email address should be unique.', 'Failed');
                                    return redirect()->back();
                                }
                            }


                            try {


                                if ($value->admission_number == null) {
                                    continue;
                                } else {
                                }
                                $academic_year = SmAcademicYear::find($request->session);


                                $user_stu = new User();
                                $user_stu->role_id = 2;
                                $user_stu->full_name = $value->first_name . ' ' . $value->last_name;

                                if (empty($value->email)) {
                                    $user_stu->username = $value->admission_number;
                                } else {
                                    $user_stu->username = $value->email;
                                }

                                if (!empty($value->mobile)) {
                                    $user_stu->username = $value->mobile;
                                }

                                $user_stu->email = $value->email;

                                $user_stu->school_id = Auth::user()->school_id;

                                $user_stu->password = Hash::make(123456);

                                $user_stu->created_at = $academic_year->year . '-01-01 12:00:00';

                                $user_stu->save();

                                $user_stu->toArray();

                                try {
                                    $user_parent = new User();
                                    $user_parent->role_id = 3;
                                    $user_parent->full_name = $value->father_name;

                                    if (empty($value->guardian_email)) {
                                        $data_parent['email'] = 'par_' . $value->admission_number;

                                        $user_parent->username = 'par_' . $value->admission_number;
                                    } else {

                                        $data_parent['email'] = $value->guardian_email;

                                        $user_parent->username = $value->guardian_email;
                                    }
                                    if (!empty($value->guardian_phone)) {
                                        $data_parent['username'] = $value->guardian_phone;
                                        $user_parent->username  = $value->guardian_phone;
                                    }
                                    $user_parent->email = $value->guardian_email;

                                    $user_parent->password = Hash::make(123456);
                                    $user_parent->school_id = Auth::user()->school_id;

                                    $user_parent->created_at = $academic_year->year . '-01-01 12:00:00';

                                    $user_parent->save();
                                    $user_parent->toArray();

                                    try {

                                        $parent = new SmParent();

                                        if (
                                            $value->relation == 'F' ||
                                            $value->guardians_relation == 'F' ||
                                            $value->guardian_relation == 'F' ||
                                            strtolower($value->guardian_relation) == 'father' ||
                                            strtolower($value->guardians_relation) == 'father'
                                        ) {
                                            $relationFull = 'Father';
                                            $relation = 'F';
                                        } elseif (
                                            $value->relation == 'M' ||
                                            $value->guardians_relation == 'M' ||
                                            $value->guardian_relation == 'M' ||
                                            strtolower($value->guardian_relation) == 'mother' ||
                                            strtolower($value->guardians_relation) == 'mother'
                                        ) {
                                            $relationFull = 'Mother';
                                            $relation = 'M';
                                        } else {
                                            $relationFull = 'Other';
                                            $relation = 'O';
                                        }
                                        $parent->guardians_relation = $relationFull;
                                        $parent->relation = $relation;


                                        $parent->user_id = $user_parent->id;
                                        $parent->fathers_name = $value->father_name;
                                        $parent->fathers_mobile = $value->father_phone;
                                        $parent->fathers_occupation = $value->fathe_occupation;
                                        $parent->mothers_name = $value->mother_name;
                                        $parent->mothers_mobile = $value->mother_phone;
                                        $parent->mothers_occupation = $value->mother_occupation;
                                        $parent->guardians_name = $value->guardian_name;
                                        $parent->guardians_mobile = $value->guardian_phone;
                                        $parent->guardians_occupation = $value->guardian_occupation;
                                        $parent->guardians_address = $value->guardian_address;
                                        $parent->guardians_email = $value->guardian_email;
                                        $parent->school_id = Auth::user()->school_id;
                                        $parent->academic_id = $request->session;

                                        $parent->created_at = $academic_year->year . '-01-01 12:00:00';

                                        $parent->save();
                                        $parent->toArray();

                                        try {
                                            $student = new SmStudent();
                                            // $student->siblings_id = $value->sibling_id;
                                            // $student->class_id = $request->class;
                                            // $student->section_id = $request->section;
                                            $student->session_id = $request->session;
                                            $student->user_id = $user_stu->id;

                                            $student->parent_id = $parent->id;
                                            $student->role_id = 2;
                                            $student->admission_no = $value->admission_number;
                                            $student->roll_no = $value->roll_no;
                                            $student->first_name = $value->first_name;
                                            $student->last_name = $value->last_name;
                                            $student->full_name = $value->first_name . ' ' . $value->last_name;
                                            //$student->gender_id = $value->gender;


                                            if ($value->gender == 'Male') {
                                                $student->gender_id = 1;
                                            }
                                            if ($value->gender == 'Female') {
                                                $student->gender_id = 2;
                                            }
                                            if ($value->gender == 'Others') {
                                                $student->gender_id = 3;
                                            }



                                            $student->date_of_birth = date('Y-m-d', strtotime($value->date_of_birth));
                                            $student->caste = $value->caste;
                                            $student->email = $value->email;
                                            $student->mobile = $value->mobile;
                                            $student->admission_date = date('Y-m-d', strtotime($value->admission_date));
                                            //$student->bloodgroup_id = $value->blood_group;
                                            if ($value->blood_group == 'A+') {
                                                $student->bloodgroup_id = 9;
                                            }
                                            if ($value->blood_group == 'O+') {
                                                $student->bloodgroup_id = 10;
                                            }
                                            if ($value->blood_group == 'B+') {
                                                $student->bloodgroup_id = 11;
                                            }
                                            if ($value->blood_group == 'AB+') {
                                                $student->bloodgroup_id = 12;
                                            }
                                            if ($value->blood_group == 'A-') {
                                                $student->bloodgroup_id = 13;
                                            }
                                            if ($value->blood_group == 'O-') {
                                                $student->bloodgroup_id = 14;
                                            }
                                            if ($value->blood_group == 'B-') {
                                                $student->bloodgroup_id = 15;
                                            }
                                            if ($value->blood_group == 'AB-') {
                                                $student->bloodgroup_id = 16;
                                            }





                                            if ($value->religion == 'Muslim') {
                                                $student->religion_id = 4;
                                            }
                                            if ($value->religion == 'Hinduism') {
                                                $student->religion_id = 5;
                                            }
                                            if ($value->religion == 'Sikhism') {
                                                $student->religion_id = 6;
                                            }
                                            if ($value->religion == 'Buddhism') {
                                                $student->religion_id = 7;
                                            }
                                            if ($value->religion == 'Protestantism') {
                                                $student->religion_id = 8;
                                            }

                                            // $student->religion_id = $value->religion;
                                            $student->height = $value->height;
                                            $student->weight = $value->weight;
                                            $student->current_address = $value->current_address;
                                            $student->permanent_address = $value->permanent_address;
                                            $student->national_id_no = $value->national_identification_no;
                                            $student->local_id_no = $value->local_identification_no;
                                            $student->bank_account_no = $value->bank_account_no;
                                            $student->bank_name = $value->bank_name;
                                            $student->previous_school_details = $value->previous_school_details;
                                            $student->class_id = $value->class_id;
											 $student->section_id = $value->section_id;
											$student->aditional_notes = $value->note;
                                            $student->school_id = Auth::user()->school_id;
                                            $student->academic_id = $request->session;

                                            $student->created_at = $academic_year->year . '-01-01 12:00:00';




                                            $request['class_id'] =  $value->class_id;
                                            $request['section_id'] =  $value->section_id;
                                            $request['roll_no'] =  $value->roll_no;
											
//                                             $call_rfid_function =  match_rfid_api($value->rfid_no);
//
//                                            if ($call_rfid_function) {
//                                                // echo "true";
//
//                                                $sm_row = SmStudent::where('rfid_no', $value->rfid_no)->first();
//                                                if ($sm_row == "") {
//                                                    $student->rfid_no = $value->rfid_no;
//                                                    $student->save();
//                                                } else {
//                                                    DB::rollback();
//                                                    Toastr::error('RFID Number is already exist', 'Failed');
//                                                    return redirect()->back();
//                                                }
//                                            }else{
//                                                DB::rollback();
//                                                Toastr::error('Invalid RFID Number', 'Failed');
//                                                return redirect()->back();
//                                            }
											
if(!empty($value->rfid_no)){
		 $sm_row = SmStudent::where('rfid_no', $value->rfid_no)->first();
        
		
			if (empty($sm_row)) {
                $student->rfid_no = $value->rfid_no;
               
            } else {
                DB::rollback();
                Toastr::error('RFID Number is already exist', 'Failed');
                return redirect()->back();
            }
			}

                                            $student->save();
                                            $this->insertStudentRecord($request->merge([
                                                'student_id' => $student->id,
                                                'roll_no' => $student->roll_no,
                                                'is_default' => 1,
                                            ]));
                                            $user_info = [];

                                            if ($value->email != "") {
                                                $user_info[] = array('email' => $value->email, 'username' => $value->email);
                                            }


                                            if ($value->guardian_email != "") {
                                                $user_info[] = array('email' => $value->guardian_email, 'username' => $data_parent['email']);
                                            }
                                        } catch (\Illuminate\Database\QueryException $e) {

                                            DB::rollback();
                                            Toastr::error('Operation Failed11', 'Failed');
                                            return redirect()->back();
                                        }
                                        //  catch (\Exception $e) {

                                        //     DB::rollback();
                                        //     Toastr::error('Operation Failed', 'Failed');
                                        //     return redirect()->back();
                                        // }
                                    } catch (\Exception $e) { //

                                        DB::rollback();
                                        Toastr::error('Operation Failed22', 'Failed');
                                        return redirect()->back();
                                    }
                                } catch (\Exception $e) {

                                    DB::rollback();
                                    Toastr::error('Operation Failed33', 'Failed');
                                    return redirect()->back();
                                }
                            } catch (\Exception $e) {

                                DB::rollback();
                                Toastr::error('Operation Failed44', 'Failed');
                                return redirect()->back();
                            }
                        }
                    }

                    StudentBulkTemporary::where('user_id', Auth::user()->id)->delete();

                    DB::commit();
                    Toastr::success('Operation successful', 'Success');
					 // start user log

                    $agent = new Agent();
                    $user_log = new SmUserLog();
                    $user_log->user_id = Auth::user()->id;
                    $user_log->role_id = Auth::user()->role_id;
                    $user_log->log_type = "student created";
                    $user_log->school_id = Auth::user()->school_id;
                    $user_log->ip_address = $request->ip();
                    $user_log->academic_id = getAcademicid() ?? 1;

                    $user_log->user_agent = $agent->browser() . ', ' . $agent->platform();
                    $user_log->save();

                    // end user log
                    return redirect()->back();
                }
            } catch (\Exception $e) {

                Toastr::error('Operation Failed55', 'Failed');
                return redirect()->back();
            }
        }
    }
    public function mm()
    {
        return view('backEnd.studentInformation.mm');
    }
	  //google backupSettings
       


}