<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Iten extends Model
{
    protected $fillable = [
        'ticket_id',
        'servico',
        'valor',
        'user_id'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
        # code...
    }

    public function user()
    {
        return $this->belongsTo(User::class);
        # code...
    }
}
