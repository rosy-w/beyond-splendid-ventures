<?php
/**
 * Custom Widgets for Beyond Splendid Ventures Theme
 *
 * @package Hello Elementor Child
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Featured Tours Widget
 */
class BSV_Featured_Tours_Widget extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bsv_featured_tours',
            __('BSV: Featured Tours', 'hello-elementor-child'),
            array('description' => __('Displays a list of featured tours', 'hello-elementor-child'))
        );
    }
    
    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        
        $query_args = array(
            'post_type' => 'tour',
            'posts_per_page' => $number,
            'meta_key' => 'tour_featured',
            'meta_value' => '1',
            'post_status' => 'publish'
        );
        
        $tours = new WP_Query($query_args);
        
        if ($tours->have_posts()) : ?>
            <div class="widget-featured-tours">
                <?php while ($tours->have_posts()) : $tours->the_post(); ?>
                    <div class="widget-tour-item">
                        <div class="widget-tour-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-tour.jpg" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </a>
                            <?php 
                            $tour_price = get_post_meta(get_the_ID(), 'tour_price', true);
                            if ($tour_price) : 
                            ?>
                                <div class="widget-tour-price">$<?php echo esc_html($tour_price); ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="widget-tour-content">
                            <h4 class="widget-tour-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            
                            <div class="widget-tour-meta">
                                <?php 
                                $tour_duration = get_post_meta(get_the_ID(), 'tour_duration', true);
                                if ($tour_duration) : 
                                ?>
                                    <span class="widget-tour-duration">
                                        <i class="far fa-clock"></i> <?php echo esc_html($tour_duration); ?> <?php _e('Days', 'hello-elementor-child'); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                
                <?php if (!empty($instance['view_all_url'])) : ?>
                    <div class="widget-view-all">
                        <a href="<?php echo esc_url($instance['view_all_url']); ?>" class="btn btn-outline-primary btn-sm">
                            <?php echo !empty($instance['view_all_text']) ? esc_html($instance['view_all_text']) : __('View All Tours', 'hello-elementor-child'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php wp_reset_postdata();
        else : ?>
            <p><?php _e('No featured tours found.', 'hello-elementor-child'); ?></p>
        <?php endif;
        
        echo $args['after_widget'];
    }
    
    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Featured Tours', 'hello-elementor-child');
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        $view_all_text = !empty($instance['view_all_text']) ? $instance['view_all_text'] : __('View All Tours', 'hello-elementor-child');
        $view_all_url = !empty($instance['view_all_url']) ? $instance['view_all_url'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of tours to show:', 'hello-elementor-child'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_all_text')); ?>"><?php esc_html_e('View All Text:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_all_text')); ?>" name="<?php echo esc_attr($this->get_field_name('view_all_text')); ?>" type="text" value="<?php echo esc_attr($view_all_text); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_all_url')); ?>"><?php esc_html_e('View All URL:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_all_url')); ?>" name="<?php echo esc_attr($this->get_field_name('view_all_url')); ?>" type="url" value="<?php echo esc_url($view_all_url); ?>">
        </p>
        <?php
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = !empty($new_instance['number']) ? absint($new_instance['number']) : 3;
        $instance['view_all_text'] = !empty($new_instance['view_all_text']) ? sanitize_text_field($new_instance['view_all_text']) : '';
        $instance['view_all_url'] = !empty($new_instance['view_all_url']) ? esc_url_raw($new_instance['view_all_url']) : '';
        
        return $instance;
    }
}

/**
 * Featured Destinations Widget
 */
