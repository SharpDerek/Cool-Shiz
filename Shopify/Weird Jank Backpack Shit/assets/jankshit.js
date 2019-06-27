// Bag Features Functionality
$(document).ready(function() {
  var $reticles = $(".hover-reticle");
  var $callouts = $(".excerpt-area .excerpt");
  
  $reticles.each(function() {
   var callout = $(this).attr("callout");
    var sectionId = $(this).parents(".shopify-section").attr("id");
    $(this).click(function() {
      doCallout(callout, sectionId);
    });
  });
  
  function doCallout(index, sectionID) {
    $("#" + sectionID + " .excerpt-area .excerpt").each(function() {
      var call = $(this).attr("call");
      if (call != index) {
       $(this).hide(); 
      } else {
       $(this).slideDown(); 
      }
    });
  }
  
});
