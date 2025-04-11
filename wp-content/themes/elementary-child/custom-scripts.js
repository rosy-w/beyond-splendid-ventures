/**
 * Custom JavaScript for Beyond Splendid Ventures
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        // Main navigation toggle for mobile
        $('.menu-toggle').on('click', function() {
            $(this).toggleClass('active');
            $('.main-navigation').toggleClass('active');
        });
        
        // Smooth scroll for anchor links
        $('a[href*="#"]:not([href="#"])').on('click', function() {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html, body').animate({
                        scrollTop: target.offset().top - 70
                    }, 1000);
                    return false;
                }
            }
        });
        
        // Initialize testimonial slider if slick is available
        if ($.fn.slick) {
            $('.testimonial-slider').slick({
                dots: true,
                arrows: false,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                fade: true,
                cssEase: 'linear',
                adaptiveHeight: true
            });
        }
        
        // Initialize featured destinations slider if slick is available
        if ($.fn.slick) {
            $('.destinations-slider').slick({
                dots: false,
                arrows: true,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 5000,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
        
        // Tour filtering
        $('.tour-filter-button').on('click', function() {
            var filterValue = $(this).attr('data-filter');
            
            // Toggle active class
            $('.tour-filter-button').removeClass('active');
            $(this).addClass('active');
            
            if (filterValue === 'all') {
                $('.tour-card').show();
            } else {
                $('.tour-card').hide();
                $('.tour-card[data-category="' + filterValue + '"]').show();
            }
            
            return false;
        });
        
        // Sticky header
        var header = $('.site-header');
        var headerOffset = header.offset().top;
        
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > headerOffset) {
                header.addClass('sticky');
                $('body').addClass('has-sticky-header');
            } else {
                header.removeClass('sticky');
                $('body').removeClass('has-sticky-header');
            }
        });
        
        // Initialize lightbox for gallery images if fancybox is available
        if ($.fn.fancybox) {
            $('.gallery-item a').fancybox({
                protect: true,
                buttons: [
                    'zoom',
                    'slideShow',
                    'fullScreen',
                    'thumbs',
                    'close'
                ]
            });
        }
        
        // Lazy load images
        if ('loading' in HTMLImageElement.prototype) {
            const images = document.querySelectorAll('img[loading="lazy"]');
            images.forEach(img => {
                img.src = img.dataset.src;
            });
        } else {
            // Fallback for browsers that don't support lazy loading
            if ($.fn.lazyload) {
                $('img.lazy').lazyload({
                    effect: 'fadeIn',
                    threshold: 200
                });
            }
        }
        
        // Tour booking date picker
        if ($.fn.datepicker) {
            $('.datepicker').datepicker({
                dateFormat: 'mm/dd/yy',
                minDate: 0,
                showOtherMonths: true,
                selectOtherMonths: true
            });
        }
        
        // Tour booking form validation
        $('#booking-form').on('submit', function(e) {
            var valid = true;
            
            // Basic validation
            $(this).find('.required').each(function() {
                if ($(this).val() === '') {
                    $(this).addClass('error');
                    valid = false;
                } else {
                    $(this).removeClass('error');
                }
            });
            
            if (!valid) {
                e.preventDefault();
                $('.form-error-message').show();
            } else {
                $('.form-error-message').hide();
            }
        });
        
        // Contact form validation
        $('#contact-form').on('submit', function(e) {
            var valid = true;
            
            // Basic validation
            $(this).find('.required').each(function() {
                if ($(this).val() === '') {
                    $(this).addClass('error');
                    valid = false;
                } else {
                    $(this).removeClass('error');
                }
            });
            
            // Email validation
            var emailField = $(this).find('input[type="email"]');
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            
            if (!emailPattern.test(emailField.val())) {
                emailField.addClass('error');
                valid = false;
            } else {
                emailField.removeClass('error');
            }
            
            if (!valid) {
                e.preventDefault();
                $('.form-error-message').show();
            } else {
                $('.form-error-message').hide();
            }
        });
        
        // Back to top button
        var backToTop = $('#back-to-top');
        
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 300) {
                backToTop.addClass('show');
            } else {
                backToTop.removeClass('show');
            }
        });
        
        backToTop.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 800);
        });
        
        // Initialize tooltips if bootstrap is available
        if ($.fn.tooltip) {
            $('[data-toggle="tooltip"]').tooltip();
        }
        
        // Initialize popovers if bootstrap is available
        if ($.fn.popover) {
            $('[data-toggle="popover"]').popover();
        }
        
        // Search toggle
        $('.search-toggle').on('click', function(e) {
            e.preventDefault();
            $('.search-form-container').toggleClass('active');
        });
        
        // Close search on escape key
        $(document).on('keydown', function(e) {
            if (e.keyCode === 27) {
                $('.search-form-container').removeClass('active');
            }
        });
        
        // Mobile submenu toggle
        $('.menu-item-has-children > a').on('click', function(e) {
            if ($(window).width() < 992) {
                e.preventDefault();
                $(this).parent().toggleClass('submenu-open');
                $(this).siblings('.sub-menu').slideToggle();
            }
        });
    });

    // Window load functions
    $(window).on('load', function() {
        // Remove page loader
        $('.page-loader').fadeOut();
    });

})(jQuery);
