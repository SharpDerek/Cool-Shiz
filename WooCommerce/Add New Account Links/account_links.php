function woo_new_account_links( $menu_links ){

	$new = array( 'link-slug' => 'Link Name' );

	$menu_links = array_slice( $menu_links, 0, 2, true ) 
	+ $new 
	+ array_slice( $menu_links, 1, NULL, true );

	return $menu_links;

}
add_filter ( 'woocommerce_account_menu_items', 'woo_new_account_links' );


function woo_new_account_link_endpoints( $url, $endpoint, $value, $permalink ){

	if( $endpoint === 'link-slug' ) {

		$url = "----link-url-----";

	}
	return $url;

}

add_filter( 'woocommerce_get_endpoint_url', 'woo_new_account_link_endpoints', 10, 4 );
