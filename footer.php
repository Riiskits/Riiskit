<?php
/**
 * @package WordPress
 * @subpackage Riiskit
 *
 * @since Riiskit 1.0.0
 */
?>

		</div> <!-- .site-main -->





		<footer class="site-footer" role="contentinfo">
			<div class="site-footer__inner">
				<span class="copyright">
					<?php _e('Copyright', 'riiskit'); ?> &copy; <?php echo date('Y'); ?> <?php echo esc_html( get_bloginfo('name') ); ?>
				</span>

				<span class="creator">
					<?php _e('Made by ', 'riiskit'); ?> <a href="<?php echo RIISKIT_AUTHOR_URL; ?>" target="_blank"><?php echo RIISKIT_AUTHOR_NAME ?></a>
				</span>
			</div> <!-- .site-footer__inner -->
		</footer> <!-- .site-footer -->

	</div> <!-- .site-->

<?php wp_footer(); ?>

</body>
</html>