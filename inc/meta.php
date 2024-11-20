<?php
// Add custom metabox for names input in the post editor
function add_names_metabox() {
    add_meta_box(
        'names_metabox',
        'Name Generator Names',
        'names_metabox_callback',
        'post',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'add_names_metabox');

// Callback function to display the input field in the metabox
function names_metabox_callback($post) {
    // Retrieve the saved names from post meta
    $names = get_post_meta($post->ID, '_names', true);
    ?>
    <label for="names">Enter names separated by commas:</label>
    <textarea name="names" id="names" rows="4" style="width:100%;"><?php echo esc_textarea($names); ?></textarea>
    <?php
}

// Save the names field when the post is saved
function save_names_metabox($post_id) {
    // Check for nonce and autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['names'])) {
        // Sanitize and save the names input
        update_post_meta($post_id, '_names', sanitize_text_field($_POST['names']));
    }
}
add_action('save_post', 'save_names_metabox');
