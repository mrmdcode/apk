<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        if (auth()->user()->type == "admin"){
            return redirect()->route("admin.dashboard");
        }
        if (auth()->user()->type == "company"){
            return redirect()->route("company.dashboard");
        }
        else{
            return abort(403);
        }


        return abort(403,'با شرکت اسرار پایش کوشا تماس بگیرید .');
    }

    public function choiser()
    {
        return redirect()->route('home');
    }
}
