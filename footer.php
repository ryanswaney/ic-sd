<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package icsd
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">

        <?php

        $defaults = array(
        'theme_location'  => 'footer-1',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'footer-menu-wrap',
        'container_id'    => '',
        'menu_class'      => 'footer-menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<h4>Learn About ICSD</h4><ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );

        wp_nav_menu( $defaults );

        ?>

        <?php

        $defaults = array(
        'theme_location'  => 'footer-2',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'footer-menu-wrap',
        'container_id'    => '',
        'menu_class'      => 'footer-menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<h4>Attend ICSD</h4><ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );

        wp_nav_menu( $defaults );

        ?>

        <?php

        $defaults = array(
        'theme_location'  => 'social',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'footer-menu-wrap',
        'container_id'    => '',
        'menu_class'      => 'footer-menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<h4>Connect with ICSD</h4><ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        );

        wp_nav_menu( $defaults );

        ?>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
