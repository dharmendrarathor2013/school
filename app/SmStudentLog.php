<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SmStudentLog extends Model
{
    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function role(){
    	return $this->belongsTo('Modules\RolePermission\Entities\InfixRole', 'role_id', 'id');
    }
}
