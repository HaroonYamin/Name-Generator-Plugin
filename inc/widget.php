<?php
// Register AJAX handler for generating names
function ajax_generate_names() {
    // Verify nonce for security
    check_ajax_referer('generate_names_nonce', 'security');

    // Validate post ID
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    if (!$post_id) {
        wp_send_json_error('Invalid post ID.');
    }

    // Retrieve names from the custom post meta
    $names_field = get_post_meta($post_id, '_names', true);
    if (!$names_field) {
        wp_send_json_error('No names available.');
    }

    $names_array = array_map('trim', explode(',', $names_field));
    $suggestions = [];

    // Randomly select up to 5 unique names
    while (count($suggestions) < 5 && count($suggestions) < count($names_array)) {
        $random_name = $names_array[array_rand($names_array)];
        if (!in_array($random_name, $suggestions)) {
            $suggestions[] = $random_name;
        }
    }

    wp_send_json_success($suggestions);
}
add_action('wp_ajax_generate_names', 'ajax_generate_names');
add_action('wp_ajax_nopriv_generate_names', 'ajax_generate_names');

// Shortcode function to display the name generator button
function name_generator_shortcode() {
    $post_id = get_the_ID();
    if (!$post_id) {
        return '<p>Post ID is not available.</p>';
    }

    ob_start(); ?>
    <div id="name-generator" data-post-id="<?php echo esc_attr($post_id); ?>">
        <button id="generate-btn">Generate Names</button>
        <ul id="name-suggestions"></ul>
        <div id="error-message" style="color: red;"></div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('random_names', 'name_generator_shortcode');
