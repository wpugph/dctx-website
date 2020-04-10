<?php
/**
 * The template used for displaying an accordion block.
 *
 * @package dctx
 */

// Set up fields.
$block_title     = get_field( 'title' );
$text            = get_field( 'text' );
$accordion_items = get_field( 'accordion_items' );
$row_index       = get_row_index();
$alignment       = dctx_get_block_alignment( $block );
$classes         = dctx_get_block_classes( $block );

// Start a <container> with possible block options.
dctx_display_block_options(
	array(
		'block'     => $block,
		'container' => 'section', // Any HTML5 container: section, div, etc...
		'class'     => 'content-block accordion-block' . esc_attr( $alignment . $classes ), // Container class.
	)
);

?>
	<div class="container">
		<?php if ( $block_title ) : ?>
			<h2 class="block-title"><?php echo esc_html( $block_title ); ?></h2>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<?php echo dctx_get_the_content( $text ); // phpcs: xss: ok. ?>
		<?php endif; ?>

		<?php if ( $accordion_items ) : ?>
			<?php $count = 0; ?>
			<div class="accordion" aria-label="<?php esc_attr_e( 'Accordion Content Block', 'dctx' ); ?>">
				<?php foreach ( $accordion_items as $accordion_item ) : ?>
					<?php
					$count++;
					$item_title      = get_sub_field( 'accordion_title' );
					$item_content    = get_sub_field( 'accordion_text' );
					$item_content_id = 'accordion-' . intval( $row_index ) . '-item-' . intval( $count );
					?>
					<div class="accordion-item">
						<div class="accordion-item-header">
							<h3 class="accordion-item-title"><?php echo esc_html( $accordion_item['accordion_title'] ); ?>
								<button class="accordion-item-toggle" aria-expanded="false" aria-controls="<?php echo esc_attr( $item_content_id ); ?>">
									<span class="screen-reader-text"><?php echo sprintf( esc_html( 'Toggle %s', 'dctx' ), esc_html( $accordion_item['accordion_title'] ) ); ?></span>
									<span class="accordion-item-toggle-icon" aria-hidden="true">+</span>
								</button>
							</h3>
						</div>
						<div id="<?php echo esc_attr( $item_content_id ); ?>" class="accordion-item-content" aria-hidden="true">
							<?php echo dctx_get_the_content( $accordion_item['accordion_text'] ); // phpcs: xss: ok. ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
