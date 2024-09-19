<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table='contact';

    public $fillable=[
    'id_customer',
    'contact_name',
    'contact_address',
    'contact_phone',
    'contact_email',
    'contact_others'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer','id_customer');
    }
}
