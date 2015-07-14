<?php
/**
 * @package icsd
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php if(get_field('event_theme')) : ?>
			<h2 class="event-theme"><?php the_field('event_theme'); ?></h2>

		<?php endif; /* Event Theme // ACF */ ?>
		
		<h3 class="event-location"><?php icsd_acf_events_date_range(); ?> | <?php the_field('event_location_text'); ?></h3>

		
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php
			/* translators: %s: Name of current post */
			the_excerpt( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'icsd' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php icsd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->