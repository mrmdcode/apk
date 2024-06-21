<?php

namespace App\Console\Commands;

use App\Jobs\Process;
use App\Models\MotorData;
use Illuminate\Console\Command;

class DataProcess extends Command
{

    protected $signature = 'app:processing';

    protected $description = 'Command description';
    public function handle()
    {
        $data = MotorData::where('process',null)->get();

        foreach ($data as $value) {
            $redata = json_decode($value->data, true);
            $payload = explode('->', $value->event->payload);
            $da = $redata[$payload[0]][$payload[1]];
            Process::dispatch($da,$value);
        }
        echo "cunt : ".$data->count();
    }
}
