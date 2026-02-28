{{-- NAVBAR Component --}}
<nav class="navbar" id="navbar">
    {{-- Brand --}}
    <a href="#" class="navbar__brand">
        <img src="{{ asset('images/logo.png') }}" alt="NextGen Logo" class="navbar__logo">
        <span class="navbar__name">NEXTGEN</span>
    </a>

    {{-- Navigation Links --}}
    <ul class="navbar__links">
        <li><a href="#testimoni">Testimoni</a></li>
        <li><a href="#paket">Paket</a></li>
        <li><a href="#faq">FAQ</a></li>
    </ul>

    {{-- Hamburger (mobile) --}}
    <button class="navbar__hamburger" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>