<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'name', 'email', 'phone',
        'address', 'description'
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class);
    }
}
