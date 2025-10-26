<?php ?>
</main>
<footer class="site-footer paper">
  <div class="container">
    <p>&copy; <?php echo date('Y'); ?> Lovelily Blooms. All rights reserved.</p>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>

<script>
(function($){
  // Ensure we have WC fragment params available before using them.
  if ( typeof wc_cart_fragments_params !== 'undefined' ) {
    // When WooCommerce triggers 'added_to_cart' (after successful AJAX add to cart), update our cart link.
    $( document.body ).on( 'added_to_cart', function( event, fragments, cart_hash, $button ) {
      // If fragments are provided, try to replace our cart-contents area
      if ( fragments ) {
        if ( fragments['a.cart-contents'] ) {
          $('.cart-contents').replaceWith( fragments['a.cart-contents'] );
        } else if ( fragments['div.widget_shopping_cart_content'] ) {
          // some themes use the mini-cart fragment
          $('.cart-contents').replaceWith( fragments['div.widget_shopping_cart_content'] );
        }
      } else {
        // Fallback: request refreshed fragments from WooCommerce
        $.post( wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ), {}, function( data ) {
          if ( data && data.fragments ) {
            if ( data.fragments['a.cart-contents'] ) {
              $('.cart-contents').replaceWith( data.fragments['a.cart-contents'] );
            }
            if ( data.fragments['div.widget_shopping_cart_content'] ) {
              $('.cart-contents').replaceWith( data.fragments['div.widget_shopping_cart_content'] );
            }
          }
        });
      }
    });
  }
})(jQuery);
</script>
