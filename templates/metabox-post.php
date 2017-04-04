<?php wp_nonce_field('save_coupon_link', 'coupon_link_field'); ?>
<div class="tcmc-box">
	<div class="tcmc-row tcmc-clear">
		<label class="link" for="coupon_link">Link Affiliate</label>
        <input id="coupon_link" type="text" autocomplete="off" 
        <?php if(isset($coupon_link)) echo 'value="'. esc_attr($coupon_link) .'"';?> 
        name="coupon_link" placeholder="http://tapchimua.com">
	</div>
</div>