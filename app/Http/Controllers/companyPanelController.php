<?php

namespace App\Http\Controllers;

use App\Models\CompanyMotors;
use App\Models\MotorData;
use App\Models\MotorEvent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class companyPanelController extends Controller
{


    public function motorCheck($MotorId )
    {
        if (CompanyMotors::where('id',$MotorId)->where('company_buyer_id',auth()->user()->company->id)->first())
            return ['bool'=>true,'type'=>'buyer']; //خریدار
        elseif (CompanyMotors::where('id',$MotorId)->where('company_seller_id',auth()->user()->company->id)->first())
            return ['bool'=>true,'type'=>'seller']; //فروشنده
        elseif (!CompanyMotors::where('id',$MotorId)->where('company_seller_id',auth()->user()->company->id)->first())
            return ['bool'=>false,'type'=>null];
        else{
            return abort(500);
        }
    }
    public function dashboard()
    {


        $motors = CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->get();
        $motor = $motors;
        $company = User::where('type','company')->count();
        $MCids =CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->pluck('id');
        $logs = MotorData::whereIn('motor_id',$MCids)->get();

        $logsT = $logs->where('created_at',">=",Carbon::today())->count();
        $logsE = $logs->where('process','error')->count();
        $lastmotor = CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
        ->orWhere('company_seller_id',auth()->user()->company->id)
        ->orderByDesc('id')->first('motor_name')['motor_name'];

        $logs = $logs->count();
        return view('Dashboard.Company.dashboard',compact('company','logs','logsT','logsE','motor','lastmotor','motors'));
    }
    public function motorLoc()
    {
        $motor = CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->get()
            ->map(function ($motor) {

                return [
                    'url' => route('company.motorView.en',$motor->id),
                    'title' => $motor->motor_name,
                    'latitude' => $motor->latitude ,
                    'longitude' => $motor->longitude,
                ];
            });
        return response()->json($motor);
    }
    public function motorsDatas()
    {
        $motor = CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->get('id')->map(function ($item) {return $item->id;});
        $data = MotorData::whereIn('id',$motor)->orderByDesc('created_at')->get(['id','data','process','created_at']);
        return response()->json($data);
    }

    public function motorsData()
    {
        $data = MotorData::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->orderByDesc('created_at')
            ->with(['motor','event'])
            ->take(17)
            ->get();
        return response()->json($data);
    }
    public function motorManager()
    {
        $motors = CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->orderBy('created_at','desc')->paginate(10);

        return view('Dashboard.Company.motorManager',compact('motors'));
    }

    public function motorViewData($motorId)
    {
        $motor = CompanyMotors::where('id',$motorId)->with('events.data')->orderBy('created_at','desc')->first();
        return response()->json($motor);
    }
    public function motorView($motorId)
    {
        $motor = CompanyMotors::find($motorId);
        $logs = $motor->data()->limit(8);
        $d =  $motor->events()->where('payload','=','d->Current1')->first()->data()->orderBy('created_at','ASC')->get();
        function calculate_times_and_switches($data) {
            $total_time = 0;
            $off_time = 0;
            $on_time = 0;
            $off_count = 0;
            $on_count = 0;
            $last_time = null;
            $last_status = null;

            foreach ($data as $entry) {
                $timestamp = $entry['created_at'];
                $status = $entry['data'];

                $time = strtotime($timestamp);

                if ($last_time !== null) {
                    $elapsed_time = ($time - $last_time);
                    $total_time += $elapsed_time;

                    if ($last_status == "0") {
                        $off_time += $elapsed_time;
                        if ($status != "0") {
                            $on_count++;
                        }
                    } else {
                        $on_time += $elapsed_time;
                        if ($status == "0") {
                            $off_count++;
                        }
                    }
                }

                $last_time = $time;
                $last_status = $status;
            }

            // اگر موتور هنوز خاموش یا روشن است و داده‌ها تمام شده‌اند
            if ($last_time !== null) {
                $current_time = time();
                $elapsed_time = ($current_time - $last_time);
                $total_time += $elapsed_time;

                if ($last_status == "0") {
                    $off_time += $elapsed_time;
                } else {
                    $on_time += $elapsed_time;
                }
            }

            return [
                'total_time' => $total_time / 3600, // به ساعت
                'off_time' => $off_time / 3600, // به ساعت
                'on_time' => $on_time / 3600, // به ساعت
                'off_count' => $off_count,
                'on_count' => $on_count
            ];
        }
        $data = calculate_times_and_switches($d);
        return view('Dashboard.Company.motorView',compact('motor','logs','data'));
    }

    public function motorData()
    {
        $MCids =CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->pluck('id');
        $logs = MotorData::whereIn('motor_id',$MCids)->orderByDesc('created_at')->paginate(10);;
        return view('Dashboard.Company.motorData',compact('logs'));
    }

    public function motorError()
    {
        $MCids =CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->pluck('id');
        $logs = MotorData::whereIn('motor_id',$MCids)->orderByDesc('created_at')->paginate(10);;
        return view('Dashboard.Company.motorError',compact('logs'));
    }
    public function motorErrorWithOutNormal()
    {
        $MCids =CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->pluck('id');
        $logs = MotorData::whereIn('motor_id',$MCids)->where('process','!=','normal')->orderByDesc('created_at')->paginate(10);;
        return view('Dashboard.Company.motorError',compact('logs'));
    }

    public function motorEvent($motorId)
    {
        if ($this->motorCheck($motorId)['bool']){
            $events = MotorEvent::where('motor_id',$motorId)->orderBy('created_at','desc')->get();
            return view('Dashboard.Company.eventManager',compact('events'));
        }
        else
            return abort(403,'you are not access to this page');
    }
    public function messages()
    {
        return view('Dashboard.Company.messages');
    }

    public function motorMonitor($motorId)
    {
        $motor = CompanyMotors::find($motorId);
        return view('Dashboard.Supervisor.motorListener',compact('motor'));
    }

    public function motorMonitorData($motorId,$sellerId,$buyerId)
    {
        $motor = CompanyMotors::where('id',$motorId)
            ->where('company_buyer_id',$buyerId)
            ->where('company_seller_id',$sellerId)
            ->with('events.data')
            ->orderBy('created_at','desc')
            ->first();
        return response()->json($motor);
    }
}
