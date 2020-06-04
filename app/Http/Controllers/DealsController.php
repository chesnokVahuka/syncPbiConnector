<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Deal;

class DealsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $deal = Deal::all();
        return $deal; 
    }

    public function store(){
        $client = new Client();
        $res = $client->get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/?');
        $responseDeals = json_decode($res->getBody()->getContents(),true);
        // while($responseDeals['next'] < 250){
        //     $current = $responseDeals['next'];
        //     $res = $client->get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/?start='.$current);
        //     $responseDeals = json_decode($res->getBody()->getContents(),true);          
        // };
        
        foreach($responseDeals['result'] as $deals){
            $data[]=[
                'ID' =>$deals['ID']
                // 'created_at' => \Carbon\Carbon::now(),
                // 'updated_at' => \Carbon\Carbon::now()
            ];
            // $dealTable = new Deal();
            // $dealTable->ID = $deals['ID'];
            // $dealTable->TITLE = $deals['TITLE'];
            // $dealTable->save();
        }
        Deal::insert($data);
       
    }
}
