jQuery(document).ready(function($) {
  $('simple-example').uniformSize();
  
  $('breakpoint-example').uniformSize({
    'breakpoint':768
  });
  
  $('breakpoint-and-max-height-example').uniformSize({
    'breakpoint':768,
    'max_height': '300px'
  });
  
});
