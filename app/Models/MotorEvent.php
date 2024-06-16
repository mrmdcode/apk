<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorEvent extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $fillable =[
        'motor_id',
        "name",
        "topic",
        'payload',
        'normal',
        'min',
        'max',

    ];

    public function motor()
    {
        return $this->belongsTo(CompanyMotors::class,'motor_id','id');
    }

    public function data()
    {
        return $this->hasMany(MotorData::class,'motor_id','id');
    }

}
