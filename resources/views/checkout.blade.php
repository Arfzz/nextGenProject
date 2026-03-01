<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout {{ $pkg['name'] }} — NextGen</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/checkout.css') }}">

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ $clientKey }}"></script>
</head>

<body>
    <div class="checkout">
        <div class="checkout__summary">
            <h2>Paket Dipilih</h2>
            <h1><span>{{ $pkg['name'] }}</span></h1>
            <div class="checkout__price">Rp {{ number_format($pkg['price'], 0, ',', '.') }}</div>
            <p class="checkout__desc">{{ $pkg['description'] }}</p>
            <a href="/#paket" class="checkout__back">← Kembali ke halaman utama</a>
        </div>

        <div class="checkout__form">
            <h2>Detail Pembeli</h2>
            <div class="form-error-msg" id="errorMsg"></div>

            <form id="checkoutForm">
                <input type="hidden" name="package" value="{{ $package }}">

                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required placeholder="Nama lengkap kamu">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required placeholder="email@example.com">
                </div>
                <div class="form-group">
                    <label for="phone">No. WhatsApp (opsional)</label>
                    <input type="text" id="phone" name="phone" placeholder="08xxxxxxxxxx">
                </div>

                <button type="submit" class="btn-pay" id="payBtn">Bayar Sekarang</button>
            </form>

            <p class="secure-note">🔒 Pembayaran diproses secara aman oleh Midtrans</p>
        </div>
    </div>

    <script>
        const form = document.getElementById('checkoutForm');
        const payBtn = document.getElementById('payBtn');
        const errorMsg = document.getElementById('errorMsg');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            payBtn.disabled = true;
            payBtn.textContent = 'Memproses...';
            errorMsg.style.display = 'none';

            const formData = new FormData(form);
            const data = Object.fromEntries(formData.entries());

            try {
                const res = await fetch('{{ route("checkout.process") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data),
                });

                if (!res.ok) {
                    const err = await res.json();
                    throw new Error(err.message || 'Terjadi kesalahan.');
                }

                const result = await res.json();

                window.snap.pay(result.snap_token, {
                    onSuccess: () => window.location.href = '{{ route("checkout.finish") }}',
                    onPending: () => window.location.href = '{{ route("checkout.finish") }}',
                    onError: () => {
                        errorMsg.textContent = 'Pembayaran gagal. Silakan coba lagi.';
                        errorMsg.style.display = 'block';
                        payBtn.disabled = false;
                        payBtn.textContent = 'Bayar Sekarang';
                    },
                    onClose: () => {
                        payBtn.disabled = false;
                        payBtn.textContent = 'Bayar Sekarang';
                    }
                });
            } catch (err) {
                errorMsg.textContent = err.message;
                errorMsg.style.display = 'block';
                payBtn.disabled = false;
                payBtn.textContent = 'Bayar Sekarang';
            }
        });
    </script>
</body>

</html>