<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: content-type,x-xsrf-token, X-Request-Signature');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Payments
Route::resource('/mnet/sms/gateway', 'GatewayAPI');

Route::get('/', 'IndexController@index')->name('landing');
Route::get('/chemicals', 'IndexController@chemicals')->name('index-chemicals');
Route::get('/fertilisers', 'IndexController@fertilisers')->name('index-fertilisers');

Route::group(['prefix'=>'admin', 'middleware'=>['auth','admins']],function(){
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('orders', 'AdminController@orders')->name('admin.orders');
    Route::get('customers', 'AdminController@customers')->name('admin.customers');
    Route::get('payments', 'AdminController@payments')->name('admin.payments');
    Route::get('products', 'AdminController@products')->name('admin.products');
    Route::view('products/add-new', 'admin.products-create')->name('admin.products.add');
    Route::post('products/add-save', 'AdminController@saveProduct')->name('admin.products.save');
});

Route::group(['middleware'=>'auth'],function(){
    //Customer dashboard.
    Route::get('/home', 'HomeController@index')->name('home');

//    #Booking
    Route::get('/booking/{product}/new', 'OrderController@book')->name('frontend.order.new');
    Route::get('/booking/{product}/new-confirm', 'OrderController@bookconfirm')->name('frontend.order.new-confirm');
    Route::get('/booking/{order}/view/pay', 'OrderController@viewBooking')->name('frontend.order.view-pay');

});

Auth::routes();

