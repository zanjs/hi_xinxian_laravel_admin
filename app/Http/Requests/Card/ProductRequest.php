<?php

namespace App\Http\Requests\Card;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->segment(3)){
            $id = $this->segment(3);
            return [
                'name'       => 'required',
                'b_price'       => 'required|numeric',
                'price'       => 'required|numeric',
                'no'       => 'required|numeric',
                'number'       => 'required|numeric',
                'market_id'       => 'required|numeric',

            ];
        }
        else{

            return [
                'name'       => 'required',
                'b_price'       => 'required|numeric',
                'price'       => 'required|numeric',
                'no'       => 'required|numeric',
                'number'       => 'required|numeric',
                'market_id'       => 'required|numeric',

            ];
        }
    }

    public function messages()
    {
        return [
            'name.required'       => '请填写标题',
            'name.unique'       => '标题重名',
            'b_price.required'            => '请填写进货价格',
            'price.required'            => '请填写零售价格',
            'no.required'            => '请填写产品编号',
            'number.required'            => '请填写产品数量',
            'price.numeric'            => '价格不是数字',
            'b_price.numeric'            => '进货价格不是数字',
            'no.numeric'            => '编号不是数字',
            'number.numeric'            => '数量不是数字',

        ];
    }
}
