<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\User;

class ProfilesController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index($user)
    {
        $client = new Client();
        $res = $client->get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/');
        // $response = Http::get('https://denvic.bitrix24.ru/rest/7319/52n8xldtt8mbi7bg/crm.deal.list/');
        // echo $response->body();
        dd($res->getBody()->getContents());

        $user = User::findOrFail($user);
        return view('profiles.index', [
            'user' => $user,
        ]);
    }
}
