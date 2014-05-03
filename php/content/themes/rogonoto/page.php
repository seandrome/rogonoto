<?php get_header(); ?>
<div class="clearfix"></div>
<div id="main">
	<?php get_template_part( 'sidebarkiri' ); ?>
	<div id="content">
	<?php echo dimox_breadcrumbs(); ?>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="entry">
	<h1 class="stitle"><?php the_title(); ?></h1>
	<?php the_content(); ?>
	</div>
	<div class="sharebar">
	<?php get_template_part( 'sharebar' ); ?>
	</div>
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