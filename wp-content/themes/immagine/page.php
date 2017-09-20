<?php get_header(); ?>

<section class="Page Page--default">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <h2 class="text-center Page-title"><?php the_title(); ?></h2>

            <?php the_content(); ?>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
