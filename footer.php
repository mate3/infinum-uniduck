<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'understrap_container_type' );

$image = get_field('footer_logo', 'options');
$copy = get_field('copyright', 'options');
$fb_text = get_field('facebook_text', 'options');
$fb_link = get_field('facebook_link', 'options');
$tw_text = get_field('twitter_text', 'options');
$tw_link = get_field('twitter_link', 'options');
$in_text = get_field('instagram_text', 'options');
$in_link = get_field('instagram_link', 'options');
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>
<footer class="site-footer">
	<div class="wrapper" id="wrapper-footer">

		<div class="<?php echo esc_attr( $container ); ?>">

			<div class="row">

				<div class="col-md-6 text-left copyright">
					<?php 
				
					if( !empty($image) ): ?>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
					<?php endif; ?>

					<?php
					
					if($copy){
						echo "<div class='copy'>" . $copy . "</div>";
					}
					
					?>
				</div>
				<div class="col-md-6 text-right social">
					<ul><?php //NOTE: Convert this to repeater?>
						<li class="fb"><?php echo $fb_text . '<a href="' . $fb_link . '"<span class="icon"></span></a>'?></li>
						<li class="tw"><?php echo $tw_text?></li>
						<li class="in"><?php echo $in_text?></li>
					</ul>
				</div>

			</div><!-- row end -->

		</div><!-- container end -->

	</div><!-- wrapper end -->
</footer>	

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenLite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/plugins/CSSPlugin.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TimelineLite.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.6/ScrollMagic.min.js"></script>

</body>

</html>

