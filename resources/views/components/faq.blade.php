{{-- FAQ Component (Dynamic) --}}
<section class="faq" id="faq">
    <div class="faq__wrapper">

        {{-- Left: Heading + CTA --}}
        <div class="faq__left">
            <h2 class="faq__heading">
                <span class="dark">Frequently Asked</span><br>
                <span class="accent">Questions</span>
            </h2>
            <p class="faq__description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt. Ada
                pertanyaan lain?
            </p>
            <a href="#" class="btn btn-accent-dark">Pelajari Strateginya</a>
        </div>

        {{-- Right: Accordion --}}
        <div class="faq__right">
            @forelse($faqs as $index => $faq)
                <div class="faq-item {{ $index === 0 ? 'faq-item--active' : '' }}">
                    <div class="faq-item__header">
                        <h3 class="faq-item__question">{{ $faq->question }}</h3>
                        <span class="faq-item__toggle">
                            <svg viewBox="0 0 14 8" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L7 7L13 1" stroke="currentColor" stroke-width="2" fill="none" />
                            </svg>
                        </span>
                    </div>
                    <div class="faq-item__answer">
                        <p>{{ $faq->answer }}</p>
                    </div>
                </div>
            @empty
                <p style="color: var(--color-text-muted); font-size: 16px;">
                    FAQ segera hadir.
                </p>
            @endforelse
        </div>

    </div>
</section>