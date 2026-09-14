<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PracticeResource extends Model
{
    protected $fillable = ['title', 'type', 'media_url', 'description', 'is_published'];
    protected function casts(): array { return ['is_published' => 'boolean']; }
}
