jQuery(document).ready(function($) {

  // Expand/Collapse for Speaker bios
  $('div.speakers h2 span.more').on('click', function() {

    $(this).parent().next('.speaker-list').toggleClass('toggled');

  });

});