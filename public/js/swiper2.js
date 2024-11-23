console.log('Initializing Swiper 2...');
const swiper2 = new Swiper('.another-slider-wrapper', {
    loop: true, // Aktifkan mode loop
    grabCursor: true,
    spaceBetween: 25,
    pagination: {
        el: '.swiper-pagination',
        clickable: true, // Pagination dapat diklik
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    breakpoints: {
        0: {
            slidesPerView: 1, // Untuk layar kecil
        },
        768: {
            slidesPerView: 2, // Untuk layar sedang
        },
        1024: {
            slidesPerView: 3, // Untuk layar besar
        },
    },
});
console.log('Swiper 2 initialized:', swiper2);
