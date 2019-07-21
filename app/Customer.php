<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    protected $attributes = [
        'owner_first_name' => '',
        'owner_last_name' => '',
        'owner_email' => '',
        'owner_phone' => '',
        'pet_name' => '',
        'pet_type' => '',
        'pet_breed' => '',
        'address' => '',
        'address_line_2' => '',
        'city' => '',
        'state' => '',
        'zip' => ''
    ];

    protected $with = ['appointments'];

    public function appointments() {
        return $this->hasMany('App\Appointment')->orderBy('date', 'ASC');
    }
}
