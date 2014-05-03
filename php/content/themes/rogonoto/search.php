<?php
if($_GET['s']!=''){
$ganti = array('+',' '); //tanda plus dan spasi
$urlredirect = get_settings('home') . '/search/' . str_replace($ganti, '-' ,$_GET['s']). '.html'; //tanda plus dan spasi jadi minus
header("HTTP/1.1 301 Moved Permanently");
header( "Location: $urlredirect" );
}
?><?php get_header(); ?>
<?php echo spp(get_search_query());?>
<div class="clearfix"></div>
<div id="main">
<?php get_template_part( 'sidebarkiri' ); ?>
	<div id="content">
	<div id="breadcrumbs-wrap">
	<div class="breadcrumbs"><a href="/">Home</a><strong><em><?php the_search_query(); ?></em></strong></div>
	</div>
	<?php $postcounter = 1; if (have_posts()) : ?>
	<?php while (have_posts()) : $postcounter = $postcounter + 1; the_post(); $do_not_duplicate = $post->ID; $the_post_ids = get_the_ID(); ?>
	<div class="post post-<?php echo $postcounter ;?>">
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<?php $featured = of_get_option('featured'); if(($featured == '1')) { ?>
	<div class="kotak"><?php the_post_thumbnail('gambar470', array('class' => 'thumb')); ?></div>
	<?php } else { ?>
	<?php } ?>
	<p><?php echo excerpt(40); ?></p>
	<?php get_template_part( 'meta' ); ?>
	</div>
	<div class='clearfix'></div>
	<?php endwhile; ?>
	<div class="navigation">
			<div class="alignleft"><?php next_posts_link(); ?></div>
			<div class="alignright"><?php previous_posts_link(); ?></div>
	</div>
	
	<?php else : ?>
	<?php endif; ?>
	<?php $agc = of_get_option('agc'); if(($agc == '1')) { ?>
	<div class="agc_posts">
	<?php get_template_part( 'agc' ); ?></div>
	<?php } else { ?>
	<?php } ?>
</div>
<?php get_sidebar(); ?>
<div class='clearfix'></div>
<?php get_footer(); ?>