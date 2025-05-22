
<?php
// Get tour meta
$tour_price = get_post_meta(get_the_ID(), 'tour_price', true);
$tour_duration = get_post_meta(get_the_ID(), 'tour_duration', true);
$tour_group_size = get_post_meta(get_the_ID(), 'tour_group_size', true);
$tour_difficulty = get_post_meta(get_the_ID(), 'tour_difficulty', true);
$tour_featured = get_post_meta(get_the_ID(), 'tour_featured', true);
$tour_excerpt = wp_trim_words(get_the_excerpt(), 20);

// Feature image
$image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
if (!$image_url) {
    $image_url = BSV_ELEMENTOR_WIDGETS_URL . 'assets/images/placeholder.svg';
}
?>

<div class="bsv-tour-card">
    <div class="bsv-tour-image">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
        </a>
        
        <?php if (!empty($tour_price)) : ?>
            <div class="bsv-tour-price">$<?php echo esc_html($tour_price); ?></div>
        <?php endif; ?>
        
        <?php if (!empty($tour_featured) && $tour_featured == '1') : ?>
            <div class="bsv-featured-badge"><?php echo esc_html__('Featured', 'bsv-elementor-widgets'); ?></div>
        <?php endif; ?>
    </div>
    
    <div class="bsv-tour-details">
        <h3 class="bsv-tour-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <div class="bsv-tour-meta">
            <?php if (!empty($tour_duration)) : ?>
                <span class="bsv-tour-meta-item">
                    <i class="fas fa-clock"></i> <?php echo esc_html($tour_duration); ?> <?php echo esc_html__('days', 'bsv-elementor-widgets'); ?>
                </span>
            <?php endif; ?>
            
            <?php if (!empty($tour_group_size)) : ?>
                <span class="bsv-tour-meta-item">
                    <i class="fas fa-users"></i> <?php echo esc_html($tour_group_size); ?> <?php echo esc_html__('people', 'bsv-elementor-widgets'); ?>
                </span>
            <?php endif; ?>
            
            <?php if (!empty($tour_difficulty)) : ?>
                <span class="bsv-tour-meta-item">
                    <i class="fas fa-mountain"></i> <?php echo esc_html($tour_difficulty); ?>
                </span>
            <?php endif; ?>
        </div>
        
        <?php if (!empty($tour_excerpt)) : ?>
            <div class="bsv-tour-description"><?php echo esc_html($tour_excerpt); ?></div>
        <?php endif; ?>
        
        <a href="<?php the_permalink(); ?>" class="bsv-tour-button">
            <?php echo esc_html__('View Details', 'bsv-elementor-widgets'); ?>
        </a>
    </div>
</div>
