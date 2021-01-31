/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function ($) {
	// Edit Site title and description.
	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.site-title a').text(to);
		});
	});
	wp.customize('blogdescription', function (value) {
		value.bind(function (to) {
			$('.site-description').text(to);
		});
	});

	// Header text color. Site title and logo position
	wp.customize('header_textcolor', function (value) {
		value.bind(function (to) {
			if ('blank' === to) {
				$('.site-title, .site-description').css({
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				});
				$('.custom-logo').css('padding-bottom', '2em');
			} else {
				$('.site-title, .site-description').css({
					clip: 'auto',
					position: 'relative',
				});
				$('.custom-logo').css('padding-bottom', '0em');
				$('.site-title a, .site-description').css({
					color: to,
				});
			}
		});
	});

	/* Hide/Show Default Logo */
	wp.customize('show_default_logo', function (cb) {
		cb.bind(function (to) {
			if (to) {
				$('.default-logo').removeClass('no-logo');
			}
			else {
				$('.default-logo').addClass('no-logo');
			}

		});
	});

	//Overlay Opacity
	wp.customize('cover_template_overlay_opacity', function (cb) {
		cb.bind(function (to) {
			var bgr = 'rgba(0,0,0,.' + to + ')';
			if (to) {
				$('head').append('<style>.site-branding::before{background:' + bgr + '}</style>');
			}
		});
	});


	// Call to action edit text
	wp.customize('banner_label', function (cb) {
		cb.bind(function (to) {
			if (to) {
				$('.call-to-action a').text(to);
				$('.call-to-action').removeClass('banner-no-label');
			}
			else {
				$('.call-to-action').addClass('banner-no-label');
			}
		});
	});

	wp.customize('banner_link', function (cb) {
		cb.bind(function (to) {
			if (to) {
				$('.call-to-action').removeClass('banner-no-link');
			}
			else {
				$('.call-to-action').addClass('banner-no-link');
			}
		});
	});

}(jQuery));