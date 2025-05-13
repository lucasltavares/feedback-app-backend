<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasUuids;

    protected $table = 'business';

    protected $fillable = [
            'name',
            'description',
            'address',
            'city',
            'state',
            'zip',
            'phone',
            'website',
            'email',
            'logo',
            'social_media'
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * App\Models\User
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
