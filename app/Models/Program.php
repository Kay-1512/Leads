<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
   protected $fillable = [
        'order',
        'start_date',
        'end_date',
        'title',
        'description',
        'program_stage_id',
    ];

    public function programStage(){
        return $this->belongsTo(ProgramStage::class);
    }
}
