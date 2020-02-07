<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = ['nama_sekolah','nss','alamat','desa','kecamatan','kota','provinsi','website','email','status','npsn'];
}
