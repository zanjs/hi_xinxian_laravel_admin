<?php

namespace App\Http\Requests\Card;

use App\Http\Requests\Request;

class MarketRequest extends Request
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
                'name'       => 'required|unique:mysql_card.markets,name,'.$id.',id',
                'no'       => 'required|numeric',
                'address'       => 'required',

            ];
        }
        else{

            return [
                'name'       => 'required|unique:mysql_card.markets,name',
                'no'       => 'required|numeric',
                'address'       => 'required',

            ];
        }
    }
}
