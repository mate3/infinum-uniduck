<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Function for Theme settings option page
add_action('acf/init', 'my_acf_init');

function my_acf_init() {
	
	if( function_exists('acf_add_options_page') ) {
	
		acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'post_id' 		=> 'options',
			'redirect'		=> true,
		));
		
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Header Settings',
			'menu_title'	=> 'Header',
			'parent_slug'	=> 'theme-general-settings',
		));
		
		acf_add_options_sub_page(array(
			'page_title' 	=> 'Theme Footer Settings',
			'menu_title'	=> 'Footer',
			'parent_slug'	=> 'theme-general-settings',
		));
		
	}
	
}

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
);

foreach ( $understrap_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}





//Excerpt length
function custom_excerpt_length( $length ) {
	return (is_front_page()) ? 33 : 12;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

//Excerpt read more
function understrap_all_excerpts_get_more_link( $post_excerpt ) {

	return $post_excerpt . '... <a class="moretag" href="'. get_permalink( get_the_ID() ) . '"> Read more </a>';

}
add_filter( 'wp_trim_excerpt', 'understrap_all_excerpts_get_more_link' );


/******** Subscription form *********/
class Subscription_Widget extends WP_Widget {
	/**
	* To create the example widget all four methods will be 
	* nested inside this single instance of the WP_Widget class.
	**/
	public function __construct() {
		$widget_options = array( 
		'classname' => 'sub_widget',
		'description' => 'Subscription Widget',
		);
		parent::__construct( 'sub_widget', 'Subscription Widget', $widget_options );
	}

	public function widget( $args, $instance ) {
	$title = apply_filters( 'widget_title', $instance[ 'title' ] );
	$blog_title = get_bloginfo( 'name' );
	$tagline = get_bloginfo( 'description' );
	echo  $args['before_widget'] . $args['before_title'] . $title . $args['after_title'] ; ?>

	<div class="subscription">
		<input type="text" class="input_mail" placeholder="Input your e-mail address">
		<button type="button" class="btn input_btn" >Subscribe</button>
	</div>

	<?php echo $args['after_widget'];
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
		<p>
		  <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		  <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
		</p><?php 
	  }
	  

  }

  function subscribe_widget() { 
	register_widget( 'Subscription_Widget' );
  }
  add_action( 'widgets_init', 'subscribe_widget' );
  

/******** Shortcode *********/
function quote_block( $atts , $content = null ) {

	// Attributes
	$atributes = shortcode_atts(
		array(
			'direction' => 'right',
		),
		$atts,
		'qb'
	);
	return '<div class="quote_block ' . $atributes['direction'] . '">' . do_shortcode($content) . "</div>";
	
}
add_shortcode( 'qb', 'quote_block' );


function quote( $atts , $content = null ) {

	return '<div class="quote">' . $content . '</div>';

}
add_shortcode( 'q', 'quote' );

function image_wrap( $atts , $content = null ) {

	return '<div class="img">' . $content . '</div>';

}
add_shortcode( 'img', 'image_wrap' );

//remove_filter( 'the_content', 'wpautop' );

