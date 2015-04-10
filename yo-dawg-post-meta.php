<?php
/*
Plugin Name: Yo Dawg Post Meta
Plugin URI: https://www.filament-studios.com
Description: Adds a metabox to a post, that shows the post meta
Version: 1.0
Author: Chris Klosowski
Author URI: http://www.kungfugrep.com
License: GPLv2 or later
*/

/**
 * Register the metaboxes for Post Promoter Pro
 * @return void
 */
function ydmb_register_meta_boxes() {
	global $post;

	$post_types = apply_filters( 'ydpm_allowed_post_types', array( 'post', 'page' ) );

	if ( !isset( $post_types ) || !is_array( $post_types ) ) {
		return;
	}

	foreach ( $post_types as $post_type ) {
		add_meta_box( 'ydmb_meta', 'Yo Dawg, I heard you like post meta, so I put your post meta in a registered metabox', 'ydmb_metabox_callback', $post_type, 'normal', 'low' );
	}
}
add_action( 'add_meta_boxes', 'ydmb_register_meta_boxes', 10 );

/**
 * Display the Metabox for Post Promoter Pro
 * @return void
 */
function ydmb_metabox_callback() {
	global $post;
	echo '<div style="overlfow:auto">';
	$post_meta = get_metadata( 'post', $post->ID );
	echo '<pre style="overflow: auto;word-wrap: break-word;">';
	foreach ( $post_meta as $key => $value ) {
		if ( is_serialized( $value[0] ) ) {
			echo $key . '=> ';
			var_dump( unserialize( $value[0] ) );
		} else {
			echo $key . ' => ' . $value[0] . "\n";
		}
	}
	echo '</pre>';
	echo '</div>';
}


