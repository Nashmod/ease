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

function rental_slider_shortcode($atts)
{
	/**
	 * Setup query to show the ‘services’ post type with ‘8’ posts.
	 * Output the title with an excerpt.
	 */
	ob_start();
	$args = [
		"post_type" => "rental",
		"post_status" => "publish",
		"posts_per_page" => -1,
		"orderby" => "date",
		"order" => "ASC",
	];
	$loop = new WP_Query($args);
?>

	<!-- Slider main container -->
	<div class="rentalSwiper swiper">
		<!-- Additional required wrapper -->
		<div class="swiper-wrapper">

			<? while ($loop->have_posts()) :
				$loop->the_post();
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), "single-post-thumbnail")[0] ?? "";
				$pod = pods("rental", get_the_id());
				$passengers = $pod->field("passengers");
				$transmission = $pod->field("transmission_type");
				$car_doors = $pod->field("car_doors");
				$luggages = $pod->field("luggages");
				$amenities = $pod->field("amenities");

				$icon_list = [
					"ac" => ["name" => "Air Conditioner", "link" => "/wp-content/uploads/2023/06/air-conditioner.png"],
					"usb" => ["name" => "USB-Port", "link" => "/wp-content/uploads/2023/06/usb-port.png"],
					"sunroof" => ["name" => "Sunroof", "link" => "/wp-content/uploads/2023/06/usb-port.png"],
					"buc" => ["name" => "Back up camera", "link" => "/wp-content/uploads/2023/06/camera.png"],
				];
			?>

				<!-- Slides -->
				<div class="swiper-slide">
					<div class="card">
						<div class="image-box relative group">
							<img src="<?= $image ?>">
						</div>
						<div class="grid grid-cols-2 gap-y-4 mb-4">
							<h2 class="m-0 mb-4 text-xl text-[#222222] col-span-2"><?= get_the_title() ?></h2>

							<? if ($passengers) : ?>

								<div class="col-span-1">
									<div class="flex flex-1 flex-row self-center text-gray-500 text-sm">
										<img class="max-h-5 mr-3" src="/wp-content/uploads/2023/06/car-door.png">
										<span class="self-center text-sm"><?= $passengers ?></span>
									</div>
								</div>

							<? endif; ?>


							<? if ($transmission) : ?>

								<div class="col-span-1">
									<div class="flex flex-1 flex-row self-center text-gray-500 text-sm">
										<img class="max-h-5 mr-3" src="/wp-content/uploads/2023/06/Gear-Icon.png">
										<span class="self-center text-sm"><?= $transmission ?></span>
									</div>
								</div>

							<? endif; ?>


							<? if ($car_doors) : ?>

								<div class="col-span-1">
									<div class="flex flex-1 flex-row self-center text-gray-500 text-sm">
										<img class="max-h-5 mr-3" src="/wp-content/uploads/2023/06/people.png">
										<span class="self-center text-sm"><?= $car_doors ?></span>
									</div>
								</div>

							<? endif; ?>

							<? if ($luggages) : ?>

								<div class="col-span-1">
									<div class="flex flex-1 flex-row self-center text-gray-500 text-sm">
										<img class="max-h-5 mr-3" src="/wp-content/uploads/2023/06/suitcase.png">
										<span class="self-center text-sm"><?= $luggages ?></span>
									</div>
								</div>

							<? endif; ?>


							<? if ($amenities) : ?>
								<section class="col-span-2">
									<div class="grid grid-cols-2 auto-rows-auto gap-y-4">
										<? if (is_string($amenities)) : ?>
											<div class="flex flex-1 flex-row self-center text-gray-500 text-sm">
												<img class="max-h-5 mr-3" src="<?= $icon_list[$amenitie]["link"] ?>">
												<span class="self-center text-sm"><?= $icon_list[$amenitie]["name"] ?></span>
											</div>
										<? else : ?>
											<? foreach ($amenities as $amenitie) {
											?>
												<div class="flex flex-1 flex-row self-center text-gray-500 text-sm">
													<img class="max-h-5 mr-3" src="<?= $icon_list[$amenitie]["link"] ?>">
													<span class="self-center text-sm"><?= $icon_list[$amenitie]["name"] ?></span>
												</div>
											<?
											} ?>
										<? endif; ?>
									</div>
								</section>
							<? endif; ?>
						</div>
						<a href="#contact" class=" mt-auto rounded-md text-center bg-[#4852DF] px-12 py-3 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Contact to Reserve</a>
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
		const swiper = new Swiper('.rentalSwiper', {
			direction: 'horizontal',
			spaceBetween: 15,
			slidesPerView: 1.5,
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
			// Responsive breakpoints
			breakpoints: {
				676: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				1400: {
					slidesPerView: 2.5,
					spaceBetween: 30,
				},
			}
		});
	</script>

<?
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode("rental_slider", "rental_slider_shortcode");

function testimonial_slider_shortcode($atts)
{
	/**
	 * Setup query to show the ‘services’ post type with ‘8’ posts.
	 * Output the title with an excerpt.
	 */
	ob_start();
	$args = [
		"post_type" => "testimonial",
		"post_status" => "publish",
		"posts_per_page" => -1,
		"orderby" => "title",
		"order" => "ASC",
	];
	$loop = new WP_Query($args);
?>
	<style>
		.brand__card {
			max-width: 398px;
		}

		.testimonialSwiper {
			padding-bottom: 30px !important;
		}
	</style>

	<!-- Slider main container -->
	<div class="testimonialSwiper swiper" dir="rtl">
		<!-- Additional required wrapper -->
		<div class="swiper-wrapper" dir="rtl">

			<? while ($loop->have_posts()) :
				$loop->the_post();
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), "single-post-thumbnail")[0] ?? "";
			?>

				<!-- Slides -->
				<div class="brand__card swiper-slide bg-[#E6E7F0] rounded-md">
					<div class="h-slider-item flex-none md:pb-4  p-8 ">
						<div class="flex content-center justify-end flex-wrap">
							<div class="flex flex-col self-center items-end">
								<h3 class="font-bold text-[#171926] text-lg leading-none mb-1 mt-0"><?= the_title() ?></h3>
								<p class="text-[0.700rem] leading-none m-0 mt-2">March 9, 2023</p>
							</div>
							<img class="inline-block !h-12 !w-12 !rounded-full mr-4" src="<?= $image ?>" alt="">
							<div class="text-[#171926] text-sm mt-2 mb-8 text-left"><?= the_content() ?></div>
						</div>
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
		const testimonialSwiper = new Swiper('.testimonialSwiper', {
			direction: 'horizontal',
			spaceBetween: 30,
			slidesPerView: 1.5,
			grabCursor: true,
			rewind: true,
			reverseDirection: true,

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
			// Responsive breakpoints
			breakpoints: {
				// when window width is >= 320px
				999: {
					spaceBetween: 30,
					slidesPerView: 3,
				},
			}
		});
	</script>

<?
	wp_reset_postdata();
	return ob_get_clean();
}
add_shortcode("testimonial_slider", "testimonial_slider_shortcode");
