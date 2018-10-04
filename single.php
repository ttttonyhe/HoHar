<?php get_header();?>
<div id="wrapper" class="io-page_wrapper">
	<?php while (have_posts()) : the_post(); ?>
  <article id="single" class="io-single_article">
    <div class="io-single_top">
			<div alt="<?php the_title(); ?>" style="background-image: url(<?php $getThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()),full);echo $getThumbnail[0];?>);" class="single-banner"></div><br/>
      <h2 class="io-single_article__title"><?php the_title(); ?></h2>
      <div class="io-single_article__date">收录于 <?php $the_post_category = get_the_category(get_the_ID()); echo $the_post_category[0]->cat_name; ?> | <span>发布于<?php the_modified_date('F j, Y'); ?></span>  |  <?php if(function_exists('the_views')) { the_views(); } ?>人看过</div>
     
    </div>
    <div class="io-single_middle">
      <div class="container-fluid">
        <div class="io-single__content">
          <?php the_content(); ?>
        </div><hr><h4 align="right">
		  小哥哥小姐姐，点个赞吗？<br><br> 赞 <?php wp_postlike();?>　</h4>
      </div>
    </div>
  </article>
  <?php endwhile;?>
  <?php echo barley_related_posts();?>
  <section class="io-comment_section">
    <div class="container-fluid">
      <h2 class="io-comment_section__title">有趣的灵魂 百里挑一</h2>
      <?php
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;
      ?>
    </div>
  </section>
<?php get_footer();?>
