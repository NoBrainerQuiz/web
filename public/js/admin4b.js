$(function() {
        $("input").typing(), $(".as-input").asInput(), $('[data-toggle="popover"]').popover(), $('[data-toggle="tooltip"]').tooltip(), $('[data-toggle="suggestion"]').suggestion()
    }),
    function(n) {
        n.fn.asInput = function() {
            return this.each(function() {
                var t = n(this),
                    i = t.find("input"),
                    e = function() {
                        t.toggleClass("disabled", i.is("[disabled]")), t.toggleClass("readonly", i.is("[readonly]"))
                    };
                t.on("click", function() {
                    i.focus()
                }), i.on("focus", function() {
                    t.addClass("focus")
                }).on("blur", function() {
                    t.removeClass("focus")
                }).observe(e), e()
            })
        }
    }(jQuery),
    function(n) {
        n.fn.suggestion = function(t) {
            return this.each(function() {
                (function() {
                    n(this).data("suggestion:initialized") || (n.fn.suggestion.select.apply(this), n.fn.suggestion.change.apply(this), n(this).is("[data-async]") ? n.fn.suggestion.async.apply(this) : n.fn.suggestion.static.apply(this), n(this).data("suggestion:initialized", !0))
                }).apply(this), "refresh" === t && n(this).trigger("suggestion:refresh")
            })
        }
    }(jQuery), $.fn.onFocusOut = function(n) {
        return this.each(function() {
            var t = $(document),
                i = $(this);

            function e(t) {
                $(t.target).closest(i).length || "function" == typeof n && n.call(this)
            }
            t.on("click", e), t.find("input").on("focus", e), t.find("select").on("focus", e), t.find("textarea").on("focus", e), t.find("button").on("focus", e), t.find("a").on("focus", e)
        })
    },
    function(n) {
        n.fn.observe = function(t) {
            var i = new MutationObserver(function(n) {
                n.forEach(function(n) {
                    t.apply(n.target)
                })
            });
            return this.each(function() {
                var e = n(this);
                e.on("DOMAttrModified onpropertychange", function() {
                    t.apply(this)
                }), i.observe(e.get(0), {
                    attributes: !0
                })
            })
        }
    }(jQuery), $.fn.typing = function() {
        return this.each(function() {
            var n = $(this),
                t = null;
            n.on("input", function() {
                clearTimeout(t), t = setTimeout(function() {
                    n.trigger("input:delay")
                }, 700)
            })
        })
    }, $(function() {
        $('[data-toggle="sidebar"]').on("click", function() {
            $(".app-sidebar").addClass("sidebar-open")
        }), $('[data-dismiss="sidebar"]').on("click", function() {
            $(".app-sidebar").removeClass("sidebar-open")
        })
    }), window.keyboard = function(n) {
        return this.isArrowDown = function() {
            return 40 === n
        }, this.isArrowUp = function() {
            return 38 === n
        }, this.isEnter = function() {
            return 13 === n
        }, this.isEscape = function() {
            return 27 === n
        }, this
    }, String.prototype.contains = function(n) {
        return new RegExp(n, "i").test(this)
    }, String.prototype.replaceAll = function(n, t) {
        return this.replace(new RegExp(n, "g"), t)
    },
    function(n) {
        n.fn.suggestion.async = function() {
            var t = n(this),
                i = t.closest(".input-suggestion").find(".input-suggestion-list"),
                e = i.find(".list-group.items").hide(),
                s = i.find(".list-group.empty").hide(),
                o = i.find(".list-group.loading").hide();
            t.on("input", function() {
                o.show(), s.hide(), e.hide()
            }).on("input:delay suggestion:show", function() {
                t.trigger("suggestion:search")
            }).on("suggestion:refresh", function() {
                n.fn.suggestion.change.apply(this), e.children().length ? e.show() : s.show(), o.hide()
            })
        }
    }(jQuery),
    function(n) {
        n.fn.suggestion.change = function() {
            var t = n(this),
                i = t.closest(".input-suggestion"),
                e = i.find(".input-suggestion-list").find(".list-group.items").children(),
                s = function(i) {
                    t.val(n.fn.suggestion.textOf(i)), t.trigger("suggestion:change", i)
                };
            e.on("click", function() {
                i.removeClass("open"), s(this)
            }), t.on("keypress", function(n) {
                var t = n.keyCode || n.which;
                if (keyboard(t).isEnter()) {
                    var i = e.filter(".active");
                    i.length && s(i.filter(".active"))
                }
            })
        }
    }(jQuery),
    function(n) {
        n.fn.suggestion.select = function() {
            var t = n(this),
                i = t.closest(".input-suggestion"),
                e = i.find(".input-suggestion-list").find(".list-group.items"),
                s = function() {
                    i.is(".open") || (e.children().removeClass("active"), i.addClass("open"), t.trigger("suggestion:show"))
                },
                o = function() {
                    i.is(".open") && (i.removeClass("open"), t.trigger("suggestion:hide"))
                };
            i.onFocusOut(o), t.on("input", s).on("keyup", function(n) {
                var t = n.keyCode || n.which;
                keyboard(t).isEscape() && o()
            }).on("keydown", function(n) {
                var t = n.keyCode || n.which,
                    o = keyboard(t);
                if (o.isArrowUp() || o.isArrowDown()) {
                    if (n.preventDefault(), !i.is(".open")) return void s();
                    var u = e.children(".active");
                    if (o.isArrowDown()) {
                        if (u.is(":last-child")) return;
                        u.length ? (u.removeClass("active"), u.next().addClass("active")) : e.children().eq(0).addClass("active")
                    }
                    if (o.isArrowUp()) {
                        if (u.is(":first-child")) return;
                        u.removeClass("active"), u.prev().addClass("active")
                    }
                }
            }).on("suggestion:change", o)
        }
    }(jQuery),
    function(n) {
        n.fn.suggestion.static = function() {
            var t = n(this),
                i = t.closest(".input-suggestion").find(".input-suggestion-list"),
                e = i.find(".list-group.empty").hide(),
                s = i.find(".list-group.items"),
                o = s.children(),
                u = [],
                r = function() {
                    o.removeClass("active"), u.forEach(function(n) {
                        var t = n.data("prev");
                        t.length ? n.insertAfter(t) : s.prepend(n)
                    }), u = [], o.each(function() {
                        var i = n(this);
                        n.fn.suggestion.textOf(i).contains(t.val()) || (u.push(i), i.data("prev", i.prev()))
                    }), u.forEach(function(n) {
                        n.detach()
                    }), s.children().length ? (e.hide(), s.show()) : (s.hide(), e.show())
                };
            t.on("input", r).on("suggestion:show", r)
        }
    }(jQuery),
    function(n) {
        n.fn.suggestion.textOf = function(t) {
            var i = n(t),
                e = i.closest(".input-suggestion").find("input");
            return e.is("[data-text]") && (i = i.find(e.attr("data-text"))), i.text().trim()
        }
    }(jQuery);