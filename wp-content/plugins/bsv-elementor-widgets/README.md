# Beyond Splendid Ventures - Elementor Widgets

Custom Elementor widgets specifically designed for the Beyond Splendid Ventures travel agency website. These widgets allow you to showcase tours, destinations, and testimonials with beautiful, responsive layouts.

## Features

- **Tours Widget**: Display your travel packages with customizable layouts, pricing badges, and featured indicators.
- **Destinations Widget**: Showcase your travel destinations with options for text overlay or standard card layouts.
- **Testimonials Widget**: Display client reviews in a beautiful slider with customizable settings.

## Requirements

- WordPress 5.0+
- Elementor 3.0+
- PHP 7.0+
- Hello Elementor theme or compatible WordPress theme

## Installation

1. Upload the `bsv-elementor-widgets` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. The widgets will be available in the Elementor editor under the "Beyond Splendid Ventures" category.

## Usage

### Tours Widget

1. Edit a page with Elementor.
2. Drag and drop the "BSV Tours" widget into your page.
3. Configure the title, subtitle, number of tours to display, and column layout.
4. Choose whether to show featured tours only or filter by tour categories.
5. Customize colors, typography, and other styling options in the Style tab.

### Destinations Widget

1. Edit a page with Elementor.
2. Drag and drop the "BSV Destinations" widget into your page.
3. Configure the title, subtitle, number of destinations to display, and column layout.
4. Choose between "Text Overlay" or "Text Below Image" card layouts.
5. Filter destinations by category or continent.
6. Customize colors, typography, and other styling options in the Style tab.

### Testimonials Widget

1. Edit a page with Elementor.
2. Drag and drop the "BSV Testimonials" widget into your page.
3. Configure the title, subtitle, and number of testimonials to display.
4. Adjust slider settings like slides to show, autoplay options, and navigation controls.
5. Customize colors, typography, and other styling options in the Style tab.

## Custom Post Types

This plugin works with the following custom post types (which should be registered in your theme):

- `tour`: For storing tour/package information
- `destination`: For storing destination information
- `testimonial`: For storing client testimonials

## Widget Settings

Each widget includes extensive customization options:

- Content settings (titles, layouts, filters)
- Typography settings for all text elements
- Color settings for backgrounds, text, and accents
- Border and spacing controls
- Responsive behavior customization

## Dependencies

The plugin uses the following libraries:

- Slick Carousel (for testimonials slider)
- Font Awesome (for icons)

These are loaded automatically when needed.

## Customization

For advanced customization, you can modify the widget PHP files, CSS, or JavaScript files:

- Widget files: `widgets/tours-widget.php`, `widgets/destinations-widget.php`, `widgets/testimonials-widget.php`
- CSS: `assets/css/bsv-elementor-widgets.css`
- JavaScript: `assets/js/bsv-elementor-widgets.js`, `assets/js/testimonials.js`

## Support

For support or customization requests, please contact Beyond Splendid Ventures development team.