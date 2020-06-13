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
use App\DealFields;
use GuzzleHttp\Promise;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;

use GuzzleHttp\Promise\EachPromise;
use GuzzleHttp\Psr7\Response;

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

        dd($request->all());
        if(Deal::count() != 0){
            return "Deal table isn't empty";
            die;
        }  
        $client = new Client();

        $fields = array_keys(DealFields::getSelectedFields());  
        $next = 0;  

        $count = $client->get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list',
        ['query' => ['select' =>['ID'],'start' => 0]]);
        $total = json_decode($count->getBody()->getContents(),true);

        $count = ceil($total['total']/50);
        $count = 5;
        for($start = 1; $start < $count+1; $start++){   
            $promises[] = $client->getAsync('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list',
            ['query' => ['select' => $fields,'start' => ($start-1)*50]]);

            if(($start % 5 == 0)||($start == $count))   {
                $results = Promise\unwrap($promises);   
                foreach($results as $result){
                    $data = json_decode($result->getBody(),true);
                    $insertData[] = $data['result'];
                }  
                foreach ($insertData as $data){                    
                    Deal::insert($data);
                }    
             $insertData = [];
             $promises = [];          
            }

        }
        return count($insertData);
        }
       
}
