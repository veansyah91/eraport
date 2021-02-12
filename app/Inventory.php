<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = ['jumlah','keterangan','inventory_item_id'];

    public function inventoryItem(){
        return $this->belongsTo('App\InventoryItem');
    }
}
