<?php get_header();?>
<style>
.layer{
    background: 
    <?php if(in_category('award')){ ?>
        #bf9b62
    <?php }elseif(in_category('kejiyuanzhuo')){ ?>
        #2b2e2f
    <?php }elseif(in_category('robot')){ ?>
        #f1898d
    <?php }elseif(in_category('news')){ ?>
        #97c9bd
    <?php }elseif(in_category('全攻略')){ ?>
        #68709f
    <?php } ?>
}
</style>
<div id="wrapper" class="io-page_wrapper">
  <section class="channel-wrap" style="position: relative;">
<section class="channel-box">
<section class="channel-info">
    <div class="channel-div">
<section class="channel-cover">
<section class="channel-img">
<img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>" class="img" alt="<?php single_cat_title();?>">
</section>
</section>
<section class="info">
<p class="channel-tag-name">呼哈栏目</p>
<p class="channel-name"><?php single_cat_title();?></p>
<p class="channel-desc">为您呈上呼哈打造的专属栏目</p>
</section>
    </div>
</section>
</section>
<section class="layer"></section>
</section>

  <div id="content" class="io-main_content" style="margin-top:-110px">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-11" style="width: 90%;margin-left: 5%;">
          <div class="io-articles_list">
			<?php while (have_posts()) : the_post();
			    get_template_part( 'content',get_post_format() );
		    endwhile;?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <section id="featured_projects" class="io-featured_projects">
    <div class="container-fluid">
      <h2>看看别的栏目</h2>
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
      <div class="row">
        <div class="col-md-12">
        </div>
      </div>
    </div>
  </section>
<?php get_footer();?>