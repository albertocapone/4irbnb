<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    public function houses()
    {
        return $this->belongsToMany(House::class);
    }
}
