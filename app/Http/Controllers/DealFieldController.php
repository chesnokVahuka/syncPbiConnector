<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DealFieldController extends Controller
{
    public function index(){
        $columns = Schema::getColumnListing('deals');
        return view('deals.index', compact('columns'));
    }
}
