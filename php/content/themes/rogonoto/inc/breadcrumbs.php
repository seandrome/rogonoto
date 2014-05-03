<?php

//* http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
function dimox_breadcrumbs() {
  
    /* === OPTIONS === */  
    $text['home']     = 'Home'; // text for the 'Home' link  
    $text['category'] = 'Archive by Category "%s"'; // text for a category page  
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page  
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page  
    $text['author']   = 'Articles Posted by %s'; // text for an author page  
    $text['404']      = 'Error 404'; // text for the 404 page  
  
    $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show  
    $show_on_home   = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show  
    $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show  
    $show_title     = 1; // 1 - show the title for the links, 0 - don't show  
    $delimiter      = '&nbsp'; // delimiter between crumbs  
    $before         = '<span class="current">'; // tag before the current crumb  
    $after          = '</span>'; // tag after the current crumb  
    /* === END OF OPTIONS === */  
  
    global $post;  
    $home_link    = home_url('/');  
    $link_before  = '<span typeof="v:Breadcrumb">';  
    $link_after   = '</span>';  
    $link_attr    = ' rel="v:url" property="v:title"';  
    $link         = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;  
    $parent_id    = $parent_id_2 = $post->post_parent;  
    $frontpage_id = get_option('page_on_front');  
  
    if (is_home() || is_front_page()) {  
  
        if ($show_on_home == 1) echo '<div class="breadcrumbs"><a href="' . $home_link . '">' . $text['home'] . '</a></div>';  
  
    } else {  
  
        echo '<div class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';  
        if ($show_home_link == 1) {  
            echo sprintf($link, $home_link, $text['home']);  
            if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;  
        }  
  
        if ( is_category() ) {  
            $this_cat = get_category(get_query_var('cat'), false);  
            if ($this_cat->parent != 0) {  
                $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);  
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
                echo $cats;  
            }  
            if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;  
  
        } elseif ( is_search() ) {  
            echo $before . sprintf($text['search'], get_search_query()) . $after;  
  
        } elseif ( is_day() ) {  
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;  
            echo $before . get_the_time('d') . $after;  
  
        } elseif ( is_month() ) {  
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
            echo $before . get_the_time('F') . $after;  
  
        } elseif ( is_year() ) {  
            echo $before . get_the_time('Y') . $after;  
  
        } elseif ( is_single() && !is_attachment() ) {  
            if ( get_post_type() != 'post' ) {  
                $post_type = get_post_type_object(get_post_type());  
                $slug = $post_type->rewrite;  
                printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);  
                if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;  
            } else {  
                $cat = get_the_category(); $cat = $cat[0];  
                $cats = get_category_parents($cat, TRUE, $delimiter);  
                if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
                $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
                echo $cats;  
                if ($show_current == 1) echo $before . get_the_title() . $after;  
            }  
  
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {  
            $post_type = get_post_type_object(get_post_type());  
            echo $before . $post_type->labels->singular_name . $after;  
  
        } elseif ( is_attachment() ) {  
            $parent = get_post($parent_id);  
            $cat = get_the_category($parent->ID); $cat = $cat[0];  
            $cats = get_category_parents($cat, TRUE, $delimiter);  
            $cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);  
            $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
            if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
            echo $cats;  
            printf($link, get_permalink($parent), $parent->post_title);  
            if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;  
  
        } elseif ( is_page() && !$parent_id ) {  
            if ($show_current == 1) echo $before . get_the_title() . $after;  
  
        } elseif ( is_page() && $parent_id ) {  
            if ($parent_id != $frontpage_id) {  
                $breadcrumbs = array();  
                while ($parent_id) {  
                    $page = get_page($parent_id);  
                    if ($parent_id != $frontpage_id) {  
                        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));  
                    }  
                    $parent_id = $page->post_parent;  
                }  
                $breadcrumbs = array_reverse($breadcrumbs);  
                for ($i = 0; $i < count($breadcrumbs); $i++) {  
                    echo $breadcrumbs[$i];  
                    if ($i != count($breadcrumbs)-1) echo $delimiter;  
                }  
            }  
            if ($show_current == 1) {  
                if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;  
                echo $before . get_the_title() . $after;  
            }  
  
        } elseif ( is_tag() ) {  
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;  
  
        } elseif ( is_author() ) {  
            global $author;  
            $userdata = get_userdata($author);  
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;  
  
        } elseif ( is_404() ) {  
            echo $before . $text['404'] . $after;  
        }  
  
        if ( get_query_var('paged') ) {  
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';  
            echo __('Page') . ' ' . get_query_var('paged');  
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';  
        }  
  
        echo '</div><!-- .breadcrumbs -->';  
  
    }  
} // end dimox_breadcrumbs()
?>
<?php
//* http://www.wpquestions.com/question/show/id/691 
function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
	global $request, $posts_per_page, $wpdb, $paged;
	if(empty($prelabel)) {
		$prelabel  = '<strong>&laquo;</strong>';
	}
	if(empty($nxtlabel)) {
		$nxtlabel = '<strong>&raquo;</strong>';
	}
	$half_pages_to_show = round($pages_to_show/2);
	if (!is_single()) {
		if(!is_category()) {
			preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);		
		} else {
			preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);		
		}
		$fromwhere = $matches[1];
		$numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
		$max_page = ceil($numposts /$posts_per_page);
		if(empty($paged)) {
			$paged = 1;
		}
		if($max_page > 1 || $always_show) {
			echo "$before <div class='navigator'><span><strong>Pages $paged of $max_page</strong>:</span>";
			if ($paged >= ($pages_to_show-1)) {
				echo '<a href="'.get_pagenum_link().'">&laquo; First</a> ... ';
			}
			previous_posts_link($prelabel);
			for($i = $paged - $half_pages_to_show; $i  <= $paged + $half_pages_to_show; $i++) {
				if ($i >= 1 && $i <= $max_page) {
					if($i == $paged) {
						echo "<strong class='on'>$i</strong>";
					} else {
						echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';
					}
				}
			}
			next_posts_link($nxtlabel, $max_page);
			if (($paged+$half_pages_to_show) < ($max_page)) {
				echo ' ... <a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';
			}
			echo "</div> $after";
		}
	}
}
?>
<?php
//* http://bavotasan.com/2009/limiting-the-number-of-words-in-your-excerpt-or-content-in-wordpress/ 
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}
?>