class BSV_Featured_Destinations_Widget extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bsv_featured_destinations',
            __('BSV: Featured Destinations', 'hello-elementor-child'),
            array('description' => __('Displays a list of featured destinations', 'hello-elementor-child'))
        );
    }
    
    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        
        $query_args = array(
            'post_type' => 'destination',
            'posts_per_page' => $number,
            'meta_key' => 'featured_destination',
            'meta_value' => '1',
            'post_status' => 'publish'
        );
        
        $destinations = new WP_Query($query_args);
        
        if ($destinations->have_posts()) : ?>
            <div class="widget-featured-destinations">
                <?php while ($destinations->have_posts()) : $destinations->the_post(); ?>
                    <div class="widget-destination-item">
                        <div class="widget-destination-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-destination.jpg" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <div class="widget-destination-content">
                            <h4 class="widget-destination-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            
                            <?php
                            $destination_location = get_post_meta(get_the_ID(), 'destination_location', true);
                            if ($destination_location) :
                            ?>
                                <div class="widget-destination-location">
                                    <i class="fas fa-map-marker-alt"></i> <?php echo esc_html($destination_location); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                
                <?php if (!empty($instance['view_all_url'])) : ?>
                    <div class="widget-view-all">
                        <a href="<?php echo esc_url($instance['view_all_url']); ?>" class="btn btn-outline-primary btn-sm">
                            <?php echo !empty($instance['view_all_text']) ? esc_html($instance['view_all_text']) : __('View All Destinations', 'hello-elementor-child'); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            <?php wp_reset_postdata();
        else : ?>
            <p><?php _e('No featured destinations found.', 'hello-elementor-child'); ?></p>
        <?php endif;
        
        echo $args['after_widget'];
    }
    
    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Featured Destinations', 'hello-elementor-child');
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        $view_all_text = !empty($instance['view_all_text']) ? $instance['view_all_text'] : __('View All Destinations', 'hello-elementor-child');
        $view_all_url = !empty($instance['view_all_url']) ? $instance['view_all_url'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of destinations to show:', 'hello-elementor-child'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_all_text')); ?>"><?php esc_html_e('View All Text:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_all_text')); ?>" name="<?php echo esc_attr($this->get_field_name('view_all_text')); ?>" type="text" value="<?php echo esc_attr($view_all_text); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_all_url')); ?>"><?php esc_html_e('View All URL:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_all_url')); ?>" name="<?php echo esc_attr($this->get_field_name('view_all_url')); ?>" type="url" value="<?php echo esc_url($view_all_url); ?>">
        </p>
        <?php
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = !empty($new_instance['number']) ? absint($new_instance['number']) : 3;
        $instance['view_all_text'] = !empty($new_instance['view_all_text']) ? sanitize_text_field($new_instance['view_all_text']) : '';
        $instance['view_all_url'] = !empty($new_instance['view_all_url']) ? esc_url_raw($new_instance['view_all_url']) : '';
        
        return $instance;
    }
}

/**
 * Recent Testimonials Widget
 */
class BSV_Recent_Testimonials_Widget extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bsv_recent_testimonials',
            __('BSV: Recent Testimonials', 'hello-elementor-child'),
            array('description' => __('Displays recent testimonials with a slider', 'hello-elementor-child'))
        );
    }
    
    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        
        $query_args = array(
            'post_type' => 'testimonial',
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'orderby' => 'date',
            'order' => 'DESC'
        );
        
        $testimonials = new WP_Query($query_args);
        
        if ($testimonials->have_posts()) : ?>
            <div class="widget-testimonials-slider">
                <?php while ($testimonials->have_posts()) : $testimonials->the_post(); ?>
                    <div class="widget-testimonial-item">
                        <div class="widget-testimonial-content">
                            <?php 
                            $excerpt = get_the_excerpt();
                            $excerpt = wp_trim_words($excerpt, 20, '...');
                            echo wpautop($excerpt);
                            ?>
                        </div>
                        
                        <div class="widget-testimonial-author">
                            <div class="widget-testimonial-author-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid rounded-circle')); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-avatar.jpg" alt="<?php the_title(); ?>" class="img-fluid rounded-circle">
                                <?php endif; ?>
                            </div>
                            
                            <div class="widget-testimonial-author-info">
                                <h5 class="widget-testimonial-author-name"><?php the_title(); ?></h5>
                                
                                <?php 
                                $tour = get_post_meta(get_the_ID(), 'testimonial_tour', true);
                                $location = get_post_meta(get_the_ID(), 'testimonial_location', true);
                                if ($tour || $location) :
                                ?>
                                    <div class="widget-testimonial-author-meta">
                                        <?php
                                        if ($tour) {
                                            echo esc_html($tour);
                                            
                                            if ($location) {
                                                echo ', ' . esc_html($location);
                                            }
                                        } elseif ($location) {
                                            echo esc_html($location);
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php 
                                $rating = get_post_meta(get_the_ID(), 'testimonial_rating', true);
                                if ($rating) :
                                ?>
                                    <div class="widget-testimonial-rating">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="fas fa-star"></i>';
                                            } else {
                                                echo '<i class="far fa-star"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            
            <?php wp_reset_postdata();
            
            // Add script to initialize the slider
            ?>
            <script>
                jQuery(document).ready(function($) {
                    if ($.fn.slick) {
                        $('.widget-testimonials-slider').slick({
                            dots: true,
                            arrows: false,
                            infinite: true,
                            speed: 500,
                            fade: true,
                            cssEase: 'linear',
                            autoplay: true,
                            autoplaySpeed: 5000
                        });
                    }
                });
            </script>
            <?php
            
            if (!empty($instance['view_all_url'])) : ?>
                <div class="widget-view-all">
                    <a href="<?php echo esc_url($instance['view_all_url']); ?>" class="btn btn-outline-primary btn-sm">
                        <?php echo !empty($instance['view_all_text']) ? esc_html($instance['view_all_text']) : __('View All Testimonials', 'hello-elementor-child'); ?>
                    </a>
                </div>
            <?php endif;
            
        else : ?>
            <p><?php _e('No testimonials found.', 'hello-elementor-child'); ?></p>
        <?php endif;
        
        echo $args['after_widget'];
    }
    
    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('What Our Clients Say', 'hello-elementor-child');
        $number = !empty($instance['number']) ? absint($instance['number']) : 3;
        $view_all_text = !empty($instance['view_all_text']) ? $instance['view_all_text'] : __('View All Testimonials', 'hello-elementor-child');
        $view_all_url = !empty($instance['view_all_url']) ? $instance['view_all_url'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of testimonials to show:', 'hello-elementor-child'); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_all_text')); ?>"><?php esc_html_e('View All Text:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_all_text')); ?>" name="<?php echo esc_attr($this->get_field_name('view_all_text')); ?>" type="text" value="<?php echo esc_attr($view_all_text); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('view_all_url')); ?>"><?php esc_html_e('View All URL:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('view_all_url')); ?>" name="<?php echo esc_attr($this->get_field_name('view_all_url')); ?>" type="url" value="<?php echo esc_url($view_all_url); ?>">
        </p>
        <?php
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number'] = !empty($new_instance['number']) ? absint($new_instance['number']) : 3;
        $instance['view_all_text'] = !empty($new_instance['view_all_text']) ? sanitize_text_field($new_instance['view_all_text']) : '';
        $instance['view_all_url'] = !empty($new_instance['view_all_url']) ? esc_url_raw($new_instance['view_all_url']) : '';
        
        return $instance;
    }
}

