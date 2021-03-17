<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountHistory extends Model
{
    protected $fillable = [
        'tipo',
        'valor',
        'desc',
    ];
}
