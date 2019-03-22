<?php
/**
 * Theme Functions.
 *
 * @since peggy 1.0
 */
define( 'THEME_NAME', 'HoHar' );
define( 'THEME_VER', '1.0' );
define( 'THEME_PATH', dirname( __FILE__ ) );
define( "THEME_URL", get_bloginfo( 'template_directory' ) );
if ( !defined( 'THEME_DIR' ) ) {
	define( 'THEME_DIR', get_template_directory() );
}
if ( !defined( 'THEME_URI' ) ) {
	define( 'THEME_URI', get_template_directory_uri() );
}
include (TEMPLATEPATH . '/function/catimages.php' );
include (TEMPLATEPATH . '/function/Load.php' );
include (TEMPLATEPATH . '/function/admin/setting.php' );
include (TEMPLATEPATH . '/function/admin/setting-config.php' );

//自定义邮箱
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
function new_mail_from($old) {
 return 'admin@hohar.top';
}
function new_mail_from_name($old) {
 return 'HoHar官方团队';
}

//登录跳转

function login_redirect( $redirect_to, $request, $user ){   
    
return home_url('');   

}   

add_filter( 'login_redirect', 'login_redirect', 10, 3 );
/**
功能说明: 载入js&css
更新时间：2016-11-11
**/
function barley_scripts_styles() {
	global $wp_styles;
	if(is_single() || is_page()){
		wp_enqueue_script( 'comment-reply' ); 
	}
	wp_enqueue_script( 'jquery', THEME_URI . '/build/js/jquery.min.js', array( ), false );
	wp_enqueue_script( 'bootstrap', THEME_URI . '/build/js/bootstrap.min.js', array( 'jquery' ), true );

	wp_enqueue_script( 'app', THEME_URI . '/build/js/app.js', array( 'jquery' ), true );
	wp_localize_script('app', 'PURE', array(
            'ajax_url' => admin_url('admin-ajax.php'),
        ));
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'main', THEME_URI . '/build/css/main.css', true );
	wp_enqueue_style( 'bootstrap', THEME_URI . '/build/css/bootstrap.min.css',true );
	wp_enqueue_style( 'font-awesome', THEME_URI . '/build/css/font-awesome.min.css', true );

}
add_action( 'wp_enqueue_scripts', 'barley_scripts_styles' );
///
add_action( 'admin_enqueue_scripts', 'barley_setting_scripts' );
function barley_setting_scripts(){
    global $pagenow;
   
    if( $pagenow == "admin.php" && $_GET['page'] == "barley" || $_GET['page'] == "barley" ){
		wp_enqueue_media();
        wp_enqueue_style('setting',  THEME_URI . '/function/admin/css/seting.css', false, THEME_VER, false);
        wp_enqueue_script('setting', THEME_URI .'/function/admin/js/setting.js' , array('jquery') , THEME_VER, true);
    }

}
//barley_setup
function barley_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video' ,'gallery' ) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	register_nav_menu( 'primary', '菜单' );
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'barley_setup' );
//related_post
function barley_related_posts(){
    global $post;
    $query_args = array(
        "posts_per_page" => 2,
        "post__not_in" => array(get_the_ID()),
        "category__in" => wp_get_post_categories(get_the_ID()),
    );
    $output = '<section id="related_posts" class="io-related_posts"><div class="container-fluid"> <h2>其他人还在看</h2><div class="io-related_posts__content"><div class="io-related_posts__wrap">';
    $the_query = new WP_Query($query_args);
    while ($the_query->have_posts()) {
        $the_query->the_post();
        $output .= ' <div class="io-related_post"><div class="io-rt_post"><a href="' . get_permalink() . '" class="io-rt_post__name">' . get_the_title() .'</a></div></div>';
    }
    wp_reset_postdata();
    $output .= '</div></div></section>';
    return $output;
}
////
function barley_next_posts(){
	global $post;
	$prev_post = get_previous_post();
	$next_post = get_next_post();
	$output ='<header class="io-main_header box_shadow io-single_header"><div class="container-fluid header_container"><div class="io-prev_post">';
	if (get_previous_post()){
		$output .='<a href="'. get_permalink( $prev_post->ID ).'"><i class="fa fa-chevron-left"></i> <span></span></a>';
	}
	$output .='</div><div class="io-main_logo"><a href="'.home_url().'"><img src="'. THEME_URI.'/build/images/logo.png'.'" alt="'.bloginfo('name').'">HoHar</a></div><div class="io-next_post">';	
    if (get_next_post() ){
		$output .='<a href="'.get_permalink( $next_post->ID ).'"><span></span><i class="fa fa-chevron-right"></i> </a>';
	}
	$output .='</div></div></header>';
	return $output;
}
////
function social_list(){
	$qq = loobo_get_setting('qq');
	$weibo = loobo_get_setting('weibo');
	$github =loobo_get_setting('github');
	$output ='<div class="col-md-1"><aside class="io-social_aside"><ul class="io-social_list">';
	if( $qq ){
		$output .='<li><a href="tencent://AddContact/?fromId=45&fromSubId=1&subcmd=all&uin='.loobo_get_setting('qq').'"><i class="fa fa-qq"></i></a></li>';
	}
	if( $weibo ){
		$output .='<li><a href="'.loobo_get_setting('weibo').'"><i class="fa fa-weibo"></i></a></li>';
	}
	if( $github ){
		$output .='<li><a href="'.loobo_get_setting('github').'"><i class="fa fa-github"></i></a></li>';
	}
	$output .='</ul></aside> </div>';
	return $output;
}
/**
功能说明: 评论回复自动添加@
更新时间：2016-11-11
**/
add_filter('comment_text','comment_add_at_parent');
function comment_add_at_parent($comment_text){
    $comment_ID = get_comment_ID();
    $comment = get_comment($comment_ID);
    if ($comment->comment_parent ) {
        $parent_comment = get_comment($comment->comment_parent);
        $comment_text = '<a href="#comment-' . $comment->comment_parent . '" rel="nofollow" class="cute">@'.$parent_comment->comment_author.'</a> ' . $comment_text;
    }
    return $comment_text;
}
/**
功能说明:评论构造
更新时间：2016-11-11
**/
function comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
            ?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p>Pingback: <?php comment_author_link(); ?> </p>
            <?php
            break;
        default :
            global $post;
            ?>     
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?> itemtype="http://schema.org/Comment" itemscope="" itemprop="comment">
			    <div class="io-comment">
				    <div class="io-comment_info">
					    <div style="background-image: url(<?php echo lb_get_avatar($comment->user_id);?>)" class="io-comment_author__thumb"></div>
					</div>
					<div class="io-comment_content">
					    <div class="io-comment_author__name"><?php echo get_comment_author_link(); ?></div>
						<div class="io-comment_meta">
						    <div class="io-comment_meta__date"> <a><?php echo barley_time_since(strtotime($comment->comment_date_gmt), true ); ?></a></div>
							<div class="io-comment_meta__reply">
							    <?php comment_reply_link( array_merge( $args, array('depth'      => $depth,'max_depth'  => $args['max_depth'],'reply_text' => '回复','login_text' => '登录回复') ) ) ?>
							</div>
						</div>
						<?php comment_text(); ?>
					</div>
				</div>
            <?php
            break;
    endswitch;
}
//时间以ago显示
function barley_time_since( $older_date, $comment_date = false ) {
	$chunks = array(
		array( 24 * 60 * 60,' Day Ago' ),
		array( 60 * 60, ' Hour Ago'),
		array( 60, ' Minute Ago' ),
		array( 1,' Second Ago')
	);
	$newer_date = time();
	$since      = abs( $newer_date - $older_date );
	if ( $since < 30 * 24 * 60 * 60 ) {
		for ( $i = 0, $j = count( $chunks ); $i < $j; $i ++ ) {
			$seconds = $chunks[ $i ][0];
			$name    = $chunks[ $i ][1];
			if ( ( $count = floor( $since / $seconds ) ) != 0 ) {
				break;
			}
		}
		$output = $count . $name;
	} else {
		$output = $comment_date ? date( 'F j, Y', $older_date ) : date( 'F j, Y', $older_date );
	}

	return $output;
}
//头像获取
function lb_get_avatar($uid){
	$photo = get_user_meta($uid, 'photo', true);
	if($photo) return $photo;
	else return get_bloginfo("template_url").'/build/images/avatar.jpg';
}
//替换avatar头像
function barley_get_ssl_avatar($avatar) {
    $avatar = str_replace(array("www.gravatar.com", "0.gravatar.com", "1.gravatar.com", "2.gravatar.com"), "cn.gravatar.com", $avatar);
    return $avatar;
}
add_filter('get_avatar', 'barley_get_ssl_avatar');
/**
功能说明: WordPress缩略图
更新时间：2016-11-11
**/
function barley_is_has_image(){
    global $post;
    if( has_post_thumbnail() ) return true;
    $content = $post->post_content;
    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
    if(!empty($strResult[1])) return true;
    return false;
}
function get_post_thumbnail(){
    global $post;
    if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
        return $timthumb_src[0];
    } else {
        $content = $post->post_content;
        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
        $n = count($strResult[1]);
        if ($n > 0) {
            return $strResult[1][0];
        } else {
            return false;
        }
    }
}
//移除wp比必要的功能
remove_action( 'wp_head',   'rsd_link' ); 
remove_action( 'wp_head',   'wlwmanifest_link' ); 
remove_action( 'wp_head',   'index_rel_link' ); 
remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
remove_action( 'wp_head',   'wp_generator' ); 
remove_action( 'wp_head',   'wp_resource_hints', 2 );
remove_action( 'wp_head',   'feed_links', 2 );
remove_action( 'wp_head',   'feed_links_extra', 3);
remove_action( 'wp_head',   'wp_shortlink_wp_head' );
remove_action( 'wp_head',   'parent_post_rel_link', 10, 0);
remove_action( 'wp_head',   'adjacent_posts_rel_link', 10, 0);
remove_filter( 'the_content', 'wptexturize');
add_filter( 'show_admin_bar', '__return_false' );
add_filter( 'wp_revisions_to_keep', 'specs_wp_revisions_to_keep', 10, 2 );
function specs_wp_revisions_to_keep( $num, $post ) {
    return 0;
}
function my_enqueue_scripts() {
	wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts', 1 );

function remove_open_sans() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans', '');
}
add_action( 'init', 'remove_open_sans' );
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );    
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );  
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
	add_filter( 'widget_text', 'do_shortcode' );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
}
add_filter( 'the_content', 'pre_content_filter', 0 );
function pre_content_filter( $content ) {
    return preg_replace_callback( '|<pre.*>(.*)</pre|isU' , 'convert_pre_entities', $content );
}
function convert_pre_entities( $matches ) {
    return str_replace( $matches[1], htmlentities( $matches[1] ), $matches[0] );
}
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array() : '';
}

