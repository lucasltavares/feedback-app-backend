<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'name',
        'email',
        'message',
        'rating',
        'business_id'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
