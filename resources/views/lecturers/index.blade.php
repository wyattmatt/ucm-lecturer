<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UCM Lecturers</title>
    <link rel="icon" type="image/png" href="{{ asset('images/fav.png') }}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="card-container relative" style="background-color: #FF6B00;">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/building/ucm-building.png') }}"
                alt="UCM Building"
                class="w-full h-full object-cover opacity-20">
        </div>

        <div class="relative z-10 h-full flex flex-col justify-center" style="padding: 4vh 6vw;">

            @php
            $departments = ['Management', 'Visual Communication Design', 'Informatics', 'Magister Management'];

            $lecturersByDept = [];
            foreach ($departments as $dept) {
                $lecturersByDept[$dept] = $lecturers->filter(function($lecturer) use ($dept) {
                    return in_array($dept, $lecturer->departments);
                })->values();
            }

            $slides = [];
            $slideIndex = 0;

            // Add lecturer slides
            foreach ($departments as $dept) {
                if ($lecturersByDept[$dept]->count() > 0) {
                    $chunks = $lecturersByDept[$dept]->chunk(6);
                    foreach ($chunks as $chunkIndex => $chunk) {
                        $slides[] = [
                            'type' => 'lecturer',
                            'department' => $dept,
                            'lecturers' => $chunk,
                            'index' => $slideIndex++
                        ];
                    }
                }
            }

            // Add event slides (one event per slide)
            foreach ($events as $event) {
                $slides[] = [
                    'type' => 'event',
                    'event' => $event,
                    'index' => $slideIndex++
                ];
            }
            @endphp

            @foreach($slides as $slide)
                @if($slide['type'] === 'lecturer')
                    {{-- Lecturer Slide --}}
                    <div class="department-slide {{ $slide['index'] === 0 ? 'active' : '' }}"
                        data-department="{{ $slide['department'] }}"
                        data-index="{{ $slide['index'] }}">

                        <div class="text-center mb-[2vh]">
                            <h1 class="font-bold text-white" style="font-size: 3vw; margin-top: 6vh;">
                                {{ $slide['department'] }}
                            </h1>
                        </div>

                        <div class="grid grid-cols-3 gap-[1.5vw] mx-auto" style="max-width: 85vw;">
                            @foreach($slide['lecturers'] as $lecturer)
                            <x-card :lecturer="$lecturer" />
                            @endforeach
                        </div>
                    </div>
                @else
                    {{-- Event Slide --}}
                    <div class="department-slide {{ $slide['index'] === 0 ? 'active' : '' }}"
                        data-department="Event"
                        data-index="{{ $slide['index'] }}">

                        <div class="text-center mb-[4vh]">
                            <h1 class="font-bold text-white" style="font-size: 3vw; margin-top: 6vh;">
                                Upcoming Event
                            </h1>
                        </div>

                        <div class="flex justify-center items-center" style="min-height: 60vh;">
                            <x-events :event="$slide['event']" />
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
