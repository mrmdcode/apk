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
        return view('Dashboard.Company.motorView',compact('motor','logs'));
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
