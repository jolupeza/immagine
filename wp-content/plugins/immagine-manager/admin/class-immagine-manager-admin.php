<?php

/**
 * The Immagine Manager Admin defines all functionality for the dashboard
 * of the plugin.
 */

/**
 * The Immagine Manager Admin defines all functionality for the dashboard
 * of the plugin.
 *
 * This class defines the meta box used to display the post meta data and registers
 * the style sheet responsible for styling the content of the meta box.
 *
 * @since    1.0.0
 */
class Immagine_Manager_Admin
{
    /**
     * A reference to the version of the plugin that is passed to this class from the caller.
     *
     * @var string The current version of the plugin.
     */
    private $version;

    /**
     * Labels indicate allowed in custom fields.
     *
     * @var array
     */
    private $allowed;

    private $domain;

    /**
     * Initializes this class and stores the current version of this plugin.
     *
     * @param string $version The current version of this plugin.
     */
    public function __construct($version)
    {
        $this->version = $version;
        $this->allowed = array(
            'h2' => array(
              'style' => array(),
            ),
            'h4' => array(
              'style' => array(),
            ),
            'h5' => array(
              'style' => array(),
            ),
            'p' => array(
              'style' => array(),
            ),
            'a' => array(// on allow a tags
                'href' => array(),
                'target' => array(),
            ),
            'ul' => array(
                'class' => array(),
            ),
            'ol' => array(),
            'li' => array(
                'style' => array(),
            ),
            'strong' => array(),
            'br' => array(),
            'span' => array(),
        );

        $this->domain = 'immagine-framework';
//        add_action('wp_ajax_generate_pdf', array(&$this, 'generate_pdf'));
//        add_action('wp_ajax_download_cv', array(&$this, 'download_cv'));
    }

    /**
     * Enqueues the style sheet responsible for styling the contents of this
     * meta box.
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            'immagine-manager-admin',
            plugin_dir_url(__FILE__).'css/immagine-manager-admin.css',
            array(),
            $this->version,
            false
        );
        
//        wp_enqueue_style('cbb-animate-admin', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css', array(), '3.5.2', false);
    }

    /**
     * Enqueues the scripts responsible for functionality.
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'immagine-manager-admin',
            plugin_dir_url(__FILE__).'js/immagine-manager-admin.js',
            array('jquery'),
            $this->version,
            true
        );
    }

    /**
     * Registers the meta box that will be used to display all of the post meta data
     * associated with post type sliders.
     */
    public function cd_mb_sliders_add()
    {
        add_meta_box(
            'mb-sliders-id', 'Configuraciones', array($this, 'render_mb_sliders'), 'sliders', 'normal', 'core'
        );
    }

    public function cd_mb_sliders_save($post_id)
    {
        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'sliders_meta_box_nonce')) {
            return;
        }

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        
        // Title
        if (isset($_POST['mb_title']) && !empty($_POST['mb_title'])) {
            update_post_meta($post_id, 'mb_title', esc_attr($_POST['mb_title']));
        } else {
            delete_post_meta($post_id, 'mb_title');
        }

        // Image Responsive
        if (isset($_POST['mb_responsive']) && !empty($_POST['mb_responsive'])) {
            update_post_meta($post_id, 'mb_responsive', esc_attr($_POST['mb_responsive']));
        } else {
            delete_post_meta($post_id, 'mb_responsive');
        }
    }

    /**
     * Requires the file that is used to display the user interface of the post meta box.
     */
    public function render_mb_sliders()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/immagine-mb-sliders.php';
    }

    /**
     * Add custom content type slides.
     */
    public function add_post_type()
    {
        $labels = array(
            'name'               => __('Sliders', $this->domain),
            'singular_name'      => __('Slider', $this->domain),
            'add_new'            => __('Nuevo slider', $this->domain),
            'add_new_item'       => __('Agregar nuevo slider', $this->domain),
            'edit_item'          => __('Editar slider', $this->domain),
            'new_item'           => __('Nuevo slider', $this->domain),
            'view_item'          => __('Ver slider', $this->domain),
            'search_items'       => __('Buscar slider', $this->domain),
            'not_found'          => __('Slider no encontrado', $this->domain),
            'not_found_in_trash' => __('Slider no encontrado en la papelera', $this->domain),
            'all_items'          => __('Todos los sliders', $this->domain),
//            'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
//            'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'. 
//            'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
//            'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
//            'featured_image' - Default is Featured Image.
//            'set_featured_image' - Default is Set featured image.
//            'remove_featured_image' - Default is Remove featured image.
//            'use_featured_image' - Default is Use as featured image.
//            'menu_name' - Default is the same as `name`.
//            'filter_items_list' - String for the table views hidden heading.
//            'items_list_navigation' - String for the table pagination hidden heading.
//            'items_list' - String for the table hidden heading.
//            'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`. 
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Todos los Sliders',
            // 'public'              => false,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            // 'menu_position'          => null,
            'menu_icon' => 'dashicons-images-alt2',
            // 'hierarchical'        => false,
            'supports' => array(
                'title',
                'editor',
//                'custom-fields',
                'author',
                'thumbnail',
                'page-attributes',
                // 'excerpt'
                // 'trackbacks'
                // 'comments',
                // 'revisions',
                // 'post-formats'
            ),
            // 'taxonomies'  => array('post_tag', 'category'),
            // 'has_archive' => false,
             'rewrite'     => false
        );
        register_post_type('sliders', $args);
        
        $labels = array(
            'name'               => __('Servicios', $this->domain),
            'singular_name'      => __('Servicio', $this->domain),
            'add_new'            => __('Nuevo servicio', $this->domain),
            'add_new_item'       => __('Agregar nuevo servicio', $this->domain),
            'edit_item'          => __('Editar servicio', $this->domain),
            'new_item'           => __('Nuevo servicio', $this->domain),
            'view_item'          => __('Ver servicio', $this->domain),
            'search_items'       => __('Buscar servicio', $this->domain),
            'not_found'          => __('Servicio no encontrado', $this->domain),
            'not_found_in_trash' => __('Servicio no encontrado en la papelera', $this->domain),
            'all_items'          => __('Todos los servicios', $this->domain),
//            'archives' - String for use with archives in nav menus. Default is Post Archives/Page Archives.
//            'attributes' - Label for the attributes meta box. Default is 'Post Attributes' / 'Page Attributes'. 
//            'insert_into_item' - String for the media frame button. Default is Insert into post/Insert into page.
//            'uploaded_to_this_item' - String for the media frame filter. Default is Uploaded to this post/Uploaded to this page.
//            'featured_image' - Default is Featured Image.
//            'set_featured_image' - Default is Set featured image.
//            'remove_featured_image' - Default is Remove featured image.
//            'use_featured_image' - Default is Use as featured image.
//            'menu_name' - Default is the same as `name`.
//            'filter_items_list' - String for the table views hidden heading.
//            'items_list_navigation' - String for the table pagination hidden heading.
//            'items_list' - String for the table hidden heading.
//            'name_admin_bar' - String for use in New in Admin menu bar. Default is the same as `singular_name`. 
        );
        $args = array(
            'labels' => $labels,
            'description' => 'Todos los Servicios',
            // 'public'              => false,
            // 'exclude_from_search' => true,
            // 'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_nav_menus' => false,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            // 'menu_position'          => null,
            'menu_icon' => 'dashicons-awards',
            // 'hierarchical'        => false,
            'supports' => array(
                'title',
                'editor',
//                'custom-fields',
                'author',
                'thumbnail',
                'page-attributes',
                // 'excerpt'
                // 'trackbacks'
                // 'comments',
                // 'revisions',
                // 'post-formats'
            ),
            // 'taxonomies'  => array('post_tag', 'category'),
            // 'has_archive' => false,
             'rewrite'     => false
        );
        register_post_type('services', $args);
        
//        flush_rewrite_rules();
    }

    public function unregister_post_type()
    {
        global $wp_post_types;
        
        dump_exit($wp_post_types);

        if (isset($wp_post_types[ 'testimonials' ])) {
            unset($wp_post_types[ 'testimonials' ]);

            return true;
        }

        return false;
    }
    
    /**
     * Add custom taxonomies areas to post type services.
     */
    public function add_taxonomies_services()
    {
        $labels = array(
            'name' => _x('Categoría', 'Taxonomy plural name', $this->domain),
            'singular_name' => _x('Categoría', 'Taxonomy singular name', $this->domain),
            'search_items' => __('Buscar Categoría', $this->domain),
            'popular_items' => __('Categorías Populares', $this->domain),
            'all_items' => __('Todas las Categorías', $this->domain),
            'parent_item' => __('Categoría Padre', $this->domain),
            'parent_item_colon' => __('Categoría Padre', $this->domain),
            'edit_item' => __('Editar Categoría', $this->domain),
            'update_item' => __('Actualizar Categoría', $this->domain),
            'add_new_item' => __('Añadir nueva Categoría', $this->domain),
            'new_item_name' => __('Nueva Categoría', $this->domain),
            'add_or_remove_items' => __('Añadir o eliminar Categoría', $this->domain),
            'choose_from_most_used' => __('Choose from most used text-domain', $this->domain),
            'menu_name' => __('Categorías de Servicios', $this->domain),
        );

        $args = array(
            'labels' => $labels,
            'public' => false,
            'show_in_nav_menus' => false,
            'show_in_menu' => true,
            'show_admin_column' => true,
            'hierarchical' => true,
            'show_tagcloud' => false,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => false,
//            'capabilities' => array(),
        );

        register_taxonomy('categories_services', 'services', $args);
    }
}
