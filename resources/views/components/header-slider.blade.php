
<div x-data="{
        current: 0,
        slides: [
            '{{ asset(''images/ads/ad1.jpg'') }}',
            '{{ asset(''images/ads/ad2.jpg'') }}',
            '{{ asset(''images/ads/ad3.jpg'') }}'
        ],

        startSlider() {
            setInterval(() => {
                this.current = (this.current + 1) % this.slides.length;
            }, 4000);
        }
    }"
    x-init="startSlider()"
    class="relative w-full overflow-hidden bg-black">

    {{-- SLIDES --}}
    <template x-for="(slide, index) in slides" :key="index">

        <div x-show="current === index"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-700"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="w-full">

            <img :src="slide"
                 class="w-full h-48 md:h-64 lg:h-80 object-cover"
                 alt="Advertisement Banner">

        </div>

    </template>

    {{-- LEFT BUTTON --}}
    <button @click="current = (current - 1 + slides.length) % slides.length"
            class="absolute left-2 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-1 rounded-full">
        ❮
    </button>

    {{-- RIGHT BUTTON --}}
    <button @click="current = (current + 1) % slides.length"
            class="absolute right-2 top-1/2 -translate-y-1/2 bg-black/50 text-white px-3 py-1 rounded-full">
        ❯
    </button>

    {{-- DOTS --}}
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-2">

        <template x-for="(slide, index) in slides" :key="index">
            <button @click="current = index"
                    :class="current === index ? 'bg-white' : 'bg-gray-400'"
                    class="w-3 h-3 rounded-full">
            </button>
        </template>

    </div>

</div>
