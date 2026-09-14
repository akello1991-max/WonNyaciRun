<?php
namespace App\Http\Controllers;
use App\Models\PaymentSetting;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Models\XPost;
use App\Models\Clan;
use App\Models\PracticeResource;
use App\Models\Partner;
use Illuminate\Http\JsonResponse;
class PublicController extends Controller {
    public function home(): JsonResponse {
        return response()->json([
            'settings' => SiteSetting::pluck('value','key'),
            'payments' => PaymentSetting::where('is_active',true)->orderBy('sort_order')->get(),
            'posts' => Post::where('is_published',true)->whereNotNull('published_at')->latest('published_at')->take(6)->get(),
            'x_posts' => XPost::latest('published_at')->take(6)->get(),
            'clans' => Clan::where('is_published',true)->latest()->take(12)->get(),
            'practice' => PracticeResource::where('is_published',true)->latest()->get(),
            'partners' => Partner::where('is_published',true)->latest()->get(),
        ]);
    }
    public function posts(): JsonResponse {
        return response()->json(Post::where('is_published',true)->whereNotNull('published_at')->latest('published_at')->paginate(9));
    }
    public function post(string $slug): JsonResponse {
        $post = Post::where('slug',$slug)->where('is_published',true)->firstOrFail();
        return response()->json($post);
    }
    public function payments(): JsonResponse {
        return response()->json(PaymentSetting::where('is_active',true)->orderBy('sort_order')->get());
    }
    public function clans(): JsonResponse { return response()->json(Clan::where('is_published',true)->latest()->get()); }
    public function practice(): JsonResponse { return response()->json(PracticeResource::where('is_published',true)->latest()->get()); }
    public function partners(): JsonResponse { return response()->json(Partner::where('is_published',true)->latest()->get()); }
}
