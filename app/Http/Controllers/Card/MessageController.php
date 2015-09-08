<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Model\Card\MsgSeed;

class MessageController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $messages = MsgSeed::orderBy('created_at', 'desc')->paginate(200);
        $data['messages'] = $messages;
        return view('card.record.message',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $card = MsgSeed::findOrFail($id);
        $card->delete();
        return redirect()->route('card.message.index')->with('message', '删除成功！');
    }
}
