<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = [
        'client_id',
        'servico',
        'date',
        'hora',
        'status'
    ];
    public function client()
    {
        return $this->hasOne(Cliente::class, 'id', 'client_id');
    }
}
