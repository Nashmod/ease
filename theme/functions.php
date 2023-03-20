<?php

/**
 * obsidianlab functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package obsidianlab
 */

if (!defined('OBSIDIANLAB_VERSION')) {
	// Replace the version number of the theme on each release.
	define('OBSIDIANLAB_VERSION', '0.1.0');
}

if (!function_exists('obsidianlab_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function obsidianlab_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on obsidianlab, use a find and replace
		 * to change 'obsidianlab' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('obsidianlab', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Add custom-logo support
		add_theme_support("custom-logo");

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('style-editor.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Remove support for block templates.
		remove_theme_support('block-templates');
	}
endif;
add_action('after_setup_theme', 'obsidianlab_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function obsidianlab_widgets_init()
{
	register_sidebar(
		array(
			'name'          => __('Footer', 'obsidianlab'),
			'id'            => 'sidebar-1',
			'description'   => __('Add widgets here to appear in your footer.', 'obsidianlab'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'obsidianlab_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function obsidianlab_scripts()
{
	wp_enqueue_style('obsidianlab-style', get_stylesheet_uri(), array(), OBSIDIANLAB_VERSION);
	wp_enqueue_script('obsidianlab-script', get_template_directory_uri() . '/js/script.min.js', array(), OBSIDIANLAB_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'obsidianlab_scripts');

/**
 * Add the block editor class to TinyMCE.
 *
 * This allows TinyMCE to use Tailwind Typography styles.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function obsidianlab_tinymce_add_class($settings)
{
	$settings['body_class'] = 'block-editor-block-list__layout';
	return $settings;
}
add_filter('tiny_mce_before_init', 'obsidianlab_tinymce_add_class');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * ========== Start of Obsidianlab Custom Code ==========
 */

/**
 * Include custom theme functions by Obsidianlab.
 */
require get_template_directory() . "/obsidianlab/obsidianlab.php";

function residential_slider_shortcode($atts)
{
	/**
	 * Setup query to show the ‘services’ post type with ‘8’ posts.
	 * Output the title with an excerpt.
	 */
	ob_start();
	$args = [
		"post_type" => "residential",
		"post_status" => "publish",
		"posts_per_page" => -1,
		"orderby" => "title",
		"order" => "ASC",
	];
	$loop = new WP_Query($args);
?>
	<style>
		.card .image-box img {
			width: 100%;
			height: 100%;
			border-radius: 24px;
		}
	</style>

	<!-- Slider main container -->
	<div class="swiper">
		<!-- Additional required wrapper -->
		<div class="swiper-wrapper">

			<? while ($loop->have_posts()) :
				$loop->the_post();
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), "single-post-thumbnail")[0] ?? "";
			?>

				<!-- Slides -->
				<div class="card swiper-slide ">
					<div class="image-box relative group">
						<img src="<?= $image ?>">
						<h2 class="absolute text-3xl text-white bottom-3 left-9"><?= get_the_title() ?></h2>
						<a href="#" class="opacity-0 group-hover:opacity-100 absolute bg-[#C5E6ED] text-[#000A44] -bottom-5 -right-5 border rounded-3xl px-12 py-2 transition-all ease-in duration-100"> <?= __("SHOP NOW", 'obsidianlab') ?></a>
					</div>
				</div>
			<?
			endwhile;
			?>

		</div>
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>

		<!-- If we need navigation buttons -->
		<div class="swiper-button-next"></div>

	</div>

	<script>
		const swiper = new Swiper('.swiper', {
			direction: 'horizontal',
			spaceBetween: 30,
			slidesPerView: 2.5,
			grabCursor: true,
			rewind: true,

			// If we need pagination
			pagination: {
				clickable: true,
				el: '.swiper-pagination',
				dynamicBullets: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: '.swiper-button-next'
			},
		});
	</script>

<?
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode("residential_slider", "residential_slider_shortcode");
