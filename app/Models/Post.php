<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $guarded = false;
    protected $primaryKey = "post_id";

    public function Category(){
        return $this->belongsTo(Category::class);
    }

    public function Comment(){
        return $this->hasMany(Comment::class);
    }

    public function User(){
        return $this->belongsToMany(User::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter){
        return $filter->apply($builder);
    }
}
