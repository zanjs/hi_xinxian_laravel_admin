<?php

namespace App\Http\Controllers\Card;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Requests\Card\ProductRequest; //请求层
use App\Repositories\Card\ProductRepository;  //模型仓库层

use App\Model\Card\Market;

class ProductController extends AdminController
{

    protected $product;

    public function __construct(ProductRepository $product)
    {
        parent::__construct();
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $products = $this->product->index();
        $data['products'] = $products;

        return view('card.product.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['markets'] = Market::all();
        return view('card.product.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        $postData = $request->all();  //获取请求过来的数据
        $user = $request->user();

        /*if(isset($_POST['_token']) && $_POST['_token']!=$_SESSION['_token']){
            echo json_encode(array('status'=>'failed','msg'=>'表单只能提交一次，不能重复提交！'));
            exit();
        }*/
        $product = $this->product->store($postData,$user->id);  //使用仓库方法存储
        if ($product->id) {  //添加成功
            return redirect()->route('card.product.index')->with('message', '成功发布新产品！');
        } else {  //添加失败
            return redirect()->back()->withInput($request->input())->with('fail', '数据库操作返回异常！');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = $this->product->edit($id);

        $data['data'] = $product;
        $data['markets'] = Market::all();

        return view('card.product.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ProductRequest $request, $id)
    {
        $postData = $request->all();  //获取请求过来的数据
        $this->product->update($id,$postData);  //使用仓库方法存储
        return redirect()->route('card.product.index')->with('message', '修改成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->product->destroy($id);
        return redirect()->route('card.product.index')->with('message', '删除成功！');
    }
}
