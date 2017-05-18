<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function guests() {
        return $this->hasMany('App\Guest');
    }
}
