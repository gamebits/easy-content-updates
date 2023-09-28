<?php
/**
* Plugin Name: Fix Featured Images
* Plugin URI: https://github.com/gamebits/easy-content-updates
* Description: Grabs the first attached image for each post and sets it as the featured image.
* Version: 1.0.0
* Author: Newspack
* Author URI: https://newspack.com/
* License: GPL2
* Text Domain: fix-featured-images
* Domain Path: /languages/
**/

// Get all posts.
$posts = get_posts( [
	'post_type'    => 'post',
	'fields'       => 'ids',
	'posts_per_page' => -1,
] );

foreach ( $posts as $post_id ) {

	if (!has_post_thumbnail( $post_id ) ) {
	
		// Get the first attachment.
		$attachments = get_posts( [
			'post_type' => 'attachment',
			'post_parent' => $post_id,
			'fields' => 'ids',
		] );

		if ( empty( $attachments ) ) {
			WP_CLI::line( "No attachments found for post " . $post_id );
			continue;
		}

		$featured_image_id = min( $attachments );
		WP_CLI::line( "Found featured image " . $featured_image_id . " for post " . $post_id );
		update_post_meta( $post_id, '_thumbnail_id', $featured_image_id );
	}
}