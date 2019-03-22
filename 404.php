<?php get_header();?>
<div id="wrapper" class="io-page_wrapper">
  <div id="content" class="io-main_content io-page_404">
    <div class="container-fluid">
      <div class="row">
        <?php echo social_list();?>
        <div class="col-md-11">
          <div class="io-page_404__content">
            <div class="io-page_404__text">
              <div class="number404">404</div>
              <div class="pageNotFound">page not found</div>
              <div class="large404">您访问的页面不可用或不存在 :(</div>
              <div class="small404">返回首页 <a href="<?php echo home_url(); ?>">home page</a></div>
            </div>
          </div>
          <!-- 404 Content End  -->
        </div>
      </div>
    </div>
  </div>
<?php get_footer();?>