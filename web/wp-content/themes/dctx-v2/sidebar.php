<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dctx
 */

$classname = ' container';

if ( ! is_active_sidebar( 'footer-bar' ) ) {
	return;
}
?>

<aside class="sidebar widget-area<?php echo esc_attr( $classname ); ?>">
	<?php dynamic_sidebar( 'footer-bar' ); ?>
</aside><!-- .secondary -->
