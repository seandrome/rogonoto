<?php get_header(); ?>
<div class="clearfix"></div>
<div id="main">
<?php get_template_part( 'sidebarkiri' ); ?>
	<div id="content">
	<div id="breadcrumbs-wrap">
	<h1 class="breadcrumbs"><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></h1></div>
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
		<div style="clear: both"></div>
	</div>
	<div class='clearfix'></div>
	<?php endwhile; ?>
	<div class="pagenavi">
		<?php wp_pagenavi('', '', '', '', 10, false); ?>
	<div class="clearfix"></div>
	</div>	
	</div>
	<?php else : ?>
		<h2>Not Found</h2>
		<div class="entry">Sorry, but you are looking for something that isn't here.</div>
	<?php endif; ?>
<?php get_sidebar(); ?>
<div class='clearfix'></div>
<?php get_footer(); ?>