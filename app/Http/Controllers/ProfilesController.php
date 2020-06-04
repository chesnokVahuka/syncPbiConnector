<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\User;

class ProfilesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index($user)
    {
      
      
        // $links = ['https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/?start=0',
        //           'https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/?start=50',
        //           'https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/?start=100'];
        // foreach ($links as $link) {
        //     $requests[] = new Request('GET', $link);
        // }
    
        // $responses = Pool::batch($client, $requests, array(
        //     'concurrency' => 15,
        // ));
       
        // foreach ($responses as $response) {
        //     $result = json_decode($response->getBody()->getContents(),true);
        //     echo "<pre>";
        //     var_dump($result["result"]);
        //     // print_r($result["result"]);
        // }

        $user = User::findOrFail($user);
        return view('profiles.index', [
            'user' => $user,
        ]);
    }
}
