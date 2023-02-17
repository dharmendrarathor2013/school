<?php

namespace App\Imports;




use App\QuestionbankBulkTemporary;



use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Auth;

class QbanksImport implements ToModel, WithStartRow, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        
   $temp = $row['question'];
   
        
        $dob = null;
        $admission_date = date('Y-m-d');

        if (gv($row, 'date_of_birth')) {
            $dob = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth'])->format('Y-m-d');
        }


        if (gv($row, 'admission_date')) {
            $admission_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['admission_date'])->format('Y-m-d');
        }
  
            return new QuestionbankBulkTemporary([

                "group_name" => @$row['group'],
                "class_name" => @$row['class'],
                "section_name" => $row['section'],
                "question_type" => @$row['question_type'],
                "question" => @$row['question'],
                "marks" => @$row['marks'],
                "number_of_option" => @$row['number_of_option'],
                "option" => @$row['option'],
                "suitable_words" => @$row['suitable_words'],
                "true_false" => @$row['true_false'],
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
