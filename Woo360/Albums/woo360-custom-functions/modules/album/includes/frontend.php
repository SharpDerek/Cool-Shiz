<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file: 
 * 
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 * Example: 
 */

?>

<div class="album-grid">

<?php

$args = array(
	'post_type' => 'woo360_album',
	'post_status' => 'publish',
	'orderby' => 'title'
);
	
	//var_dump($settings);
	
	//var_dump($settings);

$album_query = get_posts($args);

foreach ($album_query as $album):
	$show__album = 'show_album_'.$album->post_name;
	$show_album = $settings->$show__album == 'yes';
	if ($show_album):
		$album__title = 'album_title_'.$album->post_name;
		$album_title = $settings->$album__title;
	
		$album__date = 'album_date_'.$album->post_name;
		$album_date = $settings->$album__date;
	
		$album__image = 'album_image_'.$album->post_name.'_src';
		$album_image = $settings->$album__image;
?>
			<div class="<?php echo $settings->columns; ?>">
				<a href="<?php echo get_permalink($album); ?>" class="album-grid-item album-<?php echo $album->post_name; ?>">
					<?php if ($album_image): ?><img src="<?php echo $album_image; ?>"><?php endif; ?>
					<div class="album-item-text">
						<div class="album-item-text-inner">
							<p class="album-item-title"><?php echo $album_title; ?></p>
							<?php if ($album_date): ?><p class="album-item-date"><?php echo $album_date; ?></p><?php endif; ?>
						</div>
					</div>
				</a>
			</div>
<?php 
	endif;
endforeach; 
?>
</div><!-- end album grid -->