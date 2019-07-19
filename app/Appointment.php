<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $guarded = [];

    protected $attributes = [];

    protected $dates = ['date'];

    public function customer() {
      return $this->belongsTo('App\Customer');
    }
}
