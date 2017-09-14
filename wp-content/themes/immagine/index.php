<?php get_header(); ?>

<?php
  if (file_exists(TEMPLATEPATH. '/partials/sliders.php')) {
    include TEMPLATEPATH . '/partials/sliders.php';
  }
?>

<section class="Page Page--carousel">
  <div id="carousel-about" class="carousel slide Carousel Carousel--about" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img class="img-responsive center-block img-circle" src="<?php echo IMAGES; ?>/slide-salonspan-01.jpg" alt="Slide home 01">
        <div class="carousel-caption">
          <h2 class="text-center text-uppercase Caption Caption-title text-red">Immagine Salón & Spa</h2>
          <h3 class="Caption Caption-slogan text-center">el nacimiento de un ideal</h3>

          <p>Ese espacio en el que un par de chicas buscaban sentirse tratadas como realeza y salir totalmente satisfechas con su imagen. Esta idea luego se volvió un sueño y pronto pasó a ser un proyecto. Fueron muchas horas, mucho esfuerzo, muchas ganas puestas en lo que ahora llamamos nuestra empresa. Nuestros inicios aún se están plasmando, así que hay mucho por hacer, y lo haremos con la colaboración de todos los que conformamos esta empresa.</p>
        </div>
      </div>

      <div class="item">
        <img class="img-responsive center-block img-circle" src="<?php echo IMAGES; ?>/slide-salonspan-01.jpg" alt="Slide home 01">
        <div class="carousel-caption">
          <h2 class="text-center text-uppercase Caption Caption-title text-red">Immagine Salón & Spa</h2>
          <h3 class="Caption Caption-slogan text-center">el nacimiento de un ideal</h3>

          <p>Ese espacio en el que un par de chicas buscaban sentirse tratadas como realeza y salir totalmente satisfechas con su imagen. Esta idea luego se volvió un sueño y pronto pasó a ser un proyecto. Fueron muchas horas, mucho esfuerzo, muchas ganas puestas en lo que ahora llamamos nuestra empresa. Nuestros inicios aún se están plasmando, así que hay mucho por hacer, y lo haremos con la colaboración de todos los que conformamos esta empresa.</p>
        </div>
      </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-about" role="button" data-slide="prev">
      <i class="icon-arrow_back"></i>
    </a>
    <a class="right carousel-control" href="#carousel-about" role="button" data-slide="next">
      <i class="icon-arrow_forward"></i>
    </a>
  </div>
</section>

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
