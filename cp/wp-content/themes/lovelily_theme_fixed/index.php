<?php get_header(); ?>
<section class="section">
  <div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article <?php post_class('card'); ?> style="padding:16px">
        <h1><?php the_title(); ?></h1>
        <?php if ( has_post_thumbnail() ) : ?>
          <figure class="cyanotype"><?php the_post_thumbnail('large', ['loading' => 'lazy']); ?></figure>
        <?php endif; ?>
        <div class="entry"><?php the_content(); ?></div>
      </article>
    <?php endwhile; else: ?>
      <p>No content found. Create a page and set it as Front Page in Settings → Reading.</p>
    <?php endif; ?>
  </div>
</section>
<?php get_footer(); ?>
