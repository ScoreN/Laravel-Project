<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostUserLikes extends Model
{
    use HasFactory;

    

    protected $table = 'post_user_likes';
    protected $guarded = false;
    //protected $primaryKey = "like_id";
}
