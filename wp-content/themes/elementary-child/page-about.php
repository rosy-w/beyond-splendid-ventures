<?php
/**
 * Template Name: About Page
 *
 * The template for displaying the about page
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
        // About Hero Section
        ?>
        <section class="about-hero hero-section">
            <?php
            // Get the featured image as hero background
            if (has_post_thumbnail()) {
                echo '<img class="hero-background" src="' . get_the_post_thumbnail_url(get_the_ID(), 'hero-image') . '" alt="' . get_the_title() . '">';
            } else {
                // Default image if no featured image is set
                echo '<img class="hero-background" src="' . get_stylesheet_directory_uri() . '/assets/default-about-hero.jpg" alt="About Beyond Splendid Ventures">';
            }
            ?>
            <div class="hero-content">
                <h1 class="hero-title">About Beyond Splendid Ventures</h1>
                <p class="hero-subtitle">Crafting unforgettable travel experiences since 2010</p>
            </div>
        </section>

        <?php
        // About Us Section
        ?>
        <section class="about-section">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-content">
                            <h2>Our Story</h2>
                            <p>Beyond Splendid Ventures was founded in 2010 with a simple mission: to create extraordinary travel experiences that transform lives. What began as a small operation has grown into a leading travel agency known for exceptional service and unique itineraries.</p>
                            
                            <p>Our founders, seasoned travelers themselves, realized that the most memorable journeys aren't just about visiting popular attractions, but about authentic experiences, cultural immersion, and creating lasting memories.</p>
                            
                            <p>Today, we continue to uphold these values, crafting customized travel experiences that go beyond the ordinary, taking you to places both iconic and off the beaten path.</p>
                            
                            <h3>Our Mission</h3>
                            <p>To create exceptional travel experiences that inspire, educate, and transform, while promoting sustainable tourism and respecting local cultures and environments.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-image">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/about-image.jpg" alt="About Beyond Splendid Ventures">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Why Choose Us Section
        ?>
        <section class="why-choose-us">
            <div class="container">
                <div class="section-title">
                    <h2>Why Choose Us</h2>
                    <p class="section-subtitle">What sets Beyond Splendid Ventures apart from other travel agencies</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="far fa-gem"></i>
                            </div>
                            <h3 class="feature-title">Personalized Service</h3>
                            <p class="feature-description">We take the time to understand your travel preferences, interests, and needs to create a customized experience just for you.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-map-marked-alt"></i>
                            </div>
                            <h3 class="feature-title">Expert Knowledge</h3>
                            <p class="feature-description">Our team of experienced travel experts has in-depth knowledge of destinations around the world.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <h3 class="feature-title">Value for Money</h3>
                            <p class="feature-description">We offer competitive pricing without compromising on quality, ensuring you get the best value for your investment.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="feature-box">
                            <div class="feature-icon">
                                <i class="fas fa-headset"></i>
                            </div>
                            <h3 class="feature-title">24/7 Support</h3>
                            <p class="feature-description">Our dedicated support team is available round the clock to assist you before, during, and after your journey.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Our Values Section
        ?>
        <section class="our-values-section">
            <div class="container">
                <div class="section-title">
                    <h2>Our Values</h2>
                    <p class="section-subtitle">The principles that guide everything we do</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="value-item">
                            <div class="value-icon">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <div class="value-content">
                                <h3>Authenticity</h3>
                                <p>We believe in creating genuine experiences that reflect the true essence of each destination, connecting travelers with local cultures, traditions, and people.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="value-item">
                            <div class="value-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <div class="value-content">
                                <h3>Sustainability</h3>
                                <p>We are committed to responsible tourism that respects the environment, supports local communities, and preserves cultural heritage for future generations.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="value-item">
                            <div class="value-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="value-content">
                                <h3>Excellence</h3>
                                <p>We strive for excellence in every aspect of our service, from meticulous planning and attention to detail to exceeding our clients' expectations.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="value-item">
                            <div class="value-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="value-content">
                                <h3>Community</h3>
                                <p>We build meaningful relationships with our clients, partners, and the communities we visit, fostering a global network of passionate travelers.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Team Section
        ?>
        <section class="team-section">
            <div class="container">
                <div class="section-title">
                    <h2>Meet Our Team</h2>
                    <p class="section-subtitle">The passionate travel experts behind Beyond Splendid Ventures</p>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="team-member">
                            <div class="team-member-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/team-member-1.jpg" alt="Team Member">
                            </div>
                            <h3 class="team-member-name">Sarah Johnson</h3>
                            <p class="team-member-position">Founder & CEO</p>
                            <p class="team-member-bio">Sarah has visited over 80 countries and brings 15+ years of experience in the travel industry. Her passion for authentic travel experiences was the foundation for Beyond Splendid Ventures.</p>
                            <div class="team-member-social">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="team-member">
                            <div class="team-member-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/team-member-2.jpg" alt="Team Member">
                            </div>
                            <h3 class="team-member-name">Michael Lee</h3>
                            <p class="team-member-position">Travel Director</p>
                            <p class="team-member-bio">Michael specializes in adventure travel and eco-tourism. With a background in environmental science, he ensures our tours are both exciting and sustainable.</p>
                            <div class="team-member-social">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="team-member">
                            <div class="team-member-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/team-member-3.jpg" alt="Team Member">
                            </div>
                            <h3 class="team-member-name">Amelia Rodriguez</h3>
                            <p class="team-member-position">Destination Specialist</p>
                            <p class="team-member-bio">Amelia is our expert on cultural immersion and unique local experiences. She works closely with local communities to create authentic travel opportunities.</p>
                            <div class="team-member-social">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-lg-3">
                        <div class="team-member">
                            <div class="team-member-image">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/team-member-4.jpg" alt="Team Member">
                            </div>
                            <h3 class="team-member-name">David Chen</h3>
                            <p class="team-member-position">Customer Experience Manager</p>
                            <p class="team-member-bio">David ensures every aspect of your journey exceeds expectations. His attention to detail and commitment to service excellence make each trip special.</p>
                            <div class="team-member-social">
                                <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Testimonials Section
        get_template_part('template-parts/testimonials');
        ?>

        <?php
        // Partners Section
        ?>
        <section class="partners-section">
            <div class="container">
                <div class="section-title">
                    <h2>Our Partners</h2>
                    <p class="section-subtitle">We work with trusted companies around the world</p>
                </div>
                
                <div class="partners-logos">
                    <div class="row align-items-center">
                        <div class="col-6 col-md-3">
                            <div class="partner-logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/partner-logo-1.jpg" alt="Partner Logo">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="partner-logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/partner-logo-2.jpg" alt="Partner Logo">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="partner-logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/partner-logo-3.jpg" alt="Partner Logo">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="partner-logo">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/partner-logo-4.jpg" alt="Partner Logo">
                            </div>
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
                <h2 class="cta-title">Ready to Plan Your Adventure?</h2>
                <p class="cta-description">Contact our team of travel experts today to start planning your perfect trip with Beyond Splendid Ventures.</p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="cta-button">Contact Us Now</a>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
