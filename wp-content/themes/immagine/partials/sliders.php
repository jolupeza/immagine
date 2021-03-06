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
        'terms' => 'main'
      ]
    ]
  ];

  $the_query = new WP_Query($args);
  if ($the_query->have_posts()) :
    $i = 0; $j = 0;
?>
  <div id="inicio" class="carousel slide Carousel Carousel--home" data-ride="carousel">
    <?php if ($the_query->post_count > 1) : ?>
      <ol class="carousel-indicators">
        <?php while ($the_query->have_posts()) : ?>
          <?php $the_query->the_post(); ?>
          <li data-target="#inicio" data-slide-to="<?php echo $i; ?>"<?php echo ($i === 0) ? ' class="active"' : ''; ?>></li>
          <?php $i++; ?>
        <?php endwhile; ?>
      </ol>
    <?php endif; ?>

    <div class="carousel-inner" role="listbox">
      <?php while ($the_query->have_posts()) : ?>
        <?php $the_query->the_post(); ?>
        <?php
          $values = get_post_custom(get_the_id());
          $title = isset($values['mb_title']) ? esc_attr($values['mb_title'][0]) : '';
          $service = isset($values['mb_service']) ? esc_attr($values['mb_service'][0]) : '';
          $responsive = isset($values['mb_responsive']) ? esc_attr($values['mb_responsive'][0]) : '';
        ?>

        <?php if (has_post_thumbnail()) : ?>
          <div class="item<?php echo ($j === 0) ? ' active' : ''; ?>">
            <picture>
              <?php if (!empty($responsive)) : ?>
                <source class="img-responsive center-block" media="(max-width: 767px) and (orientation: portrait)" srcset="<?php echo $responsive; ?>" />
              <?php endif; ?>
              <?php
                the_post_thumbnail('full', [
                  'class' => 'img-responsive center-block',
                  'alt' => !empty($title) ? $title : ''
                ]);
              ?>
            </picture>

            <div class="carousel-caption">
              <h3 class="Caption Caption-slogan text-center"><span class="Caption-background"><?php echo get_the_content(''); ?></span></h3>
              <?php if (!empty($title)) : ?><h2 class="text-center Caption Caption-title"><?php echo $title; ?></h2><?php endif; ?>

              <aside class="Caption-buttons">
                <?php if (!empty($service)) : ?>
                  <?php $dataService = get_post($service); ?>
                  <a href="#<?php echo $dataService->post_name; ?>" class="Button Button--red text-uppercase js-move-scroll">Ver servicios</a>
                <?php endif; ?>
                <a href="#haz-tu-reserva" class="Button Button--red text-uppercase js-move-scroll">Haz tu reserva</a>
              </aside>
            </div>
          </div>
        <?php endif; ?>
        <?php $j++; ?>
      <?php endwhile; ?>
    </div>

    <?php if ($the_query->post_count > 1) : ?>
      <a class="left carousel-control" href="#inicio" role="button" data-slide="prev">
        <i class="icon-keyboard_arrow_left"></i>
      </a>
      <a class="right carousel-control" href="#inicio" role="button" data-slide="next">
        <i class="icon-keyboard_arrow_right"></i>
      </a>
    <?php endif; ?>
  </div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
