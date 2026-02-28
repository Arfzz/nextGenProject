{{-- TESTIMONIALS Carousel Component (Dynamic) --}}
<section class="testimonials" id="testimoni">
    <h2 class="section-title">
        <span class="dark">Bukti </span><span class="accent">Nyata</span><span class="dark">, No Drama</span>
    </h2>

    @if($testimonials->count() > 0)
        <div class="testimonials__carousel" id="testimonialCarousel">
            {{-- Prev Button --}}
            <button class="carousel__btn carousel__btn--prev" id="carouselPrev" aria-label="Previous testimonial">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>

            {{-- Cards Track --}}
            <div class="carousel__track" id="carouselTrack">
                @foreach($testimonials as $index => $testimonial)
                    <article class="testimonial-card" data-index="{{ $index }}">
                        <img src="{{ $testimonial->photo ? asset('storage/' . $testimonial->photo) : asset('images/rifaldi.png') }}"
                            alt="Testimoni {{ $testimonial->name }}" class="testimonial-card__image">
                        <h3 class="testimonial-card__name">{{ $testimonial->name }}</h3>
                        <p class="testimonial-card__university">{{ $testimonial->role ?? '' }}</p>
                        <p class="testimonial-card__award">{{ $testimonial->content }}</p>
                    </article>
                @endforeach
            </div>

            {{-- Next Button --}}
            <button class="carousel__btn carousel__btn--next" id="carouselNext" aria-label="Next testimonial">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18L15 12L9 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        {{-- Dots indicator (dynamic) --}}
        <div class="carousel__dots" id="carouselDots">
            @foreach($testimonials as $index => $testimonial)
                <span class="carousel__dot {{ $index === 1 ? 'carousel__dot--active' : '' }}" data-dot="{{ $index }}"></span>
            @endforeach
        </div>
    @else
        <p style="text-align: center; color: var(--color-text-muted); font-size: 16px;">
            Testimonials segera hadir.
        </p>
    @endif
</section>