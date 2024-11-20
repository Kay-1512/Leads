<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        "name",
        'user_id',
        'phone',
        'province_id',
        
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function represantatives()
    {
        return $this->hasMany(User::class, 'representative_id');
    }

    public function contact_person()
    {
        return $this->belongsTo(User::class,'contact_person_id', 'id');
    }

}
