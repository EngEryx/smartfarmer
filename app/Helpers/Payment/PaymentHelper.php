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
        if ($input['trans_amount'] == 0)
            return null;

        if(!PaymentConfirmation::query()->where(['trans_id' => $input['trans_id']])->exists()){
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

                    $data = [
                        'receipt_no' => $mpesa->bill_ref_number,
                        'customer_id' => $person->id,
                        'phone' => $mpesa->msisdn,
                        'order_id' => $order->id,
                        'amount' => $mpesa->trans_amount
                    ];

                    $payment = Payment::query()->where(array_only($data,['customer_id','phone','booking_id']));

                    if($payment->exists()){
                        $payment = $payment->first();
                        $payment->amount = ($payment->amount + $mpesa->trans_amount);
                        $payment->save();
                    }else{
                        $payment = Payment::create($data);
                    }

                    //Update the order
                    $order->amount = ($order->amount - $payment->amount);

                    $order->status = $order->amount <= 0 ? 1 : 0;
                    $order->save();
                    return $order;
                }else{
                    //the payment is just stored.
                    return null;
                }
            }
        }

        return null;
    }

}