/**
 * Tour Search Widget
 */
class BSV_Tour_Search_Widget extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bsv_tour_search',
            __('BSV: Tour Search', 'hello-elementor-child'),
            array('description' => __('Displays a search form for tours', 'hello-elementor-child'))
        );
    }
    
    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        // Get all destination categories
        $destinations = get_terms(array(
            'taxonomy' => 'destination_category',
            'hide_empty' => true,
        ));
        
        // Get search form template part with custom arguments
        $search_args = array(
            'type' => 'tour',
            'class' => 'widget-tour-search',
            'placeholder' => !empty($instance['placeholder']) ? $instance['placeholder'] : __('Search tours...', 'hello-elementor-child')
        );
        
        set_query_var('args', $search_args);
        get_template_part('template-parts/search-form');
        
        echo $args['after_widget'];
    }
    
    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Find Your Tour', 'hello-elementor-child');
        $placeholder = !empty($instance['placeholder']) ? $instance['placeholder'] : __('Search tours...', 'hello-elementor-child');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('placeholder')); ?>"><?php esc_html_e('Search Placeholder:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('placeholder')); ?>" name="<?php echo esc_attr($this->get_field_name('placeholder')); ?>" type="text" value="<?php echo esc_attr($placeholder); ?>">
        </p>
        <?php
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['placeholder'] = !empty($new_instance['placeholder']) ? sanitize_text_field($new_instance['placeholder']) : '';
        
        return $instance;
    }
}

/**
 * Contact Information Widget
 */
