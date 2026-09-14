<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class AdminPostController extends Controller {
    public function index() { return response()->json(Post::latest()->paginate(20)); }
    public function store(Request $request) {
        $data=$request->validate(['title'=>'required|string|max:190','excerpt'=>'nullable|string|max:500','body'=>'required|string','image'=>'nullable|image|max:5120','published_at'=>'nullable|date','is_published'=>'boolean']);
        if($request->hasFile('image')) $data['image']=$request->file('image')->store('run-uploads','public');
        $data['slug']=$this->uniqueSlug($data['title']);
        Post::create($data);
        return response()->json(['message'=>'Post created.'],201);
    }
    public function update(Request $request, Post $post) {
        $data=$request->validate(['title'=>'required|string|max:190','excerpt'=>'nullable|string|max:500','body'=>'required|string','image'=>'nullable|image|max:5120','published_at'=>'nullable|date','is_published'=>'boolean']);
        if($request->hasFile('image')) { if($post->image) Storage::disk('public')->delete($post->image); $data['image']=$request->file('image')->store('run-uploads','public'); }
        $data['slug']=$this->uniqueSlug($data['title'],$post->id); $post->update($data);
        return response()->json(['message'=>'Post updated.']);
    }
    public function destroy(Post $post) { if($post->image) Storage::disk('public')->delete($post->image); $post->delete(); return response()->json(['message'=>'Post deleted.']); }
    private function uniqueSlug(string $title, ?int $ignore=null): string { $base=Str::slug($title); $slug=$base; $i=1; while(Post::where('slug',$slug)->when($ignore,fn($q)=>$q->where('id','!=',$ignore))->exists()) $slug=$base.'-'.(++$i); return $slug; }
}
