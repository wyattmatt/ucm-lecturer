// Configuration
const POLLING_INTERVAL = 30000; // 30 seconds (change this value to adjust polling frequency)
const SLIDE_INTERVAL = 7000; // 7 seconds per slide

let currentSlideIndex = 0;
let slides = document.querySelectorAll(".department-slide");
let totalSlides = slides.length;
let slideTimer = null;
let cachedData = { lecturers: [], events: [] };

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.remove("active", "prev");

        if (i === index) {
            slide.classList.add("active");
        } else if (i < index) {
            slide.classList.add("prev");
        }
    });
}

function nextSlide() {
    currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
    showSlide(currentSlideIndex);
}

function startSlideshow() {
    if (slideTimer) clearInterval(slideTimer);
    if (totalSlides > 1) {
        slideTimer = setInterval(nextSlide, SLIDE_INTERVAL);
    }
}

function stopSlideshow() {
    if (slideTimer) {
        clearInterval(slideTimer);
        slideTimer = null;
    }
}

// Fetch data from API
async function fetchData() {
    try {
        const response = await fetch("/api/public/data");
        const data = await response.json();

        if (data.success) {
            return data.data;
        }
    } catch (error) {
        console.error("Error fetching data:", error);
    }
    return null;
}

// Check if data has changed
function hasDataChanged(newData) {
    const lecturersChanged =
        JSON.stringify(cachedData.lecturers) !==
        JSON.stringify(newData.lecturers);
    const eventsChanged =
        JSON.stringify(cachedData.events) !== JSON.stringify(newData.events);
    return lecturersChanged || eventsChanged;
}

// Rebuild carousel with new data
function rebuildCarousel(data) {
    const container = document.querySelector(".relative.z-10");
    if (!container) return;

    // Save current department/position
    const currentDept =
        slides[currentSlideIndex]?.getAttribute("data-department");

    // Group lecturers by department
    const departments = [
        "Management",
        "Visual Communication Design",
        "Informatics",
        "Magister Management",
    ];
    const lecturersByDept = {};

    departments.forEach((dept) => {
        lecturersByDept[dept] = data.lecturers.filter((lec) =>
            lec.departments.includes(dept)
        );
    });

    // Build slides array
    let slidesHTML = "";
    let slideIndex = 0;
    let targetIndex = 0;

    // Add lecturer slides
    departments.forEach((dept) => {
        if (lecturersByDept[dept].length > 0) {
            const chunks = chunkArray(lecturersByDept[dept], 6);
            chunks.forEach((chunk, chunkIndex) => {
                if (dept === currentDept && chunkIndex === 0) {
                    targetIndex = slideIndex;
                }
                slidesHTML += createLecturerSlide(dept, chunk, slideIndex);
                slideIndex++;
            });
        }
    });

    // Add event slides
    data.events.forEach((event) => {
        slidesHTML += createEventSlide(event, slideIndex);
        slideIndex++;
    });

    // Update DOM
    container.innerHTML = slidesHTML;

    // Reinitialize slides
    slides = document.querySelectorAll(".department-slide");
    totalSlides = slides.length;
    currentSlideIndex = Math.min(targetIndex, totalSlides - 1);

    // Show current slide
    showSlide(currentSlideIndex);

    // Cache new data
    cachedData = data;
}

// Helper: Chunk array into groups
function chunkArray(array, size) {
    const chunks = [];
    for (let i = 0; i < array.length; i += size) {
        chunks.push(array.slice(i, i + size));
    }
    return chunks;
}

// Create lecturer slide HTML
function createLecturerSlide(dept, lecturers, index) {
    const lecturerCards = lecturers
        .map((lec) => createLecturerCard(lec))
        .join("");

    return `
        <div class="department-slide" data-department="${dept}" data-index="${index}">
            <div class="text-center mb-[2vh]">
                <h1 class="font-bold text-white" style="font-size: 3vw; margin-top: 6vh;">
                    ${dept}
                </h1>
            </div>
            <div class="grid grid-cols-3 gap-[1.5vw] mx-auto" style="max-width: 85vw;">
                ${lecturerCards}
            </div>
        </div>
    `;
}

