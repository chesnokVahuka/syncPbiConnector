<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function store(User $user){
        dd(request());
        // return auth()->user()->following()->toggle($user->profile);
    }
}
