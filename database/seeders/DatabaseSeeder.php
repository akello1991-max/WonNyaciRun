<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\PaymentSetting;
use App\Models\SiteSetting;
use Illuminate\Support\Carbon;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::updateOrCreate(['email'=>env('ADMIN_EMAIL','admin@wonnyacirun.ug')],['name'=>'Won Nyaci Run Admin','password'=>env('ADMIN_PASSWORD','ChangeMe!2026'),'is_admin'=>true]);
        SiteSetting::updateOrCreate(['key'=>'tagline'],['value'=>'Running for our culture, our health & our future.']);
        SiteSetting::updateOrCreate(['key'=>'whatsapp'],['value'=>'256775384975']);
        SiteSetting::updateOrCreate(['key'=>'x_username'],['value'=>env('X_USERNAME') ?: 'AkaoGloriah']);
        PaymentSetting::updateOrCreate(['method'=>'mtn'],['label'=>'MTN MOBILE MONEY','details'=>['dial_code'=>'*165*4*4#','merchant_code'=>'WCCM','reference'=>'Sponsor’s Full Name','amount'=>'Enter your kit amount','note'=>'Use the official merchant flow shown in the supplied payment reference.'],'sort_order'=>1,'is_active'=>true]);
        PaymentSetting::updateOrCreate(['method'=>'airtel'],['label'=>'AIRTEL MONEY','details'=>['instruction'=>'Use the official Won Nyaci Run/Airtel Money merchant instructions.','reference'=>'Sponsor’s Full Name','amount'=>'UGX 30,000 standard kit'],'sort_order'=>2,'is_active'=>true]);
        PaymentSetting::updateOrCreate(['method'=>'stanbic'],['label'=>'STANBIC FLEXI-PAY','details'=>['instruction'=>'Use the official Stanbic Flexi-Pay option for the run.','reference'=>'Sponsor’s Full Name'],'sort_order'=>3,'is_active'=>true]);
        PaymentSetting::updateOrCreate(['method'=>'bank'],['label'=>'BANK TRANSFER','details'=>['bank'=>'CENTENARY','account_name'=>'WON NYACI ME LANGO','account_number'=>'310010849','note'=>'Verify account details against the latest official run notice before publishing/accepting payment.'],'sort_order'=>4,'is_active'=>true]);
        Post::updateOrCreate(['slug'=>'welcome-to-won-nyaci-run-2026'],['title'=>'Welcome to Won Nyaci Run 2026','excerpt'=>'Running for our culture, our health and our future.','body'=>"On 24 October 2026, Lango comes together at Old Akii Bua Stadium for a day of movement, culture and practical community impact.\n\nEvery kit contributes to a collective effort supporting free wheelchairs and crutches for people living with disabilities in Lango.\n\nRegistration and aerobics begin at 6:00 AM, with running at 7:30 AM.",'image'=>null,'published_at'=>Carbon::parse('2026-09-14 07:00'),'is_published'=>true]);
    }
}
