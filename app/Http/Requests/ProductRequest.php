<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProductRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
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
                'name'       => 'unique:products,name,'.$id.',id',
                'sort' => 'required|',
                'body'     => 'required|min:20',
                'price'  => 'required|numeric',
                'thumb'       => 'required',
                'status'      => 'boolean',
            ];
        }
        //store
        else{
            $rules = [
                'name'       => 'unique:products,name',
                'sort' => 'required|',
                'body'     => 'required|min:20',
                'price'  => 'required|numeric',
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
            'name.required'       => '请填写产品标题',
            'name.max'            => '标题过长，建议长度不要超出60',
            'name.unique'            => '已有同名产品',
            'category_id.required' => '请选择文章分类',
            'category_id.exists'   => '不存在该文章分类',
            'body.required'     => '请填写产品正文',
            'body.min'          => '文章正文过短，长度不得少于20',
            'status.boolean'       => '草稿箱必须为布尔值',
            'price.required'  => '请填写价格',
            'thumb.required'       => '缩略图必须上传',
        ];
    }
}
