<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Partner extends Model
{
    protected $fillable = ['name', 'category', 'description', 'website_url', 'logo', 'is_published'];
    protected function casts(): array { return ['is_published' => 'boolean']; }
}
