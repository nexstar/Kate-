<?php

//-- 20180917

Route::get('OnlineProductController/offline/{id}','OnlineProductController@offline')->name('Online.Product.offline');
Route::get('OnlineProductController/online/{id}','OnlineProductController@online')->name('Online.Product.online');
Route::get('OnlineProductController/small/{id}','OnlineProductController@smallitem')->name('Online.Product.ajaxsmall');

//-- end of 20180917

//-- 20180916
Route::put('OnlineProductDiscountController/allweb/{id}','OnlineProductDiscountController@allwebupdate')->name('Online.Product.Discount.allweb');
Route::put('OnlineProductDiscountController/fullamount/{id}','OnlineProductDiscountController@fullamountupdate')->name('Online.Product.Discount.fullamount');
Route::put('OnlineProductDiscountController/bonus/{id}','OnlineProductDiscountController@bonusupdate')->name('Online.Product.Discount.bonus');
//-- end of 20180916

//-- 20180915
Route::get('/OnlineProductItemsController/small/{id}','OnlineProductItemsController@smallshow')->name('Online.Product.small.Items.show');
Route::post('/OnlineProductItemsController/small','OnlineProductItemsController@smallitemstore')->name('Online.Product.small.Items.store');
Route::put('/OnlineProductItemsController/small/{id}','OnlineProductItemsController@smallitemupdate')->name('Online.Product.small.Items.update');
Route::delete('/OnlineProductItemsController/small/{id}','OnlineProductItemsController@smallitemdestroy')->name('Online.Product.small.Items.destroy');

Route::post('/OnlineProductItemsController/big','OnlineProductItemsController@bigitemstore')->name('Online.Product.big.Items.store');
Route::put('/OnlineProductItemsController/big/{id}','OnlineProductItemsController@bigitemupdate')->name('Online.Product.bigItems.update');
Route::delete('/OnlineProductItemsController/big/{id}','OnlineProductItemsController@bigitemdestroy')->name('Online.Product.bigItems.destroy');
//-- end of 20180915

//-- 20180914
Route::get('/Online', 'OnlineController@index')->name('Online.index');
Route::put('/Online/slide/{id}', 'OnlineController@slide')->name('Online.slide');
Route::put('/Online/hotproduct/{id}', 'OnlineController@hotproduct')->name('Online.hotproduct');
Route::put('/Online/hotarticle/{id}', 'OnlineController@hotarticle')->name('Online.hotarticle');
Route::put('/friend/{id}', 'OnlineFriendController@update')->name('Online.Friend.update');
// end of 20180914

//-- 20180911
Route::post('/jnadbase64upload',[
    'as' => 'jnadtoken',
    'uses' => 'jnadtokenController@upload',
]);
//-- end of 20180911

//-- 20180910
Route::get('/OnlineTransactionRecordController', [
   'as' => 'onlinetransactionrecordcontroller',
   'uses'=>'OnlineTransactionRecordController@index'
]);

Route::resource('/onlineproduct', 'OnlineProductController');

Route::get('/OnlineTransactionRecordController/info/{info}', [
    'as' => 'onlinetransactionrecordcontroller.info',
    'uses'=>'OnlineProductController@info'
]);

Route::resource('/onlineproductdiscount', 'OnlineProductDiscountController');
Route::resource('/onlineproducttpye', 'OnlineProductTpyeController');

Route::get('/OnlineProductItemsController', [
    'as' => 'onlineproductitemscontroller.index',
    'uses'=>'OnlineProductItemsController@index'
]);

Route::resource('/onlinecourse', 'OnlineCourseController');

Route::resource('/onlinedatacenter', 'OnlineDataCenterController');

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

//-- end fo 20180910

//-- 20180907
Route::get('/friend', 'OnlineFriendController@index')->name('Online.Friend.index');

Route::resource('/onlinearticle', 'OnlineArticleController');

Route::resource('/onlinenew', 'OnlineNewController');

Route::resource('/customertimersms', 'CustomerTimerSmsController');
//--- end of 20180907

    Route::get('/', function () {
        return view('welcome');
    });

//用戶新增測試
    Route::get('/TestInsertUser', [
        'as' => 'TestInsertUser',
        'uses' => 'UserController@TestInsertUser'
    ]);

    //Login OK
    Route::post('/login', [
		'as' => 'logon',
		'uses' => 'UserController@login'
	])->name('UserController.login');

Route::group([ 'middleware' => ['logonauth'] ], function(){
 
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


