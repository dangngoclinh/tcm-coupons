<div class="tcmc-box">
	<div class="tcmc-header clearfix">
		<div class="tcmc-percent">
			<p class="tcmc-percent-value"><?php _e("Giảm", "tcm-coupons"); ?> <br /> <span><?php echo $coupon['percent'];?></span></p>
		</div>
		<div class="tcmc-detail">
			<ul class="tcmc-title">

				<?php
					$date1 		= date_create(date('Y/m/d'));
					$date2		= date_create($coupon_exp);
					$date_diff	= date_diff($date1,$date2);
					$datenumber = $date_diff->format("%a");
				?>
				<li><i class="fa fa-check-circle" aria-hidden="true"></i><?php printf(_n('Còn %s ngày nữa', 'Còn %s ngày nữa', $datenumber + 1, 'tcm-coupons'), $datenumber + 1); ?></li>
			</ul>
			<h3 class="tcmc-coupon-title">
				<?php the_title();?>
			</h3>
		</div>

		<div class="tcmc-click">
			<a href="#">
				<span class="tcmc-coupon-code"><?php echo $coupon['code'];?></span>
				<span class="tcmc-copy"><?php _e("Copy Mã", 'tcm-coupons'); ?></span>
			</a>
		</div>
	</div>
	<p class ="tcmc-coupon-note clearfix">
		<span class="bold"><?php _e('Node: ', 'tcm-coupons'); ?></span> <?php the_content();?>
	</p>
</div>