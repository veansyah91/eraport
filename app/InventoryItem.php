<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = ['nama_item'];

    public function inventory(){
        return $this->hasMany('App\Inventory');
    }
}
