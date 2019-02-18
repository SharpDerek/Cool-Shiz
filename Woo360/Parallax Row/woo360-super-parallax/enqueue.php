<?php 

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_script('parallax_script', plugin_dir_url(__FILE__).'/assets/js/parallax.min.js', array(),'3.1', false);
});