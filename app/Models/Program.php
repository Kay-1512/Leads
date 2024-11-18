<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
   protected $fillable = [
        'order',
        'due_date',
        'title',
        'description',
        'assigned_user_id',
        'program_stage_id',
    ];


    public function column(){
        return $this->belongsTo(Column::class);
    }
}
