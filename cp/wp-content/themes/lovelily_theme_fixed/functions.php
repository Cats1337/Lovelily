<?php
add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption']);
  register_nav_menus(['primary' => __('Primary Menu','lovelily')]);
  add_theme_support('woocommerce');
});
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('lovelily-app', get_template_directory_uri() . '/assets/app.css', [], '1.0.1');
  wp_enqueue_script('lovelily-cyano', get_template_directory_uri() . '/assets/cyanotype.js', [], '1.0.1', true);
});

// Admin helper: create Classic Commerce (WooCommerce) default pages when requested by an admin.
add_action( 'admin_init', function() {
  if ( ! current_user_can( 'manage_options' ) ) {
    return;
  }
  if ( isset( $_GET['llb_create_wc_pages'] ) && '1' === $_GET['llb_create_wc_pages'] ) {
    if ( function_exists( 'wc_create_pages' ) ) {
      wc_create_pages();
      add_action( 'admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible"><p>Classic Commerce pages created (Cart, Checkout, My account, Shop).</p></div>';
      } );
    } else {
      add_action( 'admin_notices', function() {
        echo '<div class="notice notice-error is-dismissible"><p>Classic Commerce is not active or wc_create_pages() unavailable.</p></div>';
      } );
    }
  }
} );
function llb_sc($shortcode){
  if (shortcode_exists(trim(preg_replace('/\s.+$/','',$shortcode)))) {
    echo do_shortcode('['.$shortcode.']');
  }
}
function llb_cyano_img($id, $alt = '', $size = 'large') {
  $src = wp_get_attachment_image_url($id, $size);
  if (!$src) return;
  $alt = esc_attr($alt ?: get_post_meta($id, '_wp_attachment_image_alt', true));
  echo '<figure class="cyanotype"><img data-src="'.esc_url($src).'" alt="'.$alt.'"></figure>';
}
