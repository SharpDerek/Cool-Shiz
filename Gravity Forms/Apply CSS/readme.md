# Gravity Forms Apply CSS

This is a really small plugin that simply takes whatever custom CSS classes you put on a form field, and applies them to all child elements, like the `<label>` and, more importantly, the `<input>`.

## So when would I ever use this very niche thing?

Use case is admittedly small, but if you have any scripts that fire on in `<input>` tags with specific classes, this will come in handy.
For example, this was built for a site that had a script that turned any input with the class `jscolor` into a color-picker type of field. By building this plugin, the user can now apply `jscolor` to any field they want for this functionality.

## Won't my forms break or look weird if I use those [CSS-ready Gravity Forms classes](https://www.gravityforms.com/css-ready-classes/ "CSS Ready Classes for Gravity Forms")?

Luckily, no! The styling for those classes by default are only applied to the `<li>` that has those classes. So any child elements with those same classes are safe from styling harm!

## Cool, how do I use it?

Just download the .zip file in this repository and install it as a new plugin. Activate it, and enjoy! That's all there is to it.
