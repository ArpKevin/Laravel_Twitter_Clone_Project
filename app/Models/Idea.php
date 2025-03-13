<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Idea extends Model
{
    use HasFactory;

    protected $with = ['user:id,name,image', 'comments.user:id,name,image'];

    protected $withCount = ['likes'];

    protected $fillable = [
        'content',
        'user_id'
    ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'idea_like', 'idea_id', 'user_id')->withTimestamps();
    }

    public function scopeSearch(Builder $query, $search = ""){
        if($search){
            $query->where('content','like','%'.$search.'%');
        }
    }
}
