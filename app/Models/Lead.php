<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'title',
        'description',
        'is_referral',
        'referrer',
        'revenue',
        'potential_users',
        'user_id',
        'client_id',
        'lead_stage_id',
        'order',
    ];
    
    public function stage()
    {
        return $this->belongsTo(LeadStage::class, 'lead_stage_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    

    public function client(){
        return $this->belongsTo(Client::class);
    }}
