<?php
namespace App\Http\Controllers;
use App\Models\Clan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ClanController extends Controller
{
    public function index() { return response()->json(Clan::where('is_published', true)->latest()->get()); }
    public function adminIndex() { return response()->json(Clan::latest()->get()); }
    public function store(Request $request) { $data = $request->validate(['name'=>'required|string|max:150','awitong'=>'nullable|string|max:150','majority_location'=>'nullable|string|max:190','description'=>'nullable|string|max:2000','image'=>'nullable|image|max:5120','is_published'=>'boolean']); if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('clans','public'); return response()->json(Clan::create($data), 201); }
    public function update(Request $request, Clan $clan) { $data = $request->validate(['name'=>'required|string|max:150','awitong'=>'nullable|string|max:150','majority_location'=>'nullable|string|max:190','description'=>'nullable|string|max:2000','image'=>'nullable|image|max:5120','is_published'=>'boolean']); if ($request->hasFile('image')) { if ($clan->image) Storage::disk('public')->delete($clan->image); $data['image'] = $request->file('image')->store('clans','public'); } $clan->update($data); return response()->json($clan); }
    public function destroy(Clan $clan) { if ($clan->image) Storage::disk('public')->delete($clan->image); $clan->delete(); return response()->json(['message'=>'Clan deleted.']); }
}
