<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// admin 前缀
#对后台开启csrf过滤
Route::when('admin/*', 'csrf', ['post','delete','put']);
Route::when('card/*', 'csrf', ['post','delete','put']);

/*Route::get('/', function () {
  $admin_prefix = config('app.admin_prefix');
  dd($admin_prefix);
    return view('welcome');
});*/

Route::group(['namespace' => 'Auth'], function()
{
  $admin_prefix = config('app.admin_prefix');
  $authC = 'AuthController@';
  // Authentication routes...
  Route::get('auth/login',['as'=> 'login','uses'=> 'AuthController@getLogin' ]);
  Route::post('auth/login',['as'=> 'postLogin','uses'=> 'AuthController@postLogin' ]);
  Route::get('auth/logout', ['as'=> 'logout','uses'=> 'AuthController@getLogout' ]);

  // Registration routes...
  /*Route::get('auth/register', 'AuthController@getRegister');
  Route::post('auth/register', 'AuthController@postRegister');*/

});




// 管理后台
Route::group(['prefix' => config('app.admin_prefix') , 'namespace' => 'Admin','middleware' => 'auth'], function () {
    // admin 首页
  Route::get('admin007',['as' => 'admin.home','uses'=> 'AdminHomeController@index']);

  Route::get('card007',['as' => 'card.home','uses'=> 'AdminHomeController@index']);
});

/*
 * 微信商城管理后台操作
 * */
Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin','namespace' => 'Admin'], function () {
    $Admin = 'AdminController@';
    # 后台上传图片文件layer
    Route::get('/upload', ['as' => 'admin.upload', 'uses' => $Admin.'getUpload']);
    Route::post('/upload', ['as' => 'admin.upload.store', 'uses' => $Admin.'postUpload']);
    # 等待 waiting
    Route::resource('waiting', 'AdminWaitingController');
    # 栏目
    Route::resource('sort', 'AdminSortController');
    # 产品
    Route::resource('product', 'AdminProductController');
    # 订单
    Route::resource('order', 'AdminOrderController');

    # 商户
    Route::resource('merchant', 'AdminMerchantController');

    # 城市
    Route::resource('city', 'AdminCityController');

    # 用户
    Route::resource('userDo', 'AdminUserDoController');


});

//Rbac
Route::group(['prefix'=>'rbac', 'middleware' => 'auth.admin','namespace'=>'Admin\Rbac'],function(){
    Route::resource('role', 'RoleController');
    Route::get('role/{id}/permissions',['as'=>'rbac.role.permissions','uses'=>'RoleController@getPerms']);
    Route::post('role/{id}/permissions',['as'=>'rbac.role.permissions','uses'=>'RoleController@postPerms']);
    Route::resource('user', 'UserController');
    Route::resource('permission', 'PermissionController');
});

/*
 * 会员卡系统管理后台操作
 * */
Route::group(['prefix' => 'card', 'middleware' => 'auth.admin','namespace' => 'Card'], function () {
    /* 今日大盘 */
    Route::get('card/home',['as' => 'card.home','uses'=> 'HomeController@index']);
    # 会员卡
    Route::resource('card', 'CardController');
    #  payment 记录
    Route::get('record/payment',['as'=>'card_record_payment','uses'=> 'CardRecordController@payment' ] );
    #  recharge 记录
    Route::get('record/recharge',['as'=>'card_record_recharge','uses'=> 'CardRecordController@recharge' ] );

    #  message 记录
    Route::resource('message','MessageController' );
    # 充值记录
    Route::resource('recharge', 'RechargeController');
    # 补卡记录
    Route::resource('card_update', 'CardUpdateController');

    # 短信群发
    Route::resource('sms', 'SmsController');
    Route::get('jobs',['as'=>'card_sms_jobs','uses'=> 'SmsController@jobs' ]);
    Route::get('records.html',['as'=>'card_sms_record','uses'=> 'SmsController@record' ]);

    # 产品
    Route::resource('product', 'ProductController');
    #  order 订单
    Route::resource('order','OrderController');
    #  cash order 现金支付订单
    Route::resource('cash_order','CashOrderController');
    #  mix order 混合支付订单
    Route::resource('mix_order','MixOrderController');
    # 订单统计
    Route::resource('order_count','OrderCountController');
    # 返现记录
    Route::resource('cash_back', 'CashBackController');
    # market 市场
    Route::resource('market', 'MarketController');

    # market 市场操作员
    Route::resource('operator', 'OperatorController');

    #数据统计报表
//    Route::get('data',['as'=>'card_data_index','uses'=> 'DataReportController@index' ] );
    # 每个市场的统计报表
//    Route::get('data/{id}',['as'=>'card_data_market','uses'=> 'DataReportController@show' ] );
    Route::resource('data', 'DataReportController');
    #数据统计报表 每日增加
//    Route::get('data_day',['as'=>'card_data_day_index','uses'=> 'DataReportController@indexDay' ] );
    # 每个市场的统计报表  每日增加
//    Route::get('data_day/{id}',['as'=>'card_data_day_market','uses'=> 'DataReportController@showDay' ] );
    Route::resource('data_day', 'DataDayReportController');
});