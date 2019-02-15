<?php

/**
 * @class Woo360_Album_Module
 */
class Woo360_Album_Module extends FLBuilderModule {

    /** 
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */  
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Woo360 Album', 'fl-builder'),
			'group'			=> __('Woo360 Modules', 'fl-builder'),
            'description'   => __('A Dynamic Feed of Albums', 'fl-builder'),
            'category'		=> __('Woo360 Modules', 'fl-builder'),
            'dir'           => WOO360_ALBUM_DIR . 'modules/album/',
            'url'           => WOO360_ALBUM_URL . 'modules/album/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
        ));
        
        /** 
         * Use these methods to enqueue css and js already
         * registered or to register and enqueue your own.
         */
        // Already registered
        $this->add_css('font-awesome');
        $this->add_js('jquery-bxslider');
        
        // Register and enqueue your own
        $this->add_css('album', $this->url . 'css/album.css');
        $this->add_js('album', $this->url . 'js/album.js', array(), '', true);
    }

    /** 
     * Use this method to work with settings data before 
     * it is saved. You must return the settings object. 
     *
     * @method update
     * @param $settings {object}
     */      
    public function update($settings)
    {
        //$settings->textarea_field .= ' - this text was appended in the update method.';
        
        return $settings;
    }

    /** 
     * This method will be called by the builder
     * right before the module is deleted. 
     *
     * @method delete
     */      
    public function delete()
    {
    
    }

    /** 
     * Add additional methods to this class for use in the 
     * other module files such as preview.php, frontend.php
     * and frontend.css.php.
     * 
     *
     * @method example_method
     */   
    public function example_method()
    {
    
    }
}

$args = array(
	'post_type' => 'woo360_album',
	'post_status' => 'publish',
	'orderby' => 'title'
);

$album_query = get_posts($args);
//var_dump($album_query);

$album_options = array();

foreach($album_query as $album) {
	$this_album_options = array(
		'title' => __($album->post_title, 'fl-builder'),
		'fields' => array(
			'show_album_'.$album->post_name => array(
				'type'	=> 'select',
				'label' => __('Show Album?', 'fl-builder'),
				'default' => 'yes',
				'options' => array(
					'yes' => __('Yes', 'fl-builder'),
					'no' => __('No', 'fl-builder'),
				),
				'toggle' => array(
					'yes' => array(
						'fields' => array(
							'album_title_'.$album->post_name,
							'album_date_'.$album->post_name,
							'album_image_'.$album->post_name,
						)
					),
				)
			),
			'album_title_'.$album->post_name => array(
				'type' => 'textarea',
				'label' => __('Album Title', 'fl-builder'),
				'default' => __($album->post_title, 'fl-builder'),
				'placeholder' => __('Album Title', 'fl-builder'),
				'rows' => '2'
			),
			'album_date_'.$album->post_name => array(
				'type' => 'text',
				'label' => __('Album Date', 'fl-builder'),
				'placeholder' => __('Album Date', 'fl-builder'),
			),
			'album_image_'.$album->post_name => array(
				'type' => 'photo',
				'label' => __('Album Image', 'fl-builder'),
				'show_remove' => false
			),
		)
	);
	array_push($album_options,$this_album_options);
}


//    'options'       => array(
//		'title' => __('Options','fl-builder'),
//		'fields' => array(
//			'columns' => array(
//				'type' => 'select',
//				'label' => __('Columns','fl-builder'),
//				'default' => 'col-xs-12 col-sm-4',
//				'options' => array(
//					'col-xs-12 col-sm-3' => 4,
//					'col-xs-12 col-sm-4' => 3,
//					'col-xs-12 col-sm-6' => 2
//				)
//			)
//		)
//	),


/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('Woo360_Album_Module', array(
	'options' => array (
		'title' => __('Options','fl-builder'),
		'sections' => array(
			'columns_settings' => array (
				'title' => __('Columns Settings', 'fl-builder'),
				'fields' => array (
					'columns' => array (
						'type' => 'select',
						'label' => __('Columns','fl-builder'),
						'default' => 'col-xs-12 col-sm-4',
						'options' => array(
							'col-xs-12 col-sm-3' => 4,
							'col-xs-12 col-sm-4' => 3,
							'col-xs-12 col-sm-6' => 2
						)
					)
				)
			),
			'color_settings' => array (
				'title' => __('Color Settings', 'fl-builder'),
				'fields' => array (
					'text_color' => array (
						'type' => 'color',
						'label' => __('Text Color','fl-builder'),
						'default' => 'ffffff',
						'show_reset' => true,
						'show_alpha' => true
					),
					'overlay_color' => array (
						'type' => 'color',
						'label' => __('Overlay Color','fl-builder'),
						'default' => 'rgba(155, 88, 68, 0.5)',
						'show_reset' => true,
						'show_alpha' => true
					)
				)
			),
			'style_settings' => array (
				'title' => __('Style Settings', 'fl-builder'),
				'fields' => array (
					'text_position' => array (
						'type' => 'select',
						'label' => __('Text Position','fl-builder'),
						'default' => 'center',
						'options' => array (
							'top' => __('Top', 'fl-builder'),
							'center' => __('Center', 'fl-builder'),
							'bottom' => __('Bottom', 'fl-builder'),
						)
					),
					'hover_style' => array (
						'type' => 'select',
						'label' => __('Hover Style','fl-builder'),
						'default' => 'hide_text_hover',
						'options' => array (
							'hide_text_hover' => __('Text shown, hide on mouse hover', 'fl-builder'),
							'show_text_hover' => __('Text hidden, show on mouse hover', 'fl-builder'),
						)
					),
					'rollover_effect' => array (
						'type' => 'select',
						'label' => __('Rollover Effect','fl-builder'),
						'default' => 'from_bottom',
						'options' => array (
							'from_top' => __('From Top', 'fl-builder'),
							'from_bottom' => __('From Bottom', 'fl-builder'),
							'from_left' => __('From Left', 'fl-builder'),
							'from_right' => __('From Right', 'fl-builder'),
						)
					),
					'title_font' => array (
						'type' => 'font',
						'label' => __('Title Font','fl-builder')
					),
					'title_font_size' => array (
						'type' => 'unit',
						'label' => __('Title Font Size','fl-builder'),
						'default' => 30,
						'description' => 'px'
					),
					'title_letter_spacing' => array (
						'type' => 'unit',
						'label' => __('Title Letter Spacing','fl-builder'),
						'default' => 1,
						'description' => 'px'
					),
					'date_font' => array (
						'type' => 'font',
						'label' => __('Date Font','fl-builder')
					),
					'date_font_size' => array (
						'type' => 'unit',
						'label' => __('Date Font Size','fl-builder'),
						'default' => 20,
						'description' => 'px'
					),
					'date_letter_spacing' => array (
						'type' => 'unit',
						'label' => __('Date Letter Spacing','fl-builder'),
						'default' => 1,
						'description' => 'px'
					),
				)
			)
		)
	),
	'albums' => array (
        'title'         => __('Albums', 'fl-builder'),
        'sections'      => $album_options
    )
));