jQuery(document).ready(function(){
	
	jQuery(document).on('click','.filterBtn', function(){
		if(jQuery('.columnTwoLeft').hasClass("filterBox" )){
			jQuery('.columnTwoLeft').removeClass('filterBox');	
			jQuery('.filterBtn').addClass('active');
		}else{
			jQuery('.columnTwoLeft').addClass('filterBox');	
			jQuery('.filterBtn').removeClass('active');			
		}
	});
	
	jQuery('.mobMenu a').click(function(){
		jQuery(this).parent().parent().toggleClass('activeNav');
	});
	
	jQuery("#back-top").hide();
	
		jQuery('#back-top a').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
		
		if(jQuery('.header1 li.top-level').find('.sub-container')){
		   jQuery('.top-level').addClass('pclass');	
		}
		
		
		var searchOpen = jQuery('#searchIcon.active');
		
			searchOpen.click(function(){
			if(searchOpen.hasClass('active')){
				jQuery('.drop_search').addClass('showSearch');
				searchOpen.removeClass('active');	
			}else{
				jQuery('.drop_search').removeClass('showSearch');
				searchOpen.addClass('active');	
			};
		});
		
		jQuery(document).click(function(e){
		var container = jQuery(".drop_search");
	
			if (
				(!container.is(e.target) && container.has(e.target).length === 0) 
				&& (!jQuery('#searchIcon').is(e.target) && jQuery('#searchIcon').has(e.target).length === 0)    
			){
				container.removeClass('showSearch');
				jQuery('#searchIcon').addClass('active');	
			}
		
		});
		
		
		var wWidth = jQuery(window).width();
	


	
		jQuery('#tpInner').hide();
		jQuery('.tpMenu').click(function(){
		if (jQuery('#tpInner').is(":hidden")){
				jQuery('#tpInner').slideDown("fast");
			} else {
				jQuery('#tpInner').slideUp("fast");
			}
			return false;
		});
		
		jQuery('.old-price').parent().addClass('spBox');
		
		if(jQuery('.price-box').find('.minimal-price-link')){
		   jQuery('.minimal-price-link').parent().addClass('minimalBox');	
		}
			
		
});
	
		
	
	jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('#back-top').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});
	
		
