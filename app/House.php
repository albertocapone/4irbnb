<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'houses';

    public function services()
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
        return $this->belongsToMany(Ad::class)
                            ->withPivot('ending_date', 'transaction_code')
                            ->withTimestamps();
    }

    public function views() {
        return $this->hasMany(View::class);
    }
}
