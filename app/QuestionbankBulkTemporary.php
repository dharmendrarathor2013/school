<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionbankBulkTemporary extends Model
{
    protected $fillable  = ['group_name', 'class_name', 'section_name', 'question_type', 'question', 'marks', 'number_of_option', 'option', 'suitable_words', 'true_false', 'user_id'];
}
