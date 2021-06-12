<?php 

namespace App\Helpers;

use App\UpLevel;
use App\Helpers\YearHelper;

class UpLevelHelper {
    
    public static function getStatus($studentId)
    {   
        return $uplevel = UpLevel::where('student_id', $studentId)->where('semester_id', YearHelper::thisSemester())->first();
    }
}