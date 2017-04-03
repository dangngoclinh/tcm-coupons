<?php wp_nonce_field('save_coupon_code', 'coupon_code_field'); ?>
<div class="tcmc-box">
	<div class="tcmc-row tcmc-clear">
		<label class="percent" for="coupon_code">Coupon Code</label>
        <input id="coupon_code" type="text" autocomplete="off"
        <?php if(isset($coupon['code'])) echo 'value="'. esc_attr($coupon['code']) .'"';?>
        name="coupon[code]" placeholder="Coupon Code">
	</div>
	<div class="tcmc-row tcmc-clear">
		<label class="percent" for="coupon_percent">Percent</label>
        <input id="coupon_percent" type="text" autocomplete="off"
        <?php if(isset($coupon['percent'])) echo 'value="'. esc_attr($coupon['percent']) .'"';?>
        name="coupon[percent]" placeholder="Discount amount">
	</div>
	<div class="tcmc-row tcmc-clear">
		<label class="percent" for="coupon_percent">Exp Date</label>
        <input id="coupon_exp" type="text" autocomplete="off"
        <?php if(isset($coupon_exp)) echo 'value="'. esc_attr($coupon_exp) .'"';?>
        name="coupon_exp" placeholder="Date Exp">
	</div>
		<div class="tcmc-row tcmc-clear">
		<label class="percent" for="coupon_like">Like</label>
        <input id="coupon_like" type="number" autocomplete="off"
		<?php if(isset($coupon['like'])) echo 'value="'. esc_attr($coupon['like']) .'"';?>
        name="coupon[like]" placeholder="0">
	</div>
		<div class="tcmc-row tcmc-clear">
		<label class="percent" for="coupon_unlike">Unlike</label>
        <input id="coupon_unlike" type="number" autocomplete="off" 
        <?php if(isset($coupon['unlike'])) echo 'value="'. esc_attr($coupon['unlike']) .'"';?>
        name="coupon[unlike]" placeholder="0">
	</div>
	<div class="tcmc-row tcmc-clear">
		<label class="percent" for="coupon_unlike">Link Affiliate</label>
        <input id="coupon_unlike" type="text" autocomplete="off" 
        <?php if(isset($coupon['link'])) echo 'value="'. esc_attr($coupon['link']) .'"';?> 
        name="coupon[link]" placeholder="http://tapchimua.com">
	</div>
</div>