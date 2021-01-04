<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = ['age', 'bio', 'address', 'city', 'zip'];

    public function user()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    /**
     * Get the user's image.
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
