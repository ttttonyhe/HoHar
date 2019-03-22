<?php
defined('ABSPATH') or die('This file can not be loaded directly.');
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area clearfix">
	<?php
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments">评论已经被关闭</p>
	<?php endif;?>
	<?php if ( have_comments() ) : ?>
	<div class="io-comment_list">
        <ol class="commentlist comment-list">
			<?php
				wp_list_comments( array(
				    'callback'    =>'comment',
					'avatar_size' => 40,
					'style'       => 'ol',
					'short_ping'  => true,
					'reply_text'  => 'Reply',
				) );
			?>
		</ol>
    </div>
	<?php endif; ?>	
	<div id="respond" class="respond io-comment_form" role="form">
	<h3>灵魂对碰</h3><a name="comment"></a>
	<form class="comment-form io-contact_form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" novalidate="novalidate">
        <div class="io-row">
<div><p align="right">参与话题讨论，请先<a href="/login" title="登录" style="color:rgb(191, 154, 98);">登录</a></p>
</div>
            <div class="col col--12-of-12 io-form__group">
              <textarea id="comment-content" name="comment" id="text_message" required="required" class="form_input" placeholder="评论内容"></textarea>
            </div>
            <div class="col col--12-of-12 io-form__group">
              <input name="submit" type="submit" id="submit" value="Send" class="form_submit io-btn">
			  <span id="cancel-comment-reply"><?php cancel_comment_reply_link() ?></span>
            </div>
         </div> 
        <?php comment_id_fields(); ?>
        <?php do_action('comment_form', $post->ID); ?>
    </form>
	</div>
</div>