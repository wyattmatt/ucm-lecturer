<div class="lecturer-card bg-white rounded-xl shadow-lg overflow-hidden">
    <!-- Photo Profile -->
    <div class="relative bg-gray-200 overflow-hidden flex items-center justify-center" style="height: 20vh; padding: 1.5vh; flex-shrink: 0;">
        <img src="{{ $lecturer->image_path ?? asset('images/placeholder.png') }}"
            alt="{{ $lecturer->name }}"
            class="object-cover rounded-full"
            style="width: 16vh; height: 16vh; object-position: center 20%;"
            onerror="this.src='{{ asset('images/placeholder.png') }}'">
    </div>

    <!-- Card Content -->
    <div class="lecturer-card-content">
        <div class="lecturer-info">
            <!-- Name -->
            <h3 class="font-semibold text-gray-900 mb-1" style="font-size: 1.1vw; line-height: 1.3;" align="center">
                {{ $lecturer->name }}
            </h3>

            <!-- Title -->
            <p class="font-normal text-gray-600 mb-3" style="font-size: 0.8vw; line-height: 1.4;" align="center">
                {{ $lecturer->title }}
            </p>
        </div>

        <!-- Room Number (Fixed at bottom) -->
        <div class="lecturer-room rounded-md font-semibold text-center" style="padding: 0.7vh 0.8vw; background-color: #FF6B00; color: white; font-size: 0.85vw;">
            Room {{ $lecturer->room }}
        </div>
    </div>
</div>
