<div id="sidebarkiri">
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('left sidebar') ) : ?><?php endif; ?>
<div class='clearfix'></div>
<?php $agc_thumb_act1 = get_theme_option('agc_thumb_act1'); if(($agc_thumb_act1 == 'No') || ($agc_thumb_act1 == 'No')) { ?><?php } else { ?>
<div class='ads'>
	<h3 class="title"><span>Advertisement</span></h3>
	<div class="widget_ads">
	<?php echo get_theme_option('iklan_tengah'); ?>
	</div>
	</div>
<?php } ?>
</div>