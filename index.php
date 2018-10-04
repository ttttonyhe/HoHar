<?php get_header();?>
<div id="wrapper" class="io-page_wrapper">
   <div id="content" class="io-main_content">    
    <div class="container-fluid">
      <div class="row">
<div class="col-md-1" style="width:4.55%"></div>
        <div class="col-md-11">

<?php 
		$args = array(
		    'showposts'=> 1,
			'post__in' => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1
		);
		$top_posts = new WP_Query($args);
		if($top_posts->have_posts()):
		while($top_posts->have_posts()):$top_posts->the_post();?>
            
<div style="margin-top: 5%;height: 400px;">
    <div style="background-image: url(<?php $full_image_url=wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $full_image_url[0]; ?>);" class="top-banner-right-img">
    </div>
    <div class="top-banner-right">
            <p class="top-banner-right-p"><?php $the_post_category = get_the_category(get_the_ID()); echo $the_post_category[0]->cat_name; ?></p>
            <a href="<?php the_permalink(); ?>">
                <h1 class="top-banner-right-h1"><?php echo wp_trim_words(get_the_title(), 20); ?></h1>
            </a>
            <p class="top-banner-right-p-1"><?php echo wp_trim_words(get_the_excerpt(), 45); ?></p>
        <a class="top-banner-right-a" href="<?php the_permalink(); ?>">查看更多 &gt;</a>
    </div>
</div>

<?php endwhile; endif;?>  

<div class="top-banner-bottom top-items-div">
<?php
		$args = array(
		    'offset'=> 1,
		    'showposts'=> 3,
			'post__in' => get_option( 'sticky_posts' ),
			'ignore_sticky_posts' => 1
		);
		$top_posts_sub = new WP_Query($args);
		if($top_posts_sub->have_posts()):
		while($top_posts_sub->have_posts()):$top_posts_sub->the_post(); ?>
    <div class="top-items" style="background-image:url(<?php $full_image_url=wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full'); echo $full_image_url[0]; ?>)">
        <div class="top-items-hover"></div>
        <div class="top-items-info">
        <a href="<?php the_permalink(); ?>"><h3 class="top-items-info-h3"><?php echo wp_trim_words(get_the_title(), 15); ?></h3></a>
        <p class="top-items-info-p"><?php echo nospace(wp_trim_words(get_the_excerpt(), 45)); ?></p>
        <a class="top-items-info-a" href="<?php the_permalink(); ?>">立刻查看</a></div>
    </div>
        
<?php endwhile; endif;?>
</div>        
            

            
          <div class="io-articles_list blog-posts">
			<?php 
			    $args = array(
					'ignore_sticky_posts'=> 1,
					'paged' => $paged
				);
		        query_posts($args);
		        if ( have_posts() ) :
			    while (have_posts()) : the_post();
			        get_template_part( 'content',get_post_format() );
			    endwhile; endif;?>
          </div>
          
          
          
        </div>
      </div>
      <div class="io-load_more__wrapper"><?php the_posts_pagination( array(
										'prev_text'=>'上页',
										'next_text'=>'下页',
										'screen_reader_text' =>'',
										'mid_size' => 1,
									) );?></div>
    </div>
  </div>
  <section id="featured_projects" class="io-featured_projects">
    <div class="container-fluid">
      <h2>特 色 栏 目</h2>
      <div class="io-featured_projects__content">
        <?php foreach (get_categories() as $cat) : ?>
        <div class="io-ft_box">
          <a href="<?php echo get_category_link($cat->term_id); ?>" target="_blank" class="io-ft_project">
            <div style="background-image: url(<?php echo z_taxonomy_image_url($cat->term_id); ?>)" class="io-ft_project__thumb"></div>
            <div class="io-ft_project__name"><?php echo $cat->cat_name; ?></div>
          </a>
        </div>
		<?php endforeach; ?>
      </div>
    </div>
  </section>
<?php get_footer();?>