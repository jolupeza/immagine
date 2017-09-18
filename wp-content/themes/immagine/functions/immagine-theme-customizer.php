<?php
/***********************************************************************************************/
/* Add a menu option to link to the customizer */
/***********************************************************************************************/
add_action('admin_menu', 'display_custom_options_link');

function display_custom_options_link() {
    add_theme_page('Theme Immagine Options', 'Theme Immagine Options', 'edit_theme_options', 'customize.php');
}

/***********************************************************************************************/
/* Add a menu option to link to the customizer */
/***********************************************************************************************/
add_action('customize_register', 'immagine_customize_register');

function immagine_customize_register($wp_customize) {
  //
  $wp_customize->add_section('immagine_image', [
    'title' => __('Imagen del sitio', THEMEDOMAIN),
    'description' => __('Configurar y cargar logo responsive', THEMEDOMAIN),
    'priority' => 35
  ]);

  $wp_customize->add_setting('immagine_custom_settings[logo]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
    'label' => __('Logo Móvil', THEMEDOMAIN),
    'section' => 'immagine_image',
    'settings' => 'immagine_custom_settings[logo]'
  )));

  // Links Social Media
  $wp_customize->add_section('immagine_social', [
    'title' => __('Links Redes Sociales', THEMEDOMAIN),
    'description' => __('Mostrar links a redes sociales', THEMEDOMAIN),
    'priority' => 36
  ]);

  $wp_customize->add_setting('immagine_custom_settings[display_social_link]', [
    'default' => 0,
    'type' => 'option'
  ]);

  $wp_customize->add_control('immagine_custom_settings[display_social_link]', [
    'label' => __('¿Mostrar links?', THEMEDOMAIN),
    'section' => 'immagine_social',
    'settings' => 'immagine_custom_settings[display_social_link]',
    'type' => 'checkbox'
  ]);

  // Facebook
  $wp_customize->add_setting('immagine_custom_settings[facebook]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('immagine_custom_settings[facebook]', [
    'label' => __('Facebook', THEMEDOMAIN),
    'section' => 'immagine_social',
    'settings' => 'immagine_custom_settings[facebook]',
    'type' => 'text'
  ]);

  // Twitter
  $wp_customize->add_setting('immagine_custom_settings[twitter]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('immagine_custom_settings[twitter]', [
    'label' => __('Twitter', THEMEDOMAIN),
    'section' => 'immagine_social',
    'settings' => 'immagine_custom_settings[twitter]',
    'type' => 'text'
  ]);

  // Google +
  $wp_customize->add_setting('immagine_custom_settings[googleplus]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('immagine_custom_settings[googleplus]', [
    'label' => __('Whatsapp', THEMEDOMAIN),
    'section' => 'immagine_social',
    'settings' => 'immagine_custom_settings[googleplus]',
    'type' => 'text'
  ]);

  // Linkedin
  $wp_customize->add_setting('immagine_custom_settings[linkedin]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('immagine_custom_settings[linkedin]', [
    'label' => __('Linkedin', THEMEDOMAIN),
    'section' => 'immagine_social',
    'settings' => 'immagine_custom_settings[linkedin]',
    'type' => 'text'
  ]);

  // Information
  $wp_customize->add_section('immagine_info', [
    'title' => __('Información de la Web', THEMEDOMAIN),
    'description' => __('Configuración acerca de información relevante de la Web', THEMEDOMAIN),
    'priority' => 37
  ]);

  $wp_customize->add_setting('immagine_custom_settings[display_top_menu]', [
    'default' => 0,
    'type' => 'option'
  ]);

  $wp_customize->add_control('immagine_custom_settings[display_top_menu]', [
    'label' => __('¿Mostrar Menú Superior?', THEMEDOMAIN),
    'section' => 'immagine_info',
    'settings' => 'immagine_custom_settings[display_top_menu]',
    'type' => 'checkbox'
  ]);

  // Email Contact
  $wp_customize->add_setting('immagine_custom_settings[email]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('immagine_custom_settings[email]', [
    'label' => __('Email de contacto', THEMEDOMAIN),
    'section' => 'immagine_info',
    'settings' => 'immagine_custom_settings[email]',
    'type' => 'text'
  ]);

  // Teléfono
  $wp_customize->add_setting('immagine_custom_settings[phone]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('immagine_custom_settings[phone]', [
    'label' => __('Central Telefónica', THEMEDOMAIN),
    'section' => 'immagine_info',
    'settings' => 'immagine_custom_settings[phone]',
    'type' => 'text'
  ]);

  /*
  // Homepage
  $wp_customize->add_section('cbb_home', [
    'title' => __('Página de Inicio', THEMEDOMAIN),
    'description' => __('Configuración página de Inicio', THEMEDOMAIN),
    'priority' => 37
  ]);

  $wp_customize->add_setting('cbb_custom_settings[home_video_img]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'home_video_img', array(
    'label' => __('Poster Video', THEMEDOMAIN),
    'section' => 'cbb_home',
    'settings' => 'cbb_custom_settings[home_video_img]'
  )));

  $wp_customize->add_setting('cbb_custom_settings[home_video_webm]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'home_video_webm', array(
    'label' => __('Formato Webm', THEMEDOMAIN),
    'section' => 'cbb_home',
    'settings' => 'cbb_custom_settings[home_video_webm]'
  )));

  $wp_customize->add_setting('cbb_custom_settings[home_video_mp4]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'home_video_mp4', array(
    'label' => __('Formato Mp4', THEMEDOMAIN),
    'section' => 'cbb_home',
    'settings' => 'cbb_custom_settings[home_video_mp4]'
  )));

  $wp_customize->add_setting('cbb_custom_settings[home_video_ogv]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'home_video_ogv', array(
    'label' => __('Formato Ogv', THEMEDOMAIN),
    'section' => 'cbb_home',
    'settings' => 'cbb_custom_settings[home_video_ogv]'
  )));

  // Infraestructura
  $wp_customize->add_section('cbb_locals', [
    'title' => __('Infraestructura', THEMEDOMAIN),
    'description' => __('Configuración página Infraestructura', THEMEDOMAIN),
    'priority' => 38
  ]);

  $sections = get_terms('sections');
  $sects = [];
  $i = 0;

  foreach ($sections as $section) {
    if ($i === 0) {
      $default = $section->term_id;
      $i++;
    }

    $sects[$section->term_id] = $section->name;
  }

  $wp_customize->add_setting('cbb_custom_settings[slider]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('cbb_custom_settings[slider]', array(
    'label'      => __('Sliders', THEMEDOMAIN),
    'section'    => 'cbb_locals',
    'settings'   => 'cbb_custom_settings[slider]',
    'type'       => 'select',
    'choices'    => $sects,
  ));

  $wp_customize->add_setting('cbb_custom_settings[infraestructura_video_img]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'infraestructura_video_img', array(
    'label' => __('Poster Video', THEMEDOMAIN),
    'section' => 'cbb_locals',
    'settings' => 'cbb_custom_settings[infraestructura_video_img]'
  )));

  $wp_customize->add_setting('cbb_custom_settings[infraestructura_video_webm]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'infraestructura_video_webm', array(
    'label' => __('Formato Webm', THEMEDOMAIN),
    'section' => 'cbb_locals',
    'settings' => 'cbb_custom_settings[infraestructura_video_webm]'
  )));

  $wp_customize->add_setting('cbb_custom_settings[infraestructura_video_mp4]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'infraestructura_video_mp4', array(
    'label' => __('Formato Mp4', THEMEDOMAIN),
    'section' => 'cbb_locals',
    'settings' => 'cbb_custom_settings[infraestructura_video_mp4]'
  )));

  $wp_customize->add_setting('cbb_custom_settings[infraestructura_video_ogv]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'infraestructura_video_ogv', array(
    'label' => __('Formato Ogv', THEMEDOMAIN),
    'section' => 'cbb_locals',
    'settings' => 'cbb_custom_settings[infraestructura_video_ogv]'
  )));

  // Id Youtube
  $wp_customize->add_setting('cbb_custom_settings[infraestructura_youtube]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('cbb_custom_settings[infraestructura_youtube]', [
    'label' => __('Id video Youtube', THEMEDOMAIN),
    'section' => 'cbb_locals',
    'settings' => 'cbb_custom_settings[infraestructura_youtube]',
    'type' => 'text'
  ]);

  // Description
  $wp_customize->add_setting('cbb_custom_settings[infraestructura_desc]', [
    'default' => '',
    'type' => 'option'
  ]);

  $wp_customize->add_control('cbb_custom_settings[infraestructura_desc]', [
    'label' => __('Descripción', THEMEDOMAIN),
    'section' => 'cbb_locals',
    'settings' => 'cbb_custom_settings[infraestructura_desc]',
    'type' => 'textarea'
  ]);
  */
}
