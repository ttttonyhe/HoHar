<?php
function loobo_get_option_labels(){
	$option_group               =   'barley_group';
	$option_name = $option_page =   'barley';
	$field_validate				=	'barley_validate';
	$home = home_url();
	$imagepath =  get_template_directory_uri() . '/build/themestyle/';
    //常规设置
	$general_fields = array(
		'description'	=> array(
		'title'=>'网站描述',	
		'type'=>'textarea',	
		'description'=>''
		),
		
		'keywords'	    => array(
		    'title'=>'关键词',	
			'type'=>'textarea',	
			'description'=>''
		),
			
		'page_sign'	    => array(
		'title'=>'标题链接符号',	
		'type'=>'select',	
		'description'=>'选择后切勿更改,对SEO不友好',
			'options'=>array(
				'中横线- '=>'-',
			    '下划线_'=>'_'
				)
		)
	);
    //外观设置
	$skin_fields = array(
		'favicon'	=> array(
		'title'=>'网站Favicon图标',	
	    'type'=>'image',	
		'description'=>''
		),
		'logo'	=> array(
		'title'=>'高清Logo',	
		'type'=>'image',	
		'description'=>'像素大小为76px * 76px'
		),
		'theme-jquery'	=> array(
		'title'=>'jQuery库',	
		'type'=>'text',	
		'description'=>'可以使用第三方CDN或者自己的CDN'
		)
	);
    //邮箱设置
	$mail_fields = array(
	    'smtp_name'	=> array(
		'title'=>'发信人名称',	
	    'type'=>'text',	
		'description'=>''
		),
		'smtp_account'	=> array(
		'title'=>'邮箱账户',	
	    'type'=>'text',	
		'description'=>''
		),
		'smtp_pass'	=> array(
		'title'=>'密码',	
	    'type'=>'password',	
		'description'=>''
		),
		'smtp_host'	=> array(
		'title'=>'smtp服务器',	
	    'type'=>'text',	
		'description'=>''
		)
	);
	//第三方登录设置
	$social_fields = array(
		'qq'	=> array(
		    'title'=>'qq号码',	
			'type'=>'text',	
			'description'=>''
		),
		'weibo'	=> array(
		    'title'=>'微博主页',	
			'type'=>'text',	
			'description'=>'https://weibo.com/5080890941'
		),
		'weixin'	=> array(
		    'title'=>'微信二维码',	
			'type'=>'image',	
			'description'=>''
		),
		'github'	=> array(
		    'title'=>'Github主页',	
			'type'=>'text',	
			'description'=>''
		)
	);
	$sections = array( 
    	'skin'		=>array('title'=>'',		'fields'=>$skin_fields,	    'callback'=>'',	),
    	'general'	=>array('title'=>'',		'fields'=>$general_fields,	    'callback'=>'',	),
		'mail'		=>array('title'=>'',		'fields'=>$mail_fields,	    'callback'=>'',	),
    	'social'	=>array('title'=>'',	    'fields'=>$social_fields,	'callback'=>'',	),
	);

	return compact('option_group','option_name','option_page','sections','field_validate');
}
function loobo_option_defaults(){
	$name = get_bloginfo('name');
	$defaults = array(
			'description'	    =>	'简洁式博客主题',
			'keyword'	        =>	'wordpress主题,wordpress站点,主题笔记',
			'page_sign'		    =>	'_',
			'favicon'		    =>	'',
			'themelogo'		    =>	'',
			'theme-jquery'		=>	'',
			'smtp_name'         =>	'主题笔记',
			'smtp_account'      =>	'100041385@qq.com',
			'smtp_pass'         =>	'',
			'smtp_host'         =>	'smtp.qq.com',
			'qq'		        =>	'100041385',
			'weibo'			    =>	'https://weibo.com/5080890941',
			'weixin'		    =>	'',
			'github'			=>	'https://github.com/themenote'
		);
	return $defaults;
}
?>