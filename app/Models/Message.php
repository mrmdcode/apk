<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    protected $fillable =[
        'type',
        'company_sender',
        'company_receiver',
        'message',
        'seen_at',
        'priority',
    ];

    public function sender()
    {
        $this->belongsTo(UserCompany::class, 'company_sender','id');
    }

    public function receiver()
    {
        $this->belongsTo(UserCompany::class, 'company_receiver','id');
    }

}
