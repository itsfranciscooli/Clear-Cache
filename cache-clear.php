<?php
/**
 * Plugin Name: Clear Cache
 * Description: This plugin clears the cache whenever a new post is published or updated.
 * Version: 1.0
 * Author: Francisco Oliveira
 * Author URI: https://franciscooliveira.me/
 */

function clear_cache_on_publish_or_update($post_id) {
    if (wp_is_post_revision($post_id)) {
        return;
    }

    wp_cache_flush();
}
add_action('save_post', 'clear_cache_on_publish_or_update');
