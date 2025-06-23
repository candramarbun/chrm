<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code', 'description'];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'category_id');
    }
}
