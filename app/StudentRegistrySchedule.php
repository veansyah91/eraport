<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentRegistrySchedule extends Model
{
    protected $fillable = ['tahun', 'mulai','akhir','kategori'];
}
