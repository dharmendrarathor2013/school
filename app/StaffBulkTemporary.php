<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffBulkTemporary extends Model
{
    protected $fillable  = ['role_name', 'department_name', 'designation_name', 'gender_name', 'current_address', 'basic_salary', 'fathers_name', 'mothers_name', 'marital_status', 'date_of_birth', 'date_of_joining', 'emergency_mobile', 'permanent_address', 'qualification', 'experience', 'epf_no', 'contract_type', 'location', 'bank_account_name', 'bank_account_no', 'bank_name', 'bank_brach', 'facebook_url', 'twiteer_url', 'linkedin_url', 'instragram_url', 'driving_license', 'mobile', 'email', 'first_name', 'last_name', 'user_id'];
}
