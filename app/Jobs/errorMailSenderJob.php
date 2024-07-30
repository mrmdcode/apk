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
            $motor = CompanyMotors::where('id', $this->motor_id)->first();
            $details = [
                "motor_name"=>$motor->name,
                "motor_serial"=>$motor->motor_serial,
                "datas"=>$motor->data()->with('event')->orderByDesc('created_at')->take(10)->get(),
                "company_buyer_name"=>$motor->buyer->company_name,
                "company_seller_name"=>$motor->seller->company_name,
                "company_buyer_mail"=>$motor->buyer->user->email,
                "company_seller_mail"=>$motor->seller->user->email,
                ];
            Mail::to($motor->seller->user->email)->send(new logErrorMail($details));
            Mail::to($motor->buyer->user->email)->send(new logErrorMail($details));
            Mail::to(env("SUPERVISOR_MAIL"))->send(new logErrorMail($details));

//            Mail::to($motor->buyer->user->email,$motor->seller->user->email)->send(new logErrorMail($details));
            echo 'success';
        }
        catch (\Exception $e){
            echo "how err ".$e->getMessage()."\n";
        }
    }
}
