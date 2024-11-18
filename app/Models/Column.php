<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $fillables = [
        'board_id',
        'name',
        'order'
    ];

    public function board()
    {
        return $this->belongsTo(Board::class);    
    }

    public function programs()
    {
        return $this->hasMany(Program::class);    
    }

}
