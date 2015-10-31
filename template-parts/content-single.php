<?php
/**
 * @package icsd
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php // Check for Feature Image
	if ( has_post_thumbnail() ) : $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
?>
	<header class="entry-header has-feature-image" <?php echo 'style="background-image: linear-gradient(
      rgba(0, 0, 0, 0.4),
      rgba(0, 0, 0, 0.4) ),
      url('.$large_image_url[0].');"'; ?>>
<?php else : ?>
	<header class="entry-header">
<?php endif; ?>
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<div class="entry-meta">
			<?php icsd_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php icsd_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
