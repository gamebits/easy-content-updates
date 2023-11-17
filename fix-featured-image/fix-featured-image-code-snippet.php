<?php

/**
 * Fix featured images after a WXR import if needed
 * by grabbing the first attached image for each post
 * that has minimum 1200px width and setting it as the
 * featured image. Otherwise, use fallback image.
 */

// Define fallback featured image ID & minimum width
$fallback_featured_image_id = 0; // Defaults to using media attached to the post only; set to the non-zero post ID of a fallback media file to be used when no attachments are found.
$image_anysize = 0; // When set to 0, a minimum width of 1200px is enforced; set to 1 to allow any size of featured image.

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
			'order' => 'ASC',
		] );

		if ( empty( $attachments ) ) {
			WP_CLI::line( "No attachments found for post " . $post_id );
			
			// If fallback ID is not zero, assign it to the post.
			if ( $fallback_featured_image_id != 0 ) {
				WP_CLI::line( "Assigning fallback featured image " . $fallback_featured_image_id . " to post " . $post_id );
				update_post_meta( $post_id, '_thumbnail_id', $fallback_featured_image_id );
			}
			
			continue;
		}

		// Loop through attachments until one with sufficient width is found.
		$featured_image_id = 0;
		foreach ( $attachments as $attachment_id ) {
			$metadata = wp_get_attachment_metadata( $attachment_id );
			// If $image_anysize is 1, ignore width check.
			if ( $image_anysize == 1 || ($metadata && $metadata['width'] >= 1200) ) {
				$featured_image_id = $attachment_id;
				break;
			}
		}

		if ( $featured_image_id == 0 ) { // No suitable attachment was found
			$featured_image_id = $fallback_featured_image_id;
		}

		WP_CLI::line( "Assigned featured image " . $featured_image_id . " for post " . $post_id );
		update_post_meta( $post_id, '_thumbnail_id', $featured_image_id );
	}
}