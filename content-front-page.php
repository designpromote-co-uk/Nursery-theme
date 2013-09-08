<?php
/**
 * The default template for displaying content on the front page..
 *
 * @package Designpromote
 * @subpackage Nursery
 * @since Nursery 1.0
 */

global $post;
$hide_titles = array( 'Gallery', 'Contact' );
$article_body_class[] = 'home-block';
$title = get_the_title();
if ( in_array( $title, $hide_titles ) ) {
	$article_body_class[] = ' no-title';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $article_body_class ); ?>>
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>

		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'nursery' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php if ( preg_match( '/gallery/i', $title ) ) : ?>
		<a href="<?php the_permalink(); ?>" title="Gallery" rel="bookmark">
		<?php nursery_front_page_gallery( $post->ID, $post->post_content ); ?>
		</a>
		<?php elseif( preg_match( '/children/i', $title ) ) : ?>
		<?php the_widget( 'nursery_WP_Widget_Recent_Posts', array( 'show_date'=>true, 'number'=>4 ) ); ?>
		
		<?php else: ?>
		<?php global $more; $more = 0; // turn on use Read More on pages ?>
		<?php the_content( __( 'More...<span class="meta-nav">&rarr;</span>', 'nursery' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'nursery' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		<?php endif; //gallery home-block ?>
	</div><!-- .entry-content -->
	<?php endif; //is_search() ?>

	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() && ( preg_match( '/parent/i', $title ) ) ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'nursery' ) . '</span>', __( 'One comment so far', 'nursery' ), __( 'View all % comments', 'nursery' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
