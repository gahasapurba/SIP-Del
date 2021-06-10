<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'categories_id',
        'title',
        'company_name',
        'price',
        'description',
        'purchasing_status',
        'payment_slip',
    ];

    protected $hidden = [
        
    ];

    public function author()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'purchases_id', 'id');
    }
}
