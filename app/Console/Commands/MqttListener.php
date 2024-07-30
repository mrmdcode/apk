<?php

namespace App\Console\Commands;

use App\Events\MqttPublishEvent;
use App\Jobs\errorMailSenderJob;
use App\Jobs\Process;
use App\Models\CompanyMotors;
use App\Models\MotorData;
use App\Models\MotorEvent;
use App\Services\MqttService;
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


    public function handless()
    {
        $mqtt = MQTT::connection();
        $mqtt->subscribe('#', function (string $topic, string $message) {
            var_dump($topic,$message);
        });
        $mqtt->loop(true);

    }
    public function handle()
    {
        try {
            $mqtt = MQTT::connection();
            $mqtt->subscribe('#', function (string $topic, string $message) {
//                            var_dump($topic);
                $ME = MotorEvent::where('topic',$topic)->first();
                $CM = CompanyMotors::where('motor_serial',$this->extractParts($topic)[0])->first();
                $payload = explode('->', $ME->payload);
                $data = json_decode($message,true)[$payload[0]][$payload[1]];
                if ($data == $ME->normal) {
                    MotorData::create([
                        'motor_id' => $CM->id,
                        'event_id' => $ME->id,
                        'data' => $data,
                        'process' => 'normal'
                    ]);
                    echo '|----------------------------------------'."\n"
                        .'| motor name : '.$CM->motor_name ."\n"
                        .'| event name : '.$ME->name."\n"
                        .'| data : '.$data.' | normal : '.$ME->min.' < '.$ME->normal.' > '.$ME->max."\n"
                        .'| result: Normal'."\n"
                        .'|----------------------------------------'."\n"
                    ;
                }
                elseif ( $data > $ME->min && $data  < $ME->max){
                    MotorData::create([
                        'motor_id' => $CM->id,
                        'event_id' => $ME->id,
                        'data' => $data,
                        'process' => 'warning'
                    ]);
                    echo '|----------------------------------------'."\n"
                        .'| motor name : '.$CM->motor_name ."\n"
                        .'| event name : '.$ME->name."\n"
                        .'| data : '.$data.' | normal : '.$ME->min.' < '.$ME->normal.' > '.$ME->max."\n"
                        .'| result: Warning'."\n"
                        .'|----------------------------------------'."\n"
                    ;
                }
                else {
                    MotorData::create([
                        'motor_id' => $CM->id,
                        'event_id' => $ME->id,
                        'data' => $data,
                        'process' => 'error'
                    ]);
                    event(new MqttPublishEvent('notife/app',
                        json_encode(
                            [
                                "d"=>[
                                    'company_seller'=>$CM->seller->id,
                                    'company_buyer'=>$CM->buyer->id,
                                    'alarm'=>$ME->name,
                                    'motor'=>$CM->motor_name,
                                    'status'=>1,

                                ]
                            ]
                        )));
                    echo '|----------------------------------------'."\n"
                        .'| motor name : '.$CM->motor_name ."\n"
                        .'| event name : '.$ME->name."\n"
                        .'| data : '.$data.' | normal : '.$ME->min.' < '.$ME->normal.' > '.$ME->max."\n"
                        .'| result: Error'."\n"
                        .'|----------------------------------------'."\n"
                    ;
                    errorMailSenderJob::dispatch($CM->id);
                }










                var_dump($topic);
                var_dump($data);

            }, 1);
            $mqtt->loop(true);
        } catch (\Exception $e) {
            // در صورت بروز خطا، پیام خطا را ذخیره و نمایش دهید
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
