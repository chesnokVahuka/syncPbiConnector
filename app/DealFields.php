<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealFields extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'fields_id';

    public static function getSelectedFields(){
        $fields = DealFields::first()->toArray();  
        $selected = [];

        foreach ($fields as $key=>$value){
            if($key != 'fields_id'){
            if($value == "1"){
                $value = true; 
                $selected[$key] = $value;                
                }              
            }
        }    
        return $selected;
    }

    public static function getAllFields(){
        $fields = DealFields::first()->toArray();  
        $selected = [];

        foreach ($fields as $key=>$value){
            if($key != 'fields_id'){
                if($value == "1"){
                    $value = true;                                
                }
            $selected[$key] = $value;               
            }
        }    
        return $selected;
    }
}