class BSV_Contact_Info_Widget extends WP_Widget {
    
    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'bsv_contact_info',
            __('BSV: Contact Information', 'hello-elementor-child'),
            array('description' => __('Displays contact information with icons', 'hello-elementor-child'))
        );
    }
    
    /**
     * Front-end display of widget.
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        
        ?>
        <div class="widget-contact-info">
            <?php if (!empty($instance['address'])) : ?>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-info-text">
                        <?php echo wpautop(esc_html($instance['address'])); ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($instance['phone'])) : ?>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contact-info-text">
                        <p>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $instance['phone'])); ?>">
                                <?php echo esc_html($instance['phone']); ?>
                            </a>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($instance['email'])) : ?>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-info-text">
                        <p>
                            <a href="mailto:<?php echo esc_attr($instance['email']); ?>">
                                <?php echo esc_html($instance['email']); ?>
                            </a>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($instance['hours'])) : ?>
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contact-info-text">
                        <?php echo wpautop(esc_html($instance['hours'])); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($instance['show_social']) && $instance['show_social'] == 1) : ?>
            <div class="widget-social-icons">
                <?php if (!empty($instance['facebook'])) : ?>
                    <a href="<?php echo esc_url($instance['facebook']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($instance['twitter'])) : ?>
                    <a href="<?php echo esc_url($instance['twitter']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-twitter"></i>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($instance['instagram'])) : ?>
                    <a href="<?php echo esc_url($instance['instagram']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-instagram"></i>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($instance['youtube'])) : ?>
                    <a href="<?php echo esc_url($instance['youtube']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-youtube"></i>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($instance['linkedin'])) : ?>
                    <a href="<?php echo esc_url($instance['linkedin']); ?>" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <?php
        
        echo $args['after_widget'];
    }
    
    /**
     * Back-end widget form.
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('Contact Us', 'hello-elementor-child');
        $address = !empty($instance['address']) ? $instance['address'] : '';
        $phone = !empty($instance['phone']) ? $instance['phone'] : '';
        $email = !empty($instance['email']) ? $instance['email'] : '';
        $hours = !empty($instance['hours']) ? $instance['hours'] : '';
        $show_social = isset($instance['show_social']) ? (bool) $instance['show_social'] : false;
        $facebook = !empty($instance['facebook']) ? $instance['facebook'] : '';
        $twitter = !empty($instance['twitter']) ? $instance['twitter'] : '';
        $instagram = !empty($instance['instagram']) ? $instance['instagram'] : '';
        $youtube = !empty($instance['youtube']) ? $instance['youtube'] : '';
        $linkedin = !empty($instance['linkedin']) ? $instance['linkedin'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('Address:', 'hello-elementor-child'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>" rows="3"><?php echo esc_textarea($address); ?></textarea>
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('Phone:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('Email:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="email" value="<?php echo esc_attr($email); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('hours')); ?>"><?php esc_html_e('Business Hours:', 'hello-elementor-child'); ?></label>
            <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id('hours')); ?>" name="<?php echo esc_attr($this->get_field_name('hours')); ?>" rows="3"><?php echo esc_textarea($hours); ?></textarea>
        </p>
        
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_social); ?> id="<?php echo esc_attr($this->get_field_id('show_social')); ?>" name="<?php echo esc_attr($this->get_field_name('show_social')); ?>" value="1">
            <label for="<?php echo esc_attr($this->get_field_id('show_social')); ?>"><?php esc_html_e('Show Social Icons', 'hello-elementor-child'); ?></label>
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook URL:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="url" value="<?php echo esc_url($facebook); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter URL:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="url" value="<?php echo esc_url($twitter); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_html_e('Instagram URL:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="url" value="<?php echo esc_url($instagram); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('YouTube URL:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="url" value="<?php echo esc_url($youtube); ?>">
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('LinkedIn URL:', 'hello-elementor-child'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="url" value="<?php echo esc_url($linkedin); ?>">
        </p>
        <?php
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
        $instance['address'] = !empty($new_instance['address']) ? sanitize_textarea_field($new_instance['address']) : '';
        $instance['phone'] = !empty($new_instance['phone']) ? sanitize_text_field($new_instance['phone']) : '';
        $instance['email'] = !empty($new_instance['email']) ? sanitize_email($new_instance['email']) : '';
        $instance['hours'] = !empty($new_instance['hours']) ? sanitize_textarea_field($new_instance['hours']) : '';
        $instance['show_social'] = !empty($new_instance['show_social']) ? 1 : 0;
        $instance['facebook'] = !empty($new_instance['facebook']) ? esc_url_raw($new_instance['facebook']) : '';
        $instance['twitter'] = !empty($new_instance['twitter']) ? esc_url_raw($new_instance['twitter']) : '';
        $instance['instagram'] = !empty($new_instance['instagram']) ? esc_url_raw($new_instance['instagram']) : '';
        $instance['youtube'] = !empty($new_instance['youtube']) ? esc_url_raw($new_instance['youtube']) : '';
        $instance['linkedin'] = !empty($new_instance['linkedin']) ? esc_url_raw($new_instance['linkedin']) : '';
        
        return $instance;
    }
}

/**
 * Register all widgets
 */
