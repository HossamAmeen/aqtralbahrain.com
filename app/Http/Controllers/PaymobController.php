<?php

namespace App\Http\Controllers;

use App\Services\PaymobService;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use DB;

class PaymobController extends Controller
{
    protected $paymob;

    public function __construct(PaymobService $paymob)
    {
        $this->paymob = $paymob;
    }

    public function initiatePayment(Request $request)
    {
        $cart = Cart::where('user_id',auth()->user()->id)->where('order_id',null)->get()->toArray();
        
        $data = [];

        $data['items'] = array_map(function ($item) use($cart) {
            $name=Product::where('id',$item['product_id'])->pluck('title');
            return [
                'name' =>$name ,
                'price' => $item['price'],
                'qty' => $item['quantity']
            ];
        }, $cart);

        $total = 0;

        foreach($data['items'] as $item) {
            $total += $item['price']*$item['qty'];
        }

        $data['total'] = $total;

        if(session('coupon')){
            $data['shipping_discount'] = session('coupon')['value'];
        }

        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => session()->get('id')]);

        $authToken = $this->paymob->getAuthToken();

        $orderData = [
            'delivery_needed' => false,
            'amount_cents' => $total * 100,
            'currency' => 'EGP',
            'merchant_order_id' => uniqid(),
            'items' => $data['items'],
        ];

        $order = $this->paymob->createOrder($authToken, $orderData);
        return $order;
        
        $paymentData = [
            'auth_token' => $authToken,
            'amount_cents' => $order['amount_cents'],
            'order_id' => $order['id'],
            'billing_data' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'currency' => 'EGP',
            'integration_id' => env('PAYMOB_INTEGRATION_ID'),
        ];

        $paymentKey = $this->paymob->generatePaymentKey($authToken, $paymentData);

        return redirect("https://accept.paymobsolutions.com/api/acceptance/iframes/" . env('PAYMOB_IFRAME_ID') . "?payment_token=" . $paymentKey['token']);
    }

    public function webhook(Request $request)
    {
        $hmac = $request->header('hmac');
    
        // Validate HMAC to ensure the request is from Paymob
        $calculatedHmac = hash_hmac('sha512', json_encode($request->all()), config('paymob.hmac_secret'));
    
        if ($hmac !== $calculatedHmac) {
            return response()->json(['status' => 'error', 'message' => 'Invalid HMAC'], 403);
        }
    
        // Check if the event is a successful transaction
        if ($request->type === 'TRANSACTION') {
            $transaction = $request->obj;
    
            if ($transaction['success']) {
                // Retrieve the order using the merchant_order_id or integration order_id
                $orderId = $transaction['order']['merchant_order_id']; // Replace with your order reference field
                $order = Order::where('merchant_order_id', $orderId)->first();
    
                if ($order) {
                    $order->status = 'confirmed'; // Update order status
                    $order->payment_transaction_id = $transaction['id']; // Optionally store transaction ID
                    $order->save();
    
                    return response()->json(['status' => 'success']);
                }
    
                return response()->json(['status' => 'error', 'message' => 'Order not found'], 404);
            }
        }
    
        return response()->json(['status' => 'ignored']);
    }

    public function success(Request $request)
    {
        $transactionId = $request->input('transaction_id'); // Retrieved from the query string

        // Fetch transaction details from Paymob API (optional but recommended)
        $transactionResponse = Http::get("https://accept.paymobsolutions.com/api/acceptance/transactions/{$transactionId}");

        if ($transactionResponse->successful()) {
            $transaction = $transactionResponse->json();

            if ($transaction['success']) {
                // Find the order using the merchant_order_id
                $orderId = $transaction['order']['merchant_order_id'];
                $order = Order::where('merchant_order_id', $orderId)->first();

                if ($order) {
                    $order->status = 'confirmed'; 
                    $order->payment_transaction_id = $transaction['id'];
                    $order->save();
                }

                return view('paymob.success', ['order' => $order]);
            }
        }

        return view('payment.failure'); 
    }

    public function failure(Request $request)
    {
        return view('paymob.failure');
    }

}
