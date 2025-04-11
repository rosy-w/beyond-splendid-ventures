<?php
/**
 * Template Name: Contact Page
 *
 * The template for displaying the contact page
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
        // Contact Info Section
        ?>
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div class="contact-info">
                            <h2>Get in Touch</h2>
                            <p>Have questions about our tours or need help planning your next adventure? Our travel experts are here to help you.</p>
                            
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Our Location</h4>
                                    <p>123 Adventure Street<br>Travel City, TC 10001<br>United States</p>
                                </div>
                            </div>
                            
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Phone Number</h4>
                                    <p>Toll Free: +1 800 123 4567<br>International: +1 987 654 3210</p>
                                </div>
                            </div>
                            
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Email Address</h4>
                                    <p>info@beyondsplendidventures.com<br>support@beyondsplendidventures.com</p>
                                </div>
                            </div>
                            
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="contact-info-content">
                                    <h4>Office Hours</h4>
                                    <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                                </div>
                            </div>
                            
                            <div class="contact-social">
                                <h4>Connect With Us</h4>
                                <div class="social-icons">
                                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="#" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-7">
                        <div class="contact-form">
                            <h3>Send Us a Message</h3>
                            
                            <?php
                            // Check if Contact Form 7 is active
                            if (function_exists('wpcf7_contact_form')) {
                                // Display the contact form with ID 123 (replace with actual form ID)
                                echo do_shortcode('[contact-form-7 id="123" title="Contact Form"]');
                            } else {
                                // Fallback form if Contact Form 7 is not active
                            ?>
                                <form id="contact-form" action="#" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Your Name *</label>
                                                <input type="text" id="name" name="name" class="form-control required" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Your Email *</label>
                                                <input type="email" id="email" name="email" class="form-control required" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" id="phone" name="phone" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="subject">Subject *</label>
                                        <input type="text" id="subject" name="subject" class="form-control required" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="message">Your Message *</label>
                                        <textarea id="message" name="message" rows="5" class="form-control required" required></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input required" id="privacy_policy" name="privacy_policy" required>
                                            <label class="custom-control-label" for="privacy_policy">I have read and agree to the <a href="/privacy-policy">Privacy Policy</a> *</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-error-message" style="display: none;">
                                        <p class="text-danger">Please fill all required fields correctly.</p>
                                    </div>
                                    
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-submit">Send Message</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        // Map Section
        ?>
        <section class="map-section">
            <div class="container">
                <div class="map-container">
                    <?php
                    // Check if ACF is active and a Google Maps API key is set
                    if (function_exists('get_field') && get_field('google_maps_api_key', 'option')) {
                        echo do_shortcode('[acf_map field="company_location" height="450px"]');
                    } else {
                        // Fallback iframe embed (replace with actual Google Maps embed code)
                        ?>
                        <div class="responsive-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387193.3059353029!2d-74.25986548248684!3d40.69714941932609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1612433420867!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>

        <?php
        // FAQ Section
        ?>
        <section class="faq-section">
            <div class="container">
                <div class="section-title">
                    <h2>Frequently Asked Questions</h2>
                    <p class="section-subtitle">Find answers to the most common questions about our services</p>
                </div>
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="accordion" id="faqAccordion1">
                            <div class="card">
                                <div class="card-header" id="faqHeading1">
                                    <h3 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                                            How do I book a tour?
                                        </button>
                                    </h3>
                                </div>
                                <div id="faqCollapse1" class="collapse show" aria-labelledby="faqHeading1" data-parent="#faqAccordion1">
                                    <div class="card-body">
                                        You can book a tour through our website by selecting your desired tour package and following the booking instructions. Alternatively, you can contact our team directly via phone or email, and we'll guide you through the booking process.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header" id="faqHeading2">
                                    <h3 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                            What payment methods do you accept?
                                        </button>
                                    </h3>
                                </div>
                                <div id="faqCollapse2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faqAccordion1">
                                    <div class="card-body">
                                        We accept all major credit cards (Visa, MasterCard, American Express), PayPal, bank transfers, and in some cases, cash payments for in-person bookings at our office.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header" id="faqHeading3">
                                    <h3 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                            What is your cancellation policy?
                                        </button>
                                    </h3>
                                </div>
                                <div id="faqCollapse3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faqAccordion1">
                                    <div class="card-body">
                                        Our cancellation policy varies depending on the tour package and timing of the cancellation. Generally, cancellations made 30+ days before departure receive a full refund minus a small administrative fee. Cancellations made 15-29 days before departure receive a 50% refund, and cancellations made less than 14 days before departure are non-refundable. Please refer to the specific terms and conditions for your tour.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6">
                        <div class="accordion" id="faqAccordion2">
                            <div class="card">
                                <div class="card-header" id="faqHeading4">
                                    <h3 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#faqCollapse4" aria-expanded="true" aria-controls="faqCollapse4">
                                            Do you offer customized tours?
                                        </button>
                                    </h3>
                                </div>
                                <div id="faqCollapse4" class="collapse show" aria-labelledby="faqHeading4" data-parent="#faqAccordion2">
                                    <div class="card-body">
                                        Yes, we specialize in creating customized travel experiences tailored to your preferences, interests, budget, and schedule. Contact our team to discuss your travel requirements, and we'll craft a personalized itinerary for you.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header" id="faqHeading5">
                                    <h3 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                            Are meals included in your tours?
                                        </button>
                                    </h3>
                                </div>
                                <div id="faqCollapse5" class="collapse" aria-labelledby="faqHeading5" data-parent="#faqAccordion2">
                                    <div class="card-body">
                                        Meal inclusions vary by tour package. Some tours include all meals, while others might include only breakfast or selected meals. The specific meal inclusions are clearly listed in each tour's itinerary. We also accommodate dietary restrictions and preferences when notified in advance.
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card">
                                <div class="card-header" id="faqHeading6">
                                    <h3 class="mb-0">
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                                            Do I need travel insurance?
                                        </button>
                                    </h3>
                                </div>
                                <div id="faqCollapse6" class="collapse" aria-labelledby="faqHeading6" data-parent="#faqAccordion2">
                                    <div class="card-body">
                                        Yes, we strongly recommend purchasing comprehensive travel insurance for all our tours. Travel insurance provides protection against unforeseen circumstances such as trip cancellations, medical emergencies, lost luggage, and more. We can recommend reputable insurance providers if needed.
                                    </div>
                                </div>
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
                <h2 class="cta-title">Ready to Plan Your Next Adventure?</h2>
                <p class="cta-description">Our travel experts are ready to help you create unforgettable experiences.</p>
                <a href="<?php echo esc_url(home_url('/tours')); ?>" class="cta-button">Explore Our Tours</a>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
