# Headless WordPress Theme

This is a simple **headless WordPress theme** that decouples the frontend from the WordPress backend. WordPress serves as a CMS, providing content through the REST API, while the frontend is handled separately, typically by a JavaScript framework like React, Next.js, or Vue.

## Features

- **REST API Integration**: Exposes all WordPress content (posts, pages, etc.) through the REST API.
- **No frontend rendering**: The theme itself does not render any content on the WordPress front end, making it fully headless.
- **Deregisters unnecessary scripts**: Disables jQuery, emoji scripts, and other unnecessary assets to optimize performance for a headless setup.
- **Custom REST API Endpoints**: Easily extendable to include custom REST API routes.

## Adding Custom API Endpoints
In the functions.php file, add the following code to create custom REST API routes:

```php
add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/example/', array(
    'methods' => 'GET',
    'callback' => 'custom_example_endpoint',
    ));
});

function custom_example_endpoint() {
    return new WP_REST_Response(array('message' => 'Hello from custom API!'), 200);
}