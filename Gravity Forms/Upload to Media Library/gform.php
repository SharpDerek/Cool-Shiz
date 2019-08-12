function madnify_override_gform_upload_path($path_info, $form_id) {
	$path_info['path'] = trailingslashit(wp_upload_dir()['path']);
	$path_info['url'] = trailingslashit(wp_upload_dir()['url']);
	return $path_info;
}

add_filter('gform_upload_path_4', 'madnify_override_gform_upload_path', 10, 2);


function madnify_update_user_reseller_data( $entry, $form ) {
	if (is_user_logged_in()) {

		$filepath = "";
		$user_id = "";

		foreach($entry as $key => $value) {
			if (is_int($key)) {
				if (is_numeric($value)) {
					$user_id = $value;
				} else {
					$filename = $value;
				}
			}
		}
		if ($user_id && $filename) {

			$wp_filetype = wp_check_filetype(basename($filename), null );
	        $wp_upload_dir = wp_upload_dir();
	        $new_url = trailingslashit($wp_upload_dir['url']). basename( $filename );
	        $attachment = array(
	            'guid' => $new_url, 
	            'post_mime_type' => $wp_filetype['type'],
	            'post_title' => preg_replace('/\.[^.]+$/', '', basename($filename)),
	            'post_content' => '',
	            'post_status' => 'inherit'
	        );

	        $attach_id = wp_insert_attachment( $attachment, $new_url, $user_id );

	        require_once(ABSPATH . 'wp-admin/includes/image.php');

	        $attach_data = wp_generate_attachment_metadata( $attach_id, $new_url);
	        wp_update_attachment_metadata($attach_id, $attach_data);

	        update_user_meta($user_id, 'reseller_sales_certificate', $attach_id);
		}
	}
}

add_action( 'gform_after_submission_4', 'madnify_update_user_reseller_data', 10, 2 );
