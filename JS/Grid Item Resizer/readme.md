# Grid Item Resizer

Hey you!
Tired of the items on your product archives looking like garbage because you don't know how to upload images that are all the same size?
Maybe some of your titles are a single line long and others are 5 lines because consistency is an antequated concept?

Well fret no more, because now even YOU can have product grid items that always look good, no matter how many square, rectangle, or parallelogram-shaped images you upload on there, with one handy JS function!

### DEPENDENCIES
- jQuery

### INSTALLATION INSTRUCTIONS

1) Copy the `<script>` tag found in 'resizer-src.html' and paste it in the `<head>` element of your site.
  2) In a custom .js file on your site or in some `<script>` tags before the closing `</body>` tag, paste the contents of 'resizer.js'.
3) Read further for help!

### HOW TO USE

This script uses jQuery to find a set of elements of varying sizes, then wraps them in `<divs>` that are set to the height of the tallest element, then horizontally and vertically centering the contents within.
Simply call `uniformSize()` on the elements, like so:
```javascript
$('.woocommerce ul.products li.product a img').uniformSize();
```

This example is from a WordPress site with WooCommerce products. This drills down the grid of items until it finds the `<img>` tag in each item.

Additionally, you can specify a responsive breakpoint at which to stop calling the function. This is helpful for product feeds that show only 1 product per row on mobile screens, in which case resizing the items would result in a lot of unnecessary white space.
```javascript
$('.woocommerce ul.products li.product a img').uniformSize({
  'breakpoint':768
});
```
In this example, these images will only be resized on screens with a width greater than 768 pixels.

You can also manually set a max height for all the images, in case some super tall ones throw off everything else.
```javascript
$('.woocommerce ul.products li.product a img').uniformSize({
  'breakpoint':768,
  'max_height': '200px'
});
```

In this example, you specify the max_height as a string, so as to allow for any CSS specification (`'200px'`, `'10em'`, etc.)
