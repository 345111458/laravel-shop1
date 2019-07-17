<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddressRequest;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    //
    public function index(Request $reqeust){

        return view('user_addresses.index',[
            'addresses' => $reqeust->user()->addresses()->orderBy('last_used_at','desc')->paginate(6),
        ]);
    }

    //添加收货 提交地址
    public function store(UserAddressRequest $request){

        $request->user()->addresses()->create($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));
        return redirect()->route('user_addresses.index');
    }


    // 添加收货
    public function create(){

        return view('user_addresses.create_and_edit',['address'=> new UserAddress()]);
    }


    // 修改收货地址
    public function edit(UserAddress $user_address){
        $this->authorize('own' , $user_address);

        return view('user_addresses.create_and_edit',['address'=>$user_address]);
    }


    //修改提交地址
    public function update(UserAddress $user_address , UserAddressRequest $request){
        $this->authorize('own' , $user_address);

        $user_address->update($request->only([
            'province',
            'city',
            'district',
            'address',
            'zip',
            'contact_name',
            'contact_phone',
        ]));
        return redirect()->route('user_addresses.index');
    }


    public function destroy(UserAddress $user_address){
        $this->authorize('own' , $user_address);
        $user_address->delete();

        return [];
        return redirect()->route('user_addresses.index');
    }


}
