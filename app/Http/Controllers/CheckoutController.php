<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    private array $packages = [
        'scholar-vault' => [
            'name' => 'Scholar Vault',
            'price' => 19000,
            'description' => 'Akses database kalender + dokumen, komunitas NextGen Inner Circle',
        ],
        'private-copilot' => [
            'name' => 'Private Co-Pilot',
            'price' => 99000,
            'description' => 'Chat pribadi 24/7, akses penuh database, 1-on-1 bedah dokumen',
        ],
    ];

    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function show(string $package)
    {
        if (!isset($this->packages[$package])) {
            abort(404, 'Paket tidak ditemukan.');
        }

        $pkg = $this->packages[$package];
        $clientKey = env('MIDTRANS_CLIENT_KEY');

        return view('checkout', compact('package', 'pkg', 'clientKey'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'package' => 'required|string|in:scholar-vault,private-copilot',
        ]);

        $pkg = $this->packages[$request->package];
        $orderId = 'NG-' . time() . '-' . rand(100, 999);

        $order = Order::create([
            'order_id' => $orderId,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'package' => $request->package,
            'amount' => $pkg['price'],
            'status' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $pkg['price'],
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone ?? '',
            ],
            'item_details' => [
                [
                    'id' => $request->package,
                    'price' => $pkg['price'],
                    'quantity' => 1,
                    'name' => $pkg['name'],
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $order->update(['snap_token' => $snapToken]);

        return response()->json([
            'snap_token' => $snapToken,
            'order_id' => $orderId,
        ]);
    }

    public function finish()
    {
        return view('checkout-finish');
    }
}
