<?php
// functions.php

// Disable front-end theme functionalities
add_action('wp_enqueue_scripts', function() {
    wp_deregister_script('jquery'); // Disable jQuery if you are not using it
    wp_dequeue_style('wp-block-library'); // Disable Gutenberg block library styles
}, 100);

// Disable WordPress theme rendering
add_filter('template_include', function($template) {
    if (is_admin()) {
        return $template; // Return template for admin panel
    }

    // Prevent frontend rendering
    return __DIR__ . '/index.php'; // Just display the message in index.php
}, 99);

// Optional: Remove emoji scripts, unnecessary for headless use
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Enable REST API (already enabled by default from WordPress 4.7)


add_action("rest_api_init", function () {
    register_rest_route("options", "/social-links", [
        "methods" => "GET",
        "callback" => "acf_options_route",
    ]);
});
function acf_options_route() {
    return get_fields('options');
}

function add_cors_http_header(){
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
}
add_action('init','add_cors_http_header');