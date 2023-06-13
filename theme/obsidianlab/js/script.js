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
		$('#mobile-menu').toggleClass('h-0 h-100');
	});

	$('.services__img img').each(function (el) {
		if (el == 0) return;
		this.style.display = 'none';
	});

	const $toggleList = $('.elementor-toggle .elementor-toggle-item').on(
		'click',
		function () {
			const index = $toggleList.index(this);
			console.log(index);
			$('.services__img img').each(function (el) {
				if (el == index) return (this.style.display = 'block');
				this.style.display = 'none';
			});
		}
	);
});
