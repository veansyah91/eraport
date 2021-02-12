<?php

namespace App\Helpers;

use App\Inventory;
use Illuminate\Support\Facades\DB;

class InventoryHelper
{
    public static function goodInventoryItem($id)
    {
        $check = Inventory::where('inventory_item_id', $id)->where('keterangan', 'BAIK')->first();

        return $check ? $check->jumlah : 0;
    }

    public static function badInventoryItem($id)
    {
        $check = Inventory::where('inventory_item_id', $id)->where('keterangan', 'RUSAK')->first();

        return $check ? $check->jumlah : 0;
    }
}