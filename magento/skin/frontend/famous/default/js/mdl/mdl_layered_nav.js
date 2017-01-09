// checking if IE: this variable will be understood by IE: isIE = !false
isIE = /*@cc_on!@*/false;

Control.Slider.prototype.setDisabled = function()
{
    this.disabled = true;

    if (!isIE)
    {
        this.track.parentNode.className = this.track.parentNode.className + ' disabled';
    }
};

function mdl_layered_hide_products(){
    var items = $('mdl_filters_list').select('a', 'input');
    n = items.length;
    for (i = 0; i < n; ++i) {
        items[i].addClassName('mdl_layered_disabled');
    }

    if (typeof (mdl_slider) != 'undefined')
        mdl_slider.setDisabled();

    var divs = $$('div.mdl_loading_filters');
    for (var i = 0; i < divs.length; ++i)
        divs[i].show();
}

function mdl_layered_show_products(transport){
	var divs = $$('div.mdl_loading_filters');
    for (var i = 0; i < divs.length; ++i)
        divs[i].hide();
	
    var resp = {};
    if (transport && transport.responseText) {
        try {
            resp = eval('(' + transport.responseText + ')');
        }
        catch (e) {
            resp = {};
        }
    }
    if (resp.ajaxstate) {
        console.log('Ajax State');
    }
    if (resp.products) {

        var ajaxUrl = $('mdl_layered_ajax').value;

        if ($('mdl_layered_container') == undefined) {

            var c = $$('.col-main')[0];// alert(c.hasChildNodes());
            if (c.hasChildNodes()) {
                while (c.childNodes.length > 2) {
                    c.removeChild(c.lastChild);
                }
            }

            var div = document.createElement('div');
            div.setAttribute('id', 'mdl_layered_container');
            $$('.col-main')[0].appendChild(div);

        }

        var el = $('mdl_layered_container');
        el.update(resp.products.gsub(ajaxUrl, $('mdl_layered_url').value));
        catalog_toolbar_init();

        $('catalog-filters').update(
                resp.layer.gsub(
                        ajaxUrl,
                        $('mdl_layered_url').value
                        )
                );
        if (resp.ajaxstate) {
        $('ajaxlayer-states').update(
                resp.ajaxstate.gsub(
                        ajaxUrl,
                        $('mdl_layered_url').value
                        )
                );
        }
        $('mdl_layered_ajax').value = ajaxUrl;
    }

    var items = $('mdl_filters_list').select('a', 'input');
    n = items.length;
    for (i = 0; i < n; ++i) {
        items[i].removeClassName('mdl_layered_disabled');
    }
    if (typeof (mdl_slider) != 'undefined')
        mdl_slider.setEnabled();
}

function mdl_layered_add_params(k, v, isSingleVal)
{
    var el = $('mdl_layered_params');
    var params = el.value.parseQuery();

    var strVal = params[k];
    if (typeof strVal == 'undefined' || !strVal.length) {
        params[k] = v;
    }
    else if ('clear' == v) {
        params[k] = 'clear';
    }
    else {
        if (k == 'price')
            var values = strVal.split(',');
        else
            var values = strVal.split('-');

        if (-1 == values.indexOf(v)) {
            if (isSingleVal)
                values = [v];
            else
                values.push(v);
        }
        else {
            values = values.without(v);
        }

        params[k] = values.join('-');
    }

    el.value = Object.toQueryString(params).gsub('%2B', '+');
    console.log('QueryParam='+el.value);
}



function mdl_layered_make_request()
{
    
    mdl_layered_hide_products();

    var params = $('mdl_layered_params').value.parseQuery();
console.log('Now here='+params);
    if (!params['dir'])
    {
        $('mdl_layered_params').value += '&dir=' + 'desc';
    }

    new Ajax.Request(
            $('mdl_layered_ajax').value + '?' + $('mdl_layered_params').value,
            {
                method: 'get',
                onSuccess: mdl_layered_show_products
            }
    );
}


