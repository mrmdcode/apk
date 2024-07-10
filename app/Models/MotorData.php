<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotorData extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    protected $fillable = [
        'motor_id',
        "event_id",
        "data",
        "process",
    ];

    public function motor()
    {
        return $this->belongsTo(CompanyMotors::class,'motor_id','id');
    }

    public function event()
    {
        return $this->belongsTo(MotorEvent::class,'event_id','id');
    }
}
