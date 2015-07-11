<?php
/**
 * @package icsd
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php // Check for Feature Image

	if ( has_post_thumbnail() ) :

	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

?>
	<header class="entry-header has-feature-image" <?php echo 'style="background-image:url('.$large_image_url[0].');"';?>>

		<?php if(get_field('event_theme')) : ?>
		<h2 class="event-theme"><?php the_field('event_theme'); ?></h2>
		<?php endif; /* Event Theme // ACF */ ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php icsd_acf_events_date_range(); ?>
		</div><!-- .entry-meta -->

	</header>

<?php else : ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php if(get_field('event_theme')) : ?>
		<h2 class="event-theme"><?php the_field('event_theme'); ?></h2>
		<?php endif; /* Event Theme // ACF */ ?>

		<div class="entry-meta">
			<?php icsd_acf_events_date_range(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

<?php endif; // entry header ?>

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

	<?php

	$agenda_object = get_field('event_agenda');

	if( $agenda_object ): ?>

	<div class="agenda" id="agenda">

	<h2>Agenda</h2>

	<ol class="sessions">

	<?php if( have_rows('session_group_1', $agenda_object->ID) ): ?>

		<?php while ( have_rows('session_group_1', $agenda_object->ID) ) : the_row(); ?>

			<?php if( get_row_layout() == 'basic_session' ): ?>

			<li class="single-session">
				<time><?php the_sub_field('d1_bs_time'); ?></time>
				<div class="event-description">

				<?php
					$image = get_sub_field('d1_bs_photo');

					if( !empty($image) ):

					$size = 'thumbnail';
					$thumb = $image['sizes'][ $size ];

					?>

					<img class="session-thumb-photo" src="<?php echo $thumb ?>" alt="<?php echo $image['alt']; ?>" />

					<?php endif; ?>

					<h2><?php the_sub_field('d1_bs_title'); ?></h2>
				</div>
			</li>

			<?php elseif( get_row_layout() == 'parallel_session' ): ?>

			<li class="single-session has-session-info">
				<time><?php the_sub_field('d1_ps_time'); ?></time>
				<div class="event-description">
					<h2><?php the_sub_field('d1_ps_title'); ?></h2>

					<?php if( have_rows('d1_ps_list') ): ?>
					<div class="session-extended">
						<ol>
						<?php while ( have_rows('d1_ps_list') ) : the_row(); ?>
							<li>
								<h3><?php the_sub_field('d1_ps_title' ); ?></h3>
								<div class="sub-session-desc">
								<?php the_sub_field('d1_ps_desc'); ?>
								</div>
							</li>
						<?php endwhile; ?>
						</ol>
					</div>
					<?php endif; // Parallel Sessions ?>

				</div>
			</li>

			<?php endif; // Session Layout ?>

		<?php endwhile; ?>

	<?php endif; // Day 1 Sessions ?>

	<?php if( have_rows('session_group_2', $agenda_object->ID) ): ?>

		<?php while ( have_rows('session_group_2', $agenda_object->ID) ) : the_row(); ?>


		<?php if( get_row_layout() == 'd2_basic_session' ): ?>

			<li class="single-session">
				<time><?php the_sub_field('d2_bs_time'); ?></time>
				<div class="event-description">

				<?php
					$image = get_sub_field('d2_bs_photo');

					if( !empty($image) ):

					$size = 'thumbnail';
					$thumb = $image['sizes'][ $size ];

					?>

					<img class="session-thumb-photo" src="<?php echo $thumb ?>" alt="<?php echo $image['alt']; ?>" />

					<?php endif; ?>

					<h2><?php the_sub_field('d2_bs_title'); ?></h2>
				</div>
			</li>

			<?php elseif( get_row_layout() == 'd2_parallel_session' ): ?>

			<li class="single-session has-session-info">
				<time><?php the_sub_field('d2_ps_time'); ?></time>
				<div class="event-description">
					<h2><?php the_sub_field('d2_ps_title'); ?></h2>

					<?php if( have_rows('d2_ps_list') ): ?>
					<div class="session-extended">
						<ol>
						<?php while ( have_rows('d2_ps_list') ) : the_row(); ?>
							<li>
								<h3><?php the_sub_field('d2_ps_title' ); ?></h3>
								<div class="sub-session-desc">
								<?php the_sub_field('d2_ps_desc'); ?>
								</div>
							</li>
						<?php endwhile; ?>
						</ol>
					</div>
					<?php endif; // Parallel Sessions ?>

				</div>
			</li>

			<?php endif; // Session Layout ?>

		<?php endwhile; ?>

	<?php endif; // Day 2 Sessions ?>

	</ol> <!-- // Sessions -->

	</div>
  
  <?php //wp_reset_postdata(); // Reset the $post object so the rest of the page works correctly ?>

	<?php endif; ?>


	<?php $location = get_field('event_location_map'); ?>
	<?php if( !empty($location) ): ?>
	<div class="location">
		<h2>Location</h2>
		<div class="event-map">
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
		</div>

		<div class="event-dining">
			<h3>Dining</h3>
			<?php the_field('event_dining'); ?>
		</div>

		<div class="event-accommodations">
			<h3>Accommodations</h3>
			<?php the_field('event_accommodations'); ?>
		</div>

	</div>
	<?php endif; ?>

	<footer class="entry-footer">
		<?php icsd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
