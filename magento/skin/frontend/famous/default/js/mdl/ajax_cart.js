function setLocation(e){inCart||-1==e.search("checkout/cart/add")?-1!=e.search("catalog/product_compare")?sendcompare(e,"url"):window.location.href=e:sendcart(e,"url")}function sendcompare(e){showLoading(),e=e.replace("catalog/product_compare/add","bestseller/index/compare"),e+="isAjax/1/",jQuery.ajax({url:e,dataType:"json",success:function(e){if("ERROR"==e.status)alert(e.message);else if(""!=e.already){$("mdl-temp-div").innerHTML=e.already;var t=e.already;$("mdl_ajax_confirm").innerHTML='<div id="mdl_ajax_confirm_wrapper"><div class="f-block"><ul class="messages"><li class="notice-msg">'+t+"</li></ul></div></div>",showConfirm()}else{$("mdl-temp-div").innerHTML=e.message;var t=e.message;$("mdl_ajax_confirm").innerHTML='<div id="mdl_ajax_confirm_wrapper"><div class="f-block"><ul class="messages"><li class="success-msg">'+t+"</li></ul></div></div>",showConfirm(),jQuery(".header-compare").length?jQuery(".header-compare").replaceWith(e.sidebar):jQuery(".col-right").length&&jQuery(".col-right").prepend(e.sidebar)}}})}function sendcart(e,t){if(showLoading(),"form"==t){e=$("product_addtocart_form").action.replace("checkout","mdlajaxcheckout/index/cart");{new Ajax.Request(e,{method:"post",postBody:$("product_addtocart_form").serialize(),parameters:Form.serialize("product_addtocart_form"),onException:function(e,t){alert("Exception : "+t)},onComplete:function(e){$("mdl-temp-div").innerHTML=e.responseText;var t=$("mdl-temp-div").down(".mdl_ajax_message").innerHTML,a='<div class="mdl-cart-bts">'+$("mdl-temp-div").down(".back-ajax-add").innerHTML+"</div>";$("mdl_ajax_confirm").innerHTML='<div id="mdl_ajax_confirm_wrapper">'+t+a+"</div>";var r=$("mdl-temp-div").down(".cart_content").innerHTML;$$(".top-link-cart").each(function(e){e.innerHTML=r});var n=$("mdl-temp-div").down(".cart_side_ajax").innerHTML;$$(".mini-cart").each(function(e){e.replace(n)}),$$(".block-cart").each(function(e){e.replace(n)}),replaceDelUrls(),ajax_cart_show_popup?showConfirm():hideMdlOverlay()}})}}else if("url"==t){e=e.replace("checkout","mdlajaxcheckout/index/cart");{new Ajax.Request(e,{method:"post",postBody:"",onException:function(e,t){alert("Exception : "+t)},onComplete:function(e){$("mdl-temp-div").innerHTML=e.responseText;var t=$("mdl-temp-div").down(".mdl_ajax_message").innerHTML,a='<div class="mdl-cart-bts">'+$("mdl-temp-div").down(".back-ajax-add").innerHTML+"</div>",r=t+a;$("mdl_ajax_confirm").innerHTML='<div id="mdl_ajax_confirm_wrapper">'+r+"</div>";var n=$("mdl-temp-div").down(".cart_content").innerHTML;$$(".top-link-cart").each(function(e){e.innerHTML=n});var o=$("mdl-temp-div").down(".cart_side_ajax").innerHTML;$$(".mini-cart").each(function(e){e.replace(o)}),$$(".block-cart").each(function(e){e.replace(o)}),replaceDelUrls(),ajax_cart_show_popup?showConfirm():hideMdlOverlay()}})}}}function replaceDelUrls(){$$("a").each(function(e){-1!=e.href.search("checkout/cart/delete")&&-1==e.href.search("javascript:cartdelete")&&(e.href="javascript:cartdelete('"+e.href+"')")})}function replaceAddUrls(){$$("a").each(function(e){-1!=e.href.search("checkout/cart/add")&&(e.href="javascript:setLocation('"+e.href+"'); void(0);")})}function cartdelete(e){showLoading(),e=e.replace("checkout","mdlajaxcheckout/index/cartdelete");new Ajax.Request(e,{method:"post",postBody:"",onException:function(e,t){alert("Exception : "+t)},onComplete:function(e){$("mdl-temp-div").innerHTML=e.responseText;var t=$("mdl-temp-div").down(".cart_content").innerHTML;$$(".top-link-cart").each(function(e){e.innerHTML=t});var a=!1,r=$("mdl-temp-div").down(".mdl_full_cart_content").innerHTML;$$(".cart").each(function(e){e.replace(r),a=!0}),a||$$(".checkout-cart-index .col-main").each(function(e){e.replace(r)});var n="";$("mdl-temp-div").down(".cart_side_ajax")&&(n=$("mdl-temp-div").down(".cart_side_ajax").innerHTML),$$(".mini-cart").each(function(e){e.replace(n)}),$$(".block-cart").each(function(e){e.replace(n)}),replaceDelUrls(),hideMdlOverlay()}})}function showMdlOverlay(){new Effect.Appear($("mdl-overlay"),{duration:.5,to:.8})}function hideMdlOverlay(){$("mdl-overlay").hide(),$("mdl_ajax_progress").hide(),$("mdl_ajax_confirm").hide()}function mdlCenterWindow(e){if(null!=$(e)){var t=$(e),a=t.getDimensions(),r=navigator.appName;if("Microsoft Internet Explorer"===r)if(0==document.documentElement.clientWidth)var n=document.viewport.getScrollOffsets().top+(document.body.clientHeight-a.height)/2,o=document.viewport.getScrollOffsets().left+(document.body.clientWidth-a.width)/2;else var n=document.viewport.getScrollOffsets().top+(document.documentElement.clientHeight-a.height)/2,o=document.viewport.getScrollOffsets().left+(document.documentElement.clientWidth-a.width)/2;else var n=Math.round(document.viewport.getScrollOffsets().top+(window.innerHeight-$(e).getHeight())/2),o=Math.round(document.viewport.getScrollOffsets().left+(window.innerWidth-$(e).getWidth())/2);var i={position:"absolute",top:n+"px",left:o+"px"};t.setStyle(i)}}function showLoading(){showMdlOverlay();var e=$("mdl_ajax_progress");e.show(),e.style.width=loadingW+"px",e.style.height=loadingH+"px",$("mdl_ajax_progress").innerHTML=$("mdl-loading-data").innerHTML,e.style.position="absolute",mdlCenterWindow(e)}function showConfirm(){showMdlOverlay(),$("mdl_ajax_progress").hide();var e=$("mdl_ajax_confirm");e.show(),e.style.width=confirmW+"px",e.style.height=confirmH+"px",$("mdl_ajax_confirm_wrapper")&&$("mdl-upsell-product-table")&&(e.style.height=$("mdl_ajax_confirm_wrapper").getHeight()+"px",decorateTable("mdl-upsell-product-table")),$("mdl_ajax_confirm_wrapper").replace('<div id="mdl_ajax_confirm_wrapper">'+$("mdl_ajax_confirm_wrapper").innerHTML),e.style.position="absolute",mdlCenterWindow(e)}var inCart=!1;if(-1!=window.location.toString().search("/product_compare/"))var win=window.opener;else var win=window;-1!=window.location.toString().search("/checkout/cart/")&&(inCart=!0),document.observe("dom:loaded",function(){replaceDelUrls(),replaceAddUrls(),Event.observe($("mdl-overlay"),"click",hideMdlOverlay);var e=setInterval(function(){"undefined"!=typeof productAddToCartForm?($("mdl-overlay")&&Event.observe($("mdl-overlay"),"click",hideMdlOverlay),productAddToCartForm.submit=function(){return this.validator&&this.validator.validate()&&(sendcart("","form"),clearInterval(e)),!1}):clearInterval(e)},500)});