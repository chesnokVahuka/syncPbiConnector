<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use App\Deal;

class DealsController extends Controller
{
    public $fields = [];

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        // $deal = Deal::all();
        $columns = Schema::getColumnListing('deals');
        return view('deals.index', compact('columns'));
    }

    public function update(){
        $arData = [2,4,6,8];
        $arDeals = Deal::findOrFail($arData);
        // dd($arDeals);
        return view('deals.patch', compact('arDeals'));
    }

    public function store(Request $request){

        $client = new Client();
        $e = ['ID','TITLE','DATE_CREATE'];        
        $res = $client->get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/',
        ['query' => ['select' => $e]]);
        $responseDeals = json_decode($res->getBody()->getContents(),true);
        
        $selectedFields = config('fields.deal');
        
        dd($responseDeals);

        return $this->fields;
        

        // foreach($responseDeals['result'] as $deals){
        //     $data[]=[
        //         'ID' =>$deals['ID'],
        //         'DATE_CREATE'=>$deals['DATE_CREATE']
        //     ];
        // }
        // dynamic add columns into table
        // Schema::table('deals', function (Blueprint $table) {
        //     $table->unsignedBigInteger('UTM_CAMPAIGN')->nullable();
        //     $table->unsignedBigInteger('UTM_CONTENT')->nullable();
        //     $table->unsignedBigInteger('UTM_SOURCE')->nullable();
        //     $table->unsignedBigInteger('UTM_TERM')->nullable();

        // });

        // Deal::insert($responseDeals['result']);
       
    }

    // while($responseDeals['next'] < 250){
    //     $current = $responseDeals['next'];
    //     $res = $client->get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/?start='.$current);
    //     $responseDeals = json_decode($res->getBody()->getContents(),true);          
    // };

  
}
