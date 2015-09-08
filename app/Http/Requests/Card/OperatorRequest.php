<?php

namespace App\Http\Requests\Card;

use App\Http\Requests\Request;

class OperatorRequest extends Request
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
                'phone'       => 'required|digits_between:10,12|unique:mysql_card.operators,phone,'.$id.',id',
                'name'       => 'required',
                'market_id'       => 'required',
                'email' => 'required|email',
                'safety_key' => 'required|alpha_dash',
                'login_name' => 'required|numeric|max:10|unique:mysql_card.operators,login_name,'.$id.',id',

            ];
        }
        else{

            return [
                'phone'       => 'required|digits_between:10,12|unique:mysql_card.operators,phone',
                'name'       => 'required',
                'market_id'       => 'required',
                'email' => 'required|email',
                'safety_key' => 'required|alpha_dash',
                'password' => 'required|max:20',
                'login_name' => 'required|numeric|max:10|unique:mysql_card.operators,login_name',
            ];
        }
    }
}
