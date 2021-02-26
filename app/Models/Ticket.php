<?php

namespace App\Models;

use App\Events\TicketCreated;
use App\Events\TicketCreating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public static $STATUS = ['opened', 'investigating', 'closed'];
    
    public $incrementing = false;

    protected $fillable = ['id','customer_name', 'description', 'email', 'phone', 'agent_id', 'status', 'invested_at'];

    protected $dispatchesEvents = [
        'creating' => TicketCreating::class,
        'saved' => TicketCreated::class
    ];

    protected $casts = [
        'invested_at' => 'datetime',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function reply()
    {
        return $this->hasOne(Reply::class);
    }
}
