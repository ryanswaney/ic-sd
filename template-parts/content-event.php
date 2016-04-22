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
	<header class="entry-header has-feature-image" <?php echo 'style="background-color: #000;
	background-image: linear-gradient(
      rgba(0, 0, 0, 0.0),
      rgba(0, 0, 0, 0.0) ),
      url('.$large_image_url[0].');
			background-position: top center;
			position: relative;
			padding-bottom: 0;"'; ?>>

		<?php if(get_field('event_theme-')) : ?>
		<h2 class="event-theme">
			<span><?php the_field('event_theme'); ?></span>
		</h2>
		<?php endif; /* Event Theme // ACF */ ?>

		<?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>

		<!--
		<div class="entry-meta">
			<h4 class="event-date">
				<span><?php //icsd_acf_events_date_range(); ?></span>
			</h4>
			<h4 class="event-location">
				<span><?php the_field('event_location_text-'); ?></span>
		  </h4>
		</div><!-- .entry-meta -->

		<?php if ( get_field('event_registration_url') ): ?>
		<div class="event-call-to-action">
			<a href="<?php echo esc_url( the_field('event_registration_url') ); ?>" title="Register">Register</a>
		</div>
		<?php endif; // call to action ?>

		<?php if ( get_field('live_stream_url') ): ?>
		<div class="event-call-to-action">
			<a href="<?php echo esc_url( the_field('live_stream_url') ); ?>" title="Watch Live">Watch Live</a>
		</div>
		<?php endif; // call to action ?>

		<ul class="test-list">
			<li>
				<span>Moving Forward: The SDGs in Practice</span>
			</li>
			<li><span>September 21 – 22, 2016</span></li>
			<li><span>New York, NY</span></li>
		</ul>

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

	<?php if( have_rows('speaker') ) : ?>
	<?php $speaker_counter = 0; ?>

	<div class="speakers">
		<span class="anchor" id="speakers"></span>
		<h2>Featured Speakers</h2>

		<ul class="speaker-list">
		<?php
		// loop through speakers
			while ( have_rows('speaker') ) : the_row();

			$speaker_counter++;

				if( get_row_layout() == 'speaker_details' ):
		?>
				<li>
					<div class="speaker-header">
						<?php
						if(get_sub_field('speaker_photo')):
							$image = get_sub_field('speaker_photo');
							$size = 'thumbnail';
							$thumb = $image['sizes'][ $size ];
							echo '<img src="'.$thumb.'" class="speaker-photo"/>';
						endif; /* Event -- Speaker Photos // ACF // */ ?>

						<div>

						<?php
						if ( get_sub_field('speaker_name') ) :
							$modal_id = 'speaker_modal_id_'.$speaker_counter;
			      ?>
			        <button class="js-modal speaker-name"
			        data-modal-prefix-class="speaker"
			        data-modal-content-id="<?php echo $modal_id; ?>"
			        data-modal-title="<?php the_sub_field('speaker_name');?>"
			        data-modal-close-text="Close"
			        data-modal-close-title="Close">
			        <?php the_sub_field('speaker_name'); ?>
			        </button>
			      <?php endif; // speaker name ?>

						<?php if(get_sub_field('speaker_title')): ?>
							<h4 class="speaker-title">
								<?php the_sub_field('speaker_title'); /* Event -- Speaker Title // ACF */ ?>
							</h4>
						<?php endif; // speaker title ?>
						</div>
						</div><!-- Speaker Header -->

						<?php if ( get_sub_field('speaker_bio') ): ?>
						<div id="<?php echo $modal_id; ?>" class="speaker-bio">

							<?php
							if(get_sub_field('speaker_photo')) :
								$image = get_sub_field('speaker_photo');
								$size = 'thumbnail';
								$thumb = $image['sizes'][ $size ];

								echo '<img src="'.$thumb.'" class="speaker-photo" />';

							endif; /* Event -- Speaker Photos // ACF // */ ?>

							<?php the_sub_field('speaker_bio'); /* Event -- Speaker Bio // ACF */ ?>
						</div>
  					<?php endif; // speaker bio ?>

				</li>
		<?php
				endif; // speaker_details
			endwhile; // speaker loop
		?>
		</ul>

	</div>
	<?php endif; ?>
	<!-- .speakers -->

	<?php

	$agenda_object = get_field('event_agenda');

	if( $agenda_object ): ?>


	<div class="agenda">
	<span class="anchor" id="agenda"></span>

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

					<?php the_sub_field('d1_bs_desc'); ?>
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

					<?php the_sub_field('d2_bs_desc'); ?>
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

	<div class="location">
	<span class="anchor" id="location"></span>
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

<?php if( have_rows('sponsor_list') ): ?>
	<!-- sponsors -->
	<div class="sponsors">
		<span class="anchor" id="sponsors"></span>
		<h2>Sponsors</h2>
		<ul class="sponsor-list">
		<?php while ( have_rows('sponsor_list') ) : the_row(); ?>
			<li>
			<?php
				$image = get_sub_field('sponsor_logo');

				if( !empty($image) ):

				$size = 'medium';
				$thumb = $image['sizes'][ $size ];

				?>

				<img src="<?php echo $thumb ?>" />

			<?php endif; // sponsor-logo ?>
			<?php if( get_sub_field('sponsor_name') ) : ?>
				<h4><?php the_sub_field('sponsor_name'); ?></h4>
			<?php endif; // sponsor_name ?>
			</li>
		<?php endwhile; ?>
		</ul>
	</div>
	<!-- /sponsors -->
	<?php endif; ?>

	<footer class="entry-footer">
		<?php icsd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
