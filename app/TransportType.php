<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportType extends Model
{

    public function transports()
    {
        return $this->hasMany(Transport::class,'type_id','id');
    }
}
