<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;


class HomeController extends Controller
{
  
      /**
     * Create a new controller instance.
     *
     * @return void
     */
      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function index()
    {
        return view('home');
    }

    public function config(){    
        // dd(json_decode(Redis::get(auth()->user()->id.'fields')));
        $apikey = Redis::get(auth()->user()->id.'apikey');
        $fields = Redis::get(auth()->user()->id.'fields');
        if($fields == null){
           return ['default'];
        };
        return view('config.config', compact('fields','apikey'));
    }

    public function configUpdateApikey(Request $request){        
        Redis::set(auth()->user()->id.'apikey', json_encode($request['apikey']));
        return $request['apikey'];
    }

    public function configUpdateFields(Request $request){        
        // dd($request['fields']);
        Redis::set(auth()->user()->id.'fields',json_encode($request['fields']));
        return $request['fields'];
    }



  
}
