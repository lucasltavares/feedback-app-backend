<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Customer extends Model
{
    use HasUuids;

    protected $table = 'customers';

    protected $fillable = [
        'first_name',
        'email',
        'phone',
        'age',
        'region',
        'feedbacks_count',
    ];
}
