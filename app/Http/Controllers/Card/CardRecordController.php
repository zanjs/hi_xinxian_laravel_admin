<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Model\Card\OpenLog;
use App\Model\Card\MsgSeed;

class CardRecordController extends AdminController
{


    /**
     * Show the form for creating a new resource.
     *  付款记录 payment
     * @return Response
     */
    public function payment()
    {
        $payments = OpenLog::where('type','3')->orderBy('id','desc')->get();
        $data['payments'] = $payments;
        return view('card.record.payment',$data);
    }


    /**
     * Show the form for creating a new resource.
     *  短信记录 message
     * @return Response
     */
    public function message()
    {
        $messages = MsgSeed::all();
        $data['messages'] = $messages;
        return view('card.record.message',$data);
    }


}
