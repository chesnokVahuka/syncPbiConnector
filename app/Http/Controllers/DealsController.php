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
use App\CRest\CRest;
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
        $tstart = microtime(true);
     
        $client = new Client();

        $fields = array_keys(DealFields::getSelectedFields());  
        $next = 0;  

       $count = ceil(16106/50);
      for($i = 1; $i < $count+1; $i++){
          $starts[] = $i;
      }
    //   dd($starts);
        foreach ($starts as $start){
            // $promises[] = $client->getAsync('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list',
            //     ['query' => ['select' => $fields,'start' => $start]]);
            $entitys[] = [
                'entitys'.$start => [
                    'method' => 'crm.deal.list',    
                    'params' => [                          
                            'start' => ($start-1)*50,
                        ]     
                ],
            ];
            if(($start % 50 == 0) || ($start == $count)){
                $arResult[] = CRest::callBatch($entitys);  
                // $entitys = [];
            }
        }
        dd($arResult);
   
        $results = Promise\unwrap($promises);


        foreach($results as $result){
            $data[] = json_decode($result->getBody(),true);
        }    
        
        $time = microtime(true) - $tstart;
        dd($data,$time);
        return $result;   
    }   
    
}
