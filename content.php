
    <article class="io-article article_large list-article">
    <div class="list-article-img" style="background-image:url(<?php echo get_post_thumbnail();?>)"></div>
    <div class="list-article-info">
        <p class="list-article-info-p">收录于 <b style="color: #bf9a62;"><?php $the_post_category = get_the_category(get_the_ID()); echo $the_post_category[0]->cat_name; ?></b> | <b style="color: #444;"><?php if(function_exists('the_views')) { the_views(); } ?>次</b> 浏览</p>
        <a href="<?php the_permalink(); ?>">
            <h2 class="list-article-info-h2"><?php the_title(); ?></h2>
            <p class="list-article-info-p-1"><?php echo wp_trim_words(get_the_excerpt(), 45); ?></p>
        </a>
    </div>
    </article>