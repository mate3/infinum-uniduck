<?php
/**
 * Template Name: Home Page
 *
 * Template for displaying a page just with the header and footer area and a "naked" content area in between.
 * Good for landingpages and other types of pages where you want to add a lot of custom markup.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();


$h_title = get_field('homepage_title', 'options');


?>
<header>
    <div class="container">
        <div class="row heading">
            <div class="col-sm-12 text-center">
                <?php
                if($h_title){
                    echo '<h1>' . $h_title . '</h1>';
                } else{
                    echo the_title('<h1>','</h1>');
                }
                ?>
            </div>
            <div class="col-sm-12 text-center">
			<form id="nav-search-form" role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
            <i class="fa fa-search" aria-hidden="true"></i>
                <label>
			        <input type="search" class="search-field"
			            value="<?php echo get_search_query() ?>" name="s" placeholder="Search blog"
			            title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
			    </label>
			    <!--<input type="submit" class="search-submit search-btn-hack"
			        value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />-->
			</form>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
<?php
$sticky = get_option( 'sticky_posts' );
$args_sticky = array(
    'post_type' => 'post',
    'order'   => 'ASC',
    // 'meta_query' => array(
    //     array(
    //         'key' => 'featured_post', 
    //         'value' => '1'
    //     )
    // ),
    'post__in' => $sticky,
    'posts_per_page' => 1,
);
$args = array(
    'post_type' => 'post',
    'order'   => 'ASC',
    'posts_per_page' => 6,
    'post__not_in' => $sticky
);

// The Query
$the_query = new WP_Query( $args );
$the_query_sticky = new WP_Query( $args_sticky );
$have_featured = false;
// The Loop
if ( $the_query_sticky->have_posts() ) {
	
	while ( $the_query_sticky->have_posts() ) {
        $the_query_sticky->the_post();
        $tags = get_the_tags();
        $featured = get_field('featured_post');

        //if($have_featured == false && $featured==true){
            echo '<div class="col-md-12"><div class="article main-loop">';
            echo '<div class="row">';
            echo '<div class="col-md-6"><div class="post-img">';
            echo the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']) ;
            echo '</div></div>';
            echo '<div class="col-md-6"><div class="date">';
            echo the_time('F d Y'); 
            echo '</div>';
            echo '<a href="' . get_permalink() . ' "class="title-link"> <h2>' . get_the_title() . '</h2></a>';
            echo '<div class="tags">'; 
            if ($tags) {
                echo '<ul>';
                    foreach($tags as $tag) {
                    echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>'; 
                    }
                echo '</ul>';
            }
            echo '</div>';
            echo '<div class="intro">'; 
            echo the_excerpt();
            echo '</div>';
            echo '<div class="comments"> <span class="fav">17 faves</span> <span class="com">22 comments</span> </div>';
            echo '</div></div>';
            echo '</div> </div>';

    }
}
        if ( $the_query->have_posts() ) {
	
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $tags = get_the_tags();


            echo '<div class="col-md-4"><div class="article main-loop">';
            echo '<div class="post-img">';
            echo the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']) ;
            echo '</div>';
            echo '<div class="date">';
            echo the_time('F d Y'); 
            echo '</div>';
            echo '<a href="' . get_permalink() . ' "class="title-link"> <h2>' . get_the_title() . '</h2></a>';
            echo '<div class="tags">'; 
            if ($tags) {
                echo '<ul>';
                    foreach($tags as $tag) {
                    echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>'; 
                    }
                echo '</ul>';
            }
            echo '</div>';
            echo '<div class="intro">'; 
            echo the_excerpt();
            echo '</div>';
            echo '<div class="comments"> <span class="fav">17 faves</span> <span class="com">22 comments</span> </div>';
            echo '</div> </div>';

	}
	/* Restore original Post Data */
	wp_reset_postdata();
} else {
	// no posts found
}
?>
    </div>
</div>
<?php
get_footer();
