<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class PaymentSetting extends Model
{
    protected $fillable = ['method','label','details','sort_order','is_active'];
    protected $casts = ['details'=>'array','is_active'=>'boolean'];
}
