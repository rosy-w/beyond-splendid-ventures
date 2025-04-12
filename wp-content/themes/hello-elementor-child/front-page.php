<?php
/**
 * The front page template file
 *
 * This is the template for the custom homepage, optimized for Elementor
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elementor Theme for Beyond Splendid Ventures
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

    <?php
    // Check if the page is built with Elementor
    if (class_exists('\Elementor\Plugin')) {
        $document = \Elementor\Plugin::$instance->documents->get(get_the_ID());
        
        if ($document && $document->is_built_with_elementor()) {
            // If page is built with Elementor, just output the content
            the_content();
        } else {
            // If not built with Elementor, use the fallback template
            
            // Hero Section
            ?>
            <section class="hero-section">
                <?php
                // Get the featured image as hero background
                if (has_post_thumbnail()) {
                    echo '<img class="hero-background" src="' . get_the_post_thumbnail_url(get_the_ID(), 'hero-image') . '" alt="' . get_the_title() . '">';
                } else {
                    // Default image if no featured image is set
                    echo '<img class="hero-background" src="' . get_stylesheet_directory_uri() . '/assets/default-hero.jpg" alt="Beyond Splendid Ventures">';
                }
                ?>
                <div class="hero-content">
                    <h1 class="hero-title"><?php echo get_theme_mod('hero_title', 'Discover the World with Beyond Splendid Ventures'); ?></h1>
                    <p class="hero-subtitle"><?php echo get_theme_mod('hero_subtitle', 'Experience unforgettable journeys and create memories that last a lifetime'); ?></p>
                    <a href="<?php echo get_theme_mod('hero_button_url', '/tours'); ?>" class="btn btn-primary hero-button">
                        <?php echo get_theme_mod('hero_button_text', 'Explore Our Tours'); ?>
                    </a>
                </div>
            </section>
            <?php
        }
    } else {
        // Elementor is not active, use the fallback template
        ?>
        <section class="hero-section">
            <?php
            // Get the featured image as hero background
            if (has_post_thumbnail()) {
                echo '<img class="hero-background" src="' . get_the_post_thumbnail_url(get_the_ID(), 'hero-image') . '" alt="' . get_the_title() . '">';
            } else {
                // Default image if no featured image is set
                echo '<img class="hero-background" src="' . get_stylesheet_directory_uri() . '/assets/default-hero.jpg" alt="Beyond Splendid Ventures">';
            }
            ?>
            <div class="hero-content">
                <h1 class="hero-title"><?php echo get_theme_mod('hero_title', 'Discover the World with Beyond Splendid Ventures'); ?></h1>
                <p class="hero-subtitle"><?php echo get_theme_mod('hero_subtitle', 'Experience unforgettable journeys and create memories that last a lifetime'); ?></p>
                <a href="<?php echo get_theme_mod('hero_button_url', '/tours'); ?>" class="btn btn-primary hero-button">
                    <?php echo get_theme_mod('hero_button_text', 'Explore Our Tours'); ?>
                </a>
            </div>
        </section>
        <?php
    }
    ?>

        <?php
        // Featured Destinations Section
        ?>
        <section class="featured-destinations">
            <div class="container">
                <div class="section-title">
                    <h2><?php echo get_theme_mod('featured_destinations_title', 'Popular Destinations'); ?></h2>
                    <p class="section-subtitle"><?php echo get_theme_mod('featured_destinations_subtitle', 'Explore our carefully selected destinations for your next adventure'); ?></p>
                </div>
                
                <div class="row">
                    <?php
                    // Get featured destinations
                    $args = array(
                        'post_type' => 'destination',
                        'posts_per_page' => 6,
                        'meta_query' => array(
                            array(
                                'key' => 'featured_destination',
                                'value' => '1',
                                'compare' => '='
                            )
                        )
                    );
                    
                    $featured_destinations = new WP_Query($args);
                    
                    if ($featured_destinations->have_posts()) :
                        while ($featured_destinations->have_posts()) : $featured_destinations->the_post();
                            ?>
                            <div class="col-md-6 col-lg-4">
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
                        // Display placeholder if no destinations are found
                        for ($i = 1; $i <= 6; $i++) {
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="destination-card">
                                    <div class="destination-image">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-destination.jpg" alt="Destination">
                                        <div class="destination-overlay"></div>
                                    </div>
                                    <div class="destination-details">
                                        <h3 class="destination-title">Exciting Destination</h3>
                                        <div class="destination-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales, sapien non bibendum fermentum, diam orci.</div>
                                        <div class="destination-meta">
                                            <span><i class="fas fa-map-marker-alt"></i> Location</span>
                                            <a href="#" class="destination-link">Explore <i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    endif;
                    ?>
                </div>
                
                <div class="text-center mt-5">
                    <a href="<?php echo get_post_type_archive_link('destination'); ?>" class="btn btn-primary">View All Destinations</a>
                </div>
            </div>
        </section>

        <?php
        // Popular Tours Section
        ?>
        <section class="popular-tours">
            <div class="container">
                <div class="section-title">
                    <h2><?php echo get_theme_mod('popular_tours_title', 'Our Popular Tours'); ?></h2>
                    <p class="section-subtitle"><?php echo get_theme_mod('popular_tours_subtitle', 'Discover our most popular tour packages for your next adventure'); ?></p>
                </div>
                
                <?php
                // Tour category filter buttons
                $tour_categories = get_terms(array(
                    'taxonomy' => 'tour_category',
                    'hide_empty' => true,
                ));
                
                if (!empty($tour_categories) && !is_wp_error($tour_categories)) :
                    ?>
                    <div class="tour-filter text-center mb-5">
                        <button class="btn btn-outline-primary tour-filter-button active" data-filter="all">All Tours</button>
                        <?php foreach ($tour_categories as $category) : ?>
                            <button class="btn btn-outline-primary tour-filter-button" data-filter="<?php echo esc_attr($category->slug); ?>">
                                <?php echo esc_html($category->name); ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="row">
                    <?php
                    // Get popular tours
                    $args = array(
                        'post_type' => 'tour',
                        'posts_per_page' => 6,
                        'meta_key' => 'tour_featured',
                        'meta_value' => '1'
                    );
                    
                    $popular_tours = new WP_Query($args);
                    
                    if ($popular_tours->have_posts()) :
                        while ($popular_tours->have_posts()) : $popular_tours->the_post();
                            // Get tour category
                            $tour_terms = get_the_terms(get_the_ID(), 'tour_category');
                            $tour_category = '';
                            if (!empty($tour_terms) && !is_wp_error($tour_terms)) {
                                $tour_category = $tour_terms[0]->slug;
                            }
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="tour-card" data-category="<?php echo esc_attr($tour_category); ?>">
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
                                            $tour_group_size = get_post_meta(get_the_ID(), 'tour_group_size', true);
                                            if ($tour_group_size) : 
                                                ?>
                                                <div class="tour-meta-item">
                                                    <i class="fas fa-users"></i> <?php echo esc_html($tour_group_size); ?> People
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
                        // Display placeholder if no tours are found
                        for ($i = 1; $i <= 6; $i++) {
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="tour-card">
                                    <div class="tour-image">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-tour.jpg" alt="Tour">
                                        <div class="tour-price">$1299</div>
                                    </div>
                                    <div class="tour-details">
                                        <h3 class="tour-title">Amazing Tour Package</h3>
                                        <div class="tour-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales, sapien non bibendum fermentum, diam orci.</div>
                                        
                                        <div class="tour-meta">
                                            <div class="tour-meta-item">
                                                <i class="far fa-clock"></i> 7 Days
                                            </div>
                                            <div class="tour-meta-item">
                                                <i class="fas fa-users"></i> 10 People
                                            </div>
                                            <div class="tour-meta-item">
                                                <i class="fas fa-signal"></i> Easy
                                            </div>
                                        </div>
                                        
                                        <a href="#" class="tour-button">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    endif;
                    ?>
                </div>
                
                <div class="text-center mt-5">
                    <a href="<?php echo get_post_type_archive_link('tour'); ?>" class="btn btn-primary">View All Tours</a>
                </div>
            </div>
        </section>

        <?php
        // Testimonials Section
        get_template_part('template-parts/testimonials');
        ?>

        <?php
        // Why Choose Us Section
        ?>
        <section class="why-choose-us">
            <div class="container">
                <div class="section-title">
                    <h2><?php echo get_theme_mod('why_choose_us_title', 'Why Choose Us'); ?></h2>
                    <p class="section-subtitle"><?php echo get_theme_mod('why_choose_us_subtitle', 'Discover the Beyond Splendid Ventures difference'); ?></p>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="far fa-gem"></i>
                            </div>
                            <h3 class="feature-title">Quality Service</h3>
                            <p class="feature-description">We provide top-notch service to make your travel experience exceptional from start to finish.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <h3 class="feature-title">Handpicked Destinations</h3>
                            <p class="feature-description">Our destinations are carefully selected to ensure the best travel experiences for our clients.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <h3 class="feature-title">Best Price Guarantee</h3>
                            <p class="feature-description">We offer competitive prices without compromising on the quality of your travel experience.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h3 class="feature-title">24/7 Support</h3>
                            <p class="feature-description">Our dedicated team is available round the clock to assist you with any queries or concerns.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Call to Action Section
        ?>
        <section class="cta-section">
            <div class="container">
                <h2 class="cta-title"><?php echo get_theme_mod('cta_title', 'Ready to Plan Your Next Adventure?'); ?></h2>
                <p class="cta-description"><?php echo get_theme_mod('cta_description', 'Contact our team of travel experts today to start planning your perfect trip with Beyond Splendid Ventures.'); ?></p>
                <a href="<?php echo get_theme_mod('cta_button_url', '/contact'); ?>" class="cta-button">
                    <?php echo get_theme_mod('cta_button_text', 'Contact Us Now'); ?>
                </a>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
