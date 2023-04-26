// eslint-disable-next-line no-undef
jQuery(document).ready(function ($) {
	$(document).ready(function ($) {
		$('input[data-input-type]').on('input change', function () {
			var val = $(this).val();
			$(this).prev('.cs-range-value').html(val);
			$(this).val(val);
		});
	});
	if ($('body').hasClass('home')) {
		//$("body").addClass("dark__header__mode");
		$(document).scroll(function () {
			var $nav = $('#nav_menu');
			$nav.toggleClass(
				'nav__scrolled',
				$(this).scrollTop() > $nav.height()
			);
		});
	}

	$('[aria-controls="mobile-menu"]').on('click', function () {
		$('#mobile-menu').toggleClass('-translate-y-full');
	});
});

document.addEventListener('DOMContentLoaded', function () {
	const controller = new ScrollMagic.Controller();

	// scrollingImages
	let scrollingImages = Array.prototype.slice.call(
		document.querySelectorAll('.scrolling__image')
	);
	let self = this;

	scrollingImages.forEach(function (self) {
		// build a tween
		let fadeInBottom = TweenMax.from(self, 1, { y: 100 });
		// build a scene
		new ScrollMagic.Scene({
			triggerElement: self,
			duration: 2000,
			offset: -500,
		})
			.setTween(fadeInBottom)
			.addTo(controller);
	});
});
