<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deal;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class UploadController extends Controller
{
    public function init(Request $request){
        $tables = $request->all();  
        foreach ($request->all()['tables'] as $table){
            echo "<pre>";
            print_r($table);
            echo "zhopa";
        }
        dd(Schema::hasTable('deals'));
    }
}
