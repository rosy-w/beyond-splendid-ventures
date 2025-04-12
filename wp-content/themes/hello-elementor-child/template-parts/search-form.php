<?php
/**
 * Template part for displaying search form
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elementary Child
 */

$search_type = isset($args['type']) ? $args['type'] : 'general';
$custom_class = isset($args['class']) ? $args['class'] : '';
$placeholder = isset($args['placeholder']) ? $args['placeholder'] : 'Search...';
?>

<?php if ($search_type === 'tour') : ?>
    <!-- Tour Search Form -->
    <form role="search" method="get" class="search-form tour-search-form <?php echo esc_attr($custom_class); ?>" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tour_search"><?php echo esc_html__('Search Tours', 'elementary-child'); ?></label>
                    <input type="text" id="tour_search" class="form-control" placeholder="<?php echo esc_attr($placeholder); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                    <input type="hidden" name="post_type" value="tour" />
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tour_destination"><?php echo esc_html__('Destination', 'elementary-child'); ?></label>
                    <?php
                    $destinations = get_terms(array(
                        'taxonomy' => 'destination_category',
                        'hide_empty' => true,
                    ));
                    
                    if (!empty($destinations) && !is_wp_error($destinations)) :
                    ?>
                        <select id="tour_destination" name="destination_category" class="form-control">
                            <option value=""><?php echo esc_html__('All Destinations', 'elementary-child'); ?></option>
                            <?php foreach ($destinations as $destination) : ?>
                                <option value="<?php echo esc_attr($destination->slug); ?>"><?php echo esc_html($destination->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tour_duration"><?php echo esc_html__('Duration', 'elementary-child'); ?></label>
                    <select id="tour_duration" name="duration" class="form-control">
                        <option value=""><?php echo esc_html__('Any Duration', 'elementary-child'); ?></option>
                        <option value="1-3"><?php echo esc_html__('1-3 Days', 'elementary-child'); ?></option>
                        <option value="4-7"><?php echo esc_html__('4-7 Days', 'elementary-child'); ?></option>
                        <option value="8-14"><?php echo esc_html__('8-14 Days', 'elementary-child'); ?></option>
                        <option value="15+"><?php echo esc_html__('15+ Days', 'elementary-child'); ?></option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="form-group">
                    <label for="tour_submit">&nbsp;</label>
                    <button type="submit" id="tour_submit" class="btn btn-primary btn-block"><?php echo esc_html__('Search Tours', 'elementary-child'); ?></button>
                </div>
            </div>
        </div>
    </form>

<?php elseif ($search_type === 'destination') : ?>
    <!-- Destination Search Form -->
    <form role="search" method="get" class="search-form destination-search-form <?php echo esc_attr($custom_class); ?>" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="row">
            <div class="col-md-9">
                <input type="text" class="form-control" placeholder="<?php echo esc_attr($placeholder); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                <input type="hidden" name="post_type" value="destination" />
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-block"><?php echo esc_html__('Search', 'elementary-child'); ?></button>
            </div>
        </div>
    </form>

<?php elseif ($search_type === 'header') : ?>
    <!-- Header Search Form -->
    <div class="header-search-form-wrapper">
        <form role="search" method="get" class="search-form header-search-form <?php echo esc_attr($custom_class); ?>" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="<?php echo esc_attr($placeholder); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="search-categories">
                <label>
                    <input type="radio" name="post_type" value="post" checked />
                    <?php echo esc_html__('Blog', 'elementary-child'); ?>
                </label>
                <label>
                    <input type="radio" name="post_type" value="tour" />
                    <?php echo esc_html__('Tours', 'elementary-child'); ?>
                </label>
                <label>
                    <input type="radio" name="post_type" value="destination" />
                    <?php echo esc_html__('Destinations', 'elementary-child'); ?>
                </label>
            </div>
        </form>
    </div>

<?php else : ?>
    <!-- General Search Form -->
    <form role="search" method="get" class="search-form <?php echo esc_attr($custom_class); ?>" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="<?php echo esc_attr($placeholder); ?>" value="<?php echo get_search_query(); ?>" name="s" />
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> <?php echo esc_html__('Search', 'elementary-child'); ?>
                </button>
            </div>
        </div>
    </form>
<?php endif; ?>
