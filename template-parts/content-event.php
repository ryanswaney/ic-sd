<?php
/**
 * @package icsd
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if(get_field('event_theme')) : ?>
		<h2 class="event-theme"><?php the_field('event_theme'); ?></h2>
		<?php endif; /* Event Theme // ACF */ ?>

		<div class="entry-meta">
			<?php icsd_acf_events_date_range(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php if( have_rows('speaker') ): ?>
	<div class="speakers">
		<h2>Keynote Speakers</h2>
		<ul class="speaker-list">
		<?php while ( have_rows('speaker') ) : the_row(); ?>

			<?php if( get_row_layout() == 'speaker_details' ): ?>
				<li>
					<?php if ( get_sub_field('speaker_name') ) : ?>
					<h3 class="speaker-name"><?php the_sub_field('speaker_name'); /* Event -- Speaker Name // ACF */ ?></h2>
					<?php endif; ?>
					<?php if ( get_sub_field('speaker_title') ): ?>
					<h4 class="speaker-title"><?php the_sub_field('speaker_title'); /* Event -- Speaker Title // ACF */ ?></h4>
					<?php endif; ?>
					<?php if ( get_sub_field('speaker_bio') ): ?>
					<div class="speaker-bio">
					<?php the_sub_field('speaker_bio'); /* Event -- Speaker Bio // ACF */ ?>
					<?php endif; ?>
					</div>
				</li>
			<?php endif; ?>

		<?php endwhile; ?>
		</ul>
	</div>
	<?php endif; ?>
	<!-- .speakers -->

	

	<footer class="entry-footer">
		<?php icsd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