function bsv_register_widgets() {
    register_widget('BSV_Featured_Tours_Widget');
    register_widget('BSV_Featured_Destinations_Widget');
    register_widget('BSV_Recent_Testimonials_Widget');
    register_widget('BSV_Tour_Search_Widget');
    register_widget('BSV_Contact_Info_Widget');
}
add_action('widgets_init', 'bsv_register_widgets');

/**
 * Add widget styles
 */
function bsv_widget_styles() {
    ?>
    <style>
        /* Featured Tours Widget */
        .widget-featured-tours .widget-tour-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .widget-featured-tours .widget-tour-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .widget-featured-tours .widget-tour-image {
            flex: 0 0 80px;
            margin-right: 15px;
            position: relative;
        }
        
        .widget-featured-tours .widget-tour-image img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .widget-featured-tours .widget-tour-price {
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--primary-color);
            color: white;
            font-size: 12px;
            padding: 2px 5px;
            border-radius: 0 4px 0 4px;
        }
        
        .widget-featured-tours .widget-tour-content {
            flex: 1;
        }
        
        .widget-featured-tours .widget-tour-title {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 5px;
        }
        
        .widget-featured-tours .widget-tour-meta {
            color: #777;
            font-size: 13px;
        }
        
        .widget-featured-tours .widget-view-all {
            margin-top: 20px;
            text-align: center;
        }
        
        /* Featured Destinations Widget */
        .widget-featured-destinations .widget-destination-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .widget-featured-destinations .widget-destination-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .widget-featured-destinations .widget-destination-image {
            flex: 0 0 80px;
            margin-right: 15px;
        }
        
        .widget-featured-destinations .widget-destination-image img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .widget-featured-destinations .widget-destination-content {
            flex: 1;
        }
        
        .widget-featured-destinations .widget-destination-title {
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 5px;
        }
        
        .widget-featured-destinations .widget-destination-location {
            color: #777;
            font-size: 13px;
        }
        
        .widget-featured-destinations .widget-view-all {
            margin-top: 20px;
            text-align: center;
        }
        
        /* Testimonials Widget */
        .widget-testimonials-slider {
            margin-bottom: 20px;
        }
        
        .widget-testimonial-content {
            font-style: italic;
            color: #555;
            margin-bottom: 15px;
            position: relative;
            padding-left: 20px;
            padding-right: 20px;
        }
        
        .widget-testimonial-content:before {
            content: """;
            font-size: 40px;
            font-family: Georgia, serif;
            color: var(--accent-color);
            position: absolute;
            top: -10px;
            left: 0;
            line-height: 1;
        }
        
        .widget-testimonial-content:after {
            content: """;
            font-size: 40px;
            font-family: Georgia, serif;
            color: var(--accent-color);
            position: absolute;
            bottom: -10px;
            right: 0;
            line-height: 0;
        }
        
        .widget-testimonial-author {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }
        
        .widget-testimonial-author-image {
            flex: 0 0 50px;
            margin-right: 10px;
        }
        
        .widget-testimonial-author-image img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid var(--primary-color);
        }
        
        .widget-testimonial-author-info {
            flex: 1;
        }
        
        .widget-testimonial-author-name {
            font-size: 14px;
            font-weight: 600;
            margin: 0;
        }
        
        .widget-testimonial-author-meta {
            color: #777;
            font-size: 12px;
        }
        
        .widget-testimonial-rating {
            color: #ffb900;
            font-size: 12px;
        }
        
        /* Tour Search Widget */
        .widget-tour-search .form-group {
            margin-bottom: 10px;
        }
        
        .widget-tour-search label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
        }
        
        /* Contact Info Widget */
        .widget-contact-info .contact-info-item {
            display: flex;
            margin-bottom: 15px;
        }
        
        .widget-contact-info .contact-info-icon {
            flex: 0 0 40px;
            height: 40px;
            background-color: var(--primary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin-right: 15px;
        }
        
        .widget-contact-info .contact-info-text {
            flex: 1;
        }
        
        .widget-contact-info .contact-info-text p {
            margin: 0;
        }
        
        .widget-social-icons {
            margin-top: 20px;
        }
        
        .widget-social-icons a {
            display: inline-block;
            width: 35px;
            height: 35px;
            line-height: 35px;
            text-align: center;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            margin-right: 10px;
            transition: all 0.3s ease;
        }
        
        .widget-social-icons a:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
        }
    </style>
    <?php
}
add_action('wp_head', 'bsv_widget_styles');
