<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $guarded = ['id'];

    public function getAvatar($image){
        if($image==''){
            return asset('img/user.png');
        }
        return asset('img/'.$image);
    }
}


