<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function houses()
    {
        return $this->belongsTo(House::class);
    }
}
