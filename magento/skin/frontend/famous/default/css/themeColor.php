<?php
	define('MAGENTO_ROOT', (dirname(__FILE__).'../../../../../../'));
	$mageFilename = MAGENTO_ROOT . '/app/Mage.php';
	require_once $mageFilename;
	umask(0);
	Mage::app();
	
	header("Content-type: text/css; charset: UTF-8");
	$CurrentStoreId =Mage::app()->getRequest()->getParam('p');
	$config = Mage::getStoreConfig('mdloption',$CurrentStoreId);
	$color_helper = Mage::helper('mdloption/color');
?>

<?php if($config['genral_theme_setting']['enable_font'] ) : ?>
html body, body input, body select, body textarea, h1, h2, h3, h4, h5, h6{font-family:"<?php echo $config['genral_theme_setting']['font']; ?>"} 
<?php endif; ?>

<?php if ( $config['genral_theme_setting']['font_size']):?>
body, input, select, textarea{font-size:<?php echo $config['genral_theme_setting']['font_size']; ?>px;}
<?php endif;?>


/*color-settings*/
<?php
	$config = Mage::getStoreConfig('mdloptioncolor',$CurrentStoreId);
	$color_helper = Mage::helper('mdloptioncolor/color');
?>

	<?php if($config['genral_theme_setting']['body_bg_color']):?>
		body{
			background-color:<?php echo $config['genral_theme_setting']['body_bg_color']; ?>;
		}
    <?php endif;?>
    
	<?php if($config['genral_theme_setting']['color']):?>
	.cms-index-index.header1 ul#nav li.home.level0 > a, 
	.header1 ul#nav li.level0.active > a,
	.header-top,
	.classy a, .ancomp,
	.header1 .fixit .fixNavBox:after,
	.box-title h2:before, .box-title h2:after,
	.ui-rangeSlider-label,
	button.button span, .button, .axcart,
	.cms-index-index.header1 .bannerType1 .fixit ul#nav li.home.level0 > a, 
	.header1 .bannerType1 .fixit ul#nav li.level0.active > a,
	.header2 .navMain, 
	.header2 .nav-container,
	.header2 .fixit .fixNavBox:before,
	.header3 .bannerType1 .fixit .classy a, 
	.header3 .bannerType1 .fixit .ancomp,
	.header5 .bannerType1 .fixit .classy a,
	.header5 .classy a,
	.header6 .bannerType1 .fixit .classy a,
	#triggerPop:hover,
	.header-block:before,
	.direction,
	.thirdView a.add-cart, 
	.thirdView .add-cart,
	.actionBox,
	.qlinks .w-btn:hover,
	.pro-static-block li div,
	.products-grid .firstView .price-box:before,
	#nextslide:hover, #prevslide:hover,
	.header3 .bannerType1 .fixit .classy a, 
	.header3 .bannerType1 .fixit .ancomp, 
	.header4 .bannerType1 .fixit .classy a, 
	.header4 .bannerType1 .fixit .ancomp, 
	.header4 .bannerType1 .fixit .ctsClose span, 
	.header5 .bannerType1 .fixit .classy a,
	.ctsClose span,
	.highlighter-content:before,
	.actions.mdl_layered_clear_all:hover, 
	.actions.mdl_layered_clear_all:hover a
	/*opc*/
	.opc-wrapper-opc .opc-login-trigger,
	.review-menu-block a.review-total,
	.opc-wrapper-opc .payment-block dt:hover, 
	.opc-wrapper-opc .payment-block dt.active,
	.opc-wrapper-opc .payment-block dl, 
	.opc-wrapper-opc .payment-block dt,
	.opc-wrapper-opc .btn-checkout span span,
	.opc-wrapper-opc .btn-checkout span,
	.opc-wrapper-opc .discount-block .button span span
    {
    	background-color:<?php echo $config['genral_theme_setting']['color']; ?>;
    }
    
	.heart,
	.uspBox li .fa,
	.owl-nav .owl-next, .owl-nav .owl-prev,
	.secView .compareBtn,
	.footer4 .msg-block .button-newsletter,
	.proImage .qv-btn,
	.product_left .prev_product, 
	.product_left .next_product,
	.links h3:before,
	.bestselling-title h2 span.active a,
	ul#nav li.level0.active > a,
	.twitter-twets li:before,
	.quickLinks .fa,
	.mainOwlBanner .owl-carousel .owl-nav .owl-next, .mainOwlBanner .owl-carousel .owl-nav .owl-prev,
	.blogItem .bList li,
	.blogItem .bList li span,
	.blogItem .bList li span a,
	ul#nav li.level0:hover > a,
	.add-cart:hover, .link-cart:hover, .w-btn:hover,
	.header1 .bannerType1 .fixit ul#nav li.level0:hover > a,
	.header2 .bannerType1 .fixit ul#nav li.level0:hover > a,
	.header3 .bannerType1 .fixit ul#nav li.level0:hover > a,
	.header4 .bannerType1 .fixit ul#nav li.level0:hover > a,
	.header5 .bannerType1 .fixit ul#nav li.level0:hover > a,
	.header6 .bannerType1 .fixit ul#nav li.level0:hover > a,
	.header7 .bannerType1 .fixit ul#nav li.level0:hover > a,
	/*opc*/
	.discount-block h3:hover .expand_plus, 
	.signature-block h3:hover .expand_plus, 
	.comment-block h3:hover .expand_plus, 
	.giftcard h3:hover .expand_plus, 
	.discount-block h3.open-block .expand_plus, 
	.signature-block h3.open-block .expand_plus, 
	.comment-block h3.open-block .expand_plus, 
	.giftcard h3.open-block .expand_plus,
	.expand_plus,
	.header5 ul#nav li.level0.active > a
    {
    	color:<?php echo $config['genral_theme_setting']['color']; ?>;
    }
    
	.owl-nav .owl-next, .owl-nav .owl-prev,
	.secView .compareBtn,
	.proImage .qv-btn,
	.more-views .owl-nav .owl-next, 
	.more-views .owl-nav .owl-prev, 
	.verSlide a:hover, 
	.box-head h2,
	.bestselling-title h2 span.active,
	.add-cart:hover, .link-cart:hover, .w-btn:hover,
	ul#configurable_swatch_color li.selected a, 
	ul#configurable_swatch_color li:hover a, 
	ul.configurable-swatch-list li.selected a, 
	ul.configurable-swatch-list li:hover a,
	.pager li.current > span,
	.more-view .product-image-thumbs a.active img
    {
    	border-color:<?php echo $config['genral_theme_setting']['color']; ?>;
    }
    
	
	{
   	 border-left-color:<?php echo $config['genral_theme_setting']['color']; ?>;
    }
    
	.ui-rangeSlider-label-inner
    {
   	 border-top-color:<?php echo $config['genral_theme_setting']['color']; ?>;
    }
	.header1 .nav-container
	{
   	 border-bottom-color:<?php echo $config['genral_theme_setting']['color']; ?>;
    }
    
    <?php endif; ?>
    
    
    
    /*body font*/
    <?php if ( $config['genral_theme_setting']['body_font_color'] ) : ?>
    body{color:<?php echo $config['genral_theme_setting']['body_font_color']; ?>;}
    <?php endif; ?>
    
    /*body anchore color*/
    <?php if ( $config['genral_theme_setting']['anchor_color'] ) : ?>
     body a, a{color:<?php echo $config['genral_theme_setting']['anchor_color']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['genral_theme_setting']['anchor_hover'] ) : ?>
    body a:hover, a:hover{color:<?php echo $config['genral_theme_setting']['anchor_hover']; ?>;}
    <?php endif; ?>
    
    /*breadcrumb*/
    <?php if ( $config['genral_theme_setting']['breadcrumbs_anchore'] ) : ?>
    .breadcrumbs li a{color:<?php echo $config['genral_theme_setting']['breadcrumbs_anchore']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['genral_theme_setting']['breadcrumbs_text'] ) : ?>
    .breadcrumbs li strong{color:<?php echo $config['genral_theme_setting']['breadcrumbs_text']; ?>;}
    <?php endif; ?>
    
    /*block heading*/
    <?php if ( $config['genral_theme_setting']['block_heading_color'] ) : ?>
    .page-title h1 span, .block-title strong span, .page-title h2 span, .block-title h2 span,
	.newsletterBox h3
	{color:<?php echo $config['genral_theme_setting']['block_heading_color']; ?>;}
    <?php endif; ?>
    
	
	
    /*new sele*/
    <?php if ( $config['genral_theme_setting']['new_batch'] ) : ?>
	   .badgeBox .new{background-color:<?php echo $config['genral_theme_setting']['new_batch']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['genral_theme_setting']['new_batch_color'] ) : ?>
    .badgeBox .new{color:<?php echo $config['genral_theme_setting']['new_batch_color']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['genral_theme_setting']['sale_batch'] ) : ?>
    .salePrice{background-color:<?php echo $config['genral_theme_setting']['sale_batch']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['genral_theme_setting']['sale_batch_color'] ) : ?>
    .salePrice{color:<?php echo $config['genral_theme_setting']['sale_batch_color']; ?>;}
    <?php endif; ?>




