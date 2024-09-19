<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';

    public $fillable=[
    'category_name','category_description'
    ];

    public function project()
    {
        return $this->hasMany('App\Project');
    }

    public function child()
    {
        return $this->hasMany('App\Child_Category','id_category');
    }
}
