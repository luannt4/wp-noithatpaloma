<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

<div class="row">
    
    <div class="large-9 col pb-0 mb-0">

        <div class="product-page-sections">
        <?php foreach ( $tabs as $key => $tab ) : ?>
        <div class="product-section">
        <div class="row">

        <div class="large-12 col pb-0 mb-0">
        <div class="panel entry-content">
        <?php call_user_func( $tab['callback'], $key, $tab ) ?>
        </div>
        </div>
        </div>
        </div>
        <?php endforeach; ?>
        </div>

    </div>
    <div class="large-3 col pb-0 mb-0">
        <div class="is-sticky-column">
        <div id="product-sidebar">
        <?php
        dynamic_sidebar('product-sidebar');
        ?>
        </div>
        </div>
    </div>
</div>




<?php endif; ?>
