let currentSlideIndex = 0;
const slides = document.querySelectorAll(".department-slide");
const totalSlides = slides.length;

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

// Initialize first slide
showSlide(0);

// Auto-advance slides
if (totalSlides > 1) {
    setInterval(nextSlide, 7000);
}
