<?php get_header(); ?>
<section class="hero paper">
  <div class="container hero-inner">
    <div class="hero-copy">
      <h1>Fresh flowers, crafted with care</h1>

<!-- Lovelily
(adv.) — in a lovely way.
To do something with grace, care, and heart. -->

      <p>Seasonal bouquets and arrangements. Custom orders and cozy workshops.</p>
      <div class="actions">
        <?php if ( function_exists('wc_get_page_id') ): ?>
          <a class="btn" href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>">Shop bouquets</a>
        <?php endif; ?>
        <?php $classes = get_page_by_path('classes'); if ($classes): ?>
          <a class="btn alt" href="<?php echo esc_url( get_permalink($classes) ); ?>">Book a workshop</a>
        <?php endif; ?>
      </div>
      <div>
        <h4>Definition of the word Lovelily</h4>
        <p><strong>Lovelily</strong><br/>
        (adv.) — in a lovely way. To do something with grace, care, and heart.<br/>
        <em>Origin:</em> Middle English loveliche → lovelily — from love (affection) + -ly (in the manner of). A word once used to describe something done beautifully, tenderly, and with charm.</p>
      </div>
    </div>
    
    <figure class="hero-image cyanotype cyanotype--heavy">
      <?php if ( has_post_thumbnail() ) {
        $id = get_post_thumbnail_id();
        $src = wp_get_attachment_image_url($id, 'full');
        echo '<img data-src="'.esc_url($src).'" alt="'.esc_attr(get_the_title()).'">';
      } else { echo '<div class="img-fallback">Add a Featured Image to the front page</div>'; } ?>
      <figcaption class="hero-title">Lovelily Blooms</figcaption>
    </figure>
  </div>
</section>

<section id="gallery" class="section">
  <div class="container">
    <div class="section-head"><h2>Gallery</h2><p class="muted">Recent work</p></div>
    <div class="grid gallery-grid">
      <?php
        $q=new WP_Query(['posts_per_page'=>9,'post_status'=>'publish','ignore_sticky_posts'=>true,'category_name'=>'gallery']);
        if($q->have_posts()):
          while($q->have_posts()):$q->the_post();
            // compute description first so it can be placed in a data attribute for the lightbox
            $__llb_desc = get_the_excerpt();
            if ( ! $__llb_desc ) {
              $__llb_desc = wp_trim_words( get_the_content(), 20 );
            }
            echo '<article class="card" onclick="llbOpenLightbox(this)" data-caption="'.esc_attr(get_the_title()).'" data-description="'.esc_attr($__llb_desc).'">';
            if ( has_post_thumbnail() ) {
              $id = get_post_thumbnail_id();
              llb_cyano_img( $id, get_the_title(), 'large' );
            } else {
              echo '<div class="img-fallback">Set a Featured Image</div>';
            }
            echo '<div class="pad"><strong>'.esc_html( get_the_title() ).'</strong>';
            if ( $__llb_desc ) {
              echo '<p class="gallery-caption">'.esc_html( $__llb_desc ).'</p>';
            }
            echo '</div></article>';

          endwhile; wp_reset_postdata();
        else:
          echo '<p>Add posts in the "gallery" category with featured images.</p>';
        endif;
      ?>
    </div>
  </div>
</section>

<section id="shop" class="section paper">
  <div class="container">
    <div class="section-head"><h2>Shop</h2><p>Pickup and local delivery available</p></div>
    <div class="grid product-grid">
      <?php
        // Show any content that has the 'shop' category (category slug: 'shop').
        // Use a category tax_query and allow any public post type that supports the 'category' taxonomy.
        $sq = new WP_Query([
          'posts_per_page'      => 8,
          'post_status'         => 'publish',
          'ignore_sticky_posts' => true,
          'post_type'           => 'any',
          'tax_query'           => [
            'relation' => 'OR',
            // Standard post category with slug 'shop'
            [ 'taxonomy' => 'category',   'field' => 'slug', 'terms' => array( 'shop' ) ],
            // WooCommerce product category (if products are used and product_cat has a 'shop' term)
            [ 'taxonomy' => 'product_cat','field' => 'slug', 'terms' => array( 'shop' ) ],
          ],
        ]);
        if ( $sq->have_posts() ):
          while ( $sq->have_posts() ): $sq->the_post();
            echo '<article class="card" onclick="llbOpenLightbox(this)" data-caption="'.esc_attr(get_the_title()).'">';
            if ( has_post_thumbnail() ) { $id = get_post_thumbnail_id(); llb_cyano_img( $id, get_the_title(), 'large' ); }
            else { echo '<div class="img-fallback">Set a Featured Image</div>'; }
            $__desc = get_the_excerpt(); if ( ! $__desc ) { $__desc = wp_trim_words( get_the_content(), 20 ); }
            echo '<div class="pad"><strong>'.esc_html(get_the_title()).'</strong>';
            if ( $__desc ) { echo '<p class="gallery-caption">'.esc_html($__desc).'</p>'; }

            // Show price and add-to-cart button for products (WooCommerce) or a simple price for other post types
            $price_html = '';
            $add_button = '';
            $ptype = get_post_type( get_the_ID() );

            if ( $ptype === 'product' && function_exists( 'wc_get_product' ) ) {
              $product = wc_get_product( get_the_ID() );
              if ( $product ) {
                $price_html = $product->get_price_html();
                // For simple products, render an ajax add-to-cart button with data attributes so WooCommerce JS works.
                if ( $product->is_purchasable() ) {
                  if ( $product->is_type( 'simple' ) ) {
                    $add_url = esc_url( add_query_arg( 'add-to-cart', $product->get_id(), get_permalink( $product->get_id() ) ) );
                    $add_button = '<a href="' . $add_url . '" class="btn alt add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="' . esc_attr( $product->get_id() ) . '">' . esc_html__( 'Add to cart', 'lovelily' ) . '</a>';
                  } else {
                    // Variable or grouped product: link to product page to choose options
                    $add_button = '<a href="' . esc_url( get_permalink( $product->get_id() ) ) . '" class="btn alt">' . esc_html__( 'Select options', 'lovelily' ) . '</a>';
                  }
                }
              }
            } else {
              // Try legacy _price meta
              $raw_price = get_post_meta( get_the_ID(), '_price', true );
              if ( $raw_price !== '' && $raw_price !== null ) {
                if ( function_exists( 'wc_price' ) ) { $price_html = wc_price( (float) $raw_price ); }
                else { $price_html = '$' . number_format( (float) $raw_price, 2 ); }
                // Link to the single post for purchase/booking
                $add_button = '<a class="btn alt" href="' . esc_url( get_permalink() ) . '">' . esc_html__( 'Buy', 'lovelily' ) . '</a>';
              }
            }

            if ( $price_html || $add_button ) {
              echo '<p class="shop-meta">';
              if ( $price_html ) { echo '<span class="price">' . $price_html . '</span>'; }
              if ( $add_button ) { echo ' ' . $add_button; }
              echo '</p>';
            }

            echo '</div></article>';
          endwhile; wp_reset_postdata();
        else:
          echo '<div class="card"><div class="pad"><h3>The Lovelily Blooms flower cart is coming soon!</h3><p>We can’t wait to bring you hand-tied bouquets and pop-up bouquet bars. Follow us on social media for sneak peeks, updates, and all things Lovelily.</p></div></div>';
        endif;
      ?>
    </div>
  </div>
</section>

