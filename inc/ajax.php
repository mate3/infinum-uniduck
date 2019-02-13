<?php
/**
 * AJAX functions.
 *
 * @package understrap
 */
//echo ("TESTTEST");
add_action( 'wp_ajax_nopriv_load_more', 'load_more');
add_action( 'wp_ajax_load_more', 'load_more');

 function load_more(){

    $paged = $_POST["page"]+1;

    $query_ajax = new WP_Query(array (
        'post_type' => 'post',
        'paged' => $paged
    ));
    if ( $query_ajax->have_posts() ) {
	
        while ( $query_ajax->have_posts() ) {
            $query_ajax->the_post();
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
        } 

    die();
 }
