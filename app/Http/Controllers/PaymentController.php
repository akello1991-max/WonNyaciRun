<?php
namespace App\Http\Controllers;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;
class PaymentController extends Controller {
    public function index() { return response()->json(PaymentSetting::orderBy('sort_order')->get()); }
    public function update(Request $request, PaymentSetting $paymentSetting) {
        $data=$request->validate(['label'=>'required|string|max:190','details'=>'required|array','sort_order'=>'integer|min:0','is_active'=>'boolean']);
        $paymentSetting->update($data); return response()->json($paymentSetting);
    }
}
