<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beyond Splendid Ventures - Elementor Demo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap">
    
    <style>
        :root {
            --primary-color: #1a73e8;
            --secondary-color: #34a853;
            --accent-color: #fbbc05;
            --text-color: #333333;
            --light-color: #ffffff;
            --dark-color: #222222;
            --heading-font: 'Montserrat', sans-serif;
            --body-font: 'Open Sans', sans-serif;
        }
        
        body {
            font-family: var(--body-font);
            color: var(--text-color);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: var(--heading-font);
            font-weight: 700;
            color: var(--dark-color);
        }
        
        a {
            color: var(--primary-color);
            transition: color 0.3s ease;
        }
        
        a:hover {
            color: var(--secondary-color);
            text-decoration: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 12px 24px;
            font-weight: 600;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        /* Header Styles */
        .site-header {
            background-color: var(--light-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 15px 0;
        }
        
        .site-logo {
            max-height: 60px;
        }
        
        .site-navigation .nav-link {
            font-family: var(--heading-font);
            font-weight: 600;
            padding: 0.5rem 1rem;
            color: var(--dark-color);
        }
        
        .site-navigation .nav-link:hover {
            color: var(--primary-color);
        }
        
        .site-navigation .dropdown-menu {
            border-radius: 0;
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        /* Hero Section */
        .hero-section {
            position: relative;
            height: 600px;
            background-color: #f5f5f5;
            overflow: hidden;
        }
        
        .hero-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            padding: 120px 0;
            text-align: center;
            color: var(--light-color);
        }
        
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }
        
        .hero-title {
            font-size: 48px;
            margin-bottom: 20px;
            color: var(--light-color);
        }
        
        .hero-subtitle {
            font-size: 20px;
            margin-bottom: 30px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        /* Featured Destinations */
        .featured-destinations {
            padding: 80px 0;
            background-color: #f9f9f9;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .section-subtitle {
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .destination-card {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .destination-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .destination-image {
            position: relative;
            height: 250px;
            overflow: hidden;
        }
        
        .destination-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .destination-card:hover .destination-image img {
            transform: scale(1.1);
        }
        
        .destination-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0) 50%, rgba(0,0,0,0.7) 100%);
        }
        
        .destination-details {
            padding: 20px;
            background-color: var(--light-color);
        }
        
        .destination-title {
            font-size: 20px;
            margin-bottom: 10px;
        }
        
        .destination-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
        
        .destination-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .destination-meta span {
            font-size: 14px;
            color: #666;
        }
        
        .destination-link {
            font-weight: 600;
            font-size: 14px;
        }
        
        /* Popular Tours */
        .popular-tours {
            padding: 80px 0;
        }
        
        .tour-filter {
            margin-bottom: 40px;
        }
        
        .tour-filter-button {
            margin: 0 5px 10px;
            border-radius: 30px;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .tour-card {
            margin-bottom: 30px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        
        .tour-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        .tour-image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .tour-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .tour-card:hover .tour-image img {
            transform: scale(1.1);
        }
        
        .tour-price {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background-color: var(--primary-color);
            color: var(--light-color);
            padding: 5px 15px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 16px;
        }
        
        .featured-badge {
            position: absolute;
            top: 15px;
            left: 0;
            background-color: var(--accent-color);
            color: var(--dark-color);
            padding: 5px 15px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .tour-details {
            padding: 20px;
            background-color: var(--light-color);
            display: flex;
            flex-direction: column;
            height: calc(100% - 200px);
        }
        
        .tour-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .tour-description {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
            flex-grow: 1;
        }
        
        .tour-meta {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        
        .tour-meta-item {
            margin-right: 15px;
            font-size: 13px;
            color: #666;
        }
        
        .tour-button {
            align-self: flex-start;
            display: inline-block;
            background-color: var(--primary-color);
            color: var(--light-color);
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }
        
        .tour-button:hover {
            background-color: var(--secondary-color);
            color: var(--light-color);
        }
        
        /* Testimonials */
        .testimonials-section {
            padding: 80px 0;
            background-color: #f5f5f5;
        }
        
        .testimonial-item {
            background-color: var(--light-color);
            border-radius: 8px;
            padding: 30px;
            margin: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .testimonial-content {
            font-style: italic;
            margin-bottom: 20px;
            color: #555;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
        }
        
        .testimonial-author-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }
        
        .testimonial-author-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .testimonial-author-name {
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .testimonial-author-title {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }
        
        .testimonial-rating {
            color: var(--accent-color);
        }
        
        /* Footer */
        .site-footer {
            background-color: var(--dark-color);
            color: var(--light-color);
            padding: 80px 0 30px;
        }
        
        .footer-heading {
            color: var(--light-color);
            margin-bottom: 25px;
            font-size: 22px;
        }
        
        .footer-link {
            color: #aaa;
            display: block;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }
        
        .footer-link:hover {
            color: var(--light-color);
        }
        
        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .footer-contact-icon {
            margin-right: 15px;
            color: var(--primary-color);
        }
        
        .footer-contact-text {
            color: #aaa;
        }
        
        .footer-social {
            margin-top: 25px;
        }
        
        .footer-social-link {
            display: inline-block;
            margin-right: 15px;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: var(--light-color);
            transition: all 0.3s ease;
        }
        
        .footer-social-link:hover {
            background-color: var(--primary-color);
            color: var(--light-color);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 30px;
            margin-top: 50px;
        }
        
        .copyright {
            color: #aaa;
        }
        
        /* Elementor Specific Styles */
        .elementor-section.elementor-section-boxed > .elementor-container {
            max-width: 1200px;
        }
        
        .elementor-widget-heading .elementor-heading-title {
            font-family: var(--heading-font);
        }
        
        .elementor-widget-text-editor {
            font-family: var(--body-font);
        }
        
        .elementor-button {
            background-color: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .elementor-button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .elementor-widget-image-box .elementor-image-box-content .elementor-image-box-title {
            font-family: var(--heading-font);
            color: var(--dark-color);
        }
        
        .elementor-widget-image-box .elementor-image-box-content .elementor-image-box-description {
            font-family: var(--body-font);
            color: var(--text-color);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="#">
                    <img src="https://via.placeholder.com/180x60?text=Beyond+Splendid+Ventures" alt="Beyond Splendid Ventures" class="site-logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto site-navigation">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="destinationsDropdown" role="button" data-toggle="dropdown">
                                Destinations
                            </a>
                            <div class="dropdown-menu" aria-labelledby="destinationsDropdown">
                                <a class="dropdown-item" href="#">Asia</a>
                                <a class="dropdown-item" href="#">Europe</a>
                                <a class="dropdown-item" href="#">Africa</a>
                                <a class="dropdown-item" href="#">North America</a>
                                <a class="dropdown-item" href="#">South America</a>
                                <a class="dropdown-item" href="#">Oceania</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="toursDropdown" role="button" data-toggle="dropdown">
                                Tours
                            </a>
                            <div class="dropdown-menu" aria-labelledby="toursDropdown">
                                <a class="dropdown-item" href="#">Adventure Tours</a>
                                <a class="dropdown-item" href="#">Cultural Tours</a>
                                <a class="dropdown-item" href="#">Beach Getaways</a>
                                <a class="dropdown-item" href="#">Wildlife Safaris</a>
                                <a class="dropdown-item" href="#">City Breaks</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary ml-lg-3" href="#">Book Now</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Travel Adventure" class="hero-background">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Discover the World with Beyond Splendid Ventures</h1>
                <p class="hero-subtitle">Experience unforgettable journeys and create memories that last a lifetime</p>
                <a href="#" class="btn btn-primary btn-lg">Explore Our Tours</a>
            </div>
        </div>
    </section>

    <!-- Featured Destinations -->
    <section class="featured-destinations">
        <div class="container">
            <div class="section-title">
                <h2>Popular Destinations</h2>
                <p class="section-subtitle">Explore our carefully selected destinations for your next adventure</p>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="destination-card">
                        <div class="destination-image">
                            <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Tokyo, Japan">
                            <div class="destination-overlay"></div>
                        </div>
                        <div class="destination-details">
                            <h3 class="destination-title">Tokyo, Japan</h3>
                            <div class="destination-description">Experience the perfect blend of ancient traditions and ultramodern life in Japan's bustling capital.</div>
                            <div class="destination-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Japan</span>
                                <a href="#" class="destination-link">Explore <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="destination-card">
                        <div class="destination-image">
                            <img src="https://images.unsplash.com/photo-1499856871958-5b9627545d1a?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Paris, France">
                            <div class="destination-overlay"></div>
                        </div>
                        <div class="destination-details">
                            <h3 class="destination-title">Paris, France</h3>
                            <div class="destination-description">Discover why Paris is known as the City of Light, with its stunning architecture and world-class cuisine.</div>
                            <div class="destination-meta">
                                <span><i class="fas fa-map-marker-alt"></i> France</span>
                                <a href="#" class="destination-link">Explore <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="destination-card">
                        <div class="destination-image">
                            <img src="https://images.unsplash.com/photo-1506461883276-594a12b11cf3?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Santorini, Greece">
                            <div class="destination-overlay"></div>
                        </div>
                        <div class="destination-details">
                            <h3 class="destination-title">Santorini, Greece</h3>
                            <div class="destination-description">Enjoy breathtaking views, stunning sunsets, and the unique white and blue architecture of this Greek paradise.</div>
                            <div class="destination-meta">
                                <span><i class="fas fa-map-marker-alt"></i> Greece</span>
                                <a href="#" class="destination-link">Explore <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn btn-primary">View All Destinations</a>
            </div>
        </div>
    </section>

    <!-- Featured Tours -->
    <section class="popular-tours">
        <div class="container">
            <div class="section-title">
                <h2>Our Popular Tours</h2>
                <p class="section-subtitle">Discover our most popular tour packages for your next adventure</p>
            </div>
            
            <div class="tour-filter text-center mb-5">
                <button class="btn btn-outline-primary tour-filter-button active">All Tours</button>
                <button class="btn btn-outline-primary tour-filter-button">Adventure</button>
                <button class="btn btn-outline-primary tour-filter-button">Cultural</button>
                <button class="btn btn-outline-primary tour-filter-button">Beach</button>
                <button class="btn btn-outline-primary tour-filter-button">Wildlife</button>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="tour-card">
                        <div class="tour-image">
                            <img src="https://images.unsplash.com/photo-1528360983277-13d401cdc186?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Japanese Heritage Tour">
                            <div class="tour-price">$2,499</div>
                            <div class="featured-badge">
                                <i class="fas fa-star"></i> Featured
                            </div>
                        </div>
                        <div class="tour-details">
                            <h3 class="tour-title">Japanese Heritage Tour</h3>
                            <div class="tour-description">Explore Japan's rich cultural heritage, from ancient temples in Kyoto to the modern marvels of Tokyo.</div>
                            
                            <div class="tour-meta">
                                <div class="tour-meta-item">
                                    <i class="far fa-clock"></i> 12 Days
                                </div>
                                <div class="tour-meta-item">
                                    <i class="fas fa-users"></i> 16 People
                                </div>
                                <div class="tour-meta-item">
                                    <i class="fas fa-signal"></i> Moderate
                                </div>
                            </div>
                            
                            <a href="#" class="tour-button">View Details</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="tour-card">
                        <div class="tour-image">
                            <img src="https://images.unsplash.com/photo-1504512485720-7d83a16ee930?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="Mediterranean Highlights">
                            <div class="tour-price">$3,299</div>
                        </div>
                        <div class="tour-details">
                            <h3 class="tour-title">Mediterranean Highlights</h3>
                            <div class="tour-description">Journey through the stunning landscapes of Italy, Greece, and Spain. Visit historic sites and relax on beautiful beaches.</div>
                            
                            <div class="tour-meta">
                                <div class="tour-meta-item">
                                    <i class="far fa-clock"></i> 14 Days
                                </div>
                                <div class="tour-meta-item">
                                    <i class="fas fa-users"></i> 12 People
                                </div>
                                <div class="tour-meta-item">
                                    <i class="fas fa-signal"></i> Easy
                                </div>
                            </div>
                            
                            <a href="#" class="tour-button">View Details</a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="tour-card">
                        <div class="tour-image">
                            <img src="https://images.unsplash.com/photo-1516426122078-c23e76319801?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80" alt="African Safari Expedition">
                            <div class="tour-price">$4,199</div>
                        </div>
                        <div class="tour-details">
                            <h3 class="tour-title">African Safari Expedition</h3>
                            <div class="tour-description">Experience the incredible wildlife of Tanzania and Kenya. Witness the Great Migration and explore the Serengeti.</div>
                            
                            <div class="tour-meta">
                                <div class="tour-meta-item">
                                    <i class="far fa-clock"></i> 10 Days
                                </div>
                                <div class="tour-meta-item">
                                    <i class="fas fa-users"></i> 8 People
                                </div>
                                <div class="tour-meta-item">
                                    <i class="fas fa-signal"></i> Moderate
                                </div>
                            </div>
                            
                            <a href="#" class="tour-button">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5">
                <a href="#" class="btn btn-primary">View All Tours</a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials-section">
        <div class="container">
            <div class="section-title">
                <h2>What Our Travelers Say</h2>
                <p class="section-subtitle">Read reviews from our satisfied clients who have experienced our tours</p>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p>Our journey through Japan with Beyond Splendid Ventures was truly unforgettable. The attention to detail, knowledgeable guides, and perfect blend of cultural experiences made this trip exceptional.</p>
                        </div>
                        
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Sarah Thompson">
                            </div>
                            <div>
                                <h4 class="testimonial-author-name">Sarah Thompson</h4>
                                <p class="testimonial-author-title">Japan Cultural Expedition</p>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p>I was amazed by the level of personalized service provided by Beyond Splendid Ventures. From the moment I inquired about the safari tour to the day I returned home, everything was handled with professionalism.</p>
                        </div>
                        
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Johnson">
                            </div>
                            <div>
                                <h4 class="testimonial-author-name">Michael Johnson</h4>
                                <p class="testimonial-author-title">African Safari Adventure</p>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="testimonial-item">
                        <div class="testimonial-content">
                            <p>Beyond Splendid Ventures created a perfect itinerary for our family trip to Italy. The hotels were charming, the guided tours were informative and engaging for all ages, and the pace was just right.</p>
                        </div>
                        
                        <div class="testimonial-author">
                            <div class="testimonial-author-image">
                                <img src="https://randomuser.me/api/portraits/women/42.jpg" alt="Lisa Garcia">
                            </div>
                            <div>
                                <h4 class="testimonial-author-name">Lisa and Robert Garcia</h4>
                                <p class="testimonial-author-title">Italian Family Discovery</p>
                                <div class="testimonial-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="#" class="btn btn-outline-primary">View All Testimonials</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h3 class="footer-heading">About Us</h3>
                    <p>Beyond Splendid Ventures is a premier travel agency specializing in curated experiences to the world's most extraordinary destinations.</p>
                    
                    <div class="footer-social">
                        <a href="#" class="footer-social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h3 class="footer-heading">Destinations</h3>
                    <a href="#" class="footer-link">Asia</a>
                    <a href="#" class="footer-link">Europe</a>
                    <a href="#" class="footer-link">Africa</a>
                    <a href="#" class="footer-link">North America</a>
                    <a href="#" class="footer-link">South America</a>
                    <a href="#" class="footer-link">Oceania</a>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h3 class="footer-heading">Tours</h3>
                    <a href="#" class="footer-link">Adventure Tours</a>
                    <a href="#" class="footer-link">Cultural Tours</a>
                    <a href="#" class="footer-link">Beach Getaways</a>
                    <a href="#" class="footer-link">Wildlife Safaris</a>
                    <a href="#" class="footer-link">City Breaks</a>
                    <a href="#" class="footer-link">Custom Tours</a>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <h3 class="footer-heading">Contact Us</h3>
                    
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="footer-contact-text">
                            123 Travel Way, Adventure City, AC 12345, United States
                        </div>
                    </div>
                    
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div class="footer-contact-text">
                            +1 (555) 123-4567
                        </div>
                    </div>
                    
                    <div class="footer-contact-item">
                        <div class="footer-contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="footer-contact-text">
                            info@beyondsplendidventures.com
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <p class="copyright">&copy; 2025 Beyond Splendid Ventures. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-right">
                        <a href="#" class="footer-link d-inline-block mr-3">Privacy Policy</a>
                        <a href="#" class="footer-link d-inline-block mr-3">Terms of Service</a>
                        <a href="#" class="footer-link d-inline-block">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- Elementor Demo Indicator -->
    <div style="position: fixed; bottom: 20px; left: 20px; background-color: #1a73e8; color: white; padding: 10px 20px; border-radius: 5px; z-index: 9999; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <strong>Elementor</strong> Theme Demo
    </div>
</body>
</html>