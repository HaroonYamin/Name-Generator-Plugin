<?php
/**
 * Plugin Name: Name Generator Plugin
 * Description: A plugin to generate names that added to specific post in wordpress
 * Version: 1.0
 * Author: Haroon Yamin
 * Text Domain: name-generator-plugin
 */

if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
include_once plugin_dir_path(__FILE__) . 'inc/meta.php';
include_once plugin_dir_path(__FILE__) . 'inc/widget.php';

function name_generator_enqueue_scripts() {
    wp_enqueue_script(
        'name-generator',
        plugin_dir_url(__FILE__) . 'assets/script.js',
        ['jquery'],
        null,
        true
    );

    // Localize the script with the AJAX URL and nonce
    wp_localize_script('name-generator', 'nameGenerator', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('generate_names_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'name_generator_enqueue_scripts');
