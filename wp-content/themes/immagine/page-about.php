<?php
/**
 * Template Name: Salón & Spa
 */
?>
<?php $slug = sanitize_title(get_the_title()); ?>

<section class="Page Page--carousel" id="<?php echo $slug; ?>">
  <?php
    $args = [
      'post_type' => 'sliders',
      'posts_per_page' => -1,
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'tax_query' => [
        [
          'taxonomy' => 'regions',
          'field' => 'slug',
          'terms' => 'salon-spa'
        ]
      ]
    ];

    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) :
      $i = 0; $j = 0;
  ?>
  <div id="carousel-about" class="carousel slide Carousel Carousel--about" data-ride="carousel" data-interval="10000">
    <div class="carousel-inner" role="listbox">
      <?php while ($the_query->have_posts()) : ?>
        <?php $the_query->the_post(); ?>
        <div class="item<?php echo ($i === 0) ? ' active' : ''; ?>">
          <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('full', [
                'class' => 'img-responsive center-block img-circle',
                'alt' => get_the_title()
              ]);
            ?>
          <?php endif; ?>

          <div class="carousel-caption">
            <h2 class="text-center text-uppercase Caption Caption-title text-red"><?php the_title(); ?></h2>
            <?php if (has_excerpt()) : ?>
              <h3 class="Caption Caption-slogan text-center"><?php echo get_the_excerpt(); ?></h3>
            <?php endif; ?>

            <?php the_content(); ?>
          </div>
        </div>
        <?php $i++; ?>
      <?php endwhile; ?>
    </div>

    <?php if ($the_query->post_count > 1) : ?>
      <a class="left carousel-control" href="#carousel-about" role="button" data-slide="prev">
        <i class="icon-arrow_back"></i>
      </a>
      <a class="right carousel-control" href="#carousel-about" role="button" data-slide="next">
        <i class="icon-arrow_forward"></i>
      </a>
    <?php endif; ?>
  </div>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>
</section>