<section id="classes" class="section">
  <div class="container">
    <div class="section-head"><h2>Workshops</h2><p>All levels. Tools and flowers provided</p></div>
    <div class="grid class-grid">
      <?php
        // First, look for event-type posts (common event plugins) tagged 'workshops'
        // Include Mage EventPress post type and taxonomies used by that plugin.
        $event_post_types = array( 'event', 'tribe_events', 'em_event', 'easyevent', 'mep_events' );
        $eq = new WP_Query([
          'post_type' => $event_post_types,
          'posts_per_page' => 6,
          'post_status' => 'publish',
          'ignore_sticky_posts' => true,
          'tax_query' => [
            'relation' => 'OR',
            [ 'taxonomy' => 'post_tag',       'field' => 'slug', 'terms' => array( 'workshops', 'workshop' ) ],
            [ 'taxonomy' => 'event_tag',      'field' => 'slug', 'terms' => array( 'workshops', 'workshop' ) ],
            // Mage EventPress uses 'mep_tag' and 'mep_cat' (and registers 'mep_cat' for event categories)
            [ 'taxonomy' => 'mep_tag',        'field' => 'slug', 'terms' => array( 'workshops', 'workshop' ) ],
            [ 'taxonomy' => 'mep_cat',        'field' => 'slug', 'terms' => array( 'workshops', 'workshop' ) ],
            [ 'taxonomy' => 'events_category','field' => 'slug', 'terms' => array( 'workshops', 'workshop' ) ],
          ],
        ]);

        if ( $eq->have_posts() ):
          while ( $eq->have_posts() ): $eq->the_post();
            // build accessibility-friendly clickable card (role/button + keyboard handler)
            $card_attrs = 'class="card" onclick="llbOpenLightbox(this)" role="button" tabindex="0" onkeydown="if(event.key===\'Enter\'||event.key===\' \'){ llbOpenLightbox(this); }"';
            echo '<article ' . $card_attrs . ' data-caption="'.esc_attr(get_the_title()).'">';
            if ( has_post_thumbnail() ) { $id = get_post_thumbnail_id(); llb_cyano_img( $id, get_the_title(), 'large' ); }
            else { echo '<div class="img-fallback">Set a Featured Image</div>'; }
            $__desc = get_the_excerpt(); if ( ! $__desc ) { $__desc = wp_trim_words( get_the_content(), 20 ); }

            // Split pad into left (title/desc) and right (price/seats/book)
            echo '<div class="pad workshop-split">';
            // left column
            echo '<div class="left">';
            echo '<strong>'.esc_html(get_the_title()).'</strong>';
            if ( $__desc ) { echo '<p class="gallery-caption">'.esc_html($__desc).'</p>'; }
            echo '</div>';

            // prepare price/seat data for right column
            $price_html = '';
            if ( function_exists('mep_event_list_price') ) {
              $price_html = mep_event_list_price( get_the_ID() );
            } else {
              $raw_price = get_post_meta( get_the_ID(), '_price', true );
              if ( $raw_price !== '' && $raw_price !== null ) {
                if ( function_exists('wc_price') ) { $price_html = wc_price( (float) $raw_price ); }
                else { $price_html = '$' . number_format( (float) $raw_price, 2 ); }
              }
            }

            $seats_left = '';
            if ( function_exists('mep_count_total_available_seat') ) {
              $seats_left = mep_count_total_available_seat( get_the_ID() );
            } elseif ( metadata_exists( 'post', get_the_ID(), 'mep_total_seat_left' ) ) {
              $seats_left = get_post_meta( get_the_ID(), 'mep_total_seat_left', true );
            }

            // right column: price, seats, book button
            echo '<div class="right">';
            if ( $price_html || $seats_left !== '' ) {
              echo '<p class="workshop-meta">';
              if ( $price_html ) { echo '<span class="price">'. $price_html .'</span>'; }
              if ( $seats_left !== '' ) { echo ' <span class="seats">Seats left: '. esc_html( $seats_left ) .'</span>'; }
              echo '</p>';
            }
            echo '<p><a class="btn alt" href="'. esc_url( get_permalink() ) .'">'. esc_html__( 'Book', 'lovelily' ) .'</a></p>';
            echo '</div>'; // .right

            echo '</div></article>';
          endwhile; wp_reset_postdata();
        else:
          // If no event posts, fall back to regular posts in the 'workshop' category
          $wq = new WP_Query([ 'posts_per_page' => 6, 'post_status' => 'publish', 'ignore_sticky_posts' => true, 'category_name' => 'workshop' ]);
          if ( $wq->have_posts() ):
            while ( $wq->have_posts() ): $wq->the_post();
                // accessibility friendly card for standard posts in 'workshop' category
                $card_attrs = 'class="card" onclick="llbOpenLightbox(this)" role="button" tabindex="0" onkeydown="if(event.key===\'Enter\'||event.key===\' \'){ llbOpenLightbox(this); }"';
                echo '<article ' . $card_attrs . ' data-caption="'.esc_attr(get_the_title()).'">';
                if ( has_post_thumbnail() ) { $id = get_post_thumbnail_id(); llb_cyano_img( $id, get_the_title(), 'large' ); }
                else { echo '<div class="img-fallback">Set a Featured Image</div>'; }
                $__desc = get_the_excerpt(); if ( ! $__desc ) { $__desc = wp_trim_words( get_the_content(), 20 ); }
                echo '<div class="pad"><strong>'.esc_html(get_the_title()).'</strong>';
                if ( $__desc ) { echo '<p class="gallery-caption">'.esc_html($__desc).'</p>'; }

                // Try to show price/seats for legacy posts if they have event meta
                $price_html = '';
                if ( function_exists('mep_event_list_price') ) {
                  $price_html = mep_event_list_price( get_the_ID() );
                } else {
                  $raw_price = get_post_meta( get_the_ID(), '_price', true );
                  if ( $raw_price !== '' && $raw_price !== null ) {
                    if ( function_exists('wc_price') ) { $price_html = wc_price( (float) $raw_price ); }
                    else { $price_html = '$' . number_format( (float) $raw_price, 2 ); }
                  }
                }

                $seats_left = '';
                if ( function_exists('mep_count_total_available_seat') ) {
                  $seats_left = mep_count_total_available_seat( get_the_ID() );
                } elseif ( metadata_exists( 'post', get_the_ID(), 'mep_total_seat_left' ) ) {
                  $seats_left = get_post_meta( get_the_ID(), 'mep_total_seat_left', true );
                }

                if ( $price_html || $seats_left !== '' ) {
                  echo '<p class="workshop-meta">';
                  if ( $price_html ) { echo '<span class="price">'. $price_html .'</span>'; }
                  if ( $seats_left !== '' ) { echo ' <span class="seats">Seats left: '. esc_html( $seats_left ) .'</span>'; }
                  echo '</p>';
                }

                echo '<p><a class="btn alt" href="'. esc_url( get_permalink() ) .'">'. esc_html__( 'Book', 'lovelily' ) .'</a></p>';

                echo '</div></article>';
            endwhile; wp_reset_postdata();
          else:
            // Fallback to showing the Wreath Workshop details if no workshop posts exist
            echo '<article class="card"><div class="pad"><h3>Wreath Workshop</h3><p>Bring the warmth of the season into your home with a handmade holiday wreath! Using a mix of fresh evergreens, berries, and seasonal accents, you’ll craft a one-of-a-kind wreath that\'s uniquely yours.</p><p>I’ll guide you every step of the way — from shaping your base to arranging the finishing touches and tying a perfect bow — so you leave with a wreath that feels as timeless as it is beautiful. No experience is needed, just your creativity, holiday cheer, and a love of all things festive.</p><p><strong>Wreaths are built on a 14” base.</strong></p><p><em>Spots are limited.</em></p></div></article>';
          endif;
        endif;
      ?>
    </div>
  </div>
