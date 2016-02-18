<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

if ( ! class_exists( 'Timber' ) ) {
	echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	return;
}
$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$templates = array( 'index.twig' );
if ( is_home() ) {
	array_unshift( $templates, 'home.twig' );
}
$context['categories'] = Timber::get_terms('category');

/*
Instagram API
User ID: 317500696
access_token: 317500696.6341235.9a09e51cf75748728508be9b0d90c7e9
*/
$json = file_get_contents('https://api.instagram.com/v1/users/317500696/media/recent/?access_token=317500696.6341235.9a09e51cf75748728508be9b0d90c7e9');
$jsonData = json_decode($json);
$data = $jsonData->data;
$context['fotos'] = $data;

// Seleziona le impostazioni settate nel pannello di personaliizazione del tema WP
$options = get_option("laharmagazine_theme_options");
$context['youtube_code'] = $options['youtube_code'];
$context['category_now'] = $options['category_select'];
$context['edition_color'] = $options['edition_color'];

Timber::render( $templates, $context );