/*Header color*/
	<?php if ( $config['header_color_setting']['header_bg'] ) : ?>
    .header-top{background-color:<?php echo $config['header_color_setting']['header_bg']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['header_color_setting']['header_top_text'] ) : ?>
    .language-switcher label, 
	.header_currency label, 
	.compare_pan label,
	.language-switcher .fa, 
	.header_currency .fa, 
	.compare_pan .fa,
	.header-wrapper03 .links li a,
    .header-container .welcome-msg,
    .header-wrapper01 .header-top .header-social-links li a,
	.header-top .header-compare, 
	.header-top .compare_pan label,
	.language-switcher .select_lang span, 
	.header_currency .currency_pan span,
	.compare_pan span,
	.header-compare a.ancomp, 
	.header2 .links li a,
	.header2 ul#nav li.active.level0 > a,
    .header3 .language-switcher label, 
	.header3 .header_currency label, 
	.header3 .compare_pan label,
    .header3 .language-switcher .select_lang span, 
	.header3 .header_currency .currency_pan span, 
	.header3 .compare_pan span,
	.header3 .language-switcher .fa, 
	.header3 .header_currency .fa, 
	.header3 .compare_pan .fa,
    .header3 .header-compare a.ancomp,
    .header5 .header-top .compare_pan label,
	.header5 .bannerType1 .fixit .select_lang span,
	.header5 .bannerType1 .fixit .currency_pan span,
	.header5 .bannerType1 .fixit .headerMid .compare_pan label,
	.header5 .bannerType1 .fixit .language-switcher .fa.fa-sort-desc, 
	.header5 .bannerType1 .fixit .header_currency .fa.fa-sort-desc, 
	.header5 .bannerType1 .fixit .header-compare .fa.fa-sort-desc,
	.header5 .bannerType1 .fixit .searchIcon .fa-search,
	.bannerType1 .fixit .welcome-msg
    {color:<?php echo $config['header_color_setting']['header_top_text']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['header_color_setting']['header_top_anchore'] ) : ?>
    .topLinks .links li a,
	.language_detail a, 
	.currency_detail a, 
	.compare-content a,
	.header5 .links li a,
	.header5 .bannerType1 .fixit .links li a
    {color:<?php echo $config['header_color_setting']['header_top_anchore']; ?>;}
	.topLinks .links li + li a
	 {border-color:<?php echo $config['header_color_setting']['header_top_anchore']; ?>;}
    <?php endif; ?>
    
    
    <?php if ( $config['header_color_setting']['header_top_anchore_hover'] ) : ?>
    .header-top li a:hover, 
	.header-top a:hover,
	.header5 .bannerType1 .fixit .links li a:hover
	{color:<?php echo $config['header_color_setting']['header_top_anchore_hover']; ?>;}
    <?php endif; ?>
    


