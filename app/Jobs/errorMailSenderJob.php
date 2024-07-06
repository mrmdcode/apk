<?php

namespace App\Jobs;

use App\Http\Controllers\appChatController;
use App\Mail\logErrorMail;
use App\Models\CompanyMotors;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class errorMailSenderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $motor_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($motor_id)
    {
        $this->motor_id = $motor_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            echo $this->motor_id;
            $motor = CompanyMotors::find($this->motor_id);
            if (!appChatController::checkLastMessageTime($motor->seller->user->id,2)){
                Mail::to($motor->seller->user->email)->send(new logErrorMail());
                    echo 'mail send';
                appChatController::store(null,$motor->seller->user->id,'your motor has error','superHigh','mail');
                    echo 'mail mess send';
                Mail::to($motor->buyer->user->email)->send(new logErrorMail());
                    echo 'mail send';
                appChatController::store(null,$motor->buyer->user->id,'your motor has error','superHigh','mail');
                    echo 'mail mess send';
            }
            appChatController::store(null,$motor->buyer->user->id,'your motor has error','superHigh','system');
            appChatController::store(null,$motor->seller->user->id,'your motor has error','superHigh','system');

        }
        catch (\Exception $e){
            var_dump($e);
        }
    }
}
