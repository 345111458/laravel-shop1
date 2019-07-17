<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    //
    public function index(Request $reqeust){

        return view('user_addresses.index',[
            'addresses' => $reqeust->user()->addresses()->orderBy('last_used_at','desc')->paginate(6),
        ]);
    }


}
