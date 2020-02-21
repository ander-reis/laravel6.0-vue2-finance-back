<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = ['user_id', 'description', 'operation'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
