jQuery(document).ready(function($){
	'use strict';

	tisara_init_sticky_nav();
	tisara_init_navigation();
	
	$(".header-menu-primary").addClass("menu-show");

	$(document).on("click",'.btt-btn' ,function(e){
		e.preventDefault();
		$('html,body').animate({ scrollTop: 0 });
	});

	if( window.innerWidth < 990 ) {
		var mobileHeader = $(".site-header-mobile");
		var mhHeight = mobileHeader.innerHeight();

		if( mobileHeader.hasClass("header-sticky") ) {
			$(".site_content").css({
				paddingTop: mhHeight+"px"
			});
		}
	}

	$(window).load(function(){
		tisara_init_header_ui();
		tisara_init_woo();
	});

	$(window).resize(function(){

		var siteContent = $(".site_content");

		if( window.innerWidth < 990 ) {
			var mobileHeader = $(".site-header-mobile");
			var mhHeight = mobileHeader.innerHeight();

			if( mobileHeader.hasClass("header-sticky") ) {
				siteContent.css({
					paddingTop: mhHeight+"px"
				});
			}
		} else {
			siteContent.css({
				paddingTop: 0
			});
		}
	});

	$(window).scroll(function () {
		if( window.innerWidth > 990 ){
			if( $(".site-header").hasClass("header-sticky") ){
				var offset = 300;

				if( $(this).scrollTop() > offset ){
					$(".header-sticky").addClass("active");
				} else {
					$(".header-sticky").removeClass("active");
				}

			}
		}
		if( window.scrollY > 300 ){
			$(".btt-btn").addClass('active');
		} else {
			$(".btt-btn").removeClass('active');
		}

	});

	/**
	 * init sticky navigation
	 */
	function tisara_init_sticky_nav(){
		var $pageHeader   = $(".site-header").first();
		var isSticky      = ( $pageHeader.hasClass("header-sticky")) ? 'header-sticky': '';
		var containerType = ( $(".header-bottom > .container").length ) ? "container": "container-fluid";
		var isTransparent = ( $pageHeader.hasClass("header-transparent") ) ? ' header-transparent ': '';
		var stickyHeader;

		if( !$pageHeader.hasClass("site-header-style-7") && !$pageHeader.hasClass("site-header-style-8") ){
			
			if( ! $(".site-header-mobile").length ) {
				$pageHeader.after( $('<div class="site-header-mobile '+isSticky+isTransparent+'"><div class="'+containerType+'"></div></div>') );
			} else {
				$(".site-header-mobile ."+containerType).html("");
			}
			
			stickyHeader = $(".site-header-mobile ."+containerType);

			$pageHeader.find(".offcanvas-menu-trigger").clone().appendTo(stickyHeader);
			$pageHeader.find(".header-logo").clone().appendTo(stickyHeader);

			if( $pageHeader.hasClass("site-header-style-4") ){
				if( $pageHeader.find(".header-menu-primary").length ) {
					$pageHeader.find(".header-menu-primary").clone().removeClass("pull-left").addClass("menu-show").appendTo(stickyHeader);
				} else {
					stickyHeader.append('<nav class="header-menu-primary menu-show generated"></nav>');
					var pmCtr = stickyHeader.find(".generated.header-menu-primary");
					pmCtr.append( $pageHeader.find(".menu-secondary").clone().wrap('<nav class="header-menu-primary menu-show"></nav>') );
					
				}
			} else {
				$pageHeader.find(".header-menu-primary").clone().removeClass("pull-left").addClass("menu-show").appendTo(stickyHeader);
			}

			$pageHeader.find(".header-bottom-right").clone().appendTo(stickyHeader);

		} else {
			
			if( ! $(".site-header-mobile").length ) {
				$pageHeader.after( $('<div class="site-header-mobile '+isSticky+isTransparent+'"><div class="'+containerType+'"></div></div>') );
			} else {
				$(".site-header-mobile ."+containerType).html("");
			}
			stickyHeader = $(".site-header-mobile ."+containerType);

			$pageHeader.find(".header-logo").clone().appendTo(stickyHeader);
			$pageHeader.find(".header-bottom-right").clone().appendTo(stickyHeader);
		}

	}

	/**
	 * Navigation Script
	 */
	function tisara_init_navigation () {
		/* Mobile Menu Initialization */
		var toggleButton = '<button type="button" class="submenu-down"><!-- <i class="fa fa-angle-down"></i> --><svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 320 512"><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg></button>';
		if( ! $(".offcanvas-menu").length && ! $(".site-header").hasClass("site-header-style-7") && ! $(".site-header").hasClass("site-header-style-8") ){
			$("body").append('<div class="offcanvas-menu offcanvas-push-left"><button class="offcanvas-menu-close"><!-- <i class="ti-arrow-left"></i> --><svg xmlns="https://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 448 512"><path d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"/></svg></button></div>');
			$(".header-menu-primary").first().clone().attr('class','offcanvas-menu-primary').appendTo(".offcanvas-menu");
			
		}

		$(".offcanvas-menu .menu-item-has-children").prepend(toggleButton);

		// Making mobile menu behave like an accordion
		$(".offcanvas-menu .menu-item-has-children button").on( "click", function() {

			$(this).toggleClass("active");
			$(this).siblings('.sub-menu').slideToggle(200);

			return false;
		});

		if( !$(".offcanvas-overlay").length ){
			var $sidemenuOverlay = '<div class="offcanvas-overlay"></div>';
			$("body").prepend($sidemenuOverlay);
		}

		$(document).on("click",".offcanvas-menu-trigger,.offcanvas-side-trigger", function(e){
			e.preventDefault();
			e.stopPropagation();

			var body = $("body");
			body.addClass("offcanvas-menu-active");
			$(".offcanvas-overlay").fadeIn(300,function(){
				$(".offcanvas-menu").addClass("active");
			});
		});
		
		$(".offcanvas-overlay,.offcanvas-menu-close").on("click",function(){
			$(".offcanvas-menu,.offcanvas-cart").removeClass("active");
			$(".offcanvas-overlay").fadeOut(300,function(){
				$("body").removeClass("offcanvas-menu-active");
			});
			// });
		});

		var submenuIndicator = '<!-- <i class="fa fa-angle-down"></i> --><svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 320 512"><path d="M143 352.3L7 216.3c-9.4-9.4-9.4-24.6 0-33.9l22.6-22.6c9.4-9.4 24.6-9.4 33.9 0l96.4 96.4 96.4-96.4c9.4-9.4 24.6-9.4 33.9 0l22.6 22.6c9.4 9.4 9.4 24.6 0 33.9l-136 136c-9.2 9.4-24.4 9.4-33.8 0z"/></svg>';
		$(".header-menu-primary > ul > li.menu-item-has-children > a").append(submenuIndicator);
	}

	/**
	 * Header UI script
	 */
	function tisara_init_header_ui () {
		/* ====================================================
		* Search Form - Header UI
		* ==================================================== */	    
		$(document).on("click",".header-search-trigger", function(e){
			e.preventDefault();

			var $searchForm  = $(this).parent().find(".header-search-form");
			var $body        = $("body");
			var $primaryMenu = $(".header-menu-primary");

			if( $body.hasClass("header-search-form-active") ){
				$body.removeClass("header-search-form-active");
				$primaryMenu.removeClass("header-search-active");
				$searchForm.removeClass("active");
			} else {
				$body.addClass("header-search-form-active");
				$primaryMenu.addClass("header-search-active");
				$searchForm.addClass("active").find("input").focus();
			}
		});

		// Dismissing search form
		$(".header-search").clickOff(function(){
			$("body").removeClass("header-search-form-active");
			$(".header-search-form").fadeOut(100,function(){
				$(".header-menu-primary").removeClass("header-search-active");
				$(".header-search-form").removeClass("active");
			});
		});


		/* ====================================================
			* Cart Button - Header UI
			* ==================================================== */	 
		$(document).on("click",".header-cart", function(e){
			e.preventDefault();
			var body = $("body");
			
			body.addClass("offcanvas-menu-active");
			$(".offcanvas-overlay").fadeIn(300,function(){
				$(".offcanvas-cart").addClass("active");
			});
		});
	}

	function tisara_init_woo () {
		/* ====================================================
			* Inject action on Add to cart button
			* ==================================================== */	 
		$(".add_to_cart_button").on( "click", function() {
			$(this).bind("ajaxComplete",function(){
				setTimeout(function(){
					$(".site-header .header-cart").trigger("click");
				},300);
			});
		});
	}

	/**
	 * Click outside element plugins
	 */
	$.fn.clickOff = function(callback) {
		var clicked = false;
		var parent = this;
		
		parent.on( "click", function() {
			clicked = true;
		});
		
		$(document).on( "click", function() {
			if (!clicked) {
				callback(parent, event);
			}
			clicked = false;
		});

		parent.keyup(function(e){
			if(e.keyCode == 27){
				callback(parent, event);
			}
		});
	};

});