<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    public function guests() {
        return $this->hasMany('App\Guest');
    }

    public function getAddressee() {
        return $this->guests->filter(function ($guest) {
            return ! is_null($guest->email);
        })->first();
    }
}