function mdl_layered_update_links(evt, className, isSingleVal)
{
    var link = Event.findElement(evt, 'A'),
            sel = className + '-selected';

    if (link.hasClassName(sel))
        link.removeClassName(sel);
    else
        link.addClassName(sel);

    //only one  price-range can be selected
    if (isSingleVal) {
        var items = $('mdl_filters_list').getElementsByClassName(className);
        var i, n = items.length;
        for (i = 0; i < n; ++i) {
            if (items[i].hasClassName(sel) && items[i].id != link.id)
                items[i].removeClassName(sel);
        }
    }

    mdl_layered_add_params(link.id.split('-')[0], link.id.split('-')[1], isSingleVal);

    mdl_layered_make_request();

    Event.stop(evt);
}


function mdl_layered_attribute_listener(evt)
{
    mdl_layered_add_params('p', 1, 1);
    mdl_layered_update_links(evt, 'mdl_layered_attribute', 0);
}


function mdl_layered_price_listener(evt)
{
    mdl_layered_add_params('p', 1, 1);
    mdl_layered_update_links(evt, 'mdl_layered_price', 1);
}

function mdl_layered_clear_listener(evt)
{
    var link = Event.findElement(evt, 'A'),
            varName = link.id.split('-')[0];

    mdl_layered_add_params('p', 1, 1);
    mdl_layered_add_params(varName, 'clear', 1);

    if ('price' == varName) {
        var from = $('adj-nav-price-from'),
                to = $('adj-nav-price-to');

        if (Object.isElement(from)) {
            from.value = from.name;
            to.value = to.name;
        }
    }

    mdl_layered_make_request();

    Event.stop(evt);
}


function roundPrice(num) {
    num = parseFloat(num);
    if (isNaN(num))
        num = 0;

    return Math.round(num);
}

function mdl_layered_category_listener(evt) {
    var link = Event.findElement(evt, 'A');
    var catId = link.id.split('-')[1];

    var reg = /cat-/;
    if (reg.test(link.id)) { //is search
        mdl_layered_add_params('cat', catId, 1);
        mdl_layered_add_params('p', 1, 1); 
        mdl_layered_make_request();
        Event.stop(evt);
    }
    //do not stop event
}

function catalog_toolbar_listener(evt) {
   
    catalog_toolbar_make_request(Event.findElement(evt, 'A').href);
    Event.stop(evt);
	
	var url = jQuery(this).attr('href');
	var last_url = window.location.href;
   
	//history.pushState({}, last_url, url);
}

function catalog_toolbar_make_request(href)
{
     
    var pos = href.indexOf('?');
    if (pos > -1) {
        console.log('hi='+href.substring(pos + 1, href.length));
        jQuery('#mdl_layered_params').val(href.substring(pos + 1, href.length));
        jQuery('mdl_layered_params').value = href.substring(pos + 1, href.length);
        console.log('param='+jQuery('#mdl_layered_params').val());
    }
    mdl_layered_make_request();
}


function catalog_toolbar_init()
{
    var items = jQuery('mdl_layered_container').select('.pages a', '.view-mode a', '.sort-by a', '.direction a');
    var i, n = items.length;
    //Event.observe(jQuery('mdl_layered_container .showPan'), 'change', catalog_toolbar_listener);
   // Event.observe($('price_range_to---' + items[i].value), 'keypress', price_input_listener);
     console.log(items.length);
    for (i = 0; i < n; ++i) {
        Event.observe(items[i], 'click', catalog_toolbar_listener);
    }
}

function mdl_layered_dt_listener(evt) {
    var e = Event.findElement(evt, 'DT');
    e.nextSiblings()[0].toggle();
    e.toggleClassName('mdl_layered_dt_selected');
}


