<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CityRequest extends Request
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //update
        if($this->segment(3)){
            $id = $this->segment(3);
            $rules = [
                'name'       => 'required|max:10|unique:cities,name,'.$id.',id',
                'pid'       => 'required',

            ];
        }
        //store
        else{
            $rules = [
                'name'       => 'required|max:3|unique:cities,name',
                'pid'       => 'required',

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
            'name.max'              => '名字太长了',
            'name.unique'            => '已有同名',
        ];
    }
}
