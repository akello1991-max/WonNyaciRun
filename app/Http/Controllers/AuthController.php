<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller {
    public function csrf() { return response()->json(['csrf'=>csrf_token()]); }
    public function login(Request $request) {
        $data=$request->validate(['email'=>'required|email','password'=>'required|string']);
        $user=User::where('email',$data['email'])->where('is_admin',true)->first();
        if(!$user || !Hash::check($data['password'],$user->password)) return response()->json(['message'=>'Invalid admin credentials.'],422);
        $request->session()->regenerate(); $request->session()->put('admin_authenticated',true); $request->session()->put('admin_user_id',$user->id);
        return response()->json(['user'=>['id'=>$user->id,'name'=>$user->name,'email'=>$user->email]]);
    }
    public function me(Request $request) {
        if(!$request->session()->get('admin_authenticated')) return response()->json(['authenticated'=>false]);
        $user=User::find($request->session()->get('admin_user_id'));
        return response()->json(['authenticated'=>(bool)$user,'user'=>$user?->only(['id','name','email'])]);
    }
    public function logout(Request $request) { $request->session()->invalidate(); $request->session()->regenerateToken(); return response()->json(['message'=>'Logged out.']); }
}
