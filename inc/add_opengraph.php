<?php

$show_opengeraph = get_option('show_opengraph');

if ($show_opengeraph) {

    function add_title_as_meta_tags()
    {
        if (is_single()) {
            $post_title = get_the_title();
            $description = get_option('description') ?: get_the_excerpt() ?: get_bloginfo('description') ?: "";
            $site_url = esc_url(home_url('/'));
            $post_url = get_permalink();
            $post_thumbnail = get_the_post_thumbnail_url();

            // Facebook Meta Tags
            echo "\n".'<meta property="og:url" content="' . esc_url($post_url) . '">'. "\n";
            echo '<meta property="og:type" content="article">'. "\n";
            echo '<meta property="og:title" content="' . esc_attr($post_title) . '">'. "\n";
            echo '<meta property="og:description" content="' . esc_attr($description) . '">'. "\n";
            echo '<meta property="og:image" content="' . esc_url($post_thumbnail) . '">'. "\n";

            // Twitter Meta Tags
            echo '<meta name="twitter:card" content="summary_large_image">'. "\n";
            echo '<meta name="twitter:domain" content="' . esc_url($site_url) . '">'. "\n";
            echo '<meta name="twitter:url" content="' . esc_url($post_url) . '">'. "\n";
            echo '<meta name="twitter:title" content="' . esc_attr($post_title) . '">'. "\n";
            echo '<meta name="twitter:description" content="' . esc_attr($description) . '">'. "\n";
            echo '<meta name="twitter:image" content="' . esc_url($post_thumbnail) . '">'. "\n";
        }
    }

    add_action('wp_head', 'add_title_as_meta_tags');
}
