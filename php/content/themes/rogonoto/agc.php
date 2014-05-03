<div class="agc_post"><h3>Related Sites</h3></div>
<ul>﻿<?php $edit = array ('-' , '/' , '.html');
$sumber = str_replace($edit, ' ', $_SERVER['REQUEST_URI']);
?>
<?php
// Get RSS Feed(s)
include_once(ABSPATH . WPINC . '/feed.php');
 
$query = $sumber ;
$rss = fetch_feed('http://www.bing.com/search?q=' . str_replace(' ', '+', $query) . '&go=&form=QBLH&filt=all&format=rss');
 
if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly
// Figure out how many total items there are, but limit it to 10.
$maxitems = $rss->get_item_quantity(5);
 
// Build an array of all the items, starting with element 0 (first element).
$rss_items = $rss->get_items(0, $maxitems);
endif;
 
?>
<?php if ($maxitems == 0)
echo ' ';
else
 
// Loop through each feed item and display each item as a hyperlink.
foreach ( $rss_items as $item ) : ?>
<li><h4><a href="<?php echo $item->get_permalink(); ?>" target="_blank" rel="nofollow"><?php echo $item->get_title(); ?></a></h4>
<?php echo $item->get_description(); ?>
<?php
$erase = array ('block keyword di sini',';' , '%' , '+' , '-' , '&', ':' , 'amp;' , ' ...' , ' ....' , ' .....' , '–' , '|' , '/' , '[' , ']' , '?' , '$' , ','  , '.' , '«' , '(' , ')', '::' , '~');
$first = str_replace ($erase , '' , $item->get_title());
$encode = urlencode(strtolower($first));
$plus = str_replace ('+' , '-' , $encode);
$minus = array ('--' , '---' , '----');
$link = str_replace ($minus , '-' , $plus);
?><br/>
<strong>Sources : </strong><a href=<?php bloginfo('url'); ?>/search/<?php echo $link; ?>><?php echo $item->get_title(); ?></a>
<?php endforeach; ?></li></ul>