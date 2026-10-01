<?php
/** Original theme integration. No third-party service credentials. */
if (!defined('ABSPATH')) { exit; }
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('northline', get_stylesheet_uri(), [], '1.0.0');
    wp_enqueue_style('northline-fonts', get_stylesheet_directory_uri() . '/fonts/fonts.css', [], '1.0.0');
    wp_enqueue_script('northline-demo', get_stylesheet_directory_uri() . '/demo.js', [], '1.0.0', true);
}, 30);
add_action('after_setup_theme', function () { add_theme_support('title-tag'); });
