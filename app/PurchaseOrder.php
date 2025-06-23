<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Supplier;
use App\PurchaseOrderItem;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_number', 'supplier_id', 'order_date', 'expected_delivery_date', 'notes'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}
