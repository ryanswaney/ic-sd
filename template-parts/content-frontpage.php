<?php
/*
*  Loop through post objects (assuming this is a multi-select field) ( setup postdata )
*  Using this method, you can use all the normal WP functions as the $post object is temporarily initialized within the loop
*  Read more: http://codex.wordpress.org/Template_Tags/get_posts#Reset_after_Postlists_with_offset
*/

$post_objects = get_field('front_page_sections');

if( $post_objects ): ?>

    <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>

        <?php setup_postdata($post); ?>

        <?php //print_r($post); ?>

        <?php if ( $post->post_type == 'post' ) : ?>

        <?php get_template_part( 'template-parts/content', 'report'); ?>

        <?php elseif ( $post->post_type == 'page' ) : ?>

        <?php get_template_part( 'template-parts/content', 'page' ); ?>

        <?php elseif ( $post->post_type == 'events' ) : ?>

        <?php get_template_part( 'template-parts/content', 'event' ); ?>

        <?php endif; ?>

    <?php endforeach; ?>


    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

<?php endif; ?>