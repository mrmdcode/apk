<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyMotors extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = [
        "company_seller_id" ,
        "company_buyer_id" ,
        "motor_name" ,
        "motor_model" ,
        "motor_year" ,
        "motor_start" ,
        "motor_serial" ,
        "motor_address" ,
        'motor_description' ,
        "allowable_winding_temperature" ,
        "allowable_bearing_temperature" ,
        "hungarian_vibration" ,
        "latitude",
        "longitude",
        "file_1" ,
        "file_2" ,
        "file_3" ,
    ];

    public function buyer()
    {
        return $this->belongsTo(UserCompany::class, "company_buyer_id",'id');
    }
    public function seller(){
        return $this->belongsTo(UserCompany::class, "company_seller_id",'id',);
    }
    public function events(){
        return $this->hasMany(MotorEvent::class,"motor_id","id");
    }

    public function data()
    {
        return $this->hasMany(MotorData::class,"motor_id","id");
    }
}
