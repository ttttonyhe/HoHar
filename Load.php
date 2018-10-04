<?php
/**
功能说明: 首页无限加载
更新时间：2016-11-11
**/
function fa_make_post_section(){
    global $post;
	$args=array('orderby'=>'name','order'=>'ASC');
	$categories=get_categories($args);
	foreach($categories as $category)
	$the_post_category = get_the_category(get_the_ID());
	$post_section ='<article class="io-article article_large list-article"><div class="list-article-img" style="background-image:url('.get_post_thumbnail().')"></div><div class="list-article-info"><p class="list-article-info-p">收录于 <b style="color: #4a78db;">'.$the_post_category[0]->cat_name.'</b></p><a href="'.get_permalink().'"><h2 class="list-article-info-h2">'.get_the_title().'</h2><p class="list-article-info-p-1">'.wp_trim_words(get_the_excerpt(), 45).'</p></a></div></article>';
    return $post_section;
}
add_action('wp_ajax_nopriv_fa_load_postlist', 'fa_load_postlist_callback');
add_action('wp_ajax_fa_load_postlist', 'fa_load_postlist_callback');
function fa_load_postlist_callback(){
    $postlist = '';
    $paged = !empty($_POST["paged"]) ? $_POST["paged"] : null;
    $total = !empty($_POST["total"]) ? $_POST["total"] : null;
    $category = !empty($_POST["category"]) ? $_POST["category"] : null;
    $author = !empty($_POST["author"]) ? $_POST["author"] : null;
    $tag = !empty($_POST["tag"]) ? $_POST["tag"] : null;
    $search = !empty($_POST["search"]) ? $_POST["search"] : null;
    $year = !empty($_POST["year"]) ? $_POST["year"] : null;
    $month = !empty($_POST["month"]) ? $_POST["month"] : null;
    $day = !empty($_POST["day"]) ? $_POST["day"] : null;
    $query_args = array(
        "posts_per_page" => get_option('posts_per_page'),
        "cat" => $category,
        "tag" => $tag,
        "author" => $author,
        "post_status" => "publish",
        "post_type" => "post",
        "paged" => $paged,
        "s" => $search,
        "year" => $year,
        "monthnum" => $month,
        "day" => $day,
		"ignore_sticky_posts" => 1
    );
    $the_query = new WP_Query( $query_args );
    while ( $the_query->have_posts() ){
        $the_query->the_post();
        $postlist .= fa_make_post_section();
    }
    $code = $postlist ? 200 : 500;
    wp_reset_postdata();
    $next = ( $total > $paged )  ? ( $paged + 1 ) : '' ;
    echo json_encode(array('code'=>$code,'postlist'=>$postlist,'next'=> $next));
    die;
}
function fa_load_postlist_button(){
    global $wp_query;
    if (2 > $GLOBALS["wp_query"]->max_num_pages) {
        return;
    } else {
        $button = '<a id="fa-loadmore" class="io-load_more io-btn js-publishButton is-touched"';
        if (is_category()) $button .= ' data-category="' . get_query_var('cat') . '"';

        if (is_author()) $button .=  ' data-author="' . get_query_var('author') . '"';

        if (is_tag()) $button .=  ' data-tag="' . get_query_var('tag') . '"';

        if (is_search()) $button .=  ' data-search="' . get_query_var('s') . '"';

        if (is_date() ) $button .=  ' data-year="' . get_query_var('year') . '" data-month="' . get_query_var('monthnum') . '" data-day="' . get_query_var('day') . '"';

        $button .= ' data-paged="2" data-action="fa_load_postlist" data-total="' . $GLOBALS["wp_query"]->max_num_pages . '">加载更多</a>';

        return $button;
    }
}