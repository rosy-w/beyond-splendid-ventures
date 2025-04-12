<?php
/**
 * Template part for displaying featured tours
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elementary Child
 */

// Get featured tours
$args = array(
    'post_type' => 'tour',
    'posts_per_page' => 3,
    'meta_key' => 'tour_featured',
    'meta_value' => '1'
);

$featured_tours = new WP_Query($args);
?>

<section class="featured-tours-section">
    <div class="container">
        <div class="section-title">
            <h2><?php echo get_theme_mod('featured_tours_title', 'Featured Tours'); ?></h2>
            <p class="section-subtitle"><?php echo get_theme_mod('featured_tours_subtitle', 'Discover our most popular and recommended tour packages'); ?></p>
        </div>
        
        <div class="row">
            <?php
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
                $placeholders = array(
                    array(
                        'title' => 'Scenic Japan Adventure',
                        'description' => 'Explore the beauty of Japan from bustling Tokyo to serene Kyoto temples. Experience authentic cuisine and traditional culture.',
                        'price' => '2,499',
                        'duration' => '12',
                        'size' => '16',
                        'difficulty' => 'Moderate'
                    ),
                    array(
                        'title' => 'Mediterranean Highlights',
                        'description' => 'Journey through the stunning landscapes of Italy, Greece, and Spain. Visit historic sites, relax on beautiful beaches, and enjoy delicious cuisine.',
                        'price' => '3,299',
                        'duration' => '14',
                        'size' => '12',
                        'difficulty' => 'Easy'
                    ),
                    array(
                        'title' => 'African Safari Expedition',
                        'description' => 'Experience the incredible wildlife of Tanzania and Kenya. Witness the Great Migration and explore the Serengeti on this unforgettable safari adventure.',
                        'price' => '4,199',
                        'duration' => '10',
                        'size' => '8',
                        'difficulty' => 'Moderate'
                    )
                );
                
                foreach ($placeholders as $placeholder) :
                    ?>
                    <div class="col-md-4">
                        <div class="tour-card featured">
                            <div class="tour-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-tour.jpg" alt="Tour">
                                <div class="tour-price">$<?php echo esc_html($placeholder['price']); ?></div>
                                <div class="featured-badge">
                                    <i class="fas fa-star"></i> Featured
                                </div>
                            </div>
                            <div class="tour-details">
                                <h3 class="tour-title"><?php echo esc_html($placeholder['title']); ?></h3>
                                <div class="tour-description"><?php echo esc_html($placeholder['description']); ?></div>
                                
                                <div class="tour-meta">
                                    <div class="tour-meta-item">
                                        <i class="far fa-clock"></i> <?php echo esc_html($placeholder['duration']); ?> Days
                                    </div>
                                    <div class="tour-meta-item">
                                        <i class="fas fa-users"></i> <?php echo esc_html($placeholder['size']); ?> People
                                    </div>
                                    <div class="tour-meta-item">
                                        <i class="fas fa-signal"></i> <?php echo esc_html($placeholder['difficulty']); ?>
                                    </div>
                                </div>
                                
                                <a href="#" class="tour-button">View Details</a>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="<?php echo esc_url(home_url('/tours')); ?>" class="btn btn-primary">View All Tours</a>
        </div>
    </div>
</section>
