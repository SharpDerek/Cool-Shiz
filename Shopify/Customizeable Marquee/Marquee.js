  jQuery(document).ready(function($) {
    var marquee = $('#marquee');
    var slide = marquee.find('.slide');
    marquee.css({
      "white-space": "nowrap",
      "overflow": "hidden",
      "padding": "5px 0"
    });
    slide.css({
      "margin": 0,
      "padding": 0,
      "position" : "relative",
      "float": "left",
      "left": "100%"
    });
    
    Slide();
    
    function Slide() {
      slide.animate({left: "100%"},0,'linear');
      slide.animate({left: -slide.innerWidth() + "px"},{{ settings.marquee_speed | times: 1000 }},'linear', function(){Slide()});
    }
  });
