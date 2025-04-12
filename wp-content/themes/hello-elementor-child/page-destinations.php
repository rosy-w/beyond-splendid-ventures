<?php
/**
 * Template Name: Destinations Page
 *
 * The template for displaying the destinations page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elementary Child
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

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
        // Destinations Search
        ?>
        <section class="destinations-search-section">
            <div class="container">
                <div class="search-container">
                    <form class="destination-search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" name="s" class="form-control" placeholder="Search destinations...">
                                <input type="hidden" name="post_type" value="destination">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <?php
        // Destinations Map
        ?>
        <section class="destinations-map-section">
            <div class="container">
                <div class="section-title">
                    <h2>Explore Our Destinations</h2>
                    <p class="section-subtitle">Click on the regions to discover our available destinations</p>
                </div>
                
                <div class="world-map-container">
                    <div class="world-map">
                        <!-- SVG World Map will be loaded here via JavaScript -->
                        <div class="map-placeholder">
                            <p>Interactive world map is loading...</p>
                            <p>You can also browse destinations by continent below.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Destinations by Continent
        $continents = get_terms(array(
            'taxonomy' => 'destination_continent',
            'hide_empty' => true,
        ));
        
        if (!empty($continents) && !is_wp_error($continents)) :
            ?>
            <section class="destinations-by-continent">
                <div class="container">
                    <div class="section-title">
                        <h2>Destinations by Continent</h2>
                        <p class="section-subtitle">Explore our destinations around the world</p>
                    </div>
                    
                    <div class="continent-tabs">
                        <ul class="nav nav-tabs" id="continentTabs" role="tablist">
                            <?php
                            $first_tab = true;
                            foreach ($continents as $continent) :
                                $tab_id = 'continent-' . $continent->slug;
                                $active_class = $first_tab ? 'active' : '';
                                ?>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link <?php echo $active_class; ?>" id="<?php echo esc_attr($tab_id); ?>-tab" data-toggle="tab" href="#<?php echo esc_attr($tab_id); ?>" role="tab" aria-controls="<?php echo esc_attr($tab_id); ?>" aria-selected="<?php echo $first_tab ? 'true' : 'false'; ?>">
                                        <?php echo esc_html($continent->name); ?>
                                    </a>
                                </li>
                                <?php
                                $first_tab = false;
                            endforeach;
                            ?>
                        </ul>
                        
                        <div class="tab-content" id="continentTabsContent">
                            <?php
                            $first_tab = true;
                            foreach ($continents as $continent) :
                                $tab_id = 'continent-' . $continent->slug;
                                $active_class = $first_tab ? 'show active' : '';
                                
                                // Get destinations for this continent
                                $args = array(
                                    'post_type' => 'destination',
                                    'posts_per_page' => -1,
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'destination_continent',
                                            'field' => 'slug',
                                            'terms' => $continent->slug,
                                        ),
                                    ),
                                );
                                
                                $destinations = new WP_Query($args);
                                ?>
                                <div class="tab-pane fade <?php echo $active_class; ?>" id="<?php echo esc_attr($tab_id); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($tab_id); ?>-tab">
                                    <?php if ($destinations->have_posts()) : ?>
                                        <div class="row">
                                            <?php while ($destinations->have_posts()) : $destinations->the_post(); ?>
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
                                            <?php endwhile; ?>
                                        </div>
                                    <?php else : ?>
                                        <div class="no-destinations">
                                            <p>No destinations found for <?php echo esc_html($continent->name); ?>.</p>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php wp_reset_postdata(); ?>
                                </div>
                                <?php
                                $first_tab = false;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php
        // Featured Destinations
        ?>
        <section class="featured-destinations">
            <div class="container">
                <div class="section-title">
                    <h2>Featured Destinations</h2>
                    <p class="section-subtitle">Explore our most popular destinations</p>
                </div>
                
                <div class="row">
                    <?php
                    // Get featured destinations
                    $args = array(
                        'post_type' => 'destination',
                        'posts_per_page' => 3,
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
                            <div class="col-md-4">
                                <div class="destination-card featured">
                                    <div class="destination-image">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('destination-thumbnail'); ?>" alt="<?php the_title(); ?>">
                                        <?php else : ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-destination.jpg" alt="<?php the_title(); ?>">
                                        <?php endif; ?>
                                        <div class="destination-overlay"></div>
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </div>
                                    </div>
                                    <div class="destination-details">
                                        <h3 class="destination-title"><?php the_title(); ?></h3>
                                        <div class="destination-description"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
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
                        // Display placeholder if no featured destinations are found
                        for ($i = 1; $i <= 3; $i++) {
                            ?>
                            <div class="col-md-4">
                                <div class="destination-card featured">
                                    <div class="destination-image">
                                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-destination.jpg" alt="Destination">
                                        <div class="destination-overlay"></div>
                                        <div class="featured-badge">
                                            <i class="fas fa-star"></i> Featured
                                        </div>
                                    </div>
                                    <div class="destination-details">
                                        <h3 class="destination-title">Amazing Destination</h3>
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
            </div>
        </section>

        <?php
        // All Destinations
        ?>
        <section class="all-destinations">
            <div class="container">
                <div class="section-title">
                    <h2>All Destinations</h2>
                    <p class="section-subtitle">Explore all of our available destinations</p>
                </div>
                
                <div class="row">
                    <?php
                    // Get all destinations
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array(
                        'post_type' => 'destination',
                        'posts_per_page' => 9,
                        'paged' => $paged
                    );
                    
                    $destinations = new WP_Query($args);
                    
                    if ($destinations->have_posts()) :
                        while ($destinations->have_posts()) : $destinations->the_post();
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
                                    'total' => $destinations->max_num_pages,
                                    'prev_text' => '<i class="fas fa-angle-left"></i> Previous',
                                    'next_text' => 'Next <i class="fas fa-angle-right"></i>',
                                ));
                                ?>
                            </div>
                        </div>
                        <?php
                        
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
                                        <h3 class="destination-title">Amazing Destination</h3>
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
            </div>
        </section>

        <?php
        // Newsletter Section
        ?>
        <section class="newsletter-section">
            <div class="container">
                <div class="newsletter-container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h2>Subscribe to Our Newsletter</h2>
                            <p>Receive the latest travel deals, news, and inspiration directly in your inbox.</p>
                        </div>
                        <div class="col-lg-6">
                            <form class="newsletter-form" method="post" action="#">
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Your email address" required>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Subscribe</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
