<?php
namespace App\Http\Controllers;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
class ContactController extends Controller {
    public function store(Request $request) {
        $data=$request->validate(['name'=>'required|string|max:120','email'=>'required|email|max:190','phone'=>'nullable|string|max:50','subject'=>'nullable|string|max:190','message'=>'required|string|max:5000']);
        $msg=ContactMessage::create($data);
        try { Mail::raw("New Won Nyaci Run contact message\n\nName: {$msg->name}\nEmail: {$msg->email}\nPhone: {$msg->phone}\nSubject: {$msg->subject}\n\n{$msg->message}", function(Message $mail) use($msg){ $mail->to(config('mail.from.address'))->subject('Won Nyaci Run: '.$msg->subject); }); } catch(\Throwable $e) { report($e); }
        return response()->json(['message'=>'Thank you. Your message has been received.'],201);
    }
    public function index() { return response()->json(ContactMessage::latest()->paginate(20)); }
    public function read(ContactMessage $contactMessage) { $contactMessage->update(['is_read'=>true]); return response()->json($contactMessage); }
}
