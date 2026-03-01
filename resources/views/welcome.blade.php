<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NextGen - Raih Beasiswa Impianmu</title>
    <meta name="description"
        content="Strategi, Database, dan Mentorship yang terbukti meningkatkan peluang lolos beasiswa hingga 80%. Bergabunglah bersama NextGen sekarang.">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Base: tokens, reset, utilities, buttons (must load first) --}}
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">

    {{-- Component styles --}}
    <link rel="stylesheet" href="{{ asset('css/components/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/stats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/testimonials.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/weapons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/pricing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/faq.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/footer.css') }}">

    {{-- Responsive breakpoints (must load last to override) --}}
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
</head>

<body>

    @include('components.navbar')
    @include('components.hero')
    @include('components.stats')
    @include('components.testimonials')
    @include('components.weapons')
    @include('components.pricing')
    @include('components.faq')
    @include('components.footer')

    {{-- FAQ Accordion Script --}}
    <script>
        document.querySelectorAll('.faq-item__header').forEach(header => {
            header.addEventListener('click', () => {
                const item = header.closest('.faq-item');
                const isActive = item.classList.contains('faq-item--active');

                // Close all
                document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('faq-item--active'));

                // Toggle clicked
                if (!isActive) {
                    item.classList.add('faq-item--active');
                }
            });
        });

        // Mobile hamburger toggle
        const hamburger = document.querySelector('.navbar__hamburger');
        const navbar = document.querySelector('.navbar');
        if (hamburger) {
            hamburger.addEventListener('click', () => {
                navbar.classList.toggle('navbar--open');
            });
        }

        // ---- Testimonial Carousel ----
        (function () {
            const track = document.getElementById('carouselTrack');
            const prevBtn = document.getElementById('carouselPrev');
            const nextBtn = document.getElementById('carouselNext');
            const dots = document.querySelectorAll('.carousel__dot');
            if (!track || !prevBtn || !nextBtn) return;

            let cards = Array.from(track.querySelectorAll('.testimonial-card'));
            let centerIndex = 1; // Start with middle card active

            function render() {
                // Remove all is-active
                cards.forEach(c => c.classList.remove('is-active'));

                // Re-append cards in current order so DOM order = visual order
                cards.forEach(c => track.appendChild(c));

                // Center card is always index 1 (middle of 3)
                if (cards[1]) cards[1].classList.add('is-active');

                // Update dots
                const activeDataIndex = parseInt(cards[1].dataset.index);
                dots.forEach(d => {
                    d.classList.remove('carousel__dot--active');
                    if (parseInt(d.dataset.dot) === activeDataIndex) {
                        d.classList.add('carousel__dot--active');
                    }
                });
            }

            function next() {
                // Rotate left: move first to end → [b, c, a]
                const first = cards.shift();
                cards.push(first);
                render();
            }

            function prev() {
                // Rotate right: move last to front → [c, a, b]
                const last = cards.pop();
                cards.unshift(last);
                render();
            }

            nextBtn.addEventListener('click', next);
            prevBtn.addEventListener('click', prev);

            // Dot click
            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const target = parseInt(dot.dataset.dot);
                    // Rotate until target is center
                    let safety = 0;
                    while (parseInt(cards[1].dataset.index) !== target && safety < cards.length) {
                        next();
                        safety++;
                    }
                });
            });

            // Initialize: set center card
            render();
        })();
    </script>

</body>

</html>