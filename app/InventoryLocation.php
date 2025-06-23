<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLocation extends Model
{
    protected $fillable = ['name', 'code', 'description'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'location_id');
    }
}
