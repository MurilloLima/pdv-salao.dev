<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'cliente_id',
        'status',
        'token',
        'payment',
        'n_parcelas',
        'valor_dinheiro',
        'valor_cartao',
        'total'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
        # code...
    }

    public function itens()
    {
        return $this->hasMany(Iten::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($ticket) { // before delete() method call this
            $ticket->itens()->delete();
            // do the rest of the cleanup...
        });
    }

}
