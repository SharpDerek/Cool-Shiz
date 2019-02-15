var ajaxEntries = [];
jQuery('head').append('<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>');
jQuery(document).ready(function($) {
   $('.ds-post-feed').each(function() {
     var columns = parseInt($(this).attr('columns'));
     var slugs = $(this).attr('slugs').split(",");
     var titles = $(this).attr('titles');
     var category = $(this).attr('category');
     var thisFeed = $(this);
     slugs.forEach(function(slug,index) {
         var feedItem = $('<div class="ds-feed-item ' + category + ' ' + slug.replace(/\//g,"-") + '"></div>');
         thisFeed.append(feedItem);
         var newAjaxEntry = {
             url: window.location.protocol + "//" + window.location.hostname + (category ? '/' + category + '/' : '/') + slug,
             location: feedItem,
             title: titles
         }
         ajaxEntries.push(newAjaxEntry);
     });
     thisFeed.slick({
        slidesToShow: columns,
        slidesToScroll: columns,
        dots: false,
        arrows: true,
        prevArrow: '<span class="post-feed-arrow left icon-uxis-arrow-left"></span>',
        nextArrow: '<span class="post-feed-arrow right icon-uxis-arrow-right"></span>',
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: Math.floor(columns/2),
                    slidesToScroll: Math.floor(columns/2)
                },
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
     });
   });
   loadAjaxEntry(0);
});


function loadAjaxEntry(index) {
   var entry = ajaxEntries[index];
   $.ajax({
      url: entry.url,
      success: function(data) {
          var atag = $('<a class="post-feed-link" href="' + entry.url + '"></a>');
          atag.css('background-image','url(' + $(data).find('.post-image').find('img').attr('src') + ')');
          var title = $(data).find('.page-header-title').html();
          if (entry.title === 'partial') {
              title = title.split(":")[0];
          }
          atag.append('<h2>' + title + '</h2>');
          entry.location.append(atag);
      },
      complete: function() {
          index++;
          if (index < ajaxEntries.length) {
              loadAjaxEntry(index);
          }
      }
   });
}
