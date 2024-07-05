<?php

namespace App\Jobs;

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
        echo $this->motor_id;
        $motor = CompanyMotors::find($this->motor_id);
        $toAddresses = [$motor->seller->user->email,$motor->buyer->user->email];
        var_dump($toAddresses);
        $mail = Mail::to('md2885ka2885@gmail.com')->send(new logErrorMail());
        var_dump($mail);
    }
}
