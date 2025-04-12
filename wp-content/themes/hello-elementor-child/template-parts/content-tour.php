<?php
/**
 * Template part for displaying tour content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elementary Child
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('tour-single'); ?>>
    <div class="tour-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        
                        <div class="tour-meta">
                            <?php
                            // Get tour details
                            $tour_duration = get_post_meta(get_the_ID(), 'tour_duration', true);
                            $tour_group_size = get_post_meta(get_the_ID(), 'tour_group_size', true);
                            $tour_difficulty = get_post_meta(get_the_ID(), 'tour_difficulty', true);
                            ?>
                            
                            <?php if ($tour_duration) : ?>
                                <div class="tour-meta-item">
                                    <i class="far fa-clock"></i>
                                    <span><?php echo esc_html($tour_duration); ?> Days</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($tour_group_size) : ?>
                                <div class="tour-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>Max <?php echo esc_html($tour_group_size); ?> People</span>
                                </div>
                            <?php endif; ?>
                            
                            <?php if ($tour_difficulty) : ?>
                                <div class="tour-meta-item">
                                    <i class="fas fa-signal"></i>
                                    <span><?php echo esc_html($tour_difficulty); ?></span>
                                </div>
                            <?php endif; ?>
                            
                            <?php
                            // Get destination categories
                            $destinations = get_the_terms(get_the_ID(), 'destination_category');
                            if ($destinations && !is_wp_error($destinations)) :
                            ?>
                                <div class="tour-meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>
                                        <?php
                                        $destination_links = array();
                                        foreach ($destinations as $destination) {
                                            $destination_links[] = '<a href="' . esc_url(get_term_link($destination)) . '">' . esc_html($destination->name) . '</a>';
                                        }
                                        echo implode(', ', $destination_links);
                                        ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </header><!-- .entry-header -->
                </div>
                
                <div class="col-md-4">
                    <div class="tour-price-box">
                        <?php
                        $tour_price = get_post_meta(get_the_ID(), 'tour_price', true);
                        if ($tour_price) :
                        ?>
                            <div class="tour-price">
                                <span class="price-label">From</span>
                                <span class="price-value">$<?php echo esc_html($tour_price); ?></span>
                                <span class="price-unit">per person</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="tour-actions">
                            <a href="#booking-form" class="btn btn-primary btn-book-now">Book Now</a>
                            <a href="#tour-dates" class="btn btn-outline-primary btn-view-dates">View Dates</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (has_post_thumbnail()) : ?>
        <div class="tour-featured-image">
            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
        </div>
    <?php endif; ?>

    <div class="tour-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tour-tabs">
                        <ul class="nav nav-tabs" id="tourTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="itinerary-tab" data-toggle="tab" href="#itinerary" role="tab" aria-controls="itinerary" aria-selected="false">Itinerary</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="includes-tab" data-toggle="tab" href="#includes" role="tab" aria-controls="includes" aria-selected="false">Includes/Excludes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="tourTabsContent">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                <div class="tour-overview">
                                    <?php the_content(); ?>
                                    
                                    <?php
                                    // Tour highlights
                                    $tour_highlights = get_post_meta(get_the_ID(), 'tour_highlights', true);
                                    if ($tour_highlights) :
                                    ?>
                                        <div class="tour-highlights">
                                            <h3>Tour Highlights</h3>
                                            <?php echo wpautop($tour_highlights); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="itinerary" role="tabpanel" aria-labelledby="itinerary-tab">
                                <?php
                                // Tour itinerary
                                $tour_itinerary = get_post_meta(get_the_ID(), 'tour_itinerary', true);
                                if ($tour_itinerary) :
                                    echo '<div class="tour-itinerary">';
                                    echo wpautop($tour_itinerary);
                                    echo '</div>';
                                else :
                                    // Get repeater field if using ACF
                                    if (function_exists('have_rows') && have_rows('itinerary_days')) :
                                    ?>
                                        <div class="tour-itinerary">
                                            <div class="itinerary-timeline">
                                                <?php
                                                $day_count = 1;
                                                while (have_rows('itinerary_days')) : the_row();
                                                    $day_title = get_sub_field('day_title');
                                                    $day_description = get_sub_field('day_description');
                                                    $day_meals = get_sub_field('day_meals');
                                                    $day_accommodation = get_sub_field('day_accommodation');
                                                ?>
                                                    <div class="itinerary-day">
                                                        <div class="day-number">Day <?php echo $day_count; ?></div>
                                                        <div class="day-content">
                                                            <h3><?php echo esc_html($day_title); ?></h3>
                                                            <div class="day-description">
                                                                <?php echo wpautop($day_description); ?>
                                                            </div>
                                                            
                                                            <?php if ($day_meals || $day_accommodation) : ?>
                                                                <div class="day-details">
                                                                    <?php if ($day_meals) : ?>
                                                                        <div class="day-meals">
                                                                            <i class="fas fa-utensils"></i>
                                                                            <span>Meals: <?php echo esc_html($day_meals); ?></span>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    
                                                                    <?php if ($day_accommodation) : ?>
                                                                        <div class="day-accommodation">
                                                                            <i class="fas fa-bed"></i>
                                                                            <span>Accommodation: <?php echo esc_html($day_accommodation); ?></span>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                    $day_count++;
                                                endwhile;
                                                ?>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <p>Detailed itinerary information will be provided upon booking.</p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            
                            <div class="tab-pane fade" id="includes" role="tabpanel" aria-labelledby="includes-tab">
                                <div class="row">
                                    <?php
                                    // Tour includes
                                    $tour_includes = get_post_meta(get_the_ID(), 'tour_includes', true);
                                    if ($tour_includes) :
                                    ?>
                                        <div class="col-md-6">
                                            <div class="tour-includes">
                                                <h3>Tour Includes</h3>
                                                <?php echo wpautop($tour_includes); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php
                                    // Tour excludes
                                    $tour_excludes = get_post_meta(get_the_ID(), 'tour_excludes', true);
                                    if ($tour_excludes) :
                                    ?>
                                        <div class="col-md-6">
                                            <div class="tour-excludes">
                                                <h3>Tour Excludes</h3>
                                                <?php echo wpautop($tour_excludes); ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                                <?php
                                // Tour gallery
                                $gallery_images = get_post_meta(get_the_ID(), 'tour_gallery', true);
                                
                                if ($gallery_images) :
                                    // If using a custom field for gallery
                                    $gallery_array = explode(',', $gallery_images);
                                    if (!empty($gallery_array)) :
                                    ?>
                                        <div class="tour-gallery">
                                            <div class="row">
                                                <?php foreach ($gallery_array as $image_id) : ?>
                                                    <div class="col-md-4 gallery-item">
                                                        <a href="<?php echo esc_url(wp_get_attachment_url($image_id)); ?>" class="gallery-image">
                                                            <?php echo wp_get_attachment_image($image_id, 'large', false, array('class' => 'img-fluid')); ?>
                                                        </a>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php
                                // Check if using ACF gallery field
                                elseif (function_exists('get_field') && get_field('tour_gallery')) :
                                    $images = get_field('tour_gallery');
                                    if ($images) :
                                    ?>
                                        <div class="tour-gallery">
                                            <div class="row">
                                                <?php foreach ($images as $image) : ?>
                                                    <div class="col-md-4 gallery-item">
                                                        <a href="<?php echo esc_url($image['url']); ?>" class="gallery-image">
                                                            <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="img-fluid">
                                                        </a>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <p>No gallery images available for this tour.</p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="tour-reviews">
                                    <?php
                                    // If comments are open or we have at least one comment, load up the comment template.
                                    if (comments_open() || get_comments_number()) :
                                        comments_template();
                                    else :
                                    ?>
                                        <div class="no-reviews">
                                            <p>No reviews available for this tour yet. Be the first to share your experience!</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="tour-sidebar">
                        <div class="sidebar-widget tour-booking" id="booking-form">
                            <h3>Book This Tour</h3>
                            
                            <?php
                            // Check if using a booking plugin
                            if (function_exists('WC') && class_exists('WC_Product_Booking')) :
                                // Output WooCommerce booking form
                                wc_get_template_part('single-product/add-to-cart/booking');
                            else :
                            ?>
                                <form class="booking-form" action="#" method="post">
                                    <div class="form-group">
                                        <label for="booking_name">Full Name *</label>
                                        <input type="text" id="booking_name" name="booking_name" class="form-control required" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="booking_email">Email Address *</label>
                                        <input type="email" id="booking_email" name="booking_email" class="form-control required" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="booking_phone">Phone Number *</label>
                                        <input type="tel" id="booking_phone" name="booking_phone" class="form-control required" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="booking_date">Tour Date *</label>
                                        <input type="text" id="booking_date" name="booking_date" class="form-control datepicker required" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="booking_travelers">Number of Travelers *</label>
                                        <select id="booking_travelers" name="booking_travelers" class="form-control required" required>
                                            <option value="">Select</option>
                                            <option value="1">1 Person</option>
                                            <option value="2">2 People</option>
                                            <option value="3">3 People</option>
                                            <option value="4">4 People</option>
                                            <option value="5">5 People</option>
                                            <option value="6+">6+ People</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="booking_message">Special Requirements</label>
                                        <textarea id="booking_message" name="booking_message" class="form-control" rows="3"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input required" id="booking_terms" name="booking_terms" required>
                                            <label class="custom-control-label" for="booking_terms">I agree to the <a href="/terms-conditions">terms and conditions</a> *</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-error-message" style="display: none;">
                                        <p class="text-danger">Please fill all required fields correctly.</p>
                                    </div>
                                    
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-block">Book Now</button>
                                    </div>
                                </form>
                            <?php endif; ?>
                        </div>
                        
                        <div class="sidebar-widget tour-dates" id="tour-dates">
                            <h3>Upcoming Departures</h3>
                            
                            <?php
                            // Tour dates
                            $tour_dates = get_post_meta(get_the_ID(), 'tour_dates', true);
                            
                            if ($tour_dates) :
                                echo wpautop($tour_dates);
                            elseif (function_exists('have_rows') && have_rows('departure_dates')) :
                            ?>
                                <ul class="departure-list">
                                    <?php while (have_rows('departure_dates')) : the_row();
                                        $date = get_sub_field('date');
                                        $price = get_sub_field('price');
                                        $availability = get_sub_field('availability');
                                    ?>
                                        <li class="departure-item">
                                            <div class="departure-date"><?php echo esc_html($date); ?></div>
                                            <?php if ($price) : ?>
                                                <div class="departure-price">$<?php echo esc_html($price); ?></div>
                                            <?php endif; ?>
                                            <div class="departure-availability <?php echo ($availability == 'Available') ? 'available' : 'limited'; ?>">
                                                <?php echo esc_html($availability); ?>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php else : ?>
                                <p>Please contact us for upcoming departure dates and availability.</p>
                            <?php endif; ?>
                        </div>
                        
                        <div class="sidebar-widget tour-map">
                            <h3>Tour Map</h3>
                            
                            <?php
                            // Tour map
                            $tour_map = get_post_meta(get_the_ID(), 'tour_map', true);
                            
                            if ($tour_map) :
                                echo '<div class="tour-map-image">';
                                echo wp_get_attachment_image($tour_map, 'large', false, array('class' => 'img-fluid'));
                                echo '</div>';
                            elseif (function_exists('get_field') && get_field('tour_map')) :
                                $map_image = get_field('tour_map');
                                echo '<div class="tour-map-image">';
                                echo '<img src="' . esc_url($map_image['url']) . '" alt="Tour Map" class="img-fluid">';
                                echo '</div>';
                            else :
                                // Try to get Google Maps location
                                $location = get_post_meta(get_the_ID(), 'tour_location', true);
                                if ($location && function_exists('get_field') && get_field('google_maps_api_key', 'option')) :
                                    echo do_shortcode('[acf_map field="tour_location" height="300px"]');
                                else :
                                    echo '<p>Map details not available for this tour.</p>';
                                endif;
                            endif;
                            ?>
                        </div>
                        
                        <div class="sidebar-widget tour-share">
                            <h3>Share This Tour</h3>
                            
                            <div class="social-share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="btn btn-facebook" target="_blank">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="btn btn-twitter" target="_blank">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url(get_the_post_thumbnail_url()); ?>&description=<?php the_title(); ?>" class="btn btn-pinterest" target="_blank">
                                    <i class="fab fa-pinterest-p"></i> Pinterest
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Related Tours Section
    ?>
    <section class="related-tours">
        <div class="container">
            <div class="section-title">
                <h2>You May Also Like</h2>
                <p class="section-subtitle">Explore similar tours that might interest you</p>
            </div>
            
            <div class="row">
                <?php
                // Get related tours based on destination category
                $destinations = get_the_terms(get_the_ID(), 'destination_category');
                
                if ($destinations && !is_wp_error($destinations)) {
                    $destination_ids = array();
                    foreach ($destinations as $destination) {
                        $destination_ids[] = $destination->term_id;
                    }
                    
                    $args = array(
                        'post_type' => 'tour',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'destination_category',
                                'field' => 'term_id',
                                'terms' => $destination_ids,
                            ),
                        ),
                    );
                    
                    $related_tours = new WP_Query($args);
                    
                    if ($related_tours->have_posts()) :
                        while ($related_tours->have_posts()) : $related_tours->the_post();
                            ?>
                            <div class="col-md-4">
                                <div class="tour-card">
                                    <div class="tour-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('tour-thumbnail'); ?>" alt="<?php the_title(); ?>">
                                        <?php else : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-tour.jpg" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        
                                        <?php 
                                        $tour_price = get_post_meta(get_the_ID(), 'tour_price', true);
                                        if ($tour_price) : 
                                            ?>
                                            <div class="tour-price">$<?php echo esc_html($tour_price); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tour-details">
                                        <h3 class="tour-title"><?php the_title(); ?></h3>
                                        <div class="tour-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                                        
                                        <div class="tour-meta">
                                            <?php 
                                            $tour_duration = get_post_meta(get_the_ID(), 'tour_duration', true);
                                            if ($tour_duration) : 
                                                ?>
                                                <div class="tour-meta-item">
                                                    <i class="far fa-clock"></i> <?php echo esc_html($tour_duration); ?> Days
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php 
                                            $tour_difficulty = get_post_meta(get_the_ID(), 'tour_difficulty', true);
                                            if ($tour_difficulty) : 
                                                ?>
                                                <div class="tour-meta-item">
                                                    <i class="fas fa-signal"></i> <?php echo esc_html($tour_difficulty); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <a href="<?php the_permalink(); ?>" class="tour-button">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // If no related tours, show random tours
                        $args = array(
                            'post_type' => 'tour',
                            'posts_per_page' => 3,
                            'post__not_in' => array(get_the_ID()),
                            'orderby' => 'rand',
                        );
                        
                        $random_tours = new WP_Query($args);
                        
                        if ($random_tours->have_posts()) :
                            while ($random_tours->have_posts()) : $random_tours->the_post();
                                ?>
                                <div class="col-md-4">
                                    <div class="tour-card">
                                        <div class="tour-image">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php the_post_thumbnail_url('tour-thumbnail'); ?>" alt="<?php the_title(); ?>">
                                            <?php else : ?>
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-tour.jpg" alt="<?php the_title(); ?>">
                                            <?php endif; ?>
                                            
                                            <?php 
                                            $tour_price = get_post_meta(get_the_ID(), 'tour_price', true);
                                            if ($tour_price) : 
                                                ?>
                                                <div class="tour-price">$<?php echo esc_html($tour_price); ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="tour-details">
                                            <h3 class="tour-title"><?php the_title(); ?></h3>
                                            <div class="tour-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                                            
                                            <div class="tour-meta">
                                                <?php 
                                                $tour_duration = get_post_meta(get_the_ID(), 'tour_duration', true);
                                                if ($tour_duration) : 
                                                    ?>
                                                    <div class="tour-meta-item">
                                                        <i class="far fa-clock"></i> <?php echo esc_html($tour_duration); ?> Days
                                                    </div>
                                                <?php endif; ?>
                                                
                                                <?php 
                                                $tour_difficulty = get_post_meta(get_the_ID(), 'tour_difficulty', true);
                                                if ($tour_difficulty) : 
                                                    ?>
                                                    <div class="tour-meta-item">
                                                        <i class="fas fa-signal"></i> <?php echo esc_html($tour_difficulty); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <a href="<?php the_permalink(); ?>" class="tour-button">View Details</a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    endif;
                } else {
                    // If no destination categories, show random tours
                    $args = array(
                        'post_type' => 'tour',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand',
                    );
                    
                    $random_tours = new WP_Query($args);
                    
                    if ($random_tours->have_posts()) :
                        while ($random_tours->have_posts()) : $random_tours->the_post();
                            ?>
                            <div class="col-md-4">
                                <div class="tour-card">
                                    <div class="tour-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('tour-thumbnail'); ?>" alt="<?php the_title(); ?>">
                                        <?php else : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-tour.jpg" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        
                                        <?php 
                                        $tour_price = get_post_meta(get_the_ID(), 'tour_price', true);
                                        if ($tour_price) : 
                                            ?>
                                            <div class="tour-price">$<?php echo esc_html($tour_price); ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="tour-details">
                                        <h3 class="tour-title"><?php the_title(); ?></h3>
                                        <div class="tour-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                                        
                                        <div class="tour-meta">
                                            <?php 
                                            $tour_duration = get_post_meta(get_the_ID(), 'tour_duration', true);
                                            if ($tour_duration) : 
                                                ?>
                                                <div class="tour-meta-item">
                                                    <i class="far fa-clock"></i> <?php echo esc_html($tour_duration); ?> Days
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php 
                                            $tour_difficulty = get_post_meta(get_the_ID(), 'tour_difficulty', true);
                                            if ($tour_difficulty) : 
                                                ?>
                                                <div class="tour-meta-item">
                                                    <i class="fas fa-signal"></i> <?php echo esc_html($tour_difficulty); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <a href="<?php the_permalink(); ?>" class="tour-button">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                }
                ?>
            </div>
        </div>
    </section>
</article><!-- #post-<?php the_ID(); ?> -->
