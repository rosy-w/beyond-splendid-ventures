<?php
/**
 * Template part for displaying testimonials
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elementary Child
 */

// Get testimonials
$args = array(
    'post_type' => 'testimonial',
    'posts_per_page' => 6,
    'order' => 'DESC',
    'orderby' => 'date',
);

$testimonials = new WP_Query($args);
?>

<section class="testimonials-section">
    <div class="container">
        <div class="section-title">
            <h2><?php echo get_theme_mod('testimonials_title', 'What Our Travelers Say'); ?></h2>
            <p class="section-subtitle"><?php echo get_theme_mod('testimonials_subtitle', 'Read reviews from our satisfied clients who have experienced our tours'); ?></p>
        </div>
        
        <?php if ($testimonials->have_posts()) : ?>
            <div class="testimonial-slider">
                <?php while ($testimonials->have_posts()) : $testimonials->the_post(); ?>
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <?php the_content(); ?>
                        </div>
                        
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                <?php else : ?>
                                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-avatar.jpg" alt="<?php the_title(); ?>">
                                <?php endif; ?>
                            </div>
                            <h4 class="testimonial-author-name"><?php the_title(); ?></h4>
                            
                            <?php 
                            // Get testimonial meta
                            $testimonial_tour = get_post_meta(get_the_ID(), 'testimonial_tour', true);
                            $testimonial_location = get_post_meta(get_the_ID(), 'testimonial_location', true);
                            ?>
                            
                            <?php if ($testimonial_tour || $testimonial_location) : ?>
                                <p class="testimonial-author-title">
                                    <?php 
                                    if ($testimonial_tour) {
                                        echo esc_html($testimonial_tour);
                                        
                                        if ($testimonial_location) {
                                            echo ', ' . esc_html($testimonial_location);
                                        }
                                    } elseif ($testimonial_location) {
                                        echo esc_html($testimonial_location);
                                    }
                                    ?>
                                </p>
                            <?php endif; ?>
                            
                            <?php 
                            // Get testimonial rating
                            $testimonial_rating = get_post_meta(get_the_ID(), 'testimonial_rating', true);
                            if ($testimonial_rating) : 
                            ?>
                                <div class="testimonial-rating">
                                    <?php 
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $testimonial_rating) {
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
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <?php 
            // If no testimonials are found, display placeholder testimonials
            $placeholder_testimonials = array(
                array(
                    'content' => 'Our journey through Japan with Beyond Splendid Ventures was truly unforgettable. The attention to detail, knowledgeable guides, and perfect blend of cultural experiences made this trip exceptional. We saw both the iconic sites and hidden gems that we would never have discovered on our own.',
                    'name' => 'Sarah Thompson',
                    'tour' => 'Japan Cultural Expedition',
                    'rating' => 5
                ),
                array(
                    'content' => 'I was amazed by the level of personalized service provided by Beyond Splendid Ventures. From the moment I inquired about the safari tour to the day I returned home, everything was handled with professionalism and care. The wildlife encounters exceeded all my expectations!',
                    'name' => 'Michael Johnson',
                    'tour' => 'African Safari Adventure',
                    'rating' => 5
                ),
                array(
                    'content' => 'Beyond Splendid Ventures created a perfect itinerary for our family trip to Italy. The hotels were charming, the guided tours were informative and engaging for all ages, and the pace was just right. Our children still talk about making pasta with a local chef in Tuscany!',
                    'name' => 'Lisa and Robert Garcia',
                    'tour' => 'Italian Family Discovery',
                    'rating' => 5
                )
            );
            ?>
            
            <div class="testimonial-slider">
                <?php foreach ($placeholder_testimonials as $testimonial) : ?>
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p><?php echo esc_html($testimonial['content']); ?></p>
                        </div>
                        
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/default-avatar.jpg" alt="<?php echo esc_attr($testimonial['name']); ?>">
                            </div>
                            <h4 class="testimonial-author-name"><?php echo esc_html($testimonial['name']); ?></h4>
                            
                            <?php if (isset($testimonial['tour'])) : ?>
                                <p class="testimonial-author-title"><?php echo esc_html($testimonial['tour']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (isset($testimonial['rating'])) : ?>
                                <div class="testimonial-rating">
                                    <?php 
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $testimonial['rating']) {
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
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="text-center mt-4">
            <a href="<?php echo esc_url(home_url('/testimonials')); ?>" class="btn btn-outline-primary">View All Testimonials</a>
        </div>
    </div>
</section>
