<?php
/**
 * Content -- Event
 *
 * Template (partial) used for displaying an individual event post.
 *
 * @package icsd
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php // Check for Feature Image

	if ( has_post_thumbnail() ) :

	$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

?>
	<header class="entry-header has-feature-image" <?php echo 'style="background-image: linear-gradient(
      rgba(0, 0, 0, 0.2),
      rgba(0, 0, 0, 0.2) ),
      url('.$large_image_url[0].');"'; ?>>

		<?php if(get_field('event_theme')) : ?>
		<h2 class="event-theme"><?php the_field('event_theme'); ?></h2>
		<?php endif; /* Event Theme // ACF */ ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<h4 class="event-date"><?php icsd_acf_events_date_range(); ?></h4>
			<h4 class="event-location"><?php the_field('event_location_text'); ?></h4>
		</div><!-- .entry-meta -->

		<?php if ( get_field('event_registration_url') ): ?>
		<div class="event-call-to-action">
			<a href="<?php echo esc_url( the_field('event_registration_url') ); ?>" title="Register">Register</a>
		</div>
		<?php endif; // call to action ?>

	</header>

<?php else : // no feature image ?>

	<header class="entry-header">

		<?php if(get_field('event_theme')) : ?>
		<h2 class="event-theme"><?php the_field('event_theme'); ?></h2>
		<?php endif; /* Event Theme // ACF */ ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php icsd_acf_events_date_range(); ?>
		</div><!-- .entry-meta -->

		<?php if ( get_field('event_registration_url') ): ?>
		<div class="event-call-to-action">
			<?php echo esc_url( the_field('event_registration_url') ); ?>
		</div>
		<?php endif; // call to action ?>

	</header><!-- .entry-header -->

<?php endif; // entry header ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<?php if( have_rows('speaker') ): ?>
	<span class="anchor" id="speakers"></span>
	<div class="speakers">
		<h2>Featured Speakers <span class="more">Expand All</span></h2>
		<ul class="speaker-list">
		<?php while ( have_rows('speaker') ) : the_row(); ?>

			<?php if( get_row_layout() == 'speaker_details' ): ?>
				<li>
					<div class="speaker-header">
					<?php if (get_sub_field('speaker_photo') ): ?>
						<?php
							$image = get_sub_field('speaker_photo');

							$size = 'thumbnail';
							$thumb = $image['sizes'][ $size ];
						?>

							<img src="<?php echo $thumb; ?>" class="speaker-photo" />

					<? endif; /* Event -- Speaker Photos // ACF // */ ?>
					
					<div>
					<?php if ( get_sub_field('speaker_name') ) : ?>
						<h3 class="speaker-name"><?php the_sub_field('speaker_name'); /* Event -- Speaker Name // ACF */ ?></h3>
					<?php endif; ?>
					
					<?php if ( get_sub_field('speaker_title') ): ?>
						<h4 class="speaker-title"><?php the_sub_field('speaker_title'); /* Event -- Speaker Title // ACF */ ?></h4>
					<?php endif; ?>
					</div>
					</div><!-- Speaker Header -->
					
					<?php if ( get_sub_field('speaker_bio') ): ?>
						<div class="speaker-bio">
							<?php the_sub_field('speaker_bio'); /* Event -- Speaker Bio // ACF */ ?>
						</div>
					<?php endif; ?>
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

	<span class="anchor" id="agenda"></span>
	<div class="agenda">

	<h2 class="agenda-title">Agenda</h2>

	

	<?php if( have_rows('session_group_1', $agenda_object->ID) ): ?>

		<ol class="sessions">

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
								<h3><?php the_sub_field('d1_psl_title' ); ?></h3>
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

		</ol>

	<?php endif; // Day 1 Sessions ?>

	<?php if( have_rows('session_group_2', $agenda_object->ID) ): ?>

		<ol class="sessions">

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
								<h3><?php the_sub_field('d2_psl_title' ); ?></h3>
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

		</ol> <!-- // Sessions -->

	<?php endif; // Day 2 Sessions ?>

	</div>

	<?php endif; ?>


	<?php $location = get_field('event_location_map'); ?>
	<?php if( !empty($location) ): ?>
	<span class="anchor" id="location"></span>
	<div class="location">
		<h2>Location</h2>
		<div class="event-map">
			<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
		</div>


	<?php if ( get_field('event_dining') ): ?>
	<div class="event-dining">
		<h3>Dining</h3>
		<?php the_field('event_dining'); ?>
	</div>
	<?php endif; // event dining ?>

	<?php if( get_field('event_accommodations') ): ?>
	<div class="event-accommodations">
		<h3>Accommodations</h3>
		<?php the_field('event_accommodations'); ?>
	</div>
	<?php endif; // event accommodations ?>

	</div>
	<?php endif; ?>

	<footer class="entry-footer">
		<?php icsd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
