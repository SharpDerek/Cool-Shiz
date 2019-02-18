<?php

add_action( 'fl_builder_after_render_row_bg', 'parallax_row');


function parallax_row( $row ) {

	if ($row->settings->bg_type == 'super_parallax'): ?>
		<div class="parallax-scene-<?php echo $row->node; ?>">
			<div class="parallax-main-bg" data-depth="<?php echo $row->settings->background_depth; ?>">
				<img src="<?php echo $row->settings->background_src; ?>">
			</div>
			<?php foreach($row->settings->elements as $element): ?>
				<div class="parallax_img <?php echo $element->mobile_show; ?>" data-depth="<?php echo $element->depth; ?>">
					<img src="<?php echo $element->image_src; ?>"
					style="
						<?php switch ($element->position) {
							case 'top left':
								echo "top: 0; left: 0;";
								break;
							case 'top center':
								echo "top: 0; transform: translateX(-5%)";
								break;
							case 'top right':
								echo "top: 0; right: 0;";
								break;
							case 'center left':
								echo "top: 50%; left: 0; transform: translateY(-50%)";
								break;
							case 'center center':
								echo "top: 50%; transform:translate(-5%,-50%)";
								break;
							case 'center right':
								echo "top: 50%; right: 0; transform: translateY(-50%)";
								break;
							case 'bottom left':
								echo "bottom: 0; left: 0;";
								break;
							case 'bottom center':
								echo "bottom: 0; transform: translateX(-5%)";
								break;
							case 'bottom right':
								echo "bottom: 0; right: 0;";
								break;
						} ?>
					">
				</div>
			<?php endforeach; ?>
		</div>
		<style>
			.fl-node-<?php echo $row->node; ?> .fl-row-content-wrap {
				position:relative;
				z-index:0;
			}
			.parallax-scene-<?php echo $row->node; ?> {
				overflow:hidden;
				position:absolute;
				top:0;
				bottom:0;
				left:0;
				right:0;
				z-index: -1;
				pointer-events: none;
			}
			.fl-node-<?php echo $row->node; ?> .parallax_img {
				position:relative;
				height:100%;
				width:100%;
			}
			.fl-node-<?php echo $row->node; ?> .parallax_img img {
				position:absolute;
				max-width:none;
			}

			.parallax-scene-<?php echo $row->node; ?> .parallax-main-bg {
				width:110%;
				height:110%;
				top:-5% !important;
				position:relative;
			}
			.parallax-scene-<?php echo $row->node; ?> .parallax-main-bg img {
				position: absolute;
				width: 100%;
				height: auto;
				max-width:none;
				pointer-events: none;
				top:50%;
				transform:translate(-5%,-50%);
			}
			@media(max-width: 768px) {
				.parallax_img.mobile-hide {
					display:none !important;
				}
			}
		</style>
		<script>
			var node_<?php echo $row->node; ?> = document.querySelector('.parallax-scene-<?php echo $row->node; ?>');
			var parallaxInstance_<?php echo $row->node; ?> = new Parallax(node_<?php echo $row->node; ?>, {
				relativeInput: true
			});
			  jQuery(document).ready(function($) {
			    responsiveImgSetup();
			    responsiveImg();
			    $(window).resize(function() {
			      responsiveImg();
			    });
			    $(window).scroll(function() {
			      //responsiveImg();
			    });
			    function responsiveImgSetup() {
			      $('.parallax-main-bg img').each(function() {
			        var image = $(this);
			        var parent = image.parent();
			        parent.css("position","relative");
			        image.css("width","auto");
			        image.css({
			          //"left": ($(this).outerWidth() - $(window).outerWidth())/-2 + "px",
			        });
			      });
			    }
			    function responsiveImg() {
			      $('.parallax-main-bg img').each(function() {
			        var thisAR = $(this).outerWidth() / $(this).outerHeight();
			        var parentAR = $(this).parent().outerWidth() / $(this).parent().outerHeight();
			        
			        if (thisAR >= parentAR || !isFinite(parentAR)) {
			          $(this).css({
			            "height": "100%",
			            "width": "auto"//,
			            //"left": ($(this).outerWidth() - $(window).outerWidth())/-2 + "px"
			          });
			        } else {
			          $(this).css({
			            "height": "auto",
			            "width": "100%"//,
			            //"left": 0
			          });
			        }
			        //console.log("thisAR: " + thisAR + ", parentAR: " + parentAR);
			      });
			    }
			  });
		</script>
	<?php endif;

    return $row;
}