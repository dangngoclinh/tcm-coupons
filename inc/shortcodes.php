<?php
// [bartag foo="foo-value"]
function coupons_function( $atts ) {
    $a = shortcode_atts( array(
        'cat' => -1,
        'coupon' => -1
    ), $atts );

    if($a['cat'] != -1) {
        $date = date('Y/m/d');
        $args = array(
            'post_type' => 'coupon',
            'tax_query' => array(
                array(
                    'taxonomy' => 'store',
                    'field'    => 'term_id',
                    'terms'    => $a['cat'],
                ),
            ),
            'meta_query' => array(
                array(
                    'key'       => 'coupon_exp',
                    'value'     => $date,
                    'compare'   => '>=',
                    'type'      => 'DATETIME',
                ),
            )
        );
        $query = new WP_Query($args);
        if($query->have_posts()) {
            while($query->have_posts()) {
                $query->the_post();
                $coupon = get_post_meta(get_the_ID(), 'coupon_details', true);
                $coupon_exp = get_post_meta(get_the_ID(), 'coupon_exp', true);
                include (TCM_COUPON_DIR . 'templates/default.php');

            }
            wp_reset_postdata();
        }
    }

    if($a['coupon'] != -1) {
    	return 'coupons41';
    }
}
add_shortcode( 'COUPONS', 'coupons_function' );