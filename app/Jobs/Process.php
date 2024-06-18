<?php

namespace App\Jobs;

use App\Models\MotorData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Process implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = MotorData::where('process',null)->get();
        foreach ($data as $value) {
            $redata =json_decode($value->data,true);
            $payload = explode('->',$value->event->payload);
            $da = $redata[$payload[0]][$payload[1]];

            if ($da == $value->event->normal){
                $value->process = 'normal';
                $value->processed_at = now();
                $value->save();
            }
            elseif ( $da > $value->event->min && $da < $value->event->max){
                $value->process = 'warning';
                $value->processed_at = now();
                $value->save();
            }
            else{
                $value->process = 'error';
                $value->processed_at = now();
                $value->save();
            }


        }

    }
}
