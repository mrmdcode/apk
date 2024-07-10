<?php

namespace App\Http\Controllers;

use App\Models\CompanyMotors;
use App\Models\MotorData;
use App\Models\MotorEvent;
use App\Models\User;
use App\Models\UserCompany;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class adminPanelController extends Controller
{
    public function dashboard()
    {
        $mess = appChatController::dontSeenMessages(auth()->user()->company->id);
        $motor = CompanyMotors::all();
        $motors = CompanyMotors::orderBy('created_at',"desc")->take(4)->get();
        $company = User::where('type','company')->count();
        $logs = MotorData::all()->count();
        $logsT = MotorData::where('created_at',">=",Carbon::today())->count();
        $logsE = MotorData::where('process','error')->count();
        $lastmotor = CompanyMotors::orderByDesc('id')->first('motor_name')['motor_name'];


//        return view('Dashboard.Admin.index');
        return view('Dashboard.Admin.dashboard',compact('motor','company','logs','logsE','logsT','lastmotor','mess','motors'));
    }

    public function motorLoc()
    {
        $motor = CompanyMotors::all()->map(function ($motor) {

            return [
                'url' => route('admin.motorView',$motor->id),
                'title' => $motor->motor_name,
                'latitude' => $motor->latitude ,
                'longitude' => $motor->longitude,
            ];
        });
        return response()->json($motor);
    }

    public function motorsData()
    {
        $data = MotorData::orderByDesc('created_at')->with(['motor','event'])->take(17)->get();
        return response()->json($data);
    }

    public function companyManager()
    {
        $users = User::where('type','company')->orderBy('created_at','desc')->paginate(10);
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
            'company_registration_number' => 'required|string|max:255',
            'company_address' => 'required|string|max:255',
            'legal_address_company' => 'nullable|string|max:255',
            'economic_code_company' => 'required|string|max:255',
            'postal_code_company' => 'required|string|max:255',
            'name_agent_company' => 'nullable|string|max:255',
            'phone_agent_company' => 'nullable|string|max:255',
            'national_ID' => 'required|string|max:255',
        ]);

        $bool = UserCompany::find($id)->update($validatedData);
        if ($bool)
            session()->flash('success',"اطلاعات شرکت بروزرسانی شد .");
        else
            session()->flash('error',"مشکلی در صبت اطلاعات شرکت به وجود آمده.");
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
        Log::emergency("کد شرکت پاک شد .", [$company,$company->company,$company->company->boughtMotors,$company->company->soldMotors]);


        session()->flash('success',"شرکت و موتور هایی که به آن فروخته شده و از آن خریداری شده پاک شد . و تمامی دیتا های مربوطه نیز پاک شد .");
        return redirect()->route('admin.companyManager');
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
        $events = [
            [
                'motor_id' => $motor->id,
                "name" => 'میانگین دما سیم پیچ',
                "topic" => 'motor_'.$motor->motor_serial.'_temperature',
                'payload'=>'d->temperature',
                'normal'=> 33.00,'min'=> 30.00,'max'=> 36.00,
            ],
            [
                'motor_id' => $motor->id,
                "name" => 'جریان 1',
                "topic" => 'motor_'.$motor->motor_serial.'_Current1',
                'payload'=>'d->Current1',
                'normal'=> 6.00,'min'=> 4.00,'max'=> 8.00,
            ],
            [
                'motor_id' => $motor->id,
                "name" => 'جریان 2',
                "topic" => 'motor_'.$motor->motor_serial.'_Current2',
                'payload'=>'d->Current2',
                'normal'=> 10.00,'min'=> 9.00,'max'=> 12.00,
            ],
            [
                'motor_id' => $motor->id,
                "name" => 'جریان 3',
                "topic" => 'motor_'.$motor->motor_serial.'_Current3',
                'payload'=>'d->Current3',
                'normal'=> 8.00,'min'=> 6.00,'max'=> 10.00,
            ],
            [
                'motor_id' => $motor->id,
                "name" => 'دمای محیط',
                "topic" => 'motor_'.$motor->motor_serial.'_ambtemperature',
                'payload'=>'d->ambtemperature',
                'normal'=> 29.00,'min'=> 27.00,'max'=> 30.00,
            ],
            [
                'motor_id' => $motor->id,
                "name" => 'لرزش سر عقب',
                "topic" => 'motor_'.$motor->motor_serial.'_vibration1',
                'payload'=>'d->vibration1',
                'normal'=> 29.00,'min'=> 27.00,'max'=> 30.00,
            ],
            [
                'motor_id' => $motor->id,
                "name" => 'لرزش سر جلو',
                "topic" => 'motor_'.$motor->motor_serial.'_vibration2',
                'payload'=>'d->vibration2',
                'normal'=> 29.00,'min'=> 27.00,'max'=> 30.00,
            ],

            ];
        MotorEvent::create($events[0]);
        MotorEvent::create($events[1]);
        MotorEvent::create($events[2]);
        MotorEvent::create($events[3]);
        MotorEvent::create($events[4]);
        MotorEvent::create($events[5]);
        MotorEvent::create($events[6]);



        session()->flash('success',"ثبت موتور با موفقیت به پایان رسید .هفت تا از رویداد های دیفالت اضافه شد .");
        return redirect()->route('admin.motorManager');

    }

    public function motorManager()
    {
        $motors = CompanyMotors::orderBy('created_at','desc')->paginate(10);

        return view('Dashboard.Admin.motorManager',compact('motors'));
    }

    public function motorData()
    {
        $logs = MotorData::orderBy('created_at','desc')->paginate(10);
        return view('Dashboard.Admin.motorData',compact('logs'));
    }

    public function motorError()
    {
        $logs = MotorData::orderBy('created_at','desc')->paginate(25);
        return view('Dashboard.Admin.motorError',compact('logs'));
    }
    public function motorErrorWithOutNormal()
    {
        $logs = MotorData::where('process','!=','normal')->orderBy('created_at','desc')->paginate(25);
        return view('Dashboard.Admin.motorError',compact('logs'));
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
        return view('Dashboard.Admin.motorManager', compact('motors'));
    }

    public function motorView($motorId)
    {
        $motor = CompanyMotors::find($motorId);
        $logs = $motor->data()->limit(8);
        return view('Dashboard.Admin.motorView',compact('motor','logs'));
    }

    public function MotorEvent($motorId)
    {
        $events = MotorEvent::where('motor_id',$motorId)->orderBy('created_at','desc')->get();
        return view('Dashboard.Admin.eventManager',compact('events','motorId'));
    }

    public function motorEventCreate($motorId)
    {
        $motor = CompanyMotors::where('id',$motorId)->first(['id','motor_name']);
        return view('Dashboard.Admin.eventCreate',compact('motor'));
    }

    public function motorEventStore(Request $request,$motorId)
    {
        MotorEvent::create([
            'motor_id' => $motorId,
            "name" =>$request->input('name'),
            "topic" =>$request->input('topic'),
            'payload'=>$request->input('payload'),
            'normal'=>$request->input('normal'),
            'min'=>$request->input('min'),
            'max'=>$request->input('max'),

        ]);
        session()->flash('success','ساخت اخطار با موفقیت به پایان رسید');
        return redirect()->route('admin.motorEvent');
    }

    public function motorEventEdit($eventId)
    {
        $event = MotorEvent::find($eventId);
        return view('Dashboard.Admin.eventEdit',compact('event'));
    }

    public function motorEventUpdate(Request $request,$eventId)
    {

        MotorEvent::find($eventId)->update($request->all());
        session()->flash('success','بروزرسانی اخطار با موفقیت به پایان رسید');
        return redirect()->route('admin.motorEvent',$request->input('motor_id'));

    }
    public function notfounded()
    {
        return abort(404,"صفحه در حال راه اندازی میباشد یا پیدا نشده .");
    }

    public function messages()
    {
        return view('Dashboard.Admin.messages');
    }
}
