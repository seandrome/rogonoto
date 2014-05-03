<?php get_header(); ?>
<div class="clearfix"></div>
<div id="main">
<?php get_template_part( 'sidebarkiri' ); ?>
	<div id="content">
	<div id="breadcrumbs-wrap">
	<?php echo dimox_breadcrumbs(); ?>
	</div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="entry">
	<div itemscope itemtype="http://data-vocabulary.org/Review">
		<h1 class="stitle"><span itemprop="itemreviewed"><?php the_title(); ?></span></h1>
		<div class="entry-meta">
<span class="author vcard" itemprop="reviewer"><a class="url fn n" href="<?php if (get_the_author_url()) { ?><?php the_author_url(); ?><?php } else {  ?><?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?><?php } ?>" title="<?php the_author_meta('display_name'); ?>" rel="author me"><?php the_author_meta('display_name'); ?></a></span><span class="published entry-date"><time itemprop="dtreviewed" datetime="<?php the_date('F j, Y'); ?>"><?php the_time('F j, Y') ?></time></span><span class="entry-utility-prep entry-utility-prep-cat-links category"><?php the_category(', '); ?></span><span class="rating" itemprop="rating">4.5</span></div>
	</div>
		<?php $agc_dua_act1 = get_theme_option('agc_dua_act1'); if(($agc_dua_act1 == '') || ($agc_dua_act1 == 'No')) { ?><?php } else { ?>
	<div class='ads'>
	<span>Advertisement</span>
	<div class="widget_ads">
	<?php echo get_theme_option('iklan_atas'); ?>
	</div>
	</div>
	<?php } ?>
	<?php the_content(); ?>
	<?php $agc_tiga_act1 = get_theme_option('agc_tiga_act1'); if(($agc_tiga_act1 == '') || ($agc_tiga_act1 == 'No')) { ?><?php } else { ?>
	<div class='ads'>
	<span>Advertisement</span>
	<div class="widget_ads">
	<?php echo get_theme_option('iklan_bawah'); ?>
	</div>
	</div>
	<?php } ?>
	</div>
	<?php get_template_part( 'sosmed' ); ?>
	<div class='clearfix'></div>
	<?php get_template_part( 'authorbox' ); ?>
	<div class='clearfix'></div>	
	<div class="related_posts">
	<?php get_template_part( 'related' ); ?></div>

<?php $agc = of_get_option('agc'); if(($agc == '1')) { ?>
	<div class="agc_posts">
	<?php get_template_part( 'agc' ); ?></div>
	<?php } else { ?>
	<?php } ?>
	
	<?php $fbappid = of_get_option('fbappid'); if(($fbappid == '')) { ?>
	<?php } else { ?>	
	<?php if( comments_open() ): ?>
    <div id="fb-comments">
    <h3 class="reply-title">Leave a Reply</h3>
	<div id="fb-root"></div>
	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
	<fb:comments href="<?php the_permalink(); ?>" width="460" num_posts="10"></fb:comments>  
    </div>
	<div class='clearfix'></div>
	<?php endif; // end comments_open() ?>
	<?php } ?>	
	<div class='clearfix'></div>
	<?php endwhile; ?>
	<div class='clearfix'></div>
	</div>
	<?php else : ?>
		<h2>Not Found</h2>
		<div class="entry">Sorry, but you are looking for something that isn't here.</div>
	<?php endif; ?>
<?php get_sidebar(); ?>
<div class='clearfix'></div>
<?php get_footer(); ?>