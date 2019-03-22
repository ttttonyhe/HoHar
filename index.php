<?php get_header();?>
<div id="wrapper" class="io-page_wrapper">
   <div id="content" class="io-main_content" style="opacity:0">
    <div class="container-fluid">
      <div class="row">
<div class="col-md-1" style="width:4.55%"></div>
        <div class="col-md-11">

<?php if(!$paged){ ?>
<?php if(!wp_is_mobile()){ ?>
<div style="display:flex">
    <?php } ?>
<template>
  <el-carousel :interval="4000" arrow="always" :style="'<?php if(!wp_is_mobile()){ ?>width: 65.3%;<?php } ?>margin-top:4%;border-radius:5px;'+border()" v-loading="loading" indicator-position="outside" >
    <el-carousel-item v-for="post in posts" :style="'background-image:url('+ post.post_img.url +')'" class="banner-item" :onclick="'location.href=\''+post.link+'\''">
    </el-carousel-item>
  </el-carousel>
  <?php if(!wp_is_mobile()){ ?>
  <el-card class="box-card" style="width: 32%;margin-left: 2.7%;height: 300px;margin-top: 4%;border-radius:4px" shadow="hover" v-loading="loading">
  <div slot="header" class="clearfix">
    <span style="font-size: 2rem;line-height: normal;font-weight: 600;letter-spacing: .3rem;"><?php echo date('Y').'/'.date('m').'/'.date('d') ?></span>
    <el-button style="float: right;font-size: 1.4rem;font-weight: 300;border: 1px solid;padding: 5px 8px;margin-top: 1px;" type="text"><a style="color:inherit" @click="daily">查看详情</a></el-button>
  </div>
    <div style="width: 115%;margin-left: -20px;margin-top: -20px;height: 240px;background: url(&quot;https://uploadbeta.com/api/pictures/random/?key=BingEverydayWallpaperPicture&quot;);background-position: center;background-size: cover;background-repeat: no-repeat;"></div> <div style="margin-left: 0px;margin-top: -180px;background: linear-gradient( 0deg, #333333db 10%, #3333339e 100%);padding: 20px 17px;border-radius: 4px;"><em style="font-style: normal; margin: 0px; color: rgb(255, 255, 255); border: 1px solid rgb(255, 255, 255); border-radius: 4px; padding: 3px 10px;">呼哈 · 日签</em> <h3 style="font-size: 2rem;margin: 12px 0px 0px;color: rgb(255, 255, 255);font-weight: 400;line-height: 1.2;">{{ one_saying }}</h3></div>
</el-card>
<?php } ?>

<style>
  .text {
    font-size: 14px;
  }

  .item {
    margin-bottom: 18px;
  }

  .clearfix:before,
  .clearfix:after {
    display: table;
    content: "";
  }
  .clearfix:after {
    clear: both
  }

  .box-card {
    width: 480px;
  }
</style>

</template>
</div>

<style>
  .el-carousel__item h3 {
    color: #475669;
    font-size: 18px;
    opacity: 0.75;
    line-height: 300px;
    margin: 0;
  }
  
  .el-carousel__item:nth-child(2n) {
    background-color: #99a9bf;
  }
  
  .el-carousel__item:nth-child(2n+1) {
    background-color: #d3dce6;
  }
</style>
<?php if(wp_is_mobile()){ ?>
<el-row style="margin-left: 2px;margin-top: 10px;">
  <?php foreach (get_categories(array('orderby'=>'name','order'=>'DESC')) as $cat) : ?>
      <el-col :span="12" style="padding-right:2px;margin:2px 0px;">
          <div class="grid-content bg-purple" style="text-align: center;border: 1px solid #eee;padding: 7px 10px;border-radius:4px">
                <a href="<?php echo get_category_link($cat->term_id); ?>" style="font-size: 1.7rem;color: #9E9E9E;font-weight: 300;">
                    <img style="width: 25px;margin-top: -2px;margin-right: 3px;border-radius: 50%;border:1px solid #eee" src="<?php echo z_taxonomy_image_url($cat->term_id); ?>"> <?php echo $cat->cat_name; ?>
                </a>
          </div>
      </el-col>
  <?php endforeach;  ?>
</el-row>

<style>
  .el-row {
    margin-bottom: 20px;
    &:last-child {
      margin-bottom: 0;
    }
  }
  .el-col {
    border-radius: 4px;
  }
  .bg-purple-dark {
    background: #99a9bf;
  }
  .bg-purple {
    background: #d3dce6;
  }
  .bg-purple-light {
    background: #e5e9f2;
  }
  .grid-content {
    border-radius: 4px;
    min-height: 36px;
  }
  .row-bg {
    padding: 10px 0;
    background-color: #f9fafc;
  }
</style>
<?php } ?>
<?php } ?>

