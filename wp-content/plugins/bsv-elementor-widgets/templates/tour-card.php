<?php
// Get tour meta
$tour_price = get_post_meta(get_the_ID(), 'tour_price', true);

// Destination country: read from taxonomy first, fall back to post meta
$_country_terms = get_the_terms(get_the_ID(), 'destination_country');
if (!empty($_country_terms) && !is_wp_error($_country_terms)) {
    $tour_destination_country = implode(', ', wp_list_pluck($_country_terms, 'name'));
} else {
    $tour_destination_country = get_post_meta(get_the_ID(), 'destination_country', true);
}
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

// $tour_price_data and $default_currency are set in the parent widget's render()
// and are available here because this file is loaded via include().
$initial_price_display = '';
if (!empty($tour_price_data)) {
    $initial_price_display = ($default_currency === 'usd')
        ? $tour_price_data['usd_display']
        : $tour_price_data['kes_display'];
}
?>

<div class="bsv-tour-card">
    <div class="bsv-tour-image">
        <a href="<?php the_permalink(); ?>">
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
        </a>
        
        <?php if (!empty($tour_price)) : ?>
            <div
                class="bsv-tour-price"
                data-price-kes="<?php echo esc_attr($tour_price_data['kes_display']); ?>"
                data-price-usd="<?php echo esc_attr($tour_price_data['usd_display']); ?>"
            ><?php echo esc_html($initial_price_display); ?></div>
        <?php endif; ?>
        
        <?php if (!empty($tour_featured) && $tour_featured == '1') : ?>
            <div class="bsv-featured-badge"><?php echo esc_html__('Featured', 'bsv-elementor-widgets'); ?></div>
        <?php endif; ?>
    </div>
    
    <div class="bsv-tour-details">
        <?php if (!empty($tour_destination_country)) : ?>
            <p class="bsv-tour-destination-country">
                <i class="fas fa-map-marker-alt"></i> <?php echo esc_html($tour_destination_country); ?>
            </p>
        <?php endif; ?>

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
