jQuery(document).ready(function($) {

  // Expand/Collapse for Speaker bios
  $('.js div.speakers h2 span.more').on('click', function() {

    $(this).next('ul').toggleClass('toggled');

  });

});