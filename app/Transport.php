<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable = [
        'name', 'color', 'year', 'status', 'type_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function type()
    {
        return $this->belongsTo(TransportType::class);
    }
}
