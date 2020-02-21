<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'record';

    protected $fillable = [
        'user_id',
        'account_id',
        'category_id',
        'amount',
        'type',
        'date',
        'description',
        'tags',
        'note'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
