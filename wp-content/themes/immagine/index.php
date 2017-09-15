<?php get_header(); ?>

<?php
  if (file_exists(TEMPLATEPATH. '/partials/sliders.php')) {
    include TEMPLATEPATH . '/partials/sliders.php';
  }
?>

<?php
  $args = [
    'post_type' => 'page',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'posts_per_page' => -1
  ];

  $mainQuery = new WP_Query($args);

  if ($mainQuery->have_posts()) {
    while ($mainQuery->have_posts()) {
      $mainQuery->the_post();

      $template = get_post_meta(get_the_id(), '_wp_page_template', true);

      if (file_exists(TEMPLATEPATH . '/' . $template)) {
        include TEMPLATEPATH . '/' .$template;
      }
    }
  }
?>

<?php get_footer(); ?>
