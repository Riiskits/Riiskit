<?php
/**
 * @package WordPress
 * @subpackage Riiskit
 *
 * @since Riiskit 1.0.0
 */
?>

<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" class="screenreader">
    	<?php _e( 'Search', 'riiskit' ); ?>
    </label>

    <input type="search" name="s" id="s" class="searchform__input" autocomplete="off" />
</form>