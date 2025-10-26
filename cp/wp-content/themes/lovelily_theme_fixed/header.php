<?php ?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">Lovelily Blooms</a>
    <nav class="nav">
      <?php wp_nav_menu(['theme_location'=>'primary','container'=>false,'menu_class'=>'menu','fallback_cb'=>false]); ?>
      <?php if ( function_exists( 'wc_get_page_id' ) ):
        // Show cart summary (item count and total).
        // Prefer linking to the Cart page if present (avoids 404 when Checkout page is missing).
        $checkout_id = wc_get_page_id( 'checkout' );
        if ( $checkout_id ) {
          $checkout_url = get_permalink( $checkout_id );
        } elseif ( function_exists( 'wc_get_checkout_url' ) ) {
          $checkout_url = wc_get_checkout_url();
        } else {
          $checkout_url = '';
        }

        // Prefer cart page when available; otherwise fall back to checkout, then shop.
        $cart_page_id = wc_get_page_id( 'cart' );
        if ( $cart_page_id && $cart_page_id > 0 ) {
          $cart_target_url = get_permalink( $cart_page_id );
        } elseif ( ! empty( $checkout_url ) ) {
          $cart_target_url = $checkout_url;
        } elseif ( function_exists( 'wc_get_page_id' ) && wc_get_page_id( 'shop' ) ) {
          $cart_target_url = get_permalink( wc_get_page_id( 'shop' ) );
        } else {
          // If WooCommerce helper exists, try wc_get_cart_url() or wc_get_checkout_url() as a safer fallback
          if ( function_exists( 'wc_get_cart_url' ) ) {
            $cart_target_url = wc_get_cart_url();
          } elseif ( function_exists( 'wc_get_checkout_url' ) ) {
            $cart_target_url = wc_get_checkout_url();
          } else {
            // Last resort, link to home
            $cart_target_url = home_url( '/' );
          }
        }

        $cart_count = 0; $cart_total = '';
        if ( function_exists('WC') && WC()->cart ) {
          $cart_count = (int) WC()->cart->get_cart_contents_count();
          $cart_total = WC()->cart->get_cart_total();
        }
      ?>
  <a class="btn small cart-link cart-contents" href="<?php echo esc_url( $cart_target_url ); ?>">
          Cart
          <span class="cart-details">
            <?php echo esc_html( $cart_count ); ?> items — <?php echo wp_kses_post( $cart_total ?: '' ); ?>
          </span>
        </a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main>