// 去登录界面的默认图片
function custom_loginlogo() {
echo '<style type="text/css">
h1 a {background-image: url(https://hohar.top/img/512.png) !important;background-size: 84px !important;width:84px !important; height:84px !improtant;}
</style>';
}
add_action('login_head', 'custom_loginlogo');
// 去链接
function custom_loginlogo_url($url) {
return'https://hohar.top/'; 
}
add_filter( 'login_headerurl', 'custom_loginlogo_url');
function custom_register_url($url) {
return'https://hohar.top/'; 
}
add_filter( 'login_registerurl', 'custom_register_url');

// 去LOGO的title文字
function custom_headertitle ( $title ) {
return __( '呼哈' );
}
add_filter('login_headertitle','custom_headertitle');

// 去神奇的bar
add_filter( 'show_admin_bar', '__return_false' );
 
function sp_hide_admin_bar_settings()
{
    ?><style type="text/css">.show-admin-bar {display: none;}</style><?php
}
 
function sp_disable_admin_bar()
{
    add_filter( 'show_admin_bar', '__return_false' );
    add_action( 'admin_print_scripts-profile.php', 'sp_hide_admin_bar_settings' );
}
add_action( 'init', 'sp_disable_admin_bar' , 9 );

// Remove Dashboard Widgets
 
function disable_default_dashboard_widgets()
{
    // disable default dashboard widgets
    remove_meta_box('dashboard_right_now', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
    remove_meta_box('dashboard_plugins', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
    remove_meta_box('dashboard_primary', 'dashboard', 'core');
    remove_meta_box('dashboard_secondary', 'dashboard', 'core');
    remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal;');
    remove_meta_box('blc_dashboard_widget', 'dashboard', 'normal;');
    remove_meta_box('powerpress_dashboard_news', 'dashboard', 'normal;');
    // disable Simple:Press dashboard widget
    remove_meta_box('sf_announce', 'dashboard', 'normal');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');
// 屏蔽后台左上 LOGO
 
	function annointed_admin_bar_remove() {
 
    global $wp_admin_bar;
 
    /* Remove their stuff */
 
    $wp_admin_bar->remove_menu('wp-logo');
 
    }
 
    add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
 
// 屏蔽后台页脚版本信息
 function change_footer_admin () {return '';}
 
    add_filter('admin_footer_text', 'change_footer_admin', 9999);
 
    function change_footer_version() {return '';}
 
    add_filter( 'update_footer', 'change_footer_version', 9999);
 
 
//屏蔽 WP 后台“显示选项”和“帮助”选项卡
 function remove_screen_options(){ return false;}
 
    add_filter('screen_options_show_screen', 'remove_screen_options');
 
    add_filter( 'contextual_help', 'wpse50723_remove_help', 999, 3 );
 
    function wpse50723_remove_help($old_help, $screen_id, $screen){
 
    $screen->remove_help_tabs();
 
    return $old_help;
 
}

function nospace($str){
$oldchar=array(" ","　","\t","\n","\r");
$newchar=array("","","","","");
return str_replace($oldchar,$newchar,$str);
}

/* rest-api */
add_action( 'rest_api_init', 'wp_rest_insert_tag_links' );

function wp_rest_insert_tag_links(){

    register_rest_field( 'post',
        'post_categories',
        array(
            'get_callback'    => 'wp_rest_get_categories_links',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'post',
        'post_excerpt',
        array(
            'get_callback'    => 'wp_rest_get_plain_excerpt',
            'update_callback' => null,
            'schema'          => null,
        )
    );
    register_rest_field( 'post', 
        'post_img', 
        array(
            'get_callback' => 'get_post_img_for_api',
            'update_callback' => null,
            'schema' => null,
        )
    );
    register_rest_field( 'post', 
        'post_metas', 
        array(
            'get_callback' => 'get_post_meta_for_api',
            'update_callback' => null,
            'schema' => null,
        )
    );
}

function wp_rest_get_categories_links($post){
    $post_categories = array();
    $categories = wp_get_post_terms( $post['id'], 'category', array('fields'=>'all') );

foreach ($categories as $term) {
    $term_link = get_term_link($term);
    if ( is_wp_error( $term_link ) ) {
        continue;
    }
    $post_categories[] = array('term_id'=>$term->term_id, 'name'=>$term->name, 'link'=>$term_link);
}
    return $post_categories;

}
function wp_rest_get_plain_excerpt($post){
    $excerpts = array();
    $excerpts['nine'] = wp_trim_words(get_the_excerpt($post['id']), 90);
    $excerpts['four'] = wp_trim_words(get_the_excerpt($post['id']), 45);
    return $excerpts;
}
function get_post_meta_for_api($post){
    $post_meta = get_post_meta($post['id']);
    return $post_meta;
}

function get_post_img_for_api($post){
    $post_img = array();
    $post_img['url'] = get_the_post_thumbnail_url($post['id']);
    return $post_img;
}
/* rest-api */
