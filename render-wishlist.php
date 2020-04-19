<?php

/*
Plugin Name: Render Wishlist
Plugin URI: https://marclucraft.co.uk
Description: Shortcode to render the contents of a JetWishlist&Compare Wishlist, to include the content in an Elementor form submission
Version: 1.0
Author: Marc Lucraft
Author URI: https://marclucraft.co.uk
License: GPL2
*/


function grab_wishlist() {
    $wishlist_ids = ! empty( $_SESSION['jet-wish-list'] ) ? $_SESSION['jet-wish-list'] : '';

    if ( is_user_logged_in() ) {
        $wishlist_ids = get_user_meta( get_current_user_id(), 'jet_wish_list', true );
    }

    if ( ! empty( $wishlist_ids ) ) {
        $wishlist_ids = explode( ':', $wishlist_ids );
    } else {
        $wishlist_ids = array();
    }

    foreach ($wishlist_ids as $pid) {
        $name = wc_get_product($pid)->get_name();
        $sku = wc_get_product($pid)->get_sku();
        echo "Product: $name <br>";
        echo "SKU: $sku <br><br>";
    }
}

add_shortcode('rendwishlist', 'grab_wishlist');
