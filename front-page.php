<?php
/**
 * Template Name: Nursery Theme Front Page
 *
 * Description: The front page template for nursery theme consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package Designpromote
 * @subpackage Nursery
 * @since Nursery 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<?php $front_page = get_option( 'page_on_front' ); ?>
			<?php query_posts( array( 'post__not_in' => array( $front_page ), 'post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC' ) ); //hide the front page //query_posts() uses more loading time, may use get_posts or WP_Query ?>
			<?php //query_posts( array( 'post_type' => 'page', 'orderby' => 'menu_order', 'order' => 'ASC' ) ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'front-page' ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>