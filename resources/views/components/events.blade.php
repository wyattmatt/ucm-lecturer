@props(['event'])

<div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-3xl transition duration-300 transform hover:-translate-y-2" style="max-width: 50vw; width: 100%;">
    {{-- Event Image --}}
    @if($event->image)
        <div class="relative h-80 overflow-hidden">
            <img src="{{ asset('images/events/' . $event->image) }}"
                 alt="{{ $event->title }}"
                 class="w-full h-full object-cover">
            <div class="absolute top-4 right-4 bg-white px-4 py-2 rounded-full shadow-lg">
                <span class="text-black font-semibold text-lg">{{ \Carbon\Carbon::parse($event->start_date)->format('M d') }}</span>
            </div>
        </div>
    @else
        <div class="relative h-80 bg-[#1c3a6b] flex items-center justify-center">
            <svg class="w-32 h-32 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <div class="absolute top-4 right-4 bg-white px-4 py-2 rounded-full shadow-lg">
                <span class="text-black font-semibold text-lg">{{ \Carbon\Carbon::parse($event->start_date)->format('M d') }}</span>
            </div>
        </div>
    @endif

    {{-- Event Content --}}
    <div class="p-8">
        <h3 class="text-3xl font-bold text-gray-900 mb-4 hover:text-[#1c3a6b] transition duration-200">
            {{ $event->title }}
        </h3>

        <p class="text-gray-600 text-base mb-6 line-clamp-3">
            {{ $event->description }}
        </p>

        {{-- Event Details --}}
        <div class="space-y-3 mb-4">
            {{-- Date --}}
            <div class="flex items-center text-gray-700">
                <i class="bi bi-calendar-event text-xl mr-3 text-blue-600"></i>
                <span class="text-base font-medium">
                    {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y') }}
                    @if($event->start_date != $event->end_date)
                        - {{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y') }}
                    @endif
                </span>
            </div>

            {{-- Time --}}
            <div class="flex items-center text-gray-700">
                <i class="bi bi-clock text-xl mr-3 text-red-600"></i>
                <span class="text-base font-medium">
                    @php
                        $startFormat = strlen($event->start_time) > 5 ? 'H:i:s' : 'H:i';
                        $endFormat = strlen($event->end_time) > 5 ? 'H:i:s' : 'H:i';
                    @endphp
                    {{ \Carbon\Carbon::createFromFormat($startFormat, $event->start_time)->format('g:i A') }}
                    - {{ \Carbon\Carbon::createFromFormat($endFormat, $event->end_time)->format('g:i A') }}
                </span>
            </div>
        </div>

        {{-- Learn More Button --}}
        {{-- <button class="w-full bg-[#FF6B00] text-white font-semibold py-4 px-6 rounded-lg hover:bg-[#da5b00] transition duration-200 shadow-md hover:shadow-lg text-lg">
            Learn More
        </button> --}}
    </div>
</div>
