<?php
/*
Plugin Name: AniWP Home
Description: Crea una home page personalizzata simile ad AniList con integrazione al plugin AniWP.
Version: 1.0
Author: fr0zen
*/

if (!defined('ABSPATH')) exit;

// Crea la pagina home automaticamente all'attivazione
register_activation_hook(__FILE__, 'aniwp_home_create_page');
function aniwp_home_create_page() {
    if (!get_page_by_title('AniWP Home')) {
        wp_insert_post([
            'post_title' => 'AniWP Home',
            'post_content' => '[aniwp_home]',
            'post_status' => 'publish',
            'post_type' => 'page'
        ]);
    }
}

// Registra lo shortcode [aniwp_home]
add_shortcode('aniwp_home', 'aniwp_home_shortcode');
function aniwp_home_shortcode() {
    ob_start();
    include plugin_dir_path(__FILE__) . 'templates/home-template.php';
    return ob_get_clean();
}

// Carica stili e script
add_action('wp_enqueue_scripts', 'aniwp_home_enqueue_assets');
function aniwp_home_enqueue_assets() {
    wp_enqueue_style('aniwp-home-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('aniwp-home-script', plugin_dir_url(__FILE__) . 'assets/script.js', ['jquery'], null, true);
}
