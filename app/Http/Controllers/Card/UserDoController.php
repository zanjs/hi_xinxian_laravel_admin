<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Model\UserCa;
use App\Model\OpenLog;
use App\Model\MsgSeed;

class UserDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {


//        $userCa = UserCa::all()->orderBy('update-date','desc');
        $userCa = UserCa::orderBy('id','desc')->get();

        $data['userCa'] = $userCa;

        return view('admin.userDo',$data);

    }

    /**
     * Show the form for creating a new resource.
     *  付款记录
     * @return Response
     */
    public function cardLess()
    {
        $cardLess = OpenLog::where('type','3')->orderBy('id','desc')->get();
        $data['less'] = $cardLess;
        return view('admin.cardLess',$data);
    }

    /**
     * Show the form for creating a new resource.
     *  充值记录
     * @return Response
     */
    public function cardAdd()
    {
        $cardLess = OpenLog::where('type','2')->orderBy('id','desc')->get();
        $data['adds'] = $cardLess;
        return view('admin.cardAdd',$data);
    }

    /**
     * Show the form for creating a new resource.
     *  短信记录
     * @return Response
     */
    public function cardSeed()
    {
        $msgSeeds = MsgSeed::all();
        $data['Seeds'] = $msgSeeds;
        return view('admin.msgSeed',$data);
    }

}
