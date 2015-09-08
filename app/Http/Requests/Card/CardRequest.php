<?php

namespace App\Http\Requests\Card;

use App\Http\Requests\Request;

class CardRequest extends Request
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

        $id = $this->segment(3);
        return [
            'card'       => 'required|unique:mysql_card.user_cas,card,'.$id.',id',
            'phone'       => 'required|unique:mysql_card.user_cas,phone,'.$id.',id',
            'price'       => 'required|numeric',


        ];
    }

    public function messages()
    {
        return [
            'card.unique'       => '卡号存在',
            'phone.unique'       => '手机存在',


        ];
    }
}
