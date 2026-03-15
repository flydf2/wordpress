<?php

add_filter( 'bloglo_customizer_options', 'bloglo_customizer_colors_options', 11 );
function bloglo_customizer_colors_options( array $options ) {
	
	// Animation
	$options['setting']['bloglo_body_animation'] = array(
		'transport'         => 'refresh',
		'sanitize_callback' => 'bloglo_sanitize_toggle',
		'control'           => array(
			'type'        => 'bloglo-toggle',
			'label'       => esc_html__( 'Background Animation', 'bloglo' ),
			'description' => esc_html__( 'Enable Background Animation.', 'bloglo' ),
			'section'     => 'bloglo_section_colors',
			'priority'    => 11,
		),
	);

	return $options;
}
