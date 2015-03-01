<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Riiskit
 * @since Riiskit 1.3.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php riiskit_post_thumbnail(); ?>



	<header class="entry__header">
		<h2 class="entry__header__title">
			<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>

		<div class="entry__header__meta">
			<?php riiskit_entry_meta(); ?>
		</div>
	</header><!-- .entry__header -->



	<div class="entry__summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
