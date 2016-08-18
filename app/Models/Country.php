<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name'];

    public function posts()
    {
    	return $this->hasManyThrough('App\Models\Post', 'App\Models\User');
    }
}
