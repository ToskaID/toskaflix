<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
      protected $fillable = [
        'title',
        'price',
        'duration',
        'resolution',
        'max_devices',
    ];

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function users() 
    {
        return $this->belongsToMany(User::class, 'memberships', 'plan_id', 'user_id');
    }
}
