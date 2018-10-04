<!DOCTYPE html>
<html>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php 

         if (is_home()||is_search()) { bloginfo('name'); } 

         else{wp_title(''); echo ' | '; bloginfo('name');} 

    ?> </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body>
<div class="ps_preloader">
  <div class="spinner">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
  </div>
</div>
<?php if ( is_single() ){?>
<?php echo barley_next_posts();?>
<?php } else {  
if(!$_GET['zeo']){
?>
<header class="io-main_header box_shadow">
  <div class="container-fluid header_container">
    <div class="io-sidebar_trigger"><i class="fa fa-bars"></i></div>
    <div class="io-main_logo">
      <a href="<?php echo home_url(); ?>"><img src="https://hohar.top/img/logo.png" alt="H">HoHar</a>
    </div>
    <div style="width: 25%;text-align: right;"><a href="/login" style="color:#000000"><i class="fa fa-bell"></i></a></div>
  </div>
</header>
<aside id="off-sidebar" class="io-nav_sidebar">
  <div class="io-sidebar_content">
    <div class="io-sidebar_trigger"><i class="fa fa-times"></i></div>
    <nav class="io-main_nav">
	  <?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class'=>'io-nav_list','container'=>'ul')); ?>
    </nav>
  </div>
</aside>
<div class="search_container" style="display: none;">
  <div class="search-flex_centered">
    <div class="search-box" style="display: none;">
      <div class="search-box_input">
        <input type="text" placeholder="搜索文章">
      </div>
      <div style="width: 25%;text-align: right;">
        <button><i class="fa fa-search"></i></button>
      </div>
    </div>
  </div>
</div>
<?php }else{ ?>
<div id="header" class=" navbar-fixed-top" style="height: 70px;">
	<div class="container">
		<h1 class="logo" style="">
			<a href="https://www.zeo.im" title="Zeo小半" style=";background-image: url(https://static.zeo.im/wp-content/uploads/2018/01/2018012515030749.png);">
            <img src="https://static.ouorz.com/hat.svg" style="position:  relative;left: 65px;top: -70px;height: 15px;width: 30px;
">
			</a>
		</h1>
				<div role="navigation" class="site-nav  primary-menu">
			<div class="menu-fix-box">
				 <ul id="menu-navigation" class="menu">
				    <li><a href="https://www.zeo.im"><i class="icon-home-2"></i> Home</a></li>
                    <li><a href="https://www.zeo.im/capture">Capture</a></li>
                    <li class="current-menu-item"><a href="https://hohar.top/?zeo=1">HoHar</a></li>
                    <li><a href="https://www.zeo.im/topics">Topics</a></li>
</ul>		</div>
		</div>

			</div>
</div>
<?php }} ?>