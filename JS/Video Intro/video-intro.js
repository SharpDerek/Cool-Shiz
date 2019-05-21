jQuery.fn.extend({
    hvCover: function(settings = {'parentWrap':null,'breakpoint':0,'hide_on_breakpoint':false}) {
        $ = jQuery;
        if (settings['parentWrap'] === null) {
            settings['parentWrap'] = $(this).parent();
        }
        var base = $(this);
        function horizontalVerticalCenter() {
            if ($(window).outerWidth() > settings['breakpoint']) {
                var thisAR = base.outerWidth()/base.outerHeight();
                var parentAR = settings['parentWrap'].outerWidth()/settings['parentWrap'].outerHeight();

                settings['parentWrap'].css({
                    position: 'relative',
                    overflow: 'hidden'
                });
                base.css({
                    position: 'absolute',
                    top: 0,
                    left:0,
                    right:0,
                    bottom:0,
                    maxWidth: 'none',
                    display: 'block'
                });

                if (thisAR > parentAR) {
                    base.css({
                        left: (base.outerWidth() - settings['parentWrap'].outerWidth())/-2 + 'px',
                        top: 0,
                        height: '100%',
                        width: 'auto'
                    });
                } else {
                    base.css({
                        left: 0,
                        top: (base.outerHeight() - settings.parentWrap.outerHeight())/-2 + 'px',
                        height: 'auto',
                        width: '100%'
                    })
                }
            } else {
                if (settings['hide_on_breakpoint'] == true) {
                    base.hide();
                } else {
                    base.attr("style","");
                    settings['parentWrap'].attr("style","");
                }
            }
        }

        horizontalVerticalCenter();
        setTimeout(function(){
            horizontalVerticalCenter();
        },0);
        $(window).resize(function(){
            horizontalVerticalCenter();
        });

        return base;

    },
    overlayVideo: function(settings = {'fade_duration':500,'breakpoint':0,'overlay':$(window)}) {
        $ = jQuery;

        var base = $(this);
        base.on("loadeddata", function() {
            base.hvCover({
                parentWrap: settings['overlay'],
                breakpoint: settings['breakpoint'],
                hide_on_breakpoint: true
            });
            function overlayVideo() {
                base.css({
                    position: 'fixed',
                    zIndex: 100000
                });

            }
            overlayVideo();
            setTimeout(function(){
                base.animate({
                    opacity:0
                },
                settings['fade_duration'],function() {
                    base.hide();
                });
            },base[0].duration * 1000);
            $(window).resize(function(){
               overlayVideo();
            });
        });
        return base;
    }
});

jQuery(document).ready(function($) {
    if($('body').hasClass("home")) {
        $('body').append($('<video id="overlay-video" autoplay muted><source src="https://dta0yqvfnusiq.cloudfront.net/egani36791820/2019/03/20190225-logo-animation-5c7ea3df608e0.mp4" type="video/mp4"></video'));
        $('#overlay-video').overlayVideo({
            fade_duration: 500,
            breakpoint: 992,
            overlay: $(window)
        });
    }
});