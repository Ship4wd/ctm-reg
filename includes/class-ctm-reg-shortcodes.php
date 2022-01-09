<?php
  // Create Shortcode include_form
  // Shortcode: [include_form form_name=""]
  function create_includeform_shortcode($atts) {

  	$atts = shortcode_atts(
  		array(
  			'form_name' => '',
  		),
  		$atts,
  		'include_form'
  	);

  	$form_name = $atts['form_name'];
    ob_start(); ?>
      <?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/forms/'.$form_name.'.php'; ?>
    <?php $output_string = ob_get_contents();
    ob_end_clean();
    return $output_string;
  }
  add_shortcode( 'include_form', 'create_includeform_shortcode' );