// Create lecturer card HTML
function createLecturerCard(lecturer) {
    const imagePath = lecturer.image
        ? `/images/lecturers/${lecturer.image}`
        : "/images/placeholder.png";

    const deptList = lecturer.departments
        .map((dept) => `<li>${dept}</li>`)
        .join("");

    return `
        <div class="card">
            <div class="image-container">
                <img src="${imagePath}" alt="${
        lecturer.name
    }" class="lecturer-image">
            </div>
            <div class="content">
                <p class="text-name">${lecturer.name}</p>
                <p class="text-title">${lecturer.title}</p>
                <p class="text-room">Room: ${lecturer.room || "N/A"}</p>
                <ul class="text-department">${deptList}</ul>
            </div>
        </div>
    `;
}

// Create event slide HTML
function createEventSlide(event, index) {
    const imagePath = event.image
        ? `/images/events/${event.image}`
        : "/images/placeholder.png";

    const startDate = new Date(event.start_date);
    const endDate = new Date(event.end_date);
    const monthDay = startDate.toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
    });
    const fullStartDate = startDate.toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });
    const fullEndDate = endDate.toLocaleDateString("en-US", {
        month: "short",
        day: "numeric",
        year: "numeric",
    });

    const startTime = formatTime(event.start_time);
    const endTime = formatTime(event.end_time);

    const imageHTML = event.image
        ? `
        <img src="${imagePath}" alt="${event.title}" class="w-full h-full object-cover">
    `
        : `
        <svg class="w-32 h-32 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
    `;

    return `
        <div class="department-slide" data-department="Event" data-index="${index}">
            <div class="text-center mb-[4vh]">
                <h1 class="font-bold text-white" style="font-size: 3vw; margin-top: 6vh;">
                    Upcoming Event
                </h1>
            </div>
            <div class="flex justify-center items-center" style="min-height: 60vh;">
                <div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover:shadow-3xl transition duration-300 transform hover:-translate-y-2" style="max-width: 50vw; width: 100%;">
                    <div class="relative h-80 ${
                        !event.image
                            ? "bg-[#1c3a6b] to-[#0c7c5d] bg-gradient-to-br"
                            : ""
                    } flex items-center justify-center overflow-hidden">
                        ${imageHTML}
                        <div class="absolute top-4 right-4 bg-white px-4 py-2 rounded-full shadow-lg">
                            <span class="text-[#1c3a6b] font-semibold text-lg">${monthDay}</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4 hover:text-[#1c3a6b] transition duration-200">
                            ${event.title}
                        </h3>
                        <p class="text-gray-600 text-base mb-6 line-clamp-3">
                            ${event.description}
                        </p>
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center text-gray-700">
                                <i class="bi bi-calendar-event text-xl mr-3 text-blue-600"></i>
                                <span class="text-base font-medium">
                                    ${fullStartDate}${
        event.start_date !== event.end_date ? ` - ${fullEndDate}` : ""
    }
                                </span>
                            </div>
                            <div class="flex items-center text-gray-700">
                                <i class="bi bi-clock text-xl mr-3 text-red-600"></i>
                                <span class="text-base font-medium">
                                    ${startTime} - ${endTime}
                                </span>
                            </div>
                        </div>
                        // <button class="w-full bg-[#FF6B00] text-white font-semibold py-4 px-6 rounded-lg hover:bg-[#e65a00] transition duration-200 shadow-md hover:shadow-lg text-lg">
                        //     Learn More
                        // </button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Format time from H:i:s to g:i A
function formatTime(timeString) {
    const [hours, minutes] = timeString.split(":");
    const hour = parseInt(hours);
    const ampm = hour >= 12 ? "PM" : "AM";
    const displayHour = hour % 12 || 12;
    return `${displayHour}:${minutes} ${ampm}`;
}

// Poll for data updates
async function pollData() {
    const newData = await fetchData();

    if (newData && hasDataChanged(newData)) {
        console.log("Data changed, rebuilding carousel...");
        stopSlideshow();
        rebuildCarousel(newData);
        startSlideshow();
    }
}

// Initialize
async function init() {
    // Fetch initial data
    const initialData = await fetchData();
    if (initialData) {
        cachedData = initialData;
    }

    // Start slideshow
    showSlide(0);
    startSlideshow();

    // Start polling
    setInterval(pollData, POLLING_INTERVAL);
}

// Start when page loads
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
} else {
    init();
}
