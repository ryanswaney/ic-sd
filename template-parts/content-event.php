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
	background-image: url('.$large_image_url[0].');
			background-position: top center;
			padding-bottom: 0;"'; ?>>

<?php else : // no feature image ?>

	<header class="entry-header">

<?php endif; // entry header ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

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

		<ul class="event-meta">
			<?php if(get_field('event_theme-')) : ?>
			<li class="event-theme"><?php the_field('event_theme'); ?></li>
			<?php endif; /* Event Theme // ACF */ ?>
			<li>
				<?php icsd_acf_events_date_range(); ?> /
				<span class="event-location"> <?php the_field('event_location_text'); ?></span>
			</li>
			<li>
				<?php if(get_field('event_twitter_link')) :

					$twitter_link = get_field('event_twitter_link');

				?>
				<svg viewBox="328 355 335 276" xmlns="http://www.w3.org/2000/svg" class="twitter-logo">
					<path d="
						M 630, 425
						A 195, 195 0 0 1 331, 600
						A 142, 142 0 0 0 428, 570
						A  70,  70 0 0 1 370, 523
						A  70,  70 0 0 0 401, 521
						A  70,  70 0 0 1 344, 455
						A  70,  70 0 0 0 372, 460
						A  70,  70 0 0 1 354, 370
						A 195, 195 0 0 0 495, 442
						A  67,  67 0 0 1 611, 380
						A 117, 117 0 0 0 654, 363
						A  65,  65 0 0 1 623, 401
						A 117, 117 0 0 0 662, 390
						A  65,  65 0 0 1 630, 425
						Z"
						style="fill:#3BA9EE;"/>
				</svg>
				<a href="<?php echo "https://twitter.com/".$twitter_link; ?>"><?php echo "@".$twitter_link; ?></a>
			<?php endif; // twitter link -- acf event_twitter_link ?>
			<?php if(get_field('event_hashtag')) :
				$twitter_hashtag = get_field('event_hashtag');
			?>
				<svg viewBox="328 355 335 276" xmlns="http://www.w3.org/2000/svg" class="twitter-logo">
					<path d="
						M 630, 425
						A 195, 195 0 0 1 331, 600
						A 142, 142 0 0 0 428, 570
						A  70,  70 0 0 1 370, 523
						A  70,  70 0 0 0 401, 521
						A  70,  70 0 0 1 344, 455
						A  70,  70 0 0 0 372, 460
						A  70,  70 0 0 1 354, 370
						A 195, 195 0 0 0 495, 442
						A  67,  67 0 0 1 611, 380
						A 117, 117 0 0 0 654, 363
						A  65,  65 0 0 1 623, 401
						A 117, 117 0 0 0 662, 390
						A  65,  65 0 0 1 630, 425
						Z"
						style="fill:#3BA9EE;"/>
				</svg>
				<a href="<?php echo "https://twitter.com/hashtag/".$twitter_hashtag; ?>"><?php echo "#".$twitter_hashtag; ?></a>
			<?php endif; // hashtag -- acf event_hashtag ?>
		  </li>
		</ul>

	</header>

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

				$modal_id = 'speaker_modal_id_'.$speaker_counter;

				if( get_row_layout() == 'speaker_details' ): ?>
				<li>
						<?php
						if(get_sub_field('speaker_photo')):
							$image = get_sub_field('speaker_photo');
							$size = 'small';
							$thumb = $image['sizes'][ $size ];
							echo '<img src="'.$thumb.'" class="speaker-photo js-modal"
							data-modal-prefix-class="speaker"
							data-modal-content-id="'.$modal_id.'"
							data-modal-title="'.get_sub_field('speaker_name').'"
							data-modal-close-text="Close"
			        data-modal-close-title="Close" />';
						endif; /* Event -- Speaker Photos // ACF // */ ?>

						<?php	if ( get_sub_field('speaker_name') ) : ?>
			        <h3 class="js-modal speaker-name"
			        data-modal-prefix-class="speaker"
			        data-modal-content-id="<?php echo $modal_id; ?>"
			        data-modal-title="<?php the_sub_field('speaker_name');?>"
			        data-modal-close-text="Close"
			        data-modal-close-title="Close">
			        <?php the_sub_field('speaker_name'); ?>
							<?php if(get_sub_field('speaker_title')): ?>
							<span class="speaker-title">
							  <?php the_sub_field('speaker_title'); /* Event -- Speaker Title // ACF */ ?>
						  </span>
							<?php endif; // speaker title ?>
						</h3>
			      <?php endif; // speaker name ?>


						<?php if ( get_sub_field('speaker_bio') ): ?>
						<div id="<?php echo $modal_id; ?>" class="speaker-bio">

							<?php
							if(get_sub_field('speaker_photo')) :
								$image = get_sub_field('speaker_photo');
								$size = 'thumbnail';
								$thumb = $image['sizes'][ $size ];

								echo '<img src="'.$thumb.'" class="speaker-photo-modal" />';

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

	<?php endif; // Day 3 Sessions ?>

	<?php if( have_rows('session_group_3', $agenda_object->ID) ): ?>

		<ol class="sessions">

		<?php while ( have_rows('session_group_3', $agenda_object->ID) ) : the_row(); ?>


		<?php if( get_row_layout() == 'd3_basic_session' ): ?>

			<li class="single-session">
				<time><?php the_sub_field('d3_bs_time'); ?></time>
				<div class="event-description">

				<?php
					$image = get_sub_field('d3_bs_photo');

					if( !empty($image) ):

					$size = 'thumbnail';
					$thumb = $image['sizes'][ $size ];

					?>

					<img class="session-thumb-photo" src="<?php echo $thumb ?>" alt="<?php echo $image['alt']; ?>" />

					<?php endif; ?>

					<h2><?php the_sub_field('d3_bs_title'); ?></h2>

					<?php the_sub_field('d3_bs_desc'); ?>
				</div>
			</li>

		<?php elseif( get_row_layout() == 'd3_parallel_session' ): ?>

			<li class="single-session has-session-info">
				<time><?php the_sub_field('d3_ps_time'); ?></time>
				<div class="event-description">
					<h2><?php the_sub_field('d3_ps_title'); ?></h2>

					<?php if( have_rows('d3_ps_list') ): ?>
					<div class="session-extended">
						<ol>
						<?php while ( have_rows('d3_ps_list') ) : the_row(); ?>
							<li>
								<h3><?php the_sub_field('d3_psl_title' ); ?></h3>
								<div class="sub-session-desc">
								<?php the_sub_field('d3_ps_desc'); ?>
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

	<?php endif; // Day 3 Sessions ?>

	<?php if( have_rows('session_group_4', $agenda_object->ID) ): ?>

		<ol class="sessions">

		<?php while ( have_rows('session_group_4', $agenda_object->ID) ) : the_row(); ?>


		<?php if( get_row_layout() == 'd4_basic_session' ): ?>

			<li class="single-session">
				<time><?php the_sub_field('d4_bs_time'); ?></time>
				<div class="event-description">

				<?php
					$image = get_sub_field('d4_bs_photo');

					if( !empty($image) ):

					$size = 'thumbnail';
					$thumb = $image['sizes'][ $size ];

					?>

					<img class="session-thumb-photo" src="<?php echo $thumb ?>" alt="<?php echo $image['alt']; ?>" />

					<?php endif; ?>

					<h2><?php the_sub_field('d4_bs_title'); ?></h2>

					<?php the_sub_field('d4_bs_desc'); ?>
				</div>
			</li>

		<?php elseif( get_row_layout() == 'd4_parallel_session' ): ?>

			<li class="single-session has-session-info">
				<time><?php the_sub_field('d4_ps_time'); ?></time>
				<div class="event-description">
					<h2><?php the_sub_field('d4_ps_title'); ?></h2>

					<?php if( have_rows('d4_ps_list') ): ?>
					<div class="session-extended">
						<ol>
						<?php while ( have_rows('d4_ps_list') ) : the_row(); ?>
							<li>
								<h3><?php the_sub_field('d4_psl_title' ); ?></h3>
								<div class="sub-session-desc">
								<?php the_sub_field('d4_ps_desc'); ?>
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

	<?php endif; // Day 4 Sessions ?>

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
		<h2>Sponsors &amp; Partners</h2>
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
