<?php 
/**
 * Register a settings form to use in the "form" field type above.
 */
$depth_array = array(
    'type' => 'unit',
    'label' => __('Depth', 'fl-builder'),
    'slider' => array(
        'min' => 0,
        'max' => 1,
        'step' => 0.05,
    ),
);

$pos_array = array(
  'type' => 'select',
  'label' => __('Position', 'fl-builder'),
  'options' => array(
      'top left' => __('Top Left', 'fl-builder'),
      'top center' => __('Top Center', 'fl-builder'),
      'top right' => __('Top Right', 'fl-builder'),
      'center left' => __('Center Left', 'fl-builder'),
      'center center' => __('Center Center', 'fl-builder'),
      'center right' => __('Center Right', 'fl-builder'),
      'bottom left' => __('Bottom Left', 'fl-builder'),
      'bottom center' => __('Bottom Center', 'fl-builder'),
      'bottom right' => __('Bottom Right', 'fl-builder'),
  ),
);

FLBuilder::register_settings_form('super_parallax_element', array(
    'title' => __('Add Item', 'fl-builder'),
    'tabs'  => array(
        'general' => array(
            'title'    => __('General', 'fl-builder'),
            'sections' => array(
                'general' => array(
                    'title'  => '',
                    'fields' => array(
                        'label' => array(
                            'type'        => 'text',
                            'label'       => __('Label', 'fl-builder'),
                            'connections' => array('string'),
                            'description' => __('for organizational purposes only', 'fl-builder'),
                        ),
                    ),
                ),
                'images'  => array(
                    'title'  => __('Images', 'fl-builder'),
                    'fields' => array(
                        'image' => array(
                            'type'        => 'photo',
                            'label'       => __("Photo", "fl-builder"),
                            "show_remove" => true,
                        ),
                        'depth' => $depth_array,
                        'position' => $pos_array,
                        'mobile_show' => array(
                            'type' => 'select',
                            'label' => __('Show on Mobile?', 'fl-builder'),
                            'default' => 'mobile-show',
                            'options' => array(
                                'mobile-hide' => __('No', 'fl-builder'),
                                'mobile-show' => __('Yes', 'fl-builder'),
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
));


add_filter( 'fl_builder_register_settings_form', function( $form, $slug ) use ($depth_array, $pos_array) {
  if ( 'row' === $slug) {
  
    $form['tabs']['super_parallax']  = array(
      'title' => __('Super Parallax', 'fl-builder'),
      'sections' => array(
        'background' => array (
          'title' => __('Background', 'fl-builder'),
          'fields' => array(
            'background' => array (
              'type' => 'photo',
              'label' => __('Background Image', 'fl-builder'),
              'show_remove' => true,
            ),
            'background_depth' => $depth_array,
          ),
        ),
        'super_parallax_items' => array (
          'title' => __('Super Parallax Items', 'fl-builder'),
          'fields' => array(
            'elements' => array (
              'type' => 'form',
              'label' => __('Super Parallax Item', 'fl-builder'),
              'form' => 'super_parallax_element',
              'multiple' => true,
              'preview_text' => 'label',
            ),
          ),
        ),
      ),
    );      
    $form['tabs']['style']['sections']['background']['fields']['bg_type']['options']['super_parallax']  = array(
      'label' => __('SUPER Parallax', 'fl-builder')
    );
    $form['tabs']['style']['sections']['background']['fields']['bg_type']['toggle']['super_parallax']  = array(
      'tabs' => array('super_parallax'),
    );

    return $form;
  }

  return $form;
}, 10, 2 );