function mdl_layered_clearall_listener(evt)
{
    var params = $('mdl_layered_params').value.parseQuery();
    $('mdl_layered_params').value = 'clearall=true';
    if (params['q'])
    {
        $('mdl_layered_params').value += '&q=' + params['q'];
    }
    mdl_layered_make_request();
    //jQuery('.pager').css('display','none');
    jQuery.mdl({
					container :'.category-products',
					item: vMode,
					pagination: '.toolbar .pager',
					history: false,
					next: 'a.next',
					loader: '<div style="display:inline-block; font-size:25px; width:100%; text-align:center;"><i class="fa fa-refresh fa-spin"></i></div>',
					
				});
    Event.stop(evt);
}

function price_input_listener(evt) {
    if (evt.type == 'keypress' && 13 != evt.keyCode)
        return;

    if (evt.type == 'keypress') {
        var inpObj = Event.findElement(evt, 'INPUT');
    } else {
        var inpObj = Event.findElement(evt, 'BUTTON');
    }

    var sKey = inpObj.id.split('---')[1];
    var numFrom = roundPrice($('price_range_from---' + sKey).value),
            numTo = roundPrice($('price_range_to---' + sKey).value);

    if ((numFrom < 0.01 && numTo < 0.01) || numFrom < 0 || numTo < 0)
        return;

    mdl_layered_add_params('p', 1, 1);
    mdl_layered_add_params(sKey, numFrom + ',' + numTo, true);
    mdl_layered_make_request();
}

function mdl_layered_init()
{
    var items, i, j, n,
            classes = ['category', 'attribute', 'icon', 'price', 'clear', 'dt', 'clearall'];
    
    for (j = 0; j < classes.length; ++j) {
        items = $('mdl_filters_list').select('.mdl_layered_' + classes[j]);
        n = items.length;
        //console.log(items.length);
        for (i = 0; i < n; ++i) {
            Event.observe(items[i], 'click', eval('mdl_layered_' + classes[j] + '_listener'));
        }
    }

    items = $('mdl_filters_list').select('.price-input');
    n = items.length;
    var btn = $('price_button_go');
    for (i = 0; i < n; ++i)
    {
        btn = $('price_button_go---' + items[i].value);
        if (Object.isElement(btn)) {
            Event.observe(btn, 'click', price_input_listener);
            Event.observe($('price_range_from---' + items[i].value), 'keypress', price_input_listener);
            Event.observe($('price_range_to---' + items[i].value), 'keypress', price_input_listener);
        }
    }
// finish new fix code    
}

function create_price_slider(width, from, to, min_price, max_price, sKey)
{
    var price_slider = $('mdl_layered_price_slider' + sKey);

    return new Control.Slider(price_slider.select('.handle'), price_slider, {
        range: $R(0, width),
        sliderValue: [from, to],
        restricted: true,
        onChange: function(values) {
			var f = calculateSliderPrice(width, from, to, min_price, max_price, values[0]),
                    t = calculateSliderPrice(width, from, to, min_price, max_price, values[1]);

            mdl_layered_add_params(sKey, f + ',' + t, true);

            $('price_range_from' + sKey).update(f);
            $('price_range_to' + sKey).update(t);

            mdl_layered_make_request();
        },
        onSlide: function(values) {
            $('price_range_from' + sKey).update(calculateSliderPrice(width, from, to, min_price, max_price, values[0]));
            $('price_range_to' + sKey).update(calculateSliderPrice(width, from, to, min_price, max_price, values[1]));
        }
    });
}

function calculateSliderPrice(width, from, to, min_price, max_price, value){
    var calculated = roundPrice(((max_price - min_price) * value / width) + min_price);

    return calculated;
}
function create_price_slider_custom(min_price,max_price,sKey)
{
    var f = roundPrice(min_price),
                    t = roundPrice(max_price);

            mdl_layered_add_params(sKey, f + ',' + t, true);

            $('price_range_from' + sKey).update(f);
            $('price_range_to' + sKey).update(t);
             mdl_layered_make_request();
   
}