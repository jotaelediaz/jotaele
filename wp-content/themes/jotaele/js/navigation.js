/**
 * File navigation.js.
 *
 */

var alturaHeader = 0; 
var lastScrollTop = 0;
var first_change_header = true;

(function ($, root, undefined) {

    $(function () {
        'use strict';

        alturaHeader=$('.sticky-topbar').height();
        
        // Cabecera sticky 
        $(window).scroll(function () { if ($('.sticky-topbar').length) {
            // *** sticky-topbar: La cabecera se vuelve sticky al hacer scroll más allá de su altura
            if ($(window).scrollTop() >= alturaHeader) {
                $('.sticky-topbar').addClass('fixed-header');
                $(document.body).css('margin-top', alturaHeader);
                first_change_header = false;
            } else {
                $('.sticky-topbar').removeClass('fixed-header');
                $(document.body).css('margin-top', '0');
                $('.sticky-topbar').css('transform', '');
                first_change_header = true;
            }

            // sticky-on-return: La cabecera sticky solo se muestra cuando el usuario hace scroll hacia arriba
            if ($('.sticky-topbar.sticky-on-return').length) {
                var st = $(window).scrollTop();
                if (st < lastScrollTop){ // Scroll hacia arriba
                    $('.sticky-topbar.fixed-header').css('transform', 'translateY(0px)'); 
                } else { //Scroll hacia abajo
                    $('.sticky-topbar.fixed-header').css('transform', 'translateY(-'+$('.sticky-topbar').height()+'px)'); 
                }
                lastScrollTop = $(window).scrollTop();
            }
            
            if (first_change_header) {$('.sticky-topbar.sticky-on-return').removeClass('animate');}
            else {$('.sticky-topbar.sticky-on-return').addClass('animate');}
        }});
        
        // To Top
        var offset = 300;
        var duration = 1000;
        var shown = false;
        var hidding = false;
        $(window).scroll(function () {
            var wHeight = $(window).height();
            var wWidth = $(window).width();
            var hHeight = $(document).height();
            var scrollTop = $(window).scrollTop();
            if (wHeight > offset) {
                $('#toTop').fadeIn(duration);
                shown = true;
            }

            if (shown && !hidding) {
                hidding = true;
                setTimeout(function () {
                    $('#toTop').fadeOut(duration);
                    shown = false;
                    hidding = false;
                }, 3000);
            }

            if (hHeight - scrollTop - wHeight < 100 && wWidth >= 768) {
                if (!$('#toTop').hasClass("_mod")) {
                    $('#toTop').addClass("_mod");
                }
            } else {
                $('#toTop').removeClass("_mod");
            }
        });

        $(document).on('click', '#toTop', function () {
            $('html, body').stop().animate({
                scrollTop: 0
            }, 1000);
            return false;
        });

        /* Navegación */
        window.verticalNavigation = function (object, event) {
            var $anchor = object;

            var top = $($anchor.attr('href')).offset().top;
            if ($("header").hasClass("sticky") || $("header").find(".sticky").length > 0) {
                if ($("header").hasClass("sticky")) {
                    top = top - $("header").height();
                } else {
                    top = top - $("header").find(".sticky").first().outerHeight();
                }
            }
            $('html, body').stop().animate({
                scrollTop: (top)
            }, 1500);
            event.preventDefault();
        };

        $('.vertical-nav-button').on('click', function (event) {
            verticalNavigation($(this), event);
        });

        $('.ancla').on('click', function (event) {
            verticalNavigation($(this), event);
        });
		
		 // Toggle de los submenús
        $('#site-navigation li.menu-item-has-children > a', this).click(function(e) {
                e.preventDefault();
                $(this).parent().children('.sub-menu:first').slideToggle(200, function () {});
                $(this).parent().toggleClass('expanded');
                
                // Ocultamos otros menús que quedaran abiertos...
                $(this).parent().siblings().children('.sub-menu:visible').slideToggle(200, function () {});
        });
		
		// Toggle búsqueda
        $( ".search-menu-toggle" ).click(function() {     
			$('.search-menu-toggle').attr( "aria-expanded" ) == "true" ? $('.search-menu-toggle').attr("aria-expanded", "false") : $('.search-menu-toggle').attr("aria-expanded", "true");
			$('#main-search-bar').hasClass('not-visible') ? $('#main-search-bar').removeClass("not-visible") : $('#main-search-bar').addClass("not-visible");
			
			$('.search-menu-toggle').attr( "aria-expanded" ) == "true" ? $('#main-search-bar input').focus() : $('#main-search-bar input').blur();
        });
		
		// Toggle menú principal
        $( ".primary-menu-toggle" ).click(function() {     
			$('.primary-menu-toggle').attr( "aria-expanded" ) == "true" ? $('.primary-menu-toggle').attr("aria-expanded", "false") : $('.primary-menu-toggle').attr("aria-expanded", "true");
			$('#main-menu-wrapper').hasClass('menu-expanded') ? $('#main-menu-wrapper').removeClass("menu-expanded") : $('#main-menu-wrapper').addClass("menu-expanded");
			$('#main-menu-wrapper').hasClass('menu-expanded') ? $('body').addClass('scroll-locked') : $('body').removeClass('scroll-locked');
        });
		
		$( ".primary-menu-close" ).click(function() {  
			$('.primary-menu-toggle').attr("aria-expanded", "false");
			$('#main-menu-wrapper').removeClass("menu-expanded");
			$('body').removeClass('scroll-locked');
		});
		
		// Initialize Owl Carousel
		$(".owl-carousel").owlCarousel({
		    nav:true,
    		responsive:{
				0:{
					items:1
				},
				768:{
					items:3
				},
				991:{
					items:3
				}
			}
		});
        
});
})(jQuery, this);