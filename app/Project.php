<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table='project';

    public $fillable=[
    'project_name',
    'project_number',
    'project_customer',
    'project_category',
    'status',
    'contract_date',
    'contract_number'
    ];

    public function category()
    {
        return $this->belongsTo('App\Child_Category','project_category');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer','project_customer');
    }

}
