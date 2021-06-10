<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'purchases_id',
        'name',
        'quantity',
        'price_per_item',
        'price_total_item',
    ];

    protected $hidden = [
        
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchases_id', 'id');
    }
}
