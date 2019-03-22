<?php get_header();?>
<div id="wrapper" class="io-page_wrapper">
  <div id="content" class="io-main_content io-page_404">
    <div class="container-fluid">
	  <?php if (have_posts()) : ?>
      <div class="row">
        <div>
		  <?php while (have_posts()) : the_post(); ?>
          <article class="io-about_article">
            <div style="padding: 0px 5px 5px 10px">
              <p><?php the_content(); ?></p>
            </div>
          </article>
		  <?php endwhile;?>
        </div>
      </div>
	  <?php endif;?>
    </div>
  </div>
<?php get_footer();?>
