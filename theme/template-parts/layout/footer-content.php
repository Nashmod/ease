<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package obsidianlab
 */

use ObsidianLab\Tailwind_Walker;
?>

<footer class="bg-[#060816] py-4">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col gap-6 sm:gap-16 items-center justify-between md:flex-row"> <a href="<?= esc_url(home_url("/")) ?>" title="<?= esc_attr(get_bloginfo("name")) ?>">
			<img id="site_logo" class="block h-24 w-auto" src="<?= esc_url(wp_get_attachment_image_src(get_theme_mod("custom_logo"), "full")[0] ?? "") ?>" alt="<?= esc_attr(get_bloginfo("name")) ?>">
			<img id="site_logo_dark" class="hidden h-24 w-auto" src="<?= esc_url(get_theme_mod("logo_dark")) ?>" alt="<?= esc_attr(get_bloginfo("name")) ?>">
		</a>
		<div class="grid grid-cols-1 gap-8 xl:col-span-4 xl:mt-0 ">
			<div class="flex flex-col text-sm sm:text-base sm:flex-row sm:gap-10 text-right md:justify-items-end">
				<?php wp_nav_menu([
					"theme_location" => "menu-footer",
					"menu_id" => "footer-menu",
					"container" => "",
					"items_wrap" => '%3$s',
					"link_class" => " font-bold w-fit col-span-4 md:col-span-1 row-span-1 sm:text-right text-[14px] leading-6 text-white",
					"walker" => new Tailwind_Walker(),
				]); ?>
			</div>
		</div>
		<p class="text-md font-thin text-white "><?= get_theme_mod('obsidianlab_copyright_text') ?></p>
	</div>
</footer>