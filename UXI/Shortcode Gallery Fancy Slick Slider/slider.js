 $(document).ready(function(){

     function doCarousels() {
         let numSlides = 5;
         let slideSpeed = 300;
         $('.carousel-gallery .gallery').on('init', function(event, slick) {
             scaleSlides($(this), numSlides, slideSpeed, slick);
         }).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
             scaleSlides($(this), numSlides, slideSpeed, slick, currentSlide, nextSlide)
         }).slick({
             centerMode: true,
             slidesToShow: numSlides,
             speed: slideSpeed,
             swipe: false,
             draggable: false,
             autoplay: true,
             infinite: false,
             prevArrow: '<button type="button" class="slick-prev icon-uxis-arrow-left"></button>',
             nextArrow: '<button type="button" class="slick-next icon-uxis-arrow-right"></button>',
         });
     }
     doCarousels();
 });

    function scaleSlides(slider, numSlides, slideSpeed, slick = false, currentSlide = false, nextSlide = false) {
        if (slick.slideCount < numSlides) {
            slick.unslick();
            return;
        }
        let centerIndex = 0;
        let targetScale = 2;
        let scaleStep = 1/(Math.ceil(numSlides/2));
        let trackMargin = 5;

         slider.find('.slick-slide').each(function(index, value) {
             if (($(this).attr('data-slick-index') == nextSlide) || (nextSlide === false && $(this).hasClass("slick-center") && $(this).hasClass("slick-current"))) {
                 let centerSlide = $(this);
                 centerIndex = index;
                 slick.$slideTrack.css({
                    minHeight: centerSlide.height() * targetScale + "px"
                 });
             }
         }).each(function(index, value) {
             let distanceIndex = index - centerIndex;
             let absDistanceIndex = Math.abs(distanceIndex);
             let slideZ = numSlides - absDistanceIndex;
             let scaleValue = targetScale - (scaleStep * absDistanceIndex);

             $(this).css({
                position: "relative",
                zIndex: slideZ,
                transform: "translateY(50%)",
             }).find('.gallery-link').css({
                 transform: "scale("+scaleValue+")",
                 transition: slideSpeed + "ms",
             })
         });
    }
