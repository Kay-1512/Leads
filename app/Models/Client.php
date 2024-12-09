<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        "name",
        'user_id',
        'phone',
        'email',
        'province_id',
        "contact_person_id",
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function representatives()
    {
        return $this->hasMany(User::class, 'representative_id');
    }

    public function contact_person()
    {
        return $this->belongsTo(User::class, 'contact_person_id', 'id');
    }
}
