<?php
/**
 * Template Name: Tours Page
 *
 * The template for displaying the tours page with Elementor compatibility
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
            
            // We're done, don't show the default template content
            echo '</main></div>';
            get_footer();
            return;
        }
    }
    // If not built with Elementor, continue with the regular template below
    ?>

        <?php
        // Page Header
        ?>
        <section class="page-header">
            <div class="container">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<div class="breadcrumbs">', '</div>');
                }
                ?>
            </div>
        </section>

        <?php
        // Tour Search and Filter Section
        ?>
        <section class="tour-search-filter-section">
            <div class="container">
                <div class="search-filter-container">
                    <form class="tour-search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tour_search">Search Tours</label>
                                    <input type="text" id="tour_search" name="s" class="form-control" placeholder="Search tours...">
                                    <input type="hidden" name="post_type" value="tour">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tour_destination">Destination</label>
                                    <?php
                                    $destinations = get_terms(array(
                                        'taxonomy' => 'destination_category',
                                        'hide_empty' => true,
                                    ));
                                    
                                    if (!empty($destinations) && !is_wp_error($destinations)) :
                                    ?>
                                        <select id="tour_destination" name="destination_category" class="form-control">
                                            <option value="">All Destinations</option>
                                            <?php foreach ($destinations as $destination) : ?>
                                                <option value="<?php echo esc_attr($destination->slug); ?>"><?php echo esc_html($destination->name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tour_duration">Duration</label>
                                    <select id="tour_duration" name="duration" class="form-control">
                                        <option value="">Any Duration</option>
                                        <option value="1-3">1-3 Days</option>
                                        <option value="4-7">4-7 Days</option>
                                        <option value="8-14">8-14 Days</option>
                                        <option value="15+">15+ Days</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="tour_submit">&nbsp;</label>
                                    <button type="submit" id="tour_submit" class="btn btn-primary btn-block">Search Tours</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <?php
        // Featured Tours
        ?>
        <section class="featured-tours">
            <div class="container">
                <div class="section-title">
                    <h2>Featured Tours</h2>
                    <p class="section-subtitle">Our most popular and recommended tour packages</p>
                </div>
                
                <div class="row">
                    <?php
                    // Get featured tours
                    $args = array(
                        'post_type' => 'tour',
                        'posts_per_page' => 3,
                        'meta_key' => 'tour_featured',
                        'meta_value' => '1'
                    );
                    
                    $featured_tours = new WP_Query($args);
                    
                    if ($featured_tours->have_posts()) :
                        while ($featured_tours->have_posts()) : $featured_tours->the_post();
                            ?>
                            <div class="col-md-4">
                                <div class="tour-card featured">
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
                                        
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </div>
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
                        // Display placeholder if no featured tours are found
                        for ($i = 1; $i <= 3; $i++) {
                            ?>
                            <div class="col-md-4">
                                <div class="tour-card featured">
                                    <div class="tour-image">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-tour.jpg" alt="Tour">
                                        <div class="tour-price">$1499</div>
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </div>
                                    </div>
                                    <div class="tour-details">
                                        <h3 class="tour-title">Premium Tour Package</h3>
                                        <div class="tour-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales, sapien non bibendum fermentum, diam orci.</div>
                                        
                                        <div class="tour-meta">
                                            <div class="tour-meta-item">
                                                <i class="far fa-clock"></i> 10 Days
                                            </div>
                                            <div class="tour-meta-item">
                                                <i class="fas fa-users"></i> 12 People
                                            </div>
                                            <div class="tour-meta-item">
                                                <i class="fas fa-signal"></i> Moderate
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
            </div>
        </section>

        <?php
        // Tour Categories
        $tour_categories = get_terms(array(
            'taxonomy' => 'tour_category',
            'hide_empty' => true,
        ));
        
        if (!empty($tour_categories) && !is_wp_error($tour_categories)) :
            ?>
            <section class="tour-categories">
                <div class="container">
                    <div class="section-title">
                        <h2>Tour Categories</h2>
                        <p class="section-subtitle">Browse tours by category to find your perfect travel experience</p>
                    </div>
                    
                    <div class="row">
                        <?php foreach ($tour_categories as $category) : ?>
                            <div class="col-md-4">
                                <div class="category-card">
                                    <div class="category-image">
                                        <?php
                                        // Try to get category image from ACF if available
                                        $category_image = '';
                                        if (function_exists('get_field')) {
                                            $category_image = get_field('category_image', $category);
                                        }
                                        
                                        if ($category_image) {
                                            echo '<img src="' . esc_url($category_image) . '" alt="' . esc_attr($category->name) . '">';
                                        } else {
                                            // Fallback to default image
                                            echo '<img src="' . get_stylesheet_directory_uri() . '/assets/default-category.jpg" alt="' . esc_attr($category->name) . '">';
                                        }
                                        ?>
                                        <div class="category-overlay"></div>
                                    </div>
                                    <div class="category-details">
                                        <h3 class="category-title"><?php echo esc_html($category->name); ?></h3>
                                        <p class="category-count"><?php echo esc_html($category->count); ?> Tours</p>
                                        <a href="<?php echo esc_url(get_term_link($category)); ?>" class="category-link">View All <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // All Tours
        ?>
        <section class="all-tours">
            <div class="container">
                <div class="section-title">
                    <h2>All Tours</h2>
                    <p class="section-subtitle">Explore all of our available tour packages</p>
                </div>
                
                <div class="row">
                    <?php
                    // Get all tours
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'tour',
                        'posts_per_page' => 9,
                        'paged' => $paged
                    );
                    
                    $tours = new WP_Query($args);
                    
                    if ($tours->have_posts()) :
                        while ($tours->have_posts()) : $tours->the_post();
                            ?>
                            <div class="col-md-6 col-lg-4">
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
                        
                        // Pagination
                        ?>
                        <div class="col-12">
                            <div class="pagination-container">
                                <?php
                                $big = 999999999; // need an unlikely integer
                                echo paginate_links(array(
                                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                    'format' => '?paged=%#%',
                                    'current' => max(1, get_query_var('paged')),
                                    'total' => $tours->max_num_pages,
                                    'prev_text' => '<i class="fas fa-angle-left"></i> Previous',
                                    'next_text' => 'Next <i class="fas fa-angle-right"></i>',
                                ));
                                ?>
                            </div>
                        </div>
                        <?php
                        
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
            </div>
        </section>

        <?php
        // Call to Action Section
        ?>
        <section class="cta-section">
            <div class="container">
                <h2 class="cta-title">Need Help Finding the Perfect Tour?</h2>
                <p class="cta-description">Our travel experts are ready to assist you in finding the perfect tour based on your preferences and requirements.</p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="cta-button">Contact Our Team</a>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar('tour');
get_footer();
