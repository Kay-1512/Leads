<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'colour',
        'phone',
        'email',
        'province_id',
        'representative_id',
        'sales_person_id',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function representatives()
    {
        return $this->hasMany(User::class, 'representative_id');
    }

    public function salesperson()
    {
        return $this->belongsTo(User::class, 'sales_person_id', 'id');
    }
}
