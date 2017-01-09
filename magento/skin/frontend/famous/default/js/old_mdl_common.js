function showOptions(t) {
    jQuery("#fancybox" + t).delay(1e3).trigger("click")
}

function setAjaxData(t) {
    "ERROR" == t.status ? alert(t.message) : (jQuery(".block-cart") && jQuery(".block-cart").replaceWith(t.sidebar), jQuery(".header .links") && jQuery(".header .links").replaceWith(t.toplink), jQuery("body,html").animate({
        scrollTop: 0
    }, 800), jQuery("#minicart").fadeIn(), setTimeout(function() {
        jQuery("#minicart").fadeOut()
    }, 2e3), jQuery.fancybox.close())
}

function setLocationAjax(t, e) {
    t += "isAjax/1", t = t.replace("checkout/cart", "ajax/index"), jQuery("#ajax_loader" + e).show();
    try {
        jQuery.ajax({
            url: t,
            dataType: "json",
            success: function(t) {
                jQuery("#ajax_loader" + e).hide(), setAjaxData(t, !1)
            }
        })
    } catch (i) {}
}! function(t) {
    var e = {},
        n = {
            mode: "horizontal",
            slideSelector: "",
            infiniteLoop: !0,
            hideControlOnEnd: !1,
            speed: 500,
            easing: null,
            slideMargin: 0,
            startSlide: 0,
            randomStart: !1,
            captions: !1,
            ticker: !1,
            tickerHover: !1,
            adaptiveHeight: !1,
            adaptiveHeightSpeed: 500,
            video: !1,
            useCSS: !0,
            preloadImages: "visible",
            responsive: !0,
            slideZIndex: 50,
            touchEnabled: !0,
            swipeThreshold: 50,
            oneToOneTouch: !0,
            preventDefaultSwipeX: !0,
            preventDefaultSwipeY: !1,
            pager: !0,
            pagerType: "full",
            pagerShortSeparator: " / ",
            pagerSelector: null,
            buildPager: null,
            pagerCustom: null,
            controls: !0,
            nextText: "Next",
            prevText: "Prev",
            nextSelector: null,
            prevSelector: null,
            autoControls: !1,
            startText: "Start",
            stopText: "Stop",
            autoControlsCombine: !1,
            autoControlsSelector: null,
            auto: !1,
            pause: 4e3,
            autoStart: !0,
            autoDirection: "next",
            autoHover: !1,
            autoDelay: 0,
            minSlides: 1,
            maxSlides: 1,
            moveSlides: 0,
            slideWidth: 0,
            onSliderLoad: function() {},
            onSlideBefore: function() {},
            onSlideAfter: function() {},
            onSlideNext: function() {},
            onSlidePrev: function() {},
            onSliderResize: function() {}
        };
    t.fn.bxSlider = function(s) {
        if (0 == this.length) return this;
        if (this.length > 1) return this.each(function() {
            t(this).bxSlider(s)
        }), this;
        var o = {},
            r = this;
        e.el = this;
        var a = t(window).width(),
            l = t(window).height(),
            h = function() {
                o.settings = t.extend({}, n, s), o.settings.slideWidth = parseInt(o.settings.slideWidth), o.children = r.children(o.settings.slideSelector), o.children.length < o.settings.minSlides && (o.settings.minSlides = o.children.length), o.children.length < o.settings.maxSlides && (o.settings.maxSlides = o.children.length), o.settings.randomStart && (o.settings.startSlide = Math.floor(Math.random() * o.children.length)), o.active = {
                    index: o.settings.startSlide
                }, o.carousel = o.settings.minSlides > 1 || o.settings.maxSlides > 1, o.carousel && (o.settings.preloadImages = "all"), o.minThreshold = o.settings.minSlides * o.settings.slideWidth + (o.settings.minSlides - 1) * o.settings.slideMargin, o.maxThreshold = o.settings.maxSlides * o.settings.slideWidth + (o.settings.maxSlides - 1) * o.settings.slideMargin, o.working = !1, o.controls = {}, o.interval = null, o.animProp = "vertical" == o.settings.mode ? "top" : "left", o.usingCSS = o.settings.useCSS && "fade" != o.settings.mode && function() {
                    var t = document.createElement("div"),
                        e = ["WebkitPerspective", "MozPerspective", "OPerspective", "msPerspective"];
                    for (var i in e)
                        if (void 0 !== t.style[e[i]]) return o.cssPrefix = e[i].replace("Perspective", "").toLowerCase(), o.animProp = "-" + o.cssPrefix + "-transform", !0;
                    return !1
                }(), "vertical" == o.settings.mode && (o.settings.maxSlides = o.settings.minSlides), r.data("origStyle", r.attr("style")), r.children(o.settings.slideSelector).each(function() {
                    t(this).data("origStyle", t(this).attr("style"))
                }), c()
            },
            c = function() {
                r.wrap('<div class="bx-wrapper"><div class="bx-viewport"></div></div>'), o.viewport = r.parent(), o.loader = t('<div class="bx-loading" />'), o.viewport.prepend(o.loader), r.css({
                    width: "horizontal" == o.settings.mode ? 100 * o.children.length + 215 + "%" : "auto",
                    position: "relative"
                }), o.usingCSS && o.settings.easing ? r.css("-" + o.cssPrefix + "-transition-timing-function", o.settings.easing) : o.settings.easing || (o.settings.easing = "swing"), m(), o.viewport.css({
                    width: "100%",
                    overflow: "hidden",
                    position: "relative"
                }), o.viewport.parent().css({
                    maxWidth: g()
                }), o.settings.pager || o.viewport.parent().css({
                    margin: "0 auto 0px"
                }), o.children.css({
                    "float": "horizontal" == o.settings.mode ? "left" : "none",
                    listStyle: "none",
                    position: "relative"
                }), o.children.css("width", f()), "horizontal" == o.settings.mode && o.settings.slideMargin > 0 && o.children.css("marginRight", o.settings.slideMargin), "vertical" == o.settings.mode && o.settings.slideMargin > 0 && o.children.css("marginBottom", o.settings.slideMargin), "fade" == o.settings.mode && (o.children.css({
                    position: "absolute",
                    zIndex: 0,
                    display: "none"
                }), o.children.eq(o.settings.startSlide).css({
                    zIndex: o.settings.slideZIndex,
                    display: "block"
                })), o.controls.el = t('<div class="bx-controls" />'), o.settings.captions && E(), o.active.last = o.settings.startSlide == v() - 1, o.settings.video && r.fitVids();
                var e = o.children.eq(o.settings.startSlide);
                "all" == o.settings.preloadImages && (e = o.children), o.settings.ticker ? o.settings.pager = !1 : (o.settings.pager && _(), o.settings.controls && C(), o.settings.auto && o.settings.autoControls && S(), (o.settings.controls || o.settings.autoControls || o.settings.pager) && o.viewport.after(o.controls.el)), d(e, u)
            },
            d = function(e, i) {
                var n = e.find("img, iframe").length;
                if (0 == n) return void i();
                var s = 0;
                e.find("img, iframe").each(function() {
                    t(this).one("load", function() {
                        ++s == n && i()
                    }).each(function() {
                        this.complete && t(this).load()
                    })
                })
            },
            u = function() {
                if (o.settings.infiniteLoop && "fade" != o.settings.mode && !o.settings.ticker) {
                    var e = "vertical" == o.settings.mode ? o.settings.minSlides : o.settings.maxSlides,
                        i = o.children.slice(0, e).clone().addClass("bx-clone"),
                        n = o.children.slice(-e).clone().addClass("bx-clone");
                    r.append(i).prepend(n)
                }
                o.loader.remove(), w(), "vertical" == o.settings.mode && (o.settings.adaptiveHeight = !0), o.viewport.height(p()), r.redrawSlider(), o.settings.onSliderLoad(o.active.index), o.initialized = !0, o.settings.responsive && t(window).bind("resize", X), o.settings.auto && o.settings.autoStart && z(), o.settings.ticker && O(), o.settings.pager && P(o.settings.startSlide), o.settings.controls && D(), o.settings.touchEnabled && !o.settings.ticker && L()
            },
            p = function() {
                var e = 0,
                    n = t();
                if ("vertical" == o.settings.mode || o.settings.adaptiveHeight)
                    if (o.carousel) {
                        var s = 1 == o.settings.moveSlides ? o.active.index : o.active.index * y();
                        for (n = o.children.eq(s), i = 1; i <= o.settings.maxSlides - 1; i++) n = n.add(s + i >= o.children.length ? o.children.eq(i - 1) : o.children.eq(s + i))
                    } else n = o.children.eq(o.active.index);
                else n = o.children;
                return "vertical" == o.settings.mode ? (n.each(function() {
                    e += t(this).outerHeight()
                }), o.settings.slideMargin > 0 && (e += o.settings.slideMargin * (o.settings.minSlides - 1))) : e = Math.max.apply(Math, n.map(function() {
                    return t(this).outerHeight(!1)
                }).get()), e
            },
            g = function() {
                var t = "100%";
                return o.settings.slideWidth > 0 && (t = "horizontal" == o.settings.mode ? o.settings.maxSlides * o.settings.slideWidth + (o.settings.maxSlides - 1) * o.settings.slideMargin : o.settings.slideWidth), t
            },
            f = function() {
                var t = o.settings.slideWidth,
                    e = o.viewport.width();
                return 0 == o.settings.slideWidth || o.settings.slideWidth > e && !o.carousel || "vertical" == o.settings.mode ? t = e : o.settings.maxSlides > 1 && "horizontal" == o.settings.mode && (e > o.maxThreshold || e < o.minThreshold && (t = (e - o.settings.slideMargin * (o.settings.minSlides - 1)) / o.settings.minSlides)), t
            },
            m = function() {
                var t = 1;
                if ("horizontal" == o.settings.mode && o.settings.slideWidth > 0)
                    if (o.viewport.width() < o.minThreshold) t = o.settings.minSlides;
                    else if (o.viewport.width() > o.maxThreshold) t = o.settings.maxSlides;
                else {
                    var e = o.children.first().width();
                    t = Math.floor(o.viewport.width() / e)
                } else "vertical" == o.settings.mode && (t = o.settings.minSlides);
                return t
            },
            v = function() {
                var t = 0;
                if (o.settings.moveSlides > 0)
                    if (o.settings.infiniteLoop) t = o.children.length / y();
                    else
                        for (var e = 0, i = 0; e < o.children.length;) ++t, e = i + m(), i += o.settings.moveSlides <= m() ? o.settings.moveSlides : m();
                else t = Math.ceil(o.children.length / m());
                return t
            },
            y = function() {
                return o.settings.moveSlides > 0 && o.settings.moveSlides <= m() ? o.settings.moveSlides : m()
            },
            w = function() {
                if (o.children.length > o.settings.maxSlides && o.active.last && !o.settings.infiniteLoop) {
                    if ("horizontal" == o.settings.mode) {
                        var t = o.children.last(),
                            e = t.position();
                        x(-(e.left - (o.viewport.width() - t.width())), "reset", 0)
                    } else if ("vertical" == o.settings.mode) {
                        var i = o.children.length - o.settings.minSlides,
                            e = o.children.eq(i).position();
                        x(-e.top, "reset", 0)
                    }
                } else {
                    var e = o.children.eq(o.active.index * y()).position();
                    o.active.index == v() - 1 && (o.active.last = !0), void 0 != e && ("horizontal" == o.settings.mode ? x(-e.left, "reset", 0) : "vertical" == o.settings.mode && x(-e.top, "reset", 0))
                }
            },
            x = function(t, e, i, n) {
                if (o.usingCSS) {
                    var s = "vertical" == o.settings.mode ? "translate3d(0, " + t + "px, 0)" : "translate3d(" + t + "px, 0, 0)";
                    r.css("-" + o.cssPrefix + "-transition-duration", i / 1e3 + "s"), "slide" == e ? (r.css(o.animProp, s), r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                        r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), A()
                    })) : "reset" == e ? r.css(o.animProp, s) : "ticker" == e && (r.css("-" + o.cssPrefix + "-transition-timing-function", "linear"), r.css(o.animProp, s), r.bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function() {
                        r.unbind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd"), x(n.resetValue, "reset", 0), Q()
                    }))
                } else {
                    var a = {};
                    a[o.animProp] = t, "slide" == e ? r.animate(a, i, o.settings.easing, function() {
                        A()
                    }) : "reset" == e ? r.css(o.animProp, t) : "ticker" == e && r.animate(a, speed, "linear", function() {
                        x(n.resetValue, "reset", 0), Q()
                    })
                }
            },
            b = function() {
                for (var e = "", i = v(), n = 0; i > n; n++) {
                    var s = "";
                    o.settings.buildPager && t.isFunction(o.settings.buildPager) ? (s = o.settings.buildPager(n), o.pagerEl.addClass("bx-custom-pager")) : (s = n + 1, o.pagerEl.addClass("bx-default-pager")), e += '<div class="bx-pager-item"><a href="" data-slide-index="' + n + '" class="bx-pager-link">' + s + "</a></div>"
                }
                o.pagerEl.html(e)
            },
            _ = function() {
                o.settings.pagerCustom ? o.pagerEl = t(o.settings.pagerCustom) : (o.pagerEl = t('<div class="bx-pager" />'), o.settings.pagerSelector ? t(o.settings.pagerSelector).html(o.pagerEl) : o.controls.el.addClass("bx-has-pager").append(o.pagerEl), b()), o.pagerEl.on("click", "a", $)
            },
            C = function() {
                o.controls.next = t('<a class="bx-next" href="">' + o.settings.nextText + "</a>"), o.controls.prev = t('<a class="bx-prev" href="">' + o.settings.prevText + "</a>"), o.controls.next.bind("click", T), o.controls.prev.bind("click", k), o.settings.nextSelector && t(o.settings.nextSelector).append(o.controls.next), o.settings.prevSelector && t(o.settings.prevSelector).append(o.controls.prev), o.settings.nextSelector || o.settings.prevSelector || (o.controls.directionEl = t('<div class="bx-controls-direction" />'), o.controls.directionEl.append(o.controls.prev).append(o.controls.next), o.controls.el.addClass("bx-has-controls-direction").append(o.controls.directionEl))
            },
            S = function() {
                o.controls.start = t('<div class="bx-controls-auto-item"><a class="bx-start" href="">' + o.settings.startText + "</a></div>"), o.controls.stop = t('<div class="bx-controls-auto-item"><a class="bx-stop" href="">' + o.settings.stopText + "</a></div>"), o.controls.autoEl = t('<div class="bx-controls-auto" />'), o.controls.autoEl.on("click", ".bx-start", j), o.controls.autoEl.on("click", ".bx-stop", M), o.settings.autoControlsCombine ? o.controls.autoEl.append(o.controls.start) : o.controls.autoEl.append(o.controls.start).append(o.controls.stop), o.settings.autoControlsSelector ? t(o.settings.autoControlsSelector).html(o.controls.autoEl) : o.controls.el.addClass("bx-has-controls-auto").append(o.controls.autoEl), I(o.settings.autoStart ? "stop" : "start")
            },
            E = function() {
                o.children.each(function() {
                    var e = t(this).find("img:first").attr("title");
                    void 0 != e && ("" + e).length && t(this).append('<div class="bx-caption"><span>' + e + "</span></div>")
                })
            },
            T = function(t) {
                o.settings.auto && r.stopAuto(), r.goToNextSlide(), t.preventDefault()
            },
            k = function(t) {
                o.settings.auto && r.stopAuto(), r.goToPrevSlide(), t.preventDefault()
            },
            j = function(t) {
                r.startAuto(), t.preventDefault()
            },
            M = function(t) {
                r.stopAuto(), t.preventDefault()
            },
            $ = function(e) {
                o.settings.auto && r.stopAuto();
                var i = t(e.currentTarget),
                    n = parseInt(i.attr("data-slide-index"));
                n != o.active.index && r.goToSlide(n), e.preventDefault()
            },
            P = function(e) {
                var i = o.children.length;
                return "short" == o.settings.pagerType ? (o.settings.maxSlides > 1 && (i = Math.ceil(o.children.length / o.settings.maxSlides)), void o.pagerEl.html(e + 1 + o.settings.pagerShortSeparator + i)) : (o.pagerEl.find("a").removeClass("active"), void o.pagerEl.each(function(i, n) {
                    t(n).find("a").eq(e).addClass("active")
                }))
            },
            A = function() {
                if (o.settings.infiniteLoop) {
                    var t = "";
                    0 == o.active.index ? t = o.children.eq(0).position() : o.active.index == v() - 1 && o.carousel ? t = o.children.eq((v() - 1) * y()).position() : o.active.index == o.children.length - 1 && (t = o.children.eq(o.children.length - 1).position()), t && ("horizontal" == o.settings.mode ? x(-t.left, "reset", 0) : "vertical" == o.settings.mode && x(-t.top, "reset", 0))
                }
                o.working = !1, o.settings.onSlideAfter(o.children.eq(o.active.index), o.oldIndex, o.active.index)
            },
            I = function(t) {
                o.settings.autoControlsCombine ? o.controls.autoEl.html(o.controls[t]) : (o.controls.autoEl.find("a").removeClass("active"), o.controls.autoEl.find("a:not(.bx-" + t + ")").addClass("active"))
            },
            D = function() {
                1 == v() ? (o.controls.prev.addClass("disabled"), o.controls.next.addClass("disabled")) : !o.settings.infiniteLoop && o.settings.hideControlOnEnd && (0 == o.active.index ? (o.controls.prev.addClass("disabled"), o.controls.next.removeClass("disabled")) : o.active.index == v() - 1 ? (o.controls.next.addClass("disabled"), o.controls.prev.removeClass("disabled")) : (o.controls.prev.removeClass("disabled"), o.controls.next.removeClass("disabled")))
            },
            z = function() {
                o.settings.autoDelay > 0 ? setTimeout(r.startAuto, o.settings.autoDelay) : r.startAuto(), o.settings.autoHover && r.hover(function() {
                    o.interval && (r.stopAuto(!0), o.autoPaused = !0)
                }, function() {
                    o.autoPaused && (r.startAuto(!0), o.autoPaused = null)
                })
            },
            O = function() {
                var e = 0;
                if ("next" == o.settings.autoDirection) r.append(o.children.clone().addClass("bx-clone"));
                else {
                    r.prepend(o.children.clone().addClass("bx-clone"));
                    var i = o.children.first().position();
                    e = "horizontal" == o.settings.mode ? -i.left : -i.top
                }
                x(e, "reset", 0), o.settings.pager = !1, o.settings.controls = !1, o.settings.autoControls = !1, o.settings.tickerHover && !o.usingCSS && o.viewport.hover(function() {
                    r.stop()
                }, function() {
                    var e = 0;
                    o.children.each(function() {
                        e += "horizontal" == o.settings.mode ? t(this).outerWidth(!0) : t(this).outerHeight(!0)
                    });
                    var i = o.settings.speed / e,
                        n = "horizontal" == o.settings.mode ? "left" : "top",
                        s = i * (e - Math.abs(parseInt(r.css(n))));
                    Q(s)
                }), Q()
            },
            Q = function(t) {
                speed = t ? t : o.settings.speed;
                var e = {
                        left: 0,
                        top: 0
                    },
                    i = {
                        left: 0,
                        top: 0
                    };
                "next" == o.settings.autoDirection ? e = r.find(".bx-clone").first().position() : i = o.children.first().position();
                var n = "horizontal" == o.settings.mode ? -e.left : -e.top,
                    s = "horizontal" == o.settings.mode ? -i.left : -i.top,
                    a = {
                        resetValue: s
                    };
                x(n, "ticker", speed, a)
            },
            L = function() {
                o.touch = {
                    start: {
                        x: 0,
                        y: 0
                    },
                    end: {
                        x: 0,
                        y: 0
                    }
                }, o.viewport.bind("touchstart", W)
            },
            W = function(t) {
                if (o.working) t.preventDefault();
                else {
                    o.touch.originalPos = r.position();
                    var e = t.originalEvent;
                    o.touch.start.x = e.changedTouches[0].pageX, o.touch.start.y = e.changedTouches[0].pageY, o.viewport.bind("touchmove", H), o.viewport.bind("touchend", R)
                }
            },
            H = function(t) {
                var e = t.originalEvent,
                    i = Math.abs(e.changedTouches[0].pageX - o.touch.start.x),
                    n = Math.abs(e.changedTouches[0].pageY - o.touch.start.y);
                if (3 * i > n && o.settings.preventDefaultSwipeX ? t.preventDefault() : 3 * n > i && o.settings.preventDefaultSwipeY && t.preventDefault(), "fade" != o.settings.mode && o.settings.oneToOneTouch) {
                    var s = 0;
                    if ("horizontal" == o.settings.mode) {
                        var r = e.changedTouches[0].pageX - o.touch.start.x;
                        s = o.touch.originalPos.left + r
                    } else {
                        var r = e.changedTouches[0].pageY - o.touch.start.y;
                        s = o.touch.originalPos.top + r
                    }
                    x(s, "reset", 0)
                }
            },
            R = function(t) {
                o.viewport.unbind("touchmove", H);
                var e = t.originalEvent,
                    i = 0;
                if (o.touch.end.x = e.changedTouches[0].pageX, o.touch.end.y = e.changedTouches[0].pageY, "fade" == o.settings.mode) {
                    var n = Math.abs(o.touch.start.x - o.touch.end.x);
                    n >= o.settings.swipeThreshold && (o.touch.start.x > o.touch.end.x ? r.goToNextSlide() : r.goToPrevSlide(), r.stopAuto())
                } else {
                    var n = 0;
                    "horizontal" == o.settings.mode ? (n = o.touch.end.x - o.touch.start.x, i = o.touch.originalPos.left) : (n = o.touch.end.y - o.touch.start.y, i = o.touch.originalPos.top), !o.settings.infiniteLoop && (0 == o.active.index && n > 0 || o.active.last && 0 > n) ? x(i, "reset", 200) : Math.abs(n) >= o.settings.swipeThreshold ? (0 > n ? r.goToNextSlide() : r.goToPrevSlide(), r.stopAuto()) : x(i, "reset", 200)
                }
                o.viewport.unbind("touchend", R)
            },
            X = function() {
                var e = t(window).width(),
                    i = t(window).height();
                (a != e || l != i) && (a = e, l = i, r.redrawSlider(), o.settings.onSliderResize.call(r, o.active.index))
            };
        return r.goToSlide = function(e, i) {
            if (!o.working && o.active.index != e)
                if (o.working = !0, o.oldIndex = o.active.index, o.active.index = 0 > e ? v() - 1 : e >= v() ? 0 : e, o.settings.onSlideBefore(o.children.eq(o.active.index), o.oldIndex, o.active.index), "next" == i ? o.settings.onSlideNext(o.children.eq(o.active.index), o.oldIndex, o.active.index) : "prev" == i && o.settings.onSlidePrev(o.children.eq(o.active.index), o.oldIndex, o.active.index), o.active.last = o.active.index >= v() - 1, o.settings.pager && P(o.active.index), o.settings.controls && D(), "fade" == o.settings.mode) o.settings.adaptiveHeight && o.viewport.height() != p() && o.viewport.animate({
                    height: p()
                }, o.settings.adaptiveHeightSpeed), o.children.filter(":visible").fadeOut(o.settings.speed).css({
                    zIndex: 0
                }), o.children.eq(o.active.index).css("zIndex", o.settings.slideZIndex + 1).fadeIn(o.settings.speed, function() {
                    t(this).css("zIndex", o.settings.slideZIndex), A()
                });
                else {
                    o.settings.adaptiveHeight && o.viewport.height() != p() && o.viewport.animate({
                        height: p()
                    }, o.settings.adaptiveHeightSpeed);
                    var n = 0,
                        s = {
                            left: 0,
                            top: 0
                        };
                    if (!o.settings.infiniteLoop && o.carousel && o.active.last)
                        if ("horizontal" == o.settings.mode) {
                            var a = o.children.eq(o.children.length - 1);
                            s = a.position(), n = o.viewport.width() - a.outerWidth()
                        } else {
                            var l = o.children.length - o.settings.minSlides;
                            s = o.children.eq(l).position()
                        } else if (o.carousel && o.active.last && "prev" == i) {
                        var h = 1 == o.settings.moveSlides ? o.settings.maxSlides - y() : (v() - 1) * y() - (o.children.length - o.settings.maxSlides),
                            a = r.children(".bx-clone").eq(h);
                        s = a.position()
                    } else if ("next" == i && 0 == o.active.index) s = r.find("> .bx-clone").eq(o.settings.maxSlides).position(), o.active.last = !1;
                    else if (e >= 0) {
                        var c = e * y();
                        s = o.children.eq(c).position()
                    }
                    if ("undefined" != typeof s) {
                        var d = "horizontal" == o.settings.mode ? -(s.left - n) : -s.top;
                        x(d, "slide", o.settings.speed)
                    }
                }
        }, r.goToNextSlide = function() {
            if (o.settings.infiniteLoop || !o.active.last) {
                var t = parseInt(o.active.index) + 1;
                r.goToSlide(t, "next")
            }
        }, r.goToPrevSlide = function() {
            if (o.settings.infiniteLoop || 0 != o.active.index) {
                var t = parseInt(o.active.index) - 1;
                r.goToSlide(t, "prev")
            }
        }, r.startAuto = function(t) {
            o.interval || (o.interval = setInterval(function() {
                "next" == o.settings.autoDirection ? r.goToNextSlide() : r.goToPrevSlide()
            }, o.settings.pause), o.settings.autoControls && 1 != t && I("stop"))
        }, r.stopAuto = function(t) {
            o.interval && (clearInterval(o.interval), o.interval = null, o.settings.autoControls && 1 != t && I("start"))
        }, r.getCurrentSlide = function() {
            return o.active.index
        }, r.getCurrentSlideElement = function() {
            return o.children.eq(o.active.index)
        }, r.getSlideCount = function() {
            return o.children.length
        }, r.redrawSlider = function() {
            o.children.add(r.find(".bx-clone")).outerWidth(f()), o.viewport.css("height", p()), o.settings.ticker || w(), o.active.last && (o.active.index = v() - 1), o.active.index >= v() && (o.active.last = !0), o.settings.pager && !o.settings.pagerCustom && (b(), P(o.active.index))
        }, r.destroySlider = function() {
            o.initialized && (o.initialized = !1, t(".bx-clone", this).remove(), o.children.each(function() {
                void 0 != t(this).data("origStyle") ? t(this).attr("style", t(this).data("origStyle")) : t(this).removeAttr("style")
            }), void 0 != t(this).data("origStyle") ? this.attr("style", t(this).data("origStyle")) : t(this).removeAttr("style"), t(this).unwrap().unwrap(), o.controls.el && o.controls.el.remove(), o.controls.next && o.controls.next.remove(), o.controls.prev && o.controls.prev.remove(), o.pagerEl && o.settings.controls && o.pagerEl.remove(), t(".bx-caption", this).remove(), o.controls.autoEl && o.controls.autoEl.remove(), clearInterval(o.interval), o.settings.responsive && t(window).unbind("resize", X))
        }, r.reloadSlider = function(t) {
            void 0 != t && (s = t), r.destroySlider(), h()
        }, h(), this
    }
}(jQuery), jQuery.easing.jswing = jQuery.easing.swing, jQuery.extend(jQuery.easing, {
        def: "easeOutQuad",
        swing: function(t, e, i, n, s) {
            return jQuery.easing[jQuery.easing.def](t, e, i, n, s)
        },
        easeInQuad: function(t, e, i, n, s) {
            return n * (e /= s) * e + i
        },
        easeOutQuad: function(t, e, i, n, s) {
            return -n * (e /= s) * (e - 2) + i
        },
        easeInOutQuad: function(t, e, i, n, s) {
            return (e /= s / 2) < 1 ? n / 2 * e * e + i : -n / 2 * (--e * (e - 2) - 1) + i
        },
        easeInCubic: function(t, e, i, n, s) {
            return n * (e /= s) * e * e + i
        },
        easeOutCubic: function(t, e, i, n, s) {
            return n * ((e = e / s - 1) * e * e + 1) + i
        },
        easeInOutCubic: function(t, e, i, n, s) {
            return (e /= s / 2) < 1 ? n / 2 * e * e * e + i : n / 2 * ((e -= 2) * e * e + 2) + i
        },
        easeInQuart: function(t, e, i, n, s) {
            return n * (e /= s) * e * e * e + i
        },
        easeOutQuart: function(t, e, i, n, s) {
            return -n * ((e = e / s - 1) * e * e * e - 1) + i
        },
        easeInOutQuart: function(t, e, i, n, s) {
            return (e /= s / 2) < 1 ? n / 2 * e * e * e * e + i : -n / 2 * ((e -= 2) * e * e * e - 2) + i
        },
        easeInQuint: function(t, e, i, n, s) {
            return n * (e /= s) * e * e * e * e + i
        },
        easeOutQuint: function(t, e, i, n, s) {
            return n * ((e = e / s - 1) * e * e * e * e + 1) + i
        },
        easeInOutQuint: function(t, e, i, n, s) {
            return (e /= s / 2) < 1 ? n / 2 * e * e * e * e * e + i : n / 2 * ((e -= 2) * e * e * e * e + 2) + i
        },
        easeInSine: function(t, e, i, n, s) {
            return -n * Math.cos(e / s * (Math.PI / 2)) + n + i
        },
        easeOutSine: function(t, e, i, n, s) {
            return n * Math.sin(e / s * (Math.PI / 2)) + i
        },
        easeInOutSine: function(t, e, i, n, s) {
            return -n / 2 * (Math.cos(Math.PI * e / s) - 1) + i
        },
        easeInExpo: function(t, e, i, n, s) {
            return 0 == e ? i : n * Math.pow(2, 10 * (e / s - 1)) + i
        },
        easeOutExpo: function(t, e, i, n, s) {
            return e == s ? i + n : n * (-Math.pow(2, -10 * e / s) + 1) + i
        },
        easeInOutExpo: function(t, e, i, n, s) {
            return 0 == e ? i : e == s ? i + n : (e /= s / 2) < 1 ? n / 2 * Math.pow(2, 10 * (e - 1)) + i : n / 2 * (-Math.pow(2, -10 * --e) + 2) + i
        },
        easeInCirc: function(t, e, i, n, s) {
            return -n * (Math.sqrt(1 - (e /= s) * e) - 1) + i
        },
        easeOutCirc: function(t, e, i, n, s) {
            return n * Math.sqrt(1 - (e = e / s - 1) * e) + i
        },
        easeInOutCirc: function(t, e, i, n, s) {
            return (e /= s / 2) < 1 ? -n / 2 * (Math.sqrt(1 - e * e) - 1) + i : n / 2 * (Math.sqrt(1 - (e -= 2) * e) + 1) + i
        },
        easeInElastic: function(t, e, i, n, s) {
            var o = 1.70158,
                r = 0,
                a = n;
            if (0 == e) return i;
            if (1 == (e /= s)) return i + n;
            if (r || (r = .3 * s), a < Math.abs(n)) {
                a = n;
                var o = r / 4
            } else var o = r / (2 * Math.PI) * Math.asin(n / a);
            return -(a * Math.pow(2, 10 * (e -= 1)) * Math.sin(2 * (e * s - o) * Math.PI / r)) + i
        },
        easeOutElastic: function(t, e, i, n, s) {
            var o = 1.70158,
                r = 0,
                a = n;
            if (0 == e) return i;
            if (1 == (e /= s)) return i + n;
            if (r || (r = .3 * s), a < Math.abs(n)) {
                a = n;
                var o = r / 4
            } else var o = r / (2 * Math.PI) * Math.asin(n / a);
            return a * Math.pow(2, -10 * e) * Math.sin(2 * (e * s - o) * Math.PI / r) + n + i
        },
        easeInOutElastic: function(t, e, i, n, s) {
            var o = 1.70158,
                r = 0,
                a = n;
            if (0 == e) return i;
            if (2 == (e /= s / 2)) return i + n;
            if (r || (r = .3 * s * 1.5), a < Math.abs(n)) {
                a = n;
                var o = r / 4
            } else var o = r / (2 * Math.PI) * Math.asin(n / a);
            return 1 > e ? -.5 * a * Math.pow(2, 10 * (e -= 1)) * Math.sin(2 * (e * s - o) * Math.PI / r) + i : a * Math.pow(2, -10 * (e -= 1)) * Math.sin(2 * (e * s - o) * Math.PI / r) * .5 + n + i
        },
        easeInBack: function(t, e, i, n, s, o) {
            return void 0 == o && (o = 1.70158), n * (e /= s) * e * ((o + 1) * e - o) + i
        },
        easeOutBack: function(t, e, i, n, s, o) {
            return void 0 == o && (o = 1.70158), n * ((e = e / s - 1) * e * ((o + 1) * e + o) + 1) + i
        },
        easeInOutBack: function(t, e, i, n, s, o) {
            return void 0 == o && (o = 1.70158), (e /= s / 2) < 1 ? n / 2 * e * e * (((o *= 1.525) + 1) * e - o) + i : n / 2 * ((e -= 2) * e * (((o *= 1.525) + 1) * e + o) + 2) + i
        },
        easeInBounce: function(t, e, i, n, s) {
            return n - jQuery.easing.easeOutBounce(t, s - e, 0, n, s) + i
        },
        easeOutBounce: function(t, e, i, n, s) {
            return (e /= s) < 1 / 2.75 ? 7.5625 * n * e * e + i : 2 / 2.75 > e ? n * (7.5625 * (e -= 1.5 / 2.75) * e + .75) + i : 2.5 / 2.75 > e ? n * (7.5625 * (e -= 2.25 / 2.75) * e + .9375) + i : n * (7.5625 * (e -= 2.625 / 2.75) * e + .984375) + i
        },
        easeInOutBounce: function(t, e, i, n, s) {
            return s / 2 > e ? .5 * jQuery.easing.easeInBounce(t, 2 * e, 0, n, s) + i : .5 * jQuery.easing.easeOutBounce(t, 2 * e - s, 0, n, s) + .5 * n + i
        }
    }), ! function(t, e, i, n) {
        var s = t(e);
        t.fn.lazyload = function(o) {
            function r() {
                var e = 0;
                l.each(function() {
                    var i = t(this);
                    if (!h.skip_invisible || i.is(":visible"))
                        if (t.abovethetop(this, h) || t.leftofbegin(this, h));
                        else if (t.belowthefold(this, h) || t.rightoffold(this, h)) {
                        if (++e > h.failure_limit) return !1
                    } else i.trigger("appear"), e = 0
                })
            }
            var a, l = this,
                h = {
                    threshold: 0,
                    failure_limit: 0,
                    event: "scroll",
                    effect: "show",
                    container: e,
                    data_attribute: "original",
                    skip_invisible: !0,
                    appear: null,
                    load: null,
                    placeholder: "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC"
                };
            return o && (n !== o.failurelimit && (o.failure_limit = o.failurelimit, delete o.failurelimit), n !== o.effectspeed && (o.effect_speed = o.effectspeed, delete o.effectspeed), t.extend(h, o)), a = h.container === n || h.container === e ? s : t(h.container), 0 === h.event.indexOf("scroll") && a.bind(h.event, function() {
                return r()
            }), this.each(function() {
                var e = this,
                    i = t(e);
                e.loaded = !1, (i.attr("src") === n || i.attr("src") === !1) && i.is("img") && i.attr("src", h.placeholder), i.one("appear", function() {
                    if (!this.loaded) {
                        if (h.appear) {
                            var n = l.length;
                            h.appear.call(e, n, h)
                        }
                        t("<img />").bind("load", function() {
                            var n = i.attr("data-" + h.data_attribute);
                            i.hide(), i.is("img") ? i.attr("src", n) : i.css("background-image", "url('" + n + "')"), i[h.effect](h.effect_speed), e.loaded = !0;
                            var s = t.grep(l, function(t) {
                                return !t.loaded
                            });
                            if (l = t(s), h.load) {
                                var o = l.length;
                                h.load.call(e, o, h)
                            }
                        }).attr("src", i.attr("data-" + h.data_attribute))
                    }
                }), 0 !== h.event.indexOf("scroll") && i.bind(h.event, function() {
                    e.loaded || i.trigger("appear")
                })
            }), s.bind("resize", function() {
                r()
            }), /(?:iphone|ipod|ipad).*os 5/gi.test(navigator.appVersion) && s.bind("pageshow", function(e) {
                e.originalEvent && e.originalEvent.persisted && l.each(function() {
                    t(this).trigger("appear")
                })
            }), t(i).ready(function() {
                r()
            }), this
        }, t.belowthefold = function(i, o) {
            var r;
            return r = o.container === n || o.container === e ? (e.innerHeight ? e.innerHeight : s.height()) + s.scrollTop() : t(o.container).offset().top + t(o.container).height(), r <= t(i).offset().top - o.threshold
        }, t.rightoffold = function(i, o) {
            var r;
            return r = o.container === n || o.container === e ? s.width() + s.scrollLeft() : t(o.container).offset().left + t(o.container).width(), r <= t(i).offset().left - o.threshold
        }, t.abovethetop = function(i, o) {
            var r;
            return r = o.container === n || o.container === e ? s.scrollTop() : t(o.container).offset().top, r >= t(i).offset().top + o.threshold + t(i).height()
        }, t.leftofbegin = function(i, o) {
            var r;
            return r = o.container === n || o.container === e ? s.scrollLeft() : t(o.container).offset().left, r >= t(i).offset().left + o.threshold + t(i).width()
        }, t.inviewport = function(e, i) {
            return !(t.rightoffold(e, i) || t.leftofbegin(e, i) || t.belowthefold(e, i) || t.abovethetop(e, i))
        }, t.extend(t.expr[":"], {
            "below-the-fold": function(e) {
                return t.belowthefold(e, {
                    threshold: 0
                })
            },
            "above-the-top": function(e) {
                return !t.belowthefold(e, {
                    threshold: 0
                })
            },
            "right-of-screen": function(e) {
                return t.rightoffold(e, {
                    threshold: 0
                })
            },
            "left-of-screen": function(e) {
                return !t.rightoffold(e, {
                    threshold: 0
                })
            },
            "in-viewport": function(e) {
                return t.inviewport(e, {
                    threshold: 0
                })
            },
            "above-the-fold": function(e) {
                return !t.belowthefold(e, {
                    threshold: 0
                })
            },
            "right-of-fold": function(e) {
                return t.rightoffold(e, {
                    threshold: 0
                })
            },
            "left-of-fold": function(e) {
                return !t.rightoffold(e, {
                    threshold: 0
                })
            }
        })
    }(jQuery, window, document),
    function(t) {
        function e(e) {
            var i = e || window.event,
                n = [].slice.call(arguments, 1),
                s = 0,
                o = 0,
                r = 0;
            return e = t.event.fix(i), e.type = "mousewheel", i.wheelDelta && (s = i.wheelDelta / 120), i.detail && (s = -i.detail / 3), r = s, void 0 !== i.axis && i.axis === i.HORIZONTAL_AXIS && (r = 0, o = -1 * s), void 0 !== i.wheelDeltaY && (r = i.wheelDeltaY / 120), void 0 !== i.wheelDeltaX && (o = -1 * i.wheelDeltaX / 120), n.unshift(e, s, o, r), (t.event.dispatch || t.event.handle).apply(this, n)
        }
        var i = ["DOMMouseScroll", "mousewheel"];
        if (t.event.fixHooks)
            for (var n = i.length; n;) t.event.fixHooks[i[--n]] = t.event.mouseHooks;
        t.event.special.mousewheel = {
            setup: function() {
                if (this.addEventListener)
                    for (var t = i.length; t;) this.addEventListener(i[--t], e, !1);
                else this.onmousewheel = e
            },
            teardown: function() {
                if (this.removeEventListener)
                    for (var t = i.length; t;) this.removeEventListener(i[--t], e, !1);
                else this.onmousewheel = null
            }
        }, t.fn.extend({
            mousewheel: function(t) {
                return t ? this.bind("mousewheel", t) : this.trigger("mousewheel")
            },
            unmousewheel: function(t) {
                return this.unbind("mousewheel", t)
            }
        })
    }(jQuery), ! function(t, e, i, n) {
        "use strict";
        var s = i("html"),
            o = i(t),
            r = i(e),
            a = i.fancybox = function() {
                a.open.apply(this, arguments)
            },
            l = navigator.userAgent.match(/msie/i),
            h = null,
            c = e.createTouch !== n,
            d = function(t) {
                return t && t.hasOwnProperty && t instanceof i
            },
            u = function(t) {
                return t && "string" === i.type(t)
            },
            p = function(t) {
                return u(t) && t.indexOf("%") > 0
            },
            g = function(t) {
                return t && !(t.style.overflow && "hidden" === t.style.overflow) && (t.clientWidth && t.scrollWidth > t.clientWidth || t.clientHeight && t.scrollHeight > t.clientHeight)
            },
            f = function(t, e) {
                var i = parseInt(t, 10) || 0;
                return e && p(t) && (i = a.getViewport()[e] / 100 * i), Math.ceil(i)
            },
            m = function(t, e) {
                return f(t, e) + "px"
            };
        i.extend(a, {
            version: "2.1.5",
            defaults: {
                padding: 15,
                margin: 20,
                width: 800,
                height: 600,
                minWidth: 100,
                minHeight: 100,
                maxWidth: 9999,
                maxHeight: 9999,
                pixelRatio: 1,
                autoSize: !0,
                autoHeight: !1,
                autoWidth: !1,
                autoResize: !0,
                autoCenter: !c,
                fitToView: !0,
                aspectRatio: !1,
                topRatio: .5,
                leftRatio: .5,
                scrolling: "auto",
                wrapCSS: "",
                arrows: !0,
                closeBtn: !0,
                closeClick: !1,
                nextClick: !1,
                mouseWheel: !0,
                autoPlay: !1,
                playSpeed: 3e3,
                preload: 3,
                modal: !1,
                loop: !0,
                ajax: {
                    dataType: "html",
                    headers: {
                        "X-fancyBox": !0
                    }
                },
                iframe: {
                    scrolling: "auto",
                    preload: !0
                },
                swf: {
                    wmode: "transparent",
                    allowfullscreen: "true",
                    allowscriptaccess: "always"
                },
                keys: {
                    next: {
                        13: "left",
                        34: "up",
                        39: "left",
                        40: "up"
                    },
                    prev: {
                        8: "right",
                        33: "down",
                        37: "right",
                        38: "down"
                    },
                    close: [27],
                    play: [32],
                    toggle: [70]
                },
                direction: {
                    next: "left",
                    prev: "right"
                },
                scrollOutside: !0,
                index: 0,
                type: null,
                href: null,
                content: null,
                title: null,
                tpl: {
                    wrap: '<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',
                    image: '<img class="fancybox-image" src="{href}" alt="" />',
                    iframe: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen' + (l ? ' allowtransparency="true"' : "") + "></iframe>",
                    error: '<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',
                    closeBtn: '<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',
                    next: '<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',
                    prev: '<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'
                },
                openEffect: "fade",
                openSpeed: 250,
                openEasing: "swing",
                openOpacity: !0,
                openMethod: "zoomIn",
                closeEffect: "fade",
                closeSpeed: 250,
                closeEasing: "swing",
                closeOpacity: !0,
                closeMethod: "zoomOut",
                nextEffect: "elastic",
                nextSpeed: 250,
                nextEasing: "swing",
                nextMethod: "changeIn",
                prevEffect: "elastic",
                prevSpeed: 250,
                prevEasing: "swing",
                prevMethod: "changeOut",
                helpers: {
                    overlay: !0,
                    title: !0
                },
                onCancel: i.noop,
                beforeLoad: i.noop,
                afterLoad: i.noop,
                beforeShow: i.noop,
                afterShow: i.noop,
                beforeChange: i.noop,
                beforeClose: i.noop,
                afterClose: i.noop
            },
            group: {},
            opts: {},
            previous: null,
            coming: null,
            current: null,
            isActive: !1,
            isOpen: !1,
            isOpened: !1,
            wrap: null,
            skin: null,
            outer: null,
            inner: null,
            player: {
                timer: null,
                isActive: !1
            },
            ajaxLoad: null,
            imgPreload: null,
            transitions: {},
            helpers: {},
            open: function(t, e) {
                return t && (i.isPlainObject(e) || (e = {}), !1 !== a.close(!0)) ? (i.isArray(t) || (t = d(t) ? i(t).get() : [t]), i.each(t, function(s, o) {
                    var r, l, h, c, p, g, f, m = {};
                    "object" === i.type(o) && (o.nodeType && (o = i(o)), d(o) ? (m = {
                        href: o.data("fancybox-href") || o.attr("href"),
                        title: o.data("fancybox-title") || o.attr("title"),
                        isDom: !0,
                        element: o
                    }, i.metadata && i.extend(!0, m, o.metadata())) : m = o), r = e.href || m.href || (u(o) ? o : null), l = e.title !== n ? e.title : m.title || "", h = e.content || m.content, c = h ? "html" : e.type || m.type, !c && m.isDom && (c = o.data("fancybox-type"), c || (p = o.prop("class").match(/fancybox\.(\w+)/), c = p ? p[1] : null)), u(r) && (c || (a.isImage(r) ? c = "image" : a.isSWF(r) ? c = "swf" : "#" === r.charAt(0) ? c = "inline" : u(o) && (c = "html", h = o)), "ajax" === c && (g = r.split(/\s+/, 2), r = g.shift(), f = g.shift())), h || ("inline" === c ? r ? h = i(u(r) ? r.replace(/.*(?=#[^\s]+$)/, "") : r) : m.isDom && (h = o) : "html" === c ? h = r : c || r || !m.isDom || (c = "inline", h = o)), i.extend(m, {
                        href: r,
                        type: c,
                        content: h,
                        title: l,
                        selector: f
                    }), t[s] = m
                }), a.opts = i.extend(!0, {}, a.defaults, e), e.keys !== n && (a.opts.keys = e.keys ? i.extend({}, a.defaults.keys, e.keys) : !1), a.group = t, a._start(a.opts.index)) : void 0
            },
            cancel: function() {
                var t = a.coming;
                t && !1 !== a.trigger("onCancel") && (a.hideLoading(), a.ajaxLoad && a.ajaxLoad.abort(), a.ajaxLoad = null, a.imgPreload && (a.imgPreload.onload = a.imgPreload.onerror = null), t.wrap && t.wrap.stop(!0, !0).trigger("onReset").remove(), a.coming = null, a.current || a._afterZoomOut(t))
            },
            close: function(t) {
                a.cancel(), !1 !== a.trigger("beforeClose") && (a.unbindEvents(), a.isActive && (a.isOpen && t !== !0 ? (a.isOpen = a.isOpened = !1, a.isClosing = !0, i(".fancybox-item, .fancybox-nav").remove(), a.wrap.stop(!0, !0).removeClass("fancybox-opened"), a.transitions[a.current.closeMethod]()) : (i(".fancybox-wrap").stop(!0).trigger("onReset").remove(), a._afterZoomOut())))
            },
            play: function(t) {
                var e = function() {
                        clearTimeout(a.player.timer)
                    },
                    i = function() {
                        e(), a.current && a.player.isActive && (a.player.timer = setTimeout(a.next, a.current.playSpeed))
                    },
                    n = function() {
                        e(), r.unbind(".player"), a.player.isActive = !1, a.trigger("onPlayEnd")
                    },
                    s = function() {
                        a.current && (a.current.loop || a.current.index < a.group.length - 1) && (a.player.isActive = !0, r.bind({
                            "onCancel.player beforeClose.player": n,
                            "onUpdate.player": i,
                            "beforeLoad.player": e
                        }), i(), a.trigger("onPlayStart"))
                    };
                t === !0 || !a.player.isActive && t !== !1 ? s() : n()
            },
            next: function(t) {
                var e = a.current;
                e && (u(t) || (t = e.direction.next), a.jumpto(e.index + 1, t, "next"))
            },
            prev: function(t) {
                var e = a.current;
                e && (u(t) || (t = e.direction.prev), a.jumpto(e.index - 1, t, "prev"))
            },
            jumpto: function(t, e, i) {
                var s = a.current;
                s && (t = f(t), a.direction = e || s.direction[t >= s.index ? "next" : "prev"], a.router = i || "jumpto", s.loop && (0 > t && (t = s.group.length + t % s.group.length), t %= s.group.length), s.group[t] !== n && (a.cancel(), a._start(t)))
            },
            reposition: function(t, e) {
                var n, s = a.current,
                    o = s ? s.wrap : null;
                o && (n = a._getPosition(e), t && "scroll" === t.type ? (delete n.position, o.stop(!0, !0).animate(n, 200)) : (o.css(n), s.pos = i.extend({}, s.dim, n)))
            },
            update: function(t) {
                var e = t && t.type,
                    i = !e || "orientationchange" === e;
                i && (clearTimeout(h), h = null), a.isOpen && !h && (h = setTimeout(function() {
                    var n = a.current;
                    n && !a.isClosing && (a.wrap.removeClass("fancybox-tmp"), (i || "load" === e || "resize" === e && n.autoResize) && a._setDimension(), "scroll" === e && n.canShrink || a.reposition(t), a.trigger("onUpdate"), h = null)
                }, i && !c ? 0 : 300))
            },
            toggle: function(t) {
                a.isOpen && (a.current.fitToView = "boolean" === i.type(t) ? t : !a.current.fitToView, c && (a.wrap.removeAttr("style").addClass("fancybox-tmp"), a.trigger("onUpdate")), a.update())
            },
            hideLoading: function() {
                r.unbind(".loading"), i("#fancybox-loading").remove()
            },
            showLoading: function() {
                var t, e;
                a.hideLoading(), t = i('<div id="fancybox-loading"><div></div></div>').click(a.cancel).appendTo("body"), r.bind("keydown.loading", function(t) {
                    27 === (t.which || t.keyCode) && (t.preventDefault(), a.cancel())
                }), a.defaults.fixed || (e = a.getViewport(), t.css({
                    position: "absolute",
                    top: .5 * e.h + e.y,
                    left: .5 * e.w + e.x
                }))
            },
            getViewport: function() {
                var e = a.current && a.current.locked || !1,
                    i = {
                        x: o.scrollLeft(),
                        y: o.scrollTop()
                    };
                return e ? (i.w = e[0].clientWidth, i.h = e[0].clientHeight) : (i.w = c && t.innerWidth ? t.innerWidth : o.width(), i.h = c && t.innerHeight ? t.innerHeight : o.height()), i
            },
            unbindEvents: function() {
                a.wrap && d(a.wrap) && a.wrap.unbind(".fb"), r.unbind(".fb"), o.unbind(".fb")
            },
            bindEvents: function() {
                var t, e = a.current;
                e && (o.bind("orientationchange.fb" + (c ? "" : " resize.fb") + (e.autoCenter && !e.locked ? " scroll.fb" : ""), a.update), t = e.keys, t && r.bind("keydown.fb", function(s) {
                    var o = s.which || s.keyCode,
                        r = s.target || s.srcElement;
                    return 27 === o && a.coming ? !1 : void(s.ctrlKey || s.altKey || s.shiftKey || s.metaKey || r && (r.type || i(r).is("[contenteditable]")) || i.each(t, function(t, r) {
                        return e.group.length > 1 && r[o] !== n ? (a[t](r[o]), s.preventDefault(), !1) : i.inArray(o, r) > -1 ? (a[t](), s.preventDefault(), !1) : void 0
                    }))
                }), i.fn.mousewheel && e.mouseWheel && a.wrap.bind("mousewheel.fb", function(t, n, s, o) {
                    for (var r = t.target || null, l = i(r), h = !1; l.length && !(h || l.is(".fancybox-skin") || l.is(".fancybox-wrap"));) h = g(l[0]), l = i(l).parent();
                    0 === n || h || a.group.length > 1 && !e.canShrink && (o > 0 || s > 0 ? a.prev(o > 0 ? "down" : "left") : (0 > o || 0 > s) && a.next(0 > o ? "up" : "right"), t.preventDefault())
                }))
            },
            trigger: function(t, e) {
                var n, s = e || a.coming || a.current;
                if (s) {
                    if (i.isFunction(s[t]) && (n = s[t].apply(s, Array.prototype.slice.call(arguments, 1))), n === !1) return !1;
                    s.helpers && i.each(s.helpers, function(e, n) {
                        n && a.helpers[e] && i.isFunction(a.helpers[e][t]) && a.helpers[e][t](i.extend(!0, {}, a.helpers[e].defaults, n), s)
                    }), r.trigger(t)
                }
            },
            isImage: function(t) {
                return u(t) && t.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp|svg)((\?|#).*)?$)/i)
            },
            isSWF: function(t) {
                return u(t) && t.match(/\.(swf)((\?|#).*)?$/i)
            },
            _start: function(t) {
                var e, n, s, o, r, l = {};
                if (t = f(t), e = a.group[t] || null, !e) return !1;
                if (l = i.extend(!0, {}, a.opts, e), o = l.margin, r = l.padding, "number" === i.type(o) && (l.margin = [o, o, o, o]), "number" === i.type(r) && (l.padding = [r, r, r, r]), l.modal && i.extend(!0, l, {
                        closeBtn: !1,
                        closeClick: !1,
                        nextClick: !1,
                        arrows: !1,
                        mouseWheel: !1,
                        keys: null,
                        helpers: {
                            overlay: {
                                closeClick: !1
                            }
                        }
                    }), l.autoSize && (l.autoWidth = l.autoHeight = !0), "auto" === l.width && (l.autoWidth = !0), "auto" === l.height && (l.autoHeight = !0), l.group = a.group, l.index = t, a.coming = l, !1 === a.trigger("beforeLoad")) return void(a.coming = null);
                if (s = l.type, n = l.href, !s) return a.coming = null, a.current && a.router && "jumpto" !== a.router ? (a.current.index = t, a[a.router](a.direction)) : !1;
                if (a.isActive = !0, ("image" === s || "swf" === s) && (l.autoHeight = l.autoWidth = !1, l.scrolling = "visible"), "image" === s && (l.aspectRatio = !0), "iframe" === s && c && (l.scrolling = "scroll"), l.wrap = i(l.tpl.wrap).addClass("fancybox-" + (c ? "mobile" : "desktop") + " fancybox-type-" + s + " fancybox-tmp " + l.wrapCSS).appendTo(l.parent || "body"), i.extend(l, {
                        skin: i(".fancybox-skin", l.wrap),
                        outer: i(".fancybox-outer", l.wrap),
                        inner: i(".fancybox-inner", l.wrap)
                    }), i.each(["Top", "Right", "Bottom", "Left"], function(t, e) {
                        l.skin.css("padding" + e, m(l.padding[t]))
                    }), a.trigger("onReady"), "inline" === s || "html" === s) {
                    if (!l.content || !l.content.length) return a._error("content")
                } else if (!n) return a._error("href");
                "image" === s ? a._loadImage() : "ajax" === s ? a._loadAjax() : "iframe" === s ? a._loadIframe() : a._afterLoad()
            },
            _error: function(t) {
                i.extend(a.coming, {
                    type: "html",
                    autoWidth: !0,
                    autoHeight: !0,
                    minWidth: 0,
                    minHeight: 0,
                    scrolling: "no",
                    hasError: t,
                    content: a.coming.tpl.error
                }), a._afterLoad()
            },
            _loadImage: function() {
                var t = a.imgPreload = new Image;
                t.onload = function() {
                    this.onload = this.onerror = null, a.coming.width = this.width / a.opts.pixelRatio, a.coming.height = this.height / a.opts.pixelRatio, a._afterLoad()
                }, t.onerror = function() {
                    this.onload = this.onerror = null, a._error("image")
                }, t.src = a.coming.href, t.complete !== !0 && a.showLoading()
            },
            _loadAjax: function() {
                var t = a.coming;
                a.showLoading(), a.ajaxLoad = i.ajax(i.extend({}, t.ajax, {
                    url: t.href,
                    error: function(t, e) {
                        a.coming && "abort" !== e ? a._error("ajax", t) : a.hideLoading()
                    },
                    success: function(e, i) {
                        "success" === i && (t.content = e, a._afterLoad())
                    }
                }))
            },
            _loadIframe: function() {
                var t = a.coming,
                    e = i(t.tpl.iframe.replace(/\{rnd\}/g, (new Date).getTime())).attr("scrolling", c ? "auto" : t.iframe.scrolling).attr("src", t.href);
                i(t.wrap).bind("onReset", function() {
                    try {
                        i(this).find("iframe").hide().attr("src", "//about:blank").end().empty()
                    } catch (t) {}
                }), t.iframe.preload && (a.showLoading(), e.one("load", function() {
                    i(this).data("ready", 1), c || i(this).bind("load.fb", a.update), i(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show(), a._afterLoad()
                })), t.content = e.appendTo(t.inner), t.iframe.preload || a._afterLoad()
            },
            _preloadImages: function() {
                var t, e, i = a.group,
                    n = a.current,
                    s = i.length,
                    o = n.preload ? Math.min(n.preload, s - 1) : 0;
                for (e = 1; o >= e; e += 1) t = i[(n.index + e) % s], "image" === t.type && t.href && ((new Image).src = t.href)
            },
            _afterLoad: function() {
                var t, e, n, s, o, r, l = a.coming,
                    h = a.current,
                    c = "fancybox-placeholder";
                if (a.hideLoading(), l && a.isActive !== !1) {
                    if (!1 === a.trigger("afterLoad", l, h)) return l.wrap.stop(!0).trigger("onReset").remove(), void(a.coming = null);
                    switch (h && (a.trigger("beforeChange", h), h.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove()), a.unbindEvents(), t = l, e = l.content, n = l.type, s = l.scrolling, i.extend(a, {
                        wrap: t.wrap,
                        skin: t.skin,
                        outer: t.outer,
                        inner: t.inner,
                        current: t,
                        previous: h
                    }), o = t.href, n) {
                        case "inline":
                        case "ajax":
                        case "html":
                            t.selector ? e = i("<div>").html(e).find(t.selector) : d(e) && (e.data(c) || e.data(c, i('<div class="' + c + '"></div>').insertAfter(e).hide()), e = e.show().detach(), t.wrap.bind("onReset", function() {
                                i(this).find(e).length && e.hide().replaceAll(e.data(c)).data(c, !1)
                            }));
                            break;
                        case "image":
                            e = t.tpl.image.replace("{href}", o);
                            break;
                        case "swf":
                            e = '<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="' + o + '"></param>', r = "", i.each(t.swf, function(t, i) {
                                e += '<param name="' + t + '" value="' + i + '"></param>', r += " " + t + '="' + i + '"'
                            }), e += '<embed src="' + o + '" type="application/x-shockwave-flash" width="100%" height="100%"' + r + "></embed></object>"
                    }
                    d(e) && e.parent().is(t.inner) || t.inner.append(e), a.trigger("beforeShow"), t.inner.css("overflow", "yes" === s ? "scroll" : "no" === s ? "hidden" : s), a._setDimension(), a.reposition(), a.isOpen = !1, a.coming = null, a.bindEvents(), a.isOpened ? h.prevMethod && a.transitions[h.prevMethod]() : i(".fancybox-wrap").not(t.wrap).stop(!0).trigger("onReset").remove(), a.transitions[a.isOpened ? t.nextMethod : t.openMethod](), a._preloadImages()
                }
            },
            _setDimension: function() {
                var t, e, n, s, o, r, l, h, c, d, u, g, v, y, w, x = a.getViewport(),
                    b = 0,
                    _ = !1,
                    C = !1,
                    S = a.wrap,
                    E = a.skin,
                    T = a.inner,
                    k = a.current,
                    j = k.width,
                    M = k.height,
                    $ = k.minWidth,
                    P = k.minHeight,
                    A = k.maxWidth,
                    I = k.maxHeight,
                    D = k.scrolling,
                    z = k.scrollOutside ? k.scrollbarWidth : 0,
                    O = k.margin,
                    Q = f(O[1] + O[3]),
                    L = f(O[0] + O[2]);
                if (S.add(E).add(T).width("auto").height("auto").removeClass("fancybox-tmp"), t = f(E.outerWidth(!0) - E.width()), e = f(E.outerHeight(!0) - E.height()), n = Q + t, s = L + e, o = p(j) ? (x.w - n) * f(j) / 100 : j, r = p(M) ? (x.h - s) * f(M) / 100 : M, "iframe" === k.type) {
                    if (y = k.content, k.autoHeight && 1 === y.data("ready")) try {
                        y[0].contentWindow.document.location && (T.width(o).height(9999), w = y.contents().find("body"), z && w.css("overflow-x", "hidden"), r = w.outerHeight(!0))
                    } catch (W) {}
                } else(k.autoWidth || k.autoHeight) && (T.addClass("fancybox-tmp"), k.autoWidth || T.width(o), k.autoHeight || T.height(r), k.autoWidth && (o = T.width()), k.autoHeight && (r = T.height()), T.removeClass("fancybox-tmp"));
                if (j = f(o), M = f(r), c = o / r, $ = f(p($) ? f($, "w") - n : $), A = f(p(A) ? f(A, "w") - n : A), P = f(p(P) ? f(P, "h") - s : P), I = f(p(I) ? f(I, "h") - s : I), l = A, h = I, k.fitToView && (A = Math.min(x.w - n, A), I = Math.min(x.h - s, I)), g = x.w - Q, v = x.h - L, k.aspectRatio ? (j > A && (j = A, M = f(j / c)), M > I && (M = I, j = f(M * c)), $ > j && (j = $, M = f(j / c)), P > M && (M = P, j = f(M * c))) : (j = Math.max($, Math.min(j, A)), k.autoHeight && "iframe" !== k.type && (T.width(j), M = T.height()), M = Math.max(P, Math.min(M, I))), k.fitToView)
                    if (T.width(j).height(M), S.width(j + t), d = S.width(), u = S.height(), k.aspectRatio)
                        for (;
                            (d > g || u > v) && j > $ && M > P && !(b++ > 19);) M = Math.max(P, Math.min(I, M - 10)), j = f(M * c), $ > j && (j = $, M = f(j / c)), j > A && (j = A, M = f(j / c)), T.width(j).height(M), S.width(j + t), d = S.width(), u = S.height();
                    else j = Math.max($, Math.min(j, j - (d - g))), M = Math.max(P, Math.min(M, M - (u - v)));
                z && "auto" === D && r > M && g > j + t + z && (j += z), T.width(j).height(M), S.width(j + t), d = S.width(), u = S.height(), _ = (d > g || u > v) && j > $ && M > P, C = k.aspectRatio ? l > j && h > M && o > j && r > M : (l > j || h > M) && (o > j || r > M), i.extend(k, {
                    dim: {
                        width: m(d),
                        height: m(u)
                    },
                    origWidth: o,
                    origHeight: r,
                    canShrink: _,
                    canExpand: C,
                    wPadding: t,
                    hPadding: e,
                    wrapSpace: u - E.outerHeight(!0),
                    skinSpace: E.height() - M
                }), !y && k.autoHeight && M > P && I > M && !C && T.height("auto")
            },
            _getPosition: function(t) {
                var e = a.current,
                    i = a.getViewport(),
                    n = e.margin,
                    s = a.wrap.width() + n[1] + n[3],
                    o = a.wrap.height() + n[0] + n[2],
                    r = {
                        position: "absolute",
                        top: n[0],
                        left: n[3]
                    };
                return e.autoCenter && e.fixed && !t && o <= i.h && s <= i.w ? r.position = "fixed" : e.locked || (r.top += i.y, r.left += i.x), r.top = m(Math.max(r.top, r.top + (i.h - o) * e.topRatio)), r.left = m(Math.max(r.left, r.left + (i.w - s) * e.leftRatio)), r
            },
            _afterZoomIn: function() {
                var t = a.current;
                t && (a.isOpen = a.isOpened = !0, a.wrap.css("overflow", "visible").addClass("fancybox-opened"), a.update(), (t.closeClick || t.nextClick && a.group.length > 1) && a.inner.css("cursor", "pointer").bind("click.fb", function(e) {
                    i(e.target).is("a") || i(e.target).parent().is("a") || (e.preventDefault(), a[t.closeClick ? "close" : "next"]())
                }), t.closeBtn && i(t.tpl.closeBtn).appendTo(a.skin).bind("click.fb", function(t) {
                    t.preventDefault(), a.close()
                }), t.arrows && a.group.length > 1 && ((t.loop || t.index > 0) && i(t.tpl.prev).appendTo(a.outer).bind("click.fb", a.prev), (t.loop || t.index < a.group.length - 1) && i(t.tpl.next).appendTo(a.outer).bind("click.fb", a.next)), a.trigger("afterShow"), t.loop || t.index !== t.group.length - 1 ? a.opts.autoPlay && !a.player.isActive && (a.opts.autoPlay = !1, a.play()) : a.play(!1))
            },
            _afterZoomOut: function(t) {
                t = t || a.current, i(".fancybox-wrap").trigger("onReset").remove(), i.extend(a, {
                    group: {},
                    opts: {},
                    router: !1,
                    current: null,
                    isActive: !1,
                    isOpened: !1,
                    isOpen: !1,
                    isClosing: !1,
                    wrap: null,
                    skin: null,
                    outer: null,
                    inner: null
                }), a.trigger("afterClose", t)
            }
        }), a.transitions = {
            getOrigPosition: function() {
                var t = a.current,
                    e = t.element,
                    i = t.orig,
                    n = {},
                    s = 50,
                    o = 50,
                    r = t.hPadding,
                    l = t.wPadding,
                    h = a.getViewport();
                return !i && t.isDom && e.is(":visible") && (i = e.find("img:first"), i.length || (i = e)), d(i) ? (n = i.offset(), i.is("img") && (s = i.outerWidth(), o = i.outerHeight())) : (n.top = h.y + (h.h - o) * t.topRatio, n.left = h.x + (h.w - s) * t.leftRatio), ("fixed" === a.wrap.css("position") || t.locked) && (n.top -= h.y, n.left -= h.x), n = {
                    top: m(n.top - r * t.topRatio),
                    left: m(n.left - l * t.leftRatio),
                    width: m(s + l),
                    height: m(o + r)
                }
            },
            step: function(t, e) {
                var i, n, s, o = e.prop,
                    r = a.current,
                    l = r.wrapSpace,
                    h = r.skinSpace;
                ("width" === o || "height" === o) && (i = e.end === e.start ? 1 : (t - e.start) / (e.end - e.start), a.isClosing && (i = 1 - i), n = "width" === o ? r.wPadding : r.hPadding, s = t - n, a.skin[o](f("width" === o ? s : s - l * i)), a.inner[o](f("width" === o ? s : s - l * i - h * i)))
            },
            zoomIn: function() {
                var t = a.current,
                    e = t.pos,
                    n = t.openEffect,
                    s = "elastic" === n,
                    o = i.extend({
                        opacity: 1
                    }, e);
                delete o.position, s ? (e = this.getOrigPosition(), t.openOpacity && (e.opacity = .1)) : "fade" === n && (e.opacity = .1), a.wrap.css(e).animate(o, {
                    duration: "none" === n ? 0 : t.openSpeed,
                    easing: t.openEasing,
                    step: s ? this.step : null,
                    complete: a._afterZoomIn
                })
            },
            zoomOut: function() {
                var t = a.current,
                    e = t.closeEffect,
                    i = "elastic" === e,
                    n = {
                        opacity: .1
                    };
                i && (n = this.getOrigPosition(), t.closeOpacity && (n.opacity = .1)), a.wrap.animate(n, {
                    duration: "none" === e ? 0 : t.closeSpeed,
                    easing: t.closeEasing,
                    step: i ? this.step : null,
                    complete: a._afterZoomOut
                })
            },
            changeIn: function() {
                var t, e = a.current,
                    i = e.nextEffect,
                    n = e.pos,
                    s = {
                        opacity: 1
                    },
                    o = a.direction,
                    r = 200;
                n.opacity = .1, "elastic" === i && (t = "down" === o || "up" === o ? "top" : "left", "down" === o || "right" === o ? (n[t] = m(f(n[t]) - r), s[t] = "+=" + r + "px") : (n[t] = m(f(n[t]) + r), s[t] = "-=" + r + "px")), "none" === i ? a._afterZoomIn() : a.wrap.css(n).animate(s, {
                    duration: e.nextSpeed,
                    easing: e.nextEasing,
                    complete: a._afterZoomIn
                })
            },
            changeOut: function() {
                var t = a.previous,
                    e = t.prevEffect,
                    n = {
                        opacity: .1
                    },
                    s = a.direction,
                    o = 200;
                "elastic" === e && (n["down" === s || "up" === s ? "top" : "left"] = ("up" === s || "left" === s ? "-" : "+") + "=" + o + "px"), t.wrap.animate(n, {
                    duration: "none" === e ? 0 : t.prevSpeed,
                    easing: t.prevEasing,
                    complete: function() {
                        i(this).trigger("onReset").remove()
                    }
                })
            }
        }, a.helpers.overlay = {
            defaults: {
                closeClick: !0,
                speedOut: 200,
                showEarly: !0,
                css: {},
                locked: !c,
                fixed: !0
            },
            overlay: null,
            fixed: !1,
            el: i("html"),
            create: function(t) {
                t = i.extend({}, this.defaults, t), this.overlay && this.close(), this.overlay = i('<div class="fancybox-overlay"></div>').appendTo(a.coming ? a.coming.parent : t.parent), this.fixed = !1, t.fixed && a.defaults.fixed && (this.overlay.addClass("fancybox-overlay-fixed"), this.fixed = !0)
            },
            open: function(t) {
                var e = this;
                t = i.extend({}, this.defaults, t), this.overlay ? this.overlay.unbind(".overlay").width("auto").height("auto") : this.create(t), this.fixed || (o.bind("resize.overlay", i.proxy(this.update, this)), this.update()), t.closeClick && this.overlay.bind("click.overlay", function(t) {
                    return i(t.target).hasClass("fancybox-overlay") ? (a.isActive ? a.close() : e.close(), !1) : void 0
                }), this.overlay.css(t.css).show()
            },
            close: function() {
                var t, e;
                o.unbind("resize.overlay"), this.el.hasClass("fancybox-lock") && (i(".fancybox-margin").removeClass("fancybox-margin"), t = o.scrollTop(), e = o.scrollLeft(), this.el.removeClass("fancybox-lock"), o.scrollTop(t).scrollLeft(e)), i(".fancybox-overlay").remove().hide(), i.extend(this, {
                    overlay: null,
                    fixed: !1
                })
            },
            update: function() {
                var t, i = "100%";
                this.overlay.width(i).height("100%"), l ? (t = Math.max(e.documentElement.offsetWidth, e.body.offsetWidth), r.width() > t && (i = r.width())) : r.width() > o.width() && (i = r.width()), this.overlay.width(i).height(r.height())
            },
            onReady: function(t, e) {
                var n = this.overlay;
                i(".fancybox-overlay").stop(!0, !0), n || this.create(t), t.locked && this.fixed && e.fixed && (n || (this.margin = r.height() > o.height() ? i("html").css("margin-right").replace("px", "") : !1), e.locked = this.overlay.append(e.wrap), e.fixed = !1), t.showEarly === !0 && this.beforeShow.apply(this, arguments)
            },
            beforeShow: function(t, e) {
                var n, s;
                e.locked && (this.margin !== !1 && (i("*").filter(function() {
                    return "fixed" === i(this).css("position") && !i(this).hasClass("fancybox-overlay") && !i(this).hasClass("fancybox-wrap")
                }).addClass("fancybox-margin"), this.el.addClass("fancybox-margin")), n = o.scrollTop(), s = o.scrollLeft(), this.el.addClass("fancybox-lock"), o.scrollTop(n).scrollLeft(s)), this.open(t)
            },
            onUpdate: function() {
                this.fixed || this.update()
            },
            afterClose: function(t) {
                this.overlay && !a.coming && this.overlay.fadeOut(t.speedOut, i.proxy(this.close, this))
            }
        }, a.helpers.title = {
            defaults: {
                type: "float",
                position: "bottom"
            },
            beforeShow: function(t) {
                var e, n, s = a.current,
                    o = s.title,
                    r = t.type;
                if (i.isFunction(o) && (o = o.call(s.element, s)), u(o) && "" !== i.trim(o)) {
                    switch (e = i('<div class="fancybox-title fancybox-title-' + r + '-wrap">' + o + "</div>"), r) {
                        case "inside":
                            n = a.skin;
                            break;
                        case "outside":
                            n = a.wrap;
                            break;
                        case "over":
                            n = a.inner;
                            break;
                        default:
                            n = a.skin, e.appendTo("body"), l && e.width(e.width()), e.wrapInner('<span class="child"></span>'), a.current.margin[2] += Math.abs(f(e.css("margin-bottom")))
                    }
                    e["top" === t.position ? "prependTo" : "appendTo"](n)
                }
            }
        }, i.fn.fancybox = function(t) {
            var e, n = i(this),
                s = this.selector || "",
                o = function(o) {
                    var r, l, h = i(this).blur(),
                        c = e;
                    o.ctrlKey || o.altKey || o.shiftKey || o.metaKey || h.is(".fancybox-wrap") || (r = t.groupAttr || "data-fancybox-group", l = h.attr(r), l || (r = "rel", l = h.get(0)[r]), l && "" !== l && "nofollow" !== l && (h = s.length ? i(s) : n, h = h.filter("[" + r + '="' + l + '"]'), c = h.index(this)), t.index = c, a.open(h, t) !== !1 && o.preventDefault())
                };
            return t = t || {}, e = t.index || 0, s && t.live !== !1 ? r.undelegate(s, "click.fb-start").delegate(s + ":not('.fancybox-item, .fancybox-nav')", "click.fb-start", o) : n.unbind("click.fb-start").bind("click.fb-start", o), this.filter("[data-fancybox-start=1]").trigger("click"), this
        }, r.ready(function() {
            var e, o;
            i.scrollbarWidth === n && (i.scrollbarWidth = function() {
                var t = i('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"),
                    e = t.children(),
                    n = e.innerWidth() - e.height(99).innerWidth();
                return t.remove(), n
            }), i.support.fixedPosition === n && (i.support.fixedPosition = function() {
                var t = i('<div style="position:fixed;top:20px;"></div>').appendTo("body"),
                    e = 20 === t[0].offsetTop || 15 === t[0].offsetTop;
                return t.remove(), e
            }()), i.extend(a.defaults, {
                scrollbarWidth: i.scrollbarWidth(),
                fixed: i.support.fixedPosition,
                parent: i("body")
            }), e = i(t).width(), s.addClass("fancybox-lock-test"), o = i(t).width(), s.removeClass("fancybox-lock-test"), i("<style type='text/css'>.fancybox-margin{margin-right:" + (o - e) + "px;}</style>").appendTo("head")
        })
    }(window, document, jQuery), jQuery.noConflict(), jQuery(document).ready(function() {
        jQuery(".fancybox").fancybox({
            hideOnContentClick: !0,
            width: 800,
            autoDimensions: !0,
            type: "iframe",
            showNavArrows: !1,
            arrows: !1,
            showTitle: !1,
            scrolling: "auto",
            preload: !0,
            helpers: {
                title: null
            }
        })
    }), ! function(t, e, i, n) {
        function s(e, i) {
            this.settings = null, this.options = t.extend({}, s.Defaults, i), this.$element = t(e), this.drag = t.extend({}, u), this.state = t.extend({}, p), this.e = t.extend({}, g), this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._invalidated = {}, this._pipe = [], t.each(s.Plugins, t.proxy(function(t, e) {
                this._plugins[t[0].toLowerCase() + t.slice(1)] = new e(this)
            }, this)), t.each(s.Pipe, t.proxy(function(e, i) {
                this._pipe.push({
                    filter: i.filter,
                    run: t.proxy(i.run, this)
                })
            }, this)), this.setup(), this.initialize()
        }

        function o(t) {
            if (t.touches !== n) return {
                x: t.touches[0].pageX,
                y: t.touches[0].pageY
            };
            if (t.touches === n) {
                if (t.pageX !== n) return {
                    x: t.pageX,
                    y: t.pageY
                };
                if (t.pageX === n) return {
                    x: t.clientX,
                    y: t.clientY
                }
            }
        }

        function r(t) {
            var e, n, s = i.createElement("div"),
                o = t;
            for (e in o)
                if (n = o[e], "undefined" != typeof s.style[n]) return s = null, [n, e];
            return [!1]
        }

        function a() {
            return r(["transition", "WebkitTransition", "MozTransition", "OTransition"])[1]
        }

        function l() {
            return r(["transform", "WebkitTransform", "MozTransform", "OTransform", "msTransform"])[0]
        }

        function h() {
            return r(["perspective", "webkitPerspective", "MozPerspective", "OPerspective", "MsPerspective"])[0]
        }

        function c() {
            return "ontouchstart" in e || !!navigator.msMaxTouchPoints
        }

        function d() {
            return e.navigator.msPointerEnabled
        }
        var u, p, g;
        u = {
            start: 0,
            startX: 0,
            startY: 0,
            current: 0,
            currentX: 0,
            currentY: 0,
            offsetX: 0,
            offsetY: 0,
            distance: null,
            startTime: 0,
            endTime: 0,
            updatedX: 0,
            targetEl: null
        }, p = {
            isTouch: !1,
            isScrolling: !1,
            isSwiping: !1,
            direction: !1,
            inMotion: !1
        }, g = {
            _onDragStart: null,
            _onDragMove: null,
            _onDragEnd: null,
            _transitionEnd: null,
            _resizer: null,
            _responsiveCall: null,
            _goToLoop: null,
            _checkVisibile: null
        }, s.Defaults = {
            items: 3,
            loop: !1,
            center: !1,
            mouseDrag: !0,
            touchDrag: !0,
            pullDrag: !0,
            freeDrag: !1,
            margin: 0,
            stagePadding: 0,
            merge: !1,
            mergeFit: !0,
            autoWidth: !1,
            startPosition: 0,
            rtl: !1,
            smartSpeed: 250,
            fluidSpeed: !1,
            dragEndSpeed: !1,
            responsive: {},
            responsiveRefreshRate: 200,
            responsiveBaseElement: e,
            responsiveClass: !1,
            fallbackEasing: "swing",
            info: !1,
            nestedItemSelector: !1,
            itemElement: "div",
            stageElement: "div",
            themeClass: "owl-theme",
            baseClass: "owl-carousel",
            itemClass: "owl-item",
            centerClass: "center",
            activeClass: "active"
        }, s.Width = {
            Default: "default",
            Inner: "inner",
            Outer: "outer"
        }, s.Plugins = {}, s.Pipe = [{
            filter: ["width", "items", "settings"],
            run: function(t) {
                t.current = this._items && this._items[this.relative(this._current)]
            }
        }, {
            filter: ["items", "settings"],
            run: function() {
                var t = this._clones,
                    e = this.$stage.children(".cloned");
                (e.length !== t.length || !this.settings.loop && t.length > 0) && (this.$stage.children(".cloned").remove(), this._clones = [])
            }
        }, {
            filter: ["items", "settings"],
            run: function() {
                var t, e, i = this._clones,
                    n = this._items,
                    s = this.settings.loop ? i.length - Math.max(2 * this.settings.items, 4) : 0;
                for (t = 0, e = Math.abs(s / 2); e > t; t++) s > 0 ? (this.$stage.children().eq(n.length + i.length - 1).remove(), i.pop(), this.$stage.children().eq(0).remove(), i.pop()) : (i.push(i.length / 2), this.$stage.append(n[i[i.length - 1]].clone().addClass("cloned")), i.push(n.length - 1 - (i.length - 1) / 2), this.$stage.prepend(n[i[i.length - 1]].clone().addClass("cloned")))
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function() {
                var t, e, i, n = this.settings.rtl ? 1 : -1,
                    s = (this.width() / this.settings.items).toFixed(3),
                    o = 0;
                for (this._coordinates = [], e = 0, i = this._clones.length + this._items.length; i > e; e++) t = this._mergers[this.relative(e)], t = this.settings.mergeFit && Math.min(t, this.settings.items) || t, o += (this.settings.autoWidth ? this._items[this.relative(e)].width() + this.settings.margin : s * t) * n, this._coordinates.push(o)
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function() {
                var e, i, n = (this.width() / this.settings.items).toFixed(3),
                    s = {
                        width: Math.abs(this._coordinates[this._coordinates.length - 1]) + 2 * this.settings.stagePadding,
                        "padding-left": this.settings.stagePadding || "",
                        "padding-right": this.settings.stagePadding || ""
                    };
                if (this.$stage.css(s), s = {
                        width: this.settings.autoWidth ? "auto" : n - this.settings.margin
                    }, s[this.settings.rtl ? "margin-left" : "margin-right"] = this.settings.margin, !this.settings.autoWidth && t.grep(this._mergers, function(t) {
                        return t > 1
                    }).length > 0)
                    for (e = 0, i = this._coordinates.length; i > e; e++) s.width = Math.abs(this._coordinates[e]) - Math.abs(this._coordinates[e - 1] || 0) - this.settings.margin, this.$stage.children().eq(e).css(s);
                else this.$stage.children().css(s)
            }
        }, {
            filter: ["width", "items", "settings"],
            run: function(t) {
                t.current && this.reset(this.$stage.children().index(t.current))
            }
        }, {
            filter: ["position"],
            run: function() {
                this.animate(this.coordinates(this._current))
            }
        }, {
            filter: ["width", "position", "items", "settings"],
            run: function() {
                var t, e, i, n, s = this.settings.rtl ? 1 : -1,
                    o = 2 * this.settings.stagePadding,
                    r = this.coordinates(this.current()) + o,
                    a = r + this.width() * s,
                    l = [];
                for (i = 0, n = this._coordinates.length; n > i; i++) t = this._coordinates[i - 1] || 0, e = Math.abs(this._coordinates[i]) + o * s, (this.op(t, "<=", r) && this.op(t, ">", a) || this.op(e, "<", r) && this.op(e, ">", a)) && l.push(i);
                this.$stage.children("." + this.settings.activeClass).removeClass(this.settings.activeClass), this.$stage.children(":eq(" + l.join("), :eq(") + ")").addClass(this.settings.activeClass), this.settings.center && (this.$stage.children("." + this.settings.centerClass).removeClass(this.settings.centerClass), this.$stage.children().eq(this.current()).addClass(this.settings.centerClass))
            }
        }], s.prototype.initialize = function() {
            if (this.trigger("initialize"), this.$element.addClass(this.settings.baseClass).addClass(this.settings.themeClass).toggleClass("owl-rtl", this.settings.rtl), this.browserSupport(), this.settings.autoWidth && this.state.imagesLoaded !== !0) {
                var e, i, s;
                if (e = this.$element.find("img"), i = this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : n, s = this.$element.children(i).width(), e.length && 0 >= s) return this.preloadAutoWidthImages(e), !1
            }
            this.$element.addClass("owl-loading"), this.$stage = t("<" + this.settings.stageElement + ' class="owl-stage"/>').wrap('<div class="owl-stage-outer">'), this.$element.append(this.$stage.parent()), this.replace(this.$element.children().not(this.$stage.parent())), this._width = this.$element.width(), this.refresh(), this.$element.removeClass("owl-loading").addClass("owl-loaded"), this.eventsCall(), this.internalEvents(), this.addTriggerableEvents(), this.trigger("initialized")
        }, s.prototype.setup = function() {
            var e = this.viewport(),
                i = this.options.responsive,
                n = -1,
                s = null;
            i ? (t.each(i, function(t) {
                e >= t && t > n && (n = Number(t))
            }), s = t.extend({}, this.options, i[n]), delete s.responsive, s.responsiveClass && this.$element.attr("class", function(t, e) {
                return e.replace(/\b owl-responsive-\S+/g, "")
            }).addClass("owl-responsive-" + n)) : s = t.extend({}, this.options), (null === this.settings || this._breakpoint !== n) && (this.trigger("change", {
                property: {
                    name: "settings",
                    value: s
                }
            }), this._breakpoint = n, this.settings = s, this.invalidate("settings"), this.trigger("changed", {
                property: {
                    name: "settings",
                    value: this.settings
                }
            }))
        }, s.prototype.optionsLogic = function() {
            this.$element.toggleClass("owl-center", this.settings.center), this.settings.loop && this._items.length < this.settings.items && (this.settings.loop = !1), this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1)
        }, s.prototype.prepare = function(e) {
            var i = this.trigger("prepare", {
                content: e
            });
            return i.data || (i.data = t("<" + this.settings.itemElement + "/>").addClass(this.settings.itemClass).append(e)), this.trigger("prepared", {
                content: i.data
            }), i.data
        }, s.prototype.update = function() {
            for (var e = 0, i = this._pipe.length, n = t.proxy(function(t) {
                    return this[t]
                }, this._invalidated), s = {}; i > e;)(this._invalidated.all || t.grep(this._pipe[e].filter, n).length > 0) && this._pipe[e].run(s), e++;
            this._invalidated = {}
        }, s.prototype.width = function(t) {
            switch (t = t || s.Width.Default) {
                case s.Width.Inner:
                case s.Width.Outer:
                    return this._width;
                default:
                    return this._width - 2 * this.settings.stagePadding + this.settings.margin
            }
        }, s.prototype.refresh = function() {
            return 0 === this._items.length ? !1 : ((new Date).getTime(), this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$stage.addClass("owl-refresh"), this.update(), this.$stage.removeClass("owl-refresh"), this.state.orientation = e.orientation, this.watchVisibility(), this.trigger("refreshed"), void 0)
        }, s.prototype.eventsCall = function() {
            this.e._onDragStart = t.proxy(function(t) {
                this.onDragStart(t)
            }, this), this.e._onDragMove = t.proxy(function(t) {
                this.onDragMove(t)
            }, this), this.e._onDragEnd = t.proxy(function(t) {
                this.onDragEnd(t)
            }, this), this.e._onResize = t.proxy(function(t) {
                this.onResize(t)
            }, this), this.e._transitionEnd = t.proxy(function(t) {
                this.transitionEnd(t)
            }, this), this.e._preventClick = t.proxy(function(t) {
                this.preventClick(t)
            }, this)
        }, s.prototype.onThrottledResize = function() {
            e.clearTimeout(this.resizeTimer), this.resizeTimer = e.setTimeout(this.e._onResize, this.settings.responsiveRefreshRate)
        }, s.prototype.onResize = function() {
            return this._items.length ? this._width === this.$element.width() ? !1 : this.trigger("resize").isDefaultPrevented() ? !1 : (this._width = this.$element.width(), this.invalidate("width"), this.refresh(), void this.trigger("resized")) : !1
        }, s.prototype.eventsRouter = function(t) {
            var e = t.type;
            "mousedown" === e || "touchstart" === e ? this.onDragStart(t) : "mousemove" === e || "touchmove" === e ? this.onDragMove(t) : "mouseup" === e || "touchend" === e ? this.onDragEnd(t) : "touchcancel" === e && this.onDragEnd(t)
        }, s.prototype.internalEvents = function() {
            var i = (c(), d());
            this.settings.mouseDrag ? (this.$stage.on("mousedown", t.proxy(function(t) {
                this.eventsRouter(t)
            }, this)), this.$stage.on("dragstart", function() {
                return !1
            }), this.$stage.get(0).onselectstart = function() {
                return !1
            }) : this.$element.addClass("owl-text-select-on"), this.settings.touchDrag && !i && this.$stage.on("touchstart touchcancel", t.proxy(function(t) {
                this.eventsRouter(t)
            }, this)), this.transitionEndVendor && this.on(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd, !1), this.settings.responsive !== !1 && this.on(e, "resize", t.proxy(this.onThrottledResize, this))
        }, s.prototype.onDragStart = function(n) {
            var s, r, a, l;
            if (s = n.originalEvent || n || e.event, 3 === s.which || this.state.isTouch) return !1;
            if ("mousedown" === s.type && this.$stage.addClass("owl-grab"), this.trigger("drag"), this.drag.startTime = (new Date).getTime(), this.speed(0), this.state.isTouch = !0, this.state.isScrolling = !1, this.state.isSwiping = !1, this.drag.distance = 0, r = o(s).x, a = o(s).y, this.drag.offsetX = this.$stage.position().left, this.drag.offsetY = this.$stage.position().top, this.settings.rtl && (this.drag.offsetX = this.$stage.position().left + this.$stage.width() - this.width() + this.settings.margin), this.state.inMotion && this.support3d) l = this.getTransformProperty(), this.drag.offsetX = l, this.animate(l), this.state.inMotion = !0;
            else if (this.state.inMotion && !this.support3d) return this.state.inMotion = !1, !1;
            this.drag.startX = r - this.drag.offsetX, this.drag.startY = a - this.drag.offsetY, this.drag.start = r - this.drag.startX, this.drag.targetEl = s.target || s.srcElement, this.drag.updatedX = this.drag.start, ("IMG" === this.drag.targetEl.tagName || "A" === this.drag.targetEl.tagName) && (this.drag.targetEl.draggable = !1), t(i).on("mousemove.owl.dragEvents mouseup.owl.dragEvents touchmove.owl.dragEvents touchend.owl.dragEvents", t.proxy(function(t) {
                this.eventsRouter(t)
            }, this))
        }, s.prototype.onDragMove = function(t) {
            var i, s, r, a, l, h;
            this.state.isTouch && (this.state.isScrolling || (i = t.originalEvent || t || e.event, s = o(i).x, r = o(i).y, this.drag.currentX = s - this.drag.startX, this.drag.currentY = r - this.drag.startY, this.drag.distance = this.drag.currentX - this.drag.offsetX, this.drag.distance < 0 ? this.state.direction = this.settings.rtl ? "right" : "left" : this.drag.distance > 0 && (this.state.direction = this.settings.rtl ? "left" : "right"), this.settings.loop ? this.op(this.drag.currentX, ">", this.coordinates(this.minimum())) && "right" === this.state.direction ? this.drag.currentX -= (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length) : this.op(this.drag.currentX, "<", this.coordinates(this.maximum())) && "left" === this.state.direction && (this.drag.currentX += (this.settings.center && this.coordinates(0)) - this.coordinates(this._items.length)) : (a = this.coordinates(this.settings.rtl ? this.maximum() : this.minimum()), l = this.coordinates(this.settings.rtl ? this.minimum() : this.maximum()), h = this.settings.pullDrag ? this.drag.distance / 5 : 0, this.drag.currentX = Math.max(Math.min(this.drag.currentX, a + h), l + h)), (this.drag.distance > 8 || this.drag.distance < -8) && (i.preventDefault !== n ? i.preventDefault() : i.returnValue = !1, this.state.isSwiping = !0), this.drag.updatedX = this.drag.currentX, (this.drag.currentY > 16 || this.drag.currentY < -16) && this.state.isSwiping === !1 && (this.state.isScrolling = !0, this.drag.updatedX = this.drag.start), this.animate(this.drag.updatedX)))
        }, s.prototype.onDragEnd = function(e) {
            var n, s, o;
            if (this.state.isTouch) {
                if ("mouseup" === e.type && this.$stage.removeClass("owl-grab"), this.trigger("dragged"), this.drag.targetEl.removeAttribute("draggable"), this.state.isTouch = !1, this.state.isScrolling = !1, this.state.isSwiping = !1, 0 === this.drag.distance && this.state.inMotion !== !0) return this.state.inMotion = !1, !1;
                this.drag.endTime = (new Date).getTime(), n = this.drag.endTime - this.drag.startTime, s = Math.abs(this.drag.distance), (s > 3 || n > 300) && this.removeClick(this.drag.targetEl), o = this.closest(this.drag.updatedX), this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(o), this.invalidate("position"), this.update(), this.settings.pullDrag || this.drag.updatedX !== this.coordinates(o) || this.transitionEnd(), this.drag.distance = 0, t(i).off(".owl.dragEvents")
            }
        }, s.prototype.removeClick = function(i) {
            this.drag.targetEl = i, t(i).on("click.preventClick", this.e._preventClick), e.setTimeout(function() {
                t(i).off("click.preventClick")
            }, 300)
        }, s.prototype.preventClick = function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = !1, e.stopPropagation && e.stopPropagation(), t(e.target).off("click.preventClick")
        }, s.prototype.getTransformProperty = function() {
            var t, i;
            return t = e.getComputedStyle(this.$stage.get(0), null).getPropertyValue(this.vendorName + "transform"), t = t.replace(/matrix(3d)?\(|\)/g, "").split(","), i = 16 === t.length, i !== !0 ? t[4] : t[12]
        }, s.prototype.closest = function(e) {
            var i = -1,
                n = 30,
                s = this.width(),
                o = this.coordinates();
            return this.settings.freeDrag || t.each(o, t.proxy(function(t, r) {
                return e > r - n && r + n > e ? i = t : this.op(e, "<", r) && this.op(e, ">", o[t + 1] || r - s) && (i = "left" === this.state.direction ? t + 1 : t), -1 === i
            }, this)), this.settings.loop || (this.op(e, ">", o[this.minimum()]) ? i = e = this.minimum() : this.op(e, "<", o[this.maximum()]) && (i = e = this.maximum())), i
        }, s.prototype.animate = function(e) {
            this.trigger("translate"), this.state.inMotion = this.speed() > 0, this.support3d ? this.$stage.css({
                transform: "translate3d(" + e + "px,0px, 0px)",
                transition: this.speed() / 1e3 + "s"
            }) : this.state.isTouch ? this.$stage.css({
                left: e + "px"
            }) : this.$stage.animate({
                left: e
            }, this.speed() / 1e3, this.settings.fallbackEasing, t.proxy(function() {
                this.state.inMotion && this.transitionEnd()
            }, this))
        }, s.prototype.current = function(t) {
            if (t === n) return this._current;
            if (0 === this._items.length) return n;
            if (t = this.normalize(t), this._current !== t) {
                var e = this.trigger("change", {
                    property: {
                        name: "position",
                        value: t
                    }
                });
                e.data !== n && (t = this.normalize(e.data)), this._current = t, this.invalidate("position"), this.trigger("changed", {
                    property: {
                        name: "position",
                        value: this._current
                    }
                })
            }
            return this._current
        }, s.prototype.invalidate = function(t) {
            this._invalidated[t] = !0
        }, s.prototype.reset = function(t) {
            t = this.normalize(t), t !== n && (this._speed = 0, this._current = t, this.suppress(["translate", "translated"]), this.animate(this.coordinates(t)), this.release(["translate", "translated"]))
        }, s.prototype.normalize = function(e, i) {
            var s = i ? this._items.length : this._items.length + this._clones.length;
            return !t.isNumeric(e) || 1 > s ? n : e = this._clones.length ? (e % s + s) % s : Math.max(this.minimum(i), Math.min(this.maximum(i), e))
        }, s.prototype.relative = function(t) {
            return t = this.normalize(t), t -= this._clones.length / 2, this.normalize(t, !0)
        }, s.prototype.maximum = function(t) {
            var e, i, n, s = 0,
                o = this.settings;
            if (t) return this._items.length - 1;
            if (!o.loop && o.center) e = this._items.length - 1;
            else if (o.loop || o.center)
                if (o.loop || o.center) e = this._items.length + o.items;
                else {
                    if (!o.autoWidth && !o.merge) throw "Can not detect maximum absolute position.";
                    for (revert = o.rtl ? 1 : -1, i = this.$stage.width() - this.$element.width();
                        (n = this.coordinates(s)) && !(n * revert >= i);) e = ++s
                } else e = this._items.length - o.items;
            return e
        }, s.prototype.minimum = function(t) {
            return t ? 0 : this._clones.length / 2
        }, s.prototype.items = function(t) {
            return t === n ? this._items.slice() : (t = this.normalize(t, !0), this._items[t])
        }, s.prototype.mergers = function(t) {
            return t === n ? this._mergers.slice() : (t = this.normalize(t, !0), this._mergers[t])
        }, s.prototype.clones = function(e) {
            var i = this._clones.length / 2,
                s = i + this._items.length,
                o = function(t) {
                    return t % 2 === 0 ? s + t / 2 : i - (t + 1) / 2
                };
            return e === n ? t.map(this._clones, function(t, e) {
                return o(e)
            }) : t.map(this._clones, function(t, i) {
                return t === e ? o(i) : null
            })
        }, s.prototype.speed = function(t) {
            return t !== n && (this._speed = t), this._speed
        }, s.prototype.coordinates = function(e) {
            var i = null;
            return e === n ? t.map(this._coordinates, t.proxy(function(t, e) {
                return this.coordinates(e)
            }, this)) : (this.settings.center ? (i = this._coordinates[e], i += (this.width() - i + (this._coordinates[e - 1] || 0)) / 2 * (this.settings.rtl ? -1 : 1)) : i = this._coordinates[e - 1] || 0, i)
        }, s.prototype.duration = function(t, e, i) {
            return Math.min(Math.max(Math.abs(e - t), 1), 6) * Math.abs(i || this.settings.smartSpeed)
        }, s.prototype.to = function(i, n) {
            if (this.settings.loop) {
                var s = i - this.relative(this.current()),
                    o = this.current(),
                    r = this.current(),
                    a = this.current() + s,
                    l = 0 > r - a ? !0 : !1,
                    h = this._clones.length + this._items.length;
                a < this.settings.items && l === !1 ? (o = r + this._items.length, this.reset(o)) : a >= h - this.settings.items && l === !0 && (o = r - this._items.length, this.reset(o)), e.clearTimeout(this.e._goToLoop), this.e._goToLoop = e.setTimeout(t.proxy(function() {
                    this.speed(this.duration(this.current(), o + s, n)), this.current(o + s), this.update()
                }, this), 30)
            } else this.speed(this.duration(this.current(), i, n)), this.current(i), this.update()
        }, s.prototype.next = function(t) {
            t = t || !1, this.to(this.relative(this.current()) + 1, t)
        }, s.prototype.prev = function(t) {
            t = t || !1, this.to(this.relative(this.current()) - 1, t)
        }, s.prototype.transitionEnd = function(t) {
            return t !== n && (t.stopPropagation(), (t.target || t.srcElement || t.originalTarget) !== this.$stage.get(0)) ? !1 : (this.state.inMotion = !1, void this.trigger("translated"))
        }, s.prototype.viewport = function() {
            var n;
            if (this.options.responsiveBaseElement !== e) n = t(this.options.responsiveBaseElement).width();
            else if (e.innerWidth) n = e.innerWidth;
            else {
                if (!i.documentElement || !i.documentElement.clientWidth) throw "Can not detect viewport width.";
                n = i.documentElement.clientWidth
            }
            return n
        }, s.prototype.replace = function(e) {
            this.$stage.empty(), this._items = [], e && (e = e instanceof jQuery ? e : t(e)), this.settings.nestedItemSelector && (e = e.find("." + this.settings.nestedItemSelector)), e.filter(function() {
                return 1 === this.nodeType
            }).each(t.proxy(function(t, e) {
                e = this.prepare(e), this.$stage.append(e), this._items.push(e), this._mergers.push(1 * e.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)
            }, this)), this.reset(t.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items")
        }, s.prototype.add = function(t, e) {
            e = e === n ? this._items.length : this.normalize(e, !0), this.trigger("add", {
                content: t,
                position: e
            }), 0 === this._items.length || e === this._items.length ? (this.$stage.append(t), this._items.push(t), this._mergers.push(1 * t.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)) : (this._items[e].before(t), this._items.splice(e, 0, t), this._mergers.splice(e, 0, 1 * t.find("[data-merge]").andSelf("[data-merge]").attr("data-merge") || 1)), this.invalidate("items"), this.trigger("added", {
                content: t,
                position: e
            })
        }, s.prototype.remove = function(t) {
            t = this.normalize(t, !0), t !== n && (this.trigger("remove", {
                content: this._items[t],
                position: t
            }), this._items[t].remove(), this._items.splice(t, 1), this._mergers.splice(t, 1), this.invalidate("items"), this.trigger("removed", {
                content: null,
                position: t
            }))
        }, s.prototype.addTriggerableEvents = function() {
            var e = t.proxy(function(e, i) {
                return t.proxy(function(t) {
                    t.relatedTarget !== this && (this.suppress([i]), e.apply(this, [].slice.call(arguments, 1)), this.release([i]))
                }, this)
            }, this);
            t.each({
                next: this.next,
                prev: this.prev,
                to: this.to,
                destroy: this.destroy,
                refresh: this.refresh,
                replace: this.replace,
                add: this.add,
                remove: this.remove
            }, t.proxy(function(t, i) {
                this.$element.on(t + ".owl.carousel", e(i, t + ".owl.carousel"))
            }, this))
        }, s.prototype.watchVisibility = function() {
            function i(t) {
                return t.offsetWidth > 0 && t.offsetHeight > 0
            }

            function n() {
                i(this.$element.get(0)) && (this.$element.removeClass("owl-hidden"), this.refresh(), e.clearInterval(this.e._checkVisibile))
            }
            i(this.$element.get(0)) || (this.$element.addClass("owl-hidden"), e.clearInterval(this.e._checkVisibile), this.e._checkVisibile = e.setInterval(t.proxy(n, this), 500))
        }, s.prototype.preloadAutoWidthImages = function(e) {
            var i, n, s, o;
            i = 0, n = this, e.each(function(r, a) {
                s = t(a), o = new Image, o.onload = function() {
                    i++, s.attr("src", o.src), s.css("opacity", 1), i >= e.length && (n.state.imagesLoaded = !0, n.initialize())
                }, o.src = s.attr("src") || s.attr("data-src") || s.attr("data-src-retina")
            })
        }, s.prototype.destroy = function() {
            this.$element.hasClass(this.settings.themeClass) && this.$element.removeClass(this.settings.themeClass), this.settings.responsive !== !1 && t(e).off("resize.owl.carousel"), this.transitionEndVendor && this.off(this.$stage.get(0), this.transitionEndVendor, this.e._transitionEnd);
            for (var n in this._plugins) this._plugins[n].destroy();
            (this.settings.mouseDrag || this.settings.touchDrag) && (this.$stage.off("mousedown touchstart touchcancel"), t(i).off(".owl.dragEvents"), this.$stage.get(0).onselectstart = function() {}, this.$stage.off("dragstart", function() {
                return !1
            })), this.$element.off(".owl"), this.$stage.children(".cloned").remove(), this.e = null, this.$element.removeData("owlCarousel"), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$stage.unwrap()
        }, s.prototype.op = function(t, e, i) {
            var n = this.settings.rtl;
            switch (e) {
                case "<":
                    return n ? t > i : i > t;
                case ">":
                    return n ? i > t : t > i;
                case ">=":
                    return n ? i >= t : t >= i;
                case "<=":
                    return n ? t >= i : i >= t
            }
        }, s.prototype.on = function(t, e, i, n) {
            t.addEventListener ? t.addEventListener(e, i, n) : t.attachEvent && t.attachEvent("on" + e, i)
        }, s.prototype.off = function(t, e, i, n) {
            t.removeEventListener ? t.removeEventListener(e, i, n) : t.detachEvent && t.detachEvent("on" + e, i)
        }, s.prototype.trigger = function(e, i, n) {
            var s = {
                    item: {
                        count: this._items.length,
                        index: this.current()
                    }
                },
                o = t.camelCase(t.grep(["on", e, n], function(t) {
                    return t
                }).join("-").toLowerCase()),
                r = t.Event([e, "owl", n || "carousel"].join(".").toLowerCase(), t.extend({
                    relatedTarget: this
                }, s, i));
            return this._supress[e] || (t.each(this._plugins, function(t, e) {
                e.onTrigger && e.onTrigger(r)
            }), this.$element.trigger(r), this.settings && "function" == typeof this.settings[o] && this.settings[o].apply(this, r)), r
        }, s.prototype.suppress = function(e) {
            t.each(e, t.proxy(function(t, e) {
                this._supress[e] = !0
            }, this))
        }, s.prototype.release = function(e) {
            t.each(e, t.proxy(function(t, e) {
                delete this._supress[e]
            }, this))
        }, s.prototype.browserSupport = function() {
            if (this.support3d = h(), this.support3d) {
                this.transformVendor = l();
                var t = ["transitionend", "webkitTransitionEnd", "transitionend", "oTransitionEnd"];
                this.transitionEndVendor = t[a()], this.vendorName = this.transformVendor.replace(/Transform/i, ""), this.vendorName = "" !== this.vendorName ? "-" + this.vendorName.toLowerCase() + "-" : ""
            }
            this.state.orientation = e.orientation
        }, t.fn.owlCarousel = function(e) {
            return this.each(function() {
                t(this).data("owlCarousel") || t(this).data("owlCarousel", new s(this, e))
            })
        }, t.fn.owlCarousel.Constructor = s
    }(window.Zepto || window.jQuery, window, document),
    function(t, e) {
        var i = function(e) {
            this._core = e, this._loaded = [], this._handlers = {
                "initialized.owl.carousel change.owl.carousel": t.proxy(function(e) {
                    if (e.namespace && this._core.settings && this._core.settings.lazyLoad && (e.property && "position" == e.property.name || "initialized" == e.type))
                        for (var i = this._core.settings, n = i.center && Math.ceil(i.items / 2) || i.items, s = i.center && -1 * n || 0, o = (e.property && e.property.value || this._core.current()) + s, r = this._core.clones().length, a = t.proxy(function(t, e) {
                                this.load(e)
                            }, this); s++ < n;) this.load(r / 2 + this._core.relative(o)), r && t.each(this._core.clones(this._core.relative(o++)), a)
                }, this)
            }, this._core.options = t.extend({}, i.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        i.Defaults = {
            lazyLoad: !1
        }, i.prototype.load = function(i) {
            var n = this._core.$stage.children().eq(i),
                s = n && n.find(".owl-lazy");
            !s || t.inArray(n.get(0), this._loaded) > -1 || (s.each(t.proxy(function(i, n) {
                var s, o = t(n),
                    r = e.devicePixelRatio > 1 && o.attr("data-src-retina") || o.attr("data-src");
                this._core.trigger("load", {
                    element: o,
                    url: r
                }, "lazy"), o.is("img") ? o.one("load.owl.lazy", t.proxy(function() {
                    o.css("opacity", 1), this._core.trigger("loaded", {
                        element: o,
                        url: r
                    }, "lazy")
                }, this)).attr("src", r) : (s = new Image, s.onload = t.proxy(function() {
                    o.css({
                        "background-image": "url(" + r + ")",
                        opacity: "1"
                    }), this._core.trigger("loaded", {
                        element: o,
                        url: r
                    }, "lazy")
                }, this), s.src = r)
            }, this)), this._loaded.push(n.get(0)))
        }, i.prototype.destroy = function() {
            var t, e;
            for (t in this.handlers) this._core.$element.off(t, this.handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Lazy = i
    }(window.Zepto || window.jQuery, window, document),
    function(t) {
        var e = function(i) {
            this._core = i, this._handlers = {
                "initialized.owl.carousel": t.proxy(function() {
                    this._core.settings.autoHeight && this.update()
                }, this),
                "changed.owl.carousel": t.proxy(function(t) {
                    this._core.settings.autoHeight && "position" == t.property.name && this.update()
                }, this),
                "loaded.owl.lazy": t.proxy(function(t) {
                    this._core.settings.autoHeight && t.element.closest("." + this._core.settings.itemClass) === this._core.$stage.children().eq(this._core.current()) && this.update()
                }, this)
            }, this._core.options = t.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers)
        };
        e.Defaults = {
            autoHeight: !1,
            autoHeightClass: "owl-height"
        }, e.prototype.update = function() {
            this._core.$stage.parent().height(this._core.$stage.children().eq(this._core.current()).height()).addClass(this._core.settings.autoHeightClass)
        }, e.prototype.destroy = function() {
            var t, e;
            for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.AutoHeight = e
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, i) {
        var n = function(e) {
            this._core = e, this._videos = {}, this._playing = null, this._fullscreen = !1, this._handlers = {
                "resize.owl.carousel": t.proxy(function(t) {
                    this._core.settings.video && !this.isInFullScreen() && t.preventDefault()
                }, this),
                "refresh.owl.carousel changed.owl.carousel": t.proxy(function() {
                    this._playing && this.stop()
                }, this),
                "prepared.owl.carousel": t.proxy(function(e) {
                    var i = t(e.content).find(".owl-video");
                    i.length && (i.css("display", "none"), this.fetch(i, t(e.content)))
                }, this)
            }, this._core.options = t.extend({}, n.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", t.proxy(function(t) {
                this.play(t)
            }, this))
        };
        n.Defaults = {
            video: !1,
            videoHeight: !1,
            videoWidth: !1
        }, n.prototype.fetch = function(t, e) {
            var i = t.attr("data-vimeo-id") ? "vimeo" : "youtube",
                n = t.attr("data-vimeo-id") || t.attr("data-youtube-id"),
                s = t.attr("data-width") || this._core.settings.videoWidth,
                o = t.attr("data-height") || this._core.settings.videoHeight,
                r = t.attr("href");
            if (!r) throw new Error("Missing video URL.");
            if (n = r.match(/(http:|https:|)\/\/(player.|www.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com))\/(video\/|embed\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/), n[3].indexOf("youtu") > -1) i = "youtube";
            else {
                if (!(n[3].indexOf("vimeo") > -1)) throw new Error("Video URL not supported.");
                i = "vimeo"
            }
            n = n[6], this._videos[r] = {
                type: i,
                id: n,
                width: s,
                height: o
            }, e.attr("data-video", r), this.thumbnail(t, this._videos[r])
        }, n.prototype.thumbnail = function(e, i) {
            var n, s, o, r = i.width && i.height ? 'style="width:' + i.width + "px;height:" + i.height + 'px;"' : "",
                a = e.find("img"),
                l = "src",
                h = "",
                c = this._core.settings,
                d = function(t) {
                    s = '<div class="owl-video-play-icon"></div>', n = c.lazyLoad ? '<div class="owl-video-tn ' + h + '" ' + l + '="' + t + '"></div>' : '<div class="owl-video-tn" style="opacity:1;background-image:url(' + t + ')"></div>', e.after(n), e.after(s)
                };
            return e.wrap('<div class="owl-video-wrapper"' + r + "></div>"), this._core.settings.lazyLoad && (l = "data-src", h = "owl-lazy"), a.length ? (d(a.attr(l)), a.remove(), !1) : void("youtube" === i.type ? (o = "http://img.youtube.com/vi/" + i.id + "/hqdefault.jpg", d(o)) : "vimeo" === i.type && t.ajax({
                type: "GET",
                url: "http://vimeo.com/api/v2/video/" + i.id + ".json",
                jsonp: "callback",
                dataType: "jsonp",
                success: function(t) {
                    o = t[0].thumbnail_large, d(o)
                }
            }))
        }, n.prototype.stop = function() {
            this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null
        }, n.prototype.play = function(e) {
            this._core.trigger("play", null, "video"), this._playing && this.stop();
            var i, n, s = t(e.target || e.srcElement),
                o = s.closest("." + this._core.settings.itemClass),
                r = this._videos[o.attr("data-video")],
                a = r.width || "100%",
                l = r.height || this._core.$stage.height();
            "youtube" === r.type ? i = '<iframe width="' + a + '" height="' + l + '" src="http://www.youtube.com/embed/' + r.id + "?autoplay=1&v=" + r.id + '" frameborder="0" allowfullscreen></iframe>' : "vimeo" === r.type && (i = '<iframe src="http://player.vimeo.com/video/' + r.id + '?autoplay=1" width="' + a + '" height="' + l + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>'), o.addClass("owl-video-playing"), this._playing = o, n = t('<div style="height:' + l + "px; width:" + a + 'px" class="owl-video-frame">' + i + "</div>"), s.after(n)
        }, n.prototype.isInFullScreen = function() {
            var n = i.fullscreenElement || i.mozFullScreenElement || i.webkitFullscreenElement;
            return n && t(n).parent().hasClass("owl-video-frame") && (this._core.speed(0), this._fullscreen = !0), n && this._fullscreen && this._playing ? !1 : this._fullscreen ? (this._fullscreen = !1, !1) : this._playing && this._core.state.orientation !== e.orientation ? (this._core.state.orientation = e.orientation, !1) : !0
        }, n.prototype.destroy = function() {
            var t, e;
            this._core.$element.off("click.owl.video");
            for (t in this._handlers) this._core.$element.off(t, this._handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Video = n
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, i, n) {
        var s = function(e) {
            this.core = e, this.core.options = t.extend({}, s.Defaults, this.core.options), this.swapping = !0, this.previous = n, this.next = n, this.handlers = {
                "change.owl.carousel": t.proxy(function(t) {
                    "position" == t.property.name && (this.previous = this.core.current(), this.next = t.property.value)
                }, this),
                "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": t.proxy(function(t) {
                    this.swapping = "translated" == t.type
                }, this),
                "translate.owl.carousel": t.proxy(function() {
                    this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap()
                }, this)
            }, this.core.$element.on(this.handlers)
        };
        s.Defaults = {
            animateOut: !1,
            animateIn: !1
        }, s.prototype.swap = function() {
            if (1 === this.core.settings.items && this.core.support3d) {
                this.core.speed(0);
                var e, i = t.proxy(this.clear, this),
                    n = this.core.$stage.children().eq(this.previous),
                    s = this.core.$stage.children().eq(this.next),
                    o = this.core.settings.animateIn,
                    r = this.core.settings.animateOut;
                this.core.current() !== this.previous && (r && (e = this.core.coordinates(this.previous) - this.core.coordinates(this.next), n.css({
                    left: e + "px"
                }).addClass("animated owl-animated-out").addClass(r).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", i)), o && s.addClass("animated owl-animated-in").addClass(o).one("webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend", i))
            }
        }, s.prototype.clear = function(e) {
            t(e.target).css({
                left: ""
            }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.transitionEnd()
        }, s.prototype.destroy = function() {
            var t, e;
            for (t in this.handlers) this.core.$element.off(t, this.handlers[t]);
            for (e in Object.getOwnPropertyNames(this)) "function" != typeof this[e] && (this[e] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Animate = s
    }(window.Zepto || window.jQuery, window, document),
    function(t, e, i) {
        var n = function(e) {
            this.core = e, this.core.options = t.extend({}, n.Defaults, this.core.options), this.handlers = {
                "translated.owl.carousel refreshed.owl.carousel": t.proxy(function() {
                    this.autoplay()
                }, this),
                "play.owl.autoplay": t.proxy(function(t, e, i) {
                    this.play(e, i)
                }, this),
                "stop.owl.autoplay": t.proxy(function() {
                    this.stop()
                }, this),
                "mouseover.owl.autoplay": t.proxy(function() {
                    this.core.settings.autoplayHoverPause && this.pause()
                }, this),
                "mouseleave.owl.autoplay": t.proxy(function() {
                    this.core.settings.autoplayHoverPause && this.autoplay()
                }, this)
            }, this.core.$element.on(this.handlers)
        };
        n.Defaults = {
            autoplay: !1,
            autoplayTimeout: 5e3,
            autoplayHoverPause: !1,
            autoplaySpeed: !1
        }, n.prototype.autoplay = function() {
            this.core.settings.autoplay && !this.core.state.videoPlay ? (e.clearInterval(this.interval), this.interval = e.setInterval(t.proxy(function() {
                this.play()
            }, this), this.core.settings.autoplayTimeout)) : e.clearInterval(this.interval)
        }, n.prototype.play = function() {
            return i.hidden === !0 || this.core.state.isTouch || this.core.state.isScrolling || this.core.state.isSwiping || this.core.state.inMotion ? void 0 : this.core.settings.autoplay === !1 ? void e.clearInterval(this.interval) : void this.core.next(this.core.settings.autoplaySpeed)
        }, n.prototype.stop = function() {
            e.clearInterval(this.interval)
        }, n.prototype.pause = function() {
            e.clearInterval(this.interval)
        }, n.prototype.destroy = function() {
            var t, i;
            e.clearInterval(this.interval);
            for (t in this.handlers) this.core.$element.off(t, this.handlers[t]);
            for (i in Object.getOwnPropertyNames(this)) "function" != typeof this[i] && (this[i] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.autoplay = n
    }(window.Zepto || window.jQuery, window, document),
    function(t) {
        "use strict";
        var e = function(i) {
            this._core = i, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = {
                next: this._core.next,
                prev: this._core.prev,
                to: this._core.to
            }, this._handlers = {
                "prepared.owl.carousel": t.proxy(function(e) {
                    this._core.settings.dotsData && this._templates.push(t(e.content).find("[data-dot]").andSelf("[data-dot]").attr("data-dot"))
                }, this),
                "add.owl.carousel": t.proxy(function(e) {
                    this._core.settings.dotsData && this._templates.splice(e.position, 0, t(e.content).find("[data-dot]").andSelf("[data-dot]").attr("data-dot"))
                }, this),
                "remove.owl.carousel prepared.owl.carousel": t.proxy(function(t) {
                    this._core.settings.dotsData && this._templates.splice(t.position, 1)
                }, this),
                "change.owl.carousel": t.proxy(function(t) {
                    if ("position" == t.property.name && !this._core.state.revert && !this._core.settings.loop && this._core.settings.navRewind) {
                        var e = this._core.current(),
                            i = this._core.maximum(),
                            n = this._core.minimum();
                        t.data = t.property.value > i ? e >= i ? n : i : t.property.value < n ? i : t.property.value
                    }
                }, this),
                "changed.owl.carousel": t.proxy(function(t) {
                    "position" == t.property.name && this.draw()
                }, this),
                "refreshed.owl.carousel": t.proxy(function() {
                    this._initialized || (this.initialize(), this._initialized = !0), this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation")
                }, this)
            }, this._core.options = t.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers)
        };
        e.Defaults = {
            nav: !1,
            navRewind: !0,
            navText: ["prev", "next"],
            navSpeed: !1,
            navElement: "div",
            navContainer: !1,
            navContainerClass: "owl-nav",
            navClass: ["owl-prev", "owl-next"],
            slideBy: 1,
            dotClass: "owl-dot",
            dotsClass: "owl-dots",
            dots: !0,
            dotsEach: !1,
            dotData: !1,
            dotsSpeed: !1,
            dotsContainer: !1,
            controlsClass: "owl-controls"
        }, e.prototype.initialize = function() {
            var e, i, n = this._core.settings;
            n.dotsData || (this._templates = [t("<div>").addClass(n.dotClass).append(t("<span>")).prop("outerHTML")]), n.navContainer && n.dotsContainer || (this._controls.$container = t("<div>").addClass(n.controlsClass).appendTo(this.$element)), this._controls.$indicators = n.dotsContainer ? t(n.dotsContainer) : t("<div>").hide().addClass(n.dotsClass).appendTo(this._controls.$container), this._controls.$indicators.on("click", "div", t.proxy(function(e) {
                var i = t(e.target).parent().is(this._controls.$indicators) ? t(e.target).index() : t(e.target).parent().index();
                e.preventDefault(), this.to(i, n.dotsSpeed)
            }, this)), e = n.navContainer ? t(n.navContainer) : t("<div>").addClass(n.navContainerClass).prependTo(this._controls.$container), this._controls.$next = t("<" + n.navElement + ">"), this._controls.$previous = this._controls.$next.clone(), this._controls.$previous.addClass(n.navClass[0]).html(n.navText[0]).hide().prependTo(e).on("click", t.proxy(function() {
                this.prev(n.navSpeed)
            }, this)), this._controls.$next.addClass(n.navClass[1]).html(n.navText[1]).hide().appendTo(e).on("click", t.proxy(function() {
                this.next(n.navSpeed)
            }, this));
            for (i in this._overrides) this._core[i] = t.proxy(this[i], this)
        }, e.prototype.destroy = function() {
            var t, e, i, n;
            for (t in this._handlers) this.$element.off(t, this._handlers[t]);
            for (e in this._controls) this._controls[e].remove();
            for (n in this.overides) this._core[n] = this._overrides[n];
            for (i in Object.getOwnPropertyNames(this)) "function" != typeof this[i] && (this[i] = null)
        }, e.prototype.update = function() {
            var t, e, i, n = this._core.settings,
                s = this._core.clones().length / 2,
                o = s + this._core.items().length,
                r = n.center || n.autoWidth || n.dotData ? 1 : n.dotsEach || n.items;
            if ("page" !== n.slideBy && (n.slideBy = Math.min(n.slideBy, n.items)), n.dots || "page" == n.slideBy)
                for (this._pages = [], t = s, e = 0, i = 0; o > t; t++)(e >= r || 0 === e) && (this._pages.push({
                    start: t - s,
                    end: t - s + r - 1
                }), e = 0, ++i), e += this._core.mergers(this._core.relative(t))
        }, e.prototype.draw = function() {
            var e, i, n = "",
                s = this._core.settings,
                o = (this._core.$stage.children(), this._core.relative(this._core.current()));
            if (!s.nav || s.loop || s.navRewind || (this._controls.$previous.toggleClass("disabled", 0 >= o), this._controls.$next.toggleClass("disabled", o >= this._core.maximum())), this._controls.$previous.toggle(s.nav), this._controls.$next.toggle(s.nav), s.dots) {
                if (e = this._pages.length - this._controls.$indicators.children().length, s.dotData && 0 !== e) {
                    for (i = 0; i < this._controls.$indicators.children().length; i++) n += this._templates[this._core.relative(i)];
                    this._controls.$indicators.html(n)
                } else e > 0 ? (n = new Array(e + 1).join(this._templates[0]), this._controls.$indicators.append(n)) : 0 > e && this._controls.$indicators.children().slice(e).remove();
                this._controls.$indicators.find(".active").removeClass("active"), this._controls.$indicators.children().eq(t.inArray(this.current(), this._pages)).addClass("active")
            }
            this._controls.$indicators.toggle(s.dots)
        }, e.prototype.onTrigger = function(e) {
            var i = this._core.settings;
            e.page = {
                index: t.inArray(this.current(), this._pages),
                count: this._pages.length,
                size: i && (i.center || i.autoWidth || i.dotData ? 1 : i.dotsEach || i.items)
            }
        }, e.prototype.current = function() {
            var e = this._core.relative(this._core.current());
            return t.grep(this._pages, function(t) {
                return t.start <= e && t.end >= e
            }).pop()
        }, e.prototype.getPosition = function(e) {
            var i, n, s = this._core.settings;
            return "page" == s.slideBy ? (i = t.inArray(this.current(), this._pages), n = this._pages.length, e ? ++i : --i, i = this._pages[(i % n + n) % n].start) : (i = this._core.relative(this._core.current()), n = this._core.items().length, e ? i += s.slideBy : i -= s.slideBy), i
        }, e.prototype.next = function(e) {
            t.proxy(this._overrides.to, this._core)(this.getPosition(!0), e)
        }, e.prototype.prev = function(e) {
            t.proxy(this._overrides.to, this._core)(this.getPosition(!1), e)
        }, e.prototype.to = function(e, i, n) {
            var s;
            n ? t.proxy(this._overrides.to, this._core)(e, i) : (s = this._pages.length, t.proxy(this._overrides.to, this._core)(this._pages[(e % s + s) % s].start, i))
        }, t.fn.owlCarousel.Constructor.Plugins.Navigation = e
    }(window.Zepto || window.jQuery, window, document),
    function(t, e) {
        "use strict";
        var i = function(n) {
            this._core = n, this._hashes = {}, this.$element = this._core.$element, this._handlers = {
                "initialized.owl.carousel": t.proxy(function() {
                    "URLHash" == this._core.settings.startPosition && t(e).trigger("hashchange.owl.navigation")
                }, this),
                "prepared.owl.carousel": t.proxy(function(e) {
                    var i = t(e.content).find("[data-hash]").andSelf("[data-hash]").attr("data-hash");
                    this._hashes[i] = e.content
                }, this)
            }, this._core.options = t.extend({}, i.Defaults, this._core.options), this.$element.on(this._handlers), t(e).on("hashchange.owl.navigation", t.proxy(function() {
                var t = e.location.hash.substring(1),
                    i = this._core.$stage.children(),
                    n = this._hashes[t] && i.index(this._hashes[t]) || 0;
                return t ? void this._core.to(n, !1, !0) : !1
            }, this))
        };
        i.Defaults = {
            URLhashListener: !1
        }, i.prototype.destroy = function() {
            var i, n;
            t(e).off("hashchange.owl.navigation");
            for (i in this._handlers) this._core.$element.off(i, this._handlers[i]);
            for (n in Object.getOwnPropertyNames(this)) "function" != typeof this[n] && (this[n] = null)
        }, t.fn.owlCarousel.Constructor.Plugins.Hash = i
    }(window.Zepto || window.jQuery, window, document), ! function(t) {
        t.fn.extend({
            accordionNew: function() {
                return this.each(function() {
                    function e(e, n) {
                        t(e).parent(l).siblings().removeClass(s).children(r).slideUp(a), t(e).siblings(r)[n || o]("show" == n ? a : !1, function() {
                            t(e).siblings(r).is(":visible") ? t(e).parents(l).not(i.parents()).addClass(s) : t(e).parent(l).removeClass(s), "show" == n && t(e).parents(l).not(i.parents()).addClass(s), t(e).parents().show()
                        })
                    }
                    var i = t(this),
                        n = "accordiated",
                        s = "active",
                        o = "slideToggle",
                        r = "ul, div",
                        a = "fast",
                        l = "li";
                    if (i.data(n)) return !1;
                    t.each(i.find("ul, li>div"), function() {
                        t(this).data(n, !0), t(this).hide()
                    }), t.each(i.find("em.open-close"), function() {
                        t(this).click(function() {
                            return void e(this, o)
                        }), t(this).bind("activate-node", function() {
                            i.find(r).not(t(this).parents()).not(t(this).siblings()).slideUp(a), e(this, "slideDown")
                        })
                    });
                    var h = location.hash ? i.find("a[href=" + location.hash + "]")[0] : i.find("li.current a")[0];
                    h && e(h, !1)
                })
            }
        })
    }(jQuery), jQuery(document).ready(function() {
        jQuery("ul.accordion li.parent, ul.accordion li.parents, ul#magicat li.open").each(function() {
            jQuery(this).removeClass("active"), jQuery(this).append('<em class="open-close">&nbsp;</em>')
        }), jQuery("ul.accordion, ul#magicat").accordionNew(), jQuery("ul.accordion li.active, ul#magicat li.active").each(function() {
            jQuery(this).children().next("div").css("display", "block")
        })
    });