/**
 * BSV Elementor Widgets - Testimonials JavaScript
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Initialize testimonial sliders
        $('.bsv-testimonial-slider').each(function() {
            var $slider = $(this);
            
            // Check if slider was already initialized
            if ($slider.hasClass('slick-initialized')) {
                return;
            }
            
            // Default settings
            var defaults = {
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                pauseOnHover: true,
                infinite: true,
                arrows: true,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    }
                ]
            };
            
            // Get settings from data attribute if available
            var settings = $slider.data('settings') || {};
            
            // Merge default settings with custom settings
            settings = $.extend({}, defaults, settings);
            
            // Initialize slick slider
            $slider.slick(settings);
        });
    });
    
    // Re-initialize sliders after Elementor editor changes
    if (window.elementorFrontend && window.elementorFrontend.hooks) {
        elementorFrontend.hooks.addAction('frontend/element_ready/bsv_testimonials.default', function($scope) {
            var $slider = $scope.find('.bsv-testimonial-slider');
            
            // Destroy existing slider
            if ($slider.hasClass('slick-initialized')) {
                $slider.slick('unslick');
            }
            
            // Default settings
            var defaults = {
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                pauseOnHover: true,
                infinite: true,
                arrows: true,
                dots: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false
                        }
                    }
                ]
            };
            
            // Get settings from data attribute if available
            var settings = $slider.data('settings') || {};
            
            // Merge default settings with custom settings
            settings = $.extend({}, defaults, settings);
            
            // Initialize slick slider
            $slider.slick(settings);
        });
    }
    
})(jQuery);