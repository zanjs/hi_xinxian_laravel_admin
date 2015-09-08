<?php

namespace App\Http\Requests\Card;

use App\Http\Requests\Request;

class SeedMessageRequest extends Request
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
        return [
            'startTime'       => 'required',
            'endTime'       => 'required',
            'text'       => 'required',

        ];
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

        ];
    }
}
