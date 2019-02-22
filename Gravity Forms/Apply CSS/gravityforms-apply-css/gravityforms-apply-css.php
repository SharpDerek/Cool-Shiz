<?php

/*

Plugin Name: Gravity Forms Apply CSS

Plugin URI: http://www.madwire.com/

Description: Applies Custom CSS classes from Gravity Form fields onto their child elements as well

Version: 0.1

Author: Madwire

Author URI: http://www.madwire.com/

*/


add_filter('gform_field_content', function($field_content, $field, $value, $entry_id, $form_id) {
	return str_replace("class='","class='".$field['cssClass'].' ', $field_content);
},10,5);

