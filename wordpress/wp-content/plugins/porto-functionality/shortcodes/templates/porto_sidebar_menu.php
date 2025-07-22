<?php

$output   = '';
$title    = '';
$nav_menu = '';
$el_class = '';

extract(
	shortcode_atts(
		array(
			'title'    => '',
			'nav_menu' => '',
			'el_class' => '',
		),
		$atts
	)
);

wp_enqueue_script( 'porto-sidebar-menu' );

if ( ! class_exists( 'porto_sidebar_navwalker' ) ) {
	return;
}

if ( function_exists( 'vc_is_inline' ) && vc_is_inline() && ! empty( $atts['is_full'] ) ) {
	$el_class .= ' w-100 ';
}

if ( defined( 'VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG' ) && isset( $atts['css'] ) ) {
	$el_class .= ' ' . apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $atts['css'], ' ' ), 'css', $atts );
}

if ( ! empty( $shortcode_class ) ) {
	$el_class .= ' ' . $shortcode_class;
}

global $porto_settings, $porto_settings_optimize;

$output .= '<div class="widget_sidebar_menu main-sidebar-menu' . ( $el_class ? ' ' . esc_attr( trim( $el_class ) ) : '' ) . '"' . ( $nav_menu && ! empty( $porto_settings_optimize['lazyload_menu'] ) ? ' data-menu="' . esc_attr( $nav_menu ) . '"' : '' ) . '>';
if ( $title ) {
	$output .= '<div class="widget-title">';

		$output .= esc_html( $title );
	if ( $porto_settings['menu-sidebar-toggle'] ) {
		$output .= '<div class="toggle"></div>';
	}
	$output .= '</div>';
}
	$output .= '<div class="sidebar-menu-wrap">';

$nav_menu_html_escaped = '';
if ( $nav_menu ) {
	$args = array(
		'container'   => '',
		'menu_class'  => 'sidebar-menu' . ( isset( $porto_settings['side-menu-type'] ) && $porto_settings['side-menu-type'] ? ' side-menu-' . esc_attr( $porto_settings['side-menu-type'] ) : '' ),
		'before'      => '',
		'after'       => '',
		'link_before' => '',
		'link_after'  => '',
		'fallback_cb' => false,
		'walker'      => new porto_sidebar_navwalker,
		'menu'        => $nav_menu,
		'echo'        => false,
	);
	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		//$optimize_backup = $porto_settings_optimize['lazyload_menu'];
		//$porto_settings_optimize['lazyload_menu'] = '';
		$args['depth'] = 2;
		add_filter( 'porto_lazymenu_depth', '__return_true' );
	}
	$nav_menu_html_escaped = wp_nav_menu( $args );

	/*if ( isset( $optimize_backup ) ) {
		$porto_settings_optimize['lazyload_menu'] = $optimize_backup;
	}*/
	if ( ! empty( $porto_settings_optimize['lazyload_menu'] ) ) {
		remove_filter( 'porto_lazymenu_depth', '__return_true' );
	}
}
if ( ! $nav_menu_html_escaped ) {
	$nav_menu_html_escaped = esc_html__( 'Please select a valid menu to display.', 'porto-functionality' );
}
$output .= $nav_menu_html_escaped;

	$output .= '</div>';

$output .= '</div>';

echo porto_filter_output( $output );
