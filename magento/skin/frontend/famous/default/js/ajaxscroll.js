(function(b) {
    b.mdl = function(d) {
        var m = b.extend({}, b.mdl.defaults, d);
        var c = new b.mdl.util();
        var j = new b.mdl.paging();
        var h = (m.history ? new b.mdl.history() : false);
        var f = this;
        r();

        function r() {
            j.onChangePage(function(x, v, w) {
                if (h) {
                    h.setPage(x, w)
                }
                m.onPageChange.call(this, x, w, v)
            });
            s();
            if (h && h.havePage()) {
                q();
                pageNum = h.getPage();
                c.forceScrollTop(function() {
                    if (pageNum > 1) {
                        l(pageNum);
                        curTreshold = p(true);
                        b("html,body").scrollTop(curTreshold)
                    } else {
                        s()
                    }
                })
            }
            return f
        }

        function s() {
            n();
            b(window).scroll(g)
        }

        function g() {
			
            scrTop = b(window).scrollTop();
            wndHeight = b(window).height();
            curScrOffset = scrTop + wndHeight;
			
            if (curScrOffset >= p()) {
                t(curScrOffset)
            }
        }

        function q() {
            b(window).unbind("scroll", g)
        }

        function n() {
            b(m.pagination).hide()
        }

        function p(v) {
            el = b(m.container).find(m.item).last();
			
            if (el.size() == 0) {
                return 0
            }
            treshold = el.offset().top + el.height();
            if (!v) {
                treshold += m.tresholdMargin
            }
            return treshold
        }

        function t(w, v) {
            urlNextPage = b(m.next).attr("href");
			
            if (!urlNextPage) {
                return q()
            }
            j.pushPages(w, urlNextPage);
            q();
            o();
            e(urlNextPage, function(y, x) {
                result = m.onLoadItems.call(this, x);
                if (result !== false) {
                    b(x).hide();
                    curLastItem = b(m.container).find(m.item).last();
                    curLastItem.after(x);
                    b(x).fadeIn()
                }
                b(m.pagination).replaceWith(b(m.pagination, y));
                k();
                s();
                m.onRenderComplete.call(this, x);
                if (v) {
                    v.call(this)
                }
            })
        }

        function e(w, x) {
            var v = [];
            b.get(w, null, function(y) {
                b(m.container, y).find(m.item).each(function() {
                    v.push(this)
                });
                if (x) {
                    x.call(this, y, v)
                }
            }, "html")
        }

        function l(v) {
            curTreshold = p(true);
            if (curTreshold > 0) {
                t(curTreshold, function() {
                    q();
                    if ((j.getCurPageNum(curTreshold) + 1) < v) {
                        l(v);
                        b("html,body").animate({
                            scrollTop: curTreshold
                        }, 400, "swing")
                    } else {
                        b("html,body").animate({
                            scrollTop: curTreshold
                        }, 1000, "swing");
                        s()
                    }
                })
            }
        }

        function u() {
            loader = b(".loderPan");
            if (loader.size() == 0) {
                loader = b("<div class='loderPan'>" + m.loader + "</div>");
                loader.hide()
            }
            return loader
        }

        function o(v) {
            loader = u();
            el = b(m.container).find(m.item).last();
            el.after(loader);
            loader.fadeIn()
        }

        function k() {
            loader = u();
            loader.remove()
        }
    };

    function a(c) {
        if (window.console && window.console.log) {
            window.console.log(c)
        }
    }
    b.mdl.defaults = {
        container: "#container",
        item: ".item",
        pagination: "#pagination",
        next: ".next",
        loader: '<img src="images/loader.gif"/>',
        tresholdMargin: 0,
        history: false,
        onPageChange: function() {},
        onLoadItems: function() {},
        onRenderComplete: function() {},
    };
    b.mdl.util = function() {
        var d = false;
        var f = false;
        var c = this;
        e();

        function e() {
            b(window).load(function() {
                d = true
            })
        }
        this.forceScrollTop = function(g) {
            b("html,body").scrollTop(0);
            if (!f) {
                if (!d) {
                    setTimeout(function() {
                        c.forceScrollTop(g)
                    }, 1)
                } else {
                    g.call();
                    f = true
                }
            }
        }
    };
    b.mdl.paging = function() {
        var e = [
            [0, document.location.toString()]
        ];
        var h = function() {};
        var d = 1;
        j();

        function j() {
            b(window).scroll(g)
        }

        function g() {
            scrTop = b(window).scrollTop();
            wndHeight = b(window).height();
            curScrOffset = scrTop + wndHeight;
            curPageNum = c(curScrOffset);
            curPagebreak = f(curScrOffset);
            if (d != curPageNum) {
                h.call(this, curPageNum, curPagebreak[0], curPagebreak[1])
            }
            d = curPageNum
        }

        function c(k) {
            for (i = (e.length - 1); i > 0; i--) {
                if (k > e[i][0]) {
                    return i + 1
                }
            }
            return 1
        }
        this.getCurPageNum = function(k) {
            return c(k)
        };

        function f(k) {
            for (i = (e.length - 1); i >= 0; i--) {
                if (k > e[i][0]) {
                    return e[i]
                }
            }
            return null
        }
        this.onChangePage = function(k) {
            h = k
        };
        this.pushPages = function(k, l) {
            e.push([k, l])
        }
    };
    b.mdl.history = function() {
        var d = false;
        var c = false;
        e();

        function e() {
            c = !!(window.history && history.pushState && history.replaceState);
            c = false
        }
        this.setPage = function(g, f) {
            this.updateState({
                page: g
            }, "", f)
        };
        this.havePage = function() {
            return (this.getState() != false)
        };
        this.getPage = function() {
            if (this.havePage()) {
                stateObj = this.getState();
                return stateObj.page
            }
            return 1
        };
        this.getState = function() {
            if (c) {
                stateObj = history.state;
                if (stateObj && stateObj.mdl) {
                    return stateObj.mdl
                }
            } else {
                haveState = (window.location.hash.substring(0, 7) == "#/page/");
                if (haveState) {
                    pageNum = parseInt(window.location.hash.replace("#/page/", ""));
                    return {
                        page: pageNum
                    }
                }
            }
            return false
        };
        this.updateState = function(g, h, f) {
            if (d) {
                this.replaceState(g, h, f)
            } else {
                this.pushState(g, h, f)
            }
        };
        this.pushState = function(g, h, f) {
            if (c) {
                history.pushState({
                    mdl: g
                }, h, f)
            } else {
                hash = (g.page > 0 ? "#/page/" + g.page : "");
                window.location.hash = hash
            }
            d = true
        };
        this.replaceState = function(g, h, f) {
            if (c) {
                history.replaceState({
                    mdl: g
                }, h, f)
            } else {
                this.pushState(g, h, f)
            }
        }
    }
jQuery(document).ready(function(){	
	jQuery.mdl({
		container :'.category-products',
		item: vMode,
		pagination: '.toolbar .pager',
		next: 'a.next',
		loader: '<div style="display:inline-block; font-size:25px; width:100%; text-align:center;"><i class="fa fa-refresh fa-spin"></i></div>',
        onPageChange: function() { jQuery('.toolbar-bottom').find('.pager').css('display','none'); },
		onRenderComplete: function(){ 
					jQuery('.listGallery').owlCarousel({
					loop:false,
					smartSpeed: 500,
					margin:10,
					dots: false,
					nav: true,
					navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ],
					responsiveClass:true,
					items:1
					});
			}
	});
});	
	
})(jQuery);
jQuery.noConflict();