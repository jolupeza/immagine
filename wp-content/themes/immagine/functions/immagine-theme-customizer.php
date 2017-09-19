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

  $wp_customize->add_setting('immagine_custom_settings[logo_white]', array(
    'type' => 'option'
  ));

  $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_white', array(
    'label' => __('Logo Blanco', THEMEDOMAIN),
    'section' => 'immagine_image',
    'settings' => 'immagine_custom_settings[logo_white]'
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
}
