<?php
/**
 * Template Name: Servicios
 */
?>
<?php $category = sanitize_title(get_the_title()); ?>

<section class="Page Page--service" id="<?php echo $category; ?>">
  <?php if (has_post_thumbnail()) : ?>
    <figure class="Page-figure">
      <?php the_post_thumbnail('full', [
          'class' => 'img-responsive center-block',
          'alt' => get_the_title()
        ]);
      ?>
    </figure>
  <?php endif; ?>

  <?php
    $args = [
      'post_type' => 'services',
      'orderby' => 'menu_order',
      'order' => 'ASC',
      'posts_per_page' => -1,
      'tax_query' => [
        [
          'taxonomy' => 'categories_services',
          'field' => 'slug',
          'terms' => $category
        ]
      ]
    ];

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) :
  ?>
    <div class="container">
      <section class="Services-wrapper">
        <ul class="bxslider Services">
          <?php while ($the_query->have_posts()) : ?>
            <?php $the_query->the_post(); ?>
            <li class="Services-item">
              <?php if (has_post_thumbnail()) : ?>
                <figure class="Services-figure">
                  <?php the_post_thumbnail('full', [
                      'class' => 'img-responsive center-block',
                      'alt' => get_the_title()
                    ]);
                  ?>
                </figure>
              <?php endif; ?>
              <article class="Services-data">
                <h3 class="Services-title text-red text-uppercase"><?php the_title(); ?></h3>
                <?php the_content(); ?>
                <p><a href="" class="Button Button--red Button--red--invert text-uppercase">Consultar</a></p>
              </article>
            </li>
          <?php endwhile; ?>
        </ul>
      </section>
    </div>
  <?php endif; ?>
  <?php wp_reset_postdata(); ?>
</section>
