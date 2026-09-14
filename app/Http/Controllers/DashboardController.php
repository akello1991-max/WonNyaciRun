<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage;
use App\Models\Post;
use App\Models\XPost;
class DashboardController extends Controller {
    public function index(){ return response()->json(['posts'=>Post::count(),'published'=>Post::where('is_published',true)->count(),'messages'=>ContactMessage::where('is_read',false)->count(),'x_posts'=>XPost::count()]); }
}
