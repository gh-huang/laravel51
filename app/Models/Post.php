<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;
    public $dateFormat = 'U';
    protected $fillable = ['title', 'content', 'user_id'];

    //softdeletes
    protected $dates = ['delete_at'];
}
