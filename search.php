<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="search-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header">

							<h1 class="page-title">
								<?php
								printf(
									/* translators: %s: query term */
									esc_html__( 'Search Results for: %s', 'understrap' ),
									'<span>' . get_search_query() . '</span>'
								);
								?>
							</h1>

					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<div class="container">
						<div class="row">
							<?php while ( have_posts() ) : the_post(); ?>

								<?php
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								//get_template_part( 'loop-templates/content', 'search' );
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
								
								?>



							<?php endwhile; ?>
						</div>
					</div>
				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php //get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #search-wrapper -->

<?php get_footer(); ?>
