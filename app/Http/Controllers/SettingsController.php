<?php
namespace App\Http\Controllers;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
class SettingsController extends Controller {
    public function show() { return response()->json(SiteSetting::pluck('value','key')); }
    public function update(Request $request) {
        $data=$request->validate(['settings'=>'required|array']);
        foreach($data['settings'] as $key=>$value) SiteSetting::updateOrCreate(['key'=>$key],['value'=>is_scalar($value)?(string)$value:json_encode($value)]);
        return $this->show();
    }
}
