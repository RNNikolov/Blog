<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Role extends Authenticatable
{

    use HasFactory;
    use Notifiable;

    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

}
