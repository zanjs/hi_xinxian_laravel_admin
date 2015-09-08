<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Model\Card\UpdateCard;

class CardUpdateController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cards = UpdateCard::orderBy('id','desc')->get();
        $data["cards"] = $cards;
        return view('card.card.update',$data);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $card = UpdateCard::findOrFail($id);
        $card->delete();
        return redirect()->route('card.card_update.index')->with('message', '删除成功！');
    }
}
