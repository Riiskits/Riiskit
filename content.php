<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Wordpress
 * @subpackage Riiskit
 * @since Riiskit 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php riiskit_post_thumbnail(); ?>



	<header class="entry__header">
		<?php
		if ( is_single() ) : ?>
			<h1 class="entry__title">
				<?php the_title(); ?>
			</h1>
		<?php else : ?>
			<h2 class="entry__title">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>
		<?php endif; ?>

		<div class="entry__meta">
			<?php riiskit_entry_meta(); ?>
		</div> <!-- .entry__meta -->
	</header> <!-- .entry__header -->



	<div class="entry__content">
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading %s', 'riiskit' ),
			the_title( '<span class="screenreader">', '</span>', false )
		) );

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'riiskit' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screenreader">' . __( 'Page', 'riiskit' ) . ' </span>%',
			'separator'   => '<span class="screenreader">, </span>',
		) );
		?>
	</div> <!-- .entry__content -->

</article> <!-- #post-## -->
