<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Child_Category extends Model
{
    protected $table='child_category';

    public $fillable=[
    'id_category',
    'child_category_name',
    'child_category_desc'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category','id_category');
    }
}
