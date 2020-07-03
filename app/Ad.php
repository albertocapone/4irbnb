<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    public function houses()
    {
        return $this->belongsToMany(House::class);
    }
}
