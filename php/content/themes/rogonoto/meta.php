<div class="entry-meta">
<span class="author vcard"><a class="url fn n" href="<?php if (get_the_author_url()) { ?><?php the_author_url(); ?><?php } else {  ?><?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?><?php } ?>" title="<?php the_author_meta('display_name'); ?>" rel="author me"><?php the_author_meta('display_name'); ?></a></span><span class="published entry-date"><?php the_time('F j, Y') ?></span><span class="entry-utility-prep entry-utility-prep-cat-links category"><?php the_category(', '); ?>
</span></div>