<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Message extends Model
{
    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function parsed_created_at()
    {
        return Carbon::parse($this->created_at)->format('d-m-Y H:i:s');
    } 
}
