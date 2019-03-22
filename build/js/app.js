$(document).ready(function(){
  "use strict";
  $(window).on("load", function () {
      $('.ps_spinner').fadeOut();
      $('.ps_preloader').delay(300).fadeOut(250);
  });

  menuToggle();
  subMenuToggle();
  searchToggle();  
  smoothScroll();  

});

function menuToggle(){
  $('.io-sidebar_content').on('click', function(e){
    e.stopPropagation();
  });

  $('.io-sidebar_trigger, #off-sidebar').on("click", function () {
    $('html').toggleClass('nav_opened');
  });
}

function subMenuToggle(){

  $('li.menu-item-has-children').on("click", function () {
    $(this).children('.sub-menu').slideToggle(250);
  });

}

function searchToggle(){
  $('.search-box').on('click', function(e){
    e.stopPropagation();
  });

  $('.io-search_box, .search-flex_centered').on("click", function () {
    $('.search_container').slideToggle(150);
    $('.search-box').slideToggle(250);
  });

}

function flexSlider(){

  $('.flexslider').flexslider({
    animation: "slide"
  });

}

function smoothScroll() {

  $('a.scroll_to__section').on("click", function (e) {
      var anchor = $(this);
      
      $('html, body').stop().animate({
          scrollTop: $(anchor.attr('href')).offset().top
      }, 1000);
      
      e.preventDefault();
  });

}
//无限加载
jQuery(document).on("click", "#fa-loadmore", function() {
	var _self = jQuery(this),
		_postlistWrap = jQuery('.blog-posts'),
		_button = jQuery('#fa-loadmore'),
		_data = _self.data();
	if (_self.hasClass('is-loading')) {
		return false
	} else {
		_button.html('加载中');
		_self.addClass('is-loading');
		jQuery.ajax({
			url: PURE.ajax_url,
			data: _data,
			type: 'post',
			dataType: 'json',
			success: function(data) {
				if (data.code == 500) {
					_button.data("paged", data.next).html('加载更多');
					alert('服务器正在努力找回自我  o(∩_∩)o')
				} else if (data.code == 200) {
					_postlistWrap.append(data.postlist);
					if (data.next) {
						_button.data("paged", data.next).html('加载更多')
					} else {
						_button.remove()
					}
				}
				_self.removeClass('is-loading')
			}
		})
	}
});



