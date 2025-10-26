<?php
/* Template Name: Classes */
get_header();
the_post();
?>
<section class="section">
  <div class="container">
    <h1><?php the_title(); ?></h1>
    <div class="entry">
      <?php if (shortcode_exists('events_list')) {
        echo do_shortcode('[events_list limit=12 pagination=1 show_recurrence_once=1]');
      } else { the_content(); } ?>
    </div>
  </div>
</section>
<?php get_footer(); ?>
