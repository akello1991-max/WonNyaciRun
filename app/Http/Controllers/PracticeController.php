<?php
namespace App\Http\Controllers;
use App\Models\PracticeResource;
use Illuminate\Http\Request;
class PracticeController extends Controller
{
    public function index() { return response()->json(PracticeResource::where('is_published', true)->latest()->get()); }
    public function adminIndex() { return response()->json(PracticeResource::latest()->get()); }
    public function store(Request $request) { $data = $request->validate(['title'=>'required|string|max:190','type'=>'required|in:video,audio,link','media_url'=>'required|url|max:1000','description'=>'nullable|string|max:2000','is_published'=>'boolean']); return response()->json(PracticeResource::create($data), 201); }
    public function update(Request $request, PracticeResource $practiceResource) { $data = $request->validate(['title'=>'required|string|max:190','type'=>'required|in:video,audio,link','media_url'=>'required|url|max:1000','description'=>'nullable|string|max:2000','is_published'=>'boolean']); $practiceResource->update($data); return response()->json($practiceResource); }
    public function destroy(PracticeResource $practiceResource) { $practiceResource->delete(); return response()->json(['message'=>'Practice resource deleted.']); }
}
