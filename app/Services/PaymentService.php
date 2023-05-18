<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymentService
{
    public function sendRequest($url, $data, $timeout = 3){
        info('request : '.$url);
        info($data);
        $resp = Http::timeout($timeout)->withHeaders([
            'Authorization' => 'Bearer ' . base64_encode(getenv('TOKEN_PAYMENT')),
        ])->post($url, $data);
        info('response : '.$url);
        info($resp->json());
        return $resp;
    }

    public function sendDeposit($data){
        $url = config('services.payment.url').'/api/deposit';
        $timeout  = config('services.payment.timeout');
        return $this->sendRequest($url, $data, $timeout);
    }

    public function sendCheckBalance($data){
        $url = config('services.payment.url').'/api/check-balance';
        $timeout  = config('services.payment.timeout');
        return $this->sendRequest($url, $data, $timeout);
    }

    public function sendWithdrawal($data){
        $url = config('services.payment.url').'/api/deposit';
        $timeout  = config('services.payment.timeout');
        return $this->sendRequest($url, $data, $timeout);
    }

}