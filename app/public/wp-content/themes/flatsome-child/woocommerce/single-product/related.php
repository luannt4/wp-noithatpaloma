<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get Type.
$type = get_theme_mod( 'related_products', 'slider' );
if ( $type == 'hidden' ) return;
if ( $type == 'grid' ) $type = 'row';

$repater['type']         = $type;
$repater['columns']      = get_theme_mod( 'related_products_pr_row', 4 );
$repater['columns__md']  = get_theme_mod( 'related_products_pr_row_tablet', 3 );
$repater['columns__sm']  = get_theme_mod( 'related_products_pr_row_mobile', 2 );
$repater['class']        = get_theme_mod( 'equalize_product_box' ) ? 'equalize-box' : '';
$repater['slider_style'] = 'simple';
$repater['row_spacing']  = 'small';


if ( $related_products ) : ?>
<div class="large-12">
	<div class="related related-products-wrapper">

		<?php
		$heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

		if ( $heading ) :
			?>
			<h3 class="product-section-title product-section-title-related pt-half">
				<?php echo esc_html( $heading ); ?>
			</h3>
		<?php endif; ?>


	<?php get_flatsome_repeater_start( $repater ); ?>

		<?php foreach ( $related_products as $related_product ) : ?>

					<?php
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );
					?>

		<?php endforeach; ?>

		<?php get_flatsome_repeater_end( $repater ); ?>

	</div>
</div>
	<?php
endif;

wp_reset_postdata();