<div class="top-banner-bottom top-items-div" <?php if($paged){ ?>v-loading="loading" style="margin-top:10%"<?php } ?>>
<el-row v-for="(sub, index) in subs">
  <el-col>
    <el-card :body-style="{ padding: '0px' }" shadow="hover">
      <img :src="sub.post_img.url" style="height:150px;width:100%">
      <div style="padding: 14px 14px 6px 14px;">
        <a :href="sub.link" style="font-size: 1.9rem;font-weight: 500;letter-spacing: .5px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin: 0px;width: 100%;color: #333;" v-html="sub.title.rendered"></a>
        <div style="margin-top: 2px;">
          <p v-html="sub.post_excerpt.four" style="color: #999;font-weight: 300;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"></p>
        </div>
      </div>
    </el-card>
  </el-col>
</el-row>
</div>        
            
            
          <div class="io-articles_list blog-posts" <?php if($paged){ ?> style="margin-top:1%" <?php } ?>>
              <article class="io-article article_large list-article" v-for="list in lists">
    <div class="list-article-img" :style="'background-image:url('+list.post_img.url+')'"></div>
    <div class="list-article-info">
        <p class="list-article-info-p">收录于 <b style="color: #bf9a62;">{{ list.post_categories[0].name }}</b> | <b style="color: #444;">{{ list.post_metas.views[0] }} 次</b> 浏览</p>
        <a :href="list.link">
            <h2 class="list-article-info-h2" v-html="list.title.rendered"></h2>
            <p class="list-article-info-p-1" v-html="list.post_excerpt.four"></p>
        </a>
    </div>
    </article>
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
  

  <div style="z-index: 50;width: 70px;height: 70px;background: #373737;padding: 10px 0px 10px 12.5px;position: fixed;right: 10%;bottom: 40px;box-shadow: 0px 5px 20px 2px rgba(55, 55, 55, 0.19);text-align: center;border-radius: 50%;"><a href="/qactive" style="color: #fff;margin-left: -10px;"><img src="https://hohar.top/img/+.png" style="width: 45px;height: 45px;margin-top: 2px;"></a></div>

<script>
window.onload = function(){
    
    $('#content').css('opacity','1');
    
    var banner = new Vue({
        el:'#content',
        data(){
            return {
                loading : true,
                posts: null,
                subs : null,
                lists : null,
                one_saying : null
            }
        },
        mounted(){
            <?php if(!$paged){ ?>
                axios.get('https://hohar.top/wp-json/wp/v2/posts?categories=3')
                .then(response => {
                    this.posts = response.data;
                });
                
                axios.get('https://v1.hitokoto.cn/?c=f')
                .then(response => {
                    this.one_saying = response.data.hitokoto;
                })
                
                axios.get('https://hohar.top/wp-json/wp/v2/posts?per_page=3&categories_exclude=3')
                .then(response => {
                    this.subs = response.data;
                });
                
                axios.get('https://hohar.top/wp-json/wp/v2/posts?per_page=10&categories_exclude=3&offset=3')
                .then(response => {
                    this.lists = response.data;
                    this.loading = false;
                })
            <?php }else{ ?>
            
                axios.get('https://hohar.top/wp-json/wp/v2/posts?per_page=3&categories_exclude=3')
                .then(response => {
                    this.subs = response.data;
                });
                
                axios.get('https://hohar.top/wp-json/wp/v2/posts?per_page=10&categories_exclude=3&page=<?php echo $paged; ?>')
                .then(response => {
                    this.lists = response.data;
                    this.loading = false;
                })
                
            <?php } ?>
        },
        methods : {
            border : function(){
                if(this.loading){
                    return 'border:1px solid #eee';
                }else{
                    return '';
                }
            },
            daily : function(){
                this.$alert('<img style="border-radius:4px" src="https://uploadbeta.com/api/pictures/random/?key=BingEverydayWallpaperPicture"><p style="margin-top:10px;color:#999">&copy; 图片来自必应，文字来自一言</p>', '随机图片', {
                    dangerouslyUseHTMLString: true
                });
            }
        }
    })
}
</script>

<?php get_footer();?>