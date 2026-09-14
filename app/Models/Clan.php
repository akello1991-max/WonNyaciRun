<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Clan extends Model
{
    protected $fillable = ['name', 'awitong', 'majority_location', 'description', 'image', 'is_published'];
    protected function casts(): array { return ['is_published' => 'boolean']; }
}
