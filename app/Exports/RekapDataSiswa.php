<?php

namespace App\Exports;

use App\Student;
use App\SubLevel;
use App\Helpers\YearHelper;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class RekapDataSiswa implements FromQuery
{
    use Exportable;

    public function __construct(int $sublevel)
    {
        $this->sublevel = $sublevel;
        return $this;
    }

    public function query()
    {
        
        // return Student::dataSiswa($this->sublevel);
        return Student::query()->whereYear('created_at', 2020);
    }
}