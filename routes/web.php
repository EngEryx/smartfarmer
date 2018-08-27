<?php

use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;

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
Route::get('/machinery', 'IndexController@machinery')->name('index-machinery');

Route::group(['prefix'=>'admin', 'middleware'=>['auth','admins']],function(){
    Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('orders', 'AdminController@orders')->name('admin.orders');
    Route::get('customers', 'AdminController@customers')->name('admin.customers');
    Route::get('payments', 'AdminController@payments')->name('admin.payments');
    Route::get('products', 'AdminController@products')->name('admin.products');
    Route::view('products/add-new', 'admin.products-create')->name('admin.products.add');
    Route::post('products/add-save', 'AdminController@saveProduct')->name('admin.products.save');
    Route::get('orders/print', 'AdminController@downloadOrders')->name('admin.print-orders');

    Route::post('products/{product}/delete/item', 'AdminController@deleteProduct')->name('admin.products.delete');
    Route::get('products/{product}/edit', 'AdminController@editProduct')->name('admin.products.edit');
    Route::post('products/{product}/edit/save', 'AdminController@saveEditProduct')->name('admin.products.edit.save');
    //Others.
    Route::get('feedback',function(){
        $feedbacks = \App\Feedback::all();
        return view('admin.feedback',compact('feedbacks'));
    })->name('admin.feedback');
    Route::get('feedback/print', function(){
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('print.feedback-report')->with([
            'feedbacks' => \App\Feedback::all()
        ]));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        return $dompdf->stream(Carbon::today()->format('d M Y'));
    })->name('admin.print-feedback');

    Route::get('payment/print', function(){
        $options = new Options();
        $options->setIsRemoteEnabled(true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('print.payment-report')->with([
            'payments' => \App\Payment::all()
        ]));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        return $dompdf->stream(Carbon::today()->format('d M Y'));
    })->name('admin.print-payments');
});

Route::group(['middleware'=>['auth','clients']],function(){
    //Customer dashboard.
    Route::get('/home', 'HomeController@index')->name('home');

    //Orders
    Route::get('/order/{product}/new', 'OrderController@book')->name('frontend.order.new');
    Route::post('/order/{product}/add/cart', 'OrderController@AddToCart')->name('frontend.order.add-to-cart');
    Route::get('/order/{product}/new-confirm', 'OrderController@bookconfirm')->name('frontend.order.new-confirm');
    Route::get('/order/{order}/view/pay', 'OrderController@viewBooking')->name('frontend.order.view-pay');

    Route::view('/new/feedback', 'feedback')->name('feedback');
    Route::post('/feedback/save', 'IndexController@feedback')->name('feedback.save');

    Route::get('/order/view/cart', 'OrderController@ViewCart')->name('frontend.order.view-cart');
    Route::get('/order/checkout/cart', 'OrderController@CheckoutCart')->name('frontend.order.checkout-cart');

});

Auth::routes();

Route::get('/test', function(){
    session()->forget('customer_cart'.auth()->user()->id);
    return redirect()->back();
});

