<?php
/**
 * Custom Post Types and Taxonomies
 *
 * @package Hello Elementor Child
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register custom post types and taxonomies
 */
function bsv_register_custom_post_types() {
    
    // Tour Post Type
    $tour_labels = array(
        'name'                  => _x('Tours', 'Post type general name', 'hello-elementor-child'),
        'singular_name'         => _x('Tour', 'Post type singular name', 'hello-elementor-child'),
        'menu_name'             => _x('Tours', 'Admin Menu text', 'hello-elementor-child'),
        'name_admin_bar'        => _x('Tour', 'Add New on Toolbar', 'hello-elementor-child'),
        'add_new'               => __('Add New', 'hello-elementor-child'),
        'add_new_item'          => __('Add New Tour', 'hello-elementor-child'),
        'new_item'              => __('New Tour', 'hello-elementor-child'),
        'edit_item'             => __('Edit Tour', 'hello-elementor-child'),
        'view_item'             => __('View Tour', 'hello-elementor-child'),
        'all_items'             => __('All Tours', 'hello-elementor-child'),
        'search_items'          => __('Search Tours', 'hello-elementor-child'),
        'parent_item_colon'     => __('Parent Tours:', 'hello-elementor-child'),
        'not_found'             => __('No tours found.', 'hello-elementor-child'),
        'not_found_in_trash'    => __('No tours found in Trash.', 'hello-elementor-child'),
        'featured_image'        => __('Tour Featured Image', 'hello-elementor-child'),
        'set_featured_image'    => __('Set featured image', 'hello-elementor-child'),
        'remove_featured_image' => __('Remove featured image', 'hello-elementor-child'),
        'use_featured_image'    => __('Use as featured image', 'hello-elementor-child'),
        'archives'              => __('Tour archives', 'hello-elementor-child'),
        'insert_into_item'      => __('Insert into tour', 'hello-elementor-child'),
        'uploaded_to_this_item' => __('Uploaded to this tour', 'hello-elementor-child'),
        'filter_items_list'     => __('Filter tours list', 'hello-elementor-child'),
        'items_list_navigation' => __('Tours list navigation', 'hello-elementor-child'),
        'items_list'            => __('Tours list', 'hello-elementor-child'),
    );

    $tour_args = array(
        'labels'             => $tour_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'tour'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-palmtree',
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('tour', $tour_args);

    // Tour Category Taxonomy
    $tour_cat_labels = array(
        'name'              => _x('Tour Categories', 'taxonomy general name', 'hello-elementor-child'),
        'singular_name'     => _x('Tour Category', 'taxonomy singular name', 'hello-elementor-child'),
        'search_items'      => __('Search Tour Categories', 'hello-elementor-child'),
        'all_items'         => __('All Tour Categories', 'hello-elementor-child'),
        'parent_item'       => __('Parent Tour Category', 'hello-elementor-child'),
        'parent_item_colon' => __('Parent Tour Category:', 'hello-elementor-child'),
        'edit_item'         => __('Edit Tour Category', 'hello-elementor-child'),
        'update_item'       => __('Update Tour Category', 'hello-elementor-child'),
        'add_new_item'      => __('Add New Tour Category', 'hello-elementor-child'),
        'new_item_name'     => __('New Tour Category Name', 'hello-elementor-child'),
        'menu_name'         => __('Tour Categories', 'hello-elementor-child'),
    );

    $tour_cat_args = array(
        'hierarchical'      => true,
        'labels'            => $tour_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tour-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('tour_category', array('tour'), $tour_cat_args);

    // Destination Post Type
    $destination_labels = array(
        'name'                  => _x('Destinations', 'Post type general name', 'hello-elementor-child'),
        'singular_name'         => _x('Destination', 'Post type singular name', 'hello-elementor-child'),
        'menu_name'             => _x('Destinations', 'Admin Menu text', 'hello-elementor-child'),
        'name_admin_bar'        => _x('Destination', 'Add New on Toolbar', 'hello-elementor-child'),
        'add_new'               => __('Add New', 'hello-elementor-child'),
        'add_new_item'          => __('Add New Destination', 'hello-elementor-child'),
        'new_item'              => __('New Destination', 'hello-elementor-child'),
        'edit_item'             => __('Edit Destination', 'hello-elementor-child'),
        'view_item'             => __('View Destination', 'hello-elementor-child'),
        'all_items'             => __('All Destinations', 'hello-elementor-child'),
        'search_items'          => __('Search Destinations', 'hello-elementor-child'),
        'parent_item_colon'     => __('Parent Destinations:', 'hello-elementor-child'),
        'not_found'             => __('No destinations found.', 'hello-elementor-child'),
        'not_found_in_trash'    => __('No destinations found in Trash.', 'hello-elementor-child'),
        'featured_image'        => __('Destination Featured Image', 'hello-elementor-child'),
        'set_featured_image'    => __('Set featured image', 'hello-elementor-child'),
        'remove_featured_image' => __('Remove featured image', 'hello-elementor-child'),
        'use_featured_image'    => __('Use as featured image', 'hello-elementor-child'),
        'archives'              => __('Destination archives', 'hello-elementor-child'),
        'insert_into_item'      => __('Insert into destination', 'hello-elementor-child'),
        'uploaded_to_this_item' => __('Uploaded to this destination', 'hello-elementor-child'),
        'filter_items_list'     => __('Filter destinations list', 'hello-elementor-child'),
        'items_list_navigation' => __('Destinations list navigation', 'hello-elementor-child'),
        'items_list'            => __('Destinations list', 'hello-elementor-child'),
    );

    $destination_args = array(
        'labels'             => $destination_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'destination'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-location-alt',
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('destination', $destination_args);

    // Destination Category Taxonomy
    $destination_cat_labels = array(
        'name'              => _x('Destination Categories', 'taxonomy general name', 'hello-elementor-child'),
        'singular_name'     => _x('Destination Category', 'taxonomy singular name', 'hello-elementor-child'),
        'search_items'      => __('Search Destination Categories', 'hello-elementor-child'),
        'all_items'         => __('All Destination Categories', 'hello-elementor-child'),
        'parent_item'       => __('Parent Destination Category', 'hello-elementor-child'),
        'parent_item_colon' => __('Parent Destination Category:', 'hello-elementor-child'),
        'edit_item'         => __('Edit Destination Category', 'hello-elementor-child'),
        'update_item'       => __('Update Destination Category', 'hello-elementor-child'),
        'add_new_item'      => __('Add New Destination Category', 'hello-elementor-child'),
        'new_item_name'     => __('New Destination Category Name', 'hello-elementor-child'),
        'menu_name'         => __('Destination Categories', 'hello-elementor-child'),
    );

    $destination_cat_args = array(
        'hierarchical'      => true,
        'labels'            => $destination_cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'destination-category'),
        'show_in_rest'      => true,
    );

    register_taxonomy('destination_category', array('destination', 'tour'), $destination_cat_args);

    // Destination Continent Taxonomy
    $continent_labels = array(
        'name'              => _x('Continents', 'taxonomy general name', 'hello-elementor-child'),
        'singular_name'     => _x('Continent', 'taxonomy singular name', 'hello-elementor-child'),
        'search_items'      => __('Search Continents', 'hello-elementor-child'),
        'all_items'         => __('All Continents', 'hello-elementor-child'),
        'parent_item'       => __('Parent Continent', 'hello-elementor-child'),
        'parent_item_colon' => __('Parent Continent:', 'hello-elementor-child'),
        'edit_item'         => __('Edit Continent', 'hello-elementor-child'),
        'update_item'       => __('Update Continent', 'hello-elementor-child'),
        'add_new_item'      => __('Add New Continent', 'hello-elementor-child'),
        'new_item_name'     => __('New Continent Name', 'hello-elementor-child'),
        'menu_name'         => __('Continents', 'hello-elementor-child'),
    );

    $continent_args = array(
        'hierarchical'      => true,
        'labels'            => $continent_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'continent'),
        'show_in_rest'      => true,
    );

    register_taxonomy('destination_continent', array('destination'), $continent_args);

    // Testimonial Post Type
    $testimonial_labels = array(
        'name'                  => _x('Testimonials', 'Post type general name', 'hello-elementor-child'),
        'singular_name'         => _x('Testimonial', 'Post type singular name', 'hello-elementor-child'),
        'menu_name'             => _x('Testimonials', 'Admin Menu text', 'hello-elementor-child'),
        'name_admin_bar'        => _x('Testimonial', 'Add New on Toolbar', 'hello-elementor-child'),
        'add_new'               => __('Add New', 'hello-elementor-child'),
        'add_new_item'          => __('Add New Testimonial', 'hello-elementor-child'),
        'new_item'              => __('New Testimonial', 'hello-elementor-child'),
        'edit_item'             => __('Edit Testimonial', 'hello-elementor-child'),
        'view_item'             => __('View Testimonial', 'hello-elementor-child'),
        'all_items'             => __('All Testimonials', 'hello-elementor-child'),
        'search_items'          => __('Search Testimonials', 'hello-elementor-child'),
        'parent_item_colon'     => __('Parent Testimonials:', 'hello-elementor-child'),
        'not_found'             => __('No testimonials found.', 'hello-elementor-child'),
        'not_found_in_trash'    => __('No testimonials found in Trash.', 'hello-elementor-child'),
        'featured_image'        => __('Testimonial Author Image', 'hello-elementor-child'),
        'set_featured_image'    => __('Set author image', 'hello-elementor-child'),
        'remove_featured_image' => __('Remove author image', 'hello-elementor-child'),
        'use_featured_image'    => __('Use as author image', 'hello-elementor-child'),
        'archives'              => __('Testimonial archives', 'hello-elementor-child'),
        'insert_into_item'      => __('Insert into testimonial', 'hello-elementor-child'),
        'uploaded_to_this_item' => __('Uploaded to this testimonial', 'hello-elementor-child'),
        'filter_items_list'     => __('Filter testimonials list', 'hello-elementor-child'),
        'items_list_navigation' => __('Testimonials list navigation', 'hello-elementor-child'),
        'items_list'            => __('Testimonials list', 'hello-elementor-child'),
    );

    $testimonial_args = array(
        'labels'             => $testimonial_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonial'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'show_in_rest'       => true,
    );

    register_post_type('testimonial', $testimonial_args);
}
add_action('init', 'bsv_register_custom_post_types');

/**
 * Add custom meta boxes for tour post type
 */
function bsv_add_tour_meta_boxes() {
    add_meta_box(
        'tour_details',
        __('Tour Details', 'hello-elementor-child'),
        'bsv_tour_details_callback',
        'tour',
        'normal',
        'high'
    );
    
    add_meta_box(
        'tour_itinerary',
        __('Tour Itinerary', 'hello-elementor-child'),
        'bsv_tour_itinerary_callback',
        'tour',
        'normal',
        'high'
    );
    
    add_meta_box(
        'tour_includes_excludes',
        __('Tour Includes/Excludes', 'hello-elementor-child'),
        'bsv_tour_includes_excludes_callback',
        'tour',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bsv_add_tour_meta_boxes');

/**
 * Tour details meta box callback
 */
function bsv_tour_details_callback($post) {
    // Add nonce for security
    wp_nonce_field('bsv_tour_details_nonce', 'tour_details_nonce');
    
    // Get saved values
    $tour_price = get_post_meta($post->ID, 'tour_price', true);
    $tour_duration = get_post_meta($post->ID, 'tour_duration', true);
    $tour_group_size = get_post_meta($post->ID, 'tour_group_size', true);
    $tour_difficulty = get_post_meta($post->ID, 'tour_difficulty', true);
    $tour_featured = get_post_meta($post->ID, 'tour_featured', true);
    $tour_highlights = get_post_meta($post->ID, 'tour_highlights', true);
    
    // Output form fields
    ?>
    <table class="form-table">
        <tr>
            <th><label for="tour_price"><?php _e('Tour Price ($)', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="text" id="tour_price" name="tour_price" value="<?php echo esc_attr($tour_price); ?>" class="regular-text">
                <p class="description"><?php _e('Enter the base price of the tour per person (numbers only, without currency symbol).', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="tour_duration"><?php _e('Tour Duration (Days)', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="number" id="tour_duration" name="tour_duration" value="<?php echo esc_attr($tour_duration); ?>" class="small-text" min="1">
                <p class="description"><?php _e('Enter the total duration of the tour in days.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="tour_group_size"><?php _e('Maximum Group Size', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="number" id="tour_group_size" name="tour_group_size" value="<?php echo esc_attr($tour_group_size); ?>" class="small-text" min="1">
                <p class="description"><?php _e('Enter the maximum number of people allowed in the tour group.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="tour_difficulty"><?php _e('Difficulty Level', 'hello-elementor-child'); ?></label></th>
            <td>
                <select id="tour_difficulty" name="tour_difficulty">
                    <option value=""><?php _e('-- Select Difficulty --', 'hello-elementor-child'); ?></option>
                    <option value="Easy" <?php selected($tour_difficulty, 'Easy'); ?>><?php _e('Easy', 'hello-elementor-child'); ?></option>
                    <option value="Moderate" <?php selected($tour_difficulty, 'Moderate'); ?>><?php _e('Moderate', 'hello-elementor-child'); ?></option>
                    <option value="Challenging" <?php selected($tour_difficulty, 'Challenging'); ?>><?php _e('Challenging', 'hello-elementor-child'); ?></option>
                    <option value="Difficult" <?php selected($tour_difficulty, 'Difficult'); ?>><?php _e('Difficult', 'hello-elementor-child'); ?></option>
                </select>
                <p class="description"><?php _e('Select the difficulty level of the tour.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="tour_featured"><?php _e('Featured Tour', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="checkbox" id="tour_featured" name="tour_featured" value="1" <?php checked($tour_featured, '1'); ?>>
                <label for="tour_featured"><?php _e('Mark this tour as featured', 'hello-elementor-child'); ?></label>
                <p class="description"><?php _e('Featured tours will be displayed prominently on the homepage and other key areas.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="tour_highlights"><?php _e('Tour Highlights', 'hello-elementor-child'); ?></label></th>
            <td>
                <textarea id="tour_highlights" name="tour_highlights" rows="5" class="large-text"><?php echo esc_textarea($tour_highlights); ?></textarea>
                <p class="description"><?php _e('Enter the key highlights of this tour. Use bullet points (- ) for each highlight.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Tour itinerary meta box callback
 */
function bsv_tour_itinerary_callback($post) {
    // Get saved value
    $tour_itinerary = get_post_meta($post->ID, 'tour_itinerary', true);
    
    // Output form field
    ?>
    <p><?php _e('Enter the detailed day-by-day itinerary for this tour.', 'hello-elementor-child'); ?></p>
    <p><?php _e('Format each day as follows:', 'hello-elementor-child'); ?></p>
    <pre><code>Day 1: Welcome to [Destination]
- Morning: [Activity]
- Afternoon: [Activity]
- Evening: [Activity]
- Meals: Breakfast, Lunch
- Accommodation: [Hotel Name]

Day 2: [Title]
...and so on</code></pre>
    
    <textarea id="tour_itinerary" name="tour_itinerary" rows="15" class="large-text" style="width: 100%;"><?php echo esc_textarea($tour_itinerary); ?></textarea>
    <p class="description"><?php _e('The itinerary will be displayed in the Itinerary tab on the tour page.', 'hello-elementor-child'); ?></p>
    <?php
}

/**
 * Tour includes/excludes meta box callback
 */
function bsv_tour_includes_excludes_callback($post) {
    // Get saved values
    $tour_includes = get_post_meta($post->ID, 'tour_includes', true);
    $tour_excludes = get_post_meta($post->ID, 'tour_excludes', true);
    
    // Output form fields
    ?>
    <div style="display: flex; gap: 20px;">
        <div style="flex: 1;">
            <h4><?php _e('What\'s Included', 'hello-elementor-child'); ?></h4>
            <p><?php _e('List items that are included in the tour price. Use bullet points (- ) for each item.', 'hello-elementor-child'); ?></p>
            <textarea id="tour_includes" name="tour_includes" rows="10" style="width: 100%;"><?php echo esc_textarea($tour_includes); ?></textarea>
            <p class="description"><?php _e('Example: - Professional English-speaking guide<br>- Accommodation in 3-star hotels<br>- Daily breakfast', 'hello-elementor-child'); ?></p>
        </div>
        
        <div style="flex: 1;">
            <h4><?php _e('What\'s Not Included', 'hello-elementor-child'); ?></h4>
            <p><?php _e('List items that are NOT included in the tour price. Use bullet points (- ) for each item.', 'hello-elementor-child'); ?></p>
            <textarea id="tour_excludes" name="tour_excludes" rows="10" style="width: 100%;"><?php echo esc_textarea($tour_excludes); ?></textarea>
            <p class="description"><?php _e('Example: - International flights<br>- Travel insurance<br>- Personal expenses', 'hello-elementor-child'); ?></p>
        </div>
    </div>
    <?php
}

/**
 * Save tour meta data
 */
function bsv_save_tour_meta($post_id) {
    // Check if nonce is set
    if (!isset($_POST['tour_details_nonce'])) {
        return;
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['tour_details_nonce'], 'bsv_tour_details_nonce')) {
        return;
    }
    
    // If this is an autosave, don't do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Tour details
    if (isset($_POST['tour_price'])) {
        update_post_meta($post_id, 'tour_price', sanitize_text_field($_POST['tour_price']));
    }
    
    if (isset($_POST['tour_duration'])) {
        update_post_meta($post_id, 'tour_duration', sanitize_text_field($_POST['tour_duration']));
    }
    
    if (isset($_POST['tour_group_size'])) {
        update_post_meta($post_id, 'tour_group_size', sanitize_text_field($_POST['tour_group_size']));
    }
    
    if (isset($_POST['tour_difficulty'])) {
        update_post_meta($post_id, 'tour_difficulty', sanitize_text_field($_POST['tour_difficulty']));
    }
    
    // Featured tour (checkbox)
    $tour_featured = isset($_POST['tour_featured']) ? '1' : '0';
    update_post_meta($post_id, 'tour_featured', $tour_featured);
    
    if (isset($_POST['tour_highlights'])) {
        update_post_meta($post_id, 'tour_highlights', wp_kses_post($_POST['tour_highlights']));
    }
    
    // Tour itinerary
    if (isset($_POST['tour_itinerary'])) {
        update_post_meta($post_id, 'tour_itinerary', wp_kses_post($_POST['tour_itinerary']));
    }
    
    // Tour includes/excludes
    if (isset($_POST['tour_includes'])) {
        update_post_meta($post_id, 'tour_includes', wp_kses_post($_POST['tour_includes']));
    }
    
    if (isset($_POST['tour_excludes'])) {
        update_post_meta($post_id, 'tour_excludes', wp_kses_post($_POST['tour_excludes']));
    }
}
add_action('save_post_tour', 'bsv_save_tour_meta');

/**
 * Add custom meta boxes for destination post type
 */
function bsv_add_destination_meta_boxes() {
    add_meta_box(
        'destination_details',
        __('Destination Details', 'hello-elementor-child'),
        'bsv_destination_details_callback',
        'destination',
        'normal',
        'high'
    );
    
    add_meta_box(
        'destination_info',
        __('Travel Information', 'hello-elementor-child'),
        'bsv_destination_info_callback',
        'destination',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bsv_add_destination_meta_boxes');

/**
 * Destination details meta box callback
 */
function bsv_destination_details_callback($post) {
    // Add nonce for security
    wp_nonce_field('bsv_destination_details_nonce', 'destination_details_nonce');
    
    // Get saved values
    $destination_location = get_post_meta($post->ID, 'destination_location', true);
    $featured_destination = get_post_meta($post->ID, 'featured_destination', true);
    $destination_highlights = get_post_meta($post->ID, 'destination_highlights', true);
    $destination_attractions = get_post_meta($post->ID, 'destination_attractions', true);
    
    // Output form fields
    ?>
    <table class="form-table">
        <tr>
            <th><label for="destination_location"><?php _e('Location', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="text" id="destination_location" name="destination_location" value="<?php echo esc_attr($destination_location); ?>" class="regular-text">
                <p class="description"><?php _e('Enter the precise location of this destination (e.g., "Seoul, South Korea").', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="featured_destination"><?php _e('Featured Destination', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="checkbox" id="featured_destination" name="featured_destination" value="1" <?php checked($featured_destination, '1'); ?>>
                <label for="featured_destination"><?php _e('Mark this as a featured destination', 'hello-elementor-child'); ?></label>
                <p class="description"><?php _e('Featured destinations will be displayed prominently on the homepage and other key areas.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="destination_highlights"><?php _e('Destination Highlights', 'hello-elementor-child'); ?></label></th>
            <td>
                <textarea id="destination_highlights" name="destination_highlights" rows="5" class="large-text"><?php echo esc_textarea($destination_highlights); ?></textarea>
                <p class="description"><?php _e('Enter the key highlights of this destination. Use bullet points (- ) for each highlight.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="destination_attractions"><?php _e('Top Attractions', 'hello-elementor-child'); ?></label></th>
            <td>
                <textarea id="destination_attractions" name="destination_attractions" rows="8" class="large-text"><?php echo esc_textarea($destination_attractions); ?></textarea>
                <p class="description"><?php _e('List the top attractions in this destination. Use headers (## Attraction Name) for each attraction followed by a description.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Destination info meta box callback
 */
function bsv_destination_info_callback($post) {
    // Get saved values
    $best_time_to_visit = get_post_meta($post->ID, 'best_time_to_visit', true);
    $language = get_post_meta($post->ID, 'language', true);
    $currency = get_post_meta($post->ID, 'currency', true);
    $timezone = get_post_meta($post->ID, 'timezone', true);
    $destination_tips = get_post_meta($post->ID, 'destination_tips', true);
    $destination_faq = get_post_meta($post->ID, 'destination_faq', true);
    
    // Output form fields
    ?>
    <table class="form-table">
        <tr>
            <th><label for="best_time_to_visit"><?php _e('Best Time to Visit', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="text" id="best_time_to_visit" name="best_time_to_visit" value="<?php echo esc_attr($best_time_to_visit); ?>" class="regular-text">
                <p class="description"><?php _e('Example: "April to June and September to November"', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="language"><?php _e('Language', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="text" id="language" name="language" value="<?php echo esc_attr($language); ?>" class="regular-text">
                <p class="description"><?php _e('Example: "Korean (official), English (widely spoken in tourist areas)"', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="currency"><?php _e('Currency', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="text" id="currency" name="currency" value="<?php echo esc_attr($currency); ?>" class="regular-text">
                <p class="description"><?php _e('Example: "South Korean Won (KRW)"', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="timezone"><?php _e('Time Zone', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="text" id="timezone" name="timezone" value="<?php echo esc_attr($timezone); ?>" class="regular-text">
                <p class="description"><?php _e('Example: "Korea Standard Time (GMT+9)"', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="destination_tips"><?php _e('Travel Tips', 'hello-elementor-child'); ?></label></th>
            <td>
                <textarea id="destination_tips" name="destination_tips" rows="5" class="large-text"><?php echo esc_textarea($destination_tips); ?></textarea>
                <p class="description"><?php _e('Provide helpful travel tips for visitors. Use bullet points (- ) for each tip.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="destination_faq"><?php _e('Frequently Asked Questions', 'hello-elementor-child'); ?></label></th>
            <td>
                <textarea id="destination_faq" name="destination_faq" rows="8" class="large-text"><?php echo esc_textarea($destination_faq); ?></textarea>
                <p class="description"><?php _e('Format each FAQ as follows:<br>**Q: Question here?**<br>A: Answer here.<br><br>**Q: Next question?**<br>A: Next answer.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
    </table>
    <?php
}

/**
 * Save destination meta data
 */
function bsv_save_destination_meta($post_id) {
    // Check if nonce is set
    if (!isset($_POST['destination_details_nonce'])) {
        return;
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['destination_details_nonce'], 'bsv_destination_details_nonce')) {
        return;
    }
    
    // If this is an autosave, don't do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Destination details
    if (isset($_POST['destination_location'])) {
        update_post_meta($post_id, 'destination_location', sanitize_text_field($_POST['destination_location']));
    }
    
    // Featured destination (checkbox)
    $featured_destination = isset($_POST['featured_destination']) ? '1' : '0';
    update_post_meta($post_id, 'featured_destination', $featured_destination);
    
    if (isset($_POST['destination_highlights'])) {
        update_post_meta($post_id, 'destination_highlights', wp_kses_post($_POST['destination_highlights']));
    }
    
    if (isset($_POST['destination_attractions'])) {
        update_post_meta($post_id, 'destination_attractions', wp_kses_post($_POST['destination_attractions']));
    }
    
    // Travel information
    if (isset($_POST['best_time_to_visit'])) {
        update_post_meta($post_id, 'best_time_to_visit', sanitize_text_field($_POST['best_time_to_visit']));
    }
    
    if (isset($_POST['language'])) {
        update_post_meta($post_id, 'language', sanitize_text_field($_POST['language']));
    }
    
    if (isset($_POST['currency'])) {
        update_post_meta($post_id, 'currency', sanitize_text_field($_POST['currency']));
    }
    
    if (isset($_POST['timezone'])) {
        update_post_meta($post_id, 'timezone', sanitize_text_field($_POST['timezone']));
    }
    
    if (isset($_POST['destination_tips'])) {
        update_post_meta($post_id, 'destination_tips', wp_kses_post($_POST['destination_tips']));
    }
    
    if (isset($_POST['destination_faq'])) {
        update_post_meta($post_id, 'destination_faq', wp_kses_post($_POST['destination_faq']));
    }
}
add_action('save_post_destination', 'bsv_save_destination_meta');

/**
 * Add custom meta boxes for testimonial post type
 */
function bsv_add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        __('Testimonial Details', 'hello-elementor-child'),
        'bsv_testimonial_details_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'bsv_add_testimonial_meta_boxes');

/**
 * Testimonial details meta box callback
 */
function bsv_testimonial_details_callback($post) {
    // Add nonce for security
    wp_nonce_field('bsv_testimonial_details_nonce', 'testimonial_details_nonce');
    
    // Get saved values
    $testimonial_tour = get_post_meta($post->ID, 'testimonial_tour', true);
    $testimonial_location = get_post_meta($post->ID, 'testimonial_location', true);
    $testimonial_rating = get_post_meta($post->ID, 'testimonial_rating', true);
    
    // Output form fields
    ?>
    <table class="form-table">
        <tr>
            <th><label for="testimonial_tour"><?php _e('Tour Name', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="text" id="testimonial_tour" name="testimonial_tour" value="<?php echo esc_attr($testimonial_tour); ?>" class="regular-text">
                <p class="description"><?php _e('Enter the name of the tour the customer participated in.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="testimonial_location"><?php _e('Customer Location', 'hello-elementor-child'); ?></label></th>
            <td>
                <input type="text" id="testimonial_location" name="testimonial_location" value="<?php echo esc_attr($testimonial_location); ?>" class="regular-text">
                <p class="description"><?php _e('Enter the location of the customer (e.g., "New York, USA").', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="testimonial_rating"><?php _e('Rating', 'hello-elementor-child'); ?></label></th>
            <td>
                <select id="testimonial_rating" name="testimonial_rating">
                    <option value=""><?php _e('-- Select Rating --', 'hello-elementor-child'); ?></option>
                    <option value="5" <?php selected($testimonial_rating, '5'); ?>><?php _e('5 Stars', 'hello-elementor-child'); ?></option>
                    <option value="4" <?php selected($testimonial_rating, '4'); ?>><?php _e('4 Stars', 'hello-elementor-child'); ?></option>
                    <option value="3" <?php selected($testimonial_rating, '3'); ?>><?php _e('3 Stars', 'hello-elementor-child'); ?></option>
                    <option value="2" <?php selected($testimonial_rating, '2'); ?>><?php _e('2 Stars', 'hello-elementor-child'); ?></option>
                    <option value="1" <?php selected($testimonial_rating, '1'); ?>><?php _e('1 Star', 'hello-elementor-child'); ?></option>
                </select>
                <p class="description"><?php _e('Select the rating given by the customer.', 'hello-elementor-child'); ?></p>
            </td>
        </tr>
    </table>
    <p><?php _e('Use the main content area to add the testimonial text.', 'hello-elementor-child'); ?></p>
    <?php
}

/**
 * Save testimonial meta data
 */
function bsv_save_testimonial_meta($post_id) {
    // Check if nonce is set
    if (!isset($_POST['testimonial_details_nonce'])) {
        return;
    }
    
    // Verify nonce
    if (!wp_verify_nonce($_POST['testimonial_details_nonce'], 'bsv_testimonial_details_nonce')) {
        return;
    }
    
    // If this is an autosave, don't do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    // Testimonial details
    if (isset($_POST['testimonial_tour'])) {
        update_post_meta($post_id, 'testimonial_tour', sanitize_text_field($_POST['testimonial_tour']));
    }
    
    if (isset($_POST['testimonial_location'])) {
        update_post_meta($post_id, 'testimonial_location', sanitize_text_field($_POST['testimonial_location']));
    }
    
    if (isset($_POST['testimonial_rating'])) {
        update_post_meta($post_id, 'testimonial_rating', sanitize_text_field($_POST['testimonial_rating']));
    }
}
add_action('save_post_testimonial', 'bsv_save_testimonial_meta');

/**
 * Register columns for tour post type in admin
 */
function bsv_tour_admin_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key == 'title') {
            $new_columns[$key] = $value;
            $new_columns['featured'] = __('Featured', 'hello-elementor-child');
            $new_columns['price'] = __('Price', 'hello-elementor-child');
            $new_columns['duration'] = __('Duration', 'hello-elementor-child');
            $new_columns['difficulty'] = __('Difficulty', 'hello-elementor-child');
        } else {
            $new_columns[$key] = $value;
        }
    }
    return $new_columns;
}
add_filter('manage_tour_posts_columns', 'bsv_tour_admin_columns');

/**
 * Display custom column content for tour post type
 */
function bsv_tour_custom_column($column, $post_id) {
    switch ($column) {
        case 'featured':
            $featured = get_post_meta($post_id, 'tour_featured', true);
            echo $featured ? '<span class="dashicons dashicons-star-filled" style="color: #ffb900;"></span>' : '<span class="dashicons dashicons-star-empty"></span>';
            break;
        
        case 'price':
            $price = get_post_meta($post_id, 'tour_price', true);
            echo $price ? '$' . esc_html($price) : '—';
            break;
            
        case 'duration':
            $duration = get_post_meta($post_id, 'tour_duration', true);
            echo $duration ? esc_html($duration) . ' ' . __('days', 'hello-elementor-child') : '—';
            break;
            
        case 'difficulty':
            $difficulty = get_post_meta($post_id, 'tour_difficulty', true);
            echo $difficulty ? esc_html($difficulty) : '—';
            break;
    }
}
add_action('manage_tour_posts_custom_column', 'bsv_tour_custom_column', 10, 2);

/**
 * Make custom columns sortable
 */
function bsv_sortable_columns($columns) {
    $columns['price'] = 'price';
    $columns['duration'] = 'duration';
    $columns['difficulty'] = 'difficulty';
    $columns['featured'] = 'featured';
    return $columns;
}
add_filter('manage_edit-tour_sortable_columns', 'bsv_sortable_columns');

/**
 * Adjust query for custom sort
 */
function bsv_tours_orderby($query) {
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== 'tour') {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ($orderby === 'price') {
        $query->set('meta_key', 'tour_price');
        $query->set('orderby', 'meta_value_num');
    }
    
    if ($orderby === 'duration') {
        $query->set('meta_key', 'tour_duration');
        $query->set('orderby', 'meta_value_num');
    }
    
    if ($orderby === 'difficulty') {
        $query->set('meta_key', 'tour_difficulty');
        $query->set('orderby', 'meta_value');
    }
    
    if ($orderby === 'featured') {
        $query->set('meta_key', 'tour_featured');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'bsv_tours_orderby');

/**
 * Register columns for destination post type in admin
 */
function bsv_destination_admin_columns($columns) {
    $new_columns = array();
    foreach ($columns as $key => $value) {
        if ($key == 'title') {
            $new_columns[$key] = $value;
            $new_columns['featured'] = __('Featured', 'hello-elementor-child');
            $new_columns['location'] = __('Location', 'hello-elementor-child');
            $new_columns['continent'] = __('Continent', 'hello-elementor-child');
        } else {
            $new_columns[$key] = $value;
        }
    }
    return $new_columns;
}
add_filter('manage_destination_posts_columns', 'bsv_destination_admin_columns');

/**
 * Display custom column content for destination post type
 */
function bsv_destination_custom_column($column, $post_id) {
    switch ($column) {
        case 'featured':
            $featured = get_post_meta($post_id, 'featured_destination', true);
            echo $featured ? '<span class="dashicons dashicons-star-filled" style="color: #ffb900;"></span>' : '<span class="dashicons dashicons-star-empty"></span>';
            break;
        
        case 'location':
            $location = get_post_meta($post_id, 'destination_location', true);
            echo $location ? esc_html($location) : '—';
            break;
            
        case 'continent':
            $terms = get_the_terms($post_id, 'destination_continent');
            if (!empty($terms) && !is_wp_error($terms)) {
                $continent_links = array();
                foreach ($terms as $term) {
                    $continent_links[] = '<a href="' . esc_url(admin_url('edit.php?post_type=destination&destination_continent=' . $term->slug)) . '">' . esc_html($term->name) . '</a>';
                }
                echo implode(', ', $continent_links);
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_destination_posts_custom_column', 'bsv_destination_custom_column', 10, 2);

/**
 * Make destination custom columns sortable
 */
function bsv_sortable_destination_columns($columns) {
    $columns['featured'] = 'featured';
    $columns['location'] = 'location';
    return $columns;
}
add_filter('manage_edit-destination_sortable_columns', 'bsv_sortable_destination_columns');

/**
 * Adjust query for destination custom sort
 */
function bsv_destinations_orderby($query) {
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== 'destination') {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ($orderby === 'featured') {
        $query->set('meta_key', 'featured_destination');
        $query->set('orderby', 'meta_value_num');
    }
    
    if ($orderby === 'location') {
        $query->set('meta_key', 'destination_location');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'bsv_destinations_orderby');

/**
 * Register columns for testimonial post type in admin
 */
function bsv_testimonial_admin_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'],
        'image' => __('Author Image', 'hello-elementor-child'),
        'title' => __('Author Name', 'hello-elementor-child'),
        'tour' => __('Tour', 'hello-elementor-child'),
        'location' => __('Location', 'hello-elementor-child'),
        'rating' => __('Rating', 'hello-elementor-child'),
        'date' => $columns['date'],
    );
    return $columns;
}
add_filter('manage_testimonial_posts_columns', 'bsv_testimonial_admin_columns');

/**
 * Display custom column content for testimonial post type
 */
function bsv_testimonial_custom_column($column, $post_id) {
    switch ($column) {
        case 'image':
            if (has_post_thumbnail($post_id)) {
                echo '<img src="' . get_the_post_thumbnail_url($post_id, 'thumbnail') . '" width="50" height="50" style="border-radius: 50%;" />';
            } else {
                echo '<img src="' . get_stylesheet_directory_uri() . '/assets/default-avatar.jpg" width="50" height="50" style="border-radius: 50%;" />';
            }
            break;
        
        case 'tour':
            $tour = get_post_meta($post_id, 'testimonial_tour', true);
            echo $tour ? esc_html($tour) : '—';
            break;
            
        case 'location':
            $location = get_post_meta($post_id, 'testimonial_location', true);
            echo $location ? esc_html($location) : '—';
            break;
            
        case 'rating':
            $rating = get_post_meta($post_id, 'testimonial_rating', true);
            if ($rating) {
                $stars = '';
                for ($i = 1; $i <= 5; $i++) {
                    if ($i <= $rating) {
                        $stars .= '<span class="dashicons dashicons-star-filled" style="color: #ffb900;"></span>';
                    } else {
                        $stars .= '<span class="dashicons dashicons-star-empty" style="color: #aaa;"></span>';
                    }
                }
                echo $stars;
            } else {
                echo '—';
            }
            break;
    }
}
add_action('manage_testimonial_posts_custom_column', 'bsv_testimonial_custom_column', 10, 2);

/**
 * Make testimonial custom columns sortable
 */
function bsv_sortable_testimonial_columns($columns) {
    $columns['rating'] = 'rating';
    return $columns;
}
add_filter('manage_edit-testimonial_sortable_columns', 'bsv_sortable_testimonial_columns');

/**
 * Adjust query for testimonial custom sort
 */
function bsv_testimonials_orderby($query) {
    if (!is_admin() || !$query->is_main_query() || $query->get('post_type') !== 'testimonial') {
        return;
    }
    
    $orderby = $query->get('orderby');
    
    if ($orderby === 'rating') {
        $query->set('meta_key', 'testimonial_rating');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'bsv_testimonials_orderby');

/**
 * Add filter dropdowns for tours admin
 */
function bsv_add_tour_filters() {
    global $typenow;
    
    if ($typenow === 'tour') {
        // Filter by tour category
        $taxonomy = 'tour_category';
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf(__('All %s', 'hello-elementor-child'), $info_taxonomy->labels->name),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => true,
            'hide_empty' => true,
            'value_field' => 'slug',
        ));
        
        // Filter by destination
        $taxonomy = 'destination_category';
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf(__('All %s', 'hello-elementor-child'), $info_taxonomy->labels->name),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => true,
            'hide_empty' => true,
            'value_field' => 'slug',
        ));
        
        // Filter by featured status
        $featured = isset($_GET['featured']) ? $_GET['featured'] : '';
        ?>
        <select name="featured">
            <option value=""><?php _e('All Tours', 'hello-elementor-child'); ?></option>
            <option value="1" <?php selected($featured, '1'); ?>><?php _e('Featured Only', 'hello-elementor-child'); ?></option>
            <option value="0" <?php selected($featured, '0'); ?>><?php _e('Not Featured', 'hello-elementor-child'); ?></option>
        </select>
        <?php
        
        // Filter by difficulty
        $difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : '';
        ?>
        <select name="difficulty">
            <option value=""><?php _e('All Difficulties', 'hello-elementor-child'); ?></option>
            <option value="Easy" <?php selected($difficulty, 'Easy'); ?>><?php _e('Easy', 'hello-elementor-child'); ?></option>
            <option value="Moderate" <?php selected($difficulty, 'Moderate'); ?>><?php _e('Moderate', 'hello-elementor-child'); ?></option>
            <option value="Challenging" <?php selected($difficulty, 'Challenging'); ?>><?php _e('Challenging', 'hello-elementor-child'); ?></option>
            <option value="Difficult" <?php selected($difficulty, 'Difficult'); ?>><?php _e('Difficult', 'hello-elementor-child'); ?></option>
        </select>
        <?php
    }
    
    if ($typenow === 'destination') {
        // Filter by continent
        $taxonomy = 'destination_continent';
        $selected = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
        $info_taxonomy = get_taxonomy($taxonomy);
        wp_dropdown_categories(array(
            'show_option_all' => sprintf(__('All %s', 'hello-elementor-child'), $info_taxonomy->labels->name),
            'taxonomy' => $taxonomy,
            'name' => $taxonomy,
            'orderby' => 'name',
            'selected' => $selected,
            'show_count' => true,
            'hide_empty' => true,
            'value_field' => 'slug',
        ));
        
        // Filter by featured status
        $featured = isset($_GET['featured']) ? $_GET['featured'] : '';
        ?>
        <select name="featured">
            <option value=""><?php _e('All Destinations', 'hello-elementor-child'); ?></option>
            <option value="1" <?php selected($featured, '1'); ?>><?php _e('Featured Only', 'hello-elementor-child'); ?></option>
            <option value="0" <?php selected($featured, '0'); ?>><?php _e('Not Featured', 'hello-elementor-child'); ?></option>
        </select>
        <?php
    }
}
add_action('restrict_manage_posts', 'bsv_add_tour_filters');

/**
 * Modify query vars for custom filters
 */
function bsv_filter_request_query($query_vars) {
    global $typenow;
    
    if ($typenow === 'tour') {
        // Featured filter
        if (isset($_GET['featured']) && $_GET['featured'] !== '') {
            $query_vars['meta_key'] = 'tour_featured';
            $query_vars['meta_value'] = $_GET['featured'];
        }
        
        // Difficulty filter
        if (isset($_GET['difficulty']) && $_GET['difficulty'] !== '') {
            $query_vars['meta_key'] = 'tour_difficulty';
            $query_vars['meta_value'] = $_GET['difficulty'];
        }
    }
    
    if ($typenow === 'destination') {
        // Featured filter
        if (isset($_GET['featured']) && $_GET['featured'] !== '') {
            $query_vars['meta_key'] = 'featured_destination';
            $query_vars['meta_value'] = $_GET['featured'];
        }
    }
    
    return $query_vars;
}
add_filter('request', 'bsv_filter_request_query');
