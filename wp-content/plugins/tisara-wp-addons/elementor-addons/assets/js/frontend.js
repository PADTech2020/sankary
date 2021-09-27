jQuery( window ).on( 'elementor/frontend/init', function() {
	if ( undefined !== window.elementorFrontend ) {
		/* TP - Post Grid */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/kn_blog_post.default', function( $scope ) {
			var carousel_wrapper = $scope.find( '.kn-blog-post-carousel' );

			var carousel_data = carousel_wrapper.data( 'slider_options' );

			if ( carousel_data === undefined ) return;

			var slickOptions = {
				slidesToShow: parseInt( carousel_data.slides_to_show_desktop ),
				slidesToScroll: parseInt ( carousel_data.slides_to_scroll_desktop ),
				adaptiveHeight: carousel_data.adaptiveHeight,
				autoplaySpeed: parseInt( carousel_data.autoplaySpeed ),
				autoplay: carousel_data.autoplay,
				infinite: carousel_data.infinite,
				pauseOnHover: carousel_data.pauseOnHover,
				speed: parseInt( carousel_data.speed ),
				arrows: carousel_data.arrows,
				dots: carousel_data.dots,
				fade: carousel_data.fade,
				rtl: carousel_data.rtl,
				responsive: [
					{
						breakpoint: 1023,
						settings:{
							slidesToShow: parseInt( carousel_data.slides_to_show_tablet ),
							slidesToScroll: parseInt ( carousel_data.slides_to_scroll_tablet ),
						}
					},
					{
						breakpoint: 767,
						settings:{
							slidesToShow: parseInt( carousel_data.slides_to_show_mobile ),
							slidesToScroll: parseInt ( carousel_data.slides_to_scroll_mobile ),
						}
					}
				]
			};

			carousel_wrapper.slick( slickOptions );
		} );

		/* TP - Slider Content */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/kn_content_slider.default', function( $scope ) {
			var $slider = $scope.find( '.kn-content-slider' );
			if ( ! $slider.length ) {
				return;
			}
			$slider.slick( $slider.data( 'slider_options' ) );
		} );

		/* TP - Slider Image */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/kn_image_slider.default', function( $scope ) {
			var carousel_wrapper = $scope.find( '.kn-image-slider' );
			if ( carousel_wrapper.length ) {
				carousel_wrapper.slick( carousel_wrapper.data( 'slider_options' ) );
			}
			if (true == carousel_wrapper.data('slider_options').sliderSyncing) {
				var carousel_nav = $scope.find( '.kn-image-slider-nav' );
				var carousel_nav_data = carousel_nav.data( 'slider_nav_options' );
				if ( carousel_nav.length ) {
					carousel_nav.slick( {
						asNavFor: carousel_nav_data.asNavFor,
						slidesToShow: carousel_nav_data.slidesToShow,
						slidesToScroll: 1,
						fade: false,
						centerMode: true,
						focusOnSelect: true,
						arrows: true,
						responsive: [
							{
								breakpoint: 1023,
								settings:{
									slidesToShow: 3,
									slidesToScroll: 1,
								}
							},
							{
								breakpoint: 767,
								settings:{
									slidesToShow: 2,
									slidesToScroll: 1,
								}
							}
						],
					} );
				}
			}
		} );

		/* TP - Image Gallery */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/kn_image_gallery.default', function( $scope ) {

			var carousel_wrapper = $scope.find( '.kn-image-gallery-carousel' );

			if ( ! carousel_wrapper.length ) {
				return;
			}

			var carousel_data = carousel_wrapper.data( 'slider_options' );

			if ( carousel_data === undefined ) {
				return;
			}

			var slickOptions = {
				slidesToShow: parseInt( carousel_data.slides_to_show_desktop ),
				slidesToScroll: parseInt ( carousel_data.slides_to_scroll_desktop ),
				adaptiveHeight: carousel_data.adaptiveHeight,
				autoplaySpeed: parseInt( carousel_data.autoplaySpeed ),
				autoplay: carousel_data.autoplay,
				infinite: carousel_data.infinite,
				pauseOnHover: carousel_data.pauseOnHover,
				speed: parseInt( carousel_data.speed ),
				arrows: carousel_data.arrows,
				dots: carousel_data.dots,
				fade: carousel_data.fade,
				rtl: carousel_data.rtl,
				responsive: [
					{
						breakpoint: 1023,
						settings:{
							slidesToShow: parseInt( carousel_data.slides_to_show_tablet ),
							slidesToScroll: parseInt ( carousel_data.slides_to_scroll_tablet ),
						}
					},
					{
						breakpoint: 767,
						settings:{
							slidesToShow: parseInt( carousel_data.slides_to_show_mobile ),
							slidesToScroll: parseInt ( carousel_data.slides_to_scroll_mobile ),
						}
					}
				]
			};

			carousel_wrapper.slick( slickOptions );
		} );

		/* TP - Testimonials */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/kn_testimonials.default', function( $scope ) {
			var carousel_wrapper = $scope.find( '.kn-testimonials-carousel' );

			var carousel_data = carousel_wrapper.data( 'slider_options' );

			if ( carousel_data === undefined ) return;

			var slickOptions = {
				slidesToShow: parseInt( carousel_data.slides_to_show_desktop ),
				slidesToScroll: parseInt ( carousel_data.slides_to_scroll_desktop ),
				adaptiveHeight: carousel_data.adaptiveHeight,
				autoplaySpeed: parseInt( carousel_data.autoplaySpeed ),
				autoplay: carousel_data.autoplay,
				infinite: carousel_data.infinite,
				pauseOnHover: carousel_data.pauseOnHover,
				speed: parseInt( carousel_data.speed ),
				arrows: carousel_data.arrows,
				dots: carousel_data.dots,
				fade: carousel_data.fade,
				rtl: carousel_data.rtl,
				responsive: [
					{
						breakpoint: 1023,
						settings:{
							slidesToShow: parseInt( carousel_data.slides_to_show_tablet ),
							slidesToScroll: parseInt ( carousel_data.slides_to_scroll_tablet ),
						}
					},
					{
						breakpoint: 767,
						settings:{
							slidesToShow: parseInt( carousel_data.slides_to_show_mobile ),
							slidesToScroll: parseInt ( carousel_data.slides_to_scroll_mobile ),
						}
					}
				]
			};

			carousel_wrapper.slick( slickOptions );
		} );

		/* TP - WC Products */
		elementorFrontend.hooks.addAction( 'frontend/element_ready/kn_wc_products.default', function( $scope ) {
			var carousel_wrapper = $scope.find( '.tp-wc-products-carousel' );

			var carousel_slide = carousel_wrapper.find( 'ul.products' );

			var carousel_data = carousel_wrapper.data( 'slider_options' );

			if ( carousel_data === undefined ) return;

			var slickOptions = {
				slidesToShow: parseInt( carousel_data.slides_to_show_desktop ),
				slidesToScroll: parseInt ( carousel_data.slides_to_scroll_desktop ),
				adaptiveHeight: carousel_data.adaptiveHeight,
				autoplaySpeed: parseInt( carousel_data.autoplaySpeed ),
				autoplay: carousel_data.autoplay,
				infinite: carousel_data.infinite,
				pauseOnHover: carousel_data.pauseOnHover,
				speed: parseInt( carousel_data.speed ),
				arrows: carousel_data.arrows,
				dots: carousel_data.dots,
				fade: carousel_data.fade,
				rtl: carousel_data.rtl,
				responsive: [
					{
						breakpoint: 1023,
						settings:{
							slidesToShow: parseInt( carousel_data.slides_to_show_tablet ),
							slidesToScroll: parseInt ( carousel_data.slides_to_scroll_tablet ),
						}
					},
					{
						breakpoint: 767,
						settings:{
							slidesToShow: parseInt( carousel_data.slides_to_show_mobile ),
							slidesToScroll: parseInt ( carousel_data.slides_to_scroll_mobile ),
						}
					}
				]
			};

			carousel_slide.slick( slickOptions );
		} );
	}
} );