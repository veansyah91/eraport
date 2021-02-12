<?php

namespace App\Http\Controllers\Admin;

use App\Inventory;
use App\InventoryItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index()
    {
        $inventoryItems = InventoryItem::all();
        $inventories = Inventory::all();
        return view('inventories.index', compact('inventoryItems','inventories'));
    }

    public function createInventoryItem()
    {
        $inventoryItems = InventoryItem::all();
        return view('inventories.create', compact('inventoryItems'));
    }

    public function storeInventoryItem(Request $request)
    {
        $request->validate([
            'nama_item' => 'required|unique:inventory_items',
            ]
        );

        $createInventory = InventoryItem::create([
            'nama_item' => $request->nama_item
        ]);
        return redirect('/create-inventory-item')->with('status','Item Inventaris Berhasil Dibuat');
    }

    public function destroyInventoryItem($id)
    {
        $deleteInventory = InventoryItem::find($id)->delete();
        return redirect('/create-inventory-item')->with('status','Item Inventaris Berhasil Berhasil Dihapus');
    }

    public function storeInventory(InventoryItem $item,Request $request)
    {
        $createInventory = Inventory::updateOrCreate([
            'inventory_item_id' => $item->id,
            'keterangan' => $request->keterangan],[
            'jumlah' => $request->jumlah
        ]);
        
        return redirect('/inventories')->with('status', 'Inventaris Berhasil Diatur');
    }
}
