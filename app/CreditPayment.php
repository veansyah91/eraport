<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditPayment extends Model
{
    protected $fillable = ['student_id', 'jumlah_bayar','tanggal_bayar'];

    public function getCreatedAtAttribute()
{
    return \Carbon\Carbon::parse($this->attributes['tanggal_bayar'])
        ->format('d, M Y H:i');
}

    public function student(){
        return $this->belongsTo('App\Student');
    }


}
