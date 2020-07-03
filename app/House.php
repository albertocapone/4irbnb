<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'houses';

    public function service()
    {
        return $this->belongsToMany(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function ads()
    {
        return $this->belongsToMany(Ad::class);
    }

    public function views() {
        return $this->hasMany(View::class);
    }
}
