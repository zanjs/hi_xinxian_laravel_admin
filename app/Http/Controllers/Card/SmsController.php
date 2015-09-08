<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\AdminController;

use App\Jobs\SendReminderEmail;
use App\Jobs\SeedMessage;
use App\Http\Requests\Card\SeedMessageRequest;
use Mail;
use App\User;
use App\Model\Card\UserCa;
use App\Model\Card\MassMessage;
use App\Model\Card\SmsRecord;
use App\Model\Card\Jobs;

use App\Jobs\SendEmail;

class SmsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $messages = MassMessage::orderBy('id','desc')->simplePaginate(200);
        $data['messages'] = $messages;
        return view('card.sms.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        return view('card.sms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SeedMessageRequest $request)
    {
        $postData = $request->all();  //获取请求过来的数据

        $startTime = e($postData['startTime']);
        $endTime =   e($postData['endTime']);
        $text =      e($postData['text']);

        //$user = User::findOrFail(1);
        $user = $request->user();
        $cards = UserCa::whereBetween('created_at',[$startTime,$endTime])->get();

        if(count($cards)<1){
            return redirect()->back()
                ->withInput()
                ->withErrors(array('attempt' => '未查到数据'));  //回传错误信息
        }

        $user = $request->user();

//        $this->dispatch(new SendReminderEmail($user));



      /* $email =  '2265798990@qq.com';
        for($i=0;$i<1000;$i++){
            $t = floor($i/5)+10;
            $job = (new SendEmail($user,$text,$email))->delay($t);
            $this->dispatch($job);
        }

        dd($job);*/


        foreach($cards as $key => $li){

            $t = floor($key/5)+10;
            print_r($t.'</br>');
            $job = (new SeedMessage($user,$text,$li->phone))->delay($t);
            $jobS = $this->dispatch($job);
            print_r($jobS.'</br>');
        }

        $SmsRecord = new SmsRecord;
        $SmsRecord->startTime = $startTime;
        $SmsRecord->endTime = $endTime;
        $SmsRecord->text = $text;
        $SmsRecord->mumber = count($cards);
        $SmsRecord->user_id = $user->id;

        $SmsRecord->save();

        return redirect()->route('card.sms.index')->with('message', '成功发送短信队列！共发送'.count($cards)."条记录");
    }

    /*
     * 短信群发事物处理
     *
     * */
    public function jobs(){
        $jobs = Jobs::orderBy('id','desc')->simplePaginate(200);
        $data['jobs'] = $jobs;
        return view('card.sms.jobs',$data);

    }

    /*
     * 群发操作记录
     * */
    public function record(){
        $records = SmsRecord::orderBy('id','desc')->simplePaginate(200);
        $data['records'] = $records;
        return view('card.sms.record',$data);
    }

    public function destroy($id)
    {
        $order = MassMessage::findOrFail($id);
        $order->delete();
        return redirect()->route('card.sms.index')->with('message', '删除成功！');
    }
}
