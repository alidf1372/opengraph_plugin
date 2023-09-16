<?php

$current_canonical = get_option('canonical');
$current_canonical = $current_canonical ? json_decode($current_canonical, true) : [];

/**
 * @return void
 * Removing the WordPress default canonical tag from the non-main post
 */
function remove_canonical_link_for_specific_post() {
    foreach ($GLOBALS['current_canonical'] as $key => $value) {
        foreach ($value['sub'] as $sub_value) {
            if (is_single($sub_value)) {
                remove_action('wp_head', 'rel_canonical');
            }
        }
    }
}
add_action('wp', 'remove_canonical_link_for_specific_post');


/**
 * @return void
 * Add the canonical tag to the main post
 */
function custom_canonical_url() {
    foreach ($GLOBALS['current_canonical'] as $key => $value) {
        foreach ($value['sub'] as $sub_value) {
            if (is_single($sub_value)) {
                $canonical_url = get_permalink($value['main']);

                echo '<link rel="canonical" href="' . esc_url($canonical_url) . '" />' . "\n";
            }
        }
    }
}

add_action('wp_head', 'custom_canonical_url');
