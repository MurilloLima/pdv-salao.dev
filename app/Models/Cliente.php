<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'name',
        'cpf',
        'fone',
        'date_nasc',
        'avatar'
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'cliente_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($user) { // before delete() method call this
            $user->tickets()->delete();
            // do the rest of the cleanup...
        });
    }
}
