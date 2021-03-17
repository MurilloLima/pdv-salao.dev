<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'uid',
        'product_id',
        'qtd',
        'valor',
        'desc',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
        # code...
    }
}
