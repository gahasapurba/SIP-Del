<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'receiver_users_id',
        'content',
        'file',
    ];

    protected $hidden = [
        
    ];

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_users_id', 'id');
    }
}
