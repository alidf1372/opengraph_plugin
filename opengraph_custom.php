<?php

/*
Plugin Name: opengraph_custom
Plugin URI: http://aliferdows.ir
Description: با استفاده از این پلاگین برای صفحات نوشته خود متاتگ های مربوط به شبکه های اجتماعی اضافه میکنید و همچنین قابلیت استفاده از canonical هم دارید.
Author: Ali Ferdows
Version: 1.0.0
Author URI: http://aliferdows.ir
*/

define('OG_PATH', plugin_dir_path(__FILE__));
define('OG_URL', plugin_dir_url(__FILE__));
define('OG_INC_PATH', OG_PATH . '/inc/');
define('OG_TPL_PATH', OG_PATH . '/tpl/');

//    add menu item
include OG_TPL_PATH . 'menu.php';

if (is_admin()) {

//    add css file
    function og_add_stylesheet_file () {
        wp_register_style('og_stylesheet', OG_URL . '/assets/css/main.css', null, '1.0.0');
        wp_enqueue_style('og_stylesheet');
    }
    add_action('admin_enqueue_scripts', 'og_add_stylesheet_file');

}

//    add opengraph file
include OG_INC_PATH . 'add_opengraph.php';

//    add canonical file
include OG_INC_PATH . 'add_canonical.php';