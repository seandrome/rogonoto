<div id="sidebar">
<?php $agc_satu_act1 = get_theme_option('agc_satu_act1'); if(($agc_satu_act1 == '') || ($agc_satu_act1 == 'No')) { ?><?php } else { ?>
<div class='ads'>
	<h3 class="title"><span>Advertisement</span></h3>
	<div class="widget_ads">
	<?php echo get_theme_option('iklan_kanan'); ?>
	</div>
	</div>
<?php } ?>
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar') ) : ?>
<?php endif; ?>
</div>