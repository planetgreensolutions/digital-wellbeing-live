/**
 * @license almond 0.3.3 Copyright jQuery Foundation and other contributors.
 * Released under MIT license, http://github.com/requirejs/almond/LICENSE
 */

/*!
 * jQuery JavaScript Library v1.12.4
 * http://jquery.com/
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2016-05-20T17:17Z
 */

/*!
 * Sizzle CSS Selector Engine v2.2.1
 * http://sizzlejs.com/
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license
 * http://jquery.org/license
 *
 * Date: 2015-10-17
 */

/**
   * @preserve FastClick: polyfill to remove click delays on browsers with touch UIs.
   *
   * @codingstandard ftlabs-jsv2
   * @copyright The Financial Times Limited [All Rights Reserved]
   * @license MIT License (see LICENSE.txt)
   */

/**
 * @license text 2.0.15 Copyright jQuery Foundation and other contributors.
 * Released under MIT license, http://github.com/requirejs/text/LICENSE
 */

!function() {
    var requirejs, require, define;
    !function(e) {
        function t(e, t) {
            return y.call(e, t)
        }
        function n(e, t) {
            var n, i, o, r, a, s, l, u, c, d, p, f, h = t && t.split("/"), g = m.map, v = g && g["*"] || {};
            if (e) {
                for (e = e.split("/"),
                a = e.length - 1,
                m.nodeIdCompat && w.test(e[a]) && (e[a] = e[a].replace(w, "")),
                "." === e[0].charAt(0) && h && (f = h.slice(0, h.length - 1),
                e = f.concat(e)),
                c = 0; c < e.length; c++)
                    if ("." === (p = e[c]))
                        e.splice(c, 1),
                        c -= 1;
                    else if (".." === p) {
                        if (0 === c || 1 === c && ".." === e[2] || ".." === e[c - 1])
                            continue;
                        c > 0 && (e.splice(c - 1, 2),
                        c -= 2)
                    }
                e = e.join("/")
            }
            if ((h || v) && g) {
                for (n = e.split("/"),
                c = n.length; c > 0; c -= 1) {
                    if (i = n.slice(0, c).join("/"),
                    h)
                        for (d = h.length; d > 0; d -= 1)
                            if ((o = g[h.slice(0, d).join("/")]) && (o = o[i])) {
                                r = o,
                                s = c;
                                break
                            }
                    if (r)
                        break;
                    !l && v && v[i] && (l = v[i],
                    u = c)
                }
                !r && l && (r = l,
                s = u),
                r && (n.splice(0, s, r),
                e = n.join("/"))
            }
            return e
        }
        function i(t, n) {
            return function() {
                var i = b.call(arguments, 0);
                return "string" != typeof i[0] && 1 === i.length && i.push(null),
                d.apply(e, i.concat([t, n]))
            }
        }
        function o(e) {
            return function(t) {
                return n(t, e)
            }
        }
        function r(e) {
            return function(t) {
                h[e] = t
            }
        }
        function a(n) {
            if (t(g, n)) {
                var i = g[n];
                delete g[n],
                v[n] = !0,
                c.apply(e, i)
            }
            if (!t(h, n) && !t(v, n))
                throw new Error("No " + n);
            return h[n]
        }
        function s(e) {
            var t, n = e ? e.indexOf("!") : -1;
            return n > -1 && (t = e.substring(0, n),
            e = e.substring(n + 1, e.length)),
            [t, e]
        }
        function l(e) {
            return e ? s(e) : []
        }
        function u(e) {
            return function() {
                return m && m.config && m.config[e] || {}
            }
        }
        var c, d, p, f, h = {}, g = {}, m = {}, v = {}, y = Object.prototype.hasOwnProperty, b = [].slice, w = /\.js$/;
        p = function(e, t) {
            var i, r = s(e), l = r[0], u = t[1];
            return e = r[1],
            l && (l = n(l, u),
            i = a(l)),
            l ? e = i && i.normalize ? i.normalize(e, o(u)) : n(e, u) : (e = n(e, u),
            r = s(e),
            l = r[0],
            e = r[1],
            l && (i = a(l))),
            {
                f: l ? l + "!" + e : e,
                n: e,
                pr: l,
                p: i
            }
        }
        ,
        f = {
            require: function(e) {
                return i(e)
            },
            exports: function(e) {
                var t = h[e];
                return void 0 !== t ? t : h[e] = {}
            },
            module: function(e) {
                return {
                    id: e,
                    uri: "",
                    exports: h[e],
                    config: u(e)
                }
            }
        },
        c = function(n, o, s, u) {
            var c, d, m, y, b, w, x, C = [], T = typeof s;
            if (u = u || n,
            w = l(u),
            "undefined" === T || "function" === T) {
                for (o = !o.length && s.length ? ["require", "exports", "module"] : o,
                b = 0; b < o.length; b += 1)
                    if (y = p(o[b], w),
                    "require" === (d = y.f))
                        C[b] = f.require(n);
                    else if ("exports" === d)
                        C[b] = f.exports(n),
                        x = !0;
                    else if ("module" === d)
                        c = C[b] = f.module(n);
                    else if (t(h, d) || t(g, d) || t(v, d))
                        C[b] = a(d);
                    else {
                        if (!y.p)
                            throw new Error(n + " missing " + d);
                        y.p.load(y.n, i(u, !0), r(d), {}),
                        C[b] = h[d]
                    }
                m = s ? s.apply(h[n], C) : void 0,
                n && (c && c.exports !== e && c.exports !== h[n] ? h[n] = c.exports : m === e && x || (h[n] = m))
            } else
                n && (h[n] = s)
        }
        ,
        requirejs = require = d = function(t, n, i, o, r) {
            if ("string" == typeof t)
                return f[t] ? f[t](n) : a(p(t, l(n)).f);
            if (!t.splice) {
                if (m = t,
                m.deps && d(m.deps, m.callback),
                !n)
                    return;
                n.splice ? (t = n,
                n = i,
                i = null) : t = e
            }
            return n = n || function() {}
            ,
            "function" == typeof i && (i = o,
            o = r),
            o ? c(e, t, n, i) : setTimeout(function() {
                c(e, t, n, i)
            }, 4),
            d
        }
        ,
        d.config = function(e) {
            return d(e)
        }
        ,
        requirejs._defined = h,
        define = function(e, n, i) {
            if ("string" != typeof e)
                throw new Error("See almond README: incorrect module build, no module name");
            n.splice || (i = n,
            n = []),
            t(h, e) || t(g, e) || (g[e] = [e, n, i])
        }
        ,
        define.amd = {
            jQuery: !0
        }
    }(),
    define("node_modules/almond/almond", function() {}),
    function(e, t) {
        "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function(e) {
            if (!e.document)
                throw new Error("jQuery requires a window with a document");
            return t(e)
        }
        : t(e)
    }("undefined" != typeof window ? window : this, function(e, t) {
        function n(e) {
            var t = !!e && "length"in e && e.length
              , n = pe.type(e);
            return "function" !== n && !pe.isWindow(e) && ("array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e)
        }
        function i(e, t, n) {
            if (pe.isFunction(t))
                return pe.grep(e, function(e, i) {
                    return !!t.call(e, i, e) !== n
                });
            if (t.nodeType)
                return pe.grep(e, function(e) {
                    return e === t !== n
                });
            if ("string" == typeof t) {
                if (Ce.test(t))
                    return pe.filter(t, e, n);
                t = pe.filter(t, e)
            }
            return pe.grep(e, function(e) {
                return pe.inArray(e, t) > -1 !== n
            })
        }
        function o(e, t) {
            do {
                e = e[t]
            } while (e && 1 !== e.nodeType);return e
        }
        function r(e) {
            var t = {};
            return pe.each(e.match(Ne) || [], function(e, n) {
                t[n] = !0
            }),
            t
        }
        function a() {
            ie.addEventListener ? (ie.removeEventListener("DOMContentLoaded", s),
            e.removeEventListener("load", s)) : (ie.detachEvent("onreadystatechange", s),
            e.detachEvent("onload", s))
        }
        function s() {
            (ie.addEventListener || "load" === e.event.type || "complete" === ie.readyState) && (a(),
            pe.ready())
        }
        function l(e, t, n) {
            if (void 0 === n && 1 === e.nodeType) {
                var i = "data-" + t.replace(_e, "-$1").toLowerCase();
                if ("string" == typeof (n = e.getAttribute(i))) {
                    try {
                        n = "true" === n || "false" !== n && ("null" === n ? null : +n + "" === n ? +n : Ae.test(n) ? pe.parseJSON(n) : n)
                    } catch (e) {}
                    pe.data(e, t, n)
                } else
                    n = void 0
            }
            return n
        }
        function u(e) {
            var t;
            for (t in e)
                if (("data" !== t || !pe.isEmptyObject(e[t])) && "toJSON" !== t)
                    return !1;
            return !0
        }
        function c(e, t, n, i) {
            if (je(e)) {
                var o, r, a = pe.expando, s = e.nodeType, l = s ? pe.cache : e, u = s ? e[a] : e[a] && a;
                if (u && l[u] && (i || l[u].data) || void 0 !== n || "string" != typeof t)
                    return u || (u = s ? e[a] = ne.pop() || pe.guid++ : a),
                    l[u] || (l[u] = s ? {} : {
                        toJSON: pe.noop
                    }),
                    "object" != typeof t && "function" != typeof t || (i ? l[u] = pe.extend(l[u], t) : l[u].data = pe.extend(l[u].data, t)),
                    r = l[u],
                    i || (r.data || (r.data = {}),
                    r = r.data),
                    void 0 !== n && (r[pe.camelCase(t)] = n),
                    "string" == typeof t ? null == (o = r[t]) && (o = r[pe.camelCase(t)]) : o = r,
                    o
            }
        }
        function d(e, t, n) {
            if (je(e)) {
                var i, o, r = e.nodeType, a = r ? pe.cache : e, s = r ? e[pe.expando] : pe.expando;
                if (a[s]) {
                    if (t && (i = n ? a[s] : a[s].data)) {
                        pe.isArray(t) ? t = t.concat(pe.map(t, pe.camelCase)) : t in i ? t = [t] : (t = pe.camelCase(t),
                        t = t in i ? [t] : t.split(" ")),
                        o = t.length;
                        for (; o--; )
                            delete i[t[o]];
                        if (n ? !u(i) : !pe.isEmptyObject(i))
                            return
                    }
                    (n || (delete a[s].data,
                    u(a[s]))) && (r ? pe.cleanData([e], !0) : de.deleteExpando || a != a.window ? delete a[s] : a[s] = void 0)
                }
            }
        }
        function p(e, t, n, i) {
            var o, r = 1, a = 20, s = i ? function() {
                return i.cur()
            }
            : function() {
                return pe.css(e, t, "")
            }
            , l = s(), u = n && n[3] || (pe.cssNumber[t] ? "" : "px"), c = (pe.cssNumber[t] || "px" !== u && +l) && Ie.exec(pe.css(e, t));
            if (c && c[3] !== u) {
                u = u || c[3],
                n = n || [],
                c = +l || 1;
                do {
                    r = r || ".5",
                    c /= r,
                    pe.style(e, t, c + u)
                } while (r !== (r = s() / l) && 1 !== r && --a)
            }
            return n && (c = +c || +l || 0,
            o = n[1] ? c + (n[1] + 1) * n[2] : +n[2],
            i && (i.unit = u,
            i.start = c,
            i.end = o)),
            o
        }
        function f(e) {
            var t = Be.split("|")
              , n = e.createDocumentFragment();
            if (n.createElement)
                for (; t.length; )
                    n.createElement(t.pop());
            return n
        }
        function h(e, t) {
            var n, i, o = 0, r = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : void 0;
            if (!r)
                for (r = [],
                n = e.childNodes || e; null != (i = n[o]); o++)
                    !t || pe.nodeName(i, t) ? r.push(i) : pe.merge(r, h(i, t));
            return void 0 === t || t && pe.nodeName(e, t) ? pe.merge([e], r) : r
        }
        function g(e, t) {
            for (var n, i = 0; null != (n = e[i]); i++)
                pe._data(n, "globalEval", !t || pe._data(t[i], "globalEval"))
        }
        function m(e) {
            Pe.test(e.type) && (e.defaultChecked = e.checked)
        }
        function v(e, t, n, i, o) {
            for (var r, a, s, l, u, c, d, p = e.length, v = f(t), y = [], b = 0; b < p; b++)
                if ((a = e[b]) || 0 === a)
                    if ("object" === pe.type(a))
                        pe.merge(y, a.nodeType ? [a] : a);
                    else if ($e.test(a)) {
                        for (l = l || v.appendChild(t.createElement("div")),
                        u = (Oe.exec(a) || ["", ""])[1].toLowerCase(),
                        d = Xe[u] || Xe._default,
                        l.innerHTML = d[1] + pe.htmlPrefilter(a) + d[2],
                        r = d[0]; r--; )
                            l = l.lastChild;
                        if (!de.leadingWhitespace && We.test(a) && y.push(t.createTextNode(We.exec(a)[0])),
                        !de.tbody)
                            for (a = "table" !== u || ze.test(a) ? "<table>" !== d[1] || ze.test(a) ? 0 : l : l.firstChild,
                            r = a && a.childNodes.length; r--; )
                                pe.nodeName(c = a.childNodes[r], "tbody") && !c.childNodes.length && a.removeChild(c);
                        for (pe.merge(y, l.childNodes),
                        l.textContent = ""; l.firstChild; )
                            l.removeChild(l.firstChild);
                        l = v.lastChild
                    } else
                        y.push(t.createTextNode(a));
            for (l && v.removeChild(l),
            de.appendChecked || pe.grep(h(y, "input"), m),
            b = 0; a = y[b++]; )
                if (i && pe.inArray(a, i) > -1)
                    o && o.push(a);
                else if (s = pe.contains(a.ownerDocument, a),
                l = h(v.appendChild(a), "script"),
                s && g(l),
                n)
                    for (r = 0; a = l[r++]; )
                        Re.test(a.type || "") && n.push(a);
            return l = null,
            v
        }
        function y() {
            return !0
        }
        function b() {
            return !1
        }
        function w() {
            try {
                return ie.activeElement
            } catch (e) {}
        }
        function x(e, t, n, i, o, r) {
            var a, s;
            if ("object" == typeof t) {
                "string" != typeof n && (i = i || n,
                n = void 0);
                for (s in t)
                    x(e, s, n, i, t[s], r);
                return e
            }
            if (null == i && null == o ? (o = n,
            i = n = void 0) : null == o && ("string" == typeof n ? (o = i,
            i = void 0) : (o = i,
            i = n,
            n = void 0)),
            !1 === o)
                o = b;
            else if (!o)
                return e;
            return 1 === r && (a = o,
            o = function(e) {
                return pe().off(e),
                a.apply(this, arguments)
            }
            ,
            o.guid = a.guid || (a.guid = pe.guid++)),
            e.each(function() {
                pe.event.add(this, t, o, i, n)
            })
        }
        function C(e, t) {
            return pe.nodeName(e, "table") && pe.nodeName(11 !== t.nodeType ? t : t.firstChild, "tr") ? e.getElementsByTagName("tbody")[0] || e.appendChild(e.ownerDocument.createElement("tbody")) : e
        }
        function T(e) {
            return e.type = (null !== pe.find.attr(e, "type")) + "/" + e.type,
            e
        }
        function k(e) {
            var t = nt.exec(e.type);
            return t ? e.type = t[1] : e.removeAttribute("type"),
            e
        }
        function S(e, t) {
            if (1 === t.nodeType && pe.hasData(e)) {
                var n, i, o, r = pe._data(e), a = pe._data(t, r), s = r.events;
                if (s) {
                    delete a.handle,
                    a.events = {};
                    for (n in s)
                        for (i = 0,
                        o = s[n].length; i < o; i++)
                            pe.event.add(t, n, s[n][i])
                }
                a.data && (a.data = pe.extend({}, a.data))
            }
        }
        function E(e, t) {
            var n, i, o;
            if (1 === t.nodeType) {
                if (n = t.nodeName.toLowerCase(),
                !de.noCloneEvent && t[pe.expando]) {
                    o = pe._data(t);
                    for (i in o.events)
                        pe.removeEvent(t, i, o.handle);
                    t.removeAttribute(pe.expando)
                }
                "script" === n && t.text !== e.text ? (T(t).text = e.text,
                k(t)) : "object" === n ? (t.parentNode && (t.outerHTML = e.outerHTML),
                de.html5Clone && e.innerHTML && !pe.trim(t.innerHTML) && (t.innerHTML = e.innerHTML)) : "input" === n && Pe.test(e.type) ? (t.defaultChecked = t.checked = e.checked,
                t.value !== e.value && (t.value = e.value)) : "option" === n ? t.defaultSelected = t.selected = e.defaultSelected : "input" !== n && "textarea" !== n || (t.defaultValue = e.defaultValue)
            }
        }
        function N(e, t, n, i) {
            t = re.apply([], t);
            var o, r, a, s, l, u, c = 0, d = e.length, p = d - 1, f = t[0], g = pe.isFunction(f);
            if (g || d > 1 && "string" == typeof f && !de.checkClone && tt.test(f))
                return e.each(function(o) {
                    var r = e.eq(o);
                    g && (t[0] = f.call(this, o, r.html())),
                    N(r, t, n, i)
                });
            if (d && (u = v(t, e[0].ownerDocument, !1, e, i),
            o = u.firstChild,
            1 === u.childNodes.length && (u = o),
            o || i)) {
                for (s = pe.map(h(u, "script"), T),
                a = s.length; c < d; c++)
                    r = u,
                    c !== p && (r = pe.clone(r, !0, !0),
                    a && pe.merge(s, h(r, "script"))),
                    n.call(e[c], r, c);
                if (a)
                    for (l = s[s.length - 1].ownerDocument,
                    pe.map(s, k),
                    c = 0; c < a; c++)
                        r = s[c],
                        Re.test(r.type || "") && !pe._data(r, "globalEval") && pe.contains(l, r) && (r.src ? pe._evalUrl && pe._evalUrl(r.src) : pe.globalEval((r.text || r.textContent || r.innerHTML || "").replace(it, "")));
                u = o = null
            }
            return e
        }
        function D(e, t, n) {
            for (var i, o = t ? pe.filter(t, e) : e, r = 0; null != (i = o[r]); r++)
                n || 1 !== i.nodeType || pe.cleanData(h(i)),
                i.parentNode && (n && pe.contains(i.ownerDocument, i) && g(h(i, "script")),
                i.parentNode.removeChild(i));
            return e
        }
        function L(e, t) {
            var n = pe(t.createElement(e)).appendTo(t.body)
              , i = pe.css(n[0], "display");
            return n.detach(),
            i
        }
        function j(e) {
            var t = ie
              , n = st[e];
            return n || (n = L(e, t),
            "none" !== n && n || (at = (at || pe("<iframe frameborder='0' width='0' height='0'/>")).appendTo(t.documentElement),
            t = (at[0].contentWindow || at[0].contentDocument).document,
            t.write(),
            t.close(),
            n = L(e, t),
            at.detach()),
            st[e] = n),
            n
        }
        function A(e, t) {
            return {
                get: function() {
                    return e() ? void delete this.get : (this.get = t).apply(this, arguments)
                }
            }
        }
        function _(e) {
            if (e in Ct)
                return e;
            for (var t = e.charAt(0).toUpperCase() + e.slice(1), n = xt.length; n--; )
                if ((e = xt[n] + t)in Ct)
                    return e
        }
        function q(e, t) {
            for (var n, i, o, r = [], a = 0, s = e.length; a < s; a++)
                i = e[a],
                i.style && (r[a] = pe._data(i, "olddisplay"),
                n = i.style.display,
                t ? (r[a] || "none" !== n || (i.style.display = ""),
                "" === i.style.display && Me(i) && (r[a] = pe._data(i, "olddisplay", j(i.nodeName)))) : (o = Me(i),
                (n && "none" !== n || !o) && pe._data(i, "olddisplay", o ? n : pe.css(i, "display"))));
            for (a = 0; a < s; a++)
                i = e[a],
                i.style && (t && "none" !== i.style.display && "" !== i.style.display || (i.style.display = t ? r[a] || "" : "none"));
            return e
        }
        function I(e, t, n) {
            var i = yt.exec(t);
            return i ? Math.max(0, i[1] - (n || 0)) + (i[2] || "px") : t
        }
        function H(e, t, n, i, o) {
            for (var r = n === (i ? "border" : "content") ? 4 : "width" === t ? 1 : 0, a = 0; r < 4; r += 2)
                "margin" === n && (a += pe.css(e, n + He[r], !0, o)),
                i ? ("content" === n && (a -= pe.css(e, "padding" + He[r], !0, o)),
                "margin" !== n && (a -= pe.css(e, "border" + He[r] + "Width", !0, o))) : (a += pe.css(e, "padding" + He[r], !0, o),
                "padding" !== n && (a += pe.css(e, "border" + He[r] + "Width", !0, o)));
            return a
        }
        function M(e, t, n) {
            var i = !0
              , o = "width" === t ? e.offsetWidth : e.offsetHeight
              , r = pt(e)
              , a = de.boxSizing && "border-box" === pe.css(e, "boxSizing", !1, r);
            if (o <= 0 || null == o) {
                if (o = ft(e, t, r),
                (o < 0 || null == o) && (o = e.style[t]),
                ut.test(o))
                    return o;
                i = a && (de.boxSizingReliable() || o === e.style[t]),
                o = parseFloat(o) || 0
            }
            return o + H(e, t, n || (a ? "border" : "content"), i, r) + "px"
        }
        function F(e, t, n, i, o) {
            return new F.prototype.init(e,t,n,i,o)
        }
        function P() {
            return e.setTimeout(function() {
                Tt = void 0
            }),
            Tt = pe.now()
        }
        function O(e, t) {
            var n, i = {
                height: e
            }, o = 0;
            for (t = t ? 1 : 0; o < 4; o += 2 - t)
                n = He[o],
                i["margin" + n] = i["padding" + n] = e;
            return t && (i.opacity = i.width = e),
            i
        }
        function R(e, t, n) {
            for (var i, o = (X.tweeners[t] || []).concat(X.tweeners["*"]), r = 0, a = o.length; r < a; r++)
                if (i = o[r].call(n, t, e))
                    return i
        }
        function W(e, t, n) {
            var i, o, r, a, s, l, u, c = this, d = {}, p = e.style, f = e.nodeType && Me(e), h = pe._data(e, "fxshow");
            n.queue || (s = pe._queueHooks(e, "fx"),
            null == s.unqueued && (s.unqueued = 0,
            l = s.empty.fire,
            s.empty.fire = function() {
                s.unqueued || l()
            }
            ),
            s.unqueued++,
            c.always(function() {
                c.always(function() {
                    s.unqueued--,
                    pe.queue(e, "fx").length || s.empty.fire()
                })
            })),
            1 === e.nodeType && ("height"in t || "width"in t) && (n.overflow = [p.overflow, p.overflowX, p.overflowY],
            u = pe.css(e, "display"),
            "inline" === ("none" === u ? pe._data(e, "olddisplay") || j(e.nodeName) : u) && "none" === pe.css(e, "float") && (de.inlineBlockNeedsLayout && "inline" !== j(e.nodeName) ? p.zoom = 1 : p.display = "inline-block")),
            n.overflow && (p.overflow = "hidden",
            de.shrinkWrapBlocks() || c.always(function() {
                p.overflow = n.overflow[0],
                p.overflowX = n.overflow[1],
                p.overflowY = n.overflow[2]
            }));
            for (i in t)
                if (o = t[i],
                St.exec(o)) {
                    if (delete t[i],
                    r = r || "toggle" === o,
                    o === (f ? "hide" : "show")) {
                        if ("show" !== o || !h || void 0 === h[i])
                            continue;
                        f = !0
                    }
                    d[i] = h && h[i] || pe.style(e, i)
                } else
                    u = void 0;
            if (pe.isEmptyObject(d))
                "inline" === ("none" === u ? j(e.nodeName) : u) && (p.display = u);
            else {
                h ? "hidden"in h && (f = h.hidden) : h = pe._data(e, "fxshow", {}),
                r && (h.hidden = !f),
                f ? pe(e).show() : c.done(function() {
                    pe(e).hide()
                }),
                c.done(function() {
                    var t;
                    pe._removeData(e, "fxshow");
                    for (t in d)
                        pe.style(e, t, d[t])
                });
                for (i in d)
                    a = R(f ? h[i] : 0, i, c),
                    i in h || (h[i] = a.start,
                    f && (a.end = a.start,
                    a.start = "width" === i || "height" === i ? 1 : 0))
            }
        }
        function B(e, t) {
            var n, i, o, r, a;
            for (n in e)
                if (i = pe.camelCase(n),
                o = t[i],
                r = e[n],
                pe.isArray(r) && (o = r[1],
                r = e[n] = r[0]),
                n !== i && (e[i] = r,
                delete e[n]),
                (a = pe.cssHooks[i]) && "expand"in a) {
                    r = a.expand(r),
                    delete e[i];
                    for (n in r)
                        n in e || (e[n] = r[n],
                        t[n] = o)
                } else
                    t[i] = o
        }
        function X(e, t, n) {
            var i, o, r = 0, a = X.prefilters.length, s = pe.Deferred().always(function() {
                delete l.elem
            }), l = function() {
                if (o)
                    return !1;
                for (var t = Tt || P(), n = Math.max(0, u.startTime + u.duration - t), i = n / u.duration || 0, r = 1 - i, a = 0, l = u.tweens.length; a < l; a++)
                    u.tweens[a].run(r);
                return s.notifyWith(e, [u, r, n]),
                r < 1 && l ? n : (s.resolveWith(e, [u]),
                !1)
            }, u = s.promise({
                elem: e,
                props: pe.extend({}, t),
                opts: pe.extend(!0, {
                    specialEasing: {},
                    easing: pe.easing._default
                }, n),
                originalProperties: t,
                originalOptions: n,
                startTime: Tt || P(),
                duration: n.duration,
                tweens: [],
                createTween: function(t, n) {
                    var i = pe.Tween(e, u.opts, t, n, u.opts.specialEasing[t] || u.opts.easing);
                    return u.tweens.push(i),
                    i
                },
                stop: function(t) {
                    var n = 0
                      , i = t ? u.tweens.length : 0;
                    if (o)
                        return this;
                    for (o = !0; n < i; n++)
                        u.tweens[n].run(1);
                    return t ? (s.notifyWith(e, [u, 1, 0]),
                    s.resolveWith(e, [u, t])) : s.rejectWith(e, [u, t]),
                    this
                }
            }), c = u.props;
            for (B(c, u.opts.specialEasing); r < a; r++)
                if (i = X.prefilters[r].call(u, e, c, u.opts))
                    return pe.isFunction(i.stop) && (pe._queueHooks(u.elem, u.opts.queue).stop = pe.proxy(i.stop, i)),
                    i;
            return pe.map(c, R, u),
            pe.isFunction(u.opts.start) && u.opts.start.call(e, u),
            pe.fx.timer(pe.extend(l, {
                elem: e,
                anim: u,
                queue: u.opts.queue
            })),
            u.progress(u.opts.progress).done(u.opts.done, u.opts.complete).fail(u.opts.fail).always(u.opts.always)
        }
        function $(e) {
            return pe.attr(e, "class") || ""
        }
        function z(e) {
            return function(t, n) {
                "string" != typeof t && (n = t,
                t = "*");
                var i, o = 0, r = t.toLowerCase().match(Ne) || [];
                if (pe.isFunction(n))
                    for (; i = r[o++]; )
                        "+" === i.charAt(0) ? (i = i.slice(1) || "*",
                        (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n)
            }
        }
        function V(e, t, n, i) {
            function o(s) {
                var l;
                return r[s] = !0,
                pe.each(e[s] || [], function(e, s) {
                    var u = s(t, n, i);
                    return "string" != typeof u || a || r[u] ? a ? !(l = u) : void 0 : (t.dataTypes.unshift(u),
                    o(u),
                    !1)
                }),
                l
            }
            var r = {}
              , a = e === Jt;
            return o(t.dataTypes[0]) || !r["*"] && o("*")
        }
        function U(e, t) {
            var n, i, o = pe.ajaxSettings.flatOptions || {};
            for (i in t)
                void 0 !== t[i] && ((o[i] ? e : n || (n = {}))[i] = t[i]);
            return n && pe.extend(!0, e, n),
            e
        }
        function G(e, t, n) {
            for (var i, o, r, a, s = e.contents, l = e.dataTypes; "*" === l[0]; )
                l.shift(),
                void 0 === o && (o = e.mimeType || t.getResponseHeader("Content-Type"));
            if (o)
                for (a in s)
                    if (s[a] && s[a].test(o)) {
                        l.unshift(a);
                        break
                    }
            if (l[0]in n)
                r = l[0];
            else {
                for (a in n) {
                    if (!l[0] || e.converters[a + " " + l[0]]) {
                        r = a;
                        break
                    }
                    i || (i = a)
                }
                r = r || i
            }
            if (r)
                return r !== l[0] && l.unshift(r),
                n[r]
        }
        function Y(e, t, n, i) {
            var o, r, a, s, l, u = {}, c = e.dataTypes.slice();
            if (c[1])
                for (a in e.converters)
                    u[a.toLowerCase()] = e.converters[a];
            for (r = c.shift(); r; )
                if (e.responseFields[r] && (n[e.responseFields[r]] = t),
                !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)),
                l = r,
                r = c.shift())
                    if ("*" === r)
                        r = l;
                    else if ("*" !== l && l !== r) {
                        if (!(a = u[l + " " + r] || u["* " + r]))
                            for (o in u)
                                if (s = o.split(" "),
                                s[1] === r && (a = u[l + " " + s[0]] || u["* " + s[0]])) {
                                    !0 === a ? a = u[o] : !0 !== u[o] && (r = s[0],
                                    c.unshift(s[1]));
                                    break
                                }
                        if (!0 !== a)
                            if (a && e.throws)
                                t = a(t);
                            else
                                try {
                                    t = a(t)
                                } catch (e) {
                                    return {
                                        state: "parsererror",
                                        error: a ? e : "No conversion from " + l + " to " + r
                                    }
                                }
                    }
            return {
                state: "success",
                data: t
            }
        }
        function J(e) {
            return e.style && e.style.display || pe.css(e, "display")
        }
        function K(e) {
            if (!pe.contains(e.ownerDocument || ie, e))
                return !0;
            for (; e && 1 === e.nodeType; ) {
                if ("none" === J(e) || "hidden" === e.type)
                    return !0;
                e = e.parentNode
            }
            return !1
        }
        function Q(e, t, n, i) {
            var o;
            if (pe.isArray(t))
                pe.each(t, function(t, o) {
                    n || tn.test(e) ? i(e, o) : Q(e + "[" + ("object" == typeof o && null != o ? t : "") + "]", o, n, i)
                });
            else if (n || "object" !== pe.type(t))
                i(e, t);
            else
                for (o in t)
                    Q(e + "[" + o + "]", t[o], n, i)
        }
        function Z() {
            try {
                return new e.XMLHttpRequest
            } catch (e) {}
        }
        function ee() {
            try {
                return new e.ActiveXObject("Microsoft.XMLHTTP")
            } catch (e) {}
        }
        function te(e) {
            return pe.isWindow(e) ? e : 9 === e.nodeType && (e.defaultView || e.parentWindow)
        }
        var ne = []
          , ie = e.document
          , oe = ne.slice
          , re = ne.concat
          , ae = ne.push
          , se = ne.indexOf
          , le = {}
          , ue = le.toString
          , ce = le.hasOwnProperty
          , de = {}
          , pe = function(e, t) {
            return new pe.fn.init(e,t)
        }
          , fe = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g
          , he = /^-ms-/
          , ge = /-([\da-z])/gi
          , me = function(e, t) {
            return t.toUpperCase()
        };
        pe.fn = pe.prototype = {
            jquery: "1.12.4",
            constructor: pe,
            selector: "",
            length: 0,
            toArray: function() {
                return oe.call(this)
            },
            get: function(e) {
                return null != e ? e < 0 ? this[e + this.length] : this[e] : oe.call(this)
            },
            pushStack: function(e) {
                var t = pe.merge(this.constructor(), e);
                return t.prevObject = this,
                t.context = this.context,
                t
            },
            each: function(e) {
                return pe.each(this, e)
            },
            map: function(e) {
                return this.pushStack(pe.map(this, function(t, n) {
                    return e.call(t, n, t)
                }))
            },
            slice: function() {
                return this.pushStack(oe.apply(this, arguments))
            },
            first: function() {
                return this.eq(0)
            },
            last: function() {
                return this.eq(-1)
            },
            eq: function(e) {
                var t = this.length
                  , n = +e + (e < 0 ? t : 0);
                return this.pushStack(n >= 0 && n < t ? [this[n]] : [])
            },
            end: function() {
                return this.prevObject || this.constructor()
            },
            push: ae,
            sort: ne.sort,
            splice: ne.splice
        },
        pe.extend = pe.fn.extend = function() {
            var e, t, n, i, o, r, a = arguments[0] || {}, s = 1, l = arguments.length, u = !1;
            for ("boolean" == typeof a && (u = a,
            a = arguments[s] || {},
            s++),
            "object" == typeof a || pe.isFunction(a) || (a = {}),
            s === l && (a = this,
            s--); s < l; s++)
                if (null != (o = arguments[s]))
                    for (i in o)
                        e = a[i],
                        n = o[i],
                        a !== n && (u && n && (pe.isPlainObject(n) || (t = pe.isArray(n))) ? (t ? (t = !1,
                        r = e && pe.isArray(e) ? e : []) : r = e && pe.isPlainObject(e) ? e : {},
                        a[i] = pe.extend(u, r, n)) : void 0 !== n && (a[i] = n));
            return a
        }
        ,
        pe.extend({
            expando: "jQuery" + ("1.12.4" + Math.random()).replace(/\D/g, ""),
            isReady: !0,
            error: function(e) {
                throw new Error(e)
            },
            noop: function() {},
            isFunction: function(e) {
                return "function" === pe.type(e)
            },
            isArray: Array.isArray || function(e) {
                return "array" === pe.type(e)
            }
            ,
            isWindow: function(e) {
                return null != e && e == e.window
            },
            isNumeric: function(e) {
                var t = e && e.toString();
                return !pe.isArray(e) && t - parseFloat(t) + 1 >= 0
            },
            isEmptyObject: function(e) {
                var t;
                for (t in e)
                    return !1;
                return !0
            },
            isPlainObject: function(e) {
                var t;
                if (!e || "object" !== pe.type(e) || e.nodeType || pe.isWindow(e))
                    return !1;
                try {
                    if (e.constructor && !ce.call(e, "constructor") && !ce.call(e.constructor.prototype, "isPrototypeOf"))
                        return !1
                } catch (e) {
                    return !1
                }
                if (!de.ownFirst)
                    for (t in e)
                        return ce.call(e, t);
                for (t in e)
                    ;
                return void 0 === t || ce.call(e, t)
            },
            type: function(e) {
                return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? le[ue.call(e)] || "object" : typeof e
            },
            globalEval: function(t) {
                t && pe.trim(t) && (e.execScript || function(t) {
                    e.eval.call(e, t)
                }
                )(t)
            },
            camelCase: function(e) {
                return e.replace(he, "ms-").replace(ge, me)
            },
            nodeName: function(e, t) {
                return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
            },
            each: function(e, t) {
                var i, o = 0;
                if (n(e))
                    for (i = e.length; o < i && !1 !== t.call(e[o], o, e[o]); o++)
                        ;
                else
                    for (o in e)
                        if (!1 === t.call(e[o], o, e[o]))
                            break;
                return e
            },
            trim: function(e) {
                return null == e ? "" : (e + "").replace(fe, "")
            },
            makeArray: function(e, t) {
                var i = t || [];
                return null != e && (n(Object(e)) ? pe.merge(i, "string" == typeof e ? [e] : e) : ae.call(i, e)),
                i
            },
            inArray: function(e, t, n) {
                var i;
                if (t) {
                    if (se)
                        return se.call(t, e, n);
                    for (i = t.length,
                    n = n ? n < 0 ? Math.max(0, i + n) : n : 0; n < i; n++)
                        if (n in t && t[n] === e)
                            return n
                }
                return -1
            },
            merge: function(e, t) {
                for (var n = +t.length, i = 0, o = e.length; i < n; )
                    e[o++] = t[i++];
                if (n !== n)
                    for (; void 0 !== t[i]; )
                        e[o++] = t[i++];
                return e.length = o,
                e
            },
            grep: function(e, t, n) {
                for (var i = [], o = 0, r = e.length, a = !n; o < r; o++)
                    !t(e[o], o) !== a && i.push(e[o]);
                return i
            },
            map: function(e, t, i) {
                var o, r, a = 0, s = [];
                if (n(e))
                    for (o = e.length; a < o; a++)
                        null != (r = t(e[a], a, i)) && s.push(r);
                else
                    for (a in e)
                        null != (r = t(e[a], a, i)) && s.push(r);
                return re.apply([], s)
            },
            guid: 1,
            proxy: function(e, t) {
                var n, i, o;
                if ("string" == typeof t && (o = e[t],
                t = e,
                e = o),
                pe.isFunction(e))
                    return n = oe.call(arguments, 2),
                    i = function() {
                        return e.apply(t || this, n.concat(oe.call(arguments)))
                    }
                    ,
                    i.guid = e.guid = e.guid || pe.guid++,
                    i
            },
            now: function() {
                return +new Date
            },
            support: de
        }),
        "function" == typeof Symbol && (pe.fn[Symbol.iterator] = ne[Symbol.iterator]),
        pe.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(e, t) {
            le["[object " + t + "]"] = t.toLowerCase()
        });
        var ve = function(e) {
            function t(e, t, n, i) {
                var o, r, a, s, u, d, p, f, h = t && t.ownerDocument, g = t ? t.nodeType : 9;
                if (n = n || [],
                "string" != typeof e || !e || 1 !== g && 9 !== g && 11 !== g)
                    return n;
                if (!i && ((t ? t.ownerDocument || t : P) !== j && L(t),
                t = t || j,
                _)) {
                    if (11 !== g && (d = ge.exec(e)))
                        if (o = d[1]) {
                            if (9 === g) {
                                if (!(a = t.getElementById(o)))
                                    return n;
                                if (a.id === o)
                                    return n.push(a),
                                    n
                            } else if (h && (a = h.getElementById(o)) && M(t, a) && a.id === o)
                                return n.push(a),
                                n
                        } else {
                            if (d[2])
                                return J.apply(n, t.getElementsByTagName(e)),
                                n;
                            if ((o = d[3]) && b.getElementsByClassName && t.getElementsByClassName)
                                return J.apply(n, t.getElementsByClassName(o)),
                                n
                        }
                    if (b.qsa && !X[e + " "] && (!q || !q.test(e))) {
                        if (1 !== g)
                            h = t,
                            f = e;
                        else if ("object" !== t.nodeName.toLowerCase()) {
                            for ((s = t.getAttribute("id")) ? s = s.replace(ve, "\\$&") : t.setAttribute("id", s = F),
                            p = T(e),
                            r = p.length,
                            u = ce.test(s) ? "#" + s : "[id='" + s + "']"; r--; )
                                p[r] = u + " " + c(p[r]);
                            f = p.join(","),
                            h = me.test(e) && l(t.parentNode) || t
                        }
                        if (f)
                            try {
                                return J.apply(n, h.querySelectorAll(f)),
                                n
                            } catch (e) {} finally {
                                s === F && t.removeAttribute("id")
                            }
                    }
                }
                return S(e.replace(re, "$1"), t, n, i)
            }
            function n() {
                function e(n, i) {
                    return t.push(n + " ") > w.cacheLength && delete e[t.shift()],
                    e[n + " "] = i
                }
                var t = [];
                return e
            }
            function i(e) {
                return e[F] = !0,
                e
            }
            function o(e) {
                var t = j.createElement("div");
                try {
                    return !!e(t)
                } catch (e) {
                    return !1
                } finally {
                    t.parentNode && t.parentNode.removeChild(t),
                    t = null
                }
            }
            function r(e, t) {
                for (var n = e.split("|"), i = n.length; i--; )
                    w.attrHandle[n[i]] = t
            }
            function a(e, t) {
                var n = t && e
                  , i = n && 1 === e.nodeType && 1 === t.nodeType && (~t.sourceIndex || z) - (~e.sourceIndex || z);
                if (i)
                    return i;
                if (n)
                    for (; n = n.nextSibling; )
                        if (n === t)
                            return -1;
                return e ? 1 : -1
            }
            function s(e) {
                return i(function(t) {
                    return t = +t,
                    i(function(n, i) {
                        for (var o, r = e([], n.length, t), a = r.length; a--; )
                            n[o = r[a]] && (n[o] = !(i[o] = n[o]))
                    })
                })
            }
            function l(e) {
                return e && void 0 !== e.getElementsByTagName && e
            }
            function u() {}
            function c(e) {
                for (var t = 0, n = e.length, i = ""; t < n; t++)
                    i += e[t].value;
                return i
            }
            function d(e, t, n) {
                var i = t.dir
                  , o = n && "parentNode" === i
                  , r = R++;
                return t.first ? function(t, n, r) {
                    for (; t = t[i]; )
                        if (1 === t.nodeType || o)
                            return e(t, n, r)
                }
                : function(t, n, a) {
                    var s, l, u, c = [O, r];
                    if (a) {
                        for (; t = t[i]; )
                            if ((1 === t.nodeType || o) && e(t, n, a))
                                return !0
                    } else
                        for (; t = t[i]; )
                            if (1 === t.nodeType || o) {
                                if (u = t[F] || (t[F] = {}),
                                l = u[t.uniqueID] || (u[t.uniqueID] = {}),
                                (s = l[i]) && s[0] === O && s[1] === r)
                                    return c[2] = s[2];
                                if (l[i] = c,
                                c[2] = e(t, n, a))
                                    return !0
                            }
                }
            }
            function p(e) {
                return e.length > 1 ? function(t, n, i) {
                    for (var o = e.length; o--; )
                        if (!e[o](t, n, i))
                            return !1;
                    return !0
                }
                : e[0]
            }
            function f(e, n, i) {
                for (var o = 0, r = n.length; o < r; o++)
                    t(e, n[o], i);
                return i
            }
            function h(e, t, n, i, o) {
                for (var r, a = [], s = 0, l = e.length, u = null != t; s < l; s++)
                    (r = e[s]) && (n && !n(r, i, o) || (a.push(r),
                    u && t.push(s)));
                return a
            }
            function g(e, t, n, o, r, a) {
                return o && !o[F] && (o = g(o)),
                r && !r[F] && (r = g(r, a)),
                i(function(i, a, s, l) {
                    var u, c, d, p = [], g = [], m = a.length, v = i || f(t || "*", s.nodeType ? [s] : s, []), y = !e || !i && t ? v : h(v, p, e, s, l), b = n ? r || (i ? e : m || o) ? [] : a : y;
                    if (n && n(y, b, s, l),
                    o)
                        for (u = h(b, g),
                        o(u, [], s, l),
                        c = u.length; c--; )
                            (d = u[c]) && (b[g[c]] = !(y[g[c]] = d));
                    if (i) {
                        if (r || e) {
                            if (r) {
                                for (u = [],
                                c = b.length; c--; )
                                    (d = b[c]) && u.push(y[c] = d);
                                r(null, b = [], u, l)
                            }
                            for (c = b.length; c--; )
                                (d = b[c]) && (u = r ? Q(i, d) : p[c]) > -1 && (i[u] = !(a[u] = d))
                        }
                    } else
                        b = h(b === a ? b.splice(m, b.length) : b),
                        r ? r(null, a, b, l) : J.apply(a, b)
                })
            }
            function m(e) {
                for (var t, n, i, o = e.length, r = w.relative[e[0].type], a = r || w.relative[" "], s = r ? 1 : 0, l = d(function(e) {
                    return e === t
                }, a, !0), u = d(function(e) {
                    return Q(t, e) > -1
                }, a, !0), f = [function(e, n, i) {
                    var o = !r && (i || n !== E) || ((t = n).nodeType ? l(e, n, i) : u(e, n, i));
                    return t = null,
                    o
                }
                ]; s < o; s++)
                    if (n = w.relative[e[s].type])
                        f = [d(p(f), n)];
                    else {
                        if (n = w.filter[e[s].type].apply(null, e[s].matches),
                        n[F]) {
                            for (i = ++s; i < o && !w.relative[e[i].type]; i++)
                                ;
                            return g(s > 1 && p(f), s > 1 && c(e.slice(0, s - 1).concat({
                                value: " " === e[s - 2].type ? "*" : ""
                            })).replace(re, "$1"), n, s < i && m(e.slice(s, i)), i < o && m(e = e.slice(i)), i < o && c(e))
                        }
                        f.push(n)
                    }
                return p(f)
            }
            function v(e, n) {
                var o = n.length > 0
                  , r = e.length > 0
                  , a = function(i, a, s, l, u) {
                    var c, d, p, f = 0, g = "0", m = i && [], v = [], y = E, b = i || r && w.find.TAG("*", u), x = O += null == y ? 1 : Math.random() || .1, C = b.length;
                    for (u && (E = a === j || a || u); g !== C && null != (c = b[g]); g++) {
                        if (r && c) {
                            for (d = 0,
                            a || c.ownerDocument === j || (L(c),
                            s = !_); p = e[d++]; )
                                if (p(c, a || j, s)) {
                                    l.push(c);
                                    break
                                }
                            u && (O = x)
                        }
                        o && ((c = !p && c) && f--,
                        i && m.push(c))
                    }
                    if (f += g,
                    o && g !== f) {
                        for (d = 0; p = n[d++]; )
                            p(m, v, a, s);
                        if (i) {
                            if (f > 0)
                                for (; g--; )
                                    m[g] || v[g] || (v[g] = G.call(l));
                            v = h(v)
                        }
                        J.apply(l, v),
                        u && !i && v.length > 0 && f + n.length > 1 && t.uniqueSort(l)
                    }
                    return u && (O = x,
                    E = y),
                    m
                };
                return o ? i(a) : a
            }
            var y, b, w, x, C, T, k, S, E, N, D, L, j, A, _, q, I, H, M, F = "sizzle" + 1 * new Date, P = e.document, O = 0, R = 0, W = n(), B = n(), X = n(), $ = function(e, t) {
                return e === t && (D = !0),
                0
            }, z = 1 << 31, V = {}.hasOwnProperty, U = [], G = U.pop, Y = U.push, J = U.push, K = U.slice, Q = function(e, t) {
                for (var n = 0, i = e.length; n < i; n++)
                    if (e[n] === t)
                        return n;
                return -1
            }, Z = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped", ee = "[\\x20\\t\\r\\n\\f]", te = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+", ne = "\\[" + ee + "*(" + te + ")(?:" + ee + "*([*^$|!~]?=)" + ee + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + te + "))|)" + ee + "*\\]", ie = ":(" + te + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + ne + ")*)|.*)\\)|)", oe = new RegExp(ee + "+","g"), re = new RegExp("^" + ee + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ee + "+$","g"), ae = new RegExp("^" + ee + "*," + ee + "*"), se = new RegExp("^" + ee + "*([>+~]|" + ee + ")" + ee + "*"), le = new RegExp("=" + ee + "*([^\\]'\"]*?)" + ee + "*\\]","g"), ue = new RegExp(ie), ce = new RegExp("^" + te + "$"), de = {
                ID: new RegExp("^#(" + te + ")"),
                CLASS: new RegExp("^\\.(" + te + ")"),
                TAG: new RegExp("^(" + te + "|[*])"),
                ATTR: new RegExp("^" + ne),
                PSEUDO: new RegExp("^" + ie),
                CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ee + "*(even|odd|(([+-]|)(\\d*)n|)" + ee + "*(?:([+-]|)" + ee + "*(\\d+)|))" + ee + "*\\)|)","i"),
                bool: new RegExp("^(?:" + Z + ")$","i"),
                needsContext: new RegExp("^" + ee + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ee + "*((?:-\\d)?\\d*)" + ee + "*\\)|)(?=[^-]|$)","i")
            }, pe = /^(?:input|select|textarea|button)$/i, fe = /^h\d$/i, he = /^[^{]+\{\s*\[native \w/, ge = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, me = /[+~]/, ve = /'|\\/g, ye = new RegExp("\\\\([\\da-f]{1,6}" + ee + "?|(" + ee + ")|.)","ig"), be = function(e, t, n) {
                var i = "0x" + t - 65536;
                return i !== i || n ? t : i < 0 ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
            }, we = function() {
                L()
            };
            try {
                J.apply(U = K.call(P.childNodes), P.childNodes),
                U[P.childNodes.length].nodeType
            } catch (e) {
                J = {
                    apply: U.length ? function(e, t) {
                        Y.apply(e, K.call(t))
                    }
                    : function(e, t) {
                        for (var n = e.length, i = 0; e[n++] = t[i++]; )
                            ;
                        e.length = n - 1
                    }
                }
            }
            b = t.support = {},
            C = t.isXML = function(e) {
                var t = e && (e.ownerDocument || e).documentElement;
                return !!t && "HTML" !== t.nodeName
            }
            ,
            L = t.setDocument = function(e) {
                var t, n, i = e ? e.ownerDocument || e : P;
                return i !== j && 9 === i.nodeType && i.documentElement ? (j = i,
                A = j.documentElement,
                _ = !C(j),
                (n = j.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", we, !1) : n.attachEvent && n.attachEvent("onunload", we)),
                b.attributes = o(function(e) {
                    return e.className = "i",
                    !e.getAttribute("className")
                }),
                b.getElementsByTagName = o(function(e) {
                    return e.appendChild(j.createComment("")),
                    !e.getElementsByTagName("*").length
                }),
                b.getElementsByClassName = he.test(j.getElementsByClassName),
                b.getById = o(function(e) {
                    return A.appendChild(e).id = F,
                    !j.getElementsByName || !j.getElementsByName(F).length
                }),
                b.getById ? (w.find.ID = function(e, t) {
                    if (void 0 !== t.getElementById && _) {
                        var n = t.getElementById(e);
                        return n ? [n] : []
                    }
                }
                ,
                w.filter.ID = function(e) {
                    var t = e.replace(ye, be);
                    return function(e) {
                        return e.getAttribute("id") === t
                    }
                }
                ) : (delete w.find.ID,
                w.filter.ID = function(e) {
                    var t = e.replace(ye, be);
                    return function(e) {
                        var n = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                        return n && n.value === t
                    }
                }
                ),
                w.find.TAG = b.getElementsByTagName ? function(e, t) {
                    return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : b.qsa ? t.querySelectorAll(e) : void 0
                }
                : function(e, t) {
                    var n, i = [], o = 0, r = t.getElementsByTagName(e);
                    if ("*" === e) {
                        for (; n = r[o++]; )
                            1 === n.nodeType && i.push(n);
                        return i
                    }
                    return r
                }
                ,
                w.find.CLASS = b.getElementsByClassName && function(e, t) {
                    if (void 0 !== t.getElementsByClassName && _)
                        return t.getElementsByClassName(e)
                }
                ,
                I = [],
                q = [],
                (b.qsa = he.test(j.querySelectorAll)) && (o(function(e) {
                    A.appendChild(e).innerHTML = "<a id='" + F + "'></a><select id='" + F + "-\r\\' msallowcapture=''><option selected=''></option></select>",
                    e.querySelectorAll("[msallowcapture^='']").length && q.push("[*^$]=" + ee + "*(?:''|\"\")"),
                    e.querySelectorAll("[selected]").length || q.push("\\[" + ee + "*(?:value|" + Z + ")"),
                    e.querySelectorAll("[id~=" + F + "-]").length || q.push("~="),
                    e.querySelectorAll(":checked").length || q.push(":checked"),
                    e.querySelectorAll("a#" + F + "+*").length || q.push(".#.+[+~]")
                }),
                o(function(e) {
                    var t = j.createElement("input");
                    t.setAttribute("type", "hidden"),
                    e.appendChild(t).setAttribute("name", "D"),
                    e.querySelectorAll("[name=d]").length && q.push("name" + ee + "*[*^$|!~]?="),
                    e.querySelectorAll(":enabled").length || q.push(":enabled", ":disabled"),
                    e.querySelectorAll("*,:x"),
                    q.push(",.*:")
                })),
                (b.matchesSelector = he.test(H = A.matches || A.webkitMatchesSelector || A.mozMatchesSelector || A.oMatchesSelector || A.msMatchesSelector)) && o(function(e) {
                    b.disconnectedMatch = H.call(e, "div"),
                    H.call(e, "[s!='']:x"),
                    I.push("!=", ie)
                }),
                q = q.length && new RegExp(q.join("|")),
                I = I.length && new RegExp(I.join("|")),
                t = he.test(A.compareDocumentPosition),
                M = t || he.test(A.contains) ? function(e, t) {
                    var n = 9 === e.nodeType ? e.documentElement : e
                      , i = t && t.parentNode;
                    return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
                }
                : function(e, t) {
                    if (t)
                        for (; t = t.parentNode; )
                            if (t === e)
                                return !0;
                    return !1
                }
                ,
                $ = t ? function(e, t) {
                    if (e === t)
                        return D = !0,
                        0;
                    var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                    return n || (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1,
                    1 & n || !b.sortDetached && t.compareDocumentPosition(e) === n ? e === j || e.ownerDocument === P && M(P, e) ? -1 : t === j || t.ownerDocument === P && M(P, t) ? 1 : N ? Q(N, e) - Q(N, t) : 0 : 4 & n ? -1 : 1)
                }
                : function(e, t) {
                    if (e === t)
                        return D = !0,
                        0;
                    var n, i = 0, o = e.parentNode, r = t.parentNode, s = [e], l = [t];
                    if (!o || !r)
                        return e === j ? -1 : t === j ? 1 : o ? -1 : r ? 1 : N ? Q(N, e) - Q(N, t) : 0;
                    if (o === r)
                        return a(e, t);
                    for (n = e; n = n.parentNode; )
                        s.unshift(n);
                    for (n = t; n = n.parentNode; )
                        l.unshift(n);
                    for (; s[i] === l[i]; )
                        i++;
                    return i ? a(s[i], l[i]) : s[i] === P ? -1 : l[i] === P ? 1 : 0
                }
                ,
                j) : j
            }
            ,
            t.matches = function(e, n) {
                return t(e, null, null, n)
            }
            ,
            t.matchesSelector = function(e, n) {
                if ((e.ownerDocument || e) !== j && L(e),
                n = n.replace(le, "='$1']"),
                b.matchesSelector && _ && !X[n + " "] && (!I || !I.test(n)) && (!q || !q.test(n)))
                    try {
                        var i = H.call(e, n);
                        if (i || b.disconnectedMatch || e.document && 11 !== e.document.nodeType)
                            return i
                    } catch (e) {}
                return t(n, j, null, [e]).length > 0
            }
            ,
            t.contains = function(e, t) {
                return (e.ownerDocument || e) !== j && L(e),
                M(e, t)
            }
            ,
            t.attr = function(e, t) {
                (e.ownerDocument || e) !== j && L(e);
                var n = w.attrHandle[t.toLowerCase()]
                  , i = n && V.call(w.attrHandle, t.toLowerCase()) ? n(e, t, !_) : void 0;
                return void 0 !== i ? i : b.attributes || !_ ? e.getAttribute(t) : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
            }
            ,
            t.error = function(e) {
                throw new Error("Syntax error, unrecognized expression: " + e)
            }
            ,
            t.uniqueSort = function(e) {
                var t, n = [], i = 0, o = 0;
                if (D = !b.detectDuplicates,
                N = !b.sortStable && e.slice(0),
                e.sort($),
                D) {
                    for (; t = e[o++]; )
                        t === e[o] && (i = n.push(o));
                    for (; i--; )
                        e.splice(n[i], 1)
                }
                return N = null,
                e
            }
            ,
            x = t.getText = function(e) {
                var t, n = "", i = 0, o = e.nodeType;
                if (o) {
                    if (1 === o || 9 === o || 11 === o) {
                        if ("string" == typeof e.textContent)
                            return e.textContent;
                        for (e = e.firstChild; e; e = e.nextSibling)
                            n += x(e)
                    } else if (3 === o || 4 === o)
                        return e.nodeValue
                } else
                    for (; t = e[i++]; )
                        n += x(t);
                return n
            }
            ,
            w = t.selectors = {
                cacheLength: 50,
                createPseudo: i,
                match: de,
                attrHandle: {},
                find: {},
                relative: {
                    ">": {
                        dir: "parentNode",
                        first: !0
                    },
                    " ": {
                        dir: "parentNode"
                    },
                    "+": {
                        dir: "previousSibling",
                        first: !0
                    },
                    "~": {
                        dir: "previousSibling"
                    }
                },
                preFilter: {
                    ATTR: function(e) {
                        return e[1] = e[1].replace(ye, be),
                        e[3] = (e[3] || e[4] || e[5] || "").replace(ye, be),
                        "~=" === e[2] && (e[3] = " " + e[3] + " "),
                        e.slice(0, 4)
                    },
                    CHILD: function(e) {
                        return e[1] = e[1].toLowerCase(),
                        "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]),
                        e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])),
                        e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t.error(e[0]),
                        e
                    },
                    PSEUDO: function(e) {
                        var t, n = !e[6] && e[2];
                        return de.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && ue.test(n) && (t = T(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t),
                        e[2] = n.slice(0, t)),
                        e.slice(0, 3))
                    }
                },
                filter: {
                    TAG: function(e) {
                        var t = e.replace(ye, be).toLowerCase();
                        return "*" === e ? function() {
                            return !0
                        }
                        : function(e) {
                            return e.nodeName && e.nodeName.toLowerCase() === t
                        }
                    },
                    CLASS: function(e) {
                        var t = W[e + " "];
                        return t || (t = new RegExp("(^|" + ee + ")" + e + "(" + ee + "|$)")) && W(e, function(e) {
                            return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                        })
                    },
                    ATTR: function(e, n, i) {
                        return function(o) {
                            var r = t.attr(o, e);
                            return null == r ? "!=" === n : !n || (r += "",
                            "=" === n ? r === i : "!=" === n ? r !== i : "^=" === n ? i && 0 === r.indexOf(i) : "*=" === n ? i && r.indexOf(i) > -1 : "$=" === n ? i && r.slice(-i.length) === i : "~=" === n ? (" " + r.replace(oe, " ") + " ").indexOf(i) > -1 : "|=" === n && (r === i || r.slice(0, i.length + 1) === i + "-"))
                        }
                    },
                    CHILD: function(e, t, n, i, o) {
                        var r = "nth" !== e.slice(0, 3)
                          , a = "last" !== e.slice(-4)
                          , s = "of-type" === t;
                        return 1 === i && 0 === o ? function(e) {
                            return !!e.parentNode
                        }
                        : function(t, n, l) {
                            var u, c, d, p, f, h, g = r !== a ? "nextSibling" : "previousSibling", m = t.parentNode, v = s && t.nodeName.toLowerCase(), y = !l && !s, b = !1;
                            if (m) {
                                if (r) {
                                    for (; g; ) {
                                        for (p = t; p = p[g]; )
                                            if (s ? p.nodeName.toLowerCase() === v : 1 === p.nodeType)
                                                return !1;
                                        h = g = "only" === e && !h && "nextSibling"
                                    }
                                    return !0
                                }
                                if (h = [a ? m.firstChild : m.lastChild],
                                a && y) {
                                    for (p = m,
                                    d = p[F] || (p[F] = {}),
                                    c = d[p.uniqueID] || (d[p.uniqueID] = {}),
                                    u = c[e] || [],
                                    f = u[0] === O && u[1],
                                    b = f && u[2],
                                    p = f && m.childNodes[f]; p = ++f && p && p[g] || (b = f = 0) || h.pop(); )
                                        if (1 === p.nodeType && ++b && p === t) {
                                            c[e] = [O, f, b];
                                            break
                                        }
                                } else if (y && (p = t,
                                d = p[F] || (p[F] = {}),
                                c = d[p.uniqueID] || (d[p.uniqueID] = {}),
                                u = c[e] || [],
                                f = u[0] === O && u[1],
                                b = f),
                                !1 === b)
                                    for (; (p = ++f && p && p[g] || (b = f = 0) || h.pop()) && ((s ? p.nodeName.toLowerCase() !== v : 1 !== p.nodeType) || !++b || (y && (d = p[F] || (p[F] = {}),
                                    c = d[p.uniqueID] || (d[p.uniqueID] = {}),
                                    c[e] = [O, b]),
                                    p !== t)); )
                                        ;
                                return (b -= o) === i || b % i == 0 && b / i >= 0
                            }
                        }
                    },
                    PSEUDO: function(e, n) {
                        var o, r = w.pseudos[e] || w.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
                        return r[F] ? r(n) : r.length > 1 ? (o = [e, e, "", n],
                        w.setFilters.hasOwnProperty(e.toLowerCase()) ? i(function(e, t) {
                            for (var i, o = r(e, n), a = o.length; a--; )
                                i = Q(e, o[a]),
                                e[i] = !(t[i] = o[a])
                        }) : function(e) {
                            return r(e, 0, o)
                        }
                        ) : r
                    }
                },
                pseudos: {
                    not: i(function(e) {
                        var t = []
                          , n = []
                          , o = k(e.replace(re, "$1"));
                        return o[F] ? i(function(e, t, n, i) {
                            for (var r, a = o(e, null, i, []), s = e.length; s--; )
                                (r = a[s]) && (e[s] = !(t[s] = r))
                        }) : function(e, i, r) {
                            return t[0] = e,
                            o(t, null, r, n),
                            t[0] = null,
                            !n.pop()
                        }
                    }),
                    has: i(function(e) {
                        return function(n) {
                            return t(e, n).length > 0
                        }
                    }),
                    contains: i(function(e) {
                        return e = e.replace(ye, be),
                        function(t) {
                            return (t.textContent || t.innerText || x(t)).indexOf(e) > -1
                        }
                    }),
                    lang: i(function(e) {
                        return ce.test(e || "") || t.error("unsupported lang: " + e),
                        e = e.replace(ye, be).toLowerCase(),
                        function(t) {
                            var n;
                            do {
                                if (n = _ ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang"))
                                    return (n = n.toLowerCase()) === e || 0 === n.indexOf(e + "-")
                            } while ((t = t.parentNode) && 1 === t.nodeType);return !1
                        }
                    }),
                    target: function(t) {
                        var n = e.location && e.location.hash;
                        return n && n.slice(1) === t.id
                    },
                    root: function(e) {
                        return e === A
                    },
                    focus: function(e) {
                        return e === j.activeElement && (!j.hasFocus || j.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                    },
                    enabled: function(e) {
                        return !1 === e.disabled
                    },
                    disabled: function(e) {
                        return !0 === e.disabled
                    },
                    checked: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && !!e.checked || "option" === t && !!e.selected
                    },
                    selected: function(e) {
                        return e.parentNode && e.parentNode.selectedIndex,
                        !0 === e.selected
                    },
                    empty: function(e) {
                        for (e = e.firstChild; e; e = e.nextSibling)
                            if (e.nodeType < 6)
                                return !1;
                        return !0
                    },
                    parent: function(e) {
                        return !w.pseudos.empty(e)
                    },
                    header: function(e) {
                        return fe.test(e.nodeName)
                    },
                    input: function(e) {
                        return pe.test(e.nodeName)
                    },
                    button: function(e) {
                        var t = e.nodeName.toLowerCase();
                        return "input" === t && "button" === e.type || "button" === t
                    },
                    text: function(e) {
                        var t;
                        return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                    },
                    first: s(function() {
                        return [0]
                    }),
                    last: s(function(e, t) {
                        return [t - 1]
                    }),
                    eq: s(function(e, t, n) {
                        return [n < 0 ? n + t : n]
                    }),
                    even: s(function(e, t) {
                        for (var n = 0; n < t; n += 2)
                            e.push(n);
                        return e
                    }),
                    odd: s(function(e, t) {
                        for (var n = 1; n < t; n += 2)
                            e.push(n);
                        return e
                    }),
                    lt: s(function(e, t, n) {
                        for (var i = n < 0 ? n + t : n; --i >= 0; )
                            e.push(i);
                        return e
                    }),
                    gt: s(function(e, t, n) {
                        for (var i = n < 0 ? n + t : n; ++i < t; )
                            e.push(i);
                        return e
                    })
                }
            },
            w.pseudos.nth = w.pseudos.eq;
            for (y in {
                radio: !0,
                checkbox: !0,
                file: !0,
                password: !0,
                image: !0
            })
                w.pseudos[y] = function(e) {
                    return function(t) {
                        return "input" === t.nodeName.toLowerCase() && t.type === e
                    }
                }(y);
            for (y in {
                submit: !0,
                reset: !0
            })
                w.pseudos[y] = function(e) {
                    return function(t) {
                        var n = t.nodeName.toLowerCase();
                        return ("input" === n || "button" === n) && t.type === e
                    }
                }(y);
            return u.prototype = w.filters = w.pseudos,
            w.setFilters = new u,
            T = t.tokenize = function(e, n) {
                var i, o, r, a, s, l, u, c = B[e + " "];
                if (c)
                    return n ? 0 : c.slice(0);
                for (s = e,
                l = [],
                u = w.preFilter; s; ) {
                    i && !(o = ae.exec(s)) || (o && (s = s.slice(o[0].length) || s),
                    l.push(r = [])),
                    i = !1,
                    (o = se.exec(s)) && (i = o.shift(),
                    r.push({
                        value: i,
                        type: o[0].replace(re, " ")
                    }),
                    s = s.slice(i.length));
                    for (a in w.filter)
                        !(o = de[a].exec(s)) || u[a] && !(o = u[a](o)) || (i = o.shift(),
                        r.push({
                            value: i,
                            type: a,
                            matches: o
                        }),
                        s = s.slice(i.length));
                    if (!i)
                        break
                }
                return n ? s.length : s ? t.error(e) : B(e, l).slice(0)
            }
            ,
            k = t.compile = function(e, t) {
                var n, i = [], o = [], r = X[e + " "];
                if (!r) {
                    for (t || (t = T(e)),
                    n = t.length; n--; )
                        r = m(t[n]),
                        r[F] ? i.push(r) : o.push(r);
                    r = X(e, v(o, i)),
                    r.selector = e
                }
                return r
            }
            ,
            S = t.select = function(e, t, n, i) {
                var o, r, a, s, u, d = "function" == typeof e && e, p = !i && T(e = d.selector || e);
                if (n = n || [],
                1 === p.length) {
                    if (r = p[0] = p[0].slice(0),
                    r.length > 2 && "ID" === (a = r[0]).type && b.getById && 9 === t.nodeType && _ && w.relative[r[1].type]) {
                        if (!(t = (w.find.ID(a.matches[0].replace(ye, be), t) || [])[0]))
                            return n;
                        d && (t = t.parentNode),
                        e = e.slice(r.shift().value.length)
                    }
                    for (o = de.needsContext.test(e) ? 0 : r.length; o-- && (a = r[o],
                    !w.relative[s = a.type]); )
                        if ((u = w.find[s]) && (i = u(a.matches[0].replace(ye, be), me.test(r[0].type) && l(t.parentNode) || t))) {
                            if (r.splice(o, 1),
                            !(e = i.length && c(r)))
                                return J.apply(n, i),
                                n;
                            break
                        }
                }
                return (d || k(e, p))(i, t, !_, n, !t || me.test(e) && l(t.parentNode) || t),
                n
            }
            ,
            b.sortStable = F.split("").sort($).join("") === F,
            b.detectDuplicates = !!D,
            L(),
            b.sortDetached = o(function(e) {
                return 1 & e.compareDocumentPosition(j.createElement("div"))
            }),
            o(function(e) {
                return e.innerHTML = "<a href='#'></a>",
                "#" === e.firstChild.getAttribute("href")
            }) || r("type|href|height|width", function(e, t, n) {
                if (!n)
                    return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
            }),
            b.attributes && o(function(e) {
                return e.innerHTML = "<input/>",
                e.firstChild.setAttribute("value", ""),
                "" === e.firstChild.getAttribute("value")
            }) || r("value", function(e, t, n) {
                if (!n && "input" === e.nodeName.toLowerCase())
                    return e.defaultValue
            }),
            o(function(e) {
                return null == e.getAttribute("disabled")
            }) || r(Z, function(e, t, n) {
                var i;
                if (!n)
                    return !0 === e[t] ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
            }),
            t
        }(e);
        pe.find = ve,
        pe.expr = ve.selectors,
        pe.expr[":"] = pe.expr.pseudos,
        pe.uniqueSort = pe.unique = ve.uniqueSort,
        pe.text = ve.getText,
        pe.isXMLDoc = ve.isXML,
        pe.contains = ve.contains;
        var ye = function(e, t, n) {
            for (var i = [], o = void 0 !== n; (e = e[t]) && 9 !== e.nodeType; )
                if (1 === e.nodeType) {
                    if (o && pe(e).is(n))
                        break;
                    i.push(e)
                }
            return i
        }
          , be = function(e, t) {
            for (var n = []; e; e = e.nextSibling)
                1 === e.nodeType && e !== t && n.push(e);
            return n
        }
          , we = pe.expr.match.needsContext
          , xe = /^<([\w-]+)\s*\/?>(?:<\/\1>|)$/
          , Ce = /^.[^:#\[\.,]*$/;
        pe.filter = function(e, t, n) {
            var i = t[0];
            return n && (e = ":not(" + e + ")"),
            1 === t.length && 1 === i.nodeType ? pe.find.matchesSelector(i, e) ? [i] : [] : pe.find.matches(e, pe.grep(t, function(e) {
                return 1 === e.nodeType
            }))
        }
        ,
        pe.fn.extend({
            find: function(e) {
                var t, n = [], i = this, o = i.length;
                if ("string" != typeof e)
                    return this.pushStack(pe(e).filter(function() {
                        for (t = 0; t < o; t++)
                            if (pe.contains(i[t], this))
                                return !0
                    }));
                for (t = 0; t < o; t++)
                    pe.find(e, i[t], n);
                return n = this.pushStack(o > 1 ? pe.unique(n) : n),
                n.selector = this.selector ? this.selector + " " + e : e,
                n
            },
            filter: function(e) {
                return this.pushStack(i(this, e || [], !1))
            },
            not: function(e) {
                return this.pushStack(i(this, e || [], !0))
            },
            is: function(e) {
                return !!i(this, "string" == typeof e && we.test(e) ? pe(e) : e || [], !1).length
            }
        });
        var Te, ke = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/;
        (pe.fn.init = function(e, t, n) {
            var i, o;
            if (!e)
                return this;
            if (n = n || Te,
            "string" == typeof e) {
                if (!(i = "<" === e.charAt(0) && ">" === e.charAt(e.length - 1) && e.length >= 3 ? [null, e, null] : ke.exec(e)) || !i[1] && t)
                    return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
                if (i[1]) {
                    if (t = t instanceof pe ? t[0] : t,
                    pe.merge(this, pe.parseHTML(i[1], t && t.nodeType ? t.ownerDocument || t : ie, !0)),
                    xe.test(i[1]) && pe.isPlainObject(t))
                        for (i in t)
                            pe.isFunction(this[i]) ? this[i](t[i]) : this.attr(i, t[i]);
                    return this
                }
                if ((o = ie.getElementById(i[2])) && o.parentNode) {
                    if (o.id !== i[2])
                        return Te.find(e);
                    this.length = 1,
                    this[0] = o
                }
                return this.context = ie,
                this.selector = e,
                this
            }
            return e.nodeType ? (this.context = this[0] = e,
            this.length = 1,
            this) : pe.isFunction(e) ? void 0 !== n.ready ? n.ready(e) : e(pe) : (void 0 !== e.selector && (this.selector = e.selector,
            this.context = e.context),
            pe.makeArray(e, this))
        }
        ).prototype = pe.fn,
        Te = pe(ie);
        var Se = /^(?:parents|prev(?:Until|All))/
          , Ee = {
            children: !0,
            contents: !0,
            next: !0,
            prev: !0
        };
        pe.fn.extend({
            has: function(e) {
                var t, n = pe(e, this), i = n.length;
                return this.filter(function() {
                    for (t = 0; t < i; t++)
                        if (pe.contains(this, n[t]))
                            return !0
                })
            },
            closest: function(e, t) {
                for (var n, i = 0, o = this.length, r = [], a = we.test(e) || "string" != typeof e ? pe(e, t || this.context) : 0; i < o; i++)
                    for (n = this[i]; n && n !== t; n = n.parentNode)
                        if (n.nodeType < 11 && (a ? a.index(n) > -1 : 1 === n.nodeType && pe.find.matchesSelector(n, e))) {
                            r.push(n);
                            break
                        }
                return this.pushStack(r.length > 1 ? pe.uniqueSort(r) : r)
            },
            index: function(e) {
                return e ? "string" == typeof e ? pe.inArray(this[0], pe(e)) : pe.inArray(e.jquery ? e[0] : e, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
            },
            add: function(e, t) {
                return this.pushStack(pe.uniqueSort(pe.merge(this.get(), pe(e, t))))
            },
            addBack: function(e) {
                return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
            }
        }),
        pe.each({
            parent: function(e) {
                var t = e.parentNode;
                return t && 11 !== t.nodeType ? t : null
            },
            parents: function(e) {
                return ye(e, "parentNode")
            },
            parentsUntil: function(e, t, n) {
                return ye(e, "parentNode", n)
            },
            next: function(e) {
                return o(e, "nextSibling")
            },
            prev: function(e) {
                return o(e, "previousSibling")
            },
            nextAll: function(e) {
                return ye(e, "nextSibling")
            },
            prevAll: function(e) {
                return ye(e, "previousSibling")
            },
            nextUntil: function(e, t, n) {
                return ye(e, "nextSibling", n)
            },
            prevUntil: function(e, t, n) {
                return ye(e, "previousSibling", n)
            },
            siblings: function(e) {
                return be((e.parentNode || {}).firstChild, e)
            },
            children: function(e) {
                return be(e.firstChild)
            },
            contents: function(e) {
                return pe.nodeName(e, "iframe") ? e.contentDocument || e.contentWindow.document : pe.merge([], e.childNodes)
            }
        }, function(e, t) {
            pe.fn[e] = function(n, i) {
                var o = pe.map(this, t, n);
                return "Until" !== e.slice(-5) && (i = n),
                i && "string" == typeof i && (o = pe.filter(i, o)),
                this.length > 1 && (Ee[e] || (o = pe.uniqueSort(o)),
                Se.test(e) && (o = o.reverse())),
                this.pushStack(o)
            }
        });
        var Ne = /\S+/g;
        pe.Callbacks = function(e) {
            e = "string" == typeof e ? r(e) : pe.extend({}, e);
            var t, n, i, o, a = [], s = [], l = -1, u = function() {
                for (o = e.once,
                i = t = !0; s.length; l = -1)
                    for (n = s.shift(); ++l < a.length; )
                        !1 === a[l].apply(n[0], n[1]) && e.stopOnFalse && (l = a.length,
                        n = !1);
                e.memory || (n = !1),
                t = !1,
                o && (a = n ? [] : "")
            }, c = {
                add: function() {
                    return a && (n && !t && (l = a.length - 1,
                    s.push(n)),
                    function t(n) {
                        pe.each(n, function(n, i) {
                            pe.isFunction(i) ? e.unique && c.has(i) || a.push(i) : i && i.length && "string" !== pe.type(i) && t(i)
                        })
                    }(arguments),
                    n && !t && u()),
                    this
                },
                remove: function() {
                    return pe.each(arguments, function(e, t) {
                        for (var n; (n = pe.inArray(t, a, n)) > -1; )
                            a.splice(n, 1),
                            n <= l && l--
                    }),
                    this
                },
                has: function(e) {
                    return e ? pe.inArray(e, a) > -1 : a.length > 0
                },
                empty: function() {
                    return a && (a = []),
                    this
                },
                disable: function() {
                    return o = s = [],
                    a = n = "",
                    this
                },
                disabled: function() {
                    return !a
                },
                lock: function() {
                    return o = !0,
                    n || c.disable(),
                    this
                },
                locked: function() {
                    return !!o
                },
                fireWith: function(e, n) {
                    return o || (n = n || [],
                    n = [e, n.slice ? n.slice() : n],
                    s.push(n),
                    t || u()),
                    this
                },
                fire: function() {
                    return c.fireWith(this, arguments),
                    this
                },
                fired: function() {
                    return !!i
                }
            };
            return c
        }
        ,
        pe.extend({
            Deferred: function(e) {
                var t = [["resolve", "done", pe.Callbacks("once memory"), "resolved"], ["reject", "fail", pe.Callbacks("once memory"), "rejected"], ["notify", "progress", pe.Callbacks("memory")]]
                  , n = "pending"
                  , i = {
                    state: function() {
                        return n
                    },
                    always: function() {
                        return o.done(arguments).fail(arguments),
                        this
                    },
                    then: function() {
                        var e = arguments;
                        return pe.Deferred(function(n) {
                            pe.each(t, function(t, r) {
                                var a = pe.isFunction(e[t]) && e[t];
                                o[r[1]](function() {
                                    var e = a && a.apply(this, arguments);
                                    e && pe.isFunction(e.promise) ? e.promise().progress(n.notify).done(n.resolve).fail(n.reject) : n[r[0] + "With"](this === i ? n.promise() : this, a ? [e] : arguments)
                                })
                            }),
                            e = null
                        }).promise()
                    },
                    promise: function(e) {
                        return null != e ? pe.extend(e, i) : i
                    }
                }
                  , o = {};
                return i.pipe = i.then,
                pe.each(t, function(e, r) {
                    var a = r[2]
                      , s = r[3];
                    i[r[1]] = a.add,
                    s && a.add(function() {
                        n = s
                    }, t[1 ^ e][2].disable, t[2][2].lock),
                    o[r[0]] = function() {
                        return o[r[0] + "With"](this === o ? i : this, arguments),
                        this
                    }
                    ,
                    o[r[0] + "With"] = a.fireWith
                }),
                i.promise(o),
                e && e.call(o, o),
                o
            },
            when: function(e) {
                var t, n, i, o = 0, r = oe.call(arguments), a = r.length, s = 1 !== a || e && pe.isFunction(e.promise) ? a : 0, l = 1 === s ? e : pe.Deferred(), u = function(e, n, i) {
                    return function(o) {
                        n[e] = this,
                        i[e] = arguments.length > 1 ? oe.call(arguments) : o,
                        i === t ? l.notifyWith(n, i) : --s || l.resolveWith(n, i)
                    }
                };
                if (a > 1)
                    for (t = new Array(a),
                    n = new Array(a),
                    i = new Array(a); o < a; o++)
                        r[o] && pe.isFunction(r[o].promise) ? r[o].promise().progress(u(o, n, t)).done(u(o, i, r)).fail(l.reject) : --s;
                return s || l.resolveWith(i, r),
                l.promise()
            }
        });
        var De;
        pe.fn.ready = function(e) {
            return pe.ready.promise().done(e),
            this
        }
        ,
        pe.extend({
            isReady: !1,
            readyWait: 1,
            holdReady: function(e) {
                e ? pe.readyWait++ : pe.ready(!0)
            },
            ready: function(e) {
                (!0 === e ? --pe.readyWait : pe.isReady) || (pe.isReady = !0,
                !0 !== e && --pe.readyWait > 0 || (De.resolveWith(ie, [pe]),
                pe.fn.triggerHandler && (pe(ie).triggerHandler("ready"),
                pe(ie).off("ready"))))
            }
        }),
        pe.ready.promise = function(t) {
            if (!De)
                if (De = pe.Deferred(),
                "complete" === ie.readyState || "loading" !== ie.readyState && !ie.documentElement.doScroll)
                    e.setTimeout(pe.ready);
                else if (ie.addEventListener)
                    ie.addEventListener("DOMContentLoaded", s),
                    e.addEventListener("load", s);
                else {
                    ie.attachEvent("onreadystatechange", s),
                    e.attachEvent("onload", s);
                    var n = !1;
                    try {
                        n = null == e.frameElement && ie.documentElement
                    } catch (e) {}
                    n && n.doScroll && function t() {
                        if (!pe.isReady) {
                            try {
                                n.doScroll("left")
                            } catch (n) {
                                return e.setTimeout(t, 50)
                            }
                            a(),
                            pe.ready()
                        }
                    }()
                }
            return De.promise(t)
        }
        ,
        pe.ready.promise();
        var Le;
        for (Le in pe(de))
            break;
        de.ownFirst = "0" === Le,
        de.inlineBlockNeedsLayout = !1,
        pe(function() {
            var e, t, n, i;
            (n = ie.getElementsByTagName("body")[0]) && n.style && (t = ie.createElement("div"),
            i = ie.createElement("div"),
            i.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px",
            n.appendChild(i).appendChild(t),
            void 0 !== t.style.zoom && (t.style.cssText = "display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1",
            de.inlineBlockNeedsLayout = e = 3 === t.offsetWidth,
            e && (n.style.zoom = 1)),
            n.removeChild(i))
        }),
        function() {
            var e = ie.createElement("div");
            de.deleteExpando = !0;
            try {
                delete e.test
            } catch (e) {
                de.deleteExpando = !1
            }
            e = null
        }();
        var je = function(e) {
            var t = pe.noData[(e.nodeName + " ").toLowerCase()]
              , n = +e.nodeType || 1;
            return (1 === n || 9 === n) && (!t || !0 !== t && e.getAttribute("classid") === t)
        }
          , Ae = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/
          , _e = /([A-Z])/g;
        pe.extend({
            cache: {},
            noData: {
                "applet ": !0,
                "embed ": !0,
                "object ": "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
            },
            hasData: function(e) {
                return !!(e = e.nodeType ? pe.cache[e[pe.expando]] : e[pe.expando]) && !u(e)
            },
            data: function(e, t, n) {
                return c(e, t, n)
            },
            removeData: function(e, t) {
                return d(e, t)
            },
            _data: function(e, t, n) {
                return c(e, t, n, !0)
            },
            _removeData: function(e, t) {
                return d(e, t, !0)
            }
        }),
        pe.fn.extend({
            data: function(e, t) {
                var n, i, o, r = this[0], a = r && r.attributes;
                if (void 0 === e) {
                    if (this.length && (o = pe.data(r),
                    1 === r.nodeType && !pe._data(r, "parsedAttrs"))) {
                        for (n = a.length; n--; )
                            a[n] && (i = a[n].name,
                            0 === i.indexOf("data-") && (i = pe.camelCase(i.slice(5)),
                            l(r, i, o[i])));
                        pe._data(r, "parsedAttrs", !0)
                    }
                    return o
                }
                return "object" == typeof e ? this.each(function() {
                    pe.data(this, e)
                }) : arguments.length > 1 ? this.each(function() {
                    pe.data(this, e, t)
                }) : r ? l(r, e, pe.data(r, e)) : void 0
            },
            removeData: function(e) {
                return this.each(function() {
                    pe.removeData(this, e)
                })
            }
        }),
        pe.extend({
            queue: function(e, t, n) {
                var i;
                if (e)
                    return t = (t || "fx") + "queue",
                    i = pe._data(e, t),
                    n && (!i || pe.isArray(n) ? i = pe._data(e, t, pe.makeArray(n)) : i.push(n)),
                    i || []
            },
            dequeue: function(e, t) {
                t = t || "fx";
                var n = pe.queue(e, t)
                  , i = n.length
                  , o = n.shift()
                  , r = pe._queueHooks(e, t)
                  , a = function() {
                    pe.dequeue(e, t)
                };
                "inprogress" === o && (o = n.shift(),
                i--),
                o && ("fx" === t && n.unshift("inprogress"),
                delete r.stop,
                o.call(e, a, r)),
                !i && r && r.empty.fire()
            },
            _queueHooks: function(e, t) {
                var n = t + "queueHooks";
                return pe._data(e, n) || pe._data(e, n, {
                    empty: pe.Callbacks("once memory").add(function() {
                        pe._removeData(e, t + "queue"),
                        pe._removeData(e, n)
                    })
                })
            }
        }),
        pe.fn.extend({
            queue: function(e, t) {
                var n = 2;
                return "string" != typeof e && (t = e,
                e = "fx",
                n--),
                arguments.length < n ? pe.queue(this[0], e) : void 0 === t ? this : this.each(function() {
                    var n = pe.queue(this, e, t);
                    pe._queueHooks(this, e),
                    "fx" === e && "inprogress" !== n[0] && pe.dequeue(this, e)
                })
            },
            dequeue: function(e) {
                return this.each(function() {
                    pe.dequeue(this, e)
                })
            },
            clearQueue: function(e) {
                return this.queue(e || "fx", [])
            },
            promise: function(e, t) {
                var n, i = 1, o = pe.Deferred(), r = this, a = this.length, s = function() {
                    --i || o.resolveWith(r, [r])
                };
                for ("string" != typeof e && (t = e,
                e = void 0),
                e = e || "fx"; a--; )
                    (n = pe._data(r[a], e + "queueHooks")) && n.empty && (i++,
                    n.empty.add(s));
                return s(),
                o.promise(t)
            }
        }),
        function() {
            var e;
            de.shrinkWrapBlocks = function() {
                if (null != e)
                    return e;
                e = !1;
                var t, n, i;
                return (n = ie.getElementsByTagName("body")[0]) && n.style ? (t = ie.createElement("div"),
                i = ie.createElement("div"),
                i.style.cssText = "position:absolute;border:0;width:0;height:0;top:0;left:-9999px",
                n.appendChild(i).appendChild(t),
                void 0 !== t.style.zoom && (t.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1",
                t.appendChild(ie.createElement("div")).style.width = "5px",
                e = 3 !== t.offsetWidth),
                n.removeChild(i),
                e) : void 0
            }
        }();
        var qe = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source
          , Ie = new RegExp("^(?:([+-])=|)(" + qe + ")([a-z%]*)$","i")
          , He = ["Top", "Right", "Bottom", "Left"]
          , Me = function(e, t) {
            return e = t || e,
            "none" === pe.css(e, "display") || !pe.contains(e.ownerDocument, e)
        }
          , Fe = function(e, t, n, i, o, r, a) {
            var s = 0
              , l = e.length
              , u = null == n;
            if ("object" === pe.type(n)) {
                o = !0;
                for (s in n)
                    Fe(e, t, s, n[s], !0, r, a)
            } else if (void 0 !== i && (o = !0,
            pe.isFunction(i) || (a = !0),
            u && (a ? (t.call(e, i),
            t = null) : (u = t,
            t = function(e, t, n) {
                return u.call(pe(e), n)
            }
            )),
            t))
                for (; s < l; s++)
                    t(e[s], n, a ? i : i.call(e[s], s, t(e[s], n)));
            return o ? e : u ? t.call(e) : l ? t(e[0], n) : r
        }
          , Pe = /^(?:checkbox|radio)$/i
          , Oe = /<([\w:-]+)/
          , Re = /^$|\/(?:java|ecma)script/i
          , We = /^\s+/
          , Be = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|dialog|figcaption|figure|footer|header|hgroup|main|mark|meter|nav|output|picture|progress|section|summary|template|time|video";
        !function() {
            var e = ie.createElement("div")
              , t = ie.createDocumentFragment()
              , n = ie.createElement("input");
            e.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",
            de.leadingWhitespace = 3 === e.firstChild.nodeType,
            de.tbody = !e.getElementsByTagName("tbody").length,
            de.htmlSerialize = !!e.getElementsByTagName("link").length,
            de.html5Clone = "<:nav></:nav>" !== ie.createElement("nav").cloneNode(!0).outerHTML,
            n.type = "checkbox",
            n.checked = !0,
            t.appendChild(n),
            de.appendChecked = n.checked,
            e.innerHTML = "<textarea>x</textarea>",
            de.noCloneChecked = !!e.cloneNode(!0).lastChild.defaultValue,
            t.appendChild(e),
            n = ie.createElement("input"),
            n.setAttribute("type", "radio"),
            n.setAttribute("checked", "checked"),
            n.setAttribute("name", "t"),
            e.appendChild(n),
            de.checkClone = e.cloneNode(!0).cloneNode(!0).lastChild.checked,
            de.noCloneEvent = !!e.addEventListener,
            e[pe.expando] = 1,
            de.attributes = !e.getAttribute(pe.expando)
        }();
        var Xe = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            area: [1, "<map>", "</map>"],
            param: [1, "<object>", "</object>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            _default: de.htmlSerialize ? [0, "", ""] : [1, "X<div>", "</div>"]
        };
        Xe.optgroup = Xe.option,
        Xe.tbody = Xe.tfoot = Xe.colgroup = Xe.caption = Xe.thead,
        Xe.th = Xe.td;
        var $e = /<|&#?\w+;/
          , ze = /<tbody/i;
        !function() {
            var t, n, i = ie.createElement("div");
            for (t in {
                submit: !0,
                change: !0,
                focusin: !0
            })
                n = "on" + t,
                (de[t] = n in e) || (i.setAttribute(n, "t"),
                de[t] = !1 === i.attributes[n].expando);
            i = null
        }();
        var Ve = /^(?:input|select|textarea)$/i
          , Ue = /^key/
          , Ge = /^(?:mouse|pointer|contextmenu|drag|drop)|click/
          , Ye = /^(?:focusinfocus|focusoutblur)$/
          , Je = /^([^.]*)(?:\.(.+)|)/;
        pe.event = {
            global: {},
            add: function(e, t, n, i, o) {
                var r, a, s, l, u, c, d, p, f, h, g, m = pe._data(e);
                if (m) {
                    for (n.handler && (l = n,
                    n = l.handler,
                    o = l.selector),
                    n.guid || (n.guid = pe.guid++),
                    (a = m.events) || (a = m.events = {}),
                    (c = m.handle) || (c = m.handle = function(e) {
                        return void 0 === pe || e && pe.event.triggered === e.type ? void 0 : pe.event.dispatch.apply(c.elem, arguments)
                    }
                    ,
                    c.elem = e),
                    t = (t || "").match(Ne) || [""],
                    s = t.length; s--; )
                        r = Je.exec(t[s]) || [],
                        f = g = r[1],
                        h = (r[2] || "").split(".").sort(),
                        f && (u = pe.event.special[f] || {},
                        f = (o ? u.delegateType : u.bindType) || f,
                        u = pe.event.special[f] || {},
                        d = pe.extend({
                            type: f,
                            origType: g,
                            data: i,
                            handler: n,
                            guid: n.guid,
                            selector: o,
                            needsContext: o && pe.expr.match.needsContext.test(o),
                            namespace: h.join(".")
                        }, l),
                        (p = a[f]) || (p = a[f] = [],
                        p.delegateCount = 0,
                        u.setup && !1 !== u.setup.call(e, i, h, c) || (e.addEventListener ? e.addEventListener(f, c, !1) : e.attachEvent && e.attachEvent("on" + f, c))),
                        u.add && (u.add.call(e, d),
                        d.handler.guid || (d.handler.guid = n.guid)),
                        o ? p.splice(p.delegateCount++, 0, d) : p.push(d),
                        pe.event.global[f] = !0);
                    e = null
                }
            },
            remove: function(e, t, n, i, o) {
                var r, a, s, l, u, c, d, p, f, h, g, m = pe.hasData(e) && pe._data(e);
                if (m && (c = m.events)) {
                    for (t = (t || "").match(Ne) || [""],
                    u = t.length; u--; )
                        if (s = Je.exec(t[u]) || [],
                        f = g = s[1],
                        h = (s[2] || "").split(".").sort(),
                        f) {
                            for (d = pe.event.special[f] || {},
                            f = (i ? d.delegateType : d.bindType) || f,
                            p = c[f] || [],
                            s = s[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"),
                            l = r = p.length; r--; )
                                a = p[r],
                                !o && g !== a.origType || n && n.guid !== a.guid || s && !s.test(a.namespace) || i && i !== a.selector && ("**" !== i || !a.selector) || (p.splice(r, 1),
                                a.selector && p.delegateCount--,
                                d.remove && d.remove.call(e, a));
                            l && !p.length && (d.teardown && !1 !== d.teardown.call(e, h, m.handle) || pe.removeEvent(e, f, m.handle),
                            delete c[f])
                        } else
                            for (f in c)
                                pe.event.remove(e, f + t[u], n, i, !0);
                    pe.isEmptyObject(c) && (delete m.handle,
                    pe._removeData(e, "events"))
                }
            },
            trigger: function(t, n, i, o) {
                var r, a, s, l, u, c, d, p = [i || ie], f = ce.call(t, "type") ? t.type : t, h = ce.call(t, "namespace") ? t.namespace.split(".") : [];
                if (s = c = i = i || ie,
                3 !== i.nodeType && 8 !== i.nodeType && !Ye.test(f + pe.event.triggered) && (f.indexOf(".") > -1 && (h = f.split("."),
                f = h.shift(),
                h.sort()),
                a = f.indexOf(":") < 0 && "on" + f,
                t = t[pe.expando] ? t : new pe.Event(f,"object" == typeof t && t),
                t.isTrigger = o ? 2 : 3,
                t.namespace = h.join("."),
                t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null,
                t.result = void 0,
                t.target || (t.target = i),
                n = null == n ? [t] : pe.makeArray(n, [t]),
                u = pe.event.special[f] || {},
                o || !u.trigger || !1 !== u.trigger.apply(i, n))) {
                    if (!o && !u.noBubble && !pe.isWindow(i)) {
                        for (l = u.delegateType || f,
                        Ye.test(l + f) || (s = s.parentNode); s; s = s.parentNode)
                            p.push(s),
                            c = s;
                        c === (i.ownerDocument || ie) && p.push(c.defaultView || c.parentWindow || e)
                    }
                    for (d = 0; (s = p[d++]) && !t.isPropagationStopped(); )
                        t.type = d > 1 ? l : u.bindType || f,
                        r = (pe._data(s, "events") || {})[t.type] && pe._data(s, "handle"),
                        r && r.apply(s, n),
                        (r = a && s[a]) && r.apply && je(s) && (t.result = r.apply(s, n),
                        !1 === t.result && t.preventDefault());
                    if (t.type = f,
                    !o && !t.isDefaultPrevented() && (!u._default || !1 === u._default.apply(p.pop(), n)) && je(i) && a && i[f] && !pe.isWindow(i)) {
                        c = i[a],
                        c && (i[a] = null),
                        pe.event.triggered = f;
                        try {
                            i[f]()
                        } catch (e) {}
                        pe.event.triggered = void 0,
                        c && (i[a] = c)
                    }
                    return t.result
                }
            },
            dispatch: function(e) {
                e = pe.event.fix(e);
                var t, n, i, o, r, a = [], s = oe.call(arguments), l = (pe._data(this, "events") || {})[e.type] || [], u = pe.event.special[e.type] || {};
                if (s[0] = e,
                e.delegateTarget = this,
                !u.preDispatch || !1 !== u.preDispatch.call(this, e)) {
                    for (a = pe.event.handlers.call(this, e, l),
                    t = 0; (o = a[t++]) && !e.isPropagationStopped(); )
                        for (e.currentTarget = o.elem,
                        n = 0; (r = o.handlers[n++]) && !e.isImmediatePropagationStopped(); )
                            e.rnamespace && !e.rnamespace.test(r.namespace) || (e.handleObj = r,
                            e.data = r.data,
                            void 0 !== (i = ((pe.event.special[r.origType] || {}).handle || r.handler).apply(o.elem, s)) && !1 === (e.result = i) && (e.preventDefault(),
                            e.stopPropagation()));
                    return u.postDispatch && u.postDispatch.call(this, e),
                    e.result
                }
            },
            handlers: function(e, t) {
                var n, i, o, r, a = [], s = t.delegateCount, l = e.target;
                if (s && l.nodeType && ("click" !== e.type || isNaN(e.button) || e.button < 1))
                    for (; l != this; l = l.parentNode || this)
                        if (1 === l.nodeType && (!0 !== l.disabled || "click" !== e.type)) {
                            for (i = [],
                            n = 0; n < s; n++)
                                r = t[n],
                                o = r.selector + " ",
                                void 0 === i[o] && (i[o] = r.needsContext ? pe(o, this).index(l) > -1 : pe.find(o, this, null, [l]).length),
                                i[o] && i.push(r);
                            i.length && a.push({
                                elem: l,
                                handlers: i
                            })
                        }
                return s < t.length && a.push({
                    elem: this,
                    handlers: t.slice(s)
                }),
                a
            },
            fix: function(e) {
                if (e[pe.expando])
                    return e;
                var t, n, i, o = e.type, r = e, a = this.fixHooks[o];
                for (a || (this.fixHooks[o] = a = Ge.test(o) ? this.mouseHooks : Ue.test(o) ? this.keyHooks : {}),
                i = a.props ? this.props.concat(a.props) : this.props,
                e = new pe.Event(r),
                t = i.length; t--; )
                    n = i[t],
                    e[n] = r[n];
                return e.target || (e.target = r.srcElement || ie),
                3 === e.target.nodeType && (e.target = e.target.parentNode),
                e.metaKey = !!e.metaKey,
                a.filter ? a.filter(e, r) : e
            },
            props: "altKey bubbles cancelable ctrlKey currentTarget detail eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
            fixHooks: {},
            keyHooks: {
                props: "char charCode key keyCode".split(" "),
                filter: function(e, t) {
                    return null == e.which && (e.which = null != t.charCode ? t.charCode : t.keyCode),
                    e
                }
            },
            mouseHooks: {
                props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),
                filter: function(e, t) {
                    var n, i, o, r = t.button, a = t.fromElement;
                    return null == e.pageX && null != t.clientX && (i = e.target.ownerDocument || ie,
                    o = i.documentElement,
                    n = i.body,
                    e.pageX = t.clientX + (o && o.scrollLeft || n && n.scrollLeft || 0) - (o && o.clientLeft || n && n.clientLeft || 0),
                    e.pageY = t.clientY + (o && o.scrollTop || n && n.scrollTop || 0) - (o && o.clientTop || n && n.clientTop || 0)),
                    !e.relatedTarget && a && (e.relatedTarget = a === e.target ? t.toElement : a),
                    e.which || void 0 === r || (e.which = 1 & r ? 1 : 2 & r ? 3 : 4 & r ? 2 : 0),
                    e
                }
            },
            special: {
                load: {
                    noBubble: !0
                },
                focus: {
                    trigger: function() {
                        if (this !== w() && this.focus)
                            try {
                                return this.focus(),
                                !1
                            } catch (e) {}
                    },
                    delegateType: "focusin"
                },
                blur: {
                    trigger: function() {
                        if (this === w() && this.blur)
                            return this.blur(),
                            !1
                    },
                    delegateType: "focusout"
                },
                click: {
                    trigger: function() {
                        if (pe.nodeName(this, "input") && "checkbox" === this.type && this.click)
                            return this.click(),
                            !1
                    },
                    _default: function(e) {
                        return pe.nodeName(e.target, "a")
                    }
                },
                beforeunload: {
                    postDispatch: function(e) {
                        void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                    }
                }
            },
            simulate: function(e, t, n) {
                var i = pe.extend(new pe.Event, n, {
                    type: e,
                    isSimulated: !0
                });
                pe.event.trigger(i, null, t),
                i.isDefaultPrevented() && n.preventDefault()
            }
        },
        pe.removeEvent = ie.removeEventListener ? function(e, t, n) {
            e.removeEventListener && e.removeEventListener(t, n)
        }
        : function(e, t, n) {
            var i = "on" + t;
            e.detachEvent && (void 0 === e[i] && (e[i] = null),
            e.detachEvent(i, n))
        }
        ,
        pe.Event = function(e, t) {
            if (!(this instanceof pe.Event))
                return new pe.Event(e,t);
            e && e.type ? (this.originalEvent = e,
            this.type = e.type,
            this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? y : b) : this.type = e,
            t && pe.extend(this, t),
            this.timeStamp = e && e.timeStamp || pe.now(),
            this[pe.expando] = !0
        }
        ,
        pe.Event.prototype = {
            constructor: pe.Event,
            isDefaultPrevented: b,
            isPropagationStopped: b,
            isImmediatePropagationStopped: b,
            preventDefault: function() {
                var e = this.originalEvent;
                this.isDefaultPrevented = y,
                e && (e.preventDefault ? e.preventDefault() : e.returnValue = !1)
            },
            stopPropagation: function() {
                var e = this.originalEvent;
                this.isPropagationStopped = y,
                e && !this.isSimulated && (e.stopPropagation && e.stopPropagation(),
                e.cancelBubble = !0)
            },
            stopImmediatePropagation: function() {
                var e = this.originalEvent;
                this.isImmediatePropagationStopped = y,
                e && e.stopImmediatePropagation && e.stopImmediatePropagation(),
                this.stopPropagation()
            }
        },
        pe.each({
            mouseenter: "mouseover",
            mouseleave: "mouseout",
            pointerenter: "pointerover",
            pointerleave: "pointerout"
        }, function(e, t) {
            pe.event.special[e] = {
                delegateType: t,
                bindType: t,
                handle: function(e) {
                    var n, i = this, o = e.relatedTarget, r = e.handleObj;
                    return o && (o === i || pe.contains(i, o)) || (e.type = r.origType,
                    n = r.handler.apply(this, arguments),
                    e.type = t),
                    n
                }
            }
        }),
        de.submit || (pe.event.special.submit = {
            setup: function() {
                if (pe.nodeName(this, "form"))
                    return !1;
                pe.event.add(this, "click._submit keypress._submit", function(e) {
                    var t = e.target
                      , n = pe.nodeName(t, "input") || pe.nodeName(t, "button") ? pe.prop(t, "form") : void 0;
                    n && !pe._data(n, "submit") && (pe.event.add(n, "submit._submit", function(e) {
                        e._submitBubble = !0
                    }),
                    pe._data(n, "submit", !0))
                })
            },
            postDispatch: function(e) {
                e._submitBubble && (delete e._submitBubble,
                this.parentNode && !e.isTrigger && pe.event.simulate("submit", this.parentNode, e))
            },
            teardown: function() {
                if (pe.nodeName(this, "form"))
                    return !1;
                pe.event.remove(this, "._submit")
            }
        }),
        de.change || (pe.event.special.change = {
            setup: function() {
                if (Ve.test(this.nodeName))
                    return "checkbox" !== this.type && "radio" !== this.type || (pe.event.add(this, "propertychange._change", function(e) {
                        "checked" === e.originalEvent.propertyName && (this._justChanged = !0)
                    }),
                    pe.event.add(this, "click._change", function(e) {
                        this._justChanged && !e.isTrigger && (this._justChanged = !1),
                        pe.event.simulate("change", this, e)
                    })),
                    !1;
                pe.event.add(this, "beforeactivate._change", function(e) {
                    var t = e.target;
                    Ve.test(t.nodeName) && !pe._data(t, "change") && (pe.event.add(t, "change._change", function(e) {
                        !this.parentNode || e.isSimulated || e.isTrigger || pe.event.simulate("change", this.parentNode, e)
                    }),
                    pe._data(t, "change", !0))
                })
            },
            handle: function(e) {
                var t = e.target;
                if (this !== t || e.isSimulated || e.isTrigger || "radio" !== t.type && "checkbox" !== t.type)
                    return e.handleObj.handler.apply(this, arguments)
            },
            teardown: function() {
                return pe.event.remove(this, "._change"),
                !Ve.test(this.nodeName)
            }
        }),
        de.focusin || pe.each({
            focus: "focusin",
            blur: "focusout"
        }, function(e, t) {
            var n = function(e) {
                pe.event.simulate(t, e.target, pe.event.fix(e))
            };
            pe.event.special[t] = {
                setup: function() {
                    var i = this.ownerDocument || this
                      , o = pe._data(i, t);
                    o || i.addEventListener(e, n, !0),
                    pe._data(i, t, (o || 0) + 1)
                },
                teardown: function() {
                    var i = this.ownerDocument || this
                      , o = pe._data(i, t) - 1;
                    o ? pe._data(i, t, o) : (i.removeEventListener(e, n, !0),
                    pe._removeData(i, t))
                }
            }
        }),
        pe.fn.extend({
            on: function(e, t, n, i) {
                return x(this, e, t, n, i)
            },
            one: function(e, t, n, i) {
                return x(this, e, t, n, i, 1)
            },
            off: function(e, t, n) {
                var i, o;
                if (e && e.preventDefault && e.handleObj)
                    return i = e.handleObj,
                    pe(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler),
                    this;
                if ("object" == typeof e) {
                    for (o in e)
                        this.off(o, t, e[o]);
                    return this
                }
                return !1 !== t && "function" != typeof t || (n = t,
                t = void 0),
                !1 === n && (n = b),
                this.each(function() {
                    pe.event.remove(this, e, n, t)
                })
            },
            trigger: function(e, t) {
                return this.each(function() {
                    pe.event.trigger(e, t, this)
                })
            },
            triggerHandler: function(e, t) {
                var n = this[0];
                if (n)
                    return pe.event.trigger(e, t, n, !0)
            }
        });
        var Ke = / jQuery\d+="(?:null|\d+)"/g
          , Qe = new RegExp("<(?:" + Be + ")[\\s/>]","i")
          , Ze = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi
          , et = /<script|<style|<link/i
          , tt = /checked\s*(?:[^=]|=\s*.checked.)/i
          , nt = /^true\/(.*)/
          , it = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g
          , ot = f(ie)
          , rt = ot.appendChild(ie.createElement("div"));
        pe.extend({
            htmlPrefilter: function(e) {
                return e.replace(Ze, "<$1></$2>")
            },
            clone: function(e, t, n) {
                var i, o, r, a, s, l = pe.contains(e.ownerDocument, e);
                if (de.html5Clone || pe.isXMLDoc(e) || !Qe.test("<" + e.nodeName + ">") ? r = e.cloneNode(!0) : (rt.innerHTML = e.outerHTML,
                rt.removeChild(r = rt.firstChild)),
                !(de.noCloneEvent && de.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || pe.isXMLDoc(e)))
                    for (i = h(r),
                    s = h(e),
                    a = 0; null != (o = s[a]); ++a)
                        i[a] && E(o, i[a]);
                if (t)
                    if (n)
                        for (s = s || h(e),
                        i = i || h(r),
                        a = 0; null != (o = s[a]); a++)
                            S(o, i[a]);
                    else
                        S(e, r);
                return i = h(r, "script"),
                i.length > 0 && g(i, !l && h(e, "script")),
                i = s = o = null,
                r
            },
            cleanData: function(e, t) {
                for (var n, i, o, r, a = 0, s = pe.expando, l = pe.cache, u = de.attributes, c = pe.event.special; null != (n = e[a]); a++)
                    if ((t || je(n)) && (o = n[s],
                    r = o && l[o])) {
                        if (r.events)
                            for (i in r.events)
                                c[i] ? pe.event.remove(n, i) : pe.removeEvent(n, i, r.handle);
                        l[o] && (delete l[o],
                        u || void 0 === n.removeAttribute ? n[s] = void 0 : n.removeAttribute(s),
                        ne.push(o))
                    }
            }
        }),
        pe.fn.extend({
            domManip: N,
            detach: function(e) {
                return D(this, e, !0)
            },
            remove: function(e) {
                return D(this, e)
            },
            text: function(e) {
                return Fe(this, function(e) {
                    return void 0 === e ? pe.text(this) : this.empty().append((this[0] && this[0].ownerDocument || ie).createTextNode(e))
                }, null, e, arguments.length)
            },
            append: function() {
                return N(this, arguments, function(e) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        C(this, e).appendChild(e)
                    }
                })
            },
            prepend: function() {
                return N(this, arguments, function(e) {
                    if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                        var t = C(this, e);
                        t.insertBefore(e, t.firstChild)
                    }
                })
            },
            before: function() {
                return N(this, arguments, function(e) {
                    this.parentNode && this.parentNode.insertBefore(e, this)
                })
            },
            after: function() {
                return N(this, arguments, function(e) {
                    this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
                })
            },
            empty: function() {
                for (var e, t = 0; null != (e = this[t]); t++) {
                    for (1 === e.nodeType && pe.cleanData(h(e, !1)); e.firstChild; )
                        e.removeChild(e.firstChild);
                    e.options && pe.nodeName(e, "select") && (e.options.length = 0)
                }
                return this
            },
            clone: function(e, t) {
                return e = null != e && e,
                t = null == t ? e : t,
                this.map(function() {
                    return pe.clone(this, e, t)
                })
            },
            html: function(e) {
                return Fe(this, function(e) {
                    var t = this[0] || {}
                      , n = 0
                      , i = this.length;
                    if (void 0 === e)
                        return 1 === t.nodeType ? t.innerHTML.replace(Ke, "") : void 0;
                    if ("string" == typeof e && !et.test(e) && (de.htmlSerialize || !Qe.test(e)) && (de.leadingWhitespace || !We.test(e)) && !Xe[(Oe.exec(e) || ["", ""])[1].toLowerCase()]) {
                        e = pe.htmlPrefilter(e);
                        try {
                            for (; n < i; n++)
                                t = this[n] || {},
                                1 === t.nodeType && (pe.cleanData(h(t, !1)),
                                t.innerHTML = e);
                            t = 0
                        } catch (e) {}
                    }
                    t && this.empty().append(e)
                }, null, e, arguments.length)
            },
            replaceWith: function() {
                var e = [];
                return N(this, arguments, function(t) {
                    var n = this.parentNode;
                    pe.inArray(this, e) < 0 && (pe.cleanData(h(this)),
                    n && n.replaceChild(t, this))
                }, e)
            }
        }),
        pe.each({
            appendTo: "append",
            prependTo: "prepend",
            insertBefore: "before",
            insertAfter: "after",
            replaceAll: "replaceWith"
        }, function(e, t) {
            pe.fn[e] = function(e) {
                for (var n, i = 0, o = [], r = pe(e), a = r.length - 1; i <= a; i++)
                    n = i === a ? this : this.clone(!0),
                    pe(r[i])[t](n),
                    ae.apply(o, n.get());
                return this.pushStack(o)
            }
        });
        var at, st = {
            HTML: "block",
            BODY: "block"
        }, lt = /^margin/, ut = new RegExp("^(" + qe + ")(?!px)[a-z%]+$","i"), ct = function(e, t, n, i) {
            var o, r, a = {};
            for (r in t)
                a[r] = e.style[r],
                e.style[r] = t[r];
            o = n.apply(e, i || []);
            for (r in t)
                e.style[r] = a[r];
            return o
        }, dt = ie.documentElement;
        !function() {
            function t() {
                var t, c, d = ie.documentElement;
                d.appendChild(l),
                u.style.cssText = "-webkit-box-sizing:border-box;box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%",
                n = o = s = !1,
                i = a = !0,
                e.getComputedStyle && (c = e.getComputedStyle(u),
                n = "1%" !== (c || {}).top,
                s = "2px" === (c || {}).marginLeft,
                o = "4px" === (c || {
                    width: "4px"
                }).width,
                u.style.marginRight = "50%",
                i = "4px" === (c || {
                    marginRight: "4px"
                }).marginRight,
                t = u.appendChild(ie.createElement("div")),
                t.style.cssText = u.style.cssText = "-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",
                t.style.marginRight = t.style.width = "0",
                u.style.width = "1px",
                a = !parseFloat((e.getComputedStyle(t) || {}).marginRight),
                u.removeChild(t)),
                u.style.display = "none",
                r = 0 === u.getClientRects().length,
                r && (u.style.display = "",
                u.innerHTML = "<table><tr><td></td><td>t</td></tr></table>",
                u.childNodes[0].style.borderCollapse = "separate",
                t = u.getElementsByTagName("td"),
                t[0].style.cssText = "margin:0;border:0;padding:0;display:none",
                (r = 0 === t[0].offsetHeight) && (t[0].style.display = "",
                t[1].style.display = "none",
                r = 0 === t[0].offsetHeight)),
                d.removeChild(l)
            }
            var n, i, o, r, a, s, l = ie.createElement("div"), u = ie.createElement("div");
            u.style && (u.style.cssText = "float:left;opacity:.5",
            de.opacity = "0.5" === u.style.opacity,
            de.cssFloat = !!u.style.cssFloat,
            u.style.backgroundClip = "content-box",
            u.cloneNode(!0).style.backgroundClip = "",
            de.clearCloneStyle = "content-box" === u.style.backgroundClip,
            l = ie.createElement("div"),
            l.style.cssText = "border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute",
            u.innerHTML = "",
            l.appendChild(u),
            de.boxSizing = "" === u.style.boxSizing || "" === u.style.MozBoxSizing || "" === u.style.WebkitBoxSizing,
            pe.extend(de, {
                reliableHiddenOffsets: function() {
                    return null == n && t(),
                    r
                },
                boxSizingReliable: function() {
                    return null == n && t(),
                    o
                },
                pixelMarginRight: function() {
                    return null == n && t(),
                    i
                },
                pixelPosition: function() {
                    return null == n && t(),
                    n
                },
                reliableMarginRight: function() {
                    return null == n && t(),
                    a
                },
                reliableMarginLeft: function() {
                    return null == n && t(),
                    s
                }
            }))
        }();
        var pt, ft, ht = /^(top|right|bottom|left)$/;
        e.getComputedStyle ? (pt = function(t) {
            var n = t.ownerDocument.defaultView;
            return n && n.opener || (n = e),
            n.getComputedStyle(t)
        }
        ,
        ft = function(e, t, n) {
            var i, o, r, a, s = e.style;
            return n = n || pt(e),
            a = n ? n.getPropertyValue(t) || n[t] : void 0,
            "" !== a && void 0 !== a || pe.contains(e.ownerDocument, e) || (a = pe.style(e, t)),
            n && !de.pixelMarginRight() && ut.test(a) && lt.test(t) && (i = s.width,
            o = s.minWidth,
            r = s.maxWidth,
            s.minWidth = s.maxWidth = s.width = a,
            a = n.width,
            s.width = i,
            s.minWidth = o,
            s.maxWidth = r),
            void 0 === a ? a : a + ""
        }
        ) : dt.currentStyle && (pt = function(e) {
            return e.currentStyle
        }
        ,
        ft = function(e, t, n) {
            var i, o, r, a, s = e.style;
            return n = n || pt(e),
            a = n ? n[t] : void 0,
            null == a && s && s[t] && (a = s[t]),
            ut.test(a) && !ht.test(t) && (i = s.left,
            o = e.runtimeStyle,
            r = o && o.left,
            r && (o.left = e.currentStyle.left),
            s.left = "fontSize" === t ? "1em" : a,
            a = s.pixelLeft + "px",
            s.left = i,
            r && (o.left = r)),
            void 0 === a ? a : a + "" || "auto"
        }
        );
        var gt = /alpha\([^)]*\)/i
          , mt = /opacity\s*=\s*([^)]*)/i
          , vt = /^(none|table(?!-c[ea]).+)/
          , yt = new RegExp("^(" + qe + ")(.*)$","i")
          , bt = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        }
          , wt = {
            letterSpacing: "0",
            fontWeight: "400"
        }
          , xt = ["Webkit", "O", "Moz", "ms"]
          , Ct = ie.createElement("div").style;
        pe.extend({
            cssHooks: {
                opacity: {
                    get: function(e, t) {
                        if (t) {
                            var n = ft(e, "opacity");
                            return "" === n ? "1" : n
                        }
                    }
                }
            },
            cssNumber: {
                animationIterationCount: !0,
                columnCount: !0,
                fillOpacity: !0,
                flexGrow: !0,
                flexShrink: !0,
                fontWeight: !0,
                lineHeight: !0,
                opacity: !0,
                order: !0,
                orphans: !0,
                widows: !0,
                zIndex: !0,
                zoom: !0
            },
            cssProps: {
                float: de.cssFloat ? "cssFloat" : "styleFloat"
            },
            style: function(e, t, n, i) {
                if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                    var o, r, a, s = pe.camelCase(t), l = e.style;
                    if (t = pe.cssProps[s] || (pe.cssProps[s] = _(s) || s),
                    a = pe.cssHooks[t] || pe.cssHooks[s],
                    void 0 === n)
                        return a && "get"in a && void 0 !== (o = a.get(e, !1, i)) ? o : l[t];
                    if (r = typeof n,
                    "string" === r && (o = Ie.exec(n)) && o[1] && (n = p(e, t, o),
                    r = "number"),
                    null != n && n === n && ("number" === r && (n += o && o[3] || (pe.cssNumber[s] ? "" : "px")),
                    de.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (l[t] = "inherit"),
                    !(a && "set"in a && void 0 === (n = a.set(e, n, i)))))
                        try {
                            l[t] = n
                        } catch (e) {}
                }
            },
            css: function(e, t, n, i) {
                var o, r, a, s = pe.camelCase(t);
                return t = pe.cssProps[s] || (pe.cssProps[s] = _(s) || s),
                a = pe.cssHooks[t] || pe.cssHooks[s],
                a && "get"in a && (r = a.get(e, !0, n)),
                void 0 === r && (r = ft(e, t, i)),
                "normal" === r && t in wt && (r = wt[t]),
                "" === n || n ? (o = parseFloat(r),
                !0 === n || isFinite(o) ? o || 0 : r) : r
            }
        }),
        pe.each(["height", "width"], function(e, t) {
            pe.cssHooks[t] = {
                get: function(e, n, i) {
                    if (n)
                        return vt.test(pe.css(e, "display")) && 0 === e.offsetWidth ? ct(e, bt, function() {
                            return M(e, t, i)
                        }) : M(e, t, i)
                },
                set: function(e, n, i) {
                    var o = i && pt(e);
                    return I(e, n, i ? H(e, t, i, de.boxSizing && "border-box" === pe.css(e, "boxSizing", !1, o), o) : 0)
                }
            }
        }),
        de.opacity || (pe.cssHooks.opacity = {
            get: function(e, t) {
                return mt.test((t && e.currentStyle ? e.currentStyle.filter : e.style.filter) || "") ? .01 * parseFloat(RegExp.$1) + "" : t ? "1" : ""
            },
            set: function(e, t) {
                var n = e.style
                  , i = e.currentStyle
                  , o = pe.isNumeric(t) ? "alpha(opacity=" + 100 * t + ")" : ""
                  , r = i && i.filter || n.filter || "";
                n.zoom = 1,
                (t >= 1 || "" === t) && "" === pe.trim(r.replace(gt, "")) && n.removeAttribute && (n.removeAttribute("filter"),
                "" === t || i && !i.filter) || (n.filter = gt.test(r) ? r.replace(gt, o) : r + " " + o)
            }
        }),
        pe.cssHooks.marginRight = A(de.reliableMarginRight, function(e, t) {
            if (t)
                return ct(e, {
                    display: "inline-block"
                }, ft, [e, "marginRight"])
        }),
        pe.cssHooks.marginLeft = A(de.reliableMarginLeft, function(e, t) {
            if (t)
                return (parseFloat(ft(e, "marginLeft")) || (pe.contains(e.ownerDocument, e) ? e.getBoundingClientRect().left - ct(e, {
                    marginLeft: 0
                }, function() {
                    return e.getBoundingClientRect().left
                }) : 0)) + "px"
        }),
        pe.each({
            margin: "",
            padding: "",
            border: "Width"
        }, function(e, t) {
            pe.cssHooks[e + t] = {
                expand: function(n) {
                    for (var i = 0, o = {}, r = "string" == typeof n ? n.split(" ") : [n]; i < 4; i++)
                        o[e + He[i] + t] = r[i] || r[i - 2] || r[0];
                    return o
                }
            },
            lt.test(e) || (pe.cssHooks[e + t].set = I)
        }),
        pe.fn.extend({
            css: function(e, t) {
                return Fe(this, function(e, t, n) {
                    var i, o, r = {}, a = 0;
                    if (pe.isArray(t)) {
                        for (i = pt(e),
                        o = t.length; a < o; a++)
                            r[t[a]] = pe.css(e, t[a], !1, i);
                        return r
                    }
                    return void 0 !== n ? pe.style(e, t, n) : pe.css(e, t)
                }, e, t, arguments.length > 1)
            },
            show: function() {
                return q(this, !0)
            },
            hide: function() {
                return q(this)
            },
            toggle: function(e) {
                return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function() {
                    Me(this) ? pe(this).show() : pe(this).hide()
                })
            }
        }),
        pe.Tween = F,
        F.prototype = {
            constructor: F,
            init: function(e, t, n, i, o, r) {
                this.elem = e,
                this.prop = n,
                this.easing = o || pe.easing._default,
                this.options = t,
                this.start = this.now = this.cur(),
                this.end = i,
                this.unit = r || (pe.cssNumber[n] ? "" : "px")
            },
            cur: function() {
                var e = F.propHooks[this.prop];
                return e && e.get ? e.get(this) : F.propHooks._default.get(this)
            },
            run: function(e) {
                var t, n = F.propHooks[this.prop];
                return this.options.duration ? this.pos = t = pe.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e,
                this.now = (this.end - this.start) * t + this.start,
                this.options.step && this.options.step.call(this.elem, this.now, this),
                n && n.set ? n.set(this) : F.propHooks._default.set(this),
                this
            }
        },
        F.prototype.init.prototype = F.prototype,
        F.propHooks = {
            _default: {
                get: function(e) {
                    var t;
                    return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = pe.css(e.elem, e.prop, ""),
                    t && "auto" !== t ? t : 0)
                },
                set: function(e) {
                    pe.fx.step[e.prop] ? pe.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[pe.cssProps[e.prop]] && !pe.cssHooks[e.prop] ? e.elem[e.prop] = e.now : pe.style(e.elem, e.prop, e.now + e.unit)
                }
            }
        },
        F.propHooks.scrollTop = F.propHooks.scrollLeft = {
            set: function(e) {
                e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
            }
        },
        pe.easing = {
            linear: function(e) {
                return e
            },
            swing: function(e) {
                return .5 - Math.cos(e * Math.PI) / 2
            },
            _default: "swing"
        },
        pe.fx = F.prototype.init,
        pe.fx.step = {};
        var Tt, kt, St = /^(?:toggle|show|hide)$/, Et = /queueHooks$/;
        pe.Animation = pe.extend(X, {
            tweeners: {
                "*": [function(e, t) {
                    var n = this.createTween(e, t);
                    return p(n.elem, e, Ie.exec(t), n),
                    n
                }
                ]
            },
            tweener: function(e, t) {
                pe.isFunction(e) ? (t = e,
                e = ["*"]) : e = e.match(Ne);
                for (var n, i = 0, o = e.length; i < o; i++)
                    n = e[i],
                    X.tweeners[n] = X.tweeners[n] || [],
                    X.tweeners[n].unshift(t)
            },
            prefilters: [W],
            prefilter: function(e, t) {
                t ? X.prefilters.unshift(e) : X.prefilters.push(e)
            }
        }),
        pe.speed = function(e, t, n) {
            var i = e && "object" == typeof e ? pe.extend({}, e) : {
                complete: n || !n && t || pe.isFunction(e) && e,
                duration: e,
                easing: n && t || t && !pe.isFunction(t) && t
            };
            return i.duration = pe.fx.off ? 0 : "number" == typeof i.duration ? i.duration : i.duration in pe.fx.speeds ? pe.fx.speeds[i.duration] : pe.fx.speeds._default,
            null != i.queue && !0 !== i.queue || (i.queue = "fx"),
            i.old = i.complete,
            i.complete = function() {
                pe.isFunction(i.old) && i.old.call(this),
                i.queue && pe.dequeue(this, i.queue)
            }
            ,
            i
        }
        ,
        pe.fn.extend({
            fadeTo: function(e, t, n, i) {
                return this.filter(Me).css("opacity", 0).show().end().animate({
                    opacity: t
                }, e, n, i)
            },
            animate: function(e, t, n, i) {
                var o = pe.isEmptyObject(e)
                  , r = pe.speed(t, n, i)
                  , a = function() {
                    var t = X(this, pe.extend({}, e), r);
                    (o || pe._data(this, "finish")) && t.stop(!0)
                };
                return a.finish = a,
                o || !1 === r.queue ? this.each(a) : this.queue(r.queue, a)
            },
            stop: function(e, t, n) {
                var i = function(e) {
                    var t = e.stop;
                    delete e.stop,
                    t(n)
                };
                return "string" != typeof e && (n = t,
                t = e,
                e = void 0),
                t && !1 !== e && this.queue(e || "fx", []),
                this.each(function() {
                    var t = !0
                      , o = null != e && e + "queueHooks"
                      , r = pe.timers
                      , a = pe._data(this);
                    if (o)
                        a[o] && a[o].stop && i(a[o]);
                    else
                        for (o in a)
                            a[o] && a[o].stop && Et.test(o) && i(a[o]);
                    for (o = r.length; o--; )
                        r[o].elem !== this || null != e && r[o].queue !== e || (r[o].anim.stop(n),
                        t = !1,
                        r.splice(o, 1));
                    !t && n || pe.dequeue(this, e)
                })
            },
            finish: function(e) {
                return !1 !== e && (e = e || "fx"),
                this.each(function() {
                    var t, n = pe._data(this), i = n[e + "queue"], o = n[e + "queueHooks"], r = pe.timers, a = i ? i.length : 0;
                    for (n.finish = !0,
                    pe.queue(this, e, []),
                    o && o.stop && o.stop.call(this, !0),
                    t = r.length; t--; )
                        r[t].elem === this && r[t].queue === e && (r[t].anim.stop(!0),
                        r.splice(t, 1));
                    for (t = 0; t < a; t++)
                        i[t] && i[t].finish && i[t].finish.call(this);
                    delete n.finish
                })
            }
        }),
        pe.each(["toggle", "show", "hide"], function(e, t) {
            var n = pe.fn[t];
            pe.fn[t] = function(e, i, o) {
                return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(O(t, !0), e, i, o)
            }
        }),
        pe.each({
            slideDown: O("show"),
            slideUp: O("hide"),
            slideToggle: O("toggle"),
            fadeIn: {
                opacity: "show"
            },
            fadeOut: {
                opacity: "hide"
            },
            fadeToggle: {
                opacity: "toggle"
            }
        }, function(e, t) {
            pe.fn[e] = function(e, n, i) {
                return this.animate(t, e, n, i)
            }
        }),
        pe.timers = [],
        pe.fx.tick = function() {
            var e, t = pe.timers, n = 0;
            for (Tt = pe.now(); n < t.length; n++)
                (e = t[n])() || t[n] !== e || t.splice(n--, 1);
            t.length || pe.fx.stop(),
            Tt = void 0
        }
        ,
        pe.fx.timer = function(e) {
            pe.timers.push(e),
            e() ? pe.fx.start() : pe.timers.pop()
        }
        ,
        pe.fx.interval = 13,
        pe.fx.start = function() {
            kt || (kt = e.setInterval(pe.fx.tick, pe.fx.interval))
        }
        ,
        pe.fx.stop = function() {
            e.clearInterval(kt),
            kt = null
        }
        ,
        pe.fx.speeds = {
            slow: 600,
            fast: 200,
            _default: 400
        },
        pe.fn.delay = function(t, n) {
            return t = pe.fx ? pe.fx.speeds[t] || t : t,
            n = n || "fx",
            this.queue(n, function(n, i) {
                var o = e.setTimeout(n, t);
                i.stop = function() {
                    e.clearTimeout(o)
                }
            })
        }
        ,
        function() {
            var e, t = ie.createElement("input"), n = ie.createElement("div"), i = ie.createElement("select"), o = i.appendChild(ie.createElement("option"));
            n = ie.createElement("div"),
            n.setAttribute("className", "t"),
            n.innerHTML = "  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",
            e = n.getElementsByTagName("a")[0],
            t.setAttribute("type", "checkbox"),
            n.appendChild(t),
            e = n.getElementsByTagName("a")[0],
            e.style.cssText = "top:1px",
            de.getSetAttribute = "t" !== n.className,
            de.style = /top/.test(e.getAttribute("style")),
            de.hrefNormalized = "/a" === e.getAttribute("href"),
            de.checkOn = !!t.value,
            de.optSelected = o.selected,
            de.enctype = !!ie.createElement("form").enctype,
            i.disabled = !0,
            de.optDisabled = !o.disabled,
            t = ie.createElement("input"),
            t.setAttribute("value", ""),
            de.input = "" === t.getAttribute("value"),
            t.value = "t",
            t.setAttribute("type", "radio"),
            de.radioValue = "t" === t.value
        }();
        var Nt = /\r/g
          , Dt = /[\x20\t\r\n\f]+/g;
        pe.fn.extend({
            val: function(e) {
                var t, n, i, o = this[0];
                {
                    if (arguments.length)
                        return i = pe.isFunction(e),
                        this.each(function(n) {
                            var o;
                            1 === this.nodeType && (o = i ? e.call(this, n, pe(this).val()) : e,
                            null == o ? o = "" : "number" == typeof o ? o += "" : pe.isArray(o) && (o = pe.map(o, function(e) {
                                return null == e ? "" : e + ""
                            })),
                            (t = pe.valHooks[this.type] || pe.valHooks[this.nodeName.toLowerCase()]) && "set"in t && void 0 !== t.set(this, o, "value") || (this.value = o))
                        });
                    if (o)
                        return (t = pe.valHooks[o.type] || pe.valHooks[o.nodeName.toLowerCase()]) && "get"in t && void 0 !== (n = t.get(o, "value")) ? n : (n = o.value,
                        "string" == typeof n ? n.replace(Nt, "") : null == n ? "" : n)
                }
            }
        }),
        pe.extend({
            valHooks: {
                option: {
                    get: function(e) {
                        var t = pe.find.attr(e, "value");
                        return null != t ? t : pe.trim(pe.text(e)).replace(Dt, " ")
                    }
                },
                select: {
                    get: function(e) {
                        for (var t, n, i = e.options, o = e.selectedIndex, r = "select-one" === e.type || o < 0, a = r ? null : [], s = r ? o + 1 : i.length, l = o < 0 ? s : r ? o : 0; l < s; l++)
                            if (n = i[l],
                            (n.selected || l === o) && (de.optDisabled ? !n.disabled : null === n.getAttribute("disabled")) && (!n.parentNode.disabled || !pe.nodeName(n.parentNode, "optgroup"))) {
                                if (t = pe(n).val(),
                                r)
                                    return t;
                                a.push(t)
                            }
                        return a
                    },
                    set: function(e, t) {
                        for (var n, i, o = e.options, r = pe.makeArray(t), a = o.length; a--; )
                            if (i = o[a],
                            pe.inArray(pe.valHooks.option.get(i), r) > -1)
                                try {
                                    i.selected = n = !0
                                } catch (e) {
                                    i.scrollHeight
                                }
                            else
                                i.selected = !1;
                        return n || (e.selectedIndex = -1),
                        o
                    }
                }
            }
        }),
        pe.each(["radio", "checkbox"], function() {
            pe.valHooks[this] = {
                set: function(e, t) {
                    if (pe.isArray(t))
                        return e.checked = pe.inArray(pe(e).val(), t) > -1
                }
            },
            de.checkOn || (pe.valHooks[this].get = function(e) {
                return null === e.getAttribute("value") ? "on" : e.value
            }
            )
        });
        var Lt, jt, At = pe.expr.attrHandle, _t = /^(?:checked|selected)$/i, qt = de.getSetAttribute, It = de.input;
        pe.fn.extend({
            attr: function(e, t) {
                return Fe(this, pe.attr, e, t, arguments.length > 1)
            },
            removeAttr: function(e) {
                return this.each(function() {
                    pe.removeAttr(this, e)
                })
            }
        }),
        pe.extend({
            attr: function(e, t, n) {
                var i, o, r = e.nodeType;
                if (3 !== r && 8 !== r && 2 !== r)
                    return void 0 === e.getAttribute ? pe.prop(e, t, n) : (1 === r && pe.isXMLDoc(e) || (t = t.toLowerCase(),
                    o = pe.attrHooks[t] || (pe.expr.match.bool.test(t) ? jt : Lt)),
                    void 0 !== n ? null === n ? void pe.removeAttr(e, t) : o && "set"in o && void 0 !== (i = o.set(e, n, t)) ? i : (e.setAttribute(t, n + ""),
                    n) : o && "get"in o && null !== (i = o.get(e, t)) ? i : (i = pe.find.attr(e, t),
                    null == i ? void 0 : i))
            },
            attrHooks: {
                type: {
                    set: function(e, t) {
                        if (!de.radioValue && "radio" === t && pe.nodeName(e, "input")) {
                            var n = e.value;
                            return e.setAttribute("type", t),
                            n && (e.value = n),
                            t
                        }
                    }
                }
            },
            removeAttr: function(e, t) {
                var n, i, o = 0, r = t && t.match(Ne);
                if (r && 1 === e.nodeType)
                    for (; n = r[o++]; )
                        i = pe.propFix[n] || n,
                        pe.expr.match.bool.test(n) ? It && qt || !_t.test(n) ? e[i] = !1 : e[pe.camelCase("default-" + n)] = e[i] = !1 : pe.attr(e, n, ""),
                        e.removeAttribute(qt ? n : i)
            }
        }),
        jt = {
            set: function(e, t, n) {
                return !1 === t ? pe.removeAttr(e, n) : It && qt || !_t.test(n) ? e.setAttribute(!qt && pe.propFix[n] || n, n) : e[pe.camelCase("default-" + n)] = e[n] = !0,
                n
            }
        },
        pe.each(pe.expr.match.bool.source.match(/\w+/g), function(e, t) {
            var n = At[t] || pe.find.attr;
            It && qt || !_t.test(t) ? At[t] = function(e, t, i) {
                var o, r;
                return i || (r = At[t],
                At[t] = o,
                o = null != n(e, t, i) ? t.toLowerCase() : null,
                At[t] = r),
                o
            }
            : At[t] = function(e, t, n) {
                if (!n)
                    return e[pe.camelCase("default-" + t)] ? t.toLowerCase() : null
            }
        }),
        It && qt || (pe.attrHooks.value = {
            set: function(e, t, n) {
                if (!pe.nodeName(e, "input"))
                    return Lt && Lt.set(e, t, n);
                e.defaultValue = t
            }
        }),
        qt || (Lt = {
            set: function(e, t, n) {
                var i = e.getAttributeNode(n);
                if (i || e.setAttributeNode(i = e.ownerDocument.createAttribute(n)),
                i.value = t += "",
                "value" === n || t === e.getAttribute(n))
                    return t
            }
        },
        At.id = At.name = At.coords = function(e, t, n) {
            var i;
            if (!n)
                return (i = e.getAttributeNode(t)) && "" !== i.value ? i.value : null
        }
        ,
        pe.valHooks.button = {
            get: function(e, t) {
                var n = e.getAttributeNode(t);
                if (n && n.specified)
                    return n.value
            },
            set: Lt.set
        },
        pe.attrHooks.contenteditable = {
            set: function(e, t, n) {
                Lt.set(e, "" !== t && t, n)
            }
        },
        pe.each(["width", "height"], function(e, t) {
            pe.attrHooks[t] = {
                set: function(e, n) {
                    if ("" === n)
                        return e.setAttribute(t, "auto"),
                        n
                }
            }
        })),
        de.style || (pe.attrHooks.style = {
            get: function(e) {
                return e.style.cssText || void 0
            },
            set: function(e, t) {
                return e.style.cssText = t + ""
            }
        });
        var Ht = /^(?:input|select|textarea|button|object)$/i
          , Mt = /^(?:a|area)$/i;
        pe.fn.extend({
            prop: function(e, t) {
                return Fe(this, pe.prop, e, t, arguments.length > 1)
            },
            removeProp: function(e) {
                return e = pe.propFix[e] || e,
                this.each(function() {
                    try {
                        this[e] = void 0,
                        delete this[e]
                    } catch (e) {}
                })
            }
        }),
        pe.extend({
            prop: function(e, t, n) {
                var i, o, r = e.nodeType;
                if (3 !== r && 8 !== r && 2 !== r)
                    return 1 === r && pe.isXMLDoc(e) || (t = pe.propFix[t] || t,
                    o = pe.propHooks[t]),
                    void 0 !== n ? o && "set"in o && void 0 !== (i = o.set(e, n, t)) ? i : e[t] = n : o && "get"in o && null !== (i = o.get(e, t)) ? i : e[t]
            },
            propHooks: {
                tabIndex: {
                    get: function(e) {
                        var t = pe.find.attr(e, "tabindex");
                        return t ? parseInt(t, 10) : Ht.test(e.nodeName) || Mt.test(e.nodeName) && e.href ? 0 : -1
                    }
                }
            },
            propFix: {
                for: "htmlFor",
                class: "className"
            }
        }),
        de.hrefNormalized || pe.each(["href", "src"], function(e, t) {
            pe.propHooks[t] = {
                get: function(e) {
                    return e.getAttribute(t, 4)
                }
            }
        }),
        de.optSelected || (pe.propHooks.selected = {
            get: function(e) {
                var t = e.parentNode;
                return t && (t.selectedIndex,
                t.parentNode && t.parentNode.selectedIndex),
                null
            },
            set: function(e) {
                var t = e.parentNode;
                t && (t.selectedIndex,
                t.parentNode && t.parentNode.selectedIndex)
            }
        }),
        pe.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
            pe.propFix[this.toLowerCase()] = this
        }),
        de.enctype || (pe.propFix.enctype = "encoding");
        var Ft = /[\t\r\n\f]/g;
        pe.fn.extend({
            addClass: function(e) {
                var t, n, i, o, r, a, s, l = 0;
                if (pe.isFunction(e))
                    return this.each(function(t) {
                        pe(this).addClass(e.call(this, t, $(this)))
                    });
                if ("string" == typeof e && e)
                    for (t = e.match(Ne) || []; n = this[l++]; )
                        if (o = $(n),
                        i = 1 === n.nodeType && (" " + o + " ").replace(Ft, " ")) {
                            for (a = 0; r = t[a++]; )
                                i.indexOf(" " + r + " ") < 0 && (i += r + " ");
                            s = pe.trim(i),
                            o !== s && pe.attr(n, "class", s)
                        }
                return this
            },
            removeClass: function(e) {
                var t, n, i, o, r, a, s, l = 0;
                if (pe.isFunction(e))
                    return this.each(function(t) {
                        pe(this).removeClass(e.call(this, t, $(this)))
                    });
                if (!arguments.length)
                    return this.attr("class", "");
                if ("string" == typeof e && e)
                    for (t = e.match(Ne) || []; n = this[l++]; )
                        if (o = $(n),
                        i = 1 === n.nodeType && (" " + o + " ").replace(Ft, " ")) {
                            for (a = 0; r = t[a++]; )
                                for (; i.indexOf(" " + r + " ") > -1; )
                                    i = i.replace(" " + r + " ", " ");
                            s = pe.trim(i),
                            o !== s && pe.attr(n, "class", s)
                        }
                return this
            },
            toggleClass: function(e, t) {
                var n = typeof e;
                return "boolean" == typeof t && "string" === n ? t ? this.addClass(e) : this.removeClass(e) : pe.isFunction(e) ? this.each(function(n) {
                    pe(this).toggleClass(e.call(this, n, $(this), t), t)
                }) : this.each(function() {
                    var t, i, o, r;
                    if ("string" === n)
                        for (i = 0,
                        o = pe(this),
                        r = e.match(Ne) || []; t = r[i++]; )
                            o.hasClass(t) ? o.removeClass(t) : o.addClass(t);
                    else
                        void 0 !== e && "boolean" !== n || (t = $(this),
                        t && pe._data(this, "__className__", t),
                        pe.attr(this, "class", t || !1 === e ? "" : pe._data(this, "__className__") || ""))
                })
            },
            hasClass: function(e) {
                var t, n, i = 0;
                for (t = " " + e + " "; n = this[i++]; )
                    if (1 === n.nodeType && (" " + $(n) + " ").replace(Ft, " ").indexOf(t) > -1)
                        return !0;
                return !1
            }
        }),
        pe.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function(e, t) {
            pe.fn[t] = function(e, n) {
                return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
            }
        }),
        pe.fn.extend({
            hover: function(e, t) {
                return this.mouseenter(e).mouseleave(t || e)
            }
        });
        var Pt = e.location
          , Ot = pe.now()
          , Rt = /\?/
          , Wt = /(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;
        pe.parseJSON = function(t) {
            if (e.JSON && e.JSON.parse)
                return e.JSON.parse(t + "");
            var n, i = null, o = pe.trim(t + "");
            return o && !pe.trim(o.replace(Wt, function(e, t, o, r) {
                return n && t && (i = 0),
                0 === i ? e : (n = o || t,
                i += !r - !o,
                "")
            })) ? Function("return " + o)() : pe.error("Invalid JSON: " + t)
        }
        ,
        pe.parseXML = function(t) {
            var n, i;
            if (!t || "string" != typeof t)
                return null;
            try {
                e.DOMParser ? (i = new e.DOMParser,
                n = i.parseFromString(t, "text/xml")) : (n = new e.ActiveXObject("Microsoft.XMLDOM"),
                n.async = "false",
                n.loadXML(t))
            } catch (e) {
                n = void 0
            }
            return n && n.documentElement && !n.getElementsByTagName("parsererror").length || pe.error("Invalid XML: " + t),
            n
        }
        ;
        var Bt = /#.*$/
          , Xt = /([?&])_=[^&]*/
          , $t = /^(.*?):[ \t]*([^\r\n]*)\r?$/gm
          , zt = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/
          , Vt = /^(?:GET|HEAD)$/
          , Ut = /^\/\//
          , Gt = /^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/
          , Yt = {}
          , Jt = {}
          , Kt = "*/".concat("*")
          , Qt = Pt.href
          , Zt = Gt.exec(Qt.toLowerCase()) || [];
        pe.extend({
            active: 0,
            lastModified: {},
            etag: {},
            ajaxSettings: {
                url: Qt,
                type: "GET",
                isLocal: zt.test(Zt[1]),
                global: !0,
                processData: !0,
                async: !0,
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                accepts: {
                    "*": Kt,
                    text: "text/plain",
                    html: "text/html",
                    xml: "application/xml, text/xml",
                    json: "application/json, text/javascript"
                },
                contents: {
                    xml: /\bxml\b/,
                    html: /\bhtml/,
                    json: /\bjson\b/
                },
                responseFields: {
                    xml: "responseXML",
                    text: "responseText",
                    json: "responseJSON"
                },
                converters: {
                    "* text": String,
                    "text html": !0,
                    "text json": pe.parseJSON,
                    "text xml": pe.parseXML
                },
                flatOptions: {
                    url: !0,
                    context: !0
                }
            },
            ajaxSetup: function(e, t) {
                return t ? U(U(e, pe.ajaxSettings), t) : U(pe.ajaxSettings, e)
            },
            ajaxPrefilter: z(Yt),
            ajaxTransport: z(Jt),
            ajax: function(t, n) {
                function i(t, n, i, o) {
                    var r, d, y, b, x, T = n;
                    2 !== w && (w = 2,
                    l && e.clearTimeout(l),
                    c = void 0,
                    s = o || "",
                    C.readyState = t > 0 ? 4 : 0,
                    r = t >= 200 && t < 300 || 304 === t,
                    i && (b = G(p, C, i)),
                    b = Y(p, b, C, r),
                    r ? (p.ifModified && (x = C.getResponseHeader("Last-Modified"),
                    x && (pe.lastModified[a] = x),
                    (x = C.getResponseHeader("etag")) && (pe.etag[a] = x)),
                    204 === t || "HEAD" === p.type ? T = "nocontent" : 304 === t ? T = "notmodified" : (T = b.state,
                    d = b.data,
                    y = b.error,
                    r = !y)) : (y = T,
                    !t && T || (T = "error",
                    t < 0 && (t = 0))),
                    C.status = t,
                    C.statusText = (n || T) + "",
                    r ? g.resolveWith(f, [d, T, C]) : g.rejectWith(f, [C, T, y]),
                    C.statusCode(v),
                    v = void 0,
                    u && h.trigger(r ? "ajaxSuccess" : "ajaxError", [C, p, r ? d : y]),
                    m.fireWith(f, [C, T]),
                    u && (h.trigger("ajaxComplete", [C, p]),
                    --pe.active || pe.event.trigger("ajaxStop")))
                }
                "object" == typeof t && (n = t,
                t = void 0),
                n = n || {};
                var o, r, a, s, l, u, c, d, p = pe.ajaxSetup({}, n), f = p.context || p, h = p.context && (f.nodeType || f.jquery) ? pe(f) : pe.event, g = pe.Deferred(), m = pe.Callbacks("once memory"), v = p.statusCode || {}, y = {}, b = {}, w = 0, x = "canceled", C = {
                    readyState: 0,
                    getResponseHeader: function(e) {
                        var t;
                        if (2 === w) {
                            if (!d)
                                for (d = {}; t = $t.exec(s); )
                                    d[t[1].toLowerCase()] = t[2];
                            t = d[e.toLowerCase()]
                        }
                        return null == t ? null : t
                    },
                    getAllResponseHeaders: function() {
                        return 2 === w ? s : null
                    },
                    setRequestHeader: function(e, t) {
                        var n = e.toLowerCase();
                        return w || (e = b[n] = b[n] || e,
                        y[e] = t),
                        this
                    },
                    overrideMimeType: function(e) {
                        return w || (p.mimeType = e),
                        this
                    },
                    statusCode: function(e) {
                        var t;
                        if (e)
                            if (w < 2)
                                for (t in e)
                                    v[t] = [v[t], e[t]];
                            else
                                C.always(e[C.status]);
                        return this
                    },
                    abort: function(e) {
                        var t = e || x;
                        return c && c.abort(t),
                        i(0, t),
                        this
                    }
                };
                if (g.promise(C).complete = m.add,
                C.success = C.done,
                C.error = C.fail,
                p.url = ((t || p.url || Qt) + "").replace(Bt, "").replace(Ut, Zt[1] + "//"),
                p.type = n.method || n.type || p.method || p.type,
                p.dataTypes = pe.trim(p.dataType || "*").toLowerCase().match(Ne) || [""],
                null == p.crossDomain && (o = Gt.exec(p.url.toLowerCase()),
                p.crossDomain = !(!o || o[1] === Zt[1] && o[2] === Zt[2] && (o[3] || ("http:" === o[1] ? "80" : "443")) === (Zt[3] || ("http:" === Zt[1] ? "80" : "443")))),
                p.data && p.processData && "string" != typeof p.data && (p.data = pe.param(p.data, p.traditional)),
                V(Yt, p, n, C),
                2 === w)
                    return C;
                u = pe.event && p.global,
                u && 0 == pe.active++ && pe.event.trigger("ajaxStart"),
                p.type = p.type.toUpperCase(),
                p.hasContent = !Vt.test(p.type),
                a = p.url,
                p.hasContent || (p.data && (a = p.url += (Rt.test(a) ? "&" : "?") + p.data,
                delete p.data),
                !1 === p.cache && (p.url = Xt.test(a) ? a.replace(Xt, "$1_=" + Ot++) : a + (Rt.test(a) ? "&" : "?") + "_=" + Ot++)),
                p.ifModified && (pe.lastModified[a] && C.setRequestHeader("If-Modified-Since", pe.lastModified[a]),
                pe.etag[a] && C.setRequestHeader("If-None-Match", pe.etag[a])),
                (p.data && p.hasContent && !1 !== p.contentType || n.contentType) && C.setRequestHeader("Content-Type", p.contentType),
                C.setRequestHeader("Accept", p.dataTypes[0] && p.accepts[p.dataTypes[0]] ? p.accepts[p.dataTypes[0]] + ("*" !== p.dataTypes[0] ? ", " + Kt + "; q=0.01" : "") : p.accepts["*"]);
                for (r in p.headers)
                    C.setRequestHeader(r, p.headers[r]);
                if (p.beforeSend && (!1 === p.beforeSend.call(f, C, p) || 2 === w))
                    return C.abort();
                x = "abort";
                for (r in {
                    success: 1,
                    error: 1,
                    complete: 1
                })
                    C[r](p[r]);
                if (c = V(Jt, p, n, C)) {
                    if (C.readyState = 1,
                    u && h.trigger("ajaxSend", [C, p]),
                    2 === w)
                        return C;
                    p.async && p.timeout > 0 && (l = e.setTimeout(function() {
                        C.abort("timeout")
                    }, p.timeout));
                    try {
                        w = 1,
                        c.send(y, i)
                    } catch (e) {
                        if (!(w < 2))
                            throw e;
                        i(-1, e)
                    }
                } else
                    i(-1, "No Transport");
                return C
            },
            getJSON: function(e, t, n) {
                return pe.get(e, t, n, "json")
            },
            getScript: function(e, t) {
                return pe.get(e, void 0, t, "script")
            }
        }),
        pe.each(["get", "post"], function(e, t) {
            pe[t] = function(e, n, i, o) {
                return pe.isFunction(n) && (o = o || i,
                i = n,
                n = void 0),
                pe.ajax(pe.extend({
                    url: e,
                    type: t,
                    dataType: o,
                    data: n,
                    success: i
                }, pe.isPlainObject(e) && e))
            }
        }),
        pe._evalUrl = function(e) {
            return pe.ajax({
                url: e,
                type: "GET",
                dataType: "script",
                cache: !0,
                async: !1,
                global: !1,
                throws: !0
            })
        }
        ,
        pe.fn.extend({
            wrapAll: function(e) {
                if (pe.isFunction(e))
                    return this.each(function(t) {
                        pe(this).wrapAll(e.call(this, t))
                    });
                if (this[0]) {
                    var t = pe(e, this[0].ownerDocument).eq(0).clone(!0);
                    this[0].parentNode && t.insertBefore(this[0]),
                    t.map(function() {
                        for (var e = this; e.firstChild && 1 === e.firstChild.nodeType; )
                            e = e.firstChild;
                        return e
                    }).append(this)
                }
                return this
            },
            wrapInner: function(e) {
                return pe.isFunction(e) ? this.each(function(t) {
                    pe(this).wrapInner(e.call(this, t))
                }) : this.each(function() {
                    var t = pe(this)
                      , n = t.contents();
                    n.length ? n.wrapAll(e) : t.append(e)
                })
            },
            wrap: function(e) {
                var t = pe.isFunction(e);
                return this.each(function(n) {
                    pe(this).wrapAll(t ? e.call(this, n) : e)
                })
            },
            unwrap: function() {
                return this.parent().each(function() {
                    pe.nodeName(this, "body") || pe(this).replaceWith(this.childNodes)
                }).end()
            }
        }),
        pe.expr.filters.hidden = function(e) {
            return de.reliableHiddenOffsets() ? e.offsetWidth <= 0 && e.offsetHeight <= 0 && !e.getClientRects().length : K(e)
        }
        ,
        pe.expr.filters.visible = function(e) {
            return !pe.expr.filters.hidden(e)
        }
        ;
        var en = /%20/g
          , tn = /\[\]$/
          , nn = /\r?\n/g
          , on = /^(?:submit|button|image|reset|file)$/i
          , rn = /^(?:input|select|textarea|keygen)/i;
        pe.param = function(e, t) {
            var n, i = [], o = function(e, t) {
                t = pe.isFunction(t) ? t() : null == t ? "" : t,
                i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(t)
            };
            if (void 0 === t && (t = pe.ajaxSettings && pe.ajaxSettings.traditional),
            pe.isArray(e) || e.jquery && !pe.isPlainObject(e))
                pe.each(e, function() {
                    o(this.name, this.value)
                });
            else
                for (n in e)
                    Q(n, e[n], t, o);
            return i.join("&").replace(en, "+")
        }
        ,
        pe.fn.extend({
            serialize: function() {
                return pe.param(this.serializeArray())
            },
            serializeArray: function() {
                return this.map(function() {
                    var e = pe.prop(this, "elements");
                    return e ? pe.makeArray(e) : this
                }).filter(function() {
                    var e = this.type;
                    return this.name && !pe(this).is(":disabled") && rn.test(this.nodeName) && !on.test(e) && (this.checked || !Pe.test(e))
                }).map(function(e, t) {
                    var n = pe(this).val();
                    return null == n ? null : pe.isArray(n) ? pe.map(n, function(e) {
                        return {
                            name: t.name,
                            value: e.replace(nn, "\r\n")
                        }
                    }) : {
                        name: t.name,
                        value: n.replace(nn, "\r\n")
                    }
                }).get()
            }
        }),
        pe.ajaxSettings.xhr = void 0 !== e.ActiveXObject ? function() {
            return this.isLocal ? ee() : ie.documentMode > 8 ? Z() : /^(get|post|head|put|delete|options)$/i.test(this.type) && Z() || ee()
        }
        : Z;
        var an = 0
          , sn = {}
          , ln = pe.ajaxSettings.xhr();
        e.attachEvent && e.attachEvent("onunload", function() {
            for (var e in sn)
                sn[e](void 0, !0)
        }),
        de.cors = !!ln && "withCredentials"in ln,
        ln = de.ajax = !!ln,
        ln && pe.ajaxTransport(function(t) {
            if (!t.crossDomain || de.cors) {
                var n;
                return {
                    send: function(i, o) {
                        var r, a = t.xhr(), s = ++an;
                        if (a.open(t.type, t.url, t.async, t.username, t.password),
                        t.xhrFields)
                            for (r in t.xhrFields)
                                a[r] = t.xhrFields[r];
                        t.mimeType && a.overrideMimeType && a.overrideMimeType(t.mimeType),
                        t.crossDomain || i["X-Requested-With"] || (i["X-Requested-With"] = "XMLHttpRequest");
                        for (r in i)
                            void 0 !== i[r] && a.setRequestHeader(r, i[r] + "");
                        a.send(t.hasContent && t.data || null),
                        n = function(e, i) {
                            var r, l, u;
                            if (n && (i || 4 === a.readyState))
                                if (delete sn[s],
                                n = void 0,
                                a.onreadystatechange = pe.noop,
                                i)
                                    4 !== a.readyState && a.abort();
                                else {
                                    u = {},
                                    r = a.status,
                                    "string" == typeof a.responseText && (u.text = a.responseText);
                                    try {
                                        l = a.statusText
                                    } catch (e) {
                                        l = ""
                                    }
                                    r || !t.isLocal || t.crossDomain ? 1223 === r && (r = 204) : r = u.text ? 200 : 404
                                }
                            u && o(r, l, u, a.getAllResponseHeaders())
                        }
                        ,
                        t.async ? 4 === a.readyState ? e.setTimeout(n) : a.onreadystatechange = sn[s] = n : n()
                    },
                    abort: function() {
                        n && n(void 0, !0)
                    }
                }
            }
        }),
        pe.ajaxSetup({
            accepts: {
                script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
            },
            contents: {
                script: /\b(?:java|ecma)script\b/
            },
            converters: {
                "text script": function(e) {
                    return pe.globalEval(e),
                    e
                }
            }
        }),
        pe.ajaxPrefilter("script", function(e) {
            void 0 === e.cache && (e.cache = !1),
            e.crossDomain && (e.type = "GET",
            e.global = !1)
        }),
        pe.ajaxTransport("script", function(e) {
            if (e.crossDomain) {
                var t, n = ie.head || pe("head")[0] || ie.documentElement;
                return {
                    send: function(i, o) {
                        t = ie.createElement("script"),
                        t.async = !0,
                        e.scriptCharset && (t.charset = e.scriptCharset),
                        t.src = e.url,
                        t.onload = t.onreadystatechange = function(e, n) {
                            (n || !t.readyState || /loaded|complete/.test(t.readyState)) && (t.onload = t.onreadystatechange = null,
                            t.parentNode && t.parentNode.removeChild(t),
                            t = null,
                            n || o(200, "success"))
                        }
                        ,
                        n.insertBefore(t, n.firstChild)
                    },
                    abort: function() {
                        t && t.onload(void 0, !0)
                    }
                }
            }
        });
        var un = []
          , cn = /(=)\?(?=&|$)|\?\?/;
        pe.ajaxSetup({
            jsonp: "callback",
            jsonpCallback: function() {
                var e = un.pop() || pe.expando + "_" + Ot++;
                return this[e] = !0,
                e
            }
        }),
        pe.ajaxPrefilter("json jsonp", function(t, n, i) {
            var o, r, a, s = !1 !== t.jsonp && (cn.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && cn.test(t.data) && "data");
            if (s || "jsonp" === t.dataTypes[0])
                return o = t.jsonpCallback = pe.isFunction(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback,
                s ? t[s] = t[s].replace(cn, "$1" + o) : !1 !== t.jsonp && (t.url += (Rt.test(t.url) ? "&" : "?") + t.jsonp + "=" + o),
                t.converters["script json"] = function() {
                    return a || pe.error(o + " was not called"),
                    a[0]
                }
                ,
                t.dataTypes[0] = "json",
                r = e[o],
                e[o] = function() {
                    a = arguments
                }
                ,
                i.always(function() {
                    void 0 === r ? pe(e).removeProp(o) : e[o] = r,
                    t[o] && (t.jsonpCallback = n.jsonpCallback,
                    un.push(o)),
                    a && pe.isFunction(r) && r(a[0]),
                    a = r = void 0
                }),
                "script"
        }),
        pe.parseHTML = function(e, t, n) {
            if (!e || "string" != typeof e)
                return null;
            "boolean" == typeof t && (n = t,
            t = !1),
            t = t || ie;
            var i = xe.exec(e)
              , o = !n && [];
            return i ? [t.createElement(i[1])] : (i = v([e], t, o),
            o && o.length && pe(o).remove(),
            pe.merge([], i.childNodes))
        }
        ;
        var dn = pe.fn.load;
        return pe.fn.load = function(e, t, n) {
            if ("string" != typeof e && dn)
                return dn.apply(this, arguments);
            var i, o, r, a = this, s = e.indexOf(" ");
            return s > -1 && (i = pe.trim(e.slice(s, e.length)),
            e = e.slice(0, s)),
            pe.isFunction(t) ? (n = t,
            t = void 0) : t && "object" == typeof t && (o = "POST"),
            a.length > 0 && pe.ajax({
                url: e,
                type: o || "GET",
                dataType: "html",
                data: t
            }).done(function(e) {
                r = arguments,
                a.html(i ? pe("<div>").append(pe.parseHTML(e)).find(i) : e)
            }).always(n && function(e, t) {
                a.each(function() {
                    n.apply(this, r || [e.responseText, t, e])
                })
            }
            ),
            this
        }
        ,
        pe.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) {
            pe.fn[t] = function(e) {
                return this.on(t, e)
            }
        }),
        pe.expr.filters.animated = function(e) {
            return pe.grep(pe.timers, function(t) {
                return e === t.elem
            }).length
        }
        ,
        pe.offset = {
            setOffset: function(e, t, n) {
                var i, o, r, a, s, l, u, c = pe.css(e, "position"), d = pe(e), p = {};
                "static" === c && (e.style.position = "relative"),
                s = d.offset(),
                r = pe.css(e, "top"),
                l = pe.css(e, "left"),
                u = ("absolute" === c || "fixed" === c) && pe.inArray("auto", [r, l]) > -1,
                u ? (i = d.position(),
                a = i.top,
                o = i.left) : (a = parseFloat(r) || 0,
                o = parseFloat(l) || 0),
                pe.isFunction(t) && (t = t.call(e, n, pe.extend({}, s))),
                null != t.top && (p.top = t.top - s.top + a),
                null != t.left && (p.left = t.left - s.left + o),
                "using"in t ? t.using.call(e, p) : d.css(p)
            }
        },
        pe.fn.extend({
            offset: function(e) {
                if (arguments.length)
                    return void 0 === e ? this : this.each(function(t) {
                        pe.offset.setOffset(this, e, t)
                    });
                var t, n, i = {
                    top: 0,
                    left: 0
                }, o = this[0], r = o && o.ownerDocument;
                if (r)
                    return t = r.documentElement,
                    pe.contains(t, o) ? (void 0 !== o.getBoundingClientRect && (i = o.getBoundingClientRect()),
                    n = te(r),
                    {
                        top: i.top + (n.pageYOffset || t.scrollTop) - (t.clientTop || 0),
                        left: i.left + (n.pageXOffset || t.scrollLeft) - (t.clientLeft || 0)
                    }) : i
            },
            position: function() {
                if (this[0]) {
                    var e, t, n = {
                        top: 0,
                        left: 0
                    }, i = this[0];
                    return "fixed" === pe.css(i, "position") ? t = i.getBoundingClientRect() : (e = this.offsetParent(),
                    t = this.offset(),
                    pe.nodeName(e[0], "html") || (n = e.offset()),
                    n.top += pe.css(e[0], "borderTopWidth", !0),
                    n.left += pe.css(e[0], "borderLeftWidth", !0)),
                    {
                        top: t.top - n.top - pe.css(i, "marginTop", !0),
                        left: t.left - n.left - pe.css(i, "marginLeft", !0)
                    }
                }
            },
            offsetParent: function() {
                return this.map(function() {
                    for (var e = this.offsetParent; e && !pe.nodeName(e, "html") && "static" === pe.css(e, "position"); )
                        e = e.offsetParent;
                    return e || dt
                })
            }
        }),
        pe.each({
            scrollLeft: "pageXOffset",
            scrollTop: "pageYOffset"
        }, function(e, t) {
            var n = /Y/.test(t);
            pe.fn[e] = function(i) {
                return Fe(this, function(e, i, o) {
                    var r = te(e);
                    if (void 0 === o)
                        return r ? t in r ? r[t] : r.document.documentElement[i] : e[i];
                    r ? r.scrollTo(n ? pe(r).scrollLeft() : o, n ? o : pe(r).scrollTop()) : e[i] = o
                }, e, i, arguments.length, null)
            }
        }),
        pe.each(["top", "left"], function(e, t) {
            pe.cssHooks[t] = A(de.pixelPosition, function(e, n) {
                if (n)
                    return n = ft(e, t),
                    ut.test(n) ? pe(e).position()[t] + "px" : n
            })
        }),
        pe.each({
            Height: "height",
            Width: "width"
        }, function(e, t) {
            pe.each({
                padding: "inner" + e,
                content: t,
                "": "outer" + e
            }, function(n, i) {
                pe.fn[i] = function(i, o) {
                    var r = arguments.length && (n || "boolean" != typeof i)
                      , a = n || (!0 === i || !0 === o ? "margin" : "border");
                    return Fe(this, function(t, n, i) {
                        var o;
                        return pe.isWindow(t) ? t.document.documentElement["client" + e] : 9 === t.nodeType ? (o = t.documentElement,
                        Math.max(t.body["scroll" + e], o["scroll" + e], t.body["offset" + e], o["offset" + e], o["client" + e])) : void 0 === i ? pe.css(t, n, a) : pe.style(t, n, i, a)
                    }, t, r ? i : void 0, r, null)
                }
            })
        }),
        pe.fn.extend({
            bind: function(e, t, n) {
                return this.on(e, null, t, n)
            },
            unbind: function(e, t) {
                return this.off(e, null, t)
            },
            delegate: function(e, t, n, i) {
                return this.on(t, e, n, i)
            },
            undelegate: function(e, t, n) {
                return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
            }
        }),
        pe.fn.size = function() {
            return this.length
        }
        ,
        pe.fn.andSelf = pe.fn.addBack,
        "function" == typeof define && define.amd && define("jquery", [], function() {
            return pe
        }),
        pe
    }),
    define("jquery.range", ["jquery"], function(e) {
        "use strict";
        var t = function() {
            return this.init.apply(this, arguments)
        };
        t.prototype = {
            defaults: {
                onstatechange: function() {},
                ondragend: function() {},
                onbarclicked: function() {},
                isRange: !1,
                showLabels: !0,
                showScale: !0,
                step: 1,
                format: "%s",
                theme: "theme-green",
                width: 300,
                disable: !1,
                snap: !1,
                rtl: !1
            },
            template: '<div class="slider-container">\t\t\t<div class="back-bar">                <div class="selected-bar"></div>                <div class="pointer low"></div><div class="pointer-label low">123456</div>                <div class="pointer high"></div><div class="pointer-label high">456789</div>                <div class="clickable-dummy"></div>            </div>            <div class="scale"></div>\t\t</div>',
            init: function(t, n) {
                this.options = e.extend({}, this.defaults, n),
                this.inputNode = e(t),
                this.options.value = this.inputNode.val() || (this.options.isRange ? this.options.from + "," + this.options.from : "" + this.options.from),
                this.domNode = e(this.template),
                this.domNode.addClass(this.options.theme),
                this.inputNode.after(this.domNode),
                this.domNode.on("change", this.onChange),
                this.pointers = e(".pointer", this.domNode),
                this.lowPointer = this.pointers.first(),
                this.highPointer = this.pointers.last(),
                this.labels = e(".pointer-label", this.domNode),
                this.lowLabel = this.labels.first(),
                this.highLabel = this.labels.last(),
                this.scale = e(".scale", this.domNode),
                this.bar = e(".selected-bar", this.domNode),
                this.clickableBar = this.domNode.find(".clickable-dummy"),
                this.interval = this.options.to - this.options.from,
                this.rtl = this.options.rtl,
                this.render()
            },
            render: function() {
                if (0 === this.inputNode.width() && !this.options.width)
                    return void console.log("jRange : no width found, returning");
                this.options.width || (this.options.width = this.inputNode.width()),
                this.domNode.width(this.options.width),
                this.inputNode.hide(),
                this.isSingle() && (this.lowPointer.hide(),
                this.lowLabel.hide()),
                this.options.showLabels || this.labels.hide(),
                this.attachEvents(),
                this.options.showScale && this.renderScale(),
                this.setValue(this.options.value)
            },
            isSingle: function() {
                return "number" == typeof this.options.value || -1 === this.options.value.indexOf(",") && !this.options.isRange
            },
            attachEvents: function() {
                this.clickableBar.click(e.proxy(this.barClicked, this)),
                this.pointers.on("mousedown touchstart", e.proxy(this.onDragStart, this)),
                this.pointers.bind("dragstart", function(e) {
                    e.preventDefault()
                })
            },
            onDragStart: function(t) {
                if (!(this.options.disable || "mousedown" === t.type && 1 !== t.which)) {
                    t.stopPropagation(),
                    t.preventDefault();
                    var n = e(t.target);
                    this.pointers.removeClass("last-active"),
                    n.addClass("focused last-active"),
                    this[(n.hasClass("low") ? "low" : "high") + "Label"].addClass("focused"),
                    e(document).on("mousemove.slider touchmove.slider", e.proxy(this.onDrag, this, n)),
                    e(document).on("mouseup.slider touchend.slider touchcancel.slider", e.proxy(this.onDragEnd, this))
                }
            },
            onDrag: function(e, t) {
                t.stopPropagation(),
                t.preventDefault(),
                t.originalEvent.touches && t.originalEvent.touches.length ? t = t.originalEvent.touches[0] : t.originalEvent.changedTouches && t.originalEvent.changedTouches.length && (t = t.originalEvent.changedTouches[0]);
                var n = t.clientX - this.domNode.offset().left;
                this.domNode.trigger("change", [this, e, n])
            },
            onDragEnd: function(t) {
                this.pointers.removeClass("focused").trigger("rangeslideend"),
                this.labels.removeClass("focused"),
                e(document).off(".slider"),
                this.options.ondragend.call(this, this.options.value)
            },
            barClicked: function(e) {
                if (!this.options.disable) {
                    var t = e.pageX - this.clickableBar.offset().left;
                    if (this.isSingle())
                        this.setPosition(this.pointers.last(), this.options.rtl ? this.domNode.width() - t : t, !0, !0);
                    else {
                        var n, i = Math.abs(parseFloat(this.pointers.first().css("left"), 10)), o = this.pointers.first().width() / 2, r = Math.abs(parseFloat(this.pointers.last().css("left"), 10)), a = this.pointers.first().width() / 2, s = Math.abs(i - t + o), l = Math.abs(r - t + a);
                        n = s == l ? t < i ? this.pointers.first() : this.pointers.last() : s < l ? this.pointers.first() : this.pointers.last(),
                        this.setPosition(n, this.options.rtl ? max - value : value, !0, !0)
                    }
                    this.options.onbarclicked.call(this, this.options.value)
                }
            },
            onChange: function(e, t, n, i) {
                var o, r;
                o = 0,
                r = t.domNode.width(),
                t.isSingle() || (o = n.hasClass("high") ? parseFloat(t.lowPointer.css("left")) + t.lowPointer.width() / 2 : 0,
                r = n.hasClass("low") ? parseFloat(t.highPointer.css("left")) + t.highPointer.width() / 2 : t.domNode.width());
                var a = Math.min(Math.max(i, o), r);
                t.setPosition(n, t.options.rtl ? r - a : a, !0)
            },
            setPosition: function(e, t, n, i) {
                var o, r = parseFloat(this.lowPointer.css("left")), a = parseFloat(this.highPointer.css("left")) || 0, s = this.highPointer.width() / 2;
                if (n || (t = this.prcToPx(t)),
                this.options.snap) {
                    var l = this.correctPositionForSnap(t);
                    if (-1 === l)
                        return;
                    t = l
                }
                e[0] === this.highPointer[0] ? a = Math.round(t - s) : r = Math.round(t - s),
                e[i ? "animate" : "css"]({
                    left: Math.round(t - s)
                }),
                this.isSingle() ? o = 0 : o = r + s;
                var u = Math.round(a + s - o);
                this.bar[i ? "animate" : "css"]({
                    width: Math.abs(u),
                    left: u > 0 ? o : o + u
                }),
                this.showPointerValue(e, t, i),
                this.isReadonly()
            },
            correctPositionForSnap: function(e) {
                var t = this.positionToValue(e) - this.options.from
                  , n = this.options.width / (this.interval / this.options.step)
                  , i = t / this.options.step * n;
                return e <= i + n / 2 && e >= i - n / 2 ? i : -1
            },
            setValue: function(e) {
                var t = e.toString().split(",");
                t[0] = Math.min(Math.max(t[0], this.options.from), this.options.to) + "",
                t.length > 1 && (t[1] = Math.min(Math.max(t[1], this.options.from), this.options.to) + ""),
                this.options.value = e;
                var n = this.valuesToPrc(2 === t.length ? t : [0, t[0]]);
                this.isSingle() ? this.setPosition(this.highPointer, n[1]) : (this.setPosition(this.lowPointer, n[0]),
                this.setPosition(this.highPointer, n[1]))
            },
            renderScale: function() {
                for (var t = this.options.scale || [this.options.from, this.options.to], n = Math.round(100 / (t.length - 1) * 10) / 10, i = "", o = 0; o < t.length; o++)
                    i += '<span style="left: ' + o * n + '%">' + ("|" != t[o] ? "<ins>" + t[o] + "</ins>" : "") + "</span>";
                this.scale.html(i),
                e("ins", this.scale).each(function() {
                    e(this).css({
                        marginLeft: -e(this).outerWidth() / 2
                    })
                })
            },
            getBarWidth: function() {
                var e = this.options.value.split(",");
                return e.length > 1 ? parseFloat(e[1]) - parseFloat(e[0]) : parseFloat(e[0])
            },
            showPointerValue: function(t, n, i) {
                var o, r = e(".pointer-label", this.domNode)[t.hasClass("low") ? "first" : "last"](), a = this.positionToValue(n);
                if (e.isFunction(this.options.format)) {
                    var s = this.isSingle() ? void 0 : t.hasClass("low") ? "low" : "high";
                    o = this.options.format(a, s)
                } else
                    o = this.options.format.replace("%s", a);
                var l = r.html(o).width()
                  , u = n - l / 2;
                u = Math.min(Math.max(u, 0), this.options.width - l),
                r[i ? "animate" : "css"]({
                    left: u
                }),
                this.setInputValue(t, a)
            },
            valuesToPrc: function(e) {
                return [100 * (parseFloat(e[0]) - parseFloat(this.options.from)) / this.interval, 100 * (parseFloat(e[1]) - parseFloat(this.options.from)) / this.interval]
            },
            prcToPx: function(e) {
                return this.domNode.width() * e / 100
            },
            isDecimal: function() {
                return -1 !== (this.options.value + this.options.from + this.options.to).indexOf(".")
            },
            positionToValue: function(e) {
                var t = e / this.domNode.width() * this.interval;
                if (t = parseFloat(t, 10) + parseFloat(this.options.from, 10),
                this.isDecimal()) {
                    var n = Math.round(Math.round(t / this.options.step) * this.options.step * 100) / 100;
                    if (0 !== n)
                        for (n = "" + n,
                        -1 === n.indexOf(".") && (n += "."); n.length - n.indexOf(".") < 3; )
                            n += "0";
                    else
                        n = "0.00";
                    return n
                }
                return Math.round(t / this.options.step) * this.options.step
            },
            setInputValue: function(e, t) {
                if (this.isSingle())
                    this.options.value = t.toString();
                else {
                    var n = this.options.value.split(",");
                    e.hasClass("low") ? this.options.value = t + "," + n[1] : this.options.value = n[0] + "," + t
                }
                this.inputNode.val() !== this.options.value && (this.inputNode.val(this.options.value).trigger("change"),
                this.options.onstatechange.call(this, this.options.value))
            },
            getValue: function() {
                return this.options.value
            },
            getOptions: function() {
                return this.options
            },
            getRange: function() {
                return this.options.from + "," + this.options.to
            },
            isReadonly: function() {
                this.domNode.toggleClass("slider-readonly", this.options.disable)
            },
            disable: function() {
                this.options.disable = !0,
                this.isReadonly()
            },
            enable: function() {
                this.options.disable = !1,
                this.isReadonly()
            },
            toggleDisable: function() {
                this.options.disable = !this.options.disable,
                this.isReadonly()
            },
            updateRange: function(e, t) {
                var n = e.toString().split(",");
                this.interval = parseInt(n[1]) - parseInt(n[0]),
                t ? this.setValue(t) : this.setValue(this.getValue())
            },
            updateWidth: function() {
                var e = this.inputNode.width();
                e && this.options.width != e && (this.options.width = e,
                this.domNode.width(e),
                this.setValue(this.getValue()))
            }
        };
        e.fn.jRange = function(n) {
            var i, o = arguments;
            return this.each(function() {
                var r = e(this)
                  , a = e.data(this, "plugin_jRange")
                  , s = "object" == typeof n && n;
                a || r.data("plugin_jRange", a = new t(this,s)),
                "string" == typeof n && (i = a[n].apply(a, Array.prototype.slice.call(o, 1)))
            }),
            i || this
        }
    }),
    function() {
        "use strict";
        function e(t, i) {
            var o;
            if (i = i || {},
            this.trackingClick = !1,
            this.trackingClickStart = 0,
            this.targetElement = null,
            this.touchStartX = 0,
            this.touchStartY = 0,
            this.lastTouchIdentifier = 0,
            this.touchBoundary = i.touchBoundary || 10,
            this.layer = t,
            this.tapDelay = i.tapDelay || 200,
            this.tapTimeout = i.tapTimeout || 700,
            !e.notNeeded(t)) {
                for (var r = ["onMouse", "onClick", "onTouchStart", "onTouchMove", "onTouchEnd", "onTouchCancel"], a = this, s = 0, l = r.length; s < l; s++)
                    a[r[s]] = function(e, t) {
                        return function() {
                            return e.apply(t, arguments)
                        }
                    }(a[r[s]], a);
                n && (t.addEventListener("mouseover", this.onMouse, !0),
                t.addEventListener("mousedown", this.onMouse, !0),
                t.addEventListener("mouseup", this.onMouse, !0)),
                t.addEventListener("click", this.onClick, !0),
                t.addEventListener("touchstart", this.onTouchStart, !1),
                t.addEventListener("touchmove", this.onTouchMove, !1),
                t.addEventListener("touchend", this.onTouchEnd, !1),
                t.addEventListener("touchcancel", this.onTouchCancel, !1),
                Event.prototype.stopImmediatePropagation || (t.removeEventListener = function(e, n, i) {
                    var o = Node.prototype.removeEventListener;
                    "click" === e ? o.call(t, e, n.hijacked || n, i) : o.call(t, e, n, i)
                }
                ,
                t.addEventListener = function(e, n, i) {
                    var o = Node.prototype.addEventListener;
                    "click" === e ? o.call(t, e, n.hijacked || (n.hijacked = function(e) {
                        e.propagationStopped || n(e)
                    }
                    ), i) : o.call(t, e, n, i)
                }
                ),
                "function" == typeof t.onclick && (o = t.onclick,
                t.addEventListener("click", function(e) {
                    o(e)
                }, !1),
                t.onclick = null)
            }
        }
        var t = navigator.userAgent.indexOf("Windows Phone") >= 0
          , n = navigator.userAgent.indexOf("Android") > 0 && !t
          , i = /iP(ad|hone|od)/.test(navigator.userAgent) && !t
          , o = i && /OS 4_\d(_\d)?/.test(navigator.userAgent)
          , r = i && /OS [6-7]_\d/.test(navigator.userAgent)
          , a = navigator.userAgent.indexOf("BB10") > 0;
        e.prototype.needsClick = function(e) {
            switch (e.nodeName.toLowerCase()) {
            case "button":
            case "select":
            case "textarea":
                if (e.disabled)
                    return !0;
                break;
            case "input":
                if (i && "file" === e.type || e.disabled)
                    return !0;
                break;
            case "label":
            case "iframe":
            case "video":
                return !0
            }
            return /\bneedsclick\b/.test(e.className)
        }
        ,
        e.prototype.needsFocus = function(e) {
            switch (e.nodeName.toLowerCase()) {
            case "textarea":
                return !0;
            case "select":
                return !n;
            case "input":
                switch (e.type) {
                case "button":
                case "checkbox":
                case "file":
                case "image":
                case "radio":
                case "submit":
                    return !1
                }
                return !e.disabled && !e.readOnly;
            default:
                return /\bneedsfocus\b/.test(e.className)
            }
        }
        ,
        e.prototype.sendClick = function(e, t) {
            var n, i;
            document.activeElement && document.activeElement !== e && document.activeElement.blur(),
            i = t.changedTouches[0],
            n = document.createEvent("MouseEvents"),
            n.initMouseEvent(this.determineEventType(e), !0, !0, window, 1, i.screenX, i.screenY, i.clientX, i.clientY, !1, !1, !1, !1, 0, null),
            n.forwardedTouchEvent = !0,
            e.dispatchEvent(n)
        }
        ,
        e.prototype.determineEventType = function(e) {
            return n && "select" === e.tagName.toLowerCase() ? "mousedown" : "click"
        }
        ,
        e.prototype.focus = function(e) {
            var t;
            i && e.setSelectionRange && 0 !== e.type.indexOf("date") && "time" !== e.type && "month" !== e.type ? (t = e.value.length,
            e.setSelectionRange(t, t)) : window.rtl || e.focus()
        }
        ,
        e.prototype.updateScrollParent = function(e) {
            var t, n;
            if (!(t = e.fastClickScrollParent) || !t.contains(e)) {
                n = e;
                do {
                    if (n.scrollHeight > n.offsetHeight) {
                        t = n,
                        e.fastClickScrollParent = n;
                        break
                    }
                    n = n.parentElement
                } while (n)
            }
            t && (t.fastClickLastScrollTop = t.scrollTop)
        }
        ,
        e.prototype.getTargetElementFromEventTarget = function(e) {
            return e.nodeType === Node.TEXT_NODE ? e.parentNode : e
        }
        ,
        e.prototype.onTouchStart = function(e) {
            var t, n, r;
            if (e.targetTouches.length > 1)
                return !0;
            if (t = this.getTargetElementFromEventTarget(e.target),
            n = e.targetTouches[0],
            i) {
                if (r = window.getSelection(),
                r.rangeCount && !r.isCollapsed)
                    return !0;
                if (!o) {
                    if (n.identifier && n.identifier === this.lastTouchIdentifier)
                        return e.preventDefault(),
                        !1;
                    this.lastTouchIdentifier = n.identifier,
                    this.updateScrollParent(t)
                }
            }
            return this.trackingClick = !0,
            this.trackingClickStart = e.timeStamp,
            this.targetElement = t,
            this.touchStartX = n.pageX,
            this.touchStartY = n.pageY,
            e.timeStamp - this.lastClickTime < this.tapDelay && e.preventDefault(),
            !0
        }
        ,
        e.prototype.touchHasMoved = function(e) {
            var t = e.changedTouches[0]
              , n = this.touchBoundary;
            return Math.abs(t.pageX - this.touchStartX) > n || Math.abs(t.pageY - this.touchStartY) > n
        }
        ,
        e.prototype.onTouchMove = function(e) {
            return !this.trackingClick || ((this.targetElement !== this.getTargetElementFromEventTarget(e.target) || this.touchHasMoved(e)) && (this.trackingClick = !1,
            this.targetElement = null),
            !0)
        }
        ,
        e.prototype.findControl = function(e) {
            return void 0 !== e.control ? e.control : e.htmlFor ? document.getElementById(e.htmlFor) : e.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")
        }
        ,
        e.prototype.onTouchEnd = function(e) {
            var t, a, s, l, u, c = this.targetElement;
            if (!this.trackingClick)
                return !0;
            if (e.timeStamp - this.lastClickTime < this.tapDelay)
                return this.cancelNextClick = !0,
                !0;
            if (e.timeStamp - this.trackingClickStart > this.tapTimeout)
                return !0;
            if (this.cancelNextClick = !1,
            this.lastClickTime = e.timeStamp,
            a = this.trackingClickStart,
            this.trackingClick = !1,
            this.trackingClickStart = 0,
            r && (u = e.changedTouches[0],
            c = document.elementFromPoint(u.pageX - window.pageXOffset, u.pageY - window.pageYOffset) || c,
            c.fastClickScrollParent = this.targetElement.fastClickScrollParent),
            "label" === (s = c.tagName.toLowerCase())) {
                if (t = this.findControl(c)) {
                    if (this.focus(c),
                    n)
                        return !1;
                    c = t
                }
            } else if (this.needsFocus(c))
                return e.timeStamp - a > 100 || i && window.top !== window && "input" === s ? (this.targetElement = null,
                !1) : (this.focus(c),
                this.sendClick(c, e),
                i && "select" === s || (this.targetElement = null,
                e.preventDefault()),
                !1);
            return !(!i || o || !(l = c.fastClickScrollParent) || l.fastClickLastScrollTop === l.scrollTop) || (this.needsClick(c) || (e.preventDefault(),
            this.sendClick(c, e)),
            !1)
        }
        ,
        e.prototype.onTouchCancel = function() {
            this.trackingClick = !1,
            this.targetElement = null
        }
        ,
        e.prototype.onMouse = function(e) {
            return !this.targetElement || (!!e.forwardedTouchEvent || (!e.cancelable || (!(!this.needsClick(this.targetElement) || this.cancelNextClick) || (e.stopImmediatePropagation ? e.stopImmediatePropagation() : e.propagationStopped = !0,
            e.stopPropagation(),
            e.preventDefault(),
            !1))))
        }
        ,
        e.prototype.onClick = function(e) {
            var t;
            return this.trackingClick ? (this.targetElement = null,
            this.trackingClick = !1,
            !0) : "submit" === e.target.type && 0 === e.detail || (t = this.onMouse(e),
            t || (this.targetElement = null),
            t)
        }
        ,
        e.prototype.destroy = function() {
            var e = this.layer;
            n && (e.removeEventListener("mouseover", this.onMouse, !0),
            e.removeEventListener("mousedown", this.onMouse, !0),
            e.removeEventListener("mouseup", this.onMouse, !0)),
            e.removeEventListener("click", this.onClick, !0),
            e.removeEventListener("touchstart", this.onTouchStart, !1),
            e.removeEventListener("touchmove", this.onTouchMove, !1),
            e.removeEventListener("touchend", this.onTouchEnd, !1),
            e.removeEventListener("touchcancel", this.onTouchCancel, !1)
        }
        ,
        e.notNeeded = function(e) {
            var t, i, o;
            if (void 0 === window.ontouchstart)
                return !0;
            if (i = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1]) {
                if (!n)
                    return !0;
                if (t = document.querySelector("meta[name=viewport]")) {
                    if (-1 !== t.content.indexOf("user-scalable=no"))
                        return !0;
                    if (i > 31 && document.documentElement.scrollWidth <= window.outerWidth)
                        return !0
                }
            }
            if (a && (o = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/),
            o[1] >= 10 && o[2] >= 3 && (t = document.querySelector("meta[name=viewport]")))) {
                if (-1 !== t.content.indexOf("user-scalable=no"))
                    return !0;
                if (document.documentElement.scrollWidth <= window.outerWidth)
                    return !0
            }
            return "none" === e.style.msTouchAction || "manipulation" === e.style.touchAction || (!!(+(/Firefox\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1] >= 27 && (t = document.querySelector("meta[name=viewport]")) && (-1 !== t.content.indexOf("user-scalable=no") || document.documentElement.scrollWidth <= window.outerWidth)) || ("none" === e.style.touchAction || "manipulation" === e.style.touchAction))
        }
        ,
        e.attach = function(t, n) {
            return new e(t,n)
        }
        ,
        "function" == typeof define && "object" == typeof define.amd && define.amd ? define("fastclick", [], function() {
            return e
        }) : "undefined" != typeof module && module.exports ? (module.exports = e.attach,
        module.exports.FastClick = e) : window.FastClick = e
    }(),
    define("text", ["module"], function(e) {
        "use strict";
        function t(e, t) {
            return void 0 === e || "" === e ? t : e
        }
        function n(e, n, i, o) {
            if (n === o)
                return !0;
            if (e === i) {
                if ("http" === e)
                    return t(n, "80") === t(o, "80");
                if ("https" === e)
                    return t(n, "443") === t(o, "443")
            }
            return !1
        }
        var i, o, r, a, s, l = ["Msxml2.XMLHTTP", "Microsoft.XMLHTTP", "Msxml2.XMLHTTP.4.0"], u = /^\s*<\?xml(\s)+version=[\'\"](\d)*.(\d)*[\'\"](\s)*\?>/im, c = /<body[^>]*>\s*([\s\S]+)\s*<\/body>/im, d = "undefined" != typeof location && location.href, p = d && location.protocol && location.protocol.replace(/\:/, ""), f = d && location.hostname, h = d && (location.port || void 0), g = {}, m = e.config && e.config() || {};
        return i = {
            version: "2.0.15",
            strip: function(e) {
                if (e) {
                    e = e.replace(u, "");
                    var t = e.match(c);
                    t && (e = t[1])
                } else
                    e = "";
                return e
            },
            jsEscape: function(e) {
                return e.replace(/(['\\])/g, "\\$1").replace(/[\f]/g, "\\f").replace(/[\b]/g, "\\b").replace(/[\n]/g, "\\n").replace(/[\t]/g, "\\t").replace(/[\r]/g, "\\r").replace(/[\u2028]/g, "\\u2028").replace(/[\u2029]/g, "\\u2029")
            },
            createXhr: m.createXhr || function() {
                var e, t, n;
                if ("undefined" != typeof XMLHttpRequest)
                    return new XMLHttpRequest;
                if ("undefined" != typeof ActiveXObject)
                    for (t = 0; t < 3; t += 1) {
                        n = l[t];
                        try {
                            e = new ActiveXObject(n)
                        } catch (e) {}
                        if (e) {
                            l = [n];
                            break
                        }
                    }
                return e
            }
            ,
            parseName: function(e) {
                var t, n, i, o = !1, r = e.lastIndexOf("."), a = 0 === e.indexOf("./") || 0 === e.indexOf("../");
                return -1 !== r && (!a || r > 1) ? (t = e.substring(0, r),
                n = e.substring(r + 1)) : t = e,
                i = n || t,
                r = i.indexOf("!"),
                -1 !== r && (o = "strip" === i.substring(r + 1),
                i = i.substring(0, r),
                n ? n = i : t = i),
                {
                    moduleName: t,
                    ext: n,
                    strip: o
                }
            },
            xdRegExp: /^((\w+)\:)?\/\/([^\/\\]+)/,
            useXhr: function(e, t, o, r) {
                var a, s, l, u = i.xdRegExp.exec(e);
                return !u || (a = u[2],
                s = u[3],
                s = s.split(":"),
                l = s[1],
                s = s[0],
                (!a || a === t) && (!s || s.toLowerCase() === o.toLowerCase()) && (!l && !s || n(a, l, t, r)))
            },
            finishLoad: function(e, t, n, o) {
                n = t ? i.strip(n) : n,
                m.isBuild && (g[e] = n),
                o(n)
            },
            load: function(e, t, n, o) {
                if (o && o.isBuild && !o.inlineText)
                    return void n();
                m.isBuild = o && o.isBuild;
                var r = i.parseName(e)
                  , a = r.moduleName + (r.ext ? "." + r.ext : "")
                  , s = t.toUrl(a)
                  , l = m.useXhr || i.useXhr;
                if (0 === s.indexOf("empty:"))
                    return void n();
                !d || l(s, p, f, h) ? i.get(s, function(t) {
                    i.finishLoad(e, r.strip, t, n)
                }, function(e) {
                    n.error && n.error(e)
                }) : t([a], function(e) {
                    i.finishLoad(r.moduleName + "." + r.ext, r.strip, e, n)
                })
            },
            write: function(e, t, n, o) {
                if (g.hasOwnProperty(t)) {
                    var r = i.jsEscape(g[t]);
                    n.asModule(e + "!" + t, "define(function () { return '" + r + "';});\n")
                }
            },
            writeFile: function(e, t, n, o, r) {
                var a = i.parseName(t)
                  , s = a.ext ? "." + a.ext : ""
                  , l = a.moduleName + s
                  , u = n.toUrl(a.moduleName + s) + ".js";
                i.load(l, n, function(t) {
                    var n = function(e) {
                        return o(u, e)
                    };
                    n.asModule = function(e, t) {
                        return o.asModule(e, u, t)
                    }
                    ,
                    i.write(e, l, n, r)
                }, r)
            }
        },
        "node" === m.env || !m.env && "undefined" != typeof process && process.versions && process.versions.node && !process.versions["node-webkit"] && !process.versions["atom-shell"] ? (o = require.nodeRequire("fs"),
        i.get = function(e, t, n) {
            try {
                var i = o.readFileSync(e, "utf8");
                "\ufeff" === i[0] && (i = i.substring(1)),
                t(i)
            } catch (e) {
                n && n(e)
            }
        }
        ) : "xhr" === m.env || !m.env && i.createXhr() ? i.get = function(e, t, n, o) {
            var r, a = i.createXhr();
            if (a.open("GET", e, !0),
            o)
                for (r in o)
                    o.hasOwnProperty(r) && a.setRequestHeader(r.toLowerCase(), o[r]);
            m.onXhr && m.onXhr(a, e),
            a.onreadystatechange = function(i) {
                var o, r;
                4 === a.readyState && (o = a.status || 0,
                o > 399 && o < 600 ? (r = new Error(e + " HTTP status: " + o),
                r.xhr = a,
                n && n(r)) : t(a.responseText),
                m.onXhrComplete && m.onXhrComplete(a, e))
            }
            ,
            a.send(null)
        }
        : "rhino" === m.env || !m.env && "undefined" != typeof Packages && "undefined" != typeof java ? i.get = function(e, t) {
            var n, i, o = new java.io.File(e), r = java.lang.System.getProperty("line.separator"), a = new java.io.BufferedReader(new java.io.InputStreamReader(new java.io.FileInputStream(o),"utf-8")), s = "";
            try {
                for (n = new java.lang.StringBuffer,
                i = a.readLine(),
                i && i.length() && 65279 === i.charAt(0) && (i = i.substring(1)),
                null !== i && n.append(i); null !== (i = a.readLine()); )
                    n.append(r),
                    n.append(i);
                s = String(n.toString())
            } finally {
                a.close()
            }
            t(s)
        }
        : ("xpconnect" === m.env || !m.env && "undefined" != typeof Components && Components.classes && Components.interfaces) && (r = Components.classes,
        a = Components.interfaces,
        Components.utils.import("resource://gre/modules/FileUtils.jsm"),
        s = "@mozilla.org/windows-registry-key;1"in r,
        i.get = function(e, t) {
            var n, i, o, l = {};
            s && (e = e.replace(/\//g, "\\")),
            o = new FileUtils.File(e);
            try {
                n = r["@mozilla.org/network/file-input-stream;1"].createInstance(a.nsIFileInputStream),
                n.init(o, 1, 0, !1),
                i = r["@mozilla.org/intl/converter-input-stream;1"].createInstance(a.nsIConverterInputStream),
                i.init(n, "utf-8", n.available(), a.nsIConverterInputStream.DEFAULT_REPLACEMENT_CHARACTER),
                i.readString(n.available(), l),
                i.close(),
                n.close(),
                t(l.value)
            } catch (e) {
                throw new Error((o && o.path || "") + ": " + e)
            }
        }
        ),
        i
    }),
    define("text!src/template/web.html", [], function() {
        return '<div class="happiness-meter-widget-web-wrapper h-100">\n  <div class="happiness-meter-widget-web-main h-100" data-current-slide="2">\n    <div class="wrapper h-100">\n      <section class="slide" data-slide="2">\n        <div class="slide-number slide-2">\n          <div class="slide__content">\n            <div class="slide-content__header"></div>\n            <div class="slide-content__question"></div>\n            <div class="slide-content__hero-sub"></div>\n            <div class="slide-content__background">\n              <div class="happy__face"></div>\n            </div>\n          </div>\n          <div class="slide__footer">\n            <div class="slide-footer__header">\n              <ul class="happiness__options">\n                <li class="happiness__option noop"></li>\n                <li class="happiness__option cool"></li>\n              </ul>\n            </div>\n            <div class="slide-footer__answer">\n              <div class="happiness-meter">\n                <div class="meter__wrapper">\n                  <div class="happiness-slider"></div>\n                </div>\n              </div>\n            </div>\n            <div class="slide-footer__footer">\n              <span class="percentage">0 %</span>\n            </div>\n            <div class="slide-footer__background"></div>\n          </div>\n        </div>\n      </section>\n      <section class="slide" data-slide="7">\n        <div class="slide-number slide-0">\n          <p class="welcome"></p>\n          <div class="logo"></div>\n          <h1 class="hero"></h1>\n        </div>\n      </section>\n    </div>\n  </div>\n  <aside>\n    <div class="transparent__control" data-transparent-double-tap>\n    </div>\n  </aside>\n</div>\n'
    }),
    define("app", ["jquery", "text!src/template/web.html"], function(e, t) {
        "use strict";
        function n(n) {
            if ("object" != typeof n || !n.container)
                return void i("Impossible to initialise Happiness Meter Widget");
            o = e("#" + n.container),
            r = e(".happiness-meter-widget-web-backdrop"),
            o.length || (e("body").append('<div id="' + n.container + '" class="happiness-meter-widget-web-container"></div>'),
            o = e("#" + n.container)),
            r.length || (r = e('<div class="happiness-meter-widget-web-backdrop"></div>').insertBefore(o)),
            o.hide(),
            r.hide(),
            o.html(t)
        }
        function i(e) {
            window.console && window.console.error ? window.console.error.apply(window.console, arguments) : window.console && window.console.log ? window.console.log.apply(window.console, arguments) : window.alert(e)
        }
        var o = null
          , r = null;
        return {
            init: function(e) {
                n(e)
                console.log('initiated')
            }
        }
    });
    const constants = {
        render_version: 2,
        data: {
            en: {
                2: {
                    header: null,
                    hero: "Please rate your overall experience with the website",
                    "hero-sub": "Hold and swipe to the face that best represents your level of happiness.",
                    options: ["Not at all happy", "Completely happy"],
                    footer: null
                },
                7: {
                    hero: "Thank you for your feedback"
                }
            },
            ar: {
                2: {
                    header: null,
                    hero: "برجاء قيّم تجربتك في استخدام الموقع الالكتروني",
                    "hero-sub": "اضغط واسحب المؤشر إلى الوجه الذي يمثل مستوى سعادتك عن الخدمة",
                    options: ["غير سعيد إطلاقا", "سعيد جدا"],
                    footer: null
                },
                7: {
                    hero: "شكرا لك على ملاحظاتك"
                }
            }
        }
    };
    define("constants", [], function() {
        return constants
    }),
    define("render", ["jquery", "fastclick", "constants"], function(e, t, n) {
        function i(e) {
            window.console && window.console.error ? window.console.error.apply(window.console, arguments) : window.console && window.console.log ? window.console.log.apply(window.console, arguments) : window.alert(e)
        }
        function o() {
            var e = window.navigator.userAgent
              , t = e.indexOf("MSIE ");
            if (t > 0)
                return parseInt(e.substring(t + 5, e.indexOf(".", t)), 10);
            if (e.indexOf("Trident/") > 0) {
                var n = e.indexOf("rv:");
                return parseInt(e.substring(n + 3, e.indexOf(".", n)), 10)
            }
            var i = e.indexOf("Edge/");
            return i > 0 ? parseInt(e.substring(i + 5, e.indexOf(".", i)), 10) : "no"
        }
        function r() {
            window.messagesController && P.setItem("happiness_message", messagesController.serialize())
        }
        function a() {
            P.setItem("happiness_times", Z)
        }
        function s() {
            try {
                Y = e(".happiness-meter-widget-web-main .happy__face").width(),
                X = {},
                $ = M.language,
                z = g(X),
                V = h($),
                A = v(X),
                U = m(X),
                _ = x(),
                j = e("html"),
                P.cleanAll(),
                P.setItem("happiness_lang", $),
                P.setItem("happiness_feedback", {
                    "improvement-option-1": !1,
                    "improvement-option-2": !1,
                    "improvement-option-3": !1,
                    "improvement-option-4": !1,
                    "improvement-option-5": !1,
                    "improvement-option-6": !1,
                    "improvement-option-7": !1,
                    "improvement-option-8": !1,
                    "improvement-option-9": !1
                })
            } catch (e) {
                i(e)
            }
        }
        function l(e, t) {
            M.sendDataCallback(O.getSurveyData()),
            K = window.setTimeout(function() {
                try {
                    L(),
                    T(2, $)
                } catch (e) {
                    i(e)
                }
            }, t)
        }
        function u() {
            j.find(".happiness-meter-widget-web-main").attr("lang", $),
            j.find(".happiness-meter-widget-web-main").attr("data-current-slide", z),
            j.find(".happiness-meter-widget-web-main").attr("dir", V),
            S(e(".happiness-meter-widget-web-main .happy__face"), U),
            k(z)
        }
        function c(e) {
            return 2 === e ? "00" : 3 === e ? "01" : 4 === e ? "02" : 5 === e ? "03" : 8 === e ? "04" : 6 === e ? "06" : void 0
        }
        function d() {
            var t = e(".happiness-meter-widget-web-main .hm-arrow");
            t.off(),
            t.on("click touch touchend", function(t) {
                var n = e(this)
                  , i = n.parents(".happiness-meter-widget-web-main .slide")
                  , o = n.data()
                  , r = i.data();
                if ("targetSlide"in o) {
                    t.preventDefault(),
                    t.stopImmediatePropagation();
                    return T(parseInt(o.targetSlide, 10), "targetLanguage"in o ? o.targetLanguage : $, "sourceSlide"in o ? o.sourceSlide : r.slide)
                }
            })
        }
        function p() {
            var t = e(".happiness-meter-widget-web-main").find(".check__option, .slide-content__option label");
            t.off(),
            t.on("click touch", function(t) {
                clearInactiveTimeout(),
                resetCheckboxesTimeout(),
                t.preventDefault(),
                t.stopImmediatePropagation(),
                e(this).siblings("input").length > 0 && (e(this).siblings("input")[0].checked = !e(this).siblings("input")[0].checked);
                var n = {};
                e(this).parents(".slide-content__options").find("input").each(function() {
                    n[e(this).attr("id")] = e(this).is(":checked")
                }),
                P.setItem("happiness_feedback", n)
            })
        }
        function f(e) {
            var t = parseInt(e, 10);
            "number" == typeof J && window.clearTimeout(J),
            P.setItem("happiness_happy", t),
            J = window.setTimeout(function() {
                Z.question00End = y(),
                O.addAnswer({
                    type: "interval",
                    questionId: "00",
                    value: t,
                    language: $,
                    tsStart: Z.question00Start,
                    tsEnd: Z.question00End
                }),
                r(),
                T(7, $, void 0, t)
            }, R)
        }
        function h(e) {
            return e === F.en ? (window.rtl = !1,
            "ltr") : e === F.ar ? (window.rtl = !0,
            "rtl") : "ltr"
        }
        function g(e) {
            return isNaN(parseInt(e.slide, 10)) ? z : e.slide
        }
        function m(e) {
            return isNaN(parseInt(e.happiness, 10)) ? 50 : parseInt(e.happiness, 10)
        }
        function v(e) {
            if (!isNaN(parseInt(e.lastSlide, 10)))
                return e.lastSlide
        }
        function y() {
            return (new Date).getTime()
        }
        function b(e) {
            try {
                Z = P.getItem("happiness_times") || {}
            } catch (e) {
                Z = {}
            }
            0 === e && (Z.surveyStart = y()),
            7 === e && (Z.surveyEnd = y()),
            2 === e && (Z.question00Start = y(),
            O.setTsStart(Z.question00Start)),
            3 === e && (Z.question01Start = y()),
            4 === e && (Z.question02Start = y()),
            5 === e && (Z.question03Start = y()),
            8 === e && (Z.question04Start = y()),
            6 === e && (Z.question06Start = y())
        }
        function w(e) {
            return e <= 40 ? "rgb(249, 201, 70)" : e > 40 && e < 90 ? "rgb(130, 191, 122)" : e >= 90 ? "rgb(33, 193, 157)" : void 0
        }
        function x() {
            return n.data[$]
        }
        function C(t) {
            if (3 === t || 4 === t || 5 == t || 6 == t) {
                var n = [];
                e('.happiness-meter-widget-web-main [data-slide="' + t + '"]').find("input:checked").each(function(t, i) {
                    var o = {
                        id: e(i).attr("id"),
                        value: e(i).val()
                    };
                    n.push(o)
                }),
                O.addAnswer({
                    type: "multioptions",
                    questionId: c(t),
                    value: n,
                    language: $,
                    tsStart: Z["question" + c(t) + "Start"],
                    tsEnd: Z["question" + c(t) + "End"]
                })
            }
        }
        function T(e, t, n, i) {
            g(X);
            window.setTimeout(function() {
                n && (Z["question" + c(n) + "End"] = y(),
                6 === n && O.setTsEnd(Z["question" + c(n) + "End"]),
                C(n),
                r()),
                $ = t,
                z = e,
                A = n,
                U = i,
                t === F.en && (V = "ltr"),
                t === F.ar && (V = "rtl"),
                _ = x(),
                D()
            }, W)
        }
        function k(t) {
            var n = parseInt(t, 10)
              , i = e('.happiness-meter-widget-web-main .slide[data-slide="' + n + '"]');
            if (0 === n && (i.find(".welcome").html(_[n].header),
            i.find(".hero").html(_[n].hero),
            i.find(".languages").find(".en").html(_[n].options[0]),
            i.find(".languages").find(".ar").html(_[n].options[1])),
            1 !== n && 2 !== n && 8 !== n || (i.find(".slide-content__header").html(_[n].header),
            i.find(".slide-content__question").html(_[n].hero),
            1 === n && i.find(".slide-footer__header").html(_[n].footer)),
            2 === n ? (e('.happiness-meter-widget-web-main .slide[data-slide="2"] .slide__content').removeClass("touched"),
            e('.happiness-meter-widget-web-main .slide[data-slide="2"] .slide__footer').removeClass("touched"),
            i.find(".slide-content__hero-sub").html(_[n]["hero-sub"]),
            i.find(".noop").html(_[n].options[0]),
            i.find(".cool").html(_[n].options[1]),
            "en" === $ ? (e(".happiness-meter-widget-web-main .happiness-slider").jRange({
                from: 0,
                to: 100,
                step: 1,
                width: 355,
                showLabels: !1,
                showScale: !1,
                onstatechange: E,
                onbarclicked: f,
                ondragend: f
            }),
            e(".happiness-meter-widget-web-main .happiness-slider").removeClass("rtl"),
            e(".happiness-meter-widget-web-main .happiness-slider").addClass("ltr")) : "ar" === $ && (e(".happiness-meter-widget-web-main .happiness-slider").jRange({
                from: 0,
                to: 100,
                step: 1,
                width: 355,
                showLabels: !1,
                showScale: !1,
                rtl: !0,
                onstatechange: E,
                onbarclicked: f,
                ondragend: f
            }),
            e(".happiness-meter-widget-web-main .happiness-slider").removeClass("ltr"),
            e(".happiness-meter-widget-web-main .happiness-slider").addClass("rtl")),
            e(".happiness-meter-widget-web-main .happiness-slider").jRange("setValue", "50"),
            H = setInterval(function() {
                var t = e(".happiness-meter-widget-web-main .happy__face").height();
                t && t != Y && (Y = t,
                S(e(".happiness-meter-widget-web-main .happy__face"), U)),
                e(".happiness-meter-widget-web-main .happiness-slider").jRange("updateWidth")
            }, 500)) : H && clearInterval(H),
            3 !== n && 4 !== n && 5 !== n && 6 !== n || (i.find(".slide__footer").hide(),
            i.find(".slide-content__header").html(_[n].header),
            i.find(".slide-content__question").html(_[n].hero)),
            3 === n && (i.find('[for="excellent-option-1"]').html(_[n].options[0]),
            i.find('[for="excellent-option-2"]').html(_[n].options[1]),
            i.find('[for="excellent-option-3"]').html(_[n].options[2]),
            i.find("#excellent-option-1").val(_[n].options[0]),
            i.find("#excellent-option-2").val(_[n].options[1]),
            i.find("#excellent-option-3").val(_[n].options[2])),
            4 === n && (i.find('[for="good-option-1"]').html(_[n].options[0]),
            i.find('[for="good-option-2"]').html(_[n].options[1]),
            i.find('[for="good-option-3"]').html(_[n].options[2]),
            i.find('[for="good-option-4"]').html(_[n].options[3]),
            i.find('[for="good-option-5"]').html(_[n].options[4]),
            i.find('[for="good-option-6"]').html(_[n].options[5]),
            i.find("#good-option-1").val(_[n].options[0]),
            i.find("#good-option-2").val(_[n].options[1]),
            i.find("#good-option-3").val(_[n].options[2]),
            i.find("#good-option-4").val(_[n].options[3]),
            i.find("#good-option-5").val(_[n].options[4]),
            i.find("#good-option-6").val(_[n].options[5])),
            5 === n && (i.find('[for="poor-option-1"]').html(_[n].options[0]),
            i.find('[for="poor-option-2"]').html(_[n].options[1]),
            i.find('[for="poor-option-3"]').html(_[n].options[2]),
            i.find('[for="poor-option-4"]').html(_[n].options[3]),
            i.find('[for="poor-option-5"]').html(_[n].options[4]),
            i.find('[for="poor-option-6"]').html(_[n].options[5]),
            i.find("#poor-option-1").val(_[n].options[0]),
            i.find("#poor-option-2").val(_[n].options[1]),
            i.find("#poor-option-3").val(_[n].options[2]),
            i.find("#poor-option-4").val(_[n].options[3]),
            i.find("#poor-option-5").val(_[n].options[4]),
            i.find("#poor-option-6").val(_[n].options[5])),
            8 === n && (i.find(".noop").html(_[n].options[0]),
            i.find(".cool").html(_[n].options[1])),
            7 === n) {
                i.find(".hero").html(_[n].hero);
                var o = P.getItem("happiness_feedback")
                  , r = P.getItem("happiness_happy")
                  , s = P.getItem("happiness_lang")
                  , u = P.getItem("happiness_score")
                  , c = {
                    feedback: o,
                    happy: r,
                    lang: s,
                    score: u,
                    timestamp: (new Date).getTime(),
                    times: Z
                };
                O.setStatus("finished"),
                O.setResult(c),
                l(!0, B)
            }
            6 === n && (i.find('[for="improvement-option-1"]').html(_[n].options[0]),
            i.find('[for="improvement-option-2"]').html(_[n].options[1]),
            i.find('[for="improvement-option-3"]').html(_[n].options[2]),
            i.find('[for="improvement-option-4"]').html(_[n].options[3]),
            i.find('[for="improvement-option-5"]').html(_[n].options[4]),
            i.find('[for="improvement-option-6"]').html(_[n].options[5]),
            i.find('[for="improvement-option-7"]').html(_[n].options[6]),
            i.find('[for="improvement-option-8"]').html(_[n].options[7]),
            i.find('[for="improvement-option-9"]').html(_[n].options[8]),
            i.find('[for="improvement-option-10"]').html(_[n].options[9]),
            i.find("#improvement-option-1").val(_[n].options[0]),
            i.find("#improvement-option-2").val(_[n].options[1]),
            i.find("#improvement-option-3").val(_[n].options[2]),
            i.find("#improvement-option-4").val(_[n].options[3]),
            i.find("#improvement-option-5").val(_[n].options[4]),
            i.find("#improvement-option-6").val(_[n].options[5]),
            i.find("#improvement-option-7").val(_[n].options[6]),
            i.find("#improvement-option-8").val(_[n].options[7]),
            i.find("#improvement-option-9").val(_[n].options[8]),
            i.find("#improvement-option-10").val(_[n].options[9])),
            b(n),
            a()
        }
        function S(e, t) {
            var n = -Math.floor(t / 2) * Y;
            e.each(function() {
                this.style.setProperty("background-position-y", n + "px", "important")
            })
        }
        function E(t) {
            if (G > 3) {
                q && q.length || (q = e('.happiness-meter-widget-web-main .slide[data-slide="2"]')),
                I && I.length || (I = q.find(".slide__content")),
                I.hasClass("touched") || I.addClass("touched"),
                I.css("background-position", "0 " + t + "%"),
                q.find(".pointer.last-active").css("background-position", t + "% 0");
                var n = parseInt(t, 10);
                S(q.find(".happy__face"), n),
                Q = n;
                q.find(".slide__footer").hasClass("touched") || q.find(".slide__footer").addClass("touched"),
                q.find(".percentage").html(t + "%"),
                q.find(".percentage").css("color", w(t))
            } else
                G++
        }
        function N() {
            e.event.special.doubletap = {
                bindType: "touchend",
                delegateType: "touchend",
                handle: function(t) {
                    var n = t.handleObj
                      , i = e.data(t.target)
                      , o = (new Date).getTime()
                      , r = i.lastTouch ? o - i.lastTouch : 0
                      , a = null == a ? 300 : a;
                    t.touches && t.touches.length > 1 || (r < a && r > 30 ? (i.lastTouch = null,
                    t.type = n.origType,
                    ["clientX", "clientY", "pageX", "pageY"].forEach(function(e) {
                        t[e] = t.originalEvent.changedTouches[0][e]
                    }),
                    n.handler.apply(this, arguments)) : i.lastTouch = o)
                }
            }
        }
        function D() {
            j.find(".happiness-meter-widget-web-main").attr("lang", $),
            j.find(".happiness-meter-widget-web-main").attr("data-current-slide", z),
            j.find(".happiness-meter-widget-web-main").attr("dir", V),
            S(e(".happiness-meter-widget-web-main .happy__face"), U),
            k(z)
        }
        function L() {
            var t = e(".happiness-meter-widget-web-main");
            t.find(".happiness__balls").attr("data-ball", null),
            t.find(".slide-content__options").find("input").each(function() {
                e(this).prop("checked", !1)
            }),
            e("#" + M.container).hide().removeClass("shown"),
            e(".happiness-meter-widget-web-backdrop").hide().removeClass("shown"),
            K && clearTimeout(K)
        }
        var j, A, _, q, I, H, M = null, F = {
            en: "en",
            ar: "ar"
        }, P = {
            data: {},
            setItem: function(e, t) {
                this.data[e] = t
            },
            getItem: function(e) {
                return e in this.data ? this.data[e] : null
            },
            cleanAll: function() {
                this.data = {}
            }
        }, O = {
            token: "",
            url: "",
            status: "inactive",
            tsEnd: 0,
            tsStart: 0,
            result: {},
            init: function(e) {
                this.url = e.url,
                this.token = e.token
            },
            answers: [],
            addAnswer: function(e) {
                this.answers.push(e)
            },
            setStatus: function(e) {
                this.status = e
            },
            setTsStart: function(e) {
                this.tsStart = e
            },
            setTsEnd: function(e) {
                this.tsEnd = e
            },
            serialize: function() {
                return JSON.stringify({
                    status: this.status,
                    tsEnd: this.tsEnd,
                    tsStart: this.tsStart,
                    answers: this.answers,
                    result: this.result
                })
            },
            getSurveyData: function() {
                return {
                    render_version: n.render_version,
                    status: this.status,
                    tsEnd: this.tsEnd,
                    tsStart: this.tsStart,
                    answers: this.answers,
                    result: this.result
                }
            },
            setResult: function(e) {
                this.result = e
            }
        }, R = 1e3, W = 250, B = 5e3, X = "", $ = F.en, z = "2", V = "ltr", U = 50, G = 0, Y = 0, J = null, K = null, Q = 50, Z = {
            surveyStart: 0,
            surveyEnd: 0
        };
        return {
            init: function(n) {
                M = n,
                N(),
                t.attach(document.body),
                s(),
                u(),
                d(),
                p();
                var i = o();
                "no" !== i && e("body").addClass("ie ie-" + i)
            },
            getDirectionGivenLang: h,
            exitHMWidget: L,
            goToNext: T
        }
    }),
    require(["jquery", "jquery.range", "fastclick", "app", "render"], function($, jRange, FastClick, app, render) {
        "use strict";
        function consoleLog() {
            window.console && window.console.log && window.console.log.apply(window.console, arguments)
        }
        function checkIfGaIsLoadedGivenNamespace(e) {
            if ("string" != typeof e || e.length < 1)
                return void consoleLog("[hmwidget] checkIfGaIsLoadedGivenNamespace - no namespace: ", e);
            window["_" + e + "Loaded"] = !1,
            window && window[e] && "function" == typeof e && window[e](function(t) {
                window["_" + e + "Loaded"] = !0
            }),
            setTimeout(function() {
                window["_" + e + "Loaded"] ? (resultData.metadata.ga[e] = !0,
                consoleLog("[hmwidget] checkIfGaIsLoadedGivenNamespace - ga is loaded: ", e)) : (resultData.metadata.ga[e] = !1,
                consoleLog("[hmwidget] checkIfGaIsLoadedGivenNamespace - ga not loaded: ", e))
            }, 0)
        }
        function loadWidgetCSS(e) {
            if (!e || !e.length)
                return -1;
            var t = document.createElement("link");
            t.type = "text/css",
            t.rel = "stylesheet",
            t.href = e;
            try {
                return document.getElementsByTagName("head")[0].appendChild(t),
                resultData.metadata.cssLoaded = !0,
                0
            } catch (e) {
                return resultData.metadata.cssLoaded = !1,
                consoleLog("[hmwidget] loadWidgetCSS", e),
                -1
            }
        }
        function onFinish(jqXHR, textStatus) {
            var responseText = jqXHR ? jqXHR.responseText : ""
              , responseJSON = jqXHR ? jqXHR.responseJSON : null;
            if ("function" == typeof config.onFinishCallback)
                try {
                    config.onFinishCallback.call(null, jqXHR, textStatus, responseText, responseJSON)
                } catch (e) {
                    consoleLog("[hmwidget] onFinish cb", e)
                }
            if (config.onFinishCallbackStr && config.onFinishCallbackStr.length)
                try {
                    eval(config.onFinishCallbackStr)
                } catch (e) {
                    consoleLog("[hmwidget] onFinish", e)
                }
        }
        function buildResultData(e) {
	    // Custom script to store happiness score 
	    console.log("Happiness score: " + e.result.happy);
		
            return resultData.metadata.language = config.language,
            resultData.metadata.ui.innerHeight = window.innerHeight,
            resultData.metadata.ui.innerWidth = window.innerWidth,
            resultData.metadata.khadamati.fullSequenceCode = config.fullSequenceCode,
            resultData.metadata.khadamati.entitySequenceID = config.entitySequenceID,
            resultData.metadata.khadamati.mainServiceSequenceID = config.mainServiceSequenceID,
            resultData.metadata.khadamati.subserviceSequenceID = config.subserviceSequenceID,
            resultData.metadata.khadamati.subserviceComplementaryID = config.subserviceComplementaryID,
            resultData.metadata.khadamati.serviceNameEn = config.serviceNameEn,
            resultData.metadata.khadamati.serviceNameAr = config.serviceNameAr,
            resultData.metadata.originUrl = config.originUrl,
            resultData.metadata.customerId = config.customerId,
            resultData.metadata.email = config.email,
            resultData.metadata.phone = config.phone,
            resultData.metadata.transactionId = config.transactionId,
            resultData.metadata.emiratesId = config.emiratesId,
            resultData.data = e,
            resultData.client_timestamp = (new Date).getTime(),
            JSON.stringify(resultData)
        }
        function sendData(e) {
            $.ajax({
                method: "POST",
                url: globalConfig.apiUrl,
                complete: onFinish,
                dataType: "json",
                headers: {
                    "Content-Type": "application/json"
                },
                data: buildResultData(e)
            })
        }
        function parseNumericalConfig(e, t) {
            var n = "string" == typeof e ? parseInt(e, 10) : e;
            return isNaN(n) ? t : n
        }
        function initAnalytics(e) {
            var t = window.GoogleAnalyticsObject = window.GoogleAnalyticsObject || "ga"
              , n = window[t] = window[t] || function() {
                (n.q = n.q || []).push(arguments)
            }
            ;
            n.l = +new Date,
            n("create", hmWidgetAggregatedCode, "auto", "hmWidgetAggregated"),
            n("create", hmWidgetCode, "auto", "hmWidget"),
            e && n("create", e, "auto", "entityAnalytics"),
            gaPageView = function() {
                n("hmWidgetAggregated.send", "pageview"),
                n("hmWidget.send", "pageview"),
                e && n("entityAnalytics.send", "pageview")
            }
            ;
            var i = $("<script>", {
                async: 1,
                src: "https://www.google-analytics.com/analytics.js"
            });
            $("body").append(i)
        }
        function show() {
            var e = $(".happiness-meter-widget-web-backdrop")
              , t = $("#" + globalConfig.container);
            e.show(),
            t.show().addClass("shown"),
            "function" == typeof gaPageView && gaPageView(),
            render.init(config)
        }
        var hmWidgetAggregatedCode = "UA-76978230-15"
          , hmWidgetCode = "UA-76978230-13"
          , gaPageView = null
          , config = {}
          , globalConfig = {}
          , resultData = {
            survey_id: 2,
            metadata: {
                version: "",
                type: "web",
                delay: 0,
                mode: "",
                language: "",
                khadamati: {
                    fullSequenceCode: "",
                    entitySequenceID: null,
                    mainServiceSequenceID: null,
                    subserviceSequenceID: null,
                    subserviceComplementaryID: null,
                    serviceNameEn: null,
                    serviceNameAr: null
                },
                analyticsTag: null,
                originUrl: null,
                customerId: null,
                email: null,
                phone: null,
                transactionId: null,
                emiratesId: null,
                navigator: {
                    userAgent: window.navigator.userAgent,
                    platform: window.navigator.platform,
                    language: window.navigator.language,
                    appVersion: window.navigator.appVersion,
                    vendor: window.navigator.vendor
                },
                host: window.location.host,
                origin: window.location.origin,
                ui: {
                    widgetCssUrl: "",
                    container: "",
                    button: "",
                    innerHeight: window.innerHeight,
                    innerWidth: window.innerWidth
                },
                ga: {},
                jquery: null,
                jqueryVersion: ""
            }
        };
        window.happinessMeterWidgetWeb = function(e, t) {
            config = Object.assign({}, globalConfig, e),
            "arab" === config.language && (config.language = "ar"),
            config.onFinishCallback = "function" == typeof t ? t : null,
            show()
        }
        ,
        $(function() {
            try {
                var e = $("#happiness-meter-widget-web-script")
                  , t = e.data();
                config = globalConfig = {
                    container: t.containerId || "happiness-meter-widget-web-container",
                    button: t.modeClickId || "happiness-meter-widget-web-button",
                    version: t.version || "latest",
                    delay: parseNumericalConfig(t.delay, 0),
                    mode: t.mode || "auto",
                    language: t.language || "en",
                    widgetCssUrl: t.cssUrl || "",
                    sendDataCallback: sendData,
                    onFinishCallback: null,
                    onFinishCallbackStr: t.onFinish || "",
                    apiKey: t.key || "test",
                    apiHost: t.apiHost || "happinessmeter.gov.ae",
                    apiUrl: "https://" + (t.apiHost || "happinessmeter.gov.ae") + "/api/v2/survey_widget/" + ("app" === t.channel ? "app/" : "web/") + (t.key || "test"),
                    fullSequenceCode: t.fullSequenceCode || "",
                    entitySequenceID: t.entitySequenceId,
                    mainServiceSequenceID: t.mainServiceSequenceId,
                    subserviceSequenceID: t.subserviceSequenceId,
                    subserviceComplementaryID: t.subserviceComplementaryId,
                    serviceNameEn: t.serviceNameEn,
                    serviceNameAr: t.serviceNameAr,
                    analyticsTag: t.analyticsTag || null,
                    originUrl: t.originUrl,
                    customerId: t.customerId,
                    email: t.email,
                    phone: t.phone,
                    transactionId: t.transactionId,
                    emiratesId: t.emiratesId
                },
                "arab" === config.language && (globalConfig.language = config.language = "ar");
                if (-1 === loadWidgetCSS(globalConfig.widgetCssUrl))
                    return consoleLog("[hmwidget] init checks: css could not be loaded"),
                    void sendData({});
                app.init(globalConfig);
                var n = $(".happiness-meter-widget-web-backdrop")
                  , i = $("#" + globalConfig.container);
                if (n.on("click", function() {
                    onFinish(null, "canceled"),
                    render.exitHMWidget(),
                    render.goToNext(2, config.language)
                }),
                consoleLog("[hmwidget] init checks: is jQuery loaded? ", !!$),
                resultData.metadata.jquery = !!$,
                consoleLog("[hmwidget] init checks: jQuery version: ", $.fn.jquery),
                resultData.metadata.jqueryVersion = $.fn.jquery,
                consoleLog("[hmwidget] init config: ", globalConfig),
                i.hasClass("happiness-meter-widget-web-container") ? resultData.metadata.ui.hmClassSet = !0 : (consoleLog("[hmwidget] init log: no happiness-meter-widget-web-container class set"),
                resultData.metadata.ui.hmClassSet = !1,
                i.addClass("happiness-meter-widget-web-container")),
                i.hasClass("cleanslate") ? resultData.metadata.ui.cleanslateClassSet = !0 : (consoleLog("[hmwidget] init log: no cleanslate class set"),
                i.addClass("cleanslate"),
                resultData.metadata.ui.cleanslateClassSet = !1),
                checkIfGaIsLoadedGivenNamespace("ga"),
                checkIfGaIsLoadedGivenNamespace("hmwebwidget"),
                checkIfGaIsLoadedGivenNamespace("hmwidgetaggregated"),
                consoleLog("[hmwidget] init mode: ", globalConfig.mode),
                globalConfig.analyticsTag && "disabled" === globalConfig.analyticsTag.toLowerCase() || initAnalytics(globalConfig.analyticsTag),
                resultData.metadata.version = globalConfig.version,
                resultData.metadata.delay = globalConfig.delay,
                resultData.metadata.mode = globalConfig.mode,
                resultData.metadata.apiKey = globalConfig.apiKey,
                resultData.metadata.apiUrl = globalConfig.apiUrl,
                resultData.metadata.ui.widgetCssUrl = globalConfig.widgetCssUrl,
                resultData.metadata.ui.container = globalConfig.container,
                resultData.metadata.ui.button = globalConfig.button,
                resultData.metadata.analyticsTag = globalConfig.analyticsTag,
                "click" === globalConfig.mode) {
                    var o = $("#" + globalConfig.button);
                    o.length || (o = $("<div></div>", {
                        id: globalConfig.button,
                        class: "happiness-meter-widget-web-button",
                        dir: render.getDirectionGivenLang(globalConfig.language)
                    }),
                    $("body").append(o)),
                    o.on("click", show)
                } else
                    "auto" === globalConfig.mode && setTimeout(show, globalConfig.delay)
            } catch (e) {
                resultData.metadata.error = e.message,
                sendData({})
            }
        })
    }),
    define("src/web/widget", function() {})
}();
