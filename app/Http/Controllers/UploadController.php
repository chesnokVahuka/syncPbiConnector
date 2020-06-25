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

    private $method = [
        'deals' => [
            'list' => 'crm.deal.list',
            'fields' => 'crm.deal.fields'
        ],
        'leads' => [
            'list' => 'crm.lead.list',
            'fields' => 'crm.lead.fields'
        ],
        'b24users' => [
            'list' => 'user.get',
        ],
        'dealcategorys' => [
            'list' => 'crm.dealcategory.list',
            'fields' => 'crm.dealcategory.fields'
        ],
        'activitys' => [
            'list' => 'crm.activity.list',
        ],
        'activitystatuses' => [
            'list' => 'crm.enum.activitystatus',
        ],
        'departmentslists' => [
            'list' => 'department.get',
        ],
        'sonetgroups' => [
            'list' => 'sonet_group.get'
        ],
        'elapseditem' => [
            'list' => 'task.elapseditem.getlist'
        ],
        'tasklists' => [
            'list' => 'tasks.task.list'
        ],
        'statuslists' => [
            'fields' => 'crm.status.fields',
            'list' => 'crm.status.list'
        ]
    ];


    public function __construct(){
        $this->middleware('auth');
    }

    public function createTable($tableName, $fields)
    {
        if (!Schema::hasTable($tableName))
        {
            Schema::create($tableName, function(Blueprint $table) use ($fields, $tableName)
            {
                if (count($fields) > 0)
                {
                    foreach ($fields as $field)
                    {
                        // dd($field['type']);
                        if($field['name'] == 'ID')
                        {
                            $table->integer('ID')->unique();
                        }
                        elseif ($field['type'] == 'enum')
                        {
                            $table->enum($field['name'], $field['items'])-> nullable();
                        }
                        else
                        {
                            $type = $field['type'];
                            $name = $field['name'];
                            $table->$type($name)->nullable();
                        }
                    }
                }
                return response()->json(['message' => 'Given table has been successfully created!'], 200);    
            });
        }
    }

    

    public function init(Request $request)
    { 
        // dd(Schema::hasTable('leads'));

        // if(json_decode($request['init']))
        // {
        //     $tables = json_decode(Redis::get(auth()->user()->id.'tables'),true);
        // }
        $tables = json_decode(Redis::get(auth()->user()->id.'tables'),true);

        foreach ($tables as $key => $value)
        {     
            if(filter_var($value, FILTER_VALIDATE_BOOLEAN))
            {
                $data[$key] = Schema::hasTable($key);
            }
        }
 
        foreach ($data as $tableName => $status)
        {
            if (!$status)
            {
                if(key_exists('fields',$this->method[$tableName]))
                {
                    $client = new Client();
                    $fields = $client->get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/'.$this->method[$tableName]['fields']);
                    $fields = json_decode($fields->getBody()->getContents(),true);
                    foreach ($fields['result'] as $fieldName => $fieldParams)
                    {
                    //    if (key_exists('listLabel', $field))
                    //    {
                    //        $title = $field['listLabel'];
                    //    }
                    //    else
                    //    {
                    //     $title = $field['title'];
            
                    //    }
            
                        // $title = str_ireplace(['.',' '],'_',$field['title']);'
                        $title = $fieldName;
                     
                        if(key_exists($fieldParams['type'], $this->validTypes))
                        {
                            if ($fieldParams['type'] == 'enumeration')   
                            {
                                foreach ($fieldParams['items'] as $item)
                                {
                                    $items = array_keys($item);
                                }
                                $tableFields[] = 
                                [
                                    'name' => $title,
                                    'type' => $this->validTypes[$fieldParams['type']],
                                    'items' => $items,
                                ];
                            }
                            else
                            {
                                $tableFields[] = [
                                    'name' => $title,
                                    'type' => $this->validTypes[$fieldParams['type']],
                                ];
                            }
                        }
                        else
                        {
                            echo "<pre>";
                             $tableFields[] = [
                                    'name' => $title,
                                    'type' => 'string',
                                ];
                        }
                    }   
                    $result = $this->createTable($tableName, $tableFields);   
                }
                else
                {   
                    call_user_func('upload'.$tableName);              
                }
            }
        }
       
    }

    public function uploadb24users()
    {
        if(!Schema::hasTable('b24users'))
        {
            Schema::create('b24users', function (Blueprint $table) {
                $table->unsignedBigInteger('ID')->unique();
                $table->boolean('ACTIVE')->nullable();
                $table->string('EMAIL')->nullable();
                $table->string('NAME')->nullable();
                $table->string('LAST_NAME')->nullable();
                $table->string('SECOND_NAME')->nullable();
                $table->char('PERSONAL_GENDER')->nullable();
                $table->string('PERSONAL_PROFESSION')->nullable();
                $table->string('PERSONAL_WWW')->nullable();
                $table->timestamp('PERSONAL_BIRTHDAY')->nullable();
                $table->string('PERSONAL_PHOTO')->nullable();
                $table->string('PERSONAL_ICQ')->nullable();
                $table->string('PERSONAL_PHONE')->nullable();
                $table->string('PERSONAL_FAX')->nullable();
                $table->string('PERSONAL_MOBILE')->nullable();
                $table->string('PERSONAL_PAGER')->nullable();
                $table->string('PERSONAL_STREET')->nullable();
                $table->string('PERSONAL_CITY')->nullable();
                $table->string('PERSONAL_STATE')->nullable();
                $table->string('PERSONAL_ZIP')->nullable();
                $table->string('PERSONAL_COUNTRY')->nullable();
                $table->string('WORK_COMPANY')->nullable();
                $table->string('WORK_POSITION')->nullable();
                $table->string('WORK_PHONE')->nullable();
                $table->integer('UF_DEPARTMENT')->nullable();
                $table->string('UF_INTERESTS')->nullable();
                $table->string('UF_SKILLS')->nullable();
                $table->string('UF_WEB_SITES')->nullable();
                $table->string('UF_XING')->nullable();
                $table->string('UF_LINKEDIN')->nullable();
                $table->string('UF_FACEBOOK')->nullable();
                $table->string('UF_TWITTER')->nullable();
                $table->string('UF_SKYPE')->nullable();
                $table->string('UF_DISTRICT')->nullable();
                $table->integer('UF_PHONE_INNER')->nullable();
                $table->string('USER_TYPE')->nullable();
                $table->string('UF_DISTRICT')->nullable();
                $table->string('UF_DISTRICT')->nullable();       

                $table->timestamps();
            });
        }
    }

    public function uploadactivitys()
    {
        if(!Schema::hasTable('activitys'))
        {
            Schema::create('activitys', function (Blueprint $table) {
                $table->unsignedBigInteger('ID')->unique();
                $table->integer('OWNER_ID')->nullable();
                $table->integer('OWNER_TYPE_ID')->nullable();
                $table->integer('TYPE_ID')->nullable();
                $table->string('PROVIDER_ID')->nullable();
                $table->string('PROVIDER_TYPE_ID')->nullable();
                $table->string('PERSONAL_GENDER')->nullable();
                $table->string('PROVIDER_GROUP_ID')->nullable();
                $table->unsignedBigInteger('ASSOCIATED_ENTITY_ID')->nullable();
                $table->string('SUBJECT')->nullable();
                $table->timestamp('CREATED')->nullable();
                $table->timestamp('LAST_UPDATED')->nullable();
                $table->timestamp('START_TIME')->nullable();
                $table->timestamp('END_TIME')->nullable();
                $table->timestamp('DEADLINE')->nullable();
                $table->char('COMPLETED')->nullable();
                $table->integer('STATUS')->nullable();
                $table->integer('RESPONSIBLE_ID')->nullable();
                $table->integer('PRIORITY')->nullable();
                $table->integer('NOTIFY_TYPE')->nullable();
                $table->integer('NOTIFY_VALUE')->nullable();
                $table->string('DESCRIPTION')->nullable();
                $table->string('DESCRIPTION_TYPE')->nullable();
                $table->string('DIRECTION')->nullable();
                $table->string('LOCATION')->nullable();
                $table->string('PERSONAL_COUNTRY')->nullable();
                $table->string('SETTINGS')->nullable();
                $table->integer('ORIGINATOR_ID')->nullable();
                $table->integer('ORIGIN_ID')->nullable();
                $table->integer('AUTHOR_ID')->nullable();
                $table->integer('EDITOR_ID')->nullable();
                $table->string('RESULT_MARK')->nullable();
                $table->string('RESULT_VALUE')->nullable();
                $table->string('RESULT_SUM')->nullable();
                $table->string('RESULT_CURRENCY_ID')->nullable();
                $table->integer('RESULT_STATUS')->nullable();
                $table->integer('RESULT_STREAM')->nullable();
                $table->string('RESULT_SOURCE_ID')->nullable();
                $table->string('AUTOCOMPLETE_RULE')->nullable();

                $table->timestamps();
            });
        }
    }

    public function uploaddepartment()
    {
        if(!Schema::hasTable('department'))
        {
            Schema::create('department', function (Blueprint $table) {
                $table->unsignedBigInteger('ID')->unique();
                $table->string('NAME')->nullable();
                $table->integer('SORT')->nullable();
                $table->integer('UF_HEAD')->nullable();

                $table->timestamps();
            });
        }
    }

    public function uploadsonet_group()
    {
        if(!Schema::hasTable('sonet_group'))
        {
            Schema::create('sonet_group', function (Blueprint $table) {
                $table->unsignedBigInteger('ID')->unique();
                $table->string('SITE_ID')->nullable();
                $table->string('NAME')->nullable();
                $table->string('DESCRIPTION')->nullable();
                $table->timestamp('DATE_CREATE')->nullable();
                $table->timestamp('DATE_UPDATE')->nullable();
                $table->char('ACTIVE')->nullable();
                $table->char('VISIBLE')->nullable();
                $table->char('OPENED')->nullable();
                $table->char('CLOSED')->nullable();
                $table->char('SUBJECT_ID')->nullable();
                $table->integer('OWNER_ID')->nullable();
                $table->string('KEYWORDS')->nullable();
                $table->integer('NUMBER_OF_MEMBERS')->nullable();
                $table->timestamp('DATE_ACTIVITY')->nullable();
                $table->string('SUBJECT_NAME')->nullable();
                $table->integer('PROJECT')->nullable();
                $table->char('IS_EXTRANET')->nullable();

                $table->timestamps();
            });
        }
    }
   
}
