<?php  

  function shortcode_button_func( $atts, $content = null ) {

    // Shortcode to create the buttoncompontent found in Foundation
    // http://foundation.zurb.com/docs/components/buttons.html

    extract(
      shortcode_atts(
        array(
          'title' => '',
          'url' => '',
          'class' => '' // Extends default styles
          ), $atts));

    if ( !empty( $title ) && !empty( $url ) ) :

      $output = '<a href="' . esc_attr( $url ) . '" title="Permalink to: ' . esc_attr( $title ) . '" class="button">' . esc_attr( $title ) . '</a>';

      return $output;

    endif;


  }

  add_shortcode( 'button', 'shortcode_button_func' );

?>