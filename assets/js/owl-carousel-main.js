$('.speicality-carousel').owlCarousel({
    loop:true,
    autoplay: true,
    autoplayTimeout:3000,
    margin:30,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    nav:false,
    dots: true,
    autoplayHoverPause: false,
    items: 1,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})


$('.doctors-carousel').owlCarousel({
    loop:true,
    autoplay: false,
    margin:30,
    animateOut: 'fadeOut',
    animateIn: 'fadeIn',
    nav:false,
    dots: true,
    autoplayHoverPause: false,
    items: 1,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})