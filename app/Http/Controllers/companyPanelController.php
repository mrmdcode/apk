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


        $motor = CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->get();
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
        return view('Dashboard.Company.dashboard',compact('company','logs','logsT','logsE','lastmotor','motor'));
    }
    public function motorLoc()
    {
        $motor = CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->get()
            ->map(function ($motor) {

            return [
                'text' => $motor->motor_name,
                'coordinates' => [$motor->latitude ,$motor->longitude],
                'color' => '#'.rand(111,999),
            ];
        });
        return response()->json($motor);
    }

    public function motorManager()
    {
        $motors = CompanyMotors::where('company_buyer_id',auth()->user()->company->id)
            ->orWhere('company_seller_id',auth()->user()->company->id)
            ->orderBy('created_at','desc')->get();

        return view('Dashboard.company.motorManager',compact('motors'));
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
}