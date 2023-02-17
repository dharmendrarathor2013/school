<?php

namespace App\Http\Controllers\Admin\OnlineExam;

use App\SmClass;
use App\SmStaff;
use App\SmSection;
use App\YearCheck;
use App\SmQuestionBank;
use App\SmAssignSubject;
use App\SmQuestionGroup;
use App\SmQuestionLevel;
use App\SmGeneralSettings;
use Illuminate\Http\Request;
use App\SmQuestionBankMuOption;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Admin\OnlineExam\SmQuestionBankRequest;
use App\QuestionbankBulkTemporary;
use App\Imports\QbanksImport;
use Maatwebsite\Excel\Facades\Excel;


class SmQuestionBankController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
        // User::checkAuth();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $levels = SmQuestionLevel::get();

            $groups = SmQuestionGroup::get();

            $banks = SmQuestionBank::with('class', 'section', 'questionMu', 'questionGroup')->get();

            if (teacherAccess()) {
                $teacher_info = SmStaff::where('user_id', Auth::user()->id)->first();
                $classes = $teacher_info->classes;
            } else {
                $classes = SmClass::get();
            }
            $sections = SmSection::get();
            return view('backEnd.examination.question_bank', compact('banks', 'levels', 'groups', 'classes', 'sections'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }
    public function store(SmQuestionBankRequest $request)
    {


        try {

            if ($request->question_type != 'M' && $request->question_type != 'MI') {
                // echo "not MI and M"; exit;
                foreach ($request->section as $section) {
                    $online_question = new SmQuestionBank();
                    $online_question->type = $request->question_type;
                    $online_question->q_group_id = $request->group;
                    $online_question->class_id = $request->class;
                    $online_question->section_id = $section;
                    $online_question->marks = $request->marks;
                    $online_question->question = $request->question;
                    $online_question->school_id = Auth::user()->school_id;
                    $online_question->academic_id = getAcademicId();
                    if ($request->question_type == "F") {
                        $online_question->suitable_words = $request->suitable_words;
                    } elseif ($request->question_type == "T") {
                        $online_question->trueFalse = $request->trueOrFalse;
                    }
                    $result = $online_question->save();
                }
                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            } elseif ($request->question_type == 'MI') {
                // echo "MI type"; exit;

                // return $request;

                DB::beginTransaction();

                if (!Schema::hasColumn('sm_question_banks', 'question_image')) {
                    Schema::table('sm_question_banks', function ($table) {
                        $table->string('question_image')->nullable();
                    });
                }
                if (!Schema::hasColumn('sm_question_banks', 'answer_type')) {
                    Schema::table('sm_question_banks', function ($table) {
                        $table->string('answer_type')->nullable();
                    });
                }

                try {

                    $fileName = "";
                    $imagemimes = [
                        'image/png',
                        'image/jpg',
                        'image/jpeg'
                    ];

                    $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                    $file = $request->file('question_image');
                    $fileSize =  filesize($file);
                    $fileSizeKb = ($fileSize / 1000000);
                    if ($fileSizeKb >= $maxFileSize) {
                        Toastr::error('Max upload file size ' . $maxFileSize . ' Mb is set in system', 'Failed');
                        return redirect()->back();
                    }




                    if (($request->file('question_image') != "")  && (in_array($file->getMimeType(), $imagemimes))) {
                        $image_info = getimagesize($request->file('question_image'));
                        if ($image_info[0] <= 650 && $image_info[1] <= 450) {
                            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                            $file->move('public/uploads/upload_contents/', $fileName);
                            $fileName = 'public/uploads/upload_contents/' . $fileName;
                        } else {
                            Toastr::error('Question Image should be 650x450', 'Failed');
                            // return redirect()->back();
                            return redirect()->to(url()->previous())
                                ->withInput($request->input());
                        }
                    }
                    foreach ($request->section as $section) {
                        $online_question = new SmQuestionBank();
                        $online_question->type = $request->question_type;
                        $online_question->q_group_id = $request->group;
                        $online_question->class_id = $request->class;
                        $online_question->section_id = $section;
                        $online_question->marks = $request->marks;
                        $online_question->question = $request->question;
                        $online_question->answer_type = $request->answer_type;
                        $online_question->question_image = $fileName;
                        if ($request->question_type == 'MI') {
                            $online_question->number_of_option = $request->number_of_optionImg;
                        } else {

                            $online_question->number_of_option = $request->number_of_option;
                        }
                        $online_question->school_id = Auth::user()->school_id;
                        $online_question->academic_id = getAcademicId();
                        $online_question->save();
                        $online_question->toArray();
                    }
                    $i = 0;
                    if (isset($request->images)) {
                        foreach ($request->images as $key => $image) {
                            $i++;
                            $option_check = 'option_check_' . $i;
                            $online_question_option = new SmQuestionBankMuOption();
                            $online_question_option->question_bank_id = $online_question->id;

                            $file = $request->file('images');
                            $fileName = "";
                            if (($file[$key] != "")  && (in_array($file[$key]->getMimeType(), $imagemimes))) {
                                $fileName = md5($file[$key]->getClientOriginalName() . time()) . "." . $file[$key]->getClientOriginalExtension();
                                $file[$key]->move('public/uploads/upload_contents/', $fileName);
                                $fileName = 'public/uploads/upload_contents/' . $fileName;
                            }

                            $online_question_option->title = $fileName;

                            $online_question_option->school_id = Auth::user()->school_id;
                            $online_question_option->academic_id = getAcademicId();
                            if (isset($request->$option_check)) {
                                $online_question_option->status = 1;
                            } else {
                                $online_question_option->status = 0;
                            }
                            $online_question_option->save();
                        }
                    }
                    DB::commit();
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            } else {
                // echo "M type"; exit;

                DB::beginTransaction();

                try {
                    foreach ($request->section as $section) {

                        $online_question = new SmQuestionBank();
                        $online_question->type = $request->question_type;
                        $online_question->q_group_id = $request->group;
                        $online_question->class_id = $request->class;
                        $online_question->section_id = $section;
                        $online_question->marks = $request->marks;
                        $online_question->question = $request->question;
                        $online_question->number_of_option = $request->number_of_option;
                        $online_question->school_id = Auth::user()->school_id;
                        $online_question->academic_id = getAcademicId();
                        $online_question->save();
                        $online_question->toArray();
                        $i = 0;
                        if (isset($request->option)) {
                            foreach ($request->option as $option) {
                                $i++;
                                $option_check = 'option_check_' . $i;
                                $online_question_option = new SmQuestionBankMuOption();
                                $online_question_option->question_bank_id = $online_question->id;
                                $online_question_option->title = $option;
                                $online_question_option->school_id = Auth::user()->school_id;
                                $online_question_option->academic_id = getAcademicId();
                                if (isset($request->$option_check)) {
                                    $online_question_option->status = 1;
                                } else {
                                    $online_question_option->status = 0;
                                }
                                $online_question_option->save();
                            }
                        }
                    }
                    DB::commit();
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollBack();
                }
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {

            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function show($id)
    {
        try {
            $levels = SmQuestionLevel::get();
            $groups = SmQuestionGroup::get();
            $banks  = SmQuestionBank::get();
            $bank   = SmQuestionBank::find($id);
            if (teacherAccess()) {
                $teacher_info = SmStaff::where('user_id', Auth::user()->id)->first();
                $classes  = $teacher_info->classes;
            } else {
                $classes = SmClass::get();
            }
            $sections = SmSection::get();
            //return $bank;
            return view('backEnd.examination.question_bank', compact('levels', 'groups', 'banks', 'bank', 'classes', 'sections'));
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        //
    }

    public function update(SmQuestionBankRequest $request, $id)
    {


        try {
            if ($request->question_type != 'M' && $request->question_type != 'MI') {
                $online_question = SmQuestionBank::find($id);
                $online_question->type = $request->question_type;
                $online_question->q_group_id = $request->group;
                $online_question->class_id = $request->class;
                $online_question->section_id = $request->section;
                $online_question->marks = $request->marks;
                $online_question->question = $request->question;
                if ($request->question_type == "F") {
                    $online_question->suitable_words = $request->suitable_words;
                } elseif ($request->question_type == "T") {
                    $online_question->trueFalse = $request->trueOrFalse;
                }
                $result = $online_question->save();
                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect('question-bank');
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }
            } elseif ($request->question_type == 'MI') {
                DB::beginTransaction();

                if (!Schema::hasColumn('sm_question_banks', 'question_image')) {
                    Schema::table('sm_question_banks', function ($table) {
                        $table->string('question_image')->nullable();
                    });
                }

                try {


                    $online_question = SmQuestionBank::find($id);
                    $online_question->type = $request->question_type;
                    $online_question->q_group_id = $request->group;
                    $online_question->class_id = $request->class;
                    $online_question->section_id = $request->section;
                    $online_question->marks = $request->marks;
                    $online_question->question = $request->question;
                    $online_question->answer_type = $request->answer_type;
                    if ($request->question_type == 'MI') {
                        $online_question->number_of_option = $request->number_of_optionImg;
                    } else {
                        $online_question->number_of_option = $request->number_of_option;
                    }
                    $fileName = $online_question->question_image;
                    $imagemimes = [
                        'image/png',
                        'image/jpg',
                        'image/jpeg'
                    ];

                    $maxFileSize = SmGeneralSettings::first('file_size')->file_size;
                    $file = $request->file('question_image');
                    $fileSize =  filesize($file);
                    $fileSizeKb = ($fileSize / 1000000);
                    if ($fileSizeKb >= $maxFileSize) {
                        Toastr::error('Max upload file size ' . $maxFileSize . ' Mb is set in system', 'Failed');
                        return redirect()->back();
                    }




                    if (($request->file('question_image') != "")  && (in_array($file->getMimeType(), $imagemimes))) {
                        $image_info = getimagesize($request->file('question_image'));
                        if ($image_info[0] <= 650 && $image_info[1] <= 450) {
                            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                            $file->move('public/uploads/upload_contents/', $fileName);
                            $fileName = 'public/uploads/upload_contents/' . $fileName;
                        } else {
                            Toastr::error('Question Image should be 650x450', 'Failed');
                            return redirect()->to(url()->previous())
                                ->withInput($request->input());
                        }
                    }

                    $online_question->question_image = $fileName;

                    $online_question->number_of_option = $request->number_of_option;
                    $online_question->school_id = Auth::user()->school_id;
                    $online_question->academic_id = getAcademicId();
                    $online_question->save();
                    $online_question->toArray();
                    $i = 0;

                    if (isset($request->images_old)) {
                        SmQuestionBankMuOption::where('question_bank_id', $online_question->id)->delete();
                        foreach ($request->images_old as $key => $image) {
                            $i++;
                            $option_check = 'option_check_' . $i;
                            $online_question_option = new SmQuestionBankMuOption();
                            $online_question_option->question_bank_id = $online_question->id;

                            if (isset($request->images[$key])) {

                                $file = $request->file('images');
                                $fileName = "";
                                if (($file[$key] != "")  && (in_array($file[$key]->getMimeType(), $imagemimes))) {
                                    $fileName = md5($file[$key]->getClientOriginalName() . time()) . "." . $file[$key]->getClientOriginalExtension();
                                    $file[$key]->move('public/uploads/upload_contents/', $fileName);
                                    $fileName = 'public/uploads/upload_contents/' . $fileName;
                                }
                            } else {
                                $fileName = $request->images_old[$key];
                            }



                            $online_question_option->title = $fileName;

                            $online_question_option->school_id = Auth::user()->school_id;
                            $online_question_option->academic_id = getAcademicId();
                            if (isset($request->$option_check)) {
                                $online_question_option->status = 1;
                            } else {
                                $online_question_option->status = 0;
                            }
                            $online_question_option->save();
                        }
                    }
                    DB::commit();
                    Toastr::success('Operation successful', 'Success');
                    return redirect('question-bank');
                } catch (\Exception $e) {
                    DB::rollBack();
                }
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            } else {
                DB::beginTransaction();
                try {
                    $online_question = SmQuestionBank::find($id);
                    $online_question->type = $request->question_type;
                    $online_question->q_group_id = $request->group;
                    $online_question->class_id = $request->class;
                    $online_question->section_id = $request->section;
                    $online_question->marks = $request->marks;
                    $online_question->question = $request->question;
                    $online_question->number_of_option = $request->number_of_option;
                    $online_question->save();
                    $online_question->toArray();
                    $i = 0;
                    if (isset($request->option)) {
                        SmQuestionBankMuOption::where('question_bank_id', $online_question->id)->delete();
                        foreach ($request->option as $option) {
                            $i++;
                            $option_check = 'option_check_' . $i;
                            $online_question_option = new SmQuestionBankMuOption();
                            $online_question_option->question_bank_id = $online_question->id;
                            $online_question_option->title = $option;
                            $online_question_option->school_id = Auth::user()->school_id;
                            $online_question_option->academic_id = getAcademicId();
                            if (isset($request->$option_check)) {
                                $online_question_option->status = 1;
                            } else {
                                $online_question_option->status = 0;
                            }
                            $online_question_option->save();
                        }
                    }
                    DB::commit();
                    Toastr::success('Operation successful', 'Success');
                    return redirect('question-bank');
                } catch (\Exception $e) {
                    DB::rollBack();
                }
                Toastr::error('Operation Failed', 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        $tables = \App\tableList::getTableList('question_bank_id', $id);

        try {
            if ($tables == null) {
                $online_question = SmQuestionBank::find($id);
                if ($online_question->type == "M") {
                    SmQuestionBankMuOption::where('question_bank_id', $online_question->id)->delete();
                }

                $online_question->delete();

                Toastr::success('Operation successful', 'Success');
                return redirect('question-bank');
            } else {
                $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
                Toastr::error($msg, 'Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            $msg = 'This data already used in  : ' . $tables . ' Please remove those data first';
            Toastr::error($msg, 'Failed');
            return redirect()->back();
        }
    }

    //bulk import question bank
    public function import_question_bank()
    {
        return view('backEnd.examination.import_question_bank');
    }


    //download sample file
    public function downloadQuestionbankFile()
    {
        try {
            $staffsArray = ['role_id', 'department_id', 'designation_id', 'gender_id', 'current_address', 'basic_salary', 'fathers_name', 'mothers_name', 'marital_status', 'date_of_birth', 'date_of_joining', 'emergency_mobile', 'permanent_address', 'qualification', 'experience', 'epf_no', 'contract_type', 'location', 'bank_account_name', 'bank_account_no', 'bank_name', 'bank_brach', 'facebook_url', 'twiteer_url', 'linkedin_url', 'instragram_url', 'driving_license', 'mobile', 'email', 'first_name', 'last_name'];


            return Excel::create('staffs', function ($excel) use ($staffsArray) {
                $excel->sheet('staffs', function ($sheet) use ($staffsArray) {
                    $sheet->fromArray($staffsArray);
                });
            })->download('xlsx');
        } catch (\Exception $e) {
            Toastr::error('Operation Failed', 'Failed');
            return redirect()->back();
        }
    }


    //question bank bulkstore
       public function bulkstore(Request $request)
    {
        $request->validate(
            [
                'file' => 'required'
            ],
            [
                'file.required' => 'file is required.'
            ]
        );

        $file_type = strtolower($request->file->getClientOriginalExtension());
        if ($file_type <> 'csv' && $file_type <> 'xlsx' && $file_type <> 'xls') {
            Toastr::warning('The file must be a file of type: xlsx, csv or xls', 'Warning');
            return redirect()->back();
        } else {
            QuestionbankBulkTemporary::where('user_id', Auth::user()->id)->delete();
            $path = $request->file('file');
            Excel::import(new QbanksImport, $request->file('file'), 's3', \Maatwebsite\Excel\Excel::XLSX);


            $data1 = QuestionbankBulkTemporary::where('user_id', Auth::user()->id)->get();

            //  echo "<pre>"; print_r($data1); die;



            $data = [];
            $i = 0;
            $j = '';
            foreach ($data1 as $key => $value) {
                if ($i == 0) {
                    $j = $value['id'];
                }

                $temp_group_id = DB::table('sm_question_groups')->select('id')->where('title', $value['group_name'])->first();
                $temp_class_id = DB::table('sm_classes')->select('id')->where('class_name', $value['class_name'])->first();
                $temp_section_id = DB::table('sm_sections')->select('id')->where('section_name', $value['section_name'])->first();

                if ($temp_group_id == "") {
                    Toastr::error('Group does not exist');
                    return redirect()->back();
                    exit;
                } else {
                    $value['group_id'] = $temp_group_id->id;
                }


                if ($temp_class_id == "") {
                    Toastr::error('Class does not exist');
                    return redirect()->back();
                    exit;
                } else {
                    $value['class_id'] = $temp_class_id->id;
                }


                if ($temp_section_id == "") {
                    Toastr::error('Section does not exist');
                    return redirect()->back();
                    exit;
                } else {
                    $value['section_id'] = $temp_section_id->id;
                }

            //   $sections_all =   $value['section_id'];
            //   $arr_section_id =  explode(",", $sections_all);
                // echo "<pre>"; print_r($arr_section_id); die;



                


                if ($value['question_type'] == 'M') {

                    if ($value['number_of_option'] == '') {
                        Toastr::error('The number of option field is required when question type is M.');
                        return redirect()->back();
                        exit;
                    }

                    if ($value['group_name'] == '') {
                        Toastr::error('The group field is required ');
                        return redirect()->back();
                        exit;
                    }

                    if ($value['class_name'] == '') {
                        Toastr::error('The class field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['section_name'] == '') {
                        Toastr::error('The Section field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['question'] == '') {
                        Toastr::error('The Question field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['marks'] == '') {
                        Toastr::error('The Marks field is required ');
                        return redirect()->back();
                        exit;
                    }
                }

                if ($value['question_type'] == 'F') {

                    if ($value['suitable_words'] == '') {
                        Toastr::error('The suitable words field is required when question type is F.');
                        return redirect()->back();
                        exit;
                    }

                    if ($value['group_name'] == '') {
                        Toastr::error('The group field is required ');
                        return redirect()->back();
                        exit;
                    }

                    if ($value['class_name'] == '') {
                        Toastr::error('The class field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['section_name'] == '') {
                        Toastr::error('The Section field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['question'] == '') {
                        Toastr::error('The Question field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['marks'] == '') {
                        Toastr::error('The Marks field is required ');
                        return redirect()->back();
                        exit;
                    }
                }

                if ($value['question_type'] == 'T') {

                    if ($value['true_false'] == '') {
                        Toastr::error('The True or False field is required when question type is T.');
                        return redirect()->back();
                        exit;
                    }

                    if ($value['group_name'] == '') {
                        Toastr::error('The group field is required ');
                        return redirect()->back();
                        exit;
                    }

                    if ($value['class_name'] == '') {
                        Toastr::error('The class field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['section_name'] == '') {
                        Toastr::error('The Section field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['question'] == '') {
                        Toastr::error('The Question field is required ');
                        return redirect()->back();
                        exit;
                    }
                    if ($value['marks'] == '') {
                        Toastr::error('The Marks field is required ');
                        return redirect()->back();
                        exit;
                    }
                }



              

                if ($value['group_name'] == '' && $value['class_name'] == '' && $value['section_name'] == '' && $value['question_type'] == '' && $value['question'] == '' && $value['marks'] == '' && $value['number_of_option'] == '' && $value['option'] == '' && $value['suitable_words'] == '' && $value['true_false'] == '') {
                } else {
                    $data[$i] = $value;
                    $data[$i]['id'] = $j;
                    $i++;
                    $j++;
                }
            }

            // echo "<pre>"; print_r($data); die;


            if (!empty($data)) {
                // try {
                $result = "";
                foreach ($data as $key => $value) {
                    $string = $value['section_id'];
                    $section_id = explode(",", $string);

                    $string1 = $value['option'];
                    $options = explode(",", $string1);

                    if ($value['question_type'] == 'True/false' || $value['question_type'] == 'Fill in the blanks') {
                        //echo "ist"; die;
                        foreach ($section_id as $section) {
                            $online_question = new SmQuestionBank();
                            $online_question->type = substr($value['question_type'], 0, 1);
                            $online_question->q_group_id = $value['group_id'];
                            $online_question->class_id = $value['class_id'];
                            $online_question->section_id = $section;
                            $online_question->marks = $value['marks'];
                            $online_question->question = $value['question'];
                            $online_question->school_id = Auth::user()->school_id;
                            $online_question->academic_id = getAcademicId();
                            if ($value['question_type'] == "Fill in the blanks") {
                                $online_question->suitable_words = $value['suitable_words'];
                            } elseif ($value['question_type'] == "True/false") {
                                $online_question->trueFalse = $value['true_false'];
                            }
                            $result = $online_question->save();
                        }
                    } elseif ($value['question_type'] == 'MI') {
                        //echo "2nd"; die;
                    } else {
                        // echo "3rd"; die;
                        foreach ($section_id as $section) {

                            $online_question = new SmQuestionBank();
                            $online_question->type =  substr($value['question_type'], 0, 1);
                            $online_question->q_group_id = $value['group_id'];
                            $online_question->class_id = $value['class_id'];
                            $online_question->section_id = $section;
                            $online_question->marks = $value['marks'];
                            $online_question->question = $value['question'];
                            $online_question->number_of_option = $value['number_of_option'];
                            $online_question->school_id = Auth::user()->school_id;
                            $online_question->academic_id = getAcademicId();
                            $online_question->save();
                            $online_question->toArray();
                            $i = 0;
                            if (isset($options)) {
                                foreach ($options as $option) {
                                    $i++;
                                    $option_check = 'option_check_' . $i;
                                    $online_question_option = new SmQuestionBankMuOption();
                                    $online_question_option->question_bank_id = $online_question->id;
                                    $online_question_option->title = $option;
                                    $online_question_option->school_id = Auth::user()->school_id;
                                    $online_question_option->academic_id = getAcademicId();
                                    if (isset($request->$option_check)) {
                                        $online_question_option->status = 1;
                                    } else {
                                        $online_question_option->status = 0;
                                    }
                                    $result  =    $online_question_option->save();
                                }
                            }
                        }
                    }
                }  //main loop end


                if ($result) {
                    Toastr::success('Operation successful', 'Success');
                    return redirect()->back();
                } else {
                    Toastr::error('Operation Failed', 'Failed');
                    return redirect()->back();
                }

                // } catch (\Exception $e) {
                //     Toastr::error('Operation Failed', 'Failed');
                //     return redirect()->back();
                // }
                // Toastr::success('Operation successful', 'Success');
                // return redirect('staff-directory');
            }
        }
    }
}
