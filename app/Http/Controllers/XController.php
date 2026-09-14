<?php
namespace App\Http\Controllers;
use App\Models\XPost;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
class XController extends Controller {
    public function index() { return response()->json(XPost::latest('published_at')->take(12)->get()); }
    public function sync() {
        $token=config('services.x.bearer_token'); $username=ltrim((string) config('services.x.username'), '@');
        if(!$token || !$username) return response()->json(['message'=>'X integration is not configured. Add X_USERNAME and X_BEARER_TOKEN to .env.'],422);
        $user=Http::withToken($token)->get('https://api.x.com/2/users/by/username/'.rawurlencode($username),['user.fields'=>'username,name'])->throw()->json('data');
        if(!$user || empty($user['id'])) return response()->json(['message'=>'X account not found.'],422);
        $resp=Http::withToken($token)->get('https://api.x.com/2/users/'.$user['id'].'/tweets',[ 'max_results'=>20, 'exclude'=>'replies,retweets', 'tweet.fields'=>'created_at,attachments,public_metrics', 'expansions'=>'attachments.media_keys', 'media.fields'=>'url,preview_image_url,type' ])->throw();
        $json=$resp->json(); $media=collect($json['includes']['media']??[])->keyBy('media_key');
        foreach($json['data']??[] as $tweet){ $urls=[]; foreach($tweet['attachments']['media_keys']??[] as $key){ $m=$media->get($key); if($m && ($m['url']??$m['preview_image_url']??null)) $urls[]=$m['url']??$m['preview_image_url']; }
            XPost::updateOrCreate(['tweet_id'=>$tweet['id']],['text'=>$tweet['text'],'url'=>'https://x.com/'.$username.'/status/'.$tweet['id'],'author_username'=>$username,'media'=>$urls,'published_at'=>$tweet['created_at']??now()]); }
        return response()->json(['message'=>'X posts synced.','posts'=>XPost::latest('published_at')->take(12)->get()]);
    }
}
