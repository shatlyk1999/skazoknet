(function (e, t) {
    if (typeof define === "function" && define.amd) {
        define([], t);
    } else if (typeof module === "object" && module.exports) {
        module.exports = t();
    } else {
        e.htmx = e.htmx || t();
    }
})(typeof self !== "undefined" ? self : this, function () {
    return (function () {
        "use strict";
        var z = {
            onLoad: t,
            process: Tt,
            on: le,
            off: ue,
            trigger: ie,
            ajax: dr,
            find: b,
            findAll: f,
            closest: d,
            values: function (e, t) {
                var r = Jt(e, t || "post");
                return r.values;
            },
            remove: B,
            addClass: j,
            removeClass: n,
            toggleClass: U,
            takeClass: V,
            defineExtension: yr,
            removeExtension: br,
            logAll: F,
            logger: null,
            config: {
                historyEnabled: true,
                historyCacheSize: 10,
                refreshOnHistoryMiss: false,
                defaultSwapStyle: "innerHTML",
                defaultSwapDelay: 0,
                defaultSettleDelay: 20,
                includeIndicatorStyles: true,
                indicatorClass: "htmx-indicator",
                requestClass: "htmx-request",
                addedClass: "htmx-added",
                settlingClass: "htmx-settling",
                swappingClass: "htmx-swapping",
                allowEval: true,
                inlineScriptNonce: "",
                attributesToSettle: ["class", "style", "width", "height"],
                withCredentials: false,
                timeout: 0,
                wsReconnectDelay: "full-jitter",
                wsBinaryType: "blob",
                disableSelector: "[hx-disable], [data-hx-disable]",
                useTemplateFragments: false,
                scrollBehavior: "smooth",
                defaultFocusScroll: false,
                getCacheBusterParam: false,
                globalViewTransitions: false,
            },
            parseInterval: v,
            _: e,
            createEventSource: function (e) {
                return new EventSource(e, { withCredentials: true });
            },
            createWebSocket: function (e) {
                var t = new WebSocket(e, []);
                t.binaryType = z.config.wsBinaryType;
                return t;
            },
            version: "1.9.2",
        };
        var C = {
            addTriggerHandler: xt,
            bodyContains: ee,
            canAccessLocalStorage: D,
            filterValues: er,
            hasAttribute: q,
            getAttributeValue: G,
            getClosestMatch: c,
            getExpressionVars: fr,
            getHeaders: Qt,
            getInputValues: Jt,
            getInternalData: Y,
            getSwapSpecification: rr,
            getTriggerSpecs: ze,
            getTarget: de,
            makeFragment: l,
            mergeObjects: te,
            makeSettleInfo: S,
            oobSwap: me,
            selectAndSwap: Me,
            settleImmediately: Bt,
            shouldCancel: Ke,
            triggerEvent: ie,
            triggerErrorEvent: ne,
            withExtensions: w,
        };
        var R = ["get", "post", "put", "delete", "patch"];
        var O = R.map(function (e) {
            return "[hx-" + e + "], [data-hx-" + e + "]";
        }).join(", ");
        function v(e) {
            if (e == undefined) {
                return undefined;
            }
            if (e.slice(-2) == "ms") {
                return parseFloat(e.slice(0, -2)) || undefined;
            }
            if (e.slice(-1) == "s") {
                return parseFloat(e.slice(0, -1)) * 1e3 || undefined;
            }
            if (e.slice(-1) == "m") {
                return parseFloat(e.slice(0, -1)) * 1e3 * 60 || undefined;
            }
            return parseFloat(e) || undefined;
        }
        function $(e, t) {
            return e.getAttribute && e.getAttribute(t);
        }
        function q(e, t) {
            return (
                e.hasAttribute &&
                (e.hasAttribute(t) || e.hasAttribute("data-" + t))
            );
        }
        function G(e, t) {
            return $(e, t) || $(e, "data-" + t);
        }
        function u(e) {
            return e.parentElement;
        }
        function J() {
            return document;
        }
        function c(e, t) {
            while (e && !t(e)) {
                e = u(e);
            }
            return e ? e : null;
        }
        function T(e, t, r) {
            var n = G(t, r);
            var i = G(t, "hx-disinherit");
            if (e !== t && i && (i === "*" || i.split(" ").indexOf(r) >= 0)) {
                return "unset";
            } else {
                return n;
            }
        }
        function Z(t, r) {
            var n = null;
            c(t, function (e) {
                return (n = T(t, e, r));
            });
            if (n !== "unset") {
                return n;
            }
        }
        function h(e, t) {
            var r =
                e.matches ||
                e.matchesSelector ||
                e.msMatchesSelector ||
                e.mozMatchesSelector ||
                e.webkitMatchesSelector ||
                e.oMatchesSelector;
            return r && r.call(e, t);
        }
        function H(e) {
            var t = /<([a-z][^\/\0>\x20\t\r\n\f]*)/i;
            var r = t.exec(e);
            if (r) {
                return r[1].toLowerCase();
            } else {
                return "";
            }
        }
        function i(e, t) {
            var r = new DOMParser();
            var n = r.parseFromString(e, "text/html");
            var i = n.body;
            while (t > 0) {
                t--;
                i = i.firstChild;
            }
            if (i == null) {
                i = J().createDocumentFragment();
            }
            return i;
        }
        function L(e) {
            return e.match(/<body/);
        }
        function l(e) {
            var t = !L(e);
            if (z.config.useTemplateFragments && t) {
                var r = i("<body><template>" + e + "</template></body>", 0);
                return r.querySelector("template").content;
            } else {
                var n = H(e);
                switch (n) {
                    case "thead":
                    case "tbody":
                    case "tfoot":
                    case "colgroup":
                    case "caption":
                        return i("<table>" + e + "</table>", 1);
                    case "col":
                        return i(
                            "<table><colgroup>" + e + "</colgroup></table>",
                            2
                        );
                    case "tr":
                        return i("<table><tbody>" + e + "</tbody></table>", 2);
                    case "td":
                    case "th":
                        return i(
                            "<table><tbody><tr>" + e + "</tr></tbody></table>",
                            3
                        );
                    case "script":
                        return i("<div>" + e + "</div>", 1);
                    default:
                        return i(e, 0);
                }
            }
        }
        function K(e) {
            if (e) {
                e();
            }
        }
        function A(e, t) {
            return Object.prototype.toString.call(e) === "[object " + t + "]";
        }
        function N(e) {
            return A(e, "Function");
        }
        function I(e) {
            return A(e, "Object");
        }
        function Y(e) {
            var t = "htmx-internal-data";
            var r = e[t];
            if (!r) {
                r = e[t] = {};
            }
            return r;
        }
        function k(e) {
            var t = [];
            if (e) {
                for (var r = 0; r < e.length; r++) {
                    t.push(e[r]);
                }
            }
            return t;
        }
        function Q(e, t) {
            if (e) {
                for (var r = 0; r < e.length; r++) {
                    t(e[r]);
                }
            }
        }
        function P(e) {
            var t = e.getBoundingClientRect();
            var r = t.top;
            var n = t.bottom;
            return r < window.innerHeight && n >= 0;
        }
        function ee(e) {
            if (e.getRootNode && e.getRootNode() instanceof ShadowRoot) {
                return J().body.contains(e.getRootNode().host);
            } else {
                return J().body.contains(e);
            }
        }
        function M(e) {
            return e.trim().split(/\s+/);
        }
        function te(e, t) {
            for (var r in t) {
                if (t.hasOwnProperty(r)) {
                    e[r] = t[r];
                }
            }
            return e;
        }
        function y(e) {
            try {
                return JSON.parse(e);
            } catch (e) {
                x(e);
                return null;
            }
        }
        function D() {
            var e = "htmx:localStorageTest";
            try {
                localStorage.setItem(e, e);
                localStorage.removeItem(e);
                return true;
            } catch (e) {
                return false;
            }
        }
        function X(t) {
            try {
                var e = new URL(t);
                if (e) {
                    t = e.pathname + e.search;
                }
                if (!t.match("^/$")) {
                    t = t.replace(/\/+$/, "");
                }
                return t;
            } catch (e) {
                return t;
            }
        }
        function e(e) {
            return sr(J().body, function () {
                return eval(e);
            });
        }
        function t(t) {
            var e = z.on("htmx:load", function (e) {
                t(e.detail.elt);
            });
            return e;
        }
        function F() {
            z.logger = function (e, t, r) {
                if (console) {
                    console.log(t, e, r);
                }
            };
        }
        function b(e, t) {
            if (t) {
                return e.querySelector(t);
            } else {
                return b(J(), e);
            }
        }
        function f(e, t) {
            if (t) {
                return e.querySelectorAll(t);
            } else {
                return f(J(), e);
            }
        }
        function B(e, t) {
            e = s(e);
            if (t) {
                setTimeout(function () {
                    B(e);
                    e = null;
                }, t);
            } else {
                e.parentElement.removeChild(e);
            }
        }
        function j(e, t, r) {
            e = s(e);
            if (r) {
                setTimeout(function () {
                    j(e, t);
                    e = null;
                }, r);
            } else {
                e.classList && e.classList.add(t);
            }
        }
        function n(e, t, r) {
            e = s(e);
            if (r) {
                setTimeout(function () {
                    n(e, t);
                    e = null;
                }, r);
            } else {
                if (e.classList) {
                    e.classList.remove(t);
                    if (e.classList.length === 0) {
                        e.removeAttribute("class");
                    }
                }
            }
        }
        function U(e, t) {
            e = s(e);
            e.classList.toggle(t);
        }
        function V(e, t) {
            e = s(e);
            Q(e.parentElement.children, function (e) {
                n(e, t);
            });
            j(e, t);
        }
        function d(e, t) {
            e = s(e);
            if (e.closest) {
                return e.closest(t);
            } else {
                do {
                    if (e == null || h(e, t)) {
                        return e;
                    }
                } while ((e = e && u(e)));
                return null;
            }
        }
        function r(e) {
            var t = e.trim();
            if (t.startsWith("<") && t.endsWith("/>")) {
                return t.substring(1, t.length - 2);
            } else {
                return t;
            }
        }
        function _(e, t) {
            if (t.indexOf("closest ") === 0) {
                return [d(e, r(t.substr(8)))];
            } else if (t.indexOf("find ") === 0) {
                return [b(e, r(t.substr(5)))];
            } else if (t.indexOf("next ") === 0) {
                return [W(e, r(t.substr(5)))];
            } else if (t.indexOf("previous ") === 0) {
                return [oe(e, r(t.substr(9)))];
            } else if (t === "document") {
                return [document];
            } else if (t === "window") {
                return [window];
            } else {
                return J().querySelectorAll(r(t));
            }
        }
        var W = function (e, t) {
            var r = J().querySelectorAll(t);
            for (var n = 0; n < r.length; n++) {
                var i = r[n];
                if (
                    i.compareDocumentPosition(e) ===
                    Node.DOCUMENT_POSITION_PRECEDING
                ) {
                    return i;
                }
            }
        };
        var oe = function (e, t) {
            var r = J().querySelectorAll(t);
            for (var n = r.length - 1; n >= 0; n--) {
                var i = r[n];
                if (
                    i.compareDocumentPosition(e) ===
                    Node.DOCUMENT_POSITION_FOLLOWING
                ) {
                    return i;
                }
            }
        };
        function re(e, t) {
            if (t) {
                return _(e, t)[0];
            } else {
                return _(J().body, e)[0];
            }
        }
        function s(e) {
            if (A(e, "String")) {
                return b(e);
            } else {
                return e;
            }
        }
        function se(e, t, r) {
            if (N(t)) {
                return { target: J().body, event: e, listener: t };
            } else {
                return { target: s(e), event: t, listener: r };
            }
        }
        function le(t, r, n) {
            Sr(function () {
                var e = se(t, r, n);
                e.target.addEventListener(e.event, e.listener);
            });
            var e = N(r);
            return e ? r : n;
        }
        function ue(t, r, n) {
            Sr(function () {
                var e = se(t, r, n);
                e.target.removeEventListener(e.event, e.listener);
            });
            return N(r) ? r : n;
        }
        var fe = J().createElement("output");
        function ce(e, t) {
            var r = Z(e, t);
            if (r) {
                if (r === "this") {
                    return [he(e, t)];
                } else {
                    var n = _(e, r);
                    if (n.length === 0) {
                        x(
                            'The selector "' +
                                r +
                                '" on ' +
                                t +
                                " returned no matches!"
                        );
                        return [fe];
                    } else {
                        return n;
                    }
                }
            }
        }
        function he(e, t) {
            return c(e, function (e) {
                return G(e, t) != null;
            });
        }
        function de(e) {
            var t = Z(e, "hx-target");
            if (t) {
                if (t === "this") {
                    return he(e, "hx-target");
                } else {
                    return re(e, t);
                }
            } else {
                var r = Y(e);
                if (r.boosted) {
                    return J().body;
                } else {
                    return e;
                }
            }
        }
        function ve(e) {
            var t = z.config.attributesToSettle;
            for (var r = 0; r < t.length; r++) {
                if (e === t[r]) {
                    return true;
                }
            }
            return false;
        }
        function ge(t, r) {
            Q(t.attributes, function (e) {
                if (!r.hasAttribute(e.name) && ve(e.name)) {
                    t.removeAttribute(e.name);
                }
            });
            Q(r.attributes, function (e) {
                if (ve(e.name)) {
                    t.setAttribute(e.name, e.value);
                }
            });
        }
        function pe(e, t) {
            var r = wr(t);
            for (var n = 0; n < r.length; n++) {
                var i = r[n];
                try {
                    if (i.isInlineSwap(e)) {
                        return true;
                    }
                } catch (e) {
                    x(e);
                }
            }
            return e === "outerHTML";
        }
        function me(e, i, a) {
            var t = "#" + i.id;
            var o = "outerHTML";
            if (e === "true") {
            } else if (e.indexOf(":") > 0) {
                o = e.substr(0, e.indexOf(":"));
                t = e.substr(e.indexOf(":") + 1, e.length);
            } else {
                o = e;
            }
            var r = J().querySelectorAll(t);
            if (r) {
                Q(r, function (e) {
                    var t;
                    var r = i.cloneNode(true);
                    t = J().createDocumentFragment();
                    t.appendChild(r);
                    if (!pe(o, e)) {
                        t = r;
                    }
                    var n = { shouldSwap: true, target: e, fragment: t };
                    if (!ie(e, "htmx:oobBeforeSwap", n)) return;
                    e = n.target;
                    if (n["shouldSwap"]) {
                        ke(o, e, e, t, a);
                    }
                    Q(a.elts, function (e) {
                        ie(e, "htmx:oobAfterSwap", n);
                    });
                });
                i.parentNode.removeChild(i);
            } else {
                i.parentNode.removeChild(i);
                ne(J().body, "htmx:oobErrorNoTarget", { content: i });
            }
            return e;
        }
        function xe(e, t, r) {
            var n = Z(e, "hx-select-oob");
            if (n) {
                var i = n.split(",");
                for (let e = 0; e < i.length; e++) {
                    var a = i[e].split(":", 2);
                    var o = a[0].trim();
                    if (o.indexOf("#") === 0) {
                        o = o.substring(1);
                    }
                    var s = a[1] || "true";
                    var l = t.querySelector("#" + o);
                    if (l) {
                        me(s, l, r);
                    }
                }
            }
            Q(f(t, "[hx-swap-oob], [data-hx-swap-oob]"), function (e) {
                var t = G(e, "hx-swap-oob");
                if (t != null) {
                    me(t, e, r);
                }
            });
        }
        function ye(e) {
            Q(f(e, "[hx-preserve], [data-hx-preserve]"), function (e) {
                var t = G(e, "id");
                var r = J().getElementById(t);
                if (r != null) {
                    e.parentNode.replaceChild(r, e);
                }
            });
        }
        function be(a, e, o) {
            Q(e.querySelectorAll("[id]"), function (e) {
                if (e.id && e.id.length > 0) {
                    var t = e.id.replace("'", "\\'");
                    var r = e.tagName.replace(":", "\\:");
                    var n = a.querySelector(r + "[id='" + t + "']");
                    if (n && n !== a) {
                        var i = e.cloneNode();
                        ge(e, n);
                        o.tasks.push(function () {
                            ge(e, i);
                        });
                    }
                }
            });
        }
        function we(e) {
            return function () {
                n(e, z.config.addedClass);
                Tt(e);
                bt(e);
                Se(e);
                ie(e, "htmx:load");
            };
        }
        function Se(e) {
            var t = "[autofocus]";
            var r = h(e, t) ? e : e.querySelector(t);
            if (r != null) {
                r.focus();
            }
        }
        function a(e, t, r, n) {
            be(e, r, n);
            while (r.childNodes.length > 0) {
                var i = r.firstChild;
                j(i, z.config.addedClass);
                e.insertBefore(i, t);
                if (
                    i.nodeType !== Node.TEXT_NODE &&
                    i.nodeType !== Node.COMMENT_NODE
                ) {
                    n.tasks.push(we(i));
                }
            }
        }
        function Ee(e, t) {
            var r = 0;
            while (r < e.length) {
                t = ((t << 5) - t + e.charCodeAt(r++)) | 0;
            }
            return t;
        }
        function Ce(e) {
            var t = 0;
            if (e.attributes) {
                for (var r = 0; r < e.attributes.length; r++) {
                    var n = e.attributes[r];
                    if (n.value) {
                        t = Ee(n.name, t);
                        t = Ee(n.value, t);
                    }
                }
            }
            return t;
        }
        function Re(t) {
            var r = Y(t);
            if (r.timeout) {
                clearTimeout(r.timeout);
            }
            if (r.webSocket) {
                r.webSocket.close();
            }
            if (r.sseEventSource) {
                r.sseEventSource.close();
            }
            if (r.listenerInfos) {
                Q(r.listenerInfos, function (e) {
                    if (e.on) {
                        e.on.removeEventListener(e.trigger, e.listener);
                    }
                });
            }
            if (r.onHandlers) {
                for (let e = 0; e < r.onHandlers.length; e++) {
                    const n = r.onHandlers[e];
                    t.removeEventListener(n.name, n.handler);
                }
            }
        }
        function o(e) {
            ie(e, "htmx:beforeCleanupElement");
            Re(e);
            if (e.children) {
                Q(e.children, function (e) {
                    o(e);
                });
            }
        }
        function Oe(e, t, r) {
            if (e.tagName === "BODY") {
                return Ne(e, t, r);
            } else {
                var n;
                var i = e.previousSibling;
                a(u(e), e, t, r);
                if (i == null) {
                    n = u(e).firstChild;
                } else {
                    n = i.nextSibling;
                }
                Y(e).replacedWith = n;
                r.elts = [];
                while (n && n !== e) {
                    if (n.nodeType === Node.ELEMENT_NODE) {
                        r.elts.push(n);
                    }
                    n = n.nextElementSibling;
                }
                o(e);
                u(e).removeChild(e);
            }
        }
        function qe(e, t, r) {
            return a(e, e.firstChild, t, r);
        }
        function Te(e, t, r) {
            return a(u(e), e, t, r);
        }
        function He(e, t, r) {
            return a(e, null, t, r);
        }
        function Le(e, t, r) {
            return a(u(e), e.nextSibling, t, r);
        }
        function Ae(e, t, r) {
            o(e);
            return u(e).removeChild(e);
        }
        function Ne(e, t, r) {
            var n = e.firstChild;
            a(e, n, t, r);
            if (n) {
                while (n.nextSibling) {
                    o(n.nextSibling);
                    e.removeChild(n.nextSibling);
                }
                o(n);
                e.removeChild(n);
            }
        }
        function Ie(e, t) {
            var r = Z(e, "hx-select");
            if (r) {
                var n = J().createDocumentFragment();
                Q(t.querySelectorAll(r), function (e) {
                    n.appendChild(e);
                });
                t = n;
            }
            return t;
        }
        function ke(e, t, r, n, i) {
            switch (e) {
                case "none":
                    return;
                case "outerHTML":
                    Oe(r, n, i);
                    return;
                case "afterbegin":
                    qe(r, n, i);
                    return;
                case "beforebegin":
                    Te(r, n, i);
                    return;
                case "beforeend":
                    He(r, n, i);
                    return;
                case "afterend":
                    Le(r, n, i);
                    return;
                case "delete":
                    Ae(r, n, i);
                    return;
                default:
                    var a = wr(t);
                    for (var o = 0; o < a.length; o++) {
                        var s = a[o];
                        try {
                            var l = s.handleSwap(e, r, n, i);
                            if (l) {
                                if (typeof l.length !== "undefined") {
                                    for (var u = 0; u < l.length; u++) {
                                        var f = l[u];
                                        if (
                                            f.nodeType !== Node.TEXT_NODE &&
                                            f.nodeType !== Node.COMMENT_NODE
                                        ) {
                                            i.tasks.push(we(f));
                                        }
                                    }
                                }
                                return;
                            }
                        } catch (e) {
                            x(e);
                        }
                    }
                    if (e === "innerHTML") {
                        Ne(r, n, i);
                    } else {
                        ke(z.config.defaultSwapStyle, t, r, n, i);
                    }
            }
        }
        function Pe(e) {
            if (e.indexOf("<title") > -1) {
                var t = e.replace(/<svg(\s[^>]*>|>)([\s\S]*?)<\/svg>/gim, "");
                var r = t.match(/<title(\s[^>]*>|>)([\s\S]*?)<\/title>/im);
                if (r) {
                    return r[2];
                }
            }
        }
        function Me(e, t, r, n, i) {
            i.title = Pe(n);
            var a = l(n);
            if (a) {
                xe(r, a, i);
                a = Ie(r, a);
                ye(a);
                return ke(e, r, t, a, i);
            }
        }
        function De(e, t, r) {
            var n = e.getResponseHeader(t);
            if (n.indexOf("{") === 0) {
                var i = y(n);
                for (var a in i) {
                    if (i.hasOwnProperty(a)) {
                        var o = i[a];
                        if (!I(o)) {
                            o = { value: o };
                        }
                        ie(r, a, o);
                    }
                }
            } else {
                ie(r, n, []);
            }
        }
        var Xe = /\s/;
        var g = /[\s,]/;
        var Fe = /[_$a-zA-Z]/;
        var Be = /[_$a-zA-Z0-9]/;
        var je = ['"', "'", "/"];
        var p = /[^\s]/;
        function Ue(e) {
            var t = [];
            var r = 0;
            while (r < e.length) {
                if (Fe.exec(e.charAt(r))) {
                    var n = r;
                    while (Be.exec(e.charAt(r + 1))) {
                        r++;
                    }
                    t.push(e.substr(n, r - n + 1));
                } else if (je.indexOf(e.charAt(r)) !== -1) {
                    var i = e.charAt(r);
                    var n = r;
                    r++;
                    while (r < e.length && e.charAt(r) !== i) {
                        if (e.charAt(r) === "\\") {
                            r++;
                        }
                        r++;
                    }
                    t.push(e.substr(n, r - n + 1));
                } else {
                    var a = e.charAt(r);
                    t.push(a);
                }
                r++;
            }
            return t;
        }
        function Ve(e, t, r) {
            return (
                Fe.exec(e.charAt(0)) &&
                e !== "true" &&
                e !== "false" &&
                e !== "this" &&
                e !== r &&
                t !== "."
            );
        }
        function _e(e, t, r) {
            if (t[0] === "[") {
                t.shift();
                var n = 1;
                var i = " return (function(" + r + "){ return (";
                var a = null;
                while (t.length > 0) {
                    var o = t[0];
                    if (o === "]") {
                        n--;
                        if (n === 0) {
                            if (a === null) {
                                i = i + "true";
                            }
                            t.shift();
                            i += ")})";
                            try {
                                var s = sr(
                                    e,
                                    function () {
                                        return Function(i)();
                                    },
                                    function () {
                                        return true;
                                    }
                                );
                                s.source = i;
                                return s;
                            } catch (e) {
                                ne(J().body, "htmx:syntax:error", {
                                    error: e,
                                    source: i,
                                });
                                return null;
                            }
                        }
                    } else if (o === "[") {
                        n++;
                    }
                    if (Ve(o, a, r)) {
                        i +=
                            "((" +
                            r +
                            "." +
                            o +
                            ") ? (" +
                            r +
                            "." +
                            o +
                            ") : (window." +
                            o +
                            "))";
                    } else {
                        i = i + o;
                    }
                    a = t.shift();
                }
            }
        }
        function m(e, t) {
            var r = "";
            while (e.length > 0 && !e[0].match(t)) {
                r += e.shift();
            }
            return r;
        }
        var We = "input, textarea, select";
        function ze(e) {
            var t = G(e, "hx-trigger");
            var r = [];
            if (t) {
                var n = Ue(t);
                do {
                    m(n, p);
                    var i = n.length;
                    var a = m(n, /[,\[\s]/);
                    if (a !== "") {
                        if (a === "every") {
                            var o = { trigger: "every" };
                            m(n, p);
                            o.pollInterval = v(m(n, /[,\[\s]/));
                            m(n, p);
                            var s = _e(e, n, "event");
                            if (s) {
                                o.eventFilter = s;
                            }
                            r.push(o);
                        } else if (a.indexOf("sse:") === 0) {
                            r.push({ trigger: "sse", sseEvent: a.substr(4) });
                        } else {
                            var l = { trigger: a };
                            var s = _e(e, n, "event");
                            if (s) {
                                l.eventFilter = s;
                            }
                            while (n.length > 0 && n[0] !== ",") {
                                m(n, p);
                                var u = n.shift();
                                if (u === "changed") {
                                    l.changed = true;
                                } else if (u === "once") {
                                    l.once = true;
                                } else if (u === "consume") {
                                    l.consume = true;
                                } else if (u === "delay" && n[0] === ":") {
                                    n.shift();
                                    l.delay = v(m(n, g));
                                } else if (u === "from" && n[0] === ":") {
                                    n.shift();
                                    var f = m(n, g);
                                    if (
                                        f === "closest" ||
                                        f === "find" ||
                                        f === "next" ||
                                        f === "previous"
                                    ) {
                                        n.shift();
                                        f += " " + m(n, g);
                                    }
                                    l.from = f;
                                } else if (u === "target" && n[0] === ":") {
                                    n.shift();
                                    l.target = m(n, g);
                                } else if (u === "throttle" && n[0] === ":") {
                                    n.shift();
                                    l.throttle = v(m(n, g));
                                } else if (u === "queue" && n[0] === ":") {
                                    n.shift();
                                    l.queue = m(n, g);
                                } else if (
                                    (u === "root" || u === "threshold") &&
                                    n[0] === ":"
                                ) {
                                    n.shift();
                                    l[u] = m(n, g);
                                } else {
                                    ne(e, "htmx:syntax:error", {
                                        token: n.shift(),
                                    });
                                }
                            }
                            r.push(l);
                        }
                    }
                    if (n.length === i) {
                        ne(e, "htmx:syntax:error", { token: n.shift() });
                    }
                    m(n, p);
                } while (n[0] === "," && n.shift());
            }
            if (r.length > 0) {
                return r;
            } else if (h(e, "form")) {
                return [{ trigger: "submit" }];
            } else if (h(e, 'input[type="button"]')) {
                return [{ trigger: "click" }];
            } else if (h(e, We)) {
                return [{ trigger: "change" }];
            } else {
                return [{ trigger: "click" }];
            }
        }
        function $e(e) {
            Y(e).cancelled = true;
        }
        function Ge(e, t, r) {
            var n = Y(e);
            n.timeout = setTimeout(function () {
                if (ee(e) && n.cancelled !== true) {
                    if (
                        !Qe(
                            r,
                            Lt("hx:poll:trigger", { triggerSpec: r, target: e })
                        )
                    ) {
                        t(e);
                    }
                    Ge(e, t, r);
                }
            }, r.pollInterval);
        }
        function Je(e) {
            return (
                location.hostname === e.hostname &&
                $(e, "href") &&
                $(e, "href").indexOf("#") !== 0
            );
        }
        function Ze(t, r, e) {
            if (
                (t.tagName === "A" &&
                    Je(t) &&
                    (t.target === "" || t.target === "_self")) ||
                t.tagName === "FORM"
            ) {
                r.boosted = true;
                var n, i;
                if (t.tagName === "A") {
                    n = "get";
                    i = t.href;
                } else {
                    var a = $(t, "method");
                    n = a ? a.toLowerCase() : "get";
                    if (n === "get") {
                    }
                    i = $(t, "action");
                }
                e.forEach(function (e) {
                    et(
                        t,
                        function (e, t) {
                            ae(n, i, e, t);
                        },
                        r,
                        e,
                        true
                    );
                });
            }
        }
        function Ke(e, t) {
            if (e.type === "submit" || e.type === "click") {
                if (t.tagName === "FORM") {
                    return true;
                }
                if (
                    h(t, 'input[type="submit"], button') &&
                    d(t, "form") !== null
                ) {
                    return true;
                }
                if (
                    t.tagName === "A" &&
                    t.href &&
                    (t.getAttribute("href") === "#" ||
                        t.getAttribute("href").indexOf("#") !== 0)
                ) {
                    return true;
                }
            }
            return false;
        }
        function Ye(e, t) {
            return (
                Y(e).boosted &&
                e.tagName === "A" &&
                t.type === "click" &&
                (t.ctrlKey || t.metaKey)
            );
        }
        function Qe(e, t) {
            var r = e.eventFilter;
            if (r) {
                try {
                    return r(t) !== true;
                } catch (e) {
                    ne(J().body, "htmx:eventFilter:error", {
                        error: e,
                        source: r.source,
                    });
                    return true;
                }
            }
            return false;
        }
        function et(i, a, e, o, s) {
            var l = Y(i);
            var t;
            if (o.from) {
                t = _(i, o.from);
            } else {
                t = [i];
            }
            if (o.changed) {
                l.lastValue = i.value;
            }
            Q(t, function (r) {
                var n = function (e) {
                    if (!ee(i)) {
                        r.removeEventListener(o.trigger, n);
                        return;
                    }
                    if (Ye(i, e)) {
                        return;
                    }
                    if (s || Ke(e, i)) {
                        e.preventDefault();
                    }
                    if (Qe(o, e)) {
                        return;
                    }
                    var t = Y(e);
                    t.triggerSpec = o;
                    if (t.handledFor == null) {
                        t.handledFor = [];
                    }
                    if (t.handledFor.indexOf(i) < 0) {
                        t.handledFor.push(i);
                        if (o.consume) {
                            e.stopPropagation();
                        }
                        if (o.target && e.target) {
                            if (!h(e.target, o.target)) {
                                return;
                            }
                        }
                        if (o.once) {
                            if (l.triggeredOnce) {
                                return;
                            } else {
                                l.triggeredOnce = true;
                            }
                        }
                        if (o.changed) {
                            if (l.lastValue === i.value) {
                                return;
                            } else {
                                l.lastValue = i.value;
                            }
                        }
                        if (l.delayed) {
                            clearTimeout(l.delayed);
                        }
                        if (l.throttle) {
                            return;
                        }
                        if (o.throttle) {
                            if (!l.throttle) {
                                a(i, e);
                                l.throttle = setTimeout(function () {
                                    l.throttle = null;
                                }, o.throttle);
                            }
                        } else if (o.delay) {
                            l.delayed = setTimeout(function () {
                                a(i, e);
                            }, o.delay);
                        } else {
                            ie(i, "htmx:trigger");
                            a(i, e);
                        }
                    }
                };
                if (e.listenerInfos == null) {
                    e.listenerInfos = [];
                }
                e.listenerInfos.push({
                    trigger: o.trigger,
                    listener: n,
                    on: r,
                });
                r.addEventListener(o.trigger, n);
            });
        }
        var tt = false;
        var rt = null;
        function nt() {
            if (!rt) {
                rt = function () {
                    tt = true;
                };
                window.addEventListener("scroll", rt);
                setInterval(function () {
                    if (tt) {
                        tt = false;
                        Q(
                            J().querySelectorAll(
                                "[hx-trigger='revealed'],[data-hx-trigger='revealed']"
                            ),
                            function (e) {
                                it(e);
                            }
                        );
                    }
                }, 200);
            }
        }
        function it(t) {
            if (!q(t, "data-hx-revealed") && P(t)) {
                t.setAttribute("data-hx-revealed", "true");
                var e = Y(t);
                if (e.initHash) {
                    ie(t, "revealed");
                } else {
                    t.addEventListener(
                        "htmx:afterProcessNode",
                        function (e) {
                            ie(t, "revealed");
                        },
                        { once: true }
                    );
                }
            }
        }
        function at(e, t, r) {
            var n = M(r);
            for (var i = 0; i < n.length; i++) {
                var a = n[i].split(/:(.+)/);
                if (a[0] === "connect") {
                    ot(e, a[1], 0);
                }
                if (a[0] === "send") {
                    lt(e);
                }
            }
        }
        function ot(s, r, n) {
            if (!ee(s)) {
                return;
            }
            if (r.indexOf("/") == 0) {
                var e =
                    location.hostname +
                    (location.port ? ":" + location.port : "");
                if (location.protocol == "https:") {
                    r = "wss://" + e + r;
                } else if (location.protocol == "http:") {
                    r = "ws://" + e + r;
                }
            }
            var t = z.createWebSocket(r);
            t.onerror = function (e) {
                ne(s, "htmx:wsError", { error: e, socket: t });
                st(s);
            };
            t.onclose = function (e) {
                if ([1006, 1012, 1013].indexOf(e.code) >= 0) {
                    var t = ut(n);
                    setTimeout(function () {
                        ot(s, r, n + 1);
                    }, t);
                }
            };
            t.onopen = function (e) {
                n = 0;
            };
            Y(s).webSocket = t;
            t.addEventListener("message", function (e) {
                if (st(s)) {
                    return;
                }
                var t = e.data;
                w(s, function (e) {
                    t = e.transformResponse(t, null, s);
                });
                var r = S(s);
                var n = l(t);
                var i = k(n.children);
                for (var a = 0; a < i.length; a++) {
                    var o = i[a];
                    me(G(o, "hx-swap-oob") || "true", o, r);
                }
                Bt(r.tasks);
            });
        }
        function st(e) {
            if (!ee(e)) {
                Y(e).webSocket.close();
                return true;
            }
        }
        function lt(u) {
            var f = c(u, function (e) {
                return Y(e).webSocket != null;
            });
            if (f) {
                u.addEventListener(ze(u)[0].trigger, function (e) {
                    var t = Y(f).webSocket;
                    var r = Qt(u, f);
                    var n = Jt(u, "post");
                    var i = n.errors;
                    var a = n.values;
                    var o = fr(u);
                    var s = te(a, o);
                    var l = er(s, u);
                    l["HEADERS"] = r;
                    if (i && i.length > 0) {
                        ie(u, "htmx:validation:halted", i);
                        return;
                    }
                    t.send(JSON.stringify(l));
                    if (Ke(e, u)) {
                        e.preventDefault();
                    }
                });
            } else {
                ne(u, "htmx:noWebSocketSourceError");
            }
        }
        function ut(e) {
            var t = z.config.wsReconnectDelay;
            if (typeof t === "function") {
                return t(e);
            }
            if (t === "full-jitter") {
                var r = Math.min(e, 6);
                var n = 1e3 * Math.pow(2, r);
                return n * Math.random();
            }
            x(
                'htmx.config.wsReconnectDelay must either be a function or the string "full-jitter"'
            );
        }
        function ft(e, t, r) {
            var n = M(r);
            for (var i = 0; i < n.length; i++) {
                var a = n[i].split(/:(.+)/);
                if (a[0] === "connect") {
                    ct(e, a[1]);
                }
                if (a[0] === "swap") {
                    ht(e, a[1]);
                }
            }
        }
        function ct(t, e) {
            var r = z.createEventSource(e);
            r.onerror = function (e) {
                ne(t, "htmx:sseError", { error: e, source: r });
                vt(t);
            };
            Y(t).sseEventSource = r;
        }
        function ht(a, o) {
            var s = c(a, gt);
            if (s) {
                var l = Y(s).sseEventSource;
                var u = function (e) {
                    if (vt(s)) {
                        l.removeEventListener(o, u);
                        return;
                    }
                    var t = e.data;
                    w(a, function (e) {
                        t = e.transformResponse(t, null, a);
                    });
                    var r = rr(a);
                    var n = de(a);
                    var i = S(a);
                    Me(r.swapStyle, a, n, t, i);
                    Bt(i.tasks);
                    ie(a, "htmx:sseMessage", e);
                };
                Y(a).sseListener = u;
                l.addEventListener(o, u);
            } else {
                ne(a, "htmx:noSSESourceError");
            }
        }
        function dt(e, t, r) {
            var n = c(e, gt);
            if (n) {
                var i = Y(n).sseEventSource;
                var a = function () {
                    if (!vt(n)) {
                        if (ee(e)) {
                            t(e);
                        } else {
                            i.removeEventListener(r, a);
                        }
                    }
                };
                Y(e).sseListener = a;
                i.addEventListener(r, a);
            } else {
                ne(e, "htmx:noSSESourceError");
            }
        }
        function vt(e) {
            if (!ee(e)) {
                Y(e).sseEventSource.close();
                return true;
            }
        }
        function gt(e) {
            return Y(e).sseEventSource != null;
        }
        function pt(e, t, r, n) {
            var i = function () {
                if (!r.loaded) {
                    r.loaded = true;
                    t(e);
                }
            };
            if (n) {
                setTimeout(i, n);
            } else {
                i();
            }
        }
        function mt(t, i, e) {
            var a = false;
            Q(R, function (r) {
                if (q(t, "hx-" + r)) {
                    var n = G(t, "hx-" + r);
                    a = true;
                    i.path = n;
                    i.verb = r;
                    e.forEach(function (e) {
                        xt(t, e, i, function (e, t) {
                            ae(r, n, e, t);
                        });
                    });
                }
            });
            return a;
        }
        function xt(n, e, t, r) {
            if (e.sseEvent) {
                dt(n, r, e.sseEvent);
            } else if (e.trigger === "revealed") {
                nt();
                et(n, r, t, e);
                it(n);
            } else if (e.trigger === "intersect") {
                var i = {};
                if (e.root) {
                    i.root = re(n, e.root);
                }
                if (e.threshold) {
                    i.threshold = parseFloat(e.threshold);
                }
                var a = new IntersectionObserver(function (e) {
                    for (var t = 0; t < e.length; t++) {
                        var r = e[t];
                        if (r.isIntersecting) {
                            ie(n, "intersect");
                            break;
                        }
                    }
                }, i);
                a.observe(n);
                et(n, r, t, e);
            } else if (e.trigger === "load") {
                if (!Qe(e, Lt("load", { elt: n }))) {
                    pt(n, r, t, e.delay);
                }
            } else if (e.pollInterval) {
                t.polling = true;
                Ge(n, r, e);
            } else {
                et(n, r, t, e);
            }
        }
        function yt(e) {
            if (
                e.type === "text/javascript" ||
                e.type === "module" ||
                e.type === ""
            ) {
                var t = J().createElement("script");
                Q(e.attributes, function (e) {
                    t.setAttribute(e.name, e.value);
                });
                t.textContent = e.textContent;
                t.async = false;
                if (z.config.inlineScriptNonce) {
                    t.nonce = z.config.inlineScriptNonce;
                }
                var r = e.parentElement;
                try {
                    r.insertBefore(t, e);
                } catch (e) {
                    x(e);
                } finally {
                    if (e.parentElement) {
                        e.parentElement.removeChild(e);
                    }
                }
            }
        }
        function bt(e) {
            if (h(e, "script")) {
                yt(e);
            }
            Q(f(e, "script"), function (e) {
                yt(e);
            });
        }
        function wt() {
            return document.querySelector("[hx-boost], [data-hx-boost]");
        }
        function St(e) {
            if (e.querySelectorAll) {
                var t = wt() ? ", a, form" : "";
                var r = e.querySelectorAll(
                    O +
                        t +
                        ", [hx-sse], [data-hx-sse], [hx-ws]," +
                        " [data-hx-ws], [hx-ext], [data-hx-ext], [hx-trigger], [data-hx-trigger], [hx-on], [data-hx-on]"
                );
                return r;
            } else {
                return [];
            }
        }
        function Et(n) {
            var e = function (e) {
                var t = d(e.target, "button, input[type='submit']");
                if (t !== null) {
                    var r = Y(n);
                    r.lastButtonClicked = t;
                }
            };
            n.addEventListener("click", e);
            n.addEventListener("focusin", e);
            n.addEventListener("focusout", function (e) {
                var t = Y(n);
                t.lastButtonClicked = null;
            });
        }
        function Ct(e) {
            var t = Ue(e);
            var r = 0;
            for (let e = 0; e < t.length; e++) {
                const n = t[e];
                if (n === "{") {
                    r++;
                } else if (n === "}") {
                    r--;
                }
            }
            return r;
        }
        function Rt(t, e, r) {
            var n = Y(t);
            n.onHandlers = [];
            var i = new Function("event", r + "; return;");
            var a = t.addEventListener(e, function (e) {
                return i.call(t, e);
            });
            n.onHandlers.push({ event: e, listener: a });
            return { nodeData: n, code: r, func: i, listener: a };
        }
        function Ot(e) {
            var t = G(e, "hx-on");
            if (t) {
                var r = {};
                var n = t.split("\n");
                var i = null;
                var a = 0;
                while (n.length > 0) {
                    var o = n.shift();
                    var s = o.match(/^\s*([a-zA-Z:\-]+:)(.*)/);
                    if (a === 0 && s) {
                        o.split(":");
                        i = s[1].slice(0, -1);
                        r[i] = s[2];
                    } else {
                        r[i] += o;
                    }
                    a += Ct(o);
                }
                for (var l in r) {
                    Rt(e, l, r[l]);
                }
            }
        }
        function qt(t) {
            if (t.closest && t.closest(z.config.disableSelector)) {
                return;
            }
            var r = Y(t);
            if (r.initHash !== Ce(t)) {
                r.initHash = Ce(t);
                Re(t);
                Ot(t);
                ie(t, "htmx:beforeProcessNode");
                if (t.value) {
                    r.lastValue = t.value;
                }
                var e = ze(t);
                var n = mt(t, r, e);
                if (!n) {
                    if (Z(t, "hx-boost") === "true") {
                        Ze(t, r, e);
                    } else if (q(t, "hx-trigger")) {
                        e.forEach(function (e) {
                            xt(t, e, r, function () {});
                        });
                    }
                }
                if (t.tagName === "FORM") {
                    Et(t);
                }
                var i = G(t, "hx-sse");
                if (i) {
                    ft(t, r, i);
                }
                var a = G(t, "hx-ws");
                if (a) {
                    at(t, r, a);
                }
                ie(t, "htmx:afterProcessNode");
            }
        }
        function Tt(e) {
            e = s(e);
            qt(e);
            Q(St(e), function (e) {
                qt(e);
            });
        }
        function Ht(e) {
            return e.replace(/([a-z0-9])([A-Z])/g, "$1-$2").toLowerCase();
        }
        function Lt(e, t) {
            var r;
            if (
                window.CustomEvent &&
                typeof window.CustomEvent === "function"
            ) {
                r = new CustomEvent(e, {
                    bubbles: true,
                    cancelable: true,
                    detail: t,
                });
            } else {
                r = J().createEvent("CustomEvent");
                r.initCustomEvent(e, true, true, t);
            }
            return r;
        }
        function ne(e, t, r) {
            ie(e, t, te({ error: t }, r));
        }
        function At(e) {
            return e === "htmx:afterProcessNode";
        }
        function w(e, t) {
            Q(wr(e), function (e) {
                try {
                    t(e);
                } catch (e) {
                    x(e);
                }
            });
        }
        function x(e) {
            if (console.error) {
                console.error(e);
            } else if (console.log) {
                console.log("ERROR: ", e);
            }
        }
        function ie(e, t, r) {
            e = s(e);
            if (r == null) {
                r = {};
            }
            r["elt"] = e;
            var n = Lt(t, r);
            if (z.logger && !At(t)) {
                z.logger(e, t, r);
            }
            if (r.error) {
                x(r.error);
                ie(e, "htmx:error", { errorInfo: r });
            }
            var i = e.dispatchEvent(n);
            var a = Ht(t);
            if (i && a !== t) {
                var o = Lt(a, n.detail);
                i = i && e.dispatchEvent(o);
            }
            w(e, function (e) {
                i = i && e.onEvent(t, n) !== false;
            });
            return i;
        }
        var Nt = location.pathname + location.search;
        function It() {
            var e = J().querySelector("[hx-history-elt],[data-hx-history-elt]");
            return e || J().body;
        }
        function kt(e, t, r, n) {
            if (!D()) {
                return;
            }
            e = X(e);
            var i = y(localStorage.getItem("htmx-history-cache")) || [];
            for (var a = 0; a < i.length; a++) {
                if (i[a].url === e) {
                    i.splice(a, 1);
                    break;
                }
            }
            var o = { url: e, content: t, title: r, scroll: n };
            ie(J().body, "htmx:historyItemCreated", { item: o, cache: i });
            i.push(o);
            while (i.length > z.config.historyCacheSize) {
                i.shift();
            }
            while (i.length > 0) {
                try {
                    localStorage.setItem(
                        "htmx-history-cache",
                        JSON.stringify(i)
                    );
                    break;
                } catch (e) {
                    ne(J().body, "htmx:historyCacheError", {
                        cause: e,
                        cache: i,
                    });
                    i.shift();
                }
            }
        }
        function Pt(e) {
            if (!D()) {
                return null;
            }
            e = X(e);
            var t = y(localStorage.getItem("htmx-history-cache")) || [];
            for (var r = 0; r < t.length; r++) {
                if (t[r].url === e) {
                    return t[r];
                }
            }
            return null;
        }
        function Mt(e) {
            var t = z.config.requestClass;
            var r = e.cloneNode(true);
            Q(f(r, "." + t), function (e) {
                n(e, t);
            });
            return r.innerHTML;
        }
        function Dt() {
            var e = It();
            var t = Nt || location.pathname + location.search;
            var r = J().querySelector(
                '[hx-history="false" i],[data-hx-history="false" i]'
            );
            if (!r) {
                ie(J().body, "htmx:beforeHistorySave", {
                    path: t,
                    historyElt: e,
                });
                kt(t, Mt(e), J().title, window.scrollY);
            }
            if (z.config.historyEnabled)
                history.replaceState(
                    { htmx: true },
                    J().title,
                    window.location.href
                );
        }
        function Xt(e) {
            if (z.config.getCacheBusterParam) {
                e = e.replace(/org\.htmx\.cache-buster=[^&]*&?/, "");
                if (e.endsWith("&") || e.endsWith("?")) {
                    e = e.slice(0, -1);
                }
            }
            if (z.config.historyEnabled) {
                history.pushState({ htmx: true }, "", e);
            }
            Nt = e;
        }
        function Ft(e) {
            if (z.config.historyEnabled)
                history.replaceState({ htmx: true }, "", e);
            Nt = e;
        }
        function Bt(e) {
            Q(e, function (e) {
                e.call();
            });
        }
        function jt(a) {
            var e = new XMLHttpRequest();
            var o = { path: a, xhr: e };
            ie(J().body, "htmx:historyCacheMiss", o);
            e.open("GET", a, true);
            e.setRequestHeader("HX-History-Restore-Request", "true");
            e.onload = function () {
                if (this.status >= 200 && this.status < 400) {
                    ie(J().body, "htmx:historyCacheMissLoad", o);
                    var e = l(this.response);
                    e =
                        e.querySelector(
                            "[hx-history-elt],[data-hx-history-elt]"
                        ) || e;
                    var t = It();
                    var r = S(t);
                    var n = Pe(this.response);
                    if (n) {
                        var i = b("title");
                        if (i) {
                            i.innerHTML = n;
                        } else {
                            window.document.title = n;
                        }
                    }
                    Ne(t, e, r);
                    Bt(r.tasks);
                    Nt = a;
                    ie(J().body, "htmx:historyRestore", {
                        path: a,
                        cacheMiss: true,
                        serverResponse: this.response,
                    });
                } else {
                    ne(J().body, "htmx:historyCacheMissLoadError", o);
                }
            };
            e.send();
        }
        function Ut(e) {
            Dt();
            e = e || location.pathname + location.search;
            var t = Pt(e);
            if (t) {
                var r = l(t.content);
                var n = It();
                var i = S(n);
                Ne(n, r, i);
                Bt(i.tasks);
                document.title = t.title;
                window.scrollTo(0, t.scroll);
                Nt = e;
                ie(J().body, "htmx:historyRestore", { path: e, item: t });
            } else {
                if (z.config.refreshOnHistoryMiss) {
                    window.location.reload(true);
                } else {
                    jt(e);
                }
            }
        }
        function Vt(e) {
            var t = ce(e, "hx-indicator");
            if (t == null) {
                t = [e];
            }
            Q(t, function (e) {
                var t = Y(e);
                t.requestCount = (t.requestCount || 0) + 1;
                e.classList["add"].call(e.classList, z.config.requestClass);
            });
            return t;
        }
        function _t(e) {
            Q(e, function (e) {
                var t = Y(e);
                t.requestCount = (t.requestCount || 0) - 1;
                if (t.requestCount === 0) {
                    e.classList["remove"].call(
                        e.classList,
                        z.config.requestClass
                    );
                }
            });
        }
        function Wt(e, t) {
            for (var r = 0; r < e.length; r++) {
                var n = e[r];
                if (n.isSameNode(t)) {
                    return true;
                }
            }
            return false;
        }
        function zt(e) {
            if (e.name === "" || e.name == null || e.disabled) {
                return false;
            }
            if (
                e.type === "button" ||
                e.type === "submit" ||
                e.tagName === "image" ||
                e.tagName === "reset" ||
                e.tagName === "file"
            ) {
                return false;
            }
            if (e.type === "checkbox" || e.type === "radio") {
                return e.checked;
            }
            return true;
        }
        function $t(t, r, n, e, i) {
            if (e == null || Wt(t, e)) {
                return;
            } else {
                t.push(e);
            }
            if (zt(e)) {
                var a = $(e, "name");
                var o = e.value;
                if (e.multiple) {
                    o = k(e.querySelectorAll("option:checked")).map(function (
                        e
                    ) {
                        return e.value;
                    });
                }
                if (e.files) {
                    o = k(e.files);
                }
                if (a != null && o != null) {
                    var s = r[a];
                    if (s !== undefined) {
                        if (Array.isArray(s)) {
                            if (Array.isArray(o)) {
                                r[a] = s.concat(o);
                            } else {
                                s.push(o);
                            }
                        } else {
                            if (Array.isArray(o)) {
                                r[a] = [s].concat(o);
                            } else {
                                r[a] = [s, o];
                            }
                        }
                    } else {
                        r[a] = o;
                    }
                }
                if (i) {
                    Gt(e, n);
                }
            }
            if (h(e, "form")) {
                var l = e.elements;
                Q(l, function (e) {
                    $t(t, r, n, e, i);
                });
            }
        }
        function Gt(e, t) {
            if (e.willValidate) {
                ie(e, "htmx:validation:validate");
                if (!e.checkValidity()) {
                    t.push({
                        elt: e,
                        message: e.validationMessage,
                        validity: e.validity,
                    });
                    ie(e, "htmx:validation:failed", {
                        message: e.validationMessage,
                        validity: e.validity,
                    });
                }
            }
        }
        function Jt(e, t) {
            var r = [];
            var n = {};
            var i = {};
            var a = [];
            var o = Y(e);
            var s =
                (h(e, "form") && e.noValidate !== true) ||
                G(e, "hx-validate") === "true";
            if (o.lastButtonClicked) {
                s = s && o.lastButtonClicked.formNoValidate !== true;
            }
            if (t !== "get") {
                $t(r, i, a, d(e, "form"), s);
            }
            $t(r, n, a, e, s);
            if (o.lastButtonClicked) {
                var l = $(o.lastButtonClicked, "name");
                if (l) {
                    n[l] = o.lastButtonClicked.value;
                }
            }
            var u = ce(e, "hx-include");
            Q(u, function (e) {
                $t(r, n, a, e, s);
                if (!h(e, "form")) {
                    Q(e.querySelectorAll(We), function (e) {
                        $t(r, n, a, e, s);
                    });
                }
            });
            n = te(n, i);
            return { errors: a, values: n };
        }
        function Zt(e, t, r) {
            if (e !== "") {
                e += "&";
            }
            if (String(r) === "[object Object]") {
                r = JSON.stringify(r);
            }
            var n = encodeURIComponent(r);
            e += encodeURIComponent(t) + "=" + n;
            return e;
        }
        function Kt(e) {
            var t = "";
            for (var r in e) {
                if (e.hasOwnProperty(r)) {
                    var n = e[r];
                    if (Array.isArray(n)) {
                        Q(n, function (e) {
                            t = Zt(t, r, e);
                        });
                    } else {
                        t = Zt(t, r, n);
                    }
                }
            }
            return t;
        }
        function Yt(e) {
            var t = new FormData();
            for (var r in e) {
                if (e.hasOwnProperty(r)) {
                    var n = e[r];
                    if (Array.isArray(n)) {
                        Q(n, function (e) {
                            t.append(r, e);
                        });
                    } else {
                        t.append(r, n);
                    }
                }
            }
            return t;
        }
        function Qt(e, t, r) {
            var n = {
                "HX-Request": "true",
                "HX-Trigger": $(e, "id"),
                "HX-Trigger-Name": $(e, "name"),
                "HX-Target": G(t, "id"),
                "HX-Current-URL": J().location.href,
            };
            or(e, "hx-headers", false, n);
            if (r !== undefined) {
                n["HX-Prompt"] = r;
            }
            if (Y(e).boosted) {
                n["HX-Boosted"] = "true";
            }
            return n;
        }
        function er(t, e) {
            var r = Z(e, "hx-params");
            if (r) {
                if (r === "none") {
                    return {};
                } else if (r === "*") {
                    return t;
                } else if (r.indexOf("not ") === 0) {
                    Q(r.substr(4).split(","), function (e) {
                        e = e.trim();
                        delete t[e];
                    });
                    return t;
                } else {
                    var n = {};
                    Q(r.split(","), function (e) {
                        e = e.trim();
                        n[e] = t[e];
                    });
                    return n;
                }
            } else {
                return t;
            }
        }
        function tr(e) {
            return $(e, "href") && $(e, "href").indexOf("#") >= 0;
        }
        function rr(e, t) {
            var r = t ? t : Z(e, "hx-swap");
            var n = {
                swapStyle: Y(e).boosted
                    ? "innerHTML"
                    : z.config.defaultSwapStyle,
                swapDelay: z.config.defaultSwapDelay,
                settleDelay: z.config.defaultSettleDelay,
            };
            if (Y(e).boosted && !tr(e)) {
                n["show"] = "top";
            }
            if (r) {
                var i = M(r);
                if (i.length > 0) {
                    n["swapStyle"] = i[0];
                    for (var a = 1; a < i.length; a++) {
                        var o = i[a];
                        if (o.indexOf("swap:") === 0) {
                            n["swapDelay"] = v(o.substr(5));
                        }
                        if (o.indexOf("settle:") === 0) {
                            n["settleDelay"] = v(o.substr(7));
                        }
                        if (o.indexOf("transition:") === 0) {
                            n["transition"] = o.substr(11) === "true";
                        }
                        if (o.indexOf("scroll:") === 0) {
                            var s = o.substr(7);
                            var l = s.split(":");
                            var u = l.pop();
                            var f = l.length > 0 ? l.join(":") : null;
                            n["scroll"] = u;
                            n["scrollTarget"] = f;
                        }
                        if (o.indexOf("show:") === 0) {
                            var c = o.substr(5);
                            var l = c.split(":");
                            var h = l.pop();
                            var f = l.length > 0 ? l.join(":") : null;
                            n["show"] = h;
                            n["showTarget"] = f;
                        }
                        if (o.indexOf("focus-scroll:") === 0) {
                            var d = o.substr("focus-scroll:".length);
                            n["focusScroll"] = d == "true";
                        }
                    }
                }
            }
            return n;
        }
        function nr(e) {
            return (
                Z(e, "hx-encoding") === "multipart/form-data" ||
                (h(e, "form") && $(e, "enctype") === "multipart/form-data")
            );
        }
        function ir(t, r, n) {
            var i = null;
            w(r, function (e) {
                if (i == null) {
                    i = e.encodeParameters(t, n, r);
                }
            });
            if (i != null) {
                return i;
            } else {
                if (nr(r)) {
                    return Yt(n);
                } else {
                    return Kt(n);
                }
            }
        }
        function S(e) {
            return { tasks: [], elts: [e] };
        }
        function ar(e, t) {
            var r = e[0];
            var n = e[e.length - 1];
            if (t.scroll) {
                var i = null;
                if (t.scrollTarget) {
                    i = re(r, t.scrollTarget);
                }
                if (t.scroll === "top" && (r || i)) {
                    i = i || r;
                    i.scrollTop = 0;
                }
                if (t.scroll === "bottom" && (n || i)) {
                    i = i || n;
                    i.scrollTop = i.scrollHeight;
                }
            }
            if (t.show) {
                var i = null;
                if (t.showTarget) {
                    var a = t.showTarget;
                    if (t.showTarget === "window") {
                        a = "body";
                    }
                    i = re(r, a);
                }
                if (t.show === "top" && (r || i)) {
                    i = i || r;
                    i.scrollIntoView({
                        block: "start",
                        behavior: z.config.scrollBehavior,
                    });
                }
                if (t.show === "bottom" && (n || i)) {
                    i = i || n;
                    i.scrollIntoView({
                        block: "end",
                        behavior: z.config.scrollBehavior,
                    });
                }
            }
        }
        function or(e, t, r, n) {
            if (n == null) {
                n = {};
            }
            if (e == null) {
                return n;
            }
            var i = G(e, t);
            if (i) {
                var a = i.trim();
                var o = r;
                if (a === "unset") {
                    return null;
                }
                if (a.indexOf("javascript:") === 0) {
                    a = a.substr(11);
                    o = true;
                } else if (a.indexOf("js:") === 0) {
                    a = a.substr(3);
                    o = true;
                }
                if (a.indexOf("{") !== 0) {
                    a = "{" + a + "}";
                }
                var s;
                if (o) {
                    s = sr(
                        e,
                        function () {
                            return Function("return (" + a + ")")();
                        },
                        {}
                    );
                } else {
                    s = y(a);
                }
                for (var l in s) {
                    if (s.hasOwnProperty(l)) {
                        if (n[l] == null) {
                            n[l] = s[l];
                        }
                    }
                }
            }
            return or(u(e), t, r, n);
        }
        function sr(e, t, r) {
            if (z.config.allowEval) {
                return t();
            } else {
                ne(e, "htmx:evalDisallowedError");
                return r;
            }
        }
        function lr(e, t) {
            return or(e, "hx-vars", true, t);
        }
        function ur(e, t) {
            return or(e, "hx-vals", false, t);
        }
        function fr(e) {
            return te(lr(e), ur(e));
        }
        function cr(t, r, n) {
            if (n !== null) {
                try {
                    t.setRequestHeader(r, n);
                } catch (e) {
                    t.setRequestHeader(r, encodeURIComponent(n));
                    t.setRequestHeader(r + "-URI-AutoEncoded", "true");
                }
            }
        }
        function hr(t) {
            if (t.responseURL && typeof URL !== "undefined") {
                try {
                    var e = new URL(t.responseURL);
                    return e.pathname + e.search;
                } catch (e) {
                    ne(J().body, "htmx:badResponseUrl", { url: t.responseURL });
                }
            }
        }
        function E(e, t) {
            return e.getAllResponseHeaders().match(t);
        }
        function dr(e, t, r) {
            e = e.toLowerCase();
            if (r) {
                if (r instanceof Element || A(r, "String")) {
                    return ae(e, t, null, null, {
                        targetOverride: s(r),
                        returnPromise: true,
                    });
                } else {
                    return ae(e, t, s(r.source), r.event, {
                        handler: r.handler,
                        headers: r.headers,
                        values: r.values,
                        targetOverride: s(r.target),
                        swapOverride: r.swap,
                        returnPromise: true,
                    });
                }
            } else {
                return ae(e, t, null, null, { returnPromise: true });
            }
        }
        function vr(e) {
            var t = [];
            while (e) {
                t.push(e);
                e = e.parentElement;
            }
            return t;
        }
        function ae(e, t, n, r, i, M) {
            var a = null;
            var o = null;
            i = i != null ? i : {};
            if (i.returnPromise && typeof Promise !== "undefined") {
                var s = new Promise(function (e, t) {
                    a = e;
                    o = t;
                });
            }
            if (n == null) {
                n = J().body;
            }
            var D = i.handler || pr;
            if (!ee(n)) {
                return;
            }
            var l = i.targetOverride || de(n);
            if (l == null || l == fe) {
                ne(n, "htmx:targetError", { target: G(n, "hx-target") });
                return;
            }
            if (!M) {
                var X = function () {
                    return ae(e, t, n, r, i, true);
                };
                var F = {
                    target: l,
                    elt: n,
                    path: t,
                    verb: e,
                    triggeringEvent: r,
                    etc: i,
                    issueRequest: X,
                };
                if (ie(n, "htmx:confirm", F) === false) {
                    return;
                }
            }
            var u = n;
            var f = Y(n);
            var c = Z(n, "hx-sync");
            var h = null;
            var d = false;
            if (c) {
                var v = c.split(":");
                var g = v[0].trim();
                if (g === "this") {
                    u = he(n, "hx-sync");
                } else {
                    u = re(n, g);
                }
                c = (v[1] || "drop").trim();
                f = Y(u);
                if (c === "drop" && f.xhr && f.abortable !== true) {
                    return;
                } else if (c === "abort") {
                    if (f.xhr) {
                        return;
                    } else {
                        d = true;
                    }
                } else if (c === "replace") {
                    ie(u, "htmx:abort");
                } else if (c.indexOf("queue") === 0) {
                    var B = c.split(" ");
                    h = (B[1] || "last").trim();
                }
            }
            if (f.xhr) {
                if (f.abortable) {
                    ie(u, "htmx:abort");
                } else {
                    if (h == null) {
                        if (r) {
                            var p = Y(r);
                            if (p && p.triggerSpec && p.triggerSpec.queue) {
                                h = p.triggerSpec.queue;
                            }
                        }
                        if (h == null) {
                            h = "last";
                        }
                    }
                    if (f.queuedRequests == null) {
                        f.queuedRequests = [];
                    }
                    if (h === "first" && f.queuedRequests.length === 0) {
                        f.queuedRequests.push(function () {
                            ae(e, t, n, r, i);
                        });
                    } else if (h === "all") {
                        f.queuedRequests.push(function () {
                            ae(e, t, n, r, i);
                        });
                    } else if (h === "last") {
                        f.queuedRequests = [];
                        f.queuedRequests.push(function () {
                            ae(e, t, n, r, i);
                        });
                    }
                    return;
                }
            }
            var m = new XMLHttpRequest();
            f.xhr = m;
            f.abortable = d;
            var x = function () {
                f.xhr = null;
                f.abortable = false;
                if (f.queuedRequests != null && f.queuedRequests.length > 0) {
                    var e = f.queuedRequests.shift();
                    e();
                }
            };
            var y = Z(n, "hx-prompt");
            if (y) {
                var b = prompt(y);
                if (
                    b === null ||
                    !ie(n, "htmx:prompt", { prompt: b, target: l })
                ) {
                    K(a);
                    x();
                    return s;
                }
            }
            var w = Z(n, "hx-confirm");
            if (w) {
                if (!confirm(w)) {
                    K(a);
                    x();
                    return s;
                }
            }
            var S = Qt(n, l, b);
            if (i.headers) {
                S = te(S, i.headers);
            }
            var E = Jt(n, e);
            var C = E.errors;
            var R = E.values;
            if (i.values) {
                R = te(R, i.values);
            }
            var j = fr(n);
            var O = te(R, j);
            var q = er(O, n);
            if (e !== "get" && !nr(n)) {
                S["Content-Type"] = "application/x-www-form-urlencoded";
            }
            if (z.config.getCacheBusterParam && e === "get") {
                q["org.htmx.cache-buster"] = $(l, "id") || "true";
            }
            if (t == null || t === "") {
                t = J().location.href;
            }
            var T = or(n, "hx-request");
            var H = Y(n).boosted;
            var L = {
                boosted: H,
                parameters: q,
                unfilteredParameters: O,
                headers: S,
                target: l,
                verb: e,
                errors: C,
                withCredentials:
                    i.credentials || T.credentials || z.config.withCredentials,
                timeout: i.timeout || T.timeout || z.config.timeout,
                path: t,
                triggeringEvent: r,
            };
            if (!ie(n, "htmx:configRequest", L)) {
                K(a);
                x();
                return s;
            }
            t = L.path;
            e = L.verb;
            S = L.headers;
            q = L.parameters;
            C = L.errors;
            if (C && C.length > 0) {
                ie(n, "htmx:validation:halted", L);
                K(a);
                x();
                return s;
            }
            var U = t.split("#");
            var V = U[0];
            var A = U[1];
            var N = null;
            if (e === "get") {
                N = V;
                var _ = Object.keys(q).length !== 0;
                if (_) {
                    if (N.indexOf("?") < 0) {
                        N += "?";
                    } else {
                        N += "&";
                    }
                    N += Kt(q);
                    if (A) {
                        N += "#" + A;
                    }
                }
                m.open("GET", N, true);
            } else {
                m.open(e.toUpperCase(), t, true);
            }
            m.overrideMimeType("text/html");
            m.withCredentials = L.withCredentials;
            m.timeout = L.timeout;
            if (T.noHeaders) {
            } else {
                for (var I in S) {
                    if (S.hasOwnProperty(I)) {
                        var W = S[I];
                        cr(m, I, W);
                    }
                }
            }
            var k = {
                xhr: m,
                target: l,
                requestConfig: L,
                etc: i,
                boosted: H,
                pathInfo: {
                    requestPath: t,
                    finalRequestPath: N || t,
                    anchor: A,
                },
            };
            m.onload = function () {
                try {
                    var e = vr(n);
                    k.pathInfo.responsePath = hr(m);
                    D(n, k);
                    _t(P);
                    ie(n, "htmx:afterRequest", k);
                    ie(n, "htmx:afterOnLoad", k);
                    if (!ee(n)) {
                        var t = null;
                        while (e.length > 0 && t == null) {
                            var r = e.shift();
                            if (ee(r)) {
                                t = r;
                            }
                        }
                        if (t) {
                            ie(t, "htmx:afterRequest", k);
                            ie(t, "htmx:afterOnLoad", k);
                        }
                    }
                    K(a);
                    x();
                } catch (e) {
                    ne(n, "htmx:onLoadError", te({ error: e }, k));
                    throw e;
                }
            };
            m.onerror = function () {
                _t(P);
                ne(n, "htmx:afterRequest", k);
                ne(n, "htmx:sendError", k);
                K(o);
                x();
            };
            m.onabort = function () {
                _t(P);
                ne(n, "htmx:afterRequest", k);
                ne(n, "htmx:sendAbort", k);
                K(o);
                x();
            };
            m.ontimeout = function () {
                _t(P);
                ne(n, "htmx:afterRequest", k);
                ne(n, "htmx:timeout", k);
                K(o);
                x();
            };
            if (!ie(n, "htmx:beforeRequest", k)) {
                K(a);
                x();
                return s;
            }
            var P = Vt(n);
            Q(["loadstart", "loadend", "progress", "abort"], function (t) {
                Q([m, m.upload], function (e) {
                    e.addEventListener(t, function (e) {
                        ie(n, "htmx:xhr:" + t, {
                            lengthComputable: e.lengthComputable,
                            loaded: e.loaded,
                            total: e.total,
                        });
                    });
                });
            });
            ie(n, "htmx:beforeSend", k);
            m.send(e === "get" ? null : ir(m, n, q));
            return s;
        }
        function gr(e, t) {
            var r = t.xhr;
            var n = null;
            var i = null;
            if (E(r, /HX-Push:/i)) {
                n = r.getResponseHeader("HX-Push");
                i = "push";
            } else if (E(r, /HX-Push-Url:/i)) {
                n = r.getResponseHeader("HX-Push-Url");
                i = "push";
            } else if (E(r, /HX-Replace-Url:/i)) {
                n = r.getResponseHeader("HX-Replace-Url");
                i = "replace";
            }
            if (n) {
                if (n === "false") {
                    return {};
                } else {
                    return { type: i, path: n };
                }
            }
            var a = t.pathInfo.finalRequestPath;
            var o = t.pathInfo.responsePath;
            var s = Z(e, "hx-push-url");
            var l = Z(e, "hx-replace-url");
            var u = Y(e).boosted;
            var f = null;
            var c = null;
            if (s) {
                f = "push";
                c = s;
            } else if (l) {
                f = "replace";
                c = l;
            } else if (u) {
                f = "push";
                c = o || a;
            }
            if (c) {
                if (c === "false") {
                    return {};
                }
                if (c === "true") {
                    c = o || a;
                }
                if (t.pathInfo.anchor && c.indexOf("#") === -1) {
                    c = c + "#" + t.pathInfo.anchor;
                }
                return { type: f, path: c };
            } else {
                return {};
            }
        }
        function pr(s, l) {
            var u = l.xhr;
            var f = l.target;
            var e = l.etc;
            if (!ie(s, "htmx:beforeOnLoad", l)) return;
            if (E(u, /HX-Trigger:/i)) {
                De(u, "HX-Trigger", s);
            }
            if (E(u, /HX-Location:/i)) {
                Dt();
                var t = u.getResponseHeader("HX-Location");
                var c;
                if (t.indexOf("{") === 0) {
                    c = y(t);
                    t = c["path"];
                    delete c["path"];
                }
                dr("GET", t, c).then(function () {
                    Xt(t);
                });
                return;
            }
            if (E(u, /HX-Redirect:/i)) {
                location.href = u.getResponseHeader("HX-Redirect");
                return;
            }
            if (E(u, /HX-Refresh:/i)) {
                if ("true" === u.getResponseHeader("HX-Refresh")) {
                    location.reload();
                    return;
                }
            }
            if (E(u, /HX-Retarget:/i)) {
                l.target = J().querySelector(
                    u.getResponseHeader("HX-Retarget")
                );
            }
            var h = gr(s, l);
            var r = u.status >= 200 && u.status < 400 && u.status !== 204;
            var d = u.response;
            var n = u.status >= 400;
            var i = te({ shouldSwap: r, serverResponse: d, isError: n }, l);
            if (!ie(f, "htmx:beforeSwap", i)) return;
            f = i.target;
            d = i.serverResponse;
            n = i.isError;
            l.target = f;
            l.failed = n;
            l.successful = !n;
            if (i.shouldSwap) {
                if (u.status === 286) {
                    $e(s);
                }
                w(s, function (e) {
                    d = e.transformResponse(d, u, s);
                });
                if (h.type) {
                    Dt();
                }
                var a = e.swapOverride;
                if (E(u, /HX-Reswap:/i)) {
                    a = u.getResponseHeader("HX-Reswap");
                }
                var c = rr(s, a);
                f.classList.add(z.config.swappingClass);
                var v = null;
                var g = null;
                var o = function () {
                    try {
                        var e = document.activeElement;
                        var t = {};
                        try {
                            t = {
                                elt: e,
                                start: e ? e.selectionStart : null,
                                end: e ? e.selectionEnd : null,
                            };
                        } catch (e) {}
                        var n = S(f);
                        Me(c.swapStyle, f, s, d, n);
                        if (t.elt && !ee(t.elt) && t.elt.id) {
                            var r = document.getElementById(t.elt.id);
                            var i = {
                                preventScroll:
                                    c.focusScroll !== undefined
                                        ? !c.focusScroll
                                        : !z.config.defaultFocusScroll,
                            };
                            if (r) {
                                if (t.start && r.setSelectionRange) {
                                    try {
                                        r.setSelectionRange(t.start, t.end);
                                    } catch (e) {}
                                }
                                r.focus(i);
                            }
                        }
                        f.classList.remove(z.config.swappingClass);
                        Q(n.elts, function (e) {
                            if (e.classList) {
                                e.classList.add(z.config.settlingClass);
                            }
                            ie(e, "htmx:afterSwap", l);
                        });
                        if (E(u, /HX-Trigger-After-Swap:/i)) {
                            var a = s;
                            if (!ee(s)) {
                                a = J().body;
                            }
                            De(u, "HX-Trigger-After-Swap", a);
                        }
                        var o = function () {
                            Q(n.tasks, function (e) {
                                e.call();
                            });
                            Q(n.elts, function (e) {
                                if (e.classList) {
                                    e.classList.remove(z.config.settlingClass);
                                }
                                ie(e, "htmx:afterSettle", l);
                            });
                            if (h.type) {
                                if (h.type === "push") {
                                    Xt(h.path);
                                    ie(J().body, "htmx:pushedIntoHistory", {
                                        path: h.path,
                                    });
                                } else {
                                    Ft(h.path);
                                    ie(J().body, "htmx:replacedInHistory", {
                                        path: h.path,
                                    });
                                }
                            }
                            if (l.pathInfo.anchor) {
                                var e = b("#" + l.pathInfo.anchor);
                                if (e) {
                                    e.scrollIntoView({
                                        block: "start",
                                        behavior: "auto",
                                    });
                                }
                            }
                            if (n.title) {
                                var t = b("title");
                                if (t) {
                                    t.innerHTML = n.title;
                                } else {
                                    window.document.title = n.title;
                                }
                            }
                            ar(n.elts, c);
                            if (E(u, /HX-Trigger-After-Settle:/i)) {
                                var r = s;
                                if (!ee(s)) {
                                    r = J().body;
                                }
                                De(u, "HX-Trigger-After-Settle", r);
                            }
                            K(v);
                        };
                        if (c.settleDelay > 0) {
                            setTimeout(o, c.settleDelay);
                        } else {
                            o();
                        }
                    } catch (e) {
                        ne(s, "htmx:swapError", l);
                        K(g);
                        throw e;
                    }
                };
                var p = z.config.globalViewTransitions;
                if (c.hasOwnProperty("transition")) {
                    p = c.transition;
                }
                if (
                    p &&
                    ie(s, "htmx:beforeTransition", l) &&
                    typeof Promise !== "undefined" &&
                    document.startViewTransition
                ) {
                    var m = new Promise(function (e, t) {
                        v = e;
                        g = t;
                    });
                    var x = o;
                    o = function () {
                        document.startViewTransition(function () {
                            x();
                            return m;
                        });
                    };
                }
                if (c.swapDelay > 0) {
                    setTimeout(o, c.swapDelay);
                } else {
                    o();
                }
            }
            if (n) {
                ne(
                    s,
                    "htmx:responseError",
                    te(
                        {
                            error:
                                "Response Status Error Code " +
                                u.status +
                                " from " +
                                l.pathInfo.requestPath,
                        },
                        l
                    )
                );
            }
        }
        var mr = {};
        function xr() {
            return {
                init: function (e) {
                    return null;
                },
                onEvent: function (e, t) {
                    return true;
                },
                transformResponse: function (e, t, r) {
                    return e;
                },
                isInlineSwap: function (e) {
                    return false;
                },
                handleSwap: function (e, t, r, n) {
                    return false;
                },
                encodeParameters: function (e, t, r) {
                    return null;
                },
            };
        }
        function yr(e, t) {
            if (t.init) {
                t.init(C);
            }
            mr[e] = te(xr(), t);
        }
        function br(e) {
            delete mr[e];
        }
        function wr(e, r, n) {
            if (e == undefined) {
                return r;
            }
            if (r == undefined) {
                r = [];
            }
            if (n == undefined) {
                n = [];
            }
            var t = G(e, "hx-ext");
            if (t) {
                Q(t.split(","), function (e) {
                    e = e.replace(/ /g, "");
                    if (e.slice(0, 7) == "ignore:") {
                        n.push(e.slice(7));
                        return;
                    }
                    if (n.indexOf(e) < 0) {
                        var t = mr[e];
                        if (t && r.indexOf(t) < 0) {
                            r.push(t);
                        }
                    }
                });
            }
            return wr(u(e), r, n);
        }
        function Sr(e) {
            if (J().readyState !== "loading") {
                e();
            } else {
                J().addEventListener("DOMContentLoaded", e);
            }
        }
        function Er() {
            if (z.config.includeIndicatorStyles !== false) {
                J().head.insertAdjacentHTML(
                    "beforeend",
                    "<style>                      ." +
                        z.config.indicatorClass +
                        "{opacity:0;transition: opacity 200ms ease-in;}                      ." +
                        z.config.requestClass +
                        " ." +
                        z.config.indicatorClass +
                        "{opacity:1}                      ." +
                        z.config.requestClass +
                        "." +
                        z.config.indicatorClass +
                        "{opacity:1}                    </style>"
                );
            }
        }
        function Cr() {
            var e = J().querySelector('meta[name="htmx-config"]');
            if (e) {
                return y(e.content);
            } else {
                return null;
            }
        }
        function Rr() {
            var e = Cr();
            if (e) {
                z.config = te(z.config, e);
            }
        }
        Sr(function () {
            Rr();
            Er();
            var e = J().body;
            Tt(e);
            var t = J().querySelectorAll(
                "[hx-trigger='restored'],[data-hx-trigger='restored']"
            );
            e.addEventListener("htmx:abort", function (e) {
                var t = e.target;
                var r = Y(t);
                if (r && r.xhr) {
                    r.xhr.abort();
                }
            });
            var r = window.onpopstate;
            window.onpopstate = function (e) {
                if (e.state && e.state.htmx) {
                    Ut();
                    Q(t, function (e) {
                        ie(e, "htmx:restored", {
                            document: J(),
                            triggerEvent: ie,
                        });
                    });
                } else {
                    if (r) {
                        r(e);
                    }
                }
            };
            setTimeout(function () {
                ie(e, "htmx:load", {});
                e = null;
            }, 0);
        });
        return z;
    })();
});
