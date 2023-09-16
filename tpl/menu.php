<?php

function og_show_general_page () {
    include "general.php";
}

function og_show_canonical_page () {
    include "canonical.php";
}

function og_add_menu_item () {
    add_menu_page(
        'متا تگ',
        'متا تگ',
        'manage_options',
        'meta_tag',
        'og_show_general_page',
        'dashicons-admin-site-alt'
    );
    add_submenu_page(
        'meta_tag',
        'canonical',
        'مدیریت تگ های canonical',
        'manage_options',
        'meta_tag/manage_canonical',
        'og_show_canonical_page'
    );
}

add_action('admin_menu', 'og_add_menu_item');