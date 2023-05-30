<?php

namespace ObsidianLab;

use ObsidianLab\ObsidianFunctions;

class Plugin
{

    /**
     * Experiments manager.
     *
     * Holds the plugin experiments manager.
     *
     * @since 3.1.0
     * @access public
     *
     * @var obsidianfunctions
     */
    public $obsidianfunctions;

    /**
     * Instance.
     *
     * Holds the plugin instance.
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @var Plugin
     */
    public static $instance = null;

    /**
     * Init.
     *
     * Initialize Elementor Plugin. Register Elementor support for all the
     * supported post types and initialize Elementor components.
     *
     * @since 1.0.0
     * @access public
     */
    public function init()
    {
        $this->init_components();
    }

    function init_components()
    {
        $this->obsidianfunctions = new ObsidianFunctions();
    }

    /**
     * Add custom class to menu link items
     */
    function add_menu_link_class($atts, $item, $args)
    {
        if (property_exists($args, 'link_class')) {
            $atts['class'] = $args->link_class;
        }
        return $atts;
    }

    /**
     * register Menu Locations
     */

    function obsidianlab_menus()
    {

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus([
            "menu-header" => __("Header Menu", "westpuntcarrental"),
            "menu-footer" => __("Footer Menu", "westpuntcarrental"),
        ]);
    }

    /**
     * Register widget area.
     *
     * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
     */
    function obsidianlab_widgets_footer_one()
    {
        register_sidebar(
            array(
                'name'          => __('Footer One', 'obsidianlab'),
                'id'            => 'footer-one',
                'description'   => __('Add widgets here to appear in your footer.', 'obsidianlab'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

    function obsidianlab_widgets_footer_two()
    {
        register_sidebar(
            array(
                'name'          => __('Footer Two', 'obsidianlab'),
                'id'            => 'footer-two',
                'description'   => __('Add widgets here to appear in your footer.', 'obsidianlab'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

    function obsidianlab_widgets_footer_three()
    {
        register_sidebar(
            array(
                'name'          => __('Footer Three', 'obsidianlab'),
                'id'            => 'footer-three',
                'description'   => __('Add widgets here to appear in your footer.', 'obsidianlab'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

    function obsidianlab_widgets_footer_four()
    {
        register_sidebar(
            array(
                'name'          => __('Footer Four', 'obsidianlab'),
                'id'            => 'footer-four',
                'description'   => __('Add widgets here to appear in your footer.', 'obsidianlab'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            )
        );
    }

    function obsidianlab_header_styles()
    {
        echo '<style>
        #nav_menu [aria-current=page]{
            border-bottom: 2px solid' . get_theme_mod('obsidianlab_accent_color') . ';
        }
        #mobile-menu [aria-current=page]{
            border-left: 3px solid' . get_theme_mod('obsidianlab_accent_color') . ';
            border-bottom: none !important; 
        }
        .dark__header__mode #nav_menu.nav__scrolled [aria-current="page"] {
            border-color: ' . get_theme_mod('obsidianlab_accent_color') . ' !important;
        }
        .dark__header__mode #nav_menu [aria-current="page"] {
            border-color: #fff !important;
        }
        </style>';
    }

    function wpb_obsidianlab_sidebar_one($id)
    {
        register_sidebar(array(
            'name' => 'Sidebar One',
            'id'   => 'sidebar-one',
            'before_widget' => '<div class="sidebar-module">',
            'after_widget' => '</div>',
            'before_title' => '</h4>',
            'after_title' => '</h4>'
        ));
    }


    function add_custom_field_automatically($post_ID,)
    {

        $post_type = get_post_type($post_ID);

        // Only apply to custom post types
        if ('post' == $post_type || 'page' == $post_type) {

            add_post_meta($post_ID, 'meta_field', '55', true);
        }
    }

    /**
     * Instance.
     *
     * Ensures only one instance of the plugin class is loaded or can be loaded.
     *
     * @since 1.0.0
     * @access public
     * @static
     *
     * @return Plugin An instance of the class.
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    function register_autoloader()
    {
        require_once OBSIDIANLAB_PATH . 'inc/autoloader.php';

        Autoloader::run();
    }

    function admin_bar_remove_logo()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
    }

    function obsidianlab_customize_toolbar($wp_admin_bar)
    {
        global $wp_admin_bar;
        // Add feedback link
        $wp_admin_bar->add_menu(array(
            'id'        => 'obsidianlab',
            'title'     => '<img src="https://obsidianlab.io/wp-content/uploads/2023/01/favico-300x300.png" height="26" width="26" loading="lazy" style="height:26px;width:26px;padding-top: 3px;">',
            'href'      => __('https://obsidianlab.io'),
        ));
    }

    function obsidianlab_scripts()
    {
        /* When in plugin format, use this
        /* wp_enqueue_script('obsidianlab-script', OBSIDIANLAB_PATH . '/js/script.js', array(), OBSIDIANLAB_VERSION, true);
        */

        wp_enqueue_script('obsidianlab-custom-script', get_template_directory_uri() . '/obsidianlab/js/script.js', array('jquery'));
        wp_enqueue_script('gsap', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js', array('jquery'));
        wp_enqueue_style('quicksand-font', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;700&display=swap');
    }

    /**
     * Plugin constructor.
     *
     * Initializing Elementor plugin.
     *
     * @since 1.0.0
     * @access private
     */
    private function __construct()
    {
        $this->register_autoloader();
        add_action('init', [$this, 'init'], 0);
        add_filter('nav_menu_link_attributes', [$this, "add_menu_link_class"], 1, 3);
        add_action('widgets_init', [$this, 'obsidianlab_widgets_footer_one']);
        add_action('widgets_init', [$this, 'obsidianlab_widgets_footer_two']);
        add_action('widgets_init', [$this, 'obsidianlab_widgets_footer_three']);
        add_action('widgets_init', [$this, 'obsidianlab_widgets_footer_four']);
        add_action('wp_enqueue_scripts', [$this, 'obsidianlab_scripts']);
        add_action('wp_head', [$this, 'obsidianlab_header_styles']);
        add_action('publish_post', [$this, 'add_custom_field_automatically']);
        add_action('widgets_init', [$this, 'wpb_obsidianlab_sidebar_one']);
        add_action('wp_before_admin_bar_render', [$this, 'admin_bar_remove_logo'], 0);
        add_action('admin_bar_menu', [$this, 'obsidianlab_customize_toolbar'], 1);
        add_action('after_setup_theme', [$this, 'obsidianlab_menus']);
    }
}

if (!defined('ELEMENTOR_TESTS')) {
    // In tests we run the instance manually.
    Plugin::instance();

    /**
     * Include Tailwind Supported Nav Walker.
     */
    require_once OBSIDIANLAB_PATH . 'inc/tailwind-nav-walker.php';

    /**
     * Include custom custiomizer extension by Obsidianlab.
     */
    require OBSIDIANLAB_PATH . 'inc/customizer.php';
}
