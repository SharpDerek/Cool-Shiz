/**
 * This file should contain frontend styles that 
 * will be applied to individual module instances.
 *
 * You have access to three variables in this file: 
 * 
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
 *
 * Example: 
 */

.fl-node-<?php echo $id; ?> {
    font-size: <?php echo $settings->text_field; ?>px;
}
.fl-node-<?php echo $id; ?> .album-item-title {
	font-family: <?php echo $settings->title_font['family']; ?>;
	font-weight: <?php echo $settings->title_font['weight']; ?>;
	font-size: <?php echo $settings->title_font_size; ?>px;
	letter-spacing: <?php echo $settings->title_letter_spacing; ?>px;
}
.fl-node-<?php echo $id; ?> .album-item-date {
	font-family: <?php echo $settings->date_font['family']; ?>;
	font-weight: <?php echo $settings->date_font['weight']; ?>;
	font-size: <?php echo $settings->date_font_size; ?>px;
	letter-spacing: <?php echo $settings->date_letter_spacing; ?>px;
	margin-bottom:0;
}
.fl-node-<?php echo $id; ?> .album-grid-item {
	display:block;
	position:relative;
	overflow:hidden;
}
.fl-node-<?php echo $id; ?> .album-item-text {
	text-align:center;
	color: <?php echo $settings->text_color; ?>;
	color: #<?php echo $settings->text_color; ?>;
	position:absolute;
	overflow:hidden;
	top:0;
	bottom:0;
	right:0;
	left:0;
	transition: transform 0.3s;
	background: <?php echo $settings->overlay_color; ?>;
	background: #<?php echo $settings->overlay_color; ?>;
	<?php switch($settings->hover_style) {
		case 'hide_text_hover':
			echo 'transform:none';
			break;
		case 'show_text_hover':
			switch($settings->rollover_effect) {
				case 'from_top':
					echo 'transform:translateY(-100%)';
					break;
				case 'from_bottom':
					echo 'transform:translateY(100%)';
					break;
				case 'from_left':
					echo 'transform:translateX(-100%)';
					break;
				case 'from_right':
					echo 'transform:translateX(100%)';
					break;
			}
			break;
	} ?>
}
.fl-node-<?php echo $id; ?> .album-grid-item:hover .album-item-text {
	<?php switch($settings->hover_style) {
		case 'hide_text_hover':
			switch($settings->rollover_effect) {
				case 'from_top':
					echo 'transform:translateY(-100%)';
					break;
				case 'from_bottom':
					echo 'transform:translateY(100%)';
					break;
				case 'from_left':
					echo 'transform:translateX(-100%)';
					break;
				case 'from_right':
					echo 'transform:translateX(100%)';
					break;
			}
			break;
		case 'show_text_hover':
			echo 'transform:none';
			break;
	} ?>
}
.fl-node-<?php echo $id; ?> .album-item-text-inner {
	position:absolute;
	<?php switch($settings->text_position):
		case 'top': ?>
			top:0;
	<?php
		break;
		case 'center': ?>
			top:50%;
			transform:translateY(-50%);
	<?php
		break;
		case 'bottom': ?>
			bottom:0;
	<?php endswitch; ?>
	left:0;
	right:0;
}
.fl-node-<?php echo $id; ?> .album-grid-item:hover .album-item-text {
	position:absolute;
	<?php switch($settings->hover_style):
		case 'hide_text_hover': ?>
		
	<?php
		break;
		case 'show_text_hover': ?>
		
	<?php endswitch; ?>
}