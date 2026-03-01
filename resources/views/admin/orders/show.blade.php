@extends('layouts.admin')

@section('page-title', 'Detail Order')

@section('content')
    <div style="margin-bottom: 20px;">
        <a href="{{ route('admin.orders.index') }}" class="btn btn--secondary">← Kembali</a>
    </div>

    <div class="card" style="max-width: 700px;">
        <table style="width: 100%;">
            <tr>
                <td style="padding: 10px 16px; font-weight: 600; width: 160px;">Order ID</td>
                <td style="padding: 10px 16px;">{{ $order->order_id }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 16px; font-weight: 600;">Nama</td>
                <td style="padding: 10px 16px;">{{ $order->name }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 16px; font-weight: 600;">Email</td>
                <td style="padding: 10px 16px;">{{ $order->email }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 16px; font-weight: 600;">Phone</td>
                <td style="padding: 10px 16px;">{{ $order->phone ?? '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 16px; font-weight: 600;">Paket</td>
                <td style="padding: 10px 16px;">{{ $order->package_label }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 16px; font-weight: 600;">Harga</td>
                <td style="padding: 10px 16px;">Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 16px; font-weight: 600;">Status</td>
                <td style="padding: 10px 16px;">
                    @if($order->status === 'paid')
                        <span class="badge badge--active">Paid</span>
                    @elseif($order->status === 'pending')
                        <span class="badge" style="background: #FBF8E2; color: #8B7424;">Pending</span>
                    @else
                        <span class="badge badge--inactive">{{ ucfirst($order->status) }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <td style="padding: 10px 16px; font-weight: 600;">Paid At</td>
                <td style="padding: 10px 16px;">{{ $order->paid_at ? $order->paid_at->format('d M Y H:i:s') : '-' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px 16px; font-weight: 600;">Dibuat</td>
                <td style="padding: 10px 16px;">{{ $order->created_at->format('d M Y H:i:s') }}</td>
            </tr>
        </table>
    </div>

    @if($order->midtrans_response)
        <div class="card" style="max-width: 700px; margin-top: 20px;">
            <h3 style="margin-bottom: 12px;">Midtrans Response</h3>
            <pre
                style="background: var(--color-light-bg); padding: 16px; border-radius: 10px; font-size: 12px; overflow-x: auto;">{{ json_encode($order->midtrans_response, JSON_PRETTY_PRINT) }}</pre>
        </div>
    @endif
@endsection