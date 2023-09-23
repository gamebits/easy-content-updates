<?php

// Allow WP-CLI to modify database posts
define('WP_USE_THEMES', false);
require_once('wp-load.php');

function seo_excerpt_wp_cli_run()
{   
    $args = array( 
        'post_type'   => 'post',
        'numberposts' => -1,
        'post_status' => 'publish',
    );

    $posts = get_posts( $args );

    foreach ( $posts as $post )
    {
        if( '' == $post->post_excerpt )
        {
            // First, try to get Yoast SEO Description
            $seo_excerpt = get_post_meta( $post->ID, '_yoast_wpseo_metadesc' ,true);
            
            if( '' == $seo_excerpt ) {
                // If Yoast SEO description not found, try getting AIOSEOP Description
                $seo_excerpt = get_post_meta( $post->ID, '_aioseop_description' ,true);
            }

            if( '' != $seo_excerpt ) {
                $po = array();
                $po = get_post( $post->ID, 'ARRAY_A' );
                $po['post_excerpt'] = $seo_excerpt;
                wp_update_post($po);
            }
        }
    }   
}

// Run the dedicated function
seo_excerpt_wp_cli_run();