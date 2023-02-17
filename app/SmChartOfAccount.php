<?php

namespace App;

use App\Scopes\ActiveStatusSchoolScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SmChartOfAccount extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();
  
        static::addGlobalScope(new ActiveStatusSchoolScope);
    }
    
}