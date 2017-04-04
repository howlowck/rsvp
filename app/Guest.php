<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    public function invitation() {
        return $this->belongsTo('App\Invitation');
    }
}
