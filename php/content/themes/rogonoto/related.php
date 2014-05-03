<?php 
// http://www.wpbeginner.com/wp-themes/how-to-add-related-posts-with-a-thumbnail-without-using-plugins/
$orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page'=> 4, // Number of related posts that will be shown.
'caller_get_posts'=>1
);
$my_query = new wp_query( $args );
if( $my_query->have_posts() ) {
echo '<h3>Related Posts</h3><ul>';
while( $my_query->have_posts() ) {
$my_query->the_post();?>
<li><?php the_post_thumbnail('gambar80', array('class' => 'thumb')); ?>
<h4><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
<p><?php echo excerpt(17); ?></p>
</li>
<?php
}
echo '</ul>';
}
}
$post = $orig_post;
wp_reset_query(); ?>