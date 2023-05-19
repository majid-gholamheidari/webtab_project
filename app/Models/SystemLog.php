<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemLog extends Model
{
    protected $fillable = [
        'model',
        'data',
        'action',
        'admin_id',
        'ip',
        'user_agent',
    ];

    protected $casts = [
        'user_agent' => 'array',
        'data' => 'array'
    ];
}
