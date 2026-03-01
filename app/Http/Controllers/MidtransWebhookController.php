<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Notification;

class MidtransWebhookController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
    }

    public function handle(Request $request)
    {
        try {
            $notification = new Notification();

            $orderId = $notification->order_id;
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status ?? null;

            $order = Order::where('order_id', $orderId)->first();

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            $order->midtrans_response = $request->all();

            if ($transactionStatus === 'capture') {
                $order->status = ($fraudStatus === 'accept') ? 'paid' : 'failed';
            } elseif ($transactionStatus === 'settlement') {
                $order->status = 'paid';
            } elseif (in_array($transactionStatus, ['cancel', 'deny'])) {
                $order->status = 'failed';
            } elseif ($transactionStatus === 'expire') {
                $order->status = 'expired';
            } elseif ($transactionStatus === 'pending') {
                $order->status = 'pending';
            }

            if ($order->status === 'paid' && !$order->paid_at) {
                $order->paid_at = now();
            }

            $order->save();

            return response()->json(['message' => 'OK']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}
