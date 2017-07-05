<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public function invitations() {
        return $this->hasMany('App\Invitation');
    }

    public function getCapacity() {
        if ($this->type === 'round') {
            return 10;
        }
        if ($this->type === 'rectangle') {
            return 8;
        }
    }

    public function getTotalGuests() {
        $result = 0;
        foreach($this->invitations as $invitation) {
            $result += $invitation->guests->count();
        }
        return $result;
    }

    public function getCssClass() {
        if ($this->getTotalGuests() > $this->getCapacity()) {
            return 'over-capacity';
        }

        if ($this->getTotalGuests() == $this->getCapacity()) {
            return 'full-capacity';
        }
        return 'has-room';
    }
}
