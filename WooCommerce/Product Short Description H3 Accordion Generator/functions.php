<?php

if ( class_exists( 'WooCommerce' ) ) {

	function accordion_parse($excerpt) {

		$dom = new DOMDocument();
		@$dom->loadHTML($excerpt);

		foreach($dom->getElementsByTagName('body') as $node) {
			$accordions = array(); // all accordion items
			$accordion_instance = array(); // current accordion item
			foreach($node->childNodes as $childnode) {
				if ($childnode->nodeName === 'h3') { // h3's are the beginning of a new accordion instance.
					if (!empty($accordion_instance)) { // If there's already a current accordion instance with data,
						array_push($accordions,$accordion_instance); // let's push it to the list of all accordions.
						$accordion_instance = array(); // And create a new instance.
					}
					$accordion_instance['title'] = $childnode; // assigning the title of this accordion instance to this particular h3 node
				} else {
					$accordion_instance['content'][] = $childnode; // adding this particular non-h3 node to the content of this accordion instance
				}
			}
			if (!empty($accordion_instance)) {
				array_push($accordions,$accordion_instance); // one last check and push to the list of all accordion items
			}
		}

		if (count($accordions) > 0) {
			ob_start(); ?>
				<div class="accordion-section">
			<?php $excerpt = ob_get_clean();
			
				foreach($accordions as $accordion) {
					if (array_key_exists('title',$accordion)) {
						$accordion_content = '';
						foreach($accordion['content'] as $contentnode) {
							if (is_null($contentnode->wholeText)) {
								$contenthtml = $dom->saveHTML($contentnode);
								$accordion_content .= $contenthtml;
							}
						}
						ob_start(); ?>
		 					<div class="accordion-item">
								<div class="accordion-title"><?php echo $dom->saveHTML($accordion['title']); ?></div>
								<div class="accordion-content"><?php echo $accordion_content; ?></div>
							</div>
						<?php $excerpt .= ob_get_clean();
					} else {
						foreach($accordion['content'] as $contentnode) {
							$contenthtml = $dom->saveHTML($contentnode);
							$excerpt .= $contenthtml;
						}
					}
				}

			ob_start(); ?>
				</div><!-- end accordion-section -->
			<?php $excerpt .= ob_get_clean();

			return $excerpt;
		}
		return $excerpt;
	}

	add_filter('woocommerce_short_description','accordion_parse');

}
