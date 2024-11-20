<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStage extends Model
{
    protected $fillable = [
        'name', 'order', 'board_id',
    ];

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public function coordinators()
    {
        return $this->hasMany(Program::class);
    }

    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
