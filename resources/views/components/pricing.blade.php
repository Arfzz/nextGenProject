<section class="pricing" id="paket">
    <h2 class="section-title"> <span class="dark">Low Cost, </span><span class="accent">High</span><span class="dark">
            Return Value</span> </h2>
    <div class="pricing__grid">
        {{-- Card 1: Intel Channel (Free) --}}
        <article class="pricing-card">
            <div class="pricing-card__header">
                <div class="pricing-card__icon pricing-card__icon--green"><img
                        src="{{ asset('images/uil_channel.png') }}" alt="Intel Channel"></div>
                <h3 class="pricing-card__plan-name">Intel Channel</h3>
            </div>
            <ul class="pricing-card__features">
                <li>Cocok untuk pencari info dasar</li>
                <li>Bergabung ke komunitas Channel Info</li>
                <li>Tersedia tanpa batas</li>
            </ul>
            <div class="pricing-card__footer">
                <div> <span class="pricing-card__price">Gratis</span> </div>
                <a href="#" class="pricing-card__arrow" aria-label="Pilih paket Intel Channel">
                    <img src="{{ asset('images/icon-park-outline_right-c.png') }}" alt="">
                </a>
            </div>
        </article>

        {{-- Card 2: Scholar Vault --}}
        <article class="pricing-card">
            <span class="pricing-card__badge">-77%</span>
            <div class="pricing-card__header">
                <div class="pricing-card__icon pricing-card__icon--blue"><img
                        src="{{ asset('images/mingcute_unlock-line.png') }}" alt=""> </div>
                <h3 class="pricing-card__plan-name">Scholar Vault</h3>
            </div>
            <ul class="pricing-card__features">
                <li>Cocok untuk pejuang mandiri</li>
                <li>Bergabung ke komunitas NextGen Inner Circle</li>
                <li>Akses database kalender + dokumen</li>
                <li>Tersedia tanpa batas</li>
            </ul>
            <div class="pricing-card__footer">
                <div> <span class="pricing-card__old-price">Rp 89.000</span> <span class="pricing-card__price">Rp
                        19.000</span> </div>
                <a href="{{ route('checkout', 'scholar-vault') }}" class="pricing-card__arrow"
                    aria-label="Pilih paket Scholar Vault">
                    <img src="{{ asset('images/icon-park-outline_right-c.png') }}" alt="">
                </a>
            </div>
        </article>

        {{-- Card 3: Private Co-Pilot --}}
        <article class="pricing-card">
            <div class="pricing-card__header">
                <div class="pricing-card__icon pricing-card__icon--yellow"><img
                        src="{{ asset('images/material-symbols_crown-outline-rounded.png') }}" alt=""></div>
                <h3 class="pricing-card__plan-name">Private Co-Pilot</h3>
            </div>
            <ul class="pricing-card__features">
                <li>Cocok untuk yang butuh mentor</li>
                <li>Dapat chat pribadi 24/7</li>
                <li>Akses penuh ke database</li>
                <li>1-on-1 bedah dokumen</li>
                <li>Kuota terbatas</li>
            </ul>
            <div class="pricing-card__footer">
                <div> <span class="pricing-card__price">Chat for more info</span> </div>
                <a href="{{ route('checkout', 'private-copilot') }}" class="pricing-card__arrow"
                    aria-label="Pilih paket Private Co-Pilot">
                    <img src="{{ asset('images/icon-park-outline_right-c.png') }}" alt="">
                </a>
            </div>
        </article>
    </div>
</section>