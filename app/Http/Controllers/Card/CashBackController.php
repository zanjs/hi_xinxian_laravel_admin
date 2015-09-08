<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Model\Card\CashBack;

class CashBackController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $recharges = CashBack::orderBy('id','desc')->simplePaginate(200);
        $data['recharges'] = $recharges;
        return view('card.cash_back.index',$data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $card = CashBack::findOrFail($id);
        $card->delete();
        return redirect()->route('card.cash_back.index')->with('message', '删除成功！');
    }
}
