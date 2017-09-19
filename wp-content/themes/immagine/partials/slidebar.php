<?php $options = get_option('immagine_custom_settings'); ?>

<section class="Slidebar">
  <header class="Slidebar-header">
    <?php
      $logoWhite = isset($options['logo_white']) ? $options['logo_white'] : '';
    ?>
    <?php if (!empty($logoWhite)) : ?>
      <h1 class="Slidebar-logo">
        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
          <img src="<?php echo $logoWhite; ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" class="img-responsive" />
        </a>
      </h1>
    <?php endif; ?>
    <aside class="Slidebar-close js-toggle-slidebar">
      <i class="icon-close"></i>
    </aside>
  </header>

  <?php
    $args = [
      'theme_location' => 'movil-menu',
      'container' => 'nav',
      'container_class' => 'Slidebar-nav navbar-mainmenu',
      'menu_class' => 'Slidebar-nav-list nav',
      'walker' => new Immagine_Walker_Nav_menu(),
    ];

    wp_nav_menu($args);
  ?>

  <?php if ($options['display_top_menu'] && !is_null($options['display_top_menu'])) : ?>
    <aside class="Slidebar-social">
      <?php if (!empty($options['phone'])) : ?>
        <h3 class="h4 text-white text-center text-uppercase">Central Telefónica: <span><?php echo $options['phone']; ?></span></h3>
      <?php endif; ?>
      <?php if ($options['display_social_link'] && !is_null($options['display_social_link'])) : ?>
        <nav class="Slidebar-social-nav text-right">
          <ul class="Slidebar-social-nav-list">
            <?php if (!empty($options['facebook'])) : ?>
              <li>
                <a href="https://www.facebook.com/<?php echo $options['facebook']; ?>" target="_blank" rel="noopener noreferrer" title="Ir a Facebook">
                  <i class="icon-facebook"></i>
                </a>
              </li>
            <?php endif; ?>
            <?php if (!empty($options['twitter'])) : ?>
              <li>
                <a href="https://twitter.com/<?php echo $options['twitter']; ?>" target="_blank" rel="noopener noreferrer" title="Ir a Twitter">
                  <i class="icon-twitter"></i>
                </a>
              </li>
            <?php endif; ?>
            <?php if (!empty($options['googleplus'])) : ?>
              <li>
                <a href="<?php echo $options['googleplus']; ?>" target="_blank" rel="noopener noreferrer" title="Ir a Google+">
                  <i class="icon-google-plus"></i>
                </a>
              </li>
            <?php endif; ?>
            <?php if (!empty($options['linkedin'])) : ?>
              <li>
                <a href="<?php echo $options['linkedin']; ?>" target="_blank" rel="noopener noreferrer" title="Ir a Linkedin">
                  <i class="icon-linkedin"></i>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
      <?php endif; ?>
    </aside>
  <?php endif; ?>
  <aside class="Slidebar-button text-center">
    <a href="#haz-tu-reserva" class="Button Button--white Button--medium text-uppercase js-move-scroll">Haz tu reserva</a>
  </aside>
</section>
