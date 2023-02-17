<?php

namespace App\Imports;




use App\StaffBulkTemporary;



use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class StaffsImport implements ToModel, WithStartRow, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        

        $dob = null;
        $admission_date = date('Y-m-d');

        if (gv($row, 'date_of_birth')) {
            $dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d');
        }


        if (gv($row, 'admission_date')) {
            $admission_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['admission_date'])->format('Y-m-d');
        }

        // $userCount = StaffBulkTemporary::where('email', $row['email']);
        // $alredy_email =  $userCount->count();
        // if ($alredy_email > 0) {
        //     Toastr::error('Email already exist');
        // }
        //  else {
            return new StaffBulkTemporary([

                "role_name" => @$row['role'],
                "department_name" => @$row['department'],
                "designation_name" => @$row['designation'],
                "gender_name" => @$row['gender'],
                "current_address" => @$row['current_address'],
                "basic_salary" => @$row['basic_salary'],


                "fathers_name" => @$row['fathers_name'],
                "mothers_name" => @$row['mothers_name'],
                "marital_status" => @$row['marital_status'],
                "date_of_birth" => @$row['date_of_birth'],
                "date_of_joining" => @$row['date_of_joining'],
                "emergency_mobile" => @$row['emergency_mobile'],
                "permanent_address" => @$row['permanent_address'],
                "qualification" => @$row['qualification'],
                "experience" => @$row['experience'],
                "epf_no" => @$row['epf_no'],
                "contract_type" => @$row['contract_type'],
                "location" => @$row['location'],
                "bank_account_name" => @$row['bank_account_name'],
                "bank_account_no" => @$row['bank_account_no'],
                "bank_name" => @$row['bank_name'],
                "bank_brach" => @$row['bank_brach'],
                "facebook_url" => @$row['facebook_url'],
                "twiteer_url" => @$row['twiteer_url'],
                "linkedin_url" => @$row['linkedin_url'],
                "instragram_url" => @$row['instragram_url'],
                "driving_license" => @$row['driving_license'],



                "mobile" => @$row['mobile'],
                "email" => @$row['email'],
                "first_name" => @$row['first_name'],
                "last_name" => @$row['last_name'],
                "user_id" => Auth::user()->id
            ]);
        //}
    }


    public function startRow(): int
    {
        return 2;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
