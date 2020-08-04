<?php

namespace App\Http\Controllers;

use App\PaymentLog;
use App\PG_Signature;
use App\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function PayBox($amount, $userId)
    {
        $arrReq = [
            'pg_merchant_id' => null,#@ToDo get merchant_id,
            'pg_amount' => $amount,
            'pg_description' => '5Second payment',
            'pg_order_id' => $userId,
            'pg_salt' => mt_rand(21, 43433),
            'pg_result_url' => url('PayBoxResult')
        ];
        $arrReq['pg_sig'] = PG_Signature::make('payment.php', $arrReq, ''); #@ToDo get secret key

        $query = http_build_query($arrReq);

        $url = 'https://www.paybox.kz/payment.php?'.$query;

        PaymentLog::create([
            'user_id' => $userId,
            'amount' => $amount,
            'status' => 1,
            'description' => ''
        ]);

        return redirect()->to($url);
    }

    public function PayBoxResult(Request $request)
    {
        if($request['pg_result']) {
            $user = User::find($request['pg_order_id']);
            #@Todo Some action after result
//            $user->balance += $request['pg_amount'];
//            $user->save();

            $arrReq = [
                'pg_merchant_id' => null,#@ToDo get merchant_id,
                'pg_salt' => mt_rand(21, 43433)
            ];
            $pg_sig = PG_Signature::make('payment.php', $arrReq, ''); #@ToDo get secret key
            $pg_salt = str_random(10);

            $xmlResponce = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<response>
<pg_salt>$pg_salt</pg_salt>
<pg_status>ok</pg_status>
<pg_description>Клиент оплатил абонемент</pg_description>
<pg_sig>$pg_sig</pg_sig>
</response>
XML;

            return $xmlResponce;
        }
        return null;
    }
}
