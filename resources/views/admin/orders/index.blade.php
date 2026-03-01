@extends('layouts.admin')

@section('page-title', 'Orders')

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--blue">{{ $stats['total'] }}</div>
            <div>
                <div class="stat-card__value">{{ $stats['total'] }}</div>
                <div class="stat-card__label">Total Orders</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--green">{{ $stats['paid'] }}</div>
            <div>
                <div class="stat-card__value">{{ $stats['paid'] }}</div>
                <div class="stat-card__label">Paid</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--yellow">{{ $stats['pending'] }}</div>
            <div>
                <div class="stat-card__value">{{ $stats['pending'] }}</div>
                <div class="stat-card__label">Pending</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-card__icon stat-card__icon--green">Rp</div>
            <div>
                <div class="stat-card__value">{{ number_format($stats['revenue'], 0, ',', '.') }}</div>
                <div class="stat-card__label">Revenue</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td><strong>{{ $order->order_id }}</strong></td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->package_label }}</td>
                            <td>Rp {{ number_format($order->amount, 0, ',', '.') }}</td>
                            <td>
                                @if($order->status === 'paid')
                                    <span class="badge badge--active">Paid</span>
                                @elseif($order->status === 'pending')
                                    <span class="badge" style="background: #FBF8E2; color: #8B7424;">Pending</span>
                                @else
                                    <span class="badge badge--inactive">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn--secondary btn--sm">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px; color: var(--color-text-muted);">
                                Belum ada order.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection