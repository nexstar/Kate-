<?php

Route::get('/', function () {
    return view('welcome');
});

//用戶新增測試
//Route::get('/TestInsertUser', [
//    'as' => 'TestInsertUser',
//    'uses' => 'UserController@TestInsertUser'
//]);

Route::resource('/fblive','fblivecontroller');

Route::get('/fblive/fbclose/{id}/{number}',[
    'as' => 'fblive.fbclose',
    'uses' => 'fblivecontroller@fbclose',
]);

//Login OK
    Route::post('/login', [
        'as' => 'logon',
        'uses' => 'UserController@login'
    ])->name('UserController.login');

//GreenPet picload
    Route::post('/jnadbase64upload',[
        'as' => 'jnadtoken.upload',
        'uses' => 'jnadtokenController@upload',
    ]);

    Route::get('/rmpic/{id}',[
        'as' => 'jnadtoken.rmpic',
        'uses' => 'jnadtokenController@rmpic',
    ]);

//SmsVerify
    Route::post('/smsserify',[
        'as' => 'sms.smsverify',
        'uses' => 'SmsController@smsverify',
    ]);


Route::group([ 'middleware' => ['logonauth'] ], function(){
//GreenPet
    //部落格
    Route::resource('/greenpetblog','GreenPetBlogController');

    Route::get('/greenpetblogsendnotifi/{id}',[
        'as' => 'greenpetblog.sendNotifi',
        'uses' => 'GreenPetBlogController@sendNotifi'
    ]);

    //訊息通知(單)
    Route::resource('/greenpetnotifisingle','GreenPetNotifiSingleController');

    Route::get('/greenpetnotifisingle/info/{id}',[
        'as' => 'greenpetnotifisingle.info',
        'uses' => 'GreenPetNotifiSingleController@info'
    ]);

    Route::get('/greenpetnotifisingle/notifi/{id}',[
        'as' => 'greenpetnotifisingle.notifi',
        'uses' => 'GreenPetNotifiSingleController@notifi'
    ]);

    Route::post('/greenpetnotifisingle/depth}',[
        'as' => 'greenpetnotifisingle.depth',
        'uses' => 'GreenPetNotifiSingleController@depth'
    ]);

    //訊息通知(單-預約)
    Route::resource('/greenpetnotifireservesingle','GreenPetNotifiReserveSingleController');

    Route::get('/greenpetnotifireservesingle/info/{id}',[
        'as' => 'greenpetnotifireservesingle.info',
        'uses' => 'GreenPetNotifiReserveSingleController@info'
    ]);

    //訊息通知(群)
    Route::resource('/greenpetnotifigroup','GreenPetNotifiGroupController');

    Route::get('/greenpetnotifigroup/info/{id}',[
        'as' => 'greenpetnotifigroup.info',
        'uses' => 'GreenPetNotifiGroupController@info'
    ]);

    Route::get('/greenpetnotifigroup/notifi/{id}',[
        'as' => 'greenpetnotifigroup.notifi',
        'uses' => 'GreenPetNotifiGroupController@notifi'
    ]);

    //訊息通知(群-預約)
    Route::resource('/greenpetnotifireservegroup','GreenPetNotifiReserveGroupController');

    Route::get('/greenpetnotifireservegroup/info/{id}',[
        'as' => 'greenpetnotifireservegroup.info',
        'uses' => 'GreenPetNotifiReserveGroupController@info'
    ]);

    Route::get('/greenpetnotifireservegroup/notifi/{id}',[
        'as' => 'greenpetnotifireservegroup.notifi',
        'uses' => 'GreenPetNotifiReserveGroupController@notifi'
    ]);

    //幻燈片
    Route::group(['prefix' => 'greenpetslide'],function () {
        Route::get('/', [
            'as' => 'greenpetslide.index',
            'uses' => 'GreenPetSlideController@index',
        ]);

        Route::put('/{id}', [
            'as' => 'greenpetslide.store',
            'uses' => 'GreenPetSlideController@store',
        ]);
    });

//數據中心
    Route::get('OnlineDataCenterPage',
        'OnlineDataCenterController@index'
    )->name('Online.DataCenter.index');

    Route::get('OnlineDataCenterPage/clientinfosheet/{id}',
        'OnlineDataCenterController@clientinfosheet'
    )->name('Online.DataCenter.clientinfosheet');

    Route::get('OnlineDataCenterPage/clientinfobought/{id}',
        'OnlineDataCenterController@clientinfobought'
    )->name('Online.DataCenter.clientinfobought');

//商品設定
    Route::get('/OnlineProductController/onoffline/{id}/{uplow}',
        'OnlineProductController@onoffline'
    )->name('Online.Product.onoffline');

    Route::get('/OnlineProductItemsController/pdname/{id}',
        'OnlineProductController@pdname'
    )->name('Online.Product.pdname');

    // 小項資訊由 Online.Product.small.Items.show 獲得

//    Route::get('/OnlineProductController',
//        'OnlineProductController@index'
//    )->name('Online.Product.online');

//商品折扣
    Route::resource('/onlineproductdiscount', 'OnlineProductDiscountController');

    Route::put('/OnlineProductDiscountController/allweb/{id}',
        'OnlineProductDiscountController@allwebupdate'
    )->name('Online.Product.Discount.allweb');

    Route::put('/OnlineProductDiscountController/fullamount/{id}',
        'OnlineProductDiscountController@fullamountupdate'
    )->name('Online.Product.Discount.fullamount');

    Route::put('/OnlineProductDiscountController/bonus/{id}',
        'OnlineProductDiscountController@bonusupdate'
    )->name('Online.Product.Discount.bonus');

//商品大小項
    Route::get('/OnlineProductItemsController', [
        'as' => 'onlineproductitemscontroller.index',
        'uses'=>'OnlineProductItemsController@index'
    ]);

    Route::get('/OnlineProductItemsController/small/{id}',
        'OnlineProductItemsController@smallshow'
    )->name('Online.Product.small.Items.show');

    Route::post('/OnlineProductItemsController/small',
        'OnlineProductItemsController@smallitemstore'
    )->name('Online.Product.small.Items.store');

    Route::put('/OnlineProductItemsController/small/{id}',
        'OnlineProductItemsController@smallitemupdate'
    )->name('Online.Product.small.Items.update');

    Route::delete('/OnlineProductItemsController/small/{id}',
        'OnlineProductItemsController@smallitemdestroy'
    )->name('Online.Product.small.Items.destroy');

    Route::post('/OnlineProductItemsController/big',
        'OnlineProductItemsController@bigitemstore'
    )->name('Online.Product.big.Items.store');

    Route::put('/OnlineProductItemsController/big/{id}',
        'OnlineProductItemsController@bigitemupdate'
    )->name('Online.Product.bigItems.update');

    Route::delete('/OnlineProductItemsController/big/{id}',
        'OnlineProductItemsController@bigitemdestroy'
    )->name('Online.Product.bigItems.destroy');

//首頁
    Route::get('/Online', 'OnlineController@index')->name('Online.index');
    Route::put('/Online/slide/{id}', 'OnlineController@slide')->name('Online.slide');
    Route::put('/Online/hotproduct/{id}', 'OnlineController@hotproduct')->name('Online.hotproduct');
    Route::put('/Online/hotarticle/{id}', 'OnlineController@hotarticle')->name('Online.hotarticle');

//朋友肯定
    Route::put('/friend/{id}', 'OnlineFriendController@update')->name('Online.Friend.update');
    Route::get('/friend', 'OnlineFriendController@index')->name('Online.Friend.index');

//交易記錄
    Route::get('/OnlineTransactionRecordController', [
       'as' => 'onlinetransactionrecordcontroller',
       'uses'=>'OnlineTransactionRecordController@index'
    ]);

//商品資訊
    Route::get('/OnlineTransactionRecordController/info/{info}', [
        'as' => 'onlinetransactionrecordcontroller.info',
        'uses'=>'OnlineProductController@info'
    ]);

//商品首頁
    Route::resource('/onlineproduct', 'OnlineProductController');

//商品分類
    Route::resource('/onlineproducttpye', 'OnlineProductTpyeController');

//課程
    Route::resource('/onlinecourse', 'OnlineCourseController');
    Route::get('/onlinecourse/{id}/{uplow}',
        'OnlineCourseController@onoff'
    )->name('course.onoff');

//文章
    Route::resource('/onlinearticle', 'OnlineArticleController');
    Route::get('/onlinearticle/{id}/{uplow}',
        'OnlineArticleController@onoffonline'
    )->name('Article.onoffonline');

//新聞
    Route::resource('/onlinenew', 'OnlineNewController');

//簡訊群組-預約發送
    Route::resource('/customertimersms', 'CustomerTimerSmsController');

//網路流量
    Route::get('/onlinedatacenternetworktraffic/y', [
        'as' => 'onlinedatacenternetworktrafficY',
        'uses' => 'OnlineDataCenterNetworkTrafficController@y'
    ]);

    Route::get('/onlinedatacenternetworktraffic/m/{m}/y/{y}', [
        'as' => 'onlinedatacenternetworktrafficM',
        'uses' => 'OnlineDataCenterNetworkTrafficController@m'
    ]);

    Route::get('/onlinedatacenternetworktraffic/d/{d}/m/{m}/y/{y}', [
        'as' => 'onlinedatacenternetworktrafficD',
        'uses' => 'OnlineDataCenterNetworkTrafficController@d'
    ]);

//初始middleware.logonauth
	Route::get('/success', [
		'as' => 'success',
		'uses' => 'UserController@index'
	])->name('UserController.index');


	Route::resource('/customerinfo','CustomerInfoController');
	Route::resource('/customergroup','CustomerGroupController');
	
	Route::get('/ExcelExport', 'CustomerInfoController@ExcelExport')->name('customerinfo.ExcelExport');

	Route::get('/headinfo', 'UserController@edit')->name('UserController.edit');
	Route::post('/usercontrollerupdate', 'UserController@update')->name('UserController.update');

	Route::post('singlesms', 'SmsController@Single')->name('smscontroller.single');
	Route::get('groupsms/{id}', 'SmsController@Group')->name('smscontroller.group');
	Route::post('sendsms', 'SmsController@Send')->name('smscontroller.send');

});

//errors
    Route::group(['prefix' => 'errors'],function (){

        Route::get('/403', function () {
            return view('errors.403');
        })->name('errors.403');

        Route::get('/404', function () {
            return view('errors.404');
        })->name('errors.404');

        Route::get('/443', function () {
            return view('errors.443');
        })->name('errors.443');

        Route::get('/500', function () {
            return view('errors.500');
        })->name('errors.500');

        Route::get('/503', function () {
            return view('errors.503');
        })->name('errors.503');

    });


