<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package obsidianlab
 */

use ObsidianLab\Tailwind_Walker;
?>

<!-- #site-navigation -->
<nav class="bg-[#171926de] py-8 absolute top-0 left-0 z-10 w-full">
	<div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
		<div class="relative flex gap-x-12 h-16 items-center justify-between">
			<div class="flex flex-1 items-center justify-center sm:justify-start">
				<div class="flex flex-shrink-0 items-center">
					<a href="<?= esc_url(home_url("/")) ?>" title="<?= esc_attr(get_bloginfo("name")) ?>">
						<img id="site_logo" class="block h-14 w-auto" src="<?= esc_url(wp_get_attachment_image_src(get_theme_mod("custom_logo"), "full")[0] ?? "") ?>" alt="<?= esc_attr(get_bloginfo("name")) ?>">
						<img id="site_logo_dark" class="hidden h-14 w-auto" src="<?= esc_url(get_theme_mod("logo_dark")) ?>" alt="<?= esc_attr(get_bloginfo("name")) ?>">
					</a>
				</div>
				<div class="hidden sm:ml-auto md:block">
					<div class="flex space-x-4">
						<?php wp_nav_menu([
							"theme_location" => "menu-header",
							"menu_id" => "header-menu",
							"container" => "",
							"items_wrap" => '%3$s',
							"link_class" => "text-white hover:text-white rounded-md px-3 py-2 text-lg font-medium",
							"walker" => new Tailwind_Walker(),
						]); ?>
						<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
					</div>
				</div>
			</div>
			<div class="flex items-center md:hidden">
				<!-- Mobile menu button-->
				<button type="button" class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
					<span class="sr-only">Open main menu</span>
					<!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
					<svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
					</svg>
					<!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
					<svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>
			<a href="#contact" class="hidden md:block text-lg rounded-md bg-[#00ADCC] px-12 py-3 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Contact us</a>
		</div>
	</div>

	<!-- Mobile menu, show/hide based on menu state. -->
	<div class="md:hidden transition-all duration-300 ease-in-out overflow-hidden h-0" id="mobile-menu">
		<div class="space-y-1 px-2 pb-3 pt-2">
			<div class="flex space-x-4">
				<?php wp_nav_menu([
					"theme_location" => "menu-header",
					"menu_id" => "header-menu",
					"container" => "",
					"items_wrap" => '%3$s',
					"link_class" => "text-gray-300 hover:bg-gray-700 hover:text-white block rounded-md px-3 py-2 text-base font-medium",
					"walker" => new Tailwind_Walker(),
				]); ?>
				<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
			</div>
		</div>
</nav>