<?php

namespace App\Jobs;

use App\Mail\logErrorMail;
use App\Models\MotorData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class Process implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data ;
    public $value;
    public function __construct($data,$value)
    {
        $this->data = $data;
        $this->value = $value;
    }

    public function handle()
    {
            $value = MotorData::find($this->value->id);
            $motor_name = $value->motor->motor_name;

            if ($this->data == $value->event->normal){
                $value->process = 'normal';
                $value->processed_at = now();
                $value->save();
            }
            elseif ( $this->data > $value->event->min && $this->data  < $value->event->max){
                $value->process = 'warning';
                $value->processed_at = now();
                $value->save();
            }
            else{
                $value->process = 'error';
                $value->processed_at = now();
                $value->save();
                errorMailSenderJob::dispatch($value->motor_id);
            }

            echo '|----------------------------------------'."\n"
                .'| motor name : '.$motor_name ."\n"
                .'| event name : '.$value->event->name."\n"
                .'| data : '.$this->data.' | normal : '.$value->event->min.' < '.$value->event->normal.' > '.$value->event->max."\n"
                .'| result: '.$value->process."\n"
                .'|----------------------------------------'."\n"
            ;




    }
}
