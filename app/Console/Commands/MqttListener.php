<?php

namespace App\Console\Commands;

use App\Models\CompanyMotors;
use App\Models\MotorData;
use App\Models\MotorEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class MqttListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mqtt-listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    function extractParts($input) {
        $firstUnderscorePos = strpos($input, '_');
        $secondUnderscorePos = strpos($input, '_', $firstUnderscorePos + 1);

        if ($firstUnderscorePos === false || $secondUnderscorePos === false) {
            return [null, null];
        }

        $number = substr($input, $firstUnderscorePos + 1, $secondUnderscorePos - $firstUnderscorePos - 1);

        $temperature = substr($input, $secondUnderscorePos + 1);

        return [$number, $temperature];
    }



    public function handle()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe('#', function (string $topic, string $message) {
            var_dump($this->extractParts($topic)[0] );
            $ME = MotorEvent::where('topic',$topic)->first();
            $CM = CompanyMotors::where('motor_serial',$this->extractParts($topic)[0])->first();
            $MD = MotorData::create([
                'motor_id'=>$CM->id,
                'event_id'=>$ME->id,
                'data'=>json_encode(json_decode($message)),
            ]);
            var_dump($MD->data);

        }, 1);
        $mqtt->loop(true);
    }
}