/*Navigation color*/
	<?php if ( $config['navsettings']['mainbg'] ) : ?>
		.header1 .nav-container,
		.header2 .nav-container,
		.header4 .header-block,
		.header4 .nav-container,
		.header5 .header-block,
		.header6 .header-block,
		.header6 .nav-container,
		.header2 .fixit .fixNavBox:before
		{background-color:<?php echo $config['navsettings']['mainbg']; ?>;}
	<?php endif; ?>

	<?php if ( $config['navsettings']['mainTextColor'] ) : ?>
    	ul#nav li.level0 > a,
		.bannerType1 .fixit ul#nav li.level0 > a,
		.header2 ul#nav li.level0 > a,
		.header3 .bannerType1 .fixit ul#nav li.level0 > a,
		.header4 .bannerType1 .fixit ul#nav li.level0 > a,
		.header7 .bannerType1 .fixit ul#nav li.level0 > a,
		.header6 .bannerType1 .fixit ul#nav li.level0 > a
		{color:<?php echo $config['navsettings']['mainTextColor']; ?>;}
    <?php endif; ?>
	
	<?php if ( $config['navsettings']['mainTextHoverColor'] ) : ?>
    	ul#nav li.level0 > a:hover,
        ul#nav li.level0.over > a,
		.bannerType1 .fixit ul#nav li.level0 > a:hover,
		.header7 .bannerType1 .fixit ul#nav li.level0 > a:hover 
         {color:<?php echo $config['navsettings']['mainTextHoverColor']; ?>;}
    <?php endif; ?>
	
	<?php if ( $config['navsettings']['activeBgColor'] ) : ?>
	.cms-index-index.header1 ul#nav li.home.level0 > a,
	.header1 ul#nav li.active.home.level0 > a,
	.cms-index-index.header2 ul#nav li.home.level0 > a,
	.header2 ul#nav li.active.level0 > a
	{background-color:<?php echo $config['navsettings']['activeBgColor']; ?>;}
	<?php endif; ?>
	
	<?php if ( $config['navsettings']['activeColor'] ) : ?>
	.cms-index-index ul#nav li.home.level0 > a,
	ul#nav li.level0.active > a,
	.cms-index-index.header4 ul#nav li.home.level0 > a, 
	.cms-index-index.header4 .fixit ul#nav li.home.level0 > a, 
	.header4 ul#nav li.level0.active > a,
	.header5 ul#nav li.level0.active > a,
	.bannerType1 .fixit ul#nav li.active.level0 > a:hover,
	.header7 .bannerType1 .fixit ul#nav li.active.level0 > a,
	.cms-index-index.header7 .bannerType1 .fixit ul#nav li.home.level0 > a,
	.cms-index-index.header2 .bannerType1 .fixit ul#nav li.home.level0 > a,
	.header2 ul#nav li.active.level0 > a,
	.cms-index-index.header3 .bannerType1 .fixit ul#nav li.home.level0 > a,
	.cms-index-index .bannerType1 .fixit ul#nav li.home.level0 > a
	{color:<?php echo $config['navsettings']['activeColor']; ?>;}
	<?php endif; ?>
	
	<?php if ( $config['navsettings']['mainMenuBottom'] ) : ?>
	.header1 .nav-container
	{border-color:<?php echo $config['navsettings']['mainMenuBottom']; ?>;}
	.header1 .fixit .fixNavBox:after
	{background-color:<?php echo $config['navsettings']['mainMenuBottom']; ?>;}	
	<?php endif; ?>
	
    
    <?php if ( $config['navsettings']['manimenubordercolor'] ) : ?>
    	ul#nav li.level0 > a:hover:before, 
		ul#nav li.level0.over > a:before, 
		ul#nav li.level0.active > a:before
        {background-color:<?php echo $config['navsettings']['manimenubordercolor']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettings']['submenubg'] ) : ?>
    	ul#nav li.level0.megamenu > .pump, 
        ul#nav li.level0 > .pump, 
        ul.dmenu ul, 
        ul#nav li.level0 ul.level0 .pump, 
        ul#nav li.level0.megamenu li.level2 .pump, 
        .nav-container ul#nav.level0 ul, .nav-container .level0 .pump,
        ul.dmenu ul ul{background-color:<?php echo $config['navsettings']['submenubg']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettings']['submenubgH'] ) : ?>
    	ul#nav li.level0.megamenu ul.level0 > li > a{color:<?php echo $config['navsettings']['submenubgH']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettings']['submenutext'] ) : ?>
    	ul#nav li.level0 ul.level0 li a{color:<?php echo $config['navsettings']['submenutext']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettings']['submenutexthover'] ) : ?>
    	ul#nav li.level0 ul.level0 li a:hover, 
    	ul#nav li.level0 ul.level0 li.over > a
        {color:<?php echo $config['navsettings']['submenutexthover']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettings']['headerfixbg'] ) : ?>
		.fixit .nav-container,
    	.header1 .fixit .nav-container,
		.header1 .fixit .fixNavBox:before,
		.header2 .fixit .fixNavBox:before,
		.header3 .fixit .header-block,
		.header4 .bannerType1 .fixit .header-block,
		.header7 .fixit .header-block,
		.header7 .bannerType1 .fixit .header-block,
		.header4 .fixit .header-block,
		.header5 .bannerType1 .fixit .header-block,
		.header5 .fixit .header-block,
		.header6 .fixit .header-block,
		.header6 .bannerType1 .fixit .header-block
        {background-color:<?php echo $config['navsettings']['headerfixbg']; ?>;}
    <?php endif; ?>
    


/*Mobile navigation color*/
	<?php if ( $config['navsettingMob']['mainMobbg'] ) : ?>
    	.nav-container .mobMenu h1{background-color:<?php echo $config['navsettingMob']['mainMobbg']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettingMob']['mainMobcolor'] ) : ?>
    	.mobMenu h1 span{color:<?php echo $config['navsettingMob']['mainMobcolor']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettingMob']['buttonscolor'] ) : ?>
    	.nav-container .mobMenu h1 a .fa{color:<?php echo $config['navsettingMob']['buttonscolor']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettingMob']['mainmenuBg'] ) : ?>
    	.mobMenu .accordion li a{background-color:<?php echo $config['navsettingMob']['mainmenuBg']; ?>;}
    <?php endif; ?>
	
	<?php if ( $config['navsettingMob']['mainmenuBghover'] ) : ?>
    	.mobMenu .accordion li a:hover{background-color:<?php echo $config['navsettingMob']['mainmenuBghover']; ?>;}
    <?php endif; ?>
	
	<?php if ( $config['navsettingMob']['sapborder'] ) : ?>
    	.mobMenu .accordion{background-color:<?php echo $config['navsettingMob']['sapborder']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettingMob']['mobMainmenuTextColor'] ) : ?>
    	.mobMenu .accordion li a
        {color:<?php echo $config['navsettingMob']['mobMainmenuTextColor']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['navsettingMob']['mobMainmenuTextHoverColor'] ) : ?>
    	.mobMenu .accordion li.active a,.mobMenu .accordion li a:hover{color:<?php echo $config['navsettingMob']['mobMainmenuTextHoverColor']; ?>;}
    <?php endif; ?>


/*Button color*/
    <?php if ( $config['buttonSetting']['button_color_bg'] ) : ?>
    	button.button span,
        .proImage .qv-btn, .add-cart,
		.add-cart, a.add-cart, .w-btn,
		.thirdView a.add-cart, 
		.thirdView .add-cart,
		.qlinks .w-btn,
		.actionBox
        {background-color:<?php echo $config['buttonSetting']['button_color_bg']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['buttonSetting']['button_text_color'] ) : ?>
    	button.button span,
        .proImage .qv-btn, .add-cart,
		.add-cart, a.add-cart, .w-btn,
		.add-cart .fa, a.add-cart .fa, .w-btn .fa,
		.thirdView a.add-cart, .thirdView .add-cart,
		.lowPanel a.add-cart, .lowPanel .add-cart, .galleryBtn
        {color:<?php echo $config['buttonSetting']['button_text_color']; ?>;}
    <?php endif; ?>

	<?php if ( $config['buttonSetting']['button_border_color'] ) : ?>
    	.add-cart, a.add-cart, .w-btn,
		.secView .add-cart, .secView a.add-cart, .secView .w-btn,
		.lowPanel a.add-cart, .lowPanel .add-cart, .galleryBtn
        {border-color:<?php echo $config['buttonSetting']['button_border_color']; ?>;}
    <?php endif; ?>	
    
    <?php if ( $config['buttonSetting']['button_hover_bg'] ) : ?>
    	button.button:hover span,
        .proImage .qv-btn:hover, .add-cart:hover,
		.w-btn:hover, .w-btn:hover .fa,
		.secView .add-cart:hover, .secView a.add-cart:hover, .secView .w-btn:hover,
		button.button:hover span, .button:hover, .axcart:hover, .thirdView a.add-cart:hover, .thirdView .add-cart:hover,
		.qlinks .w-btn:hover,
		.actionBox:hover
        {background-color:<?php echo $config['buttonSetting']['button_hover_bg']; ?>;}
    <?php endif; ?>
    
    <?php if ( $config['buttonSetting']['button_hover_text'] ) : ?>
    	button.button:hover span,
        .proImage .qv-btn:hover, .add-cart:hover,
		.w-btn:hover, .w-btn:hover .fa,
		.secView .add-cart:hover, .secView a.add-cart:hover, .secView .w-btn:hover,
		.secView .add-cart:hover .fa, .secView a.add-cart:hover .fa, .secView .w-btn:hover .fa,
		.thirdView a.add-cart:hover, .thirdView .add-cart:hover,
		.lowPanel a.add-cart:hover, .lowPanel .add-cart:hover, .galleryBtn:hover
        {color:<?php echo $config['buttonSetting']['button_hover_text']; ?>;}
    <?php endif; ?>
	
	<?php if ( $config['buttonSetting']['button_border_hover_color'] ) : ?>
    	.add-cart:hover, a.add-cart:hover, .w-btn:hover,
		.lowPanel a.add-cart:hover, .lowPanel .add-cart:hover, .galleryBtn:hover
        {border-color:<?php echo $config['buttonSetting']['button_border_hover_color']; ?>;}
    <?php endif; ?>	

	
	
/*Price color*/
    <?php if ( $config['priceSetting']['regular_price'] ) : ?>
    	.regular-price .price
        {color:<?php echo $config['priceSetting']['regular_price']; ?>;}
    <?php endif; ?>
    
    <?php if ($config['priceSetting']['price_label'] ) : ?>
    	.price-label, .minimal-price-link .label, .special-price .price-label
        {color:<?php echo $config['priceSetting']['price_label']; ?>;}
    <?php endif; ?>
    
    <?php if ($config['priceSetting']['special_price'] ) : ?>
    	.minimal-price .price, .price-from .price, .minimal-price-link .price, .special-price .price
        {color:<?php echo $config['priceSetting']['special_price']; ?>;}
    <?php endif; ?>
    
    <?php if ($config['priceSetting']['old_price'] ) : ?>
    	.old-price .price
        {color:<?php echo $config['priceSetting']['old_price']; ?>;}
    <?php endif; ?>


/*Footer color*/

	<?php if ($config['footer_setting']['footer_bg'] ) : ?>
    	footer
        {background-color:<?php echo $config['footer_setting']['footer_bg']; ?>;}
    <?php endif; ?>
	
	<?php if ($config['footer_setting']['footer_text_color'] ) : ?>
		.footer4 .links ul li, 
		.uspBox li p,
		.footer-wrapper .links li,
		.footer-top-wrapper .msg-block .button-newsletter,
		 footer p		 
        {color:<?php echo $config['footer_setting']['footer_text_color']; ?>;}
    <?php endif; ?>
    
    <?php if ($config['footer_setting']['footer_heading'] ) : ?>
    	footer h3,
		.footer4 .footer-wrapper h3, 
		.uspBox li h3, .uspBox li .fa, 
		.footer4 .msg-block .button-newsletter,
		.footer-wrapper h3
        {color:<?php echo $config['footer_setting']['footer_heading']; ?>;}
    <?php endif; ?>
    
     <?php if ($config['footer_setting']['footer_text_anchore_color']) : ?>
    	.footer4 .links ul li a, 
		.footer-wrapper .links li a,
		footer a,
		.mdl-social li a,
		.smallFooter li a
		{color:<?php echo $config['footer_setting']['footer_text_anchore_color']; ?>;}
		.footer-wrapper .links li:before
		{border-left-color:<?php echo $config['footer_setting']['footer_text_anchore_color']; ?>;}
    <?php endif; ?>
    
    <?php if($config['footer_setting']['footer_text_color_hover'] ) : ?>
    	.footer4 .links ul li a:hover, 
		footer a:hover,
		.footer-wrapper .links li a:hover,
		.smallFooter li a:hover
        {color:<?php echo $config['footer_setting']['footer_text_color_hover']; ?>;}
    <?php endif;?>
	
	<?php if($config['footer_setting']['footer_border_color'] ) : ?>
    	.footer4 .footer-wrapper, 
		footer.footer4,
		.input-newsletter,
		.mdl-social li a,
		.footer-top-wrapper,
		.hexagon .mdl-social li:after, 
		.hexagon .mdl-social li:before
        {border-color:<?php echo $config['footer_setting']['footer_border_color']; ?>;}
		.smallFooter li:before
		{background-color:<?php echo $config['footer_setting']['footer_border_color']; ?>;}
    <?php endif;?>
	
	<?php if ($config['footer_setting']['footer_bg_bottom'] ) : ?>
    	.copyrightBox
        {background-color:<?php echo $config['footer_setting']['footer_bg_bottom']; ?>;}
    <?php endif; ?>
	
	<?php if ($config['footer_setting']['footer_bg_bottom'] ) : ?>
    	footer .copyrightBox
        {background-color:<?php echo $config['footer_setting']['footer_bg_bottom']; ?>;}
    <?php endif; ?>
    
    <?php if ($config['footer_setting']['footer_bottom_border_color'] ) : ?>
    	.fob-wrapper .bottom-links
        {
        	border-top-color:<?php echo $config['footer_setting']['footer_bottom_border_color']; ?>;
        	border-bottom-color:<?php echo $config['footer_setting']['footer_bottom_border_color']; ?>;
         }
    <?php endif; ?>
	
	<?php if ($config['footer_setting']['footer_bg_copy_text'] ) : ?>
    	.copyText
		{
        	color:<?php echo $config['footer_setting']['footer_bg_copy_text']; ?>;
         }
    <?php endif; ?>

/*Newsletter Popup color*/

	<?php if ($config['newsletter_color_setting']['nl_left_bg'] ) : ?>
    	#newsletter-popup .span6.newsTextarea
        {background-color:<?php echo $config['newsletter_color_setting']['nl_left_bg']; ?>;}
    <?php endif; ?>
	
	<?php if ($config['newsletter_color_setting']['nl_right_bg'] ) : ?>
    	#newsletter-popup .span6.newsletterBg
        {background-color:<?php echo $config['newsletter_color_setting']['nl_right_bg']; ?> !important;}
    <?php endif; ?>
	
	<?php if ($config['newsletter_color_setting']['nl_heading_color'] ) : ?>
    	#newsletter-popup h1
        {color:<?php echo $config['newsletter_color_setting']['nl_heading_color']; ?>;}
    <?php endif; ?>
	
	<?php if ($config['newsletter_color_setting']['nl_des_color'] ) : ?>
    	#newsletter-popup p
        {color:<?php echo $config['newsletter_color_setting']['nl_des_color']; ?>;}
    <?php endif; ?>
	
	<?php if ($config['newsletter_color_setting']['nl_btn_border'] ) : ?>
    	#newsletter-popup #subscr_btn
        {border-color:<?php echo $config['newsletter_color_setting']['nl_btn_border']; ?>;}
    <?php endif; ?>
	
	<?php if ($config['newsletter_color_setting']['nl_btn_text'] ) : ?>
    	#newsletter-popup #subscr_btn
        {color:<?php echo $config['newsletter_color_setting']['nl_btn_text']; ?>;}
    <?php endif; ?>

