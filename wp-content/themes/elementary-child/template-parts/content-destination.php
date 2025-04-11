<?php
/**
 * Template part for displaying destination content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elementary Child
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('destination-single'); ?>>
    <div class="destination-header">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 text-center">
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        
                        <?php
                        // Get destination location
                        $destination_location = get_post_meta(get_the_ID(), 'destination_location', true);
                        if ($destination_location) :
                        ?>
                            <div class="destination-location">
                                <i class="fas fa-map-marker-alt"></i> <?php echo esc_html($destination_location); ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        // Get destination continent
                        $continents = get_the_terms(get_the_ID(), 'destination_continent');
                        if ($continents && !is_wp_error($continents)) :
                        ?>
                            <div class="destination-continent">
                                <?php
                                $continent_links = array();
                                foreach ($continents as $continent) {
                                    $continent_links[] = '<a href="' . esc_url(get_term_link($continent)) . '">' . esc_html($continent->name) . '</a>';
                                }
                                echo implode(', ', $continent_links);
                                ?>
                            </div>
                        <?php endif; ?>
                    </header><!-- .entry-header -->
                </div>
            </div>
        </div>
    </div>

    <?php if (has_post_thumbnail()) : ?>
        <div class="destination-featured-image">
            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
        </div>
    <?php endif; ?>

    <div class="destination-content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="destination-tabs">
                        <ul class="nav nav-tabs" id="destinationTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tours-tab" data-toggle="tab" href="#tours" role="tab" aria-controls="tours" aria-selected="false">Available Tours</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="attractions-tab" data-toggle="tab" href="#attractions" role="tab" aria-controls="attractions" aria-selected="false">Attractions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="gallery-tab" data-toggle="tab" href="#gallery" role="tab" aria-controls="gallery" aria-selected="false">Gallery</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="faq-tab" data-toggle="tab" href="#faq" role="tab" aria-controls="faq" aria-selected="false">FAQ</a>
                            </li>
                        </ul>
                        
                        <div class="tab-content" id="destinationTabsContent">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                <div class="destination-overview">
                                    <?php the_content(); ?>
                                    
                                    <?php
                                    // Destination highlights
                                    $destination_highlights = get_post_meta(get_the_ID(), 'destination_highlights', true);
                                    if ($destination_highlights) :
                                    ?>
                                        <div class="destination-highlights">
                                            <h3>Destination Highlights</h3>
                                            <?php echo wpautop($destination_highlights); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php
                                    // Get destination info if using ACF
                                    if (function_exists('get_field')) :
                                        $best_time = get_field('best_time_to_visit');
                                        $language = get_field('language');
                                        $currency = get_field('currency');
                                        $timezone = get_field('timezone');
                                        
                                        if ($best_time || $language || $currency || $timezone) :
                                        ?>
                                            <div class="destination-info-box">
                                                <h3>Destination Information</h3>
                                                <div class="row">
                                                    <?php if ($best_time) : ?>
                                                        <div class="col-md-6">
                                                            <div class="info-item">
                                                                <h4><i class="fas fa-calendar-alt"></i> Best Time to Visit</h4>
                                                                <p><?php echo esc_html($best_time); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($language) : ?>
                                                        <div class="col-md-6">
                                                            <div class="info-item">
                                                                <h4><i class="fas fa-language"></i> Language</h4>
                                                                <p><?php echo esc_html($language); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($currency) : ?>
                                                        <div class="col-md-6">
                                                            <div class="info-item">
                                                                <h4><i class="fas fa-money-bill-wave"></i> Currency</h4>
                                                                <p><?php echo esc_html($currency); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <?php if ($timezone) : ?>
                                                        <div class="col-md-6">
                                                            <div class="info-item">
                                                                <h4><i class="fas fa-clock"></i> Time Zone</h4>
                                                                <p><?php echo esc_html($timezone); ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="tours" role="tabpanel" aria-labelledby="tours-tab">
                                <?php
                                // Get tours for this destination
                                $destination_id = get_the_ID();
                                $destination_cats = get_the_terms($destination_id, 'destination_category');
                                
                                if ($destination_cats && !is_wp_error($destination_cats)) {
                                    $destination_cat_ids = array();
                                    foreach ($destination_cats as $dest_cat) {
                                        $destination_cat_ids[] = $dest_cat->term_id;
                                    }
                                    
                                    $args = array(
                                        'post_type' => 'tour',
                                        'posts_per_page' => -1,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'destination_category',
                                                'field' => 'term_id',
                                                'terms' => $destination_cat_ids,
                                            ),
                                        ),
                                    );
                                    
                                    $destination_tours = new WP_Query($args);
                                    
                                    if ($destination_tours->have_posts()) :
                                    ?>
                                        <div class="destination-tours">
                                            <h3>Tours in <?php the_title(); ?></h3>
                                            
                                            <div class="row">
                                                <?php while ($destination_tours->have_posts()) : $destination_tours->the_post(); ?>
                                                    <div class="col-md-6">
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
                                                <?php endwhile; ?>
                                            </div>
                                        </div>
                                        <?php wp_reset_postdata(); ?>
                                    <?php else : ?>
                                        <div class="no-tours">
                                            <p>No tours are currently available for this destination. Please check back later or <a href="<?php echo esc_url(home_url('/contact')); ?>">contact us</a> for custom tour options.</p>
                                        </div>
                                    <?php endif;
                                } else {
                                    ?>
                                    <div class="no-tours">
                                        <p>No tours are currently available for this destination. Please check back later or <a href="<?php echo esc_url(home_url('/contact')); ?>">contact us</a> for custom tour options.</p>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            
                            <div class="tab-pane fade" id="attractions" role="tabpanel" aria-labelledby="attractions-tab">
                                <?php
                                // Destination attractions
                                $destination_attractions = get_post_meta(get_the_ID(), 'destination_attractions', true);
                                
                                if ($destination_attractions) :
                                    echo '<div class="destination-attractions">';
                                    echo '<h3>Top Attractions</h3>';
                                    echo wpautop($destination_attractions);
                                    echo '</div>';
                                elseif (function_exists('have_rows') && have_rows('attractions')) :
                                ?>
                                    <div class="destination-attractions">
                                        <h3>Top Attractions</h3>
                                        
                                        <div class="row">
                                            <?php
                                            while (have_rows('attractions')) : the_row();
                                                $attraction_title = get_sub_field('attraction_title');
                                                $attraction_description = get_sub_field('attraction_description');
                                                $attraction_image = get_sub_field('attraction_image');
                                            ?>
                                                <div class="col-md-6">
                                                    <div class="attraction-card">
                                                        <?php if ($attraction_image) : ?>
                                                            <div class="attraction-image">
                                                                <img src="<?php echo esc_url($attraction_image['sizes']['medium']); ?>" alt="<?php echo esc_attr($attraction_title); ?>" class="img-fluid">
                                                            </div>
                                                        <?php endif; ?>
                                                        
                                                        <div class="attraction-details">
                                                            <h4 class="attraction-title"><?php echo esc_html($attraction_title); ?></h4>
                                                            <div class="attraction-description">
                                                                <?php echo wpautop($attraction_description); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <p>Information about attractions in this destination will be added soon.</p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="tab-pane fade" id="gallery" role="tabpanel" aria-labelledby="gallery-tab">
                                <?php
                                // Destination gallery
                                $gallery_images = get_post_meta(get_the_ID(), 'destination_gallery', true);
                                
                                if ($gallery_images) :
                                    // If using a custom field for gallery
                                    $gallery_array = explode(',', $gallery_images);
                                    if (!empty($gallery_array)) :
                                    ?>
                                        <div class="destination-gallery">
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
                                elseif (function_exists('get_field') && get_field('destination_gallery')) :
                                    $images = get_field('destination_gallery');
                                    if ($images) :
                                    ?>
                                        <div class="destination-gallery">
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
                                    <p>No gallery images available for this destination.</p>
                                <?php endif; ?>
                            </div>
                            
                            <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                                <?php
                                // Destination FAQ
                                $destination_faq = get_post_meta(get_the_ID(), 'destination_faq', true);
                                
                                if ($destination_faq) :
                                    echo '<div class="destination-faq">';
                                    echo '<h3>Frequently Asked Questions</h3>';
                                    echo wpautop($destination_faq);
                                    echo '</div>';
                                elseif (function_exists('have_rows') && have_rows('faq_items')) :
                                ?>
                                    <div class="destination-faq">
                                        <h3>Frequently Asked Questions</h3>
                                        
                                        <div class="accordion" id="faqAccordion">
                                            <?php
                                            $faq_count = 0;
                                            while (have_rows('faq_items')) : the_row();
                                                $faq_count++;
                                                $faq_question = get_sub_field('question');
                                                $faq_answer = get_sub_field('answer');
                                            ?>
                                                <div class="card">
                                                    <div class="card-header" id="faqHeading<?php echo $faq_count; ?>">
                                                        <h4 class="mb-0">
                                                            <button class="btn btn-link <?php echo ($faq_count > 1) ? 'collapsed' : ''; ?>" type="button" data-toggle="collapse" data-target="#faqCollapse<?php echo $faq_count; ?>" aria-expanded="<?php echo ($faq_count == 1) ? 'true' : 'false'; ?>" aria-controls="faqCollapse<?php echo $faq_count; ?>">
                                                                <?php echo esc_html($faq_question); ?>
                                                            </button>
                                                        </h4>
                                                    </div>
                                                    
                                                    <div id="faqCollapse<?php echo $faq_count; ?>" class="collapse <?php echo ($faq_count == 1) ? 'show' : ''; ?>" aria-labelledby="faqHeading<?php echo $faq_count; ?>" data-parent="#faqAccordion">
                                                        <div class="card-body">
                                                            <?php echo wpautop($faq_answer); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <div class="destination-faq">
                                        <h3>Frequently Asked Questions</h3>
                                        
                                        <p>No FAQs are available for this destination yet. If you have specific questions, please <a href="<?php echo esc_url(home_url('/contact')); ?>">contact us</a>.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="destination-sidebar">
                        <div class="sidebar-widget destination-cta">
                            <h3>Plan Your Trip</h3>
                            <p>Interested in exploring <?php the_title(); ?>? Contact our travel experts to start planning your perfect trip.</p>
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary btn-block">Contact Us</a>
                        </div>
                        
                        <div class="sidebar-widget destination-map">
                            <h3>Location</h3>
                            
                            <?php
                            // Destination map
                            $destination_map = get_post_meta(get_the_ID(), 'destination_map', true);
                            
                            if ($destination_map) :
                                echo '<div class="destination-map-image">';
                                echo wp_get_attachment_image($destination_map, 'large', false, array('class' => 'img-fluid'));
                                echo '</div>';
                            elseif (function_exists('get_field') && get_field('destination_map_location')) :
                                echo do_shortcode('[acf_map field="destination_map_location" height="300px"]');
                            else :
                                // Fallback to Google Maps embed
                                $location_name = get_the_title();
                                $location_encoded = urlencode($location_name);
                                ?>
                                <div class="map-embed">
                                    <iframe 
                                        width="100%" 
                                        height="300" 
                                        style="border:0" 
                                        loading="lazy" 
                                        allowfullscreen 
                                        src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=<?php echo $location_encoded; ?>">
                                    </iframe>
                                </div>
                                <?php
                            endif;
                            ?>
                        </div>
                        
                        <div class="sidebar-widget destination-weather">
                            <h3>Weather</h3>
                            
                            <?php
                            // Check if using a weather plugin or API
                            if (function_exists('get_field') && get_field('destination_weather_code')) :
                                $weather_code = get_field('destination_weather_code');
                                echo do_shortcode('[weather id="' . esc_attr($weather_code) . '"]');
                            else :
                                // Fallback weather info
                                if (function_exists('get_field')) :
                                    $weather_info = get_field('destination_weather_info');
                                    if ($weather_info) :
                                        echo wpautop($weather_info);
                                    else :
                                        ?>
                                        <p>Weather information for this destination will be added soon. Please check back later.</p>
                                        <?php
                                    endif;
                                else :
                                    ?>
                                    <p>Weather information for this destination will be added soon. Please check back later.</p>
                                    <?php
                                endif;
                            endif;
                            ?>
                        </div>
                        
                        <div class="sidebar-widget destination-travel-tips">
                            <h3>Travel Tips</h3>
                            
                            <?php
                            // Destination travel tips
                            $destination_tips = get_post_meta(get_the_ID(), 'destination_tips', true);
                            
                            if ($destination_tips) :
                                echo wpautop($destination_tips);
                            elseif (function_exists('get_field') && get_field('travel_tips')) :
                                $travel_tips = get_field('travel_tips');
                                if (is_array($travel_tips) && !empty($travel_tips)) :
                                ?>
                                    <ul class="travel-tips-list">
                                        <?php foreach ($travel_tips as $tip) : ?>
                                            <li>
                                                <i class="fas fa-check-circle"></i>
                                                <?php echo esc_html($tip['tip']); ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else : ?>
                                    <p>Travel tips for this destination will be added soon.</p>
                                <?php endif;
                            else :
                                ?>
                                <p>Travel tips for this destination will be added soon.</p>
                                <?php
                            endif;
                            ?>
                        </div>
                        
                        <div class="sidebar-widget destination-share">
                            <h3>Share This Destination</h3>
                            
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
    // Related Destinations Section
    ?>
    <section class="related-destinations">
        <div class="container">
            <div class="section-title">
                <h2>Explore More Destinations</h2>
                <p class="section-subtitle">Discover other amazing places to visit</p>
            </div>
            
            <div class="row">
                <?php
                // Get related destinations based on continent
                $continents = get_the_terms(get_the_ID(), 'destination_continent');
                
                if ($continents && !is_wp_error($continents)) {
                    $continent_ids = array();
                    foreach ($continents as $continent) {
                        $continent_ids[] = $continent->term_id;
                    }
                    
                    $args = array(
                        'post_type' => 'destination',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'destination_continent',
                                'field' => 'term_id',
                                'terms' => $continent_ids,
                            ),
                        ),
                    );
                    
                    $related_destinations = new WP_Query($args);
                    
                    if ($related_destinations->have_posts()) :
                        while ($related_destinations->have_posts()) : $related_destinations->the_post();
                            ?>
                            <div class="col-md-4">
                                <div class="destination-card">
                                    <div class="destination-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('destination-thumbnail'); ?>" alt="<?php the_title(); ?>">
                                        <?php else : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-destination.jpg" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        <div class="destination-overlay"></div>
                                    </div>
                                    <div class="destination-details">
                                        <h3 class="destination-title"><?php the_title(); ?></h3>
                                        <div class="destination-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                                        <div class="destination-meta">
                                            <span><i class="fas fa-map-marker-alt"></i> <?php echo get_post_meta(get_the_ID(), 'destination_location', true); ?></span>
                                            <a href="<?php the_permalink(); ?>" class="destination-link">Explore <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // If no related destinations, show random destinations
                        $args = array(
                            'post_type' => 'destination',
                            'posts_per_page' => 3,
                            'post__not_in' => array(get_the_ID()),
                            'orderby' => 'rand',
                        );
                        
                        $random_destinations = new WP_Query($args);
                        
                        if ($random_destinations->have_posts()) :
                            while ($random_destinations->have_posts()) : $random_destinations->the_post();
                                ?>
                                <div class="col-md-4">
                                    <div class="destination-card">
                                        <div class="destination-image">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <img src="<?php the_post_thumbnail_url('destination-thumbnail'); ?>" alt="<?php the_title(); ?>">
                                            <?php else : ?>
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-destination.jpg" alt="<?php the_title(); ?>">
                                            <?php endif; ?>
                                            <div class="destination-overlay"></div>
                                        </div>
                                        <div class="destination-details">
                                            <h3 class="destination-title"><?php the_title(); ?></h3>
                                            <div class="destination-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                                            <div class="destination-meta">
                                                <span><i class="fas fa-map-marker-alt"></i> <?php echo get_post_meta(get_the_ID(), 'destination_location', true); ?></span>
                                                <a href="<?php the_permalink(); ?>" class="destination-link">Explore <i class="fas fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                    endif;
                } else {
                    // If no continents, show random destinations
                    $args = array(
                        'post_type' => 'destination',
                        'posts_per_page' => 3,
                        'post__not_in' => array(get_the_ID()),
                        'orderby' => 'rand',
                    );
                    
                    $random_destinations = new WP_Query($args);
                    
                    if ($random_destinations->have_posts()) :
                        while ($random_destinations->have_posts()) : $random_destinations->the_post();
                            ?>
                            <div class="col-md-4">
                                <div class="destination-card">
                                    <div class="destination-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('destination-thumbnail'); ?>" alt="<?php the_title(); ?>">
                                        <?php else : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-destination.jpg" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        <div class="destination-overlay"></div>
                                    </div>
                                    <div class="destination-details">
                                        <h3 class="destination-title"><?php the_title(); ?></h3>
                                        <div class="destination-description"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                                        <div class="destination-meta">
                                            <span><i class="fas fa-map-marker-alt"></i> <?php echo get_post_meta(get_the_ID(), 'destination_location', true); ?></span>
                                            <a href="<?php the_permalink(); ?>" class="destination-link">Explore <i class="fas fa-arrow-right"></i></a>
                                        </div>
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
