<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompany extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [
        "user_id",
        'company_name',
        "company_registration_number",
        "company_address",
        "legal_address_company",
        "economic_code_company",
        "postal_code_company",
        "name_agent_company",
        "phone_agent_company",
        "national_ID",
        "type",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function soldMotors()
    {
        return $this->hasMany(CompanyMotors::class, 'company_seller_id');
    }

    public function boughtMotors()
    {
        return $this->hasMany(CompanyMotors::class, 'company_buyer_id');
    }


    public function MotorData()
    {
        return $this->hasMany(MotorData::class, 'motor_id','id');
    }

}
