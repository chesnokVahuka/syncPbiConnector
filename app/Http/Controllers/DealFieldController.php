<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\DealFields;
use App\Deal;

class DealFieldController extends Controller
{
    public function index(){
        $columns = Schema::getColumnListing('deal_fields');
        $fields = DealFields::all();
        if($fields->isEmpty()){
           die;
        }else{
          $fields = DealFields::first()->toArray();  
          $selected = [];
          foreach ($fields as $key=>$value){
              if($key != 'fields_id'){
                $selected[$key] = $value;
              }
       
              if($value === "1"){
                
              }
            
          }    
          
        $columns = $selected;
        // dd($columns);  
        }
           
        

        return view('deals.index', compact('columns'));
    }

    public function update(Request $request){
        $fields = DealFields::all();
        if($fields->isEmpty()){
           die;
        }else{
            $table = DealFields::find(1);  
            $column = array_keys($request->all())[0];
            $table-> $column = true;
            $table->save();
        }
        // dd(array_keys($request->all())[0]);
        return 'saved';
    }
}
