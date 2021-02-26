<?php

namespace App\Models;

use App\Events\ReplyCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'agent_id',
        'ticket_id',
    ];
    protected $with = [
        'agent',
        'ticket'
    ];

    protected $dispatchesEvents = [
        'saved' => ReplyCreated::class
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }



    
}
