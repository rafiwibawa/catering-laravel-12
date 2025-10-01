<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class DuitkuService
{
    protected $merchantCode;
    protected $apiKey;
    protected $paymentUrl;

    public function __construct()
    {
        $this->merchantCode = config('app.duitku.merchant_code');
        $this->apiKey = config('app.duitku.api_key');
        $this->paymentUrl = config('app.duitku.payment_url');
    }

    public function createPayment(array $order)
    { 
        $signature = md5($this->merchantCode . $order['merchantOrderId'] . $order['paymentAmount'] . $this->apiKey); 
        $payload = array_merge($order, [
            'merchantCode' => $this->merchantCode,
            'signature' => $signature,
        ]); 

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->paymentUrl . '/webapi/api/merchant/v2/inquiry', $payload); 
 
        return $response->json();
    } 
}
