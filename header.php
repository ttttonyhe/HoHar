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
  <script type="text/javascript" src="https://static.ouorz.com/vue.min.js"></script>
  <script type="text/javascript" src="https://static.ouorz.com/axios.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
  <script src="https://unpkg.com/element-ui/lib/index.js"></script>
  <?php wp_head(); ?>
</head>
<body>

<?php if ( is_single() ){?>
<?php echo barley_next_posts();?>
<?php } else { 
?>
<header class="io-main_header box_shadow">
  <div class="container-fluid header_container">
    <div class="io-sidebar_trigger"><i class="fa fa-bars"></i></div>
    <div class="io-main_logo" style="padding-top: 3px;height: 49px;">
      <a href="https://hohar.top" style="font-size: 2rem;line-height: 20px;"><img src="https://hohar.top/wp-content/themes/peg/build/images/logo.png" alt="">HoHar</a>
    </div>
    <div style="width: 25%;text-align: right;"><a href="/login" style="color:#000000"><i class="fa fa-user"></i></a></div>
  </div>
  <?php if(!wp_is_mobile()){ ?>
  <div class="cap-nav">
    <div class="uk-container">
      <div class="cap-nav-right">
        <ul class="nav">
          <li>
              <a class="cap-nav-a" href="https://hohar.top" style="border-left: 1px solid #eee;">
                首页
                </a>          
          </li>
          <?php foreach (get_categories() as $cat) : ?>
        <li>
              <a class="cap-nav-a" href="<?php echo get_category_link($cat->term_id); ?>">
                <img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>"> <?php echo $cat->cat_name; ?>
                </a>          
          </li>
		<?php endforeach; ?>
                  </ul>
      </div>
      
    </div>
  </div>
  <?php } ?>
</header>
<aside id="off-sidebar" class="io-nav_sidebar">
  <div class="io-sidebar_content">
    <div class="io-sidebar_trigger"><i class="fa fa-times"></i></div>
    <nav class="io-main_nav">
	  <?php wp_nav_menu( array( 'theme_location' => 'primary','menu_class'=>'io-nav_list','container'=>'ul')); ?>
	  <hr>
	  <ul class="io-nav_list">
	  <?php 
	      if(wp_is_mobile()){
	      foreach (get_categories() as $cat) : ?>
        <li>
              <a href="<?php echo get_category_link($cat->term_id); ?>">
                <?php echo $cat->cat_name; ?>
                </a>          
          </li>
		<?php endforeach; } ?>
		</ul>
    </nav>
  </div>
</aside>

<?php } ?>