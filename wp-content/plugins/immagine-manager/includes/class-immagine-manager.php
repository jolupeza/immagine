<?php

/**
 * The Immagine Manager is the core plugin responsible for including and
 * instantiating all of the code that composes the plugin.
 */

/**
 * The Immagine Manager is the core plugin responsible for including and
 * instantiating all of the code that composes the plugin.
 *
 * The Immagine Manager includes an instance to the Immagine Manager
 * Loader which is responsible for coordinating the hooks that exist within the
 * plugin.
 *
 * It also maintains a reference to the plugin slug which can be used in
 * internationalization, and a reference to the current version of the plugin
 * so that we can easily update the version in a single place to provide
 * cache busting functionality when including scripts and styles.
 *
 * @since    1.0.0
 */
class Immagine_Manager
{
    /**
     * A reference to the loader class that coordinates the hooks and callbacks
     * throughout the plugin.
     *
     * @var Immagine_Manager_Loader Manages hooks between the WordPress hooks and the callback functions.
     */
    protected $loader;

    /**
     * Represents the slug of hte plugin that can be used throughout the plugin
     * for internationalization and other purposes.
     *
     * @var string The single, hyphenated string used to identify this plugin.
     */
    protected $plugin_slug;

    /**
     * Maintains the current version of the plugin so that we can use it throughout
     * the plugin.
     *
     * @var string The current version of the plugin.
     */
    protected $version;

    /**
     * Instantiates the plugin by setting up the core properties and loading
     * all necessary dependencies and defining the hooks.
     *
     * The constructor will define both the plugin slug and the verison
     * attributes, but will also use internal functions to import all the
     * plugin dependencies, and will leverage the Single_Post_Meta_Loader for
     * registering the hooks and the callback functions used throughout the
     * plugin.
     */
    public function __construct()
    {
        $this->plugin_slug = 'immagine-manager-slug';
        $this->version = '1.0.0';

        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Imports the Immagine Post Meta administration classes, and the Immagine Post Meta Loader.
     *
     * The Immagine Manager administration class defines all unique functionality for
     * introducing custom functionality into the WordPress dashboard.
     *
     * The Immagine Manager Manager Loader is the class that will coordinate the hooks and callbacks
     * from WordPress and the plugin. This function instantiates and sets the reference to the
     * $loader class property.
     */
    private function load_dependencies()
    {
        require_once plugin_dir_path(dirname(__FILE__)).'admin/class-immagine-manager-admin.php';
        require_once plugin_dir_path(dirname(__FILE__)).'public/class-immagine-manager-public.php';

        require_once plugin_dir_path(__FILE__).'class-immagine-manager-loader.php';
        $this->loader = new Immagine_Manager_Loader();
    }

    /**
     * Defines the hooks and callback functions that are used for setting up the plugin stylesheets
     * and the plugin's meta box.
     *
     * This function relies on the Immagine Post Meta Manager Admin class and the Immagine Manager
     * Loader class property.
     */
    private function define_admin_hooks()
    {
        $admin = new Immagine_Manager_Admin($this->get_version());
        
        $this->loader->add_action('init', $admin, 'add_post_type');
//        $this->loader->add_action('init', $admin, 'unregister_post_type');
        
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $admin, 'enqueue_scripts');
        
        $this->loader->add_action('add_meta_boxes', $admin, 'cd_mb_sliders_add');
        $this->loader->add_action('save_post', $admin, 'cd_mb_sliders_save' );
        
        $this->loader->add_action('init', $admin, 'add_taxonomies_services');
    }

    /**
     * Defines the hooks and callback functions that are used for rendering information on the front
     * end of the site.
     *
     * This function relies on the Immagine Manager Public class and the Immagine Manager
     * Loader class property.
     */
    private function define_public_hooks()
    {
        $public = new Immagine_Manager_Public($this->get_version());
        //$this->loader->add_action( 'the_content', $public, 'display_post_meta_data' );
    }

    /**
     * Sets this class into motion.
     *
     * Executes the plugin by calling the run method of the loader class which will
     * register all of the hooks and callback functions used throughout the plugin
     * with WordPress.
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * Returns the current version of the plugin to the caller.
     *
     * @return string $this->version    The current version of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}
