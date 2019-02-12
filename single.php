<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $post;
$author_id=$post->post_author;
get_header();
$container = get_theme_mod( 'understrap_container_type' );
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$intro = get_field('post_intro');
?>

<div class="wrapper" id="single-wrapper">
	<?php while ( have_posts() ) : the_post(); ?>
		<header>
			<div class="header-bg" style="background-image: url('<?php echo $thumb['0'];?>')">
				<div class="<?php echo esc_attr( $container ); ?>">
					<div class="heading-content">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<div class="author"><?php echo get_the_author(); ?></div> 
					</div>
					<div class="text-center btb"><a href="<?= get_home_url()?>">Back to blog</a></div>
				</div>
			</div>
		</header>

		<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

			<div class="row">

				<main class="site-main" id="main">

				<?= '<div class=" intro-text">' . $intro . '</div>';?>

						<?php get_template_part( 'loop-templates/content', 'single' ); ?>

						<?php //understrap_post_nav(); ?>

						<div id="cooler-nav" class="more-posts single-container">
							<div class="container">
								<div class="row">
								<?php  $nextPost = get_next_post(true); //Should set previous if next is empty!
									if($nextPost) { ?>
									<div class="col-sm-12">
										<h2 class="text-center more-title">More magic</h2>
									</div>
									
									
									<div class="col-md-6 nav-box next">
									<?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, array(250,250) );  
									next_post_link('%link',"$nextthumbnail", TRUE); 
									?>
									</div>

									<div class="col-md-6">
									<?php 
										next_post_link('%link',"  <h2>%title</h2>", TRUE); 
										setup_postdata( $nextPost ); the_excerpt(); wp_reset_postdata(); 
									?>
									</div>
									<?php } ?>
								</div>
							</div><!--end .container-->
						</div>

				</main><!-- #main -->

			</div><!-- .row -->

		</div><!-- #content -->
	<?php endwhile; // end of the loop. ?>
</div><!-- #single-wrapper -->

<?php get_footer(); ?>
