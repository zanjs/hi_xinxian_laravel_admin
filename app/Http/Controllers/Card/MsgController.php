<?php

namespace App\Http\Controllers\Card;
use Mail;
use Illuminate\Http\Request;
use App\User;
use App\Model\UserCa;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Jobs\SeedMessage;
use App\Http\Requests\SeedMessageRequest;
class MsgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        // $user = $request->user();
        $user = User::findOrFail(1);

        $email =  '2265798990@qq.com';
        $data = '恭喜您成功发送';
       /* $job = (new SendEmail($user,$data,$email))->delay(1);
        $this->dispatch($job);*/

        return view('admin.message.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function seed(SeedMessageRequest $request)
    {
        $postData = $request->all();  //获取请求过来的数据

        $startTime = e($postData['startTime']);
        $endTime =   e($postData['endTime']);
        $text =      e($postData['text']);

        //$user = User::findOrFail(1);
        $user = $request->user();
        //$cards = UserCa::where('created_at','>',$startTime)->where('created_at','<',$endTime)->get();
        $cards = UserCa::whereBetween('created_at',[$startTime,$endTime])->get();

        if(count($cards)<1){
            return redirect()->back()
                ->withInput()
                ->withErrors(array('attempt' => '未查到数据'));  //回传错误信息
        }

        foreach($cards as $key => $li){
            $job = (new SeedMessage($user,$text,$li->phone))->delay(1);
            $jobS = $this->dispatch($job);
        }

        return redirect()->route('adminMsgSeed')->with('fail', '成功发送短信队列！共发送'.count($cards)."条记录");

    }


}
