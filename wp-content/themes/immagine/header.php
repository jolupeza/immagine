<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('|', true, 'right') ?><?php bloginfo('name'); ?></title>
    <meta name="description" content="<?php bloginfo('description'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
      <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>

    <!-- Script required for extra functionality on the comment form -->
    <?php if (is_singular()) wp_enqueue_script( 'comment-reply' ); ?>

    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> data-spy="scroll" data-target=".navbar-mainmenu">
    <header class="Header">
      <?php $options = get_option('immagine_custom_settings'); ?>

      <?php if ($options['display_top_menu'] && !is_null($options['display_top_menu'])) : ?>
        <aside class="Header-top hidden-xs hidden-sm">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <?php if (!empty($options['phone'])) : ?>
                  <h3 class="h5 text-white text-uppercase">Central Telefónica: <?php echo $options['phone']; ?></h3>
                <?php endif; ?>
              </div>
              <div class="col-sm-6">
                <?php if ($options['display_social_link'] && !is_null($options['display_social_link'])) : ?>
                  <nav class="Header-social text-right">
                    <ul class="Header-social-list">
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
              </div>
            </div>
          </div>
        </aside>
      <?php endif; ?>

      <div class="Header-menu">
        <?php
          $customLogoId = get_theme_mod('custom_logo');
          $logo = wp_get_attachment_image_src($customLogoId, 'full');
          $logoResponsive = isset($options['logo']) ? $options['logo'] : '';
        ?>
        <div class="container">
          <section class="Header-main">
            <aside class="Header-toggle hidden-md hidden-lg js-toggle-slidebar">
              <i class="Icons Icons--bars"></i>
            </aside>
            <h1 class="Header-logo">
              <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                <picture>
                  <source class="img-responsive center-block" media="(max-width: 991px)" srcset="<?php echo $logoResponsive; ?>" />
                  <img src="<?php echo $logo[0]; ?>" alt="<?php bloginfo('name'); ?> | <?php bloginfo('description'); ?>" class="img-responsive center-block" />
                </picture>
              </a>
            </h1>

            <?php
              $args = [
                'theme_location' => 'main-menu',
                'container' => 'nav',
                'container_class' => 'Header-nav hidden-xs hidden-sm navbar-mainmenu',
                'menu_class' => 'Header-nav-list nav',
                'walker' => new Immagine_Walker_Nav_menu(),
              ];

              wp_nav_menu($args);
            ?>
            <aside class="Header-button text-center hidden-md hidden-lg">
              <a href="#haz-tu-reserva" class="Button Button--white Button--medium Button--border text-uppercase js-move-scroll">Haz tu reserva</a>
            </aside>
          </section>
        </div>
      </div>
    </header>

    <?php
      if (file_exists(TEMPLATEPATH . '/partials/slidebar.php')) {
        include TEMPLATEPATH . '/partials/slidebar.php';
      }
    ?>
