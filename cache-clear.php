<?php
/**
 * Plugin Name: Clear Cache
 * Description: This plugin clears the cache whenever a new post is published or updated.
 * Version: 1.1
 * Author: Francisco Oliveira
 * Author URI: https://franciscooliveira.me/
 */

function clear_cache_on_publish_or_update($post_id) {
    if (wp_is_post_revision($post_id)) {
        return;
    }

    wp_cache_flush();
    update_option('last_cache_flush', current_time('mysql'));
}
add_action('save_post', 'clear_cache_on_publish_or_update');

function add_last_cache_flush_section() {
    $last_flush_time = get_option('last_cache_flush');
    $last_flush_time_formatted = date('Y-m-d H:i:s', strtotime($last_flush_time));
    ?>
    <div class="notice notice-info">
        <p><?php printf(__('The cache was last flushed on %s', 'my-plugin'), $last_flush_time_formatted); ?></p>
    </div>
    <?php
}
add_action('admin_notices', 'add_last_cache_flush_section');
