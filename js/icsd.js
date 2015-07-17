jQuery(document).ready(function($) {

  // Expand/Collapse for Speaker bios
  $('div.speakers h2 span.more').on('click', function() {

    $(this).next('ul').toggleClass('toggled');

  });

});