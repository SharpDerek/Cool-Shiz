# WooCommerce Product Short Description H3 Accordion Generator
PSDHAG For Short

## What it does
Looks for `<h3>` tags in your WooCommerce products' short descriptions and turns them into clickable accordions on the single product page.

## Dependencies
- WooCommerce
- jQuery

## How to use
1) Paste the contents of `functions.php` in your theme's functions.php file or inside a plugin file
2) Paste the contents of `style.css` in your theme's stylesheet or in another enqueued stylesheet
3) Paste the contents of `accordion.js` in a JS file that is enqueued after jQuery
4) Put `<h3>` tags in your products' short descriptions to see the result!

## Why should I use this?
This works by using PHP's native *DOMDocument* and *DomNode* classes to break apart the product's short description HTML by iterating through each tag and piecemealing together an array of titles and content, which then replaces the default short description after formatting it into usable accordion markup.
What this essentially means is that this will parse out your products' short descriptions into accordions ***regardless of what the markup has in it***. It doesn't simply explode the text content into an array of titles and content by searching for instances of `<h3>`. That would result in tags like `<h3 style="text-center">` to break the accordion. So what results is a nice-looking, automatically-generated accordion that will work no matter *what* absurdity TinyMCE throws in there.
