<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 2/7/18
 * Time: 9:28 AM
 */

namespace App\Helpers\Payment;

use App\Order;
use App\Payment;
use App\PaymentConfirmation;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentHelper
{
    private $sms;

    public function __construct()
    {

    }

    private static function formatPhoneNumber($msisdn)
    {
        return $msisdn;
//        if(starts_with($msisdn,'+254')
//        return substr($msisdn,1);
    }

    public function process($input)
    {
        if($input['trans_amount'] == 0)
            return;

        if(!PaymentConfirmation::query()->where(['trans_id'=>$input['trans_id']])->exists())

            DB::transaction(function() use ($input){

            #payment confirmation
            $data = $input;

            //Remove the statement below.
            $data['kyc_name'] = ends_with($data['kyc_name'],'.New')?str_replace('.New','',$data['kyc_name']):$data['kyc_name'];

            $phone = self::formatPhoneNumber($input['msisdn']);

            $person = User::where('phone', $phone)->first();

            if(!is_null($person)){
                $data['user_id'] = $person->id;
                $data['status'] = true;
            }

            $mpesa = PaymentConfirmation::query()->create($data);

            #create transaction if user is found
            if (!is_null($person)){

                #query the latest customer orders.
                $order = Order::where(['user_id'=>$person->id,'status'=>0])->latest()->first();

                if($order){
                    $payment = Payment::create([
                        'receipt_no' => $mpesa->bill_ref_number,
                        'customer_id' => $person->id,
                        'phone' => $mpesa->msisdn,
                        'booking_id' => $order->id,
                        'amount' => $mpesa->trans_amount
                    ]);
                    $order->status = 1;
                    $order->save();
                }else{
                    //the payment is just stored.
                }
            }
        });
    }
}