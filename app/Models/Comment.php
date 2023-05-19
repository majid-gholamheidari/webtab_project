<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'admin_id',
        'parent_id',
        'status',
        'text'
    ];

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function adminReplay()
    {
        return $this->hasOne(Comment::class, 'parent_id', 'id')->where('admin_id', '!=', null);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id', 'admin_id');
    }
}
