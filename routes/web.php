<?php

use App\Http\Controllers\appChatController;
use App\Mail\logErrorMail;
use App\Models\CompanyMotors;
use App\Models\MotorData;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
//    return appChatController::dontSeenMessages(auth()->user()->company->id);
    return redirect()->route('login');
//    return view('Emails.logError');
//\Illuminate\Support\Facades\Mail::to('mdka2885mdka@gmail.com')
//    ->send(new \App\Mail\logErrorMail('d'));
//    $users = \App\Models\CompanyMotors::with('data')->get();
//    return response()->json($users);
//    return  [$motor->seller->user->email,$motor->buyer->user->email];
//    $mail = Mail::to('md2885ka2885@gmail.com')->send(new logErrorMail());



});


Auth::routes([

    'register' => false, // Register Routes...

    'reset' => false, // Reset Password Routes...

    'verify' => false, // Email Verification Routes...

]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{motorId}/{sellerId}/{sellerName}/{buyerId}/{buyerName}/{motorName}/motorListener',[\App\Http\Controllers\companyPanelController::class,'motorMonitor'])->name('motor.listener');
Route::prefix("dashboard")->middleware(['auth'])->group(function (){
    Route::get('/',[\App\Http\Controllers\HomeController::class,'choiser']);
    Route::middleware('aCA')->prefix("admin")->group(function (){
        Route::get("/",[\App\Http\Controllers\adminPanelController::class,'dashboard'])->name('admin.dashboard');
        Route::get("/motorLoc",[\App\Http\Controllers\adminPanelController::class,'motorLoc'])->name('admin.motorLoc');
        Route::get("/motorsData",[\App\Http\Controllers\adminPanelController::class,'motorsData'])->name('admin.motorsData');
        Route::get("/motorsDatas",[\App\Http\Controllers\adminPanelController::class,'motorsDatas'])->name('admin.motorsDatas');


        Route::get("companyManager",[\App\Http\Controllers\adminPanelController::class,'companyManager'])->name('admin.companyManager');
        Route::get("/companyCreate",[\App\Http\Controllers\adminPanelController::class,'companyCreate'])->name('admin.companyCreate');
        Route::post("/companyStore",[\App\Http\Controllers\adminPanelController::class,'companyStore'])->name('admin.companyStore');
        Route::get("/company/motors/{id}/",[\App\Http\Controllers\adminPanelController::class,'companyMotors'])->name('admin.companyMotors');
        Route::get("/company/{id}/",[\App\Http\Controllers\adminPanelController::class,'companyView'])->name('admin.companyView');
        Route::get("/company/Edit/{id}/",[\App\Http\Controllers\adminPanelController::class,'companyEdit'])->name('admin.companyEdit');
        Route::put("/company/Update/{id}/",[\App\Http\Controllers\adminPanelController::class,'companyUpdate'])->name('admin.companyUpdate');
        Route::get("/company/delete/{id}/",[\App\Http\Controllers\adminPanelController::class,'companyDelete'])->name('admin.companyDelete');
        Route::delete("/company/destroy/{id}/",[\App\Http\Controllers\adminPanelController::class,'companyDestroy'])->name('admin.companyDestroy');





        Route::get("/motorManager",[\App\Http\Controllers\adminPanelController::class,'motorManager'])->name('admin.motorManager');
        Route::get("/motorManager/{motorId}",[\App\Http\Controllers\adminPanelController::class,'motorView'])->name('admin.motorView');
        Route::get("/motorManager/{motorId}/data",[\App\Http\Controllers\adminPanelController::class,'motorViewData'])->name('admin.motor.data');
        Route::get("/motor/edit/{motorId}",[\App\Http\Controllers\adminPanelController::class,'notfounded'])->name('admin.motorEdit');
        Route::get("/motorCreate",[\App\Http\Controllers\adminPanelController::class,'motorCreate'])->name('admin.motorCreate');
        Route::post("/motorStore",[\App\Http\Controllers\adminPanelController::class,'motorStore'])->name('admin.motorStore');
        Route::get("/motorManager/delete/{motorId}",[\App\Http\Controllers\adminPanelController::class,'notfounded'])->name('admin.motorDelete');
        Route::delete("/motorManager/destroy/{motorId}",[\App\Http\Controllers\adminPanelController::class,'notfounded'])->name('admin.motorDestroy');



        Route::get("events/{motorId}",[\App\Http\Controllers\adminPanelController::class,'motorEvent'])->name('admin.motorEvent');
        Route::get("/eventCreate/{motorId}",[\App\Http\Controllers\adminPanelController::class,'motorEventCreate'])->name('admin.motorEventCreate');
        Route::post("/eventStore/{motorId}",[\App\Http\Controllers\adminPanelController::class,'motorEventStore'])->name('admin.motorEventStore');
        Route::get("/eventEdit/{motorId}",[\App\Http\Controllers\adminPanelController::class,'motorEventEdit'])->name('admin.motorEventEdit');
        Route::put("/eventUpdate/{motorId}",[\App\Http\Controllers\adminPanelController::class,'motorEventUpdate'])->name('admin.motorEventUpdate');


        Route::get("/motorData",[\App\Http\Controllers\adminPanelController::class,'motorData'])->name('admin.motorData');
        Route::get("/motorLog/{motorId}/{userId}/{startReceived}/{endReceived}/{boolProcess}/{startTimeProcess}/{endTimeProcess}",[\App\Http\Controllers\adminPanelController::class,'motorLogsAPI'])->name('admin.motorLogs.api');
        Route::get("/motorError",[\App\Http\Controllers\adminPanelController::class,'motorError'])->name('admin.motorError');
        Route::get("/motorError/motorErrorWithOutNormal",[\App\Http\Controllers\adminPanelController::class,'motorErrorWithOutNormal'])->name('admin.motorErrorWON');


        Route::prefix('messages')->group(function (){
            Route::get('/',[\App\Http\Controllers\adminPanelController::class,'messages'])->name('admin.messages');
            Route::get('/init',[\App\Http\Controllers\appChatController::class,'initAdmin'])->name('admin.messages.init');
            Route::get('/giveMessages/{targetId}',[\App\Http\Controllers\appChatController::class,'giveMessages'])->name('admin.messages.GM');
            Route::post('/sendMessages/{targetId}',[\App\Http\Controllers\appChatController::class,'sendCTC'])->name('admin.messages.sendCTC');
        });
    });
    Route::prefix('company')->middleware(['aCC'])->group(function (){
        Route::get('/',function (){return redirect()->route('company.dashboard');});
        Route::prefix('FA')->group(function (){
            Route::get('/',[\App\Http\Controllers\companyPanelController::class,'dashboard'])->name('company.dashboard');
            Route::get('motorLoc',[\App\Http\Controllers\companyPanelController::class,'MotorLoc'])->name('company.MotorLoc');
            Route::get("/motorsData",[\App\Http\Controllers\companyPanelController::class,'motorsData'])->name('company.motorsData');
            Route::get("/motorsDatas",[\App\Http\Controllers\companyPanelController::class,'motorsDatas'])->name('company.motorsDatas');
            Route::get('motorManager',[\App\Http\Controllers\companyPanelController::class,'MotorManager'])->name('company.motorManager');
            Route::get("/motorManager/{motorId}/data",[\App\Http\Controllers\companyPanelController::class,'motorViewData'])->name('company.motor.data');
            Route::get('motorView/{id}',[\App\Http\Controllers\companyPanelController::class,'MotorView'])->name('company.motorView');
            Route::get('eventManager/{id}',[\App\Http\Controllers\companyPanelController::class,'motorEvent'])->name('company.motorEvent');
            Route::get('eventView/{id}',[\App\Http\Controllers\companyPanelController::class,'eventView'])->name('company.eventView');
            Route::get('motorData',[\App\Http\Controllers\companyPanelController::class,'motorData'])->name('company.motorData');
            Route::get('motorError',[\App\Http\Controllers\companyPanelController::class,'motorError'])->name('company.motorError');
            Route::get("/motorError/motorErrorWithOutNormal",[\App\Http\Controllers\companyPanelController::class,'motorErrorWithOutNormal'])->name('company.motorErrorWON');
            Route::get('messages',[\App\Http\Controllers\companyPanelController::class,'messages'])->name('company.messages');
            Route::post('message',[\App\Http\Controllers\companyPanelController::class,'messageStore'])->name('company.messageStore');
            Route::prefix('messages')->group(function (){
                Route::get('/',[\App\Http\Controllers\companyPanelController::class,'messages'])->name('company.messages');
                Route::get('/init',[\App\Http\Controllers\appChatController::class,'initCompany'])->name('admin.messages.init');
                Route::get('/giveMessages/{targetId}',[\App\Http\Controllers\appChatController::class,'giveMessages'])->name('company.messages.GM');
                Route::post('/sendMessages/{targetId}',[\App\Http\Controllers\appChatController::class,'sendCTC'])->name('company.messages.sendCTC');
            });

        });
        Route::prefix('EN')->group(function (){
            Route::get('/',[\App\Http\Controllers\companyEnPanelController::class,'dashboard'])->name('company.dashboard.en');
            Route::get('motorManager',[\App\Http\Controllers\companyEnPanelController::class,'MotorManager'])->name('company.motorManager.en');
            Route::get('motorView/{id}',[\App\Http\Controllers\companyEnPanelController::class,'MotorView'])->name('company.motorView.en');
            Route::get('eventManager',[\App\Http\Controllers\companyEnPanelController::class,'EventManager'])->name('company.eventManager.en');
            Route::get('eventView/{id}',[\App\Http\Controllers\companyEnPanelController::class,'eventView'])->name('company.eventView.en');
            Route::get('motorData',[\App\Http\Controllers\companyEnPanelController::class,'motorData'])->name('company.motorData.en');
            Route::get('motorError',[\App\Http\Controllers\companyEnPanelController::class,'motorError'])->name('company.motorError.en');
            Route::get("/motorError/motorErrorWithOutNormal",[\App\Http\Controllers\companyEnPanelController::class,'motorErrorWithOutNormal'])->name('company.motorErrorWON');
            Route::get('messages',[\App\Http\Controllers\companyEnPanelController::class,'messages'])->name('company.messages.en');


        });

    });
    Route::prefix('supervisor')->group(function (){
        Route::get('/',[\App\Http\Controllers\Supervisor\SupervisorController::class,'dashboard'])->name('supervisor.dashboard');
    });
});





















//
// Route::get('init',function (){
//     $u0 = \App\Models\User::create([
//         "type"=>"admin",
//         "email"=>"a@a.a",
//         "password"=> \Illuminate\Support\Facades\Hash::make('123456789'),
//     ]);
//     $u1 = \App\Models\User::create([
//         "type"=>"company",
//         "email"=>"b@a.a",
//         "password"=> \Illuminate\Support\Facades\Hash::make('123456789'),
//     ]);
//      $u2 = \App\Models\User::create([
//         "type"=>"company",
//         "email"=>"c@a.a",
//         "password"=> \Illuminate\Support\Facades\Hash::make('123456789'),
//     ]);
//
//     $u3 = \App\Models\User::create([
//         "type"=>"company",
//         "email"=>"d@a.a",
//         "password"=> \Illuminate\Support\Facades\Hash::make('123456789'),
//     ]);
//     $c0 = \App\Models\UserCompany::create([
//         "user_id" => $u0->id,
//         'company_name' => "اسرار پایش کوشا",
//         "company_registration_number"=>rand(111111111111,999999999999),
//         "company_address"=>"خراسان رضوی ،سبزوار ، بالا تر از فهمیده پایین تر از سراه استثنایی، پلاک 6666 ",
//         "legal_address_company" => "lorem ipsum",
//         "economic_code_company" => rand(111111111111,999999999999),
//         "postal_code_company" => rand(111111111111,999999999999) ,
//         "national_ID" => rand(111111111111,999999999999) ,
//         "type" => "both",
//     ]);
//     $c1 = \App\Models\UserCompany::create([
//        "user_id" => $u1->id,
//        'company_name' => "شرکت جمکو",
//        "company_registration_number"=>rand(111111111111,999999999999),
//        "company_address"=>"خراسان رضوی ،سبزوار ، بالا تر از فهمیده پایین تر از سراه استثنایی، پلاک 6666 ",
//        "legal_address_company" => "lorem ipsum",
//        "economic_code_company" => rand(111111111111,999999999999),
//        "national_ID" => rand(111111111111,999999999999) ,
//        "postal_code_company" => rand(111111111111,999999999999) ,
//        "type" => "seller",
//    ]);
//
//     $c2 =\App\Models\UserCompany::create([
//         "user_id" => $u2->id,
//         'company_name' => "شرکت سیمان جوین",
//         "company_registration_number"=>rand(111111111111,999999999999),
//         "company_address"=>"خراسان رضوی ،سبزوار ، بالا تر از لاله پایین تر از سراه شرق سیلو، پلاک 6666 ",
//         "legal_address_company" => "lorem ipsum",
//         "economic_code_company" => rand(111111111111,999999999999),
//         "postal_code_company" => rand(111111111111,999999999999) ,
//         "national_ID" => rand(111111111111,999999999999) ,
//         "type" => "buyer",
//     ]);
//
//     $c3 = \App\Models\UserCompany::create([
//         "user_id" => $u3->id,
//         'company_name' => "شرکت سیمان مشهد ",
//         "company_registration_number"=>rand(111111111111,999999999999),
//         "company_address"=>"خراسان رضوی ،مشهد ، بالا تر از لاله پایین تر از سراه شرق سیلو، پلاک 6666 ",
//         "legal_address_company" => "lorem ipsum",
//         "economic_code_company" => rand(111111111111,999999999999),
//         "postal_code_company" => rand(111111111111,999999999999) ,
//         "national_ID" => rand(111111111111,999999999999) ,
//         "type" => "buyer",
//     ]);
//
//     $m1 = \App\Models\CompanyMotors::create([
//         'company_seller_id' => $c1->id,
//         'company_buyer_id' => $c2->id,
//         'motor_name' => 'هاوند',
//         'motor_model' => 'irani',
//         'motor_year' => '1400/05/02',
//         'motor_start' => '1400/09/01',
//         'motor_serial' => '140005024507806',
//         'motor_address' => 'پایین تر از مدرسه افق دانش 4 بین کلوتای سدید',
//         'motor_description' => 'این توضیحات تستی برای موتور هست',
//         'allowable_winding_temperature' => 4.5,
//         'allowable_bearing_temperature' => 5.4,
//         'hungarian_vibration' => 55,
//         'latitude' => '36.472235364352464',
//         'longitude' => '57.535571863832885',
//         'file_1' => null,
//         'file_2' => null,
//         'file_3' => null,
//     ]);
//
//     $m2 = \App\Models\CompanyMotors::create([
//         'company_seller_id' => $c1->id,
//         'company_buyer_id' => $c3->id,
//         'motor_name' => 'هاوند 2',
//         'motor_model' => 'usa',
//         'motor_year' => '1400/01/01',
//         'motor_start' => '1400/09/01',
//         'motor_serial' => '140005024507805',
//         'motor_address' => 'پایین تر از مدرسه افق دانش 4 بین کلوتای سدید',
//         'motor_description' => 'این توضیحات تستی برای موتور هست',
//         'allowable_winding_temperature' => 4.5,
//         'allowable_bearing_temperature' => 5.4,
//         'hungarian_vibration' => 55,
//         'latitude' => '36.216804023978504',
//         'longitude' => '57.68365143421714',
//         'file_1' => null,
//         'file_2' => null,
//         'file_3' => null,
//     ]);
//
//     $e1 = \App\Models\MotorEvent::create([
//         'motor_id' => $m1->id,
//         'name' => 'دما',
//         'topic' => 'motor_140005024507806_temperature',
//         'payload' => 'd->temperature',
//         'normal' => 5,
//         'min' => 2,
//         'max' => 8,
//
//     ]);
//
//     \App\Models\MotorData::create([
//         'motor_id' => $m1->id,
//         'event_id' => $e1->id,
//         'data' => json_encode([
//             'd' => [
//                 '$1' => '22.5',
//                 'temperature' => '22.5',
//                 'TYPE' => 'CAHR'
//             ]
//         ]),
//         'process' => null,
//         'processed_at' => null,
//
//     ]);
// });
