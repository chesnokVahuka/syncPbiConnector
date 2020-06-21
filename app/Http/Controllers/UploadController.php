<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deal;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;

class UploadController extends Controller
{
    private $validTypes = [
        'string' => 'string',
        'integer' => 'integer',
        'enumeration' => 'enum',
        'double' => 'double',
        'float' => 'float',
        'date' => 'date',
        'datetime' => 'dateTime',
        'boolean' => 'boolean', 
        'char' => 'char',
    ];

    public function init(Request $request)
    { 
        if(json_decode($request['init']))
        {
            $tables = json_decode(Redis::get(auth()->user()->id.'tables'),true);
        }
        foreach ($tables as $key => $value)
        {     
            if(filter_var($value, FILTER_VALIDATE_BOOLEAN))
            {
                $data[$key] = Schema::hasTable($key);
            }
        }
        $client = new Client();
        $fields = $client->get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.fields');
        $fields = json_decode($fields->getBody()->getContents(),true);
        foreach ($fields['result'] as $field)
        {
           if (key_exists('listLabel', $field))
           {
               $title = $field['listLabel'];
           }
           else
           {
            $title = $field['title'];

           }
            if(key_exists($field['type'], $this->validTypes))
            {
                echo "<pre>";
                // print_r($this->validTypes[$field['type']]);  
                if ($field['type'] == 'enumeration')   
                {
                    foreach ($field['items'] as $item)
                    {
                        $items = array_keys($item);
                    }
                    $tableFields[] = 
                    [
                        'name' => $title,
                        'type' => $this->validTypes[$field['type']]
                    ];
                    // $tableFields[$field['title']] = $this->validTypes[$field['type']];

                }
                else
                {
                    $tableFields[] = [
                        'name' => $title,
                        'type' => $this->validTypes[$field['type']],
                    ];
                    // $tableFields[$field['title']] = $this->validTypes[$field['type']];
    
                }
            }
            else
            {
                echo "<pre>";
                // echo "<<>>";
                // print_r($field['type']);  
                 $tableFields[] = [
                        'name' => $title,
                        'type' => 'string',
                    ];
            }
        }
        // dd(json_encode(array_values($items)));
        dd($tableFields);
        dd(Schema::hasTable('deals'));
    }
}
