<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function plusOnes() {
        return $this->hasMany('App\Guests');
    }
}
