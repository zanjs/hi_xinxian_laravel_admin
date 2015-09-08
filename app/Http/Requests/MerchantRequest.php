<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MerchantRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * 自定义验证规则rules
     *
     * @return array
     */
    public function rules()
    {
        //update
        if($this->segment(3)){
            $id = $this->segment(3);
            $rules = [
                'name'               => 'unique:merchants,name,'.$id.',id',
                'mobile'            => 'required|numeric|regex:/^1[34578][0-9]{9}$/',
                'dist_name'         => 'required',
                'fare'               => 'sometimes|numeric',
                'full_price'       => 'sometimes|numeric',
                'city'             => 'required',
                'address'             => 'required',
            ];
        }
        //store
        else{
            $rules = [
                'name'       => 'unique:merchants,name',
                'mobile'            => 'required|numeric|regex:/^1[34578][0-9]{9}$/',
                'dist_name'         => 'required',
                'fare'               => 'required|numeric',
                'full_price'       => 'required|numeric',
                'city'             => 'required',
                'address'             => 'required',
            ];
        }


        return $rules;
    }

    /**
     * 自定义验证信息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'       => '请填写标题',
            'name.unique'            => '已有同名',
            'mobile.min'            => '不是有效的10位号min',
            'mobile.max'            => '不是有效的10位号max',
            'mobile.regex'            => '不是有效的手机号',
            'dist_name.required'         => '配送哥哥的称呼呢？',

        ];
    }
}
