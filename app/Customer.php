<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customer';

    public $fillable=[
    'customer_name',
    'customer_address',
    'customer_phone'
    ];

    public function project()
    {
        return $this->hasMany('App\Project');
    }

    public function contact()
    {
        return $this->hasMany('App\Contact', 'id_customer');
    }
}
