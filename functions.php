<?php
/*
* Theme Options – The Customizer API
* https://developer.wordpress.org/themes/advanced-topics/customizer-api/
*/
function laharmagazine_customize_register($wp_customize){

    $wp_customize->add_section('laharmagazine_color_scheme', array(
        'title'    => __('Impostazioni', 'laharmagazine'),
        'priority' => 120,
    ));

    // Youtube Video                
    $wp_customize->add_setting('laharmagazine_theme_options[youtube_code]', array(
        'default'        => 'AbvxR0STPmU',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('laharmagazine_text_test', array(
        'label'      => __('Codice video YouTube', 'laharmagazine'),
        'section'    => 'laharmagazine_color_scheme',
        'settings'   => 'laharmagazine_theme_options[youtube_code]',
    ));
    
    // Select Category              
    $categories = get_categories();
    $cat_list = array();
    foreach ($categories as $c) {
        $cat_name = $c->name;
        $cat_select[$cat_name] = $cat_name;
    }

    $wp_customize->add_setting('laharmagazine_theme_options[category_select]', array(
        'default'        => 'Categoria',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( 'example_select_box', array(
        'settings' => 'laharmagazine_theme_options[category_select]',
        'label'   => 'Seleziona il numero di riferimento',
        'section' => 'laharmagazine_color_scheme',
        'type'    => 'select',
        'choices'    => $cat_select,
    ));
       
    // Color picker              
    $wp_customize->add_setting('laharmagazine_theme_options[edition_color]', array(
        'default'           => '#000',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'edition_color', array(
        'label'    => __('Colore edizione', 'laharmagazine'),
        'section'  => 'laharmagazine_color_scheme',
        'settings' => 'laharmagazine_theme_options[edition_color]',
    )));
    
}
add_action('customize_register', 'laharmagazine_customize_register');

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