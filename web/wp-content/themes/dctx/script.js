(function($) {
	$(window).on('load', function() {
		$('#preloader').delay(100).fadeOut('slow', function() {
			$(this).remove();
		});
	});

	if ($('#back-to-top').length) {
		var scrollTrigger = 100,
			backToTop = function() {
				var scrollTop = $(window).scrollTop();

				if (scrollTop > scrollTrigger) {
					$('#back-to-top').addClass('show');
				} else {
					$('#back-to-top').removeClass('show');
				}
			};

		backToTop();

		$(window).on('scroll', function() {
			backToTop();
		});

		$('#back-to-top').on('click', function(e) {
			e.preventDefault();

			$('html, body').animate({
				scrollTop: 0
			}, 500);
		});
	}
})(jQuery);
