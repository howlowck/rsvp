<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function invitations() {
        return $this->hasMany('App\Invitation');
    }
}
