{{-- FOOTER Component --}}
<footer class="footer" id="footer">
    <div class="footer__content">

        {{-- Brand / Logo --}}
        <div class="footer__brand">
            <img src="{{ asset('images/nextgenCommunity.jpg') }}" alt="NextGen Community Logo">
        </div>

        {{-- Quick Links --}}
        <nav class="footer__links">
            <h4 class="footer__links-title">Quick Links</h4>
            <ul>
                <li><a href="#testimoni">Testimoni</a></li>
                <li><a href="#paket">Paket</a></li>
                <li><a href="#faq">FAQ</a></li>
            </ul>
        </nav>

        {{-- Get In Touch --}}
        <div class="footer__contact">
            <h4 class="footer__contact-title">
                Get In <span class="accent">Touch</span>
            </h4>
            <p class="footer__contact-text">
                Lorem ipsum dolor sit amet, consectetur adipiscing eli
            </p>
            <div class="footer__socials">
                <a href="#" aria-label="WhatsApp"><img src="{{ asset('images/ic_baseline-whatsapp.png') }}"
                        alt="WhatsApp"></a>
                <a href="#" aria-label="Instagram"><img src="{{ asset('images/igbaru.png') }}" alt="Instagram"></a>
                <a href="#" aria-label="TikTok"><img src="{{ asset('images/ic_baseline-tiktok.png') }}"
                        alt="TikTok"></a>
                <a href="#" aria-label="Twitter"><img src="{{ asset('images/twitter.png') }}" alt="Twitter"></a>
            </div>
        </div>

    </div>

    <div class="footer__divider"></div>
    <p class="footer__copyright">Copyright 2026. All Rights Reserved.</p>
</footer>