<?php

namespace App\Http\Controllers;

use App\Models\CompanyMotors;
use App\Models\MotorData;
use App\Models\MotorEvent;
use App\Models\User;
use App\Models\UserCompany;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminPanelController extends Controller
{
    public function dashboard()
    {
        $motor = CompanyMotors::all();
        $company = User::where('type','company')->count();
        $logs = MotorData::all()->count();
        $logsT = MotorData::where('created_at',">=",Carbon::today())->count();

        return view('Dashboard.Admin.dashboard',compact('motor','company','logs','logsT'));
    }

    public function motorLoc()
    {
        $motor = CompanyMotors::all()->map(function ($motor) {

            return [
                'text' => $motor->motor_name,
                'coordinates' => [$motor->latitude ,$motor->longitude],
                'color' => '#'.rand(111,999),
            ];
        });
        return response()->json($motor);
    }

    public function companyManager()
    {
        $users = User::where('type','company')->orderBy('created_at','desc')->get();
        return view('Dashboard.Admin.companyManager', compact('users'));
    }

    public function companyCreate()
    {
        return view('Dashboard.Admin.companyCreate');
    }

    public function companyStore(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|max:255|email|unique:users,email',
            'password' => 'required|max:255',
            'company_name' => 'required|string|max:255',
            'company_registration_number' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'legal_address_company' => 'required|string|max:255',
            'economic_code_company' => 'required|string|max:255',
            'postal_code_company' => 'required|string|max:255',
            'name_agent_company' => 'string|max:255',
            'phone_agent_company' => 'string|max:255',
            'national_ID' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);



        $user = User::create([
            'email' => $validatedData['email'],
            'password' => Hash::make('password'),
            'type' => 'company',
        ]);

        $validatedData['user_id'] = $user->id;

        UserCompany::create($validatedData);


        session()->flash('success',"ثبت شرکت با موفقیت به پایان رسید .");
        return redirect()->route('admin.companyManager');
    }

    public function companyUpdate(Request $request,$id)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_registration_number' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'legal_address_company' => 'required|string|max:255',
            'economic_code_company' => 'required|string|max:255',
            'postal_code_company' => 'required|string|max:255',
            'name_agent_company' => 'string|max:255',
            'phone_agent_company' => 'string|max:255',
            'national_ID' => 'required|string|max:255',
        ]);

        UserCompany::find($id)->update($validatedData);
        return redirect()->route('admin.companyManager');
    }

    public function companyDelete($user)
    {
        $company = User::find($user);

        return view('Dashboard.Admin.companyDelete', compact('company'));
    }
    public function companyDestroy($user)
    {
        $company = User::find($user);
        return [$company,$company->company,$company->company->boughtMotors,$company->company->soldMotors];
    }
    public function motorCreate()
    {
            $company = User::where('type','company')->orderBy('created_at','desc')->get();
            return view('Dashboard.Admin.motorCreate',compact('company'));
    }

    public function motorStore(Request $request)
    {
        $validatedData = $request->validate([
            'company_seller_id' => 'required|integer|exists:user_companies,id',
            'company_buyer_id' => 'required|integer|exists:user_companies,id',
            'motor_name' => 'required|string|max:255',
            'motor_model' => 'nullable|string|max:255',
            'motor_year' => 'required|string|max:10',
            'motor_serial' => 'required|string|max:255|unique:company_motors,motor_serial',
            'motor_address' => 'required|string|max:255',
            'motor_description' => 'required|string',
            'allowable_winding_temperature' => 'required|numeric',
            'allowable_bearing_temperature' => 'required|numeric',
            'hungarian_vibration' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'file_1' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'file_2' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'file_3' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $motor = new CompanyMotors();
        $motor->company_seller_id = $validatedData['company_seller_id'];
        $motor->company_buyer_id = $validatedData['company_buyer_id'];
        $motor->motor_name = $validatedData['motor_name'];
        $motor->motor_model = $validatedData['motor_model'];
        $motor->motor_year = $validatedData['motor_year'];
        $motor->motor_serial = $validatedData['motor_serial'];
        $motor->motor_address = $validatedData['motor_address'];
        $motor->motor_description = $validatedData['motor_description'];
        $motor->allowable_winding_temperature = $validatedData['allowable_winding_temperature'];
        $motor->allowable_bearing_temperature = $validatedData['allowable_bearing_temperature'];
        $motor->hungarian_vibration = $validatedData['hungarian_vibration'];
        $motor->latitude = $validatedData['latitude'];
        $motor->longitude = $validatedData['longitude'];

        if ($request->hasFile('file_1')) {
            $motor->file_1 = $request->file('file_1')->store('files', 'public');
        }

        if ($request->hasFile('file_2')) {
            $motor->file_2 = $request->file('file_2')->store('files', 'public');
        }

        if ($request->hasFile('file_3')) {
            $motor->file_3 = $request->file('file_3')->store('files', 'public');
        }

        $motor->save();

        session()->flash('success',"ثبت موتور با موفقیت به پایان رسید .");
        return redirect()->route('admin.motorManager');

    }

    public function motorManager()
    {
        $motors = CompanyMotors::orderBy('created_at','desc')->get();

        return view('Dashboard.Admin.motorManager',compact('motors'));
    }

    public function motorData()
    {
        $logs = MotorData::orderBy('created_at','desc')->get();
        return view('Dashboard.Admin.motorData',compact('logs'));
    }

    public function companyView($user)
    {
        $user = User::find($user);
        if ($user->company->type == 'seller') {
            $motors = $user->company->soldMotors;
        }
        elseif ($user->company->type == 'buyer') {
            $motors = $user->company->boughtMotors;
        }
        else{

            $motors = $user->company->soldMotors;
            $motors->merge($user->company->boughtMotors);
        }


//        return $motor;
        return view('Dashboard.Admin.companyView',compact('user','motors'));
    }

    public function companyEdit($user)
    {
        $user = User::find($user);
        return view('Dashboard.Admin.companyEdit',compact('user'));
    }

    public function companyMotors($user)
    {
        $user = User::find($user);
        if ($user->company->type == 'seller') {
            $motors = $user->company->soldMotors;
        }
        elseif ($user->company->type == 'buyer') {
            $motors = $user->company->boughtMotors;
        }
        else{

            $motors = $user->company->soldMotors;
            $motors->merge($user->company->boughtMotors);
        }
        return view('Dashboard.Admin.MotorManager', compact('motors'));
    }

    public function motorView($motorId)
    {
        $motor =     CompanyMotors::find($motorId);
        return view('Dashboard.Admin.motorView',compact('motor'));
    }

    public function MotorEvent($motorId)
    {
        $events = MotorEvent::where('motor_id',$motorId)->orderBy('created_at','desc')->get();
        return view('Dashboard.Admin.eventManager',compact('events'));
    }
}
