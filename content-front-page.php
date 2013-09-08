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
		<?php if ( 'Gallery' == $title ) : ?>
		<?php $args = array(
			'numberposts' => -1,
			'order' => 'ASC',
			'post_mime_type' => 'image',
			'post_parent' => $post->ID,
			'post_status' => null,
			'post_type' => 'attachment',
		);
		$number_attachment = 0; 
		$attachments = get_children( $args );
		if ( $attachments ) {
			foreach ( $attachments as $attachment ) {
				//$number_attachment++;
				if( ++$number_attachment > 2 ) break;
				//$image_attributes = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' )  ? wp_get_attachment_image_src( $attachment->ID, 'thumbnail' ) : wp_get_attachment_image_src( $attachment->ID, 'full' );
				echo '<img src="' . wp_get_attachment_thumb_url( $attachment->ID ) . '" class="current">';
			}
		}
		/* show up to 4 images from [gallery] and attachment */
		$regex_pattern = get_shortcode_regex();
		//var_dump( $regex_pattern );
    preg_match ('/'.$regex_pattern.'/s', $post->post_content, $regex_matches);
		//var_dump( $regex_matches[3] ); 
		
		if( $regex_matches ) :
		preg_match_all( "/[0-9]+/", $regex_matches[3], $matches );
		//var_dump( $matches );
		//print_r( $matches );
		$number_image = 0;
		$total_image = 4 - $number_attachment;
		foreach( $matches as $vals ) {
			foreach( $vals as $val ) {
				if( ++$number_image > $total_image ) break; 
				echo wp_get_attachment_image( $val, array( 160, 160 ) );
			}
		}
		endif;
		?>
		<?php elseif( 'Children Activities' == $title ):?>
		<?php the_widget( 'zn_sparkle_WP_Widget_Recent_Posts', array( 'show_date'=>true, 'number'=>4 ) ); ?>
		
		<?php else: ?>
		<?php global $more; $more = 0; // turn on use Read More on pages ?>
		<?php the_content( __( 'More <span class="meta-nav">&rarr;</span>', 'nursery' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'nursery' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		<?php endif; ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() && ( 'Parents Comments' == $title ) ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'nursery' ) . '</span>', __( 'One comment so far', 'nursery' ), __( 'View all % comments', 'nursery' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
