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

    //Query Scopes
    public function scopePopular($query)
    {
    	return $query->where('user_id', 1);
    }

    public function scopeStatus($query, $status = 1)
    {
    	return $query->where('status', $status);
    }

    //one belone to 
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    //Polymorphic relations
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'item');
    }

    //polymorphic relations to many
    public function tags()
    {
        return $this->morphToMany('App\Models\Tag', 'taggable');
    }
}
