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

    private $mappArray = [
        'deals' =>              'Deals',
        'leads' =>              'Leads',
        'b24users' =>           'Users',
        'dealcategorys' =>      'Dealcategory',
        'activitys' =>          'Activity',
        'activitystatuses' =>   'Activitystatus',
        'calllists' =>          'Calllist',
        'departmentslists' =>   'Departmentslist',
        'sonetgroups' =>        'Sonetgroup',
        'elapseditem' =>        'Elapseditem',
        'tasklists' =>          'Tasklist',
        'statuslists' =>        'Statuslist',
    ];
    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function index()
    {
        return view('home');
    }

    public function config()
    {   
        $apikey = Redis::get(auth()->user()->id.'apikey');
        $redisTables = Redis::get(auth()->user()->id.'tables');
        // if($tables == null)
        // {
        //    return ['default'];
        // };
        foreach (json_decode($redisTables) as $key => $value)
        {
            if (array_key_exists($key,$this->mappArray))
            {
              $tables[$this->mappArray[$key]] = $value;
            }
        }
        // dd($tables);
        $tables = json_encode($tables);
        // $tables = $redisTables;
       
        return view('config.config', compact('tables','apikey'));
    }

    public function configApikeyUpdate(Request $request)
    {        
        Redis::set(auth()->user()->id.'apikey', json_encode($request['apikey']));
        return $request['apikey'];
    }

    public function configTablesUpdate(Request $request)
    {       
        foreach ($request['tables'] as $key => $value)
        {
            if (in_array($key,$this->mappArray))
            {
                $redisTables[array_search($key,$this->mappArray)] = $value;
            }
        }
        Redis::set(auth()->user()->id.'tables',json_encode($redisTables));

        return json_encode($redisTables);   
    }

    public function configDefault()
    {
        // Redis::
    }
  
}
