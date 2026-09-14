<?php
namespace App\Http\Controllers;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class PartnerController extends Controller
{
    public function index() { return response()->json(Partner::where('is_published', true)->latest()->get()); }
    public function adminIndex() { return response()->json(Partner::latest()->get()); }
    public function store(Request $request) { $data = $request->validate(['name'=>'required|string|max:190','category'=>'nullable|string|max:120','description'=>'nullable|string|max:2000','website_url'=>'nullable|url|max:1000','logo'=>'nullable|image|max:5120','is_published'=>'boolean']); if ($request->hasFile('logo')) $data['logo'] = $request->file('logo')->store('partners','public'); return response()->json(Partner::create($data), 201); }
    public function update(Request $request, Partner $partner) { $data = $request->validate(['name'=>'required|string|max:190','category'=>'nullable|string|max:120','description'=>'nullable|string|max:2000','website_url'=>'nullable|url|max:1000','logo'=>'nullable|image|max:5120','is_published'=>'boolean']); if ($request->hasFile('logo')) { if ($partner->logo) Storage::disk('public')->delete($partner->logo); $data['logo'] = $request->file('logo')->store('partners','public'); } $partner->update($data); return response()->json($partner); }
    public function destroy(Partner $partner) { if ($partner->logo) Storage::disk('public')->delete($partner->logo); $partner->delete(); return response()->json(['message'=>'Partner deleted.']); }
}
