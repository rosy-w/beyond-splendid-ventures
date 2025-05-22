/**
 * BSV Elementor Widgets - Common JavaScript
 */

(function($) {
    'use strict';
    
    /**
     * Initialize widgets when Elementor frontend is loaded
     */
    $(window).on('elementor/frontend/init', function() {
        // Initialize the tours widget
        elementorFrontend.hooks.addAction('frontend/element_ready/bsv_tours.default', function($scope) {
            // Add hover effects and other functionality if needed
            initTourWidgets($scope);
        });
        
        // Initialize the destinations widget
        elementorFrontend.hooks.addAction('frontend/element_ready/bsv_destinations.default', function($scope) {
            // Add hover effects and other functionality if needed
            initDestinationWidgets($scope);
        });
        
        // Initialize the testimonials widget
        elementorFrontend.hooks.addAction('frontend/element_ready/bsv_testimonials.default', function($scope) {
            // Initialize slider
            initTestimonialSlider($scope);
        });
    });
    
    /**
     * Initialize tour widgets
     */
    function initTourWidgets($scope) {
        var $tourCards = $scope.find('.bsv-tour-card');
        
        // Handle tour card hover effects
        $tourCards.on('mouseenter', function() {
            $(this).addClass('bsv-tour-card-hover');
        }).on('mouseleave', function() {
            $(this).removeClass('bsv-tour-card-hover');
        });
        
        // Any additional functionality for tours widget
    }
    
    /**
     * Initialize destination widgets
     */
    function initDestinationWidgets($scope) {
        var $destinationCards = $scope.find('.bsv-destination-card');
        
        // Handle destination card hover effects
        $destinationCards.on('mouseenter', function() {
            $(this).addClass('bsv-destination-card-hover');
        }).on('mouseleave', function() {
            $(this).removeClass('bsv-destination-card-hover');
        });
        
        // Any additional functionality for destinations widget
    }
    
    /**
     * Initialize testimonial slider
     */
    function initTestimonialSlider($scope) {
        var $slider = $scope.find('.bsv-testimonial-slider');
        
        // Check if slider exists and slick is available
        if ($slider.length && typeof $.fn.slick !== 'undefined') {
            // Get slider settings
            var sliderSettings = $slider.data('settings') || {};
            
            // Initialize slick slider with settings
            $slider.slick(sliderSettings);
        }
    }
    
})(jQuery);