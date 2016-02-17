<?php
function laharmag_customize_register( $wp_customize ) {
	/*
	/ Colore dell'edizione
    $wp_customize->add_section('sezione_colore',
        array(
       		'title'       => __('Colore edizione', 'documentation'),
       		'priority'    => 100,
        )
    );

    $wp_customize->add_setting(
        'colore_edizione',
        array(
            'default'    => '#000000',
            'type' => 'theme_mod',
  			'capability' => 'edit_theme_options',
            'transport' => 'refresh',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        'colore_option',
        array(
            'label'      => 'Setta il colore',
            'section'    => 'sezione_colore',
            'settings'   => 'colore_edizione',
        )
    );
    */

	/*
    / Video dell'edizione
    */
    $wp_customize->add_section('sezione_video',
        array(
            'title'       => __('Video','documentation'),
            'priority'    => 110,
        )
    );

    $wp_customize->add_setting(
        'video_edizione',
        array(
            'default'    => 'http://player.vimeo.com/video/118424243',
            'type' => 'theme_mod',
            'capability' => 'edit_theme_options',
            'transport' => 'refresh',
        )
    );

    $wp_customize->add_control(
        'colore_option',
        array(
            'label'      => 'Setta il video',
            'section'    => 'sezione_video',
            'settings'   => 'video_edizione',
        )
    );

    
}
add_action( 'customize_register' , 'laharmag_customize_register' );


function custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats', array( 'video', 'standard' ) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {
		//this is where you can register custom post types
	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu('Top Menu');
		$context['site'] = $this;
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

}



new StarterSite();

function myfoo( $text ) {
	$text .= ' bar!';
	return $text;
}