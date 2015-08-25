$(document).ready(function(){

   /*
    * jQuery simple and accessible modal window, using ARIA
    * Website: http://a11y.nicolas-hoffmann.net/modal/
    * License MIT: https://github.com/nico3333fr/jquery-accessible-modal-window-aria/blob/master/LICENSE
    */
   // loading modal ------------------------------------------------------------------------------------------------------------
   
   // init
   if ( $('.js-modal').length  ) { // if there are at least one :)
      $('.js-modal' ).each( function(index_to_expand) {
          var $this = $(this) ,
              index_lisible = index_to_expand+1;
          
          $this.attr({
                  'id' : 'label_modal_' + index_lisible
                });

      });
      
      // jQuery formatted selector to search for focusable items
      var focusableElementsString = "a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, *[tabindex], *[contenteditable]";
      
      if ( $('#js-modal-page').length === 0 ) { // just to avoid missing #js-modal-page
         $( 'body' ).wrapInner('<div id="js-modal-page"></div>');
      }
      
      // events ------------------
      $( 'body' ).on( 'click', '.js-modal', function( event ) {
         var $this = $(this),
             options = $this.data(),
             $modal_starter_id = $this.attr('id'),
             $modal_prefix_classes = typeof options.modalPrefixClass !== 'undefined' ? options.modalPrefixClass + '-' : '',
             $modal_text = options.modalText || '',
             $modal_content_id = typeof options.modalContentId !== 'undefined' ? '#' + options.modalContentId : '',
             $modal_title = options.modalTitle || '',
             $modal_close_text = options.modalCloseText || 'Close',
             $modal_close_title = options.modalCloseTitle || options.modalCloseText,
             $modal_background_click = options.modalBackgroundClick || '',
             $modal_code,
             $modal_overlay,
             $page = $('#js-modal-page');
         
         // insert code at the end
         $modal_code = '<dialog id="js-modal" class="' + $modal_prefix_classes + 'modal" role="dialog" aria-labelledby="modal-title"><div role="document">';
         $modal_code += '<button id="js-modal-close" class="' + $modal_prefix_classes + 'modal-close" data-focus-back="' + $modal_starter_id + '" title="' + $modal_close_title + '">' + $modal_close_text + '</button>';
         if ($modal_title !== ''){
            $modal_code += '<h1 id="modal-title" class="' + $modal_prefix_classes + 'modal-title">' + $modal_title + '</h1>';
            }
         if ($modal_text !== ''){
            $modal_code += '<p>' + $modal_text + '</p>';
            }
            else {
                  if ($modal_content_id !== '' && $($modal_content_id).length  ){
                     $modal_code += $($modal_content_id).html();
                     }
                  }

         $modal_code += '</div></dialog>';
         
         $( $modal_code ).insertAfter($page);
         
         $page.attr('aria-hidden', 'true');
         
         // add overlay
         if ( $modal_background_click != 'disabled' ){
            $modal_overlay = '<span id="js-modal-overlay" class="' + $modal_prefix_classes + 'modal-overlay" title="' + $modal_close_title + '" data-background-click="enabled"><span class="invisible">Close modal</span></span>';
            }
            else { $modal_overlay = '<span id="js-modal-overlay" class="' + $modal_prefix_classes + 'modal-overlay" data-background-click="disabled"></span>'; }
         
         $( $modal_overlay ).insertAfter($('#js-modal'));
         
         $('#js-modal-close').focus();
         
         event.preventDefault();
         
      })
      // close button and esc key
      $( 'body' ).on( 'click', '#js-modal-close', function( event ) {
         var $this = $(this),
             $focus_back = '#' + $this.attr('data-focus-back'),
             $js_modal = $('#js-modal'),
             $js_modal_overlay = $('#js-modal-overlay'),
             $page = $('#js-modal-page');
             
         $page.removeAttr('aria-hidden');
         $js_modal.remove();
         $js_modal_overlay.remove();
         $( $focus_back ).focus();
         
      })
      .on( 'click', '#js-modal-overlay', function( event ) {
         var $close = $('#js-modal-close'),
             $focus_back = '#' + $close.attr('data-focus-back'),
             $js_modal = $('#js-modal'),
             $js_modal_overlay = $('#js-modal-overlay'),
             $modal_background_click = $js_modal_overlay.attr('data-background-click'),
             $page = $('#js-modal-page');

         if ( $modal_background_click == 'enabled' ){
             $page.removeAttr('aria-hidden');
             $js_modal.remove();
             $js_modal_overlay.remove();
             $( $focus_back ).focus();
            }
      })
      .on( 'keydown', '#js-modal-overlay', function( event ) {
         if ( event.keyCode == 13 || event.keyCode == 32 ) { // space or enter

             var $close = $('#js-modal-close'),
                 $focus_back = '#' + $close.attr('data-focus-back'),
                 $js_modal = $('#js-modal'),
                 $js_modal_overlay = $('#js-modal-overlay'),
                 $modal_background_click = $js_modal_overlay.attr('data-background-click'),
                 $page = $('#js-modal-page');

             if ( $modal_background_click == 'enabled' ){
                 $page.removeAttr('aria-hidden');
                 $js_modal.remove();
                 $js_modal_overlay.remove();
                 $( $focus_back ).focus();
                 }

         }
      })
      .on( "keydown", "#js-modal", function( event ) {
         var $this = $(this);
         
         if ( event.keyCode == 27 ) { // esc
             var $close = $('#js-modal-close'),
                 $focus_back = '#' + $close.attr('data-focus-back'),
                 $js_modal = $('#js-modal'),
                 $js_modal_overlay = $('#js-modal-overlay'),
                 $page = $('#js-modal-page');
    
             $page.removeAttr('aria-hidden');
             $js_modal.remove();
             $js_modal_overlay.remove();
             $( $focus_back ).focus();
         }
         if ( event.keyCode == 9 ) { // tab or maj+tab

            // get list of all children elements in given object
            var children = $this.find('*');
    
            // get list of focusable items
            var focusableItems = children.filter(focusableElementsString).filter(':visible');
    
            // get currently focused item
            var focusedItem = $( document.activeElement );
    
            // get the number of focusable items
            var numberOfFocusableItems = focusableItems.length;
            
            var focusedItemIndex = focusableItems.index(focusedItem);

            if ( !event.shiftKey && (focusedItemIndex == numberOfFocusableItems - 1) ){
                focusableItems.get(0).focus();
                event.preventDefault();
               }
            if ( event.shiftKey && focusedItemIndex == 0 ){
                focusableItems.get(numberOfFocusableItems - 1).focus();
                event.preventDefault();
               }
               
           
            }
         
      })
      .on( 'focus', '#js-modal-tabindex', function( event ) {
         $('#js-modal-close').focus(); 
      });
   
   
   }
 
  
});