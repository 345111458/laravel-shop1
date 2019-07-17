<?php

namespace App\Http\Requests;

class UserAddressRequest extends Request
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'province'      => 'required',
            'city'          => 'required',
            'district'      => 'required',
            'address'       => 'required',
            'zip'           => 'required|numeric',
            'contact_name'  => 'required',
            'contact_phone' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'province'      => '省',
            'city'          => '城市',
            'district'      => '地区',
            'address'       => '详细地址',
            'zip'           => '邮编',
            'contact_name'  => '姓名',
            'contact_phone' => '电话',
        ];
    }


    public function messages(){
        return [
            'zip.numeric'           => '邮编 必须是数字',
            'contact_phone.numeric' => '电话 必须是数字',
        ];
    }


}
