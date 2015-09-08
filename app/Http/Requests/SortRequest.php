<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SortRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
//        return false;
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
                'name'       => 'required|max:3|unique:sorts,name,'.$id.',id',
                'thumb'       => 'required',
                'status'      => 'boolean',
            ];
        }
        //store
        else{
            $rules = [
                'name'       => 'required|max:3|unique:sorts,name',
                'thumb'       => 'required',
                'status'      => 'boolean',
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
            'name.max'            => '标题过长，建议长度不要超出3',
            'name.unique'            => '已有同名',
            'status.boolean'       => '草稿箱必须为布尔值',
            'thumb.required'       => '缩略图必须上传',
        ];
    }
}
