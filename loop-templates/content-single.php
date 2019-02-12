<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<div class="col">
	<div class="entry-content">
		
		<div class="single-container">
			<?php the_content(); ?>
		</div>
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->
</div>
	<footer class="entry-footer">
		<div class="container">
			<div class="single-container">
				<div class="tags">
					<?php $tags = get_the_tags();
					if ($tags) {
						echo '<ul>';
							foreach($tags as $tag) {
							echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>'; 
							}
						echo '</ul>';
					} ?>
				</div>	
			</div>
		</div>	
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