</section>

<section id="about" class="section paper">
    <div class="container split">
    <div>
      <h2>About</h2>
      <h3>Hi, I’m Amy — the hands and heart behind Lovelily Blooms.</h3>
      <p>I started Lovelily Blooms to bring a touch of nostalgia and natural beauty to everyday moments. Inspired by vintage flower markets, the charm of hand-tied posies, and the Victorian language of flowers, I wanted to create something that feels both whimsical and timeless.</p>
      <p>Whether you visit me at a pop-up, order a bouquet subscription, or join a floral workshop, my hope is to bring a bit of wonder to your world — one Lovelily bloom at a time.</p>
    </div>
    <figure class="cyanotype about-image">
      <?php
        // Prefer the 'About' page featured image if available
        $about_page = get_page_by_path( 'about' );
        if ( $about_page && has_post_thumbnail( $about_page->ID ) ) {
          $aid = get_post_thumbnail_id( $about_page->ID );
          llb_cyano_img( $aid, 'About image', 'large' );
        } elseif ( has_post_thumbnail() ) {
          // fallback to the front page featured image
          $fid = get_post_thumbnail_id();
          llb_cyano_img( $fid, get_the_title(), 'large' );
        } else {
          echo '<div class="img-fallback">Add an image or keep this texture</div>';
        }
      ?>
    </figure>
  </div>
</section>
<?php get_footer(); ?>
