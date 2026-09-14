<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class XPost extends Model
{
    protected $fillable = ['tweet_id','text','url','author_username','media','published_at'];
    protected $casts = ['media'=>'array','published_at'=>'datetime'];
}
