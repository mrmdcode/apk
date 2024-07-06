<?php

namespace App\Http\Controllers;

use App\Mail\logErrorMail;
use App\Models\Message;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class appChatController extends Controller
{

    public static function initAdmin()
    {
        $company = User::where('type','!=','admin')->with('company')->get()->map(function ($item){
            return [
                'id' => $item->company->id,
                'name' => $item->company->company_name,
                'logo' => $item->company->company_logo,
            ];
        });
        $company = $company->unique('id');
        $company = collect($company->values()->all());
        return response()->json(['Users' => $company]);
    }
    public function initCompany()
    {
        $companiesSol = auth()->user()->company->soldMotors->map(function ($item){
            return [
                'id' => $item->buyer->id,
                'name'=>$item->buyer->company_name.'(customer)',
                'logo'=>$item->buyer->company_logo
            ];
        });

        $companiesBou = auth()->user()->company->boughtMotors->map(function ($item){
            return [
                'id' => $item->seller->id,
                'name'=>$item->seller->company_name.'(seller)',
                'logo'=>$item->seller->company_logo
            ];
        });

        $companies =$companiesSol->merge($companiesBou);

        $admin = UserCompany::where('id',1)->first(['id','company_name','company_logo']);

        $companies = $companies->merge([[
            'id'=>$admin->id,
            'name'=>$admin->company_name,
            'logo'=>$admin->company_logo,
        ]]);

        $companies = $companies->unique('id');
        $companies = collect($companies->values()->all());
        return response()->json(['Users' => $companies]);
    }

    public function giveMessages($targetId)
    {
        $companyId = auth()->user()->company->id;

        $company = UserCompany::find($targetId);
        $messages = Message::where(function ($query) use ($companyId, $targetId) {
            $query->where(function ($subQuery) use ($companyId, $targetId) {
                $subQuery->where('company_sender', $companyId)
                    ->where('company_receiver', $targetId);
            })->orWhere(function ($subQuery) use ($companyId, $targetId) {
                $subQuery->where('company_sender', $targetId)
                    ->where('company_receiver', $companyId);
            });
        })->orderByDesc('created_at')->take(10)->get();
        Message::where(function ($query) use ($companyId, $targetId) {
            $query->where(function ($subQuery) use ($companyId, $targetId) {
                $subQuery->where('company_sender', $companyId)
                    ->where('company_receiver', $targetId);
            })->orWhere(function ($subQuery) use ($companyId, $targetId) {
                $subQuery->where('company_sender', $targetId)
                    ->where('company_receiver', $companyId);
            });
        })->whereNull('seen_at')->update(['seen_at' => now()]);
        return response()->json(['user'=>$company,'messages'=>$messages]);
    }

    public static function dontSeenMessages($companyId)
    {

        return Message::where('company_receiver',$companyId)->whereNull('seen_at')->orderByDesc('created_at')->get();
    }
    public function sendCTC(Request $request) //send message company to company
    {
        return self::store(auth()->user()->company->id,$request->input('targetId'),$request->input('message'),$request->input('priority','normal'));


    }


    public static function checkLastMessageTime($receiverId,$time= 30)
    {
        $timeAgo = now()->subMinutes($time);
        if (Message::where('created_at','>=',$timeAgo)->where('company_receiver',$receiverId)->exists()) {
            return true;
        }
        return false;
    }


    public static function store($senderId,$receiverId,$message,$priority,$type='company')
    {
        $mess = Message::create([
            'company_sender'=>$senderId,
            'company_receiver'=>$receiverId,
            'message'=>$message,
            'priority'=>$priority,
            'type' => $type
        ]);
        if ($mess){
            $res = 200;
        }
        else{
            $res = 408;
        }
        return response(['send Mess'],$res);
    }
}
