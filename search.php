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
								
									echo '<div class="col-md-4">';
									echo '<div class="article">';
									echo '<div class="post-img">' . the_post_thumbnail('post-thumbnail', ['class' => 'img-fluid']) . '</div>';
									echo '<div class="date">' . the_date() . '</div>';
									echo '<div class="tags">' . the_tags('<ul><li>', '</li><li>', '</li></ul>') . '</div>';
									
									echo '<h2>' . get_the_title() . '</h2>';
									echo '<div class="intro">' . the_excerpt() . '</div>';
									echo '</div>';
									echo '</div>';
								
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
