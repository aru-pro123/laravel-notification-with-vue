<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['id', 'type', 'data', 'read_at', 'notifiable_type', 'notifiable_id'];

    protected $casts = [
        'data' => 'object',
    ];
}
