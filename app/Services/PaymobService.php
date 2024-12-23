<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    private $baseUrl;
    private $apiKey;

    public function __construct()
    {
        $this->baseUrl = env('PAYMOB_BASE_URL');
        $this->apiKey = env('PAYMOB_API_KEY');
    }

    public function getAuthToken()
    {
        $response = Http::post("{$this->baseUrl}/auth/tokens", [
            'api_key' => $this->apiKey,
        ]);

        return $response->json()['token'] ?? null;
    }

    public function createOrder($authToken, $orderData)
    {
        $response = Http::withToken($authToken)
            ->post("{$this->baseUrl}/ecommerce/orders", $orderData);

        return $response->json();
    }

    public function generatePaymentKey($authToken, $paymentData)
    {
        $paymentData['lock_order_when_paid'] = true; // Optional: Ensures the order is locked after payment
        $paymentData['redirection_url'] = route('paymob.success');
        $paymentData['error_url'] = route('paymob.failure');

        $response = Http::withToken($authToken)
            ->post("{$this->baseUrl}/acceptance/payment_keys", $paymentData);

        return $response->json();
    }
}
