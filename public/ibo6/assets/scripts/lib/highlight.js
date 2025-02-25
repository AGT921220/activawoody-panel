/*! highlight.js v9.18.5 | BSD3 License | git.io/hljslicense */
!(function (e) {
  var t =
    ("object" == typeof window && window) || ("object" == typeof self && self);
  "undefined" == typeof exports || exports.nodeType
    ? t &&
      ((t.hljs = e({})),
      "function" == typeof define &&
        define.amd &&
        define([], function () {
          return t.hljs;
        }))
    : e(exports);
})(function (a) {
  var w = !1,
    u = [],
    i = Object.keys,
    x = Object.create(null),
    c = Object.create(null),
    k = !0,
    t = /^(no-?highlight|plain|text)$/i,
    o = /\blang(?:uage)?-([\w-]+)\b/i,
    r = /((^(<[^>]+>|\t|)+|(?:\n)))/gm,
    n = {
      case_insensitive: "cI",
      lexemes: "l",
      contains: "c",
      keywords: "k",
      subLanguage: "sL",
      className: "cN",
      begin: "b",
      beginKeywords: "bK",
      end: "e",
      endsWithParent: "eW",
      illegal: "i",
      excludeBegin: "eB",
      excludeEnd: "eE",
      returnBegin: "rB",
      returnEnd: "rE",
      variants: "v",
      IDENT_RE: "IR",
      UNDERSCORE_IDENT_RE: "UIR",
      NUMBER_RE: "NR",
      C_NUMBER_RE: "CNR",
      BINARY_NUMBER_RE: "BNR",
      RE_STARTERS_RE: "RSR",
      BACKSLASH_ESCAPE: "BE",
      APOS_STRING_MODE: "ASM",
      QUOTE_STRING_MODE: "QSM",
      PHRASAL_WORDS_MODE: "PWM",
      C_LINE_COMMENT_MODE: "CLCM",
      C_BLOCK_COMMENT_MODE: "CBCM",
      HASH_COMMENT_MODE: "HCM",
      NUMBER_MODE: "NM",
      C_NUMBER_MODE: "CNM",
      BINARY_NUMBER_MODE: "BNM",
      CSS_NUMBER_MODE: "CSSNM",
      REGEXP_MODE: "RM",
      TITLE_MODE: "TM",
      UNDERSCORE_TITLE_MODE: "UTM",
      COMMENT: "C",
      beginRe: "bR",
      endRe: "eR",
      illegalRe: "iR",
      lexemesRe: "lR",
      terminators: "t",
      terminator_end: "tE",
    },
    E = "</span>",
    M =
      "Could not find the language '{}', did you forget to load/include a language module?",
    C = {
      hideUpgradeWarningAcceptNoSupportOrSecurityUpdates: !1,
      classPrefix: "hljs-",
      tabReplace: null,
      useBR: !1,
      languages: void 0,
    },
    s = "of and for in not or if then".split(" ");
  function R(e) {
    return e.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
  }
  function b(e) {
    return e.nodeName.toLowerCase();
  }
  function l(e) {
    return t.test(e);
  }
  function d(e) {
    var t,
      r = {},
      n = Array.prototype.slice.call(arguments, 1);
    for (t in e) r[t] = e[t];
    return (
      n.forEach(function (e) {
        for (t in e) r[t] = e[t];
      }),
      r
    );
  }
  function p(e) {
    var a = [];
    return (
      (function e(t, r) {
        for (var n = t.firstChild; n; n = n.nextSibling)
          3 === n.nodeType
            ? (r += n.nodeValue.length)
            : 1 === n.nodeType &&
              (a.push({ event: "start", offset: r, node: n }),
              (r = e(n, r)),
              b(n).match(/br|hr|img|input/) ||
                a.push({ event: "stop", offset: r, node: n }));
        return r;
      })(e, 0),
      a
    );
  }
  function f(e, t, r) {
    var n = 0,
      a = "",
      i = [];
    function s() {
      return e.length && t.length
        ? e[0].offset !== t[0].offset
          ? e[0].offset < t[0].offset
            ? e
            : t
          : "start" === t[0].event
          ? e
          : t
        : e.length
        ? e
        : t;
    }
    function c(e) {
      a +=
        "<" +
        b(e) +
        u.map
          .call(e.attributes, function (e) {
            return (
              " " + e.nodeName + '="' + R(e.value).replace(/"/g, "&quot;") + '"'
            );
          })
          .join("") +
        ">";
    }
    function o(e) {
      a += "</" + b(e) + ">";
    }
    function l(e) {
      ("start" === e.event ? c : o)(e.node);
    }
    for (; e.length || t.length; ) {
      var d = s();
      if (((a += R(r.substring(n, d[0].offset))), (n = d[0].offset), d === e)) {
        for (
          i.reverse().forEach(o);
          l(d.splice(0, 1)[0]),
            (d = s()) === e && d.length && d[0].offset === n;

        );
        i.reverse().forEach(c);
      } else
        "start" === d[0].event ? i.push(d[0].node) : i.pop(),
          l(d.splice(0, 1)[0]);
    }
    return a + R(r.substr(n));
  }
  function m(t) {
    return (
      t.v &&
        !t.cached_variants &&
        (t.cached_variants = t.v.map(function (e) {
          return d(t, { v: null }, e);
        })),
      t.cached_variants
        ? t.cached_variants
        : (function e(t) {
            return !!t && (t.eW || e(t.starts));
          })(t)
        ? [d(t, { starts: t.starts ? d(t.starts) : null })]
        : Object.isFrozen(t)
        ? [d(t)]
        : [t]
    );
  }
  function g(e) {
    if (n && !e.langApiRestored) {
      for (var t in ((e.langApiRestored = !0), n)) e[t] && (e[n[t]] = e[t]);
      (e.c || []).concat(e.v || []).forEach(g);
    }
  }
  function _(t, n) {
    var a = {};
    return (
      "string" == typeof t
        ? r("keyword", t)
        : i(t).forEach(function (e) {
            r(e, t[e]);
          }),
      a
    );
    function r(r, e) {
      n && (e = e.toLowerCase()),
        e.split(" ").forEach(function (e) {
          var t = e.split("|");
          a[t[0]] = [
            r,
            (function (e, t) {
              return t
                ? Number(t)
                : (function (e) {
                    return -1 != s.indexOf(e.toLowerCase());
                  })(e)
                ? 0
                : 1;
            })(t[0], t[1]),
          ];
        });
    }
  }
  function B(n) {
    function d(e) {
      return (e && e.source) || e;
    }
    function u(e, t) {
      return new RegExp(d(e), "m" + (n.cI ? "i" : "") + (t ? "g" : ""));
    }
    function a(a) {
      var i,
        e,
        s = {},
        c = [],
        o = {},
        r = 1;
      function t(e, t) {
        (s[r] = e),
          c.push([e, t]),
          (r +=
            (function (e) {
              return new RegExp(e.toString() + "|").exec("").length - 1;
            })(t) + 1);
      }
      for (var n = 0; n < a.c.length; n++) {
        t((e = a.c[n]), e.bK ? "\\.?(?:" + e.b + ")\\.?" : e.b);
      }
      a.tE && t("end", a.tE), a.i && t("illegal", a.i);
      var l = c.map(function (e) {
        return e[1];
      });
      return (
        (i = u(
          (function (e, t) {
            for (
              var r = /\[(?:[^\\\]]|\\.)*\]|\(\??|\\([1-9][0-9]*)|\\./,
                n = 0,
                a = "",
                i = 0;
              i < e.length;
              i++
            ) {
              var s = (n += 1),
                c = d(e[i]);
              for (0 < i && (a += t), a += "("; 0 < c.length; ) {
                var o = r.exec(c);
                if (null == o) {
                  a += c;
                  break;
                }
                (a += c.substring(0, o.index)),
                  (c = c.substring(o.index + o[0].length)),
                  "\\" == o[0][0] && o[1]
                    ? (a += "\\" + String(Number(o[1]) + s))
                    : ((a += o[0]), "(" == o[0] && n++);
              }
              a += ")";
            }
            return a;
          })(l, "|"),
          !0
        )),
        (o.lastIndex = 0),
        (o.exec = function (e) {
          var t;
          if (0 === c.length) return null;
          i.lastIndex = o.lastIndex;
          var r = i.exec(e);
          if (!r) return null;
          for (var n = 0; n < r.length; n++)
            if (null != r[n] && null != s["" + n]) {
              t = s["" + n];
              break;
            }
          return (
            "string" == typeof t
              ? ((r.type = t), (r.extra = [a.i, a.tE]))
              : ((r.type = "begin"), (r.rule = t)),
            r
          );
        }),
        o
      );
    }
    if (n.c && -1 != n.c.indexOf("self")) {
      if (!k)
        throw new Error(
          "ERR: contains `self` is not supported at the top-level of a language.  See documentation."
        );
      n.c = n.c.filter(function (e) {
        return "self" != e;
      });
    }
    !(function t(r, e) {
      r.compiled ||
        ((r.compiled = !0),
        (r.k = r.k || r.bK),
        r.k && (r.k = _(r.k, n.cI)),
        (r.lR = u(r.l || /\w+/, !0)),
        e &&
          (r.bK && (r.b = "\\b(" + r.bK.split(" ").join("|") + ")\\b"),
          r.b || (r.b = /\B|\b/),
          (r.bR = u(r.b)),
          r.endSameAsBegin && (r.e = r.b),
          r.e || r.eW || (r.e = /\B|\b/),
          r.e && (r.eR = u(r.e)),
          (r.tE = d(r.e) || ""),
          r.eW && e.tE && (r.tE += (r.e ? "|" : "") + e.tE)),
        r.i && (r.iR = u(r.i)),
        null == r.relevance && (r.relevance = 1),
        r.c || (r.c = []),
        (r.c = Array.prototype.concat.apply(
          [],
          r.c.map(function (e) {
            return m("self" === e ? r : e);
          })
        )),
        r.c.forEach(function (e) {
          t(e, r);
        }),
        r.starts && t(r.starts, e),
        (r.t = a(r)));
    })(n);
  }
  function S(t, e, a, r) {
    C.hideUpgradeWarningAcceptNoSupportOrSecurityUpdates ||
      ("object" == typeof process &&
        "object" == typeof process.env &&
        process.env.HLJS_HIDE_UPGRADE_WARNING) ||
      w ||
      ((w = !0), "");
    var i = e;
    function s(e, t) {
      if (
        (function (e, t) {
          var r = e && e.exec(t);
          return r && 0 === r.index;
        })(e.eR, t)
      ) {
        for (; e.endsParent && e.parent; ) e = e.parent;
        return e;
      }
      if (e.eW) return s(e.parent, t);
    }
    function c(e, t, r, n) {
      if (!r && "" === t) return "";
      if (!e) return t;
      var a = '<span class="' + (n ? "" : C.classPrefix);
      return (a += e + '">') + t + (r ? "" : E);
    }
    function o() {
      (g +=
        null != f.sL
          ? (function () {
              var e = "string" == typeof f.sL;
              if (e && !x[f.sL]) return R(_);
              var t = e
                ? S(f.sL, _, !0, m[f.sL])
                : A(_, f.sL.length ? f.sL : void 0);
              return (
                0 < f.relevance && (h += t.relevance),
                e && (m[f.sL] = t.top),
                c(t.language, t.value, !1, !0)
              );
            })()
          : (function () {
              var e, t, r, n, a, i, s;
              if (!f.k) return R(_);
              for (n = "", t = 0, f.lR.lastIndex = 0, r = f.lR.exec(_); r; )
                (n += R(_.substring(t, r.index))),
                  (a = f),
                  (i = r),
                  void 0,
                  (s = b.cI ? i[0].toLowerCase() : i[0]),
                  (e = a.k.hasOwnProperty(s) && a.k[s])
                    ? ((h += e[1]), (n += c(e[0], R(r[0]))))
                    : (n += R(r[0])),
                  (t = f.lR.lastIndex),
                  (r = f.lR.exec(_));
              return n + R(_.substr(t));
            })()),
        (_ = "");
    }
    function l(e) {
      (g += e.cN ? c(e.cN, "", !0) : ""),
        (f = Object.create(e, { parent: { value: f } }));
    }
    function d(e) {
      var t = e[0],
        r = e.rule;
      return (
        r &&
          r.endSameAsBegin &&
          (r.eR = (function (e) {
            return new RegExp(e.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$&"), "m");
          })(t)),
        r.skip ? (_ += t) : (r.eB && (_ += t), o(), r.rB || r.eB || (_ = t)),
        l(r),
        r.rB ? 0 : t.length
      );
    }
    var u = {};
    function n(e, t) {
      var r = t && t[0];
      if (((_ += e), null == r)) return o(), 0;
      if (
        "begin" == u.type &&
        "end" == t.type &&
        u.index == t.index &&
        "" === r
      )
        return (_ += i.slice(t.index, t.index + 1)), 1;
      if ("illegal" === u.type && "" === r)
        return (_ += i.slice(t.index, t.index + 1)), 1;
      if ("begin" === (u = t).type) return d(t);
      if ("illegal" === t.type && !a)
        throw new Error(
          'Illegal lexeme "' + r + '" for mode "' + (f.cN || "<unnamed>") + '"'
        );
      if ("end" === t.type) {
        var n = (function (e) {
          var t = e[0],
            r = i.substr(e.index),
            n = s(f, r);
          if (n) {
            var a = f;
            for (
              a.skip
                ? (_ += t)
                : (a.rE || a.eE || (_ += t), o(), a.eE && (_ = t));
              f.cN && (g += E),
                f.skip || f.sL || (h += f.relevance),
                (f = f.parent) !== n.parent;

            );
            return (
              n.starts &&
                (n.endSameAsBegin && (n.starts.eR = n.eR), l(n.starts)),
              a.rE ? 0 : t.length
            );
          }
        })(t);
        if (null != n) return n;
      }
      return (_ += r), r.length;
    }
    var b = L(t);
    if (!b)
      throw (
        (console.error(M.replace("{}", t)),
        new Error('Unknown language: "' + t + '"'))
      );
    B(b);
    var p,
      f = r || b,
      m = {},
      g = "";
    for (p = f; p !== b; p = p.parent) p.cN && (g = c(p.cN, "", !0) + g);
    var _ = "",
      h = 0;
    try {
      for (var v, y, N = 0; (f.t.lastIndex = N), (v = f.t.exec(i)); )
        (y = n(i.substring(N, v.index), v)), (N = v.index + y);
      for (n(i.substr(N)), p = f; p.parent; p = p.parent) p.cN && (g += E);
      return { relevance: h, value: g, i: !1, language: t, top: f };
    } catch (e) {
      if (e.message && -1 !== e.message.indexOf("Illegal"))
        return { i: !0, relevance: 0, value: R(i) };
      if (k)
        return {
          relevance: 0,
          value: R(i),
          language: t,
          top: f,
          errorRaised: e,
        };
      throw e;
    }
  }
  function A(r, e) {
    e = e || C.languages || i(x);
    var n = { relevance: 0, value: R(r) },
      a = n;
    return (
      e
        .filter(L)
        .filter(I)
        .forEach(function (e) {
          var t = S(e, r, !1);
          (t.language = e),
            t.relevance > a.relevance && (a = t),
            t.relevance > n.relevance && ((a = n), (n = t));
        }),
      a.language && (n.second_best = a),
      n
    );
  }
  function h(e) {
    return C.tabReplace || C.useBR
      ? e.replace(r, function (e, t) {
          return C.useBR && "\n" === e
            ? "<br>"
            : C.tabReplace
            ? t.replace(/\t/g, C.tabReplace)
            : "";
        })
      : e;
  }
  function v(e) {
    var t,
      r,
      n,
      a,
      i,
      s = (function (e) {
        var t,
          r,
          n,
          a,
          i = e.className + " ";
        if (
          ((i += e.parentNode ? e.parentNode.className : ""), (r = o.exec(i)))
        ) {
          var s = L(r[1]);
          return (
            s ||
              (console.warn(M.replace("{}", r[1])),
              console.warn(
                "Falling back to no-highlight mode for this block.",
                e
              )),
            s ? r[1] : "no-highlight"
          );
        }
        for (t = 0, n = (i = i.split(/\s+/)).length; t < n; t++)
          if (l((a = i[t])) || L(a)) return a;
      })(e);
    l(s) ||
      (C.useBR
        ? ((t = document.createElement("div")).innerHTML = e.innerHTML
            .replace(/\n/g, "")
            .replace(/<br[ \/]*>/g, "\n"))
        : (t = e),
      (i = t.textContent),
      (n = s ? S(s, i, !0) : A(i)),
      (r = p(t)).length &&
        (((a = document.createElement("div")).innerHTML = n.value),
        (n.value = f(r, p(a), i))),
      (n.value = h(n.value)),
      (e.innerHTML = n.value),
      (e.className = (function (e, t, r) {
        var n = t ? c[t] : r,
          a = [e.trim()];
        return (
          e.match(/\bhljs\b/) || a.push("hljs"),
          -1 === e.indexOf(n) && a.push(n),
          a.join(" ").trim()
        );
      })(e.className, s, n.language)),
      (e.result = { language: n.language, re: n.relevance }),
      n.second_best &&
        (e.second_best = {
          language: n.second_best.language,
          re: n.second_best.relevance,
        }));
  }
  function y() {
    if (!y.called) {
      y.called = !0;
      var e = document.querySelectorAll("pre code");
      u.forEach.call(e, v);
    }
  }
  var N = { disableAutodetect: !0 };
  function L(e) {
    return (e = (e || "").toLowerCase()), x[e] || x[c[e]];
  }
  function I(e) {
    var t = L(e);
    return t && !t.disableAutodetect;
  }
  return (
    (a.highlight = S),
    (a.highlightAuto = A),
    (a.fixMarkup = h),
    (a.highlightBlock = v),
    (a.configure = function (e) {
      C = d(C, e);
    }),
    (a.initHighlighting = y),
    (a.initHighlightingOnLoad = function () {
      window.addEventListener("DOMContentLoaded", y, !1),
        window.addEventListener("load", y, !1);
    }),
    (a.registerLanguage = function (t, e) {
      var r;
      try {
        r = e(a);
      } catch (e) {
        if (
          (console.error(
            "Language definition for '{}' could not be registered.".replace(
              "{}",
              t
            )
          ),
          !k)
        )
          throw e;
        console.error(e), (r = N);
      }
      g((x[t] = r)),
        (r.rawDefinition = e.bind(null, a)),
        r.aliases &&
          r.aliases.forEach(function (e) {
            c[e] = t;
          });
    }),
    (a.listLanguages = function () {
      return i(x);
    }),
    (a.getLanguage = L),
    (a.requireLanguage = function (e) {
      var t = L(e);
      if (t) return t;
      throw new Error(
        "The '{}' language is required, but not loaded.".replace("{}", e)
      );
    }),
    (a.autoDetection = I),
    (a.inherit = d),
    (a.debugMode = function () {
      k = !1;
    }),
    (a.IR = a.IDENT_RE = "[a-zA-Z]\\w*"),
    (a.UIR = a.UNDERSCORE_IDENT_RE = "[a-zA-Z_]\\w*"),
    (a.NR = a.NUMBER_RE = "\\b\\d+(\\.\\d+)?"),
    (a.CNR = a.C_NUMBER_RE =
      "(-?)(\\b0[xX][a-fA-F0-9]+|(\\b\\d+(\\.\\d*)?|\\.\\d+)([eE][-+]?\\d+)?)"),
    (a.BNR = a.BINARY_NUMBER_RE = "\\b(0b[01]+)"),
    (a.RSR = a.RE_STARTERS_RE =
      "!|!=|!==|%|%=|&|&&|&=|\\*|\\*=|\\+|\\+=|,|-|-=|/=|/|:|;|<<|<<=|<=|<|===|==|=|>>>=|>>=|>=|>>>|>>|>|\\?|\\[|\\{|\\(|\\^|\\^=|\\||\\|=|\\|\\||~"),
    (a.BE = a.BACKSLASH_ESCAPE = { b: "\\\\[\\s\\S]", relevance: 0 }),
    (a.ASM = a.APOS_STRING_MODE =
      { cN: "string", b: "'", e: "'", i: "\\n", c: [a.BE] }),
    (a.QSM = a.QUOTE_STRING_MODE =
      { cN: "string", b: '"', e: '"', i: "\\n", c: [a.BE] }),
    (a.PWM = a.PHRASAL_WORDS_MODE =
      {
        b: /\b(a|an|the|are|I'm|isn't|don't|doesn't|won't|but|just|should|pretty|simply|enough|gonna|going|wtf|so|such|will|you|your|they|like|more)\b/,
      }),
    (a.C = a.COMMENT =
      function (e, t, r) {
        var n = a.inherit({ cN: "comment", b: e, e: t, c: [] }, r || {});
        return (
          n.c.push(a.PWM),
          n.c.push({
            cN: "doctag",
            b: "(?:TODO|FIXME|NOTE|BUG|XXX):",
            relevance: 0,
          }),
          n
        );
      }),
    (a.CLCM = a.C_LINE_COMMENT_MODE = a.C("//", "$")),
    (a.CBCM = a.C_BLOCK_COMMENT_MODE = a.C("/\\*", "\\*/")),
    (a.HCM = a.HASH_COMMENT_MODE = a.C("#", "$")),
    (a.NM = a.NUMBER_MODE = { cN: "number", b: a.NR, relevance: 0 }),
    (a.CNM = a.C_NUMBER_MODE = { cN: "number", b: a.CNR, relevance: 0 }),
    (a.BNM = a.BINARY_NUMBER_MODE = { cN: "number", b: a.BNR, relevance: 0 }),
    (a.CSSNM = a.CSS_NUMBER_MODE =
      {
        cN: "number",
        b:
          a.NR +
          "(%|em|ex|ch|rem|vw|vh|vmin|vmax|cm|mm|in|pt|pc|px|deg|grad|rad|turn|s|ms|Hz|kHz|dpi|dpcm|dppx)?",
        relevance: 0,
      }),
    (a.RM = a.REGEXP_MODE =
      {
        cN: "regexp",
        b: /\//,
        e: /\/[gimuy]*/,
        i: /\n/,
        c: [a.BE, { b: /\[/, e: /\]/, relevance: 0, c: [a.BE] }],
      }),
    (a.TM = a.TITLE_MODE = { cN: "title", b: a.IR, relevance: 0 }),
    (a.UTM = a.UNDERSCORE_TITLE_MODE = { cN: "title", b: a.UIR, relevance: 0 }),
    (a.METHOD_GUARD = { b: "\\.\\s*" + a.UIR, relevance: 0 }),
    [
      a.BE,
      a.ASM,
      a.QSM,
      a.PWM,
      a.C,
      a.CLCM,
      a.CBCM,
      a.HCM,
      a.NM,
      a.CNM,
      a.BNM,
      a.CSSNM,
      a.RM,
      a.TM,
      a.UTM,
      a.METHOD_GUARD,
    ].forEach(function (e) {
      !(function t(r) {
        Object.freeze(r);
        var n = "function" == typeof r;
        Object.getOwnPropertyNames(r).forEach(function (e) {
          !r.hasOwnProperty(e) ||
            null === r[e] ||
            ("object" != typeof r[e] && "function" != typeof r[e]) ||
            (n && ("caller" === e || "callee" === e || "arguments" === e)) ||
            Object.isFrozen(r[e]) ||
            t(r[e]);
        });
        return r;
      })(e);
    }),
    a.registerLanguage("apache", function (e) {
      var t = { cN: "number", b: "[\\$%]\\d+" };
      return {
        aliases: ["apacheconf"],
        cI: !0,
        c: [
          e.HCM,
          { cN: "section", b: "</?", e: ">" },
          {
            cN: "attribute",
            b: /\w+/,
            relevance: 0,
            k: {
              nomarkup:
                "order deny allow setenv rewriterule rewriteengine rewritecond documentroot sethandler errordocument loadmodule options header listen serverroot servername",
            },
            starts: {
              e: /$/,
              relevance: 0,
              k: { literal: "on off all" },
              c: [
                { cN: "meta", b: "\\s\\[", e: "\\]$" },
                { cN: "variable", b: "[\\$%]\\{", e: "\\}", c: ["self", t] },
                t,
                e.QSM,
              ],
            },
          },
        ],
        i: /\S/,
      };
    }),
    a.registerLanguage("bash", function (e) {
      var t = {
          cN: "variable",
          v: [{ b: /\$[\w\d#@][\w\d_]*/ }, { b: /\$\{(.*?)}/ }],
        },
        r = {
          cN: "string",
          b: /"/,
          e: /"/,
          c: [e.BE, t, { cN: "variable", b: /\$\(/, e: /\)/, c: [e.BE] }],
        };
      return {
        aliases: ["sh", "zsh"],
        l: /\b-?[a-z\._]+\b/,
        k: {
          keyword:
            "if then else elif fi for while in do done case esac function",
          literal: "true false",
          built_in:
            "break cd continue eval exec exit export getopts hash pwd readonly return shift test times trap umask unset alias bind builtin caller command declare echo enable help let local logout mapfile printf read readarray source type typeset ulimit unalias set shopt autoload bg bindkey bye cap chdir clone comparguments compcall compctl compdescribe compfiles compgroups compquote comptags comptry compvalues dirs disable disown echotc echoti emulate fc fg float functions getcap getln history integer jobs kill limit log noglob popd print pushd pushln rehash sched setcap setopt stat suspend ttyctl unfunction unhash unlimit unsetopt vared wait whence where which zcompile zformat zftp zle zmodload zparseopts zprof zpty zregexparse zsocket zstyle ztcp",
          _: "-ne -eq -lt -gt -f -d -e -s -l -a",
        },
        c: [
          { cN: "meta", b: /^#![^\n]+sh\s*$/, relevance: 10 },
          {
            cN: "function",
            b: /\w[\w\d_]*\s*\(\s*\)\s*\{/,
            rB: !0,
            c: [e.inherit(e.TM, { b: /\w[\w\d_]*/ })],
            relevance: 0,
          },
          e.HCM,
          r,
          { cN: "", b: /\\"/ },
          { cN: "string", b: /'/, e: /'/ },
          t,
        ],
      };
    }),
    a.registerLanguage("coffeescript", function (e) {
      var t = {
          keyword:
            "in if for while finally new do return else break catch instanceof throw try this switch continue typeof delete debugger super yield import export from as default await then unless until loop of by when and or is isnt not",
          literal: "true false null undefined yes no on off",
          built_in: "npm require console print module global window document",
        },
        r = "[A-Za-z$_][0-9A-Za-z$_]*",
        n = { cN: "subst", b: /#\{/, e: /}/, k: t },
        a = [
          e.BNM,
          e.inherit(e.CNM, { starts: { e: "(\\s*/)?", relevance: 0 } }),
          {
            cN: "string",
            v: [
              { b: /'''/, e: /'''/, c: [e.BE] },
              { b: /'/, e: /'/, c: [e.BE] },
              { b: /"""/, e: /"""/, c: [e.BE, n] },
              { b: /"/, e: /"/, c: [e.BE, n] },
            ],
          },
          {
            cN: "regexp",
            v: [
              { b: "///", e: "///", c: [n, e.HCM] },
              { b: "//[gim]{0,3}(?=\\W)", relevance: 0 },
              { b: /\/(?![ *]).*?(?![\\]).\/[gim]{0,3}(?=\W)/ },
            ],
          },
          { b: "@" + r },
          {
            sL: "javascript",
            eB: !0,
            eE: !0,
            v: [
              { b: "```", e: "```" },
              { b: "`", e: "`" },
            ],
          },
        ];
      n.c = a;
      var i = e.inherit(e.TM, { b: r }),
        s = "(\\(.*\\))?\\s*\\B[-=]>",
        c = {
          cN: "params",
          b: "\\([^\\(]",
          rB: !0,
          c: [{ b: /\(/, e: /\)/, k: t, c: ["self"].concat(a) }],
        };
      return {
        aliases: ["coffee", "cson", "iced"],
        k: t,
        i: /\/\*/,
        c: a.concat([
          e.C("###", "###"),
          e.HCM,
          {
            cN: "function",
            b: "^\\s*" + r + "\\s*=\\s*" + s,
            e: "[-=]>",
            rB: !0,
            c: [i, c],
          },
          {
            b: /[:\(,=]\s*/,
            relevance: 0,
            c: [{ cN: "function", b: s, e: "[-=]>", rB: !0, c: [c] }],
          },
          {
            cN: "class",
            bK: "class",
            e: "$",
            i: /[:="\[\]]/,
            c: [{ bK: "extends", eW: !0, i: /[:="\[\]]/, c: [i] }, i],
          },
          { b: r + ":", e: ":", rB: !0, rE: !0, relevance: 0 },
        ]),
      };
    }),
    a.registerLanguage("cpp", function (e) {
      function t(e) {
        return "(?:" + e + ")?";
      }
      var r = "decltype\\(auto\\)",
        n = "[a-zA-Z_]\\w*::",
        a = "(" + r + "|" + t(n) + "[a-zA-Z_]\\w*" + t("<.*?>") + ")",
        i = { cN: "keyword", b: "\\b[a-z\\d_]*_t\\b" },
        s = {
          cN: "string",
          v: [
            { b: '(u8?|U|L)?"', e: '"', i: "\\n", c: [e.BE] },
            {
              b: "(u8?|U|L)?'(\\\\(x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4,8}|[0-7]{3}|\\S)|.)",
              e: "'",
              i: ".",
            },
            { b: /(?:u8?|U|L)?R"([^()\\ ]{0,16})\((?:.|\n)*?\)\1"/ },
          ],
        },
        c = {
          cN: "number",
          v: [
            { b: "\\b(0b[01']+)" },
            {
              b: "(-?)\\b([\\d']+(\\.[\\d']*)?|\\.[\\d']+)(u|U|l|L|ul|UL|f|F|b|B)",
            },
            {
              b: "(-?)(\\b0[xX][a-fA-F0-9']+|(\\b[\\d']+(\\.[\\d']*)?|\\.[\\d']+)([eE][-+]?[\\d']+)?)",
            },
          ],
          relevance: 0,
        },
        o = {
          cN: "meta",
          b: /#\s*[a-z]+\b/,
          e: /$/,
          k: {
            "meta-keyword":
              "if else elif endif define undef warning error line pragma _Pragma ifdef ifndef include",
          },
          c: [
            { b: /\\\n/, relevance: 0 },
            e.inherit(s, { cN: "meta-string" }),
            { cN: "meta-string", b: /<.*?>/, e: /$/, i: "\\n" },
            e.CLCM,
            e.CBCM,
          ],
        },
        l = { cN: "title", b: t(n) + e.IR, relevance: 0 },
        d = t(n) + e.IR + "\\s*\\(",
        u = {
          keyword:
            "int float while private char char8_t char16_t char32_t catch import module export virtual operator sizeof dynamic_cast|10 typedef const_cast|10 const for static_cast|10 union namespace unsigned long volatile static protected bool template mutable if public friend do goto auto void enum else break extern using asm case typeid wchar_tshort reinterpret_cast|10 default double register explicit signed typename try this switch continue inline delete alignas alignof constexpr consteval constinit decltype concept co_await co_return co_yield requires noexcept static_assert thread_local restrict final override atomic_bool atomic_char atomic_schar atomic_uchar atomic_short atomic_ushort atomic_int atomic_uint atomic_long atomic_ulong atomic_llong atomic_ullong new throw return and and_eq bitand bitor compl not not_eq or or_eq xor xor_eq",
          built_in:
            "std string wstring cin cout cerr clog stdin stdout stderr stringstream istringstream ostringstream auto_ptr deque list queue stack vector map set bitset multiset multimap unordered_set unordered_map unordered_multiset unordered_multimap array shared_ptr abort terminate abs acos asin atan2 atan calloc ceil cosh cos exit exp fabs floor fmod fprintf fputs free frexp fscanf future isalnum isalpha iscntrl isdigit isgraph islower isprint ispunct isspace isupper isxdigit tolower toupper labs ldexp log10 log malloc realloc memchr memcmp memcpy memset modf pow printf putchar puts scanf sinh sin snprintf sprintf sqrt sscanf strcat strchr strcmp strcpy strcspn strlen strncat strncmp strncpy strpbrk strrchr strspn strstr tanh tan vfprintf vprintf vsprintf endl initializer_list unique_ptr _Bool complex _Complex imaginary _Imaginary",
          literal: "true false nullptr NULL",
        },
        b = [i, e.CLCM, e.CBCM, c, s],
        p = {
          v: [
            { b: /=/, e: /;/ },
            { b: /\(/, e: /\)/ },
            { bK: "new throw return else", e: /;/ },
          ],
          k: u,
          c: b.concat([
            { b: /\(/, e: /\)/, k: u, c: b.concat(["self"]), relevance: 0 },
          ]),
          relevance: 0,
        },
        f = {
          cN: "function",
          b: "(" + a + "[\\*&\\s]+)+" + d,
          rB: !0,
          e: /[{;=]/,
          eE: !0,
          k: u,
          i: /[^\w\s\*&:<>]/,
          c: [
            { b: r, k: u, relevance: 0 },
            { b: d, rB: !0, c: [l], relevance: 0 },
            {
              cN: "params",
              b: /\(/,
              e: /\)/,
              k: u,
              relevance: 0,
              c: [
                e.CLCM,
                e.CBCM,
                s,
                c,
                i,
                {
                  b: /\(/,
                  e: /\)/,
                  k: u,
                  relevance: 0,
                  c: ["self", e.CLCM, e.CBCM, s, c, i],
                },
              ],
            },
            i,
            e.CLCM,
            e.CBCM,
            o,
          ],
        };
      return {
        aliases: ["c", "cc", "h", "c++", "h++", "hpp", "hh", "hxx", "cxx"],
        k: u,
        i: "</",
        c: [].concat(p, f, b, [
          o,
          {
            b: "\\b(deque|list|queue|stack|vector|map|set|bitset|multiset|multimap|unordered_map|unordered_set|unordered_multiset|unordered_multimap|array)\\s*<",
            e: ">",
            k: u,
            c: ["self", i],
          },
          { b: e.IR + "::", k: u },
          {
            cN: "class",
            bK: "class struct",
            e: /[{;:]/,
            c: [{ b: /</, e: />/, c: ["self"] }, e.TM],
          },
        ]),
        exports: { preprocessor: o, strings: s, k: u },
      };
    }),
    a.registerLanguage("cs", function (e) {
      var t = {
          keyword:
            "abstract as base bool break byte case catch char checked const continue decimal default delegate do double enum event explicit extern finally fixed float for foreach goto if implicit in int interface internal is lock long object operator out override params private protected public readonly ref sbyte sealed short sizeof stackalloc static string struct switch this try typeof uint ulong unchecked unsafe ushort using virtual void volatile while add alias ascending async await by descending dynamic equals from get global group into join let nameof on orderby partial remove select set value var when where yield",
          literal: "null false true",
        },
        r = {
          cN: "number",
          v: [
            { b: "\\b(0b[01']+)" },
            {
              b: "(-?)\\b([\\d']+(\\.[\\d']*)?|\\.[\\d']+)(u|U|l|L|ul|UL|f|F|b|B)",
            },
            {
              b: "(-?)(\\b0[xX][a-fA-F0-9']+|(\\b[\\d']+(\\.[\\d']*)?|\\.[\\d']+)([eE][-+]?[\\d']+)?)",
            },
          ],
          relevance: 0,
        },
        n = { cN: "string", b: '@"', e: '"', c: [{ b: '""' }] },
        a = e.inherit(n, { i: /\n/ }),
        i = { cN: "subst", b: "{", e: "}", k: t },
        s = e.inherit(i, { i: /\n/ }),
        c = {
          cN: "string",
          b: /\$"/,
          e: '"',
          i: /\n/,
          c: [{ b: "{{" }, { b: "}}" }, e.BE, s],
        },
        o = {
          cN: "string",
          b: /\$@"/,
          e: '"',
          c: [{ b: "{{" }, { b: "}}" }, { b: '""' }, i],
        },
        l = e.inherit(o, {
          i: /\n/,
          c: [{ b: "{{" }, { b: "}}" }, { b: '""' }, s],
        });
      (i.c = [o, c, n, e.ASM, e.QSM, r, e.CBCM]),
        (s.c = [l, c, a, e.ASM, e.QSM, r, e.inherit(e.CBCM, { i: /\n/ })]);
      var d = { v: [o, c, n, e.ASM, e.QSM] },
        u = e.IR + "(<" + e.IR + "(\\s*,\\s*" + e.IR + ")*>)?(\\[\\])?";
      return {
        aliases: ["csharp", "c#"],
        k: t,
        i: /::/,
        c: [
          e.C("///", "$", {
            rB: !0,
            c: [
              {
                cN: "doctag",
                v: [
                  { b: "///", relevance: 0 },
                  { b: "\x3c!--|--\x3e" },
                  { b: "</?", e: ">" },
                ],
              },
            ],
          }),
          e.CLCM,
          e.CBCM,
          {
            cN: "meta",
            b: "#",
            e: "$",
            k: {
              "meta-keyword":
                "if else elif endif define undef warning error line region endregion pragma checksum",
            },
          },
          d,
          r,
          {
            bK: "class interface",
            e: /[{;=]/,
            i: /[^\s:,]/,
            c: [e.TM, e.CLCM, e.CBCM],
          },
          {
            bK: "namespace",
            e: /[{;=]/,
            i: /[^\s:]/,
            c: [e.inherit(e.TM, { b: "[a-zA-Z](\\.?\\w)*" }), e.CLCM, e.CBCM],
          },
          {
            cN: "meta",
            b: "^\\s*\\[",
            eB: !0,
            e: "\\]",
            eE: !0,
            c: [{ cN: "meta-string", b: /"/, e: /"/ }],
          },
          { bK: "new return throw await else", relevance: 0 },
          {
            cN: "function",
            b: "(" + u + "\\s+)+" + e.IR + "\\s*\\(",
            rB: !0,
            e: /\s*[{;=]/,
            eE: !0,
            k: t,
            c: [
              { b: e.IR + "\\s*\\(", rB: !0, c: [e.TM], relevance: 0 },
              {
                cN: "params",
                b: /\(/,
                e: /\)/,
                eB: !0,
                eE: !0,
                k: t,
                relevance: 0,
                c: [d, r, e.CBCM],
              },
              e.CLCM,
              e.CBCM,
            ],
          },
        ],
      };
    }),
    a.registerLanguage("css", function (e) {
      var t = {
        b: /(?:[A-Z\_\.\-]+|--[a-zA-Z0-9_-]+)\s*:/,
        rB: !0,
        e: ";",
        eW: !0,
        c: [
          {
            cN: "attribute",
            b: /\S/,
            e: ":",
            eE: !0,
            starts: {
              eW: !0,
              eE: !0,
              c: [
                {
                  b: /[\w-]+\(/,
                  rB: !0,
                  c: [
                    { cN: "built_in", b: /[\w-]+/ },
                    { b: /\(/, e: /\)/, c: [e.ASM, e.QSM, e.CSSNM] },
                  ],
                },
                e.CSSNM,
                e.QSM,
                e.ASM,
                e.CBCM,
                { cN: "number", b: "#[0-9A-Fa-f]+" },
                { cN: "meta", b: "!important" },
              ],
            },
          },
        ],
      };
      return {
        cI: !0,
        i: /[=\/|'\$]/,
        c: [
          e.CBCM,
          { cN: "selector-id", b: /#[A-Za-z0-9_-]+/ },
          { cN: "selector-class", b: /\.[A-Za-z0-9_-]+/ },
          { cN: "selector-attr", b: /\[/, e: /\]/, i: "$", c: [e.ASM, e.QSM] },
          { cN: "selector-pseudo", b: /:(:)?[a-zA-Z0-9\_\-\+\(\)"'.]+/ },
          { b: "@(page|font-face)", l: "@[a-z-]+", k: "@page @font-face" },
          {
            b: "@",
            e: "[{;]",
            i: /:/,
            rB: !0,
            c: [
              { cN: "keyword", b: /@\-?\w[\w]*(\-\w+)*/ },
              {
                b: /\s/,
                eW: !0,
                eE: !0,
                relevance: 0,
                k: "and or not only",
                c: [{ b: /[a-z-]+:/, cN: "attribute" }, e.ASM, e.QSM, e.CSSNM],
              },
            ],
          },
          { cN: "selector-tag", b: "[a-zA-Z-][a-zA-Z0-9_-]*", relevance: 0 },
          { b: "{", e: "}", i: /\S/, c: [e.CBCM, t] },
        ],
      };
    }),
    a.registerLanguage("diff", function (e) {
      return {
        aliases: ["patch"],
        c: [
          {
            cN: "meta",
            relevance: 10,
            v: [
              { b: /^@@ +\-\d+,\d+ +\+\d+,\d+ +@@$/ },
              { b: /^\*\*\* +\d+,\d+ +\*\*\*\*$/ },
              { b: /^\-\-\- +\d+,\d+ +\-\-\-\-$/ },
            ],
          },
          {
            cN: "comment",
            v: [
              { b: /Index: /, e: /$/ },
              { b: /={3,}/, e: /$/ },
              { b: /^\-{3}/, e: /$/ },
              { b: /^\*{3} /, e: /$/ },
              { b: /^\+{3}/, e: /$/ },
              { b: /^\*{15}$/ },
            ],
          },
          { cN: "addition", b: "^\\+", e: "$" },
          { cN: "deletion", b: "^\\-", e: "$" },
          { cN: "addition", b: "^\\!", e: "$" },
        ],
      };
    }),
    a.registerLanguage("go", function (e) {
      var t = {
        keyword:
          "break default func interface select case map struct chan else goto package switch const fallthrough if range type continue for import return var go defer bool byte complex64 complex128 float32 float64 int8 int16 int32 int64 string uint8 uint16 uint32 uint64 int uint uintptr rune",
        literal: "true false iota nil",
        built_in:
          "append cap close complex copy imag len make new panic print println real recover delete",
      };
      return {
        aliases: ["golang"],
        k: t,
        i: "</",
        c: [
          e.CLCM,
          e.CBCM,
          { cN: "string", v: [e.QSM, e.ASM, { b: "`", e: "`" }] },
          { cN: "number", v: [{ b: e.CNR + "[i]", relevance: 1 }, e.CNM] },
          { b: /:=/ },
          {
            cN: "function",
            bK: "func",
            e: "\\s*(\\{|$)",
            eE: !0,
            c: [e.TM, { cN: "params", b: /\(/, e: /\)/, k: t, i: /["']/ }],
          },
        ],
      };
    }),
    a.registerLanguage("http", function (e) {
      var t = "HTTP/[0-9\\.]+";
      return {
        aliases: ["https"],
        i: "\\S",
        c: [
          { b: "^" + t, e: "$", c: [{ cN: "number", b: "\\b\\d{3}\\b" }] },
          {
            b: "^[A-Z]+ (.*?) " + t + "$",
            rB: !0,
            e: "$",
            c: [
              { cN: "string", b: " ", e: " ", eB: !0, eE: !0 },
              { b: t },
              { cN: "keyword", b: "[A-Z]+" },
            ],
          },
          {
            cN: "attribute",
            b: "^\\w",
            e: ": ",
            eE: !0,
            i: "\\n|\\s|=",
            starts: { e: "$", relevance: 0 },
          },
          { b: "\\n\\n", starts: { sL: [], eW: !0 } },
        ],
      };
    }),
    a.registerLanguage("ini", function (e) {
      var t = {
          cN: "number",
          relevance: 0,
          v: [{ b: /([\+\-]+)?[\d]+_[\d_]+/ }, { b: e.NR }],
        },
        r = e.C();
      r.v = [
        { b: /;/, e: /$/ },
        { b: /#/, e: /$/ },
      ];
      var n = {
          cN: "variable",
          v: [{ b: /\$[\w\d"][\w\d_]*/ }, { b: /\$\{(.*?)}/ }],
        },
        a = { cN: "literal", b: /\bon|off|true|false|yes|no\b/ },
        i = {
          cN: "string",
          c: [e.BE],
          v: [
            { b: "'''", e: "'''", relevance: 10 },
            { b: '"""', e: '"""', relevance: 10 },
            { b: '"', e: '"' },
            { b: "'", e: "'" },
          ],
        };
      return {
        aliases: ["toml"],
        cI: !0,
        i: /\S/,
        c: [
          r,
          { cN: "section", b: /\[+/, e: /\]+/ },
          {
            b: /^[a-z0-9\[\]_\.-]+(?=\s*=\s*)/,
            cN: "attr",
            starts: {
              e: /$/,
              c: [
                r,
                { b: /\[/, e: /\]/, c: [r, a, n, i, t, "self"], relevance: 0 },
                a,
                n,
                i,
                t,
              ],
            },
          },
        ],
      };
    }),
    a.registerLanguage("java", function (e) {
      var t =
          "false synchronized int abstract float private char boolean var static null if const for true while long strictfp finally protected import native final void enum else break transient catch instanceof byte super volatile case assert short package default double public try this switch continue throws protected public private module requires exports do",
        r = {
          cN: "number",
          b: "\\b(0[bB]([01]+[01_]+[01]+|[01]+)|0[xX]([a-fA-F0-9]+[a-fA-F0-9_]+[a-fA-F0-9]+|[a-fA-F0-9]+)|(([\\d]+[\\d_]+[\\d]+|[\\d]+)(\\.([\\d]+[\\d_]+[\\d]+|[\\d]+))?|\\.([\\d]+[\\d_]+[\\d]+|[\\d]+))([eE][-+]?\\d+)?)[lLfF]?",
          relevance: 0,
        };
      return {
        aliases: ["jsp"],
        k: t,
        i: /<\/|#/,
        c: [
          e.C("/\\*\\*", "\\*/", {
            relevance: 0,
            c: [
              { b: /\w+@/, relevance: 0 },
              { cN: "doctag", b: "@[A-Za-z]+" },
            ],
          }),
          e.CLCM,
          e.CBCM,
          e.ASM,
          e.QSM,
          {
            cN: "class",
            bK: "class interface",
            e: /[{;=]/,
            eE: !0,
            k: "class interface",
            i: /[:"\[\]]/,
            c: [{ bK: "extends implements" }, e.UTM],
          },
          { bK: "new throw return else", relevance: 0 },
          {
            cN: "function",
            b:
              "([À-ʸa-zA-Z_$][À-ʸa-zA-Z_$0-9]*(<[À-ʸa-zA-Z_$][À-ʸa-zA-Z_$0-9]*(\\s*,\\s*[À-ʸa-zA-Z_$][À-ʸa-zA-Z_$0-9]*)*>)?\\s+)+" +
              e.UIR +
              "\\s*\\(",
            rB: !0,
            e: /[{;=]/,
            eE: !0,
            k: t,
            c: [
              { b: e.UIR + "\\s*\\(", rB: !0, relevance: 0, c: [e.UTM] },
              {
                cN: "params",
                b: /\(/,
                e: /\)/,
                k: t,
                relevance: 0,
                c: [e.ASM, e.QSM, e.CNM, e.CBCM],
              },
              e.CLCM,
              e.CBCM,
            ],
          },
          r,
          { cN: "meta", b: "@[A-Za-z]+" },
        ],
      };
    }),
    a.registerLanguage("javascript", function (e) {
      var t = "<>",
        r = "</>",
        n = { b: /<[A-Za-z0-9\\._:-]+/, e: /\/[A-Za-z0-9\\._:-]+>|\/>/ },
        a = "[A-Za-z$_][0-9A-Za-z$_]*",
        i = {
          keyword:
            "in of if for while finally var new function do return void else break catch instanceof with throw case default try this switch continue typeof delete let yield const export super debugger as async await static import from as",
          literal: "true false null undefined NaN Infinity",
          built_in:
            "eval isFinite isNaN parseFloat parseInt decodeURI decodeURIComponent encodeURI encodeURIComponent escape unescape Object Function Boolean Error EvalError InternalError RangeError ReferenceError StopIteration SyntaxError TypeError URIError Number Math Date String RegExp Array Float32Array Float64Array Int16Array Int32Array Int8Array Uint16Array Uint32Array Uint8Array Uint8ClampedArray ArrayBuffer DataView JSON Intl arguments require module console window document Symbol Set Map WeakSet WeakMap Proxy Reflect Promise",
        },
        s = {
          cN: "number",
          v: [
            { b: "\\b(0[bB][01]+)n?" },
            { b: "\\b(0[oO][0-7]+)n?" },
            { b: e.CNR + "n?" },
          ],
          relevance: 0,
        },
        c = { cN: "subst", b: "\\$\\{", e: "\\}", k: i, c: [] },
        o = {
          b: "html`",
          e: "",
          starts: { e: "`", rE: !1, c: [e.BE, c], sL: "xml" },
        },
        l = {
          b: "css`",
          e: "",
          starts: { e: "`", rE: !1, c: [e.BE, c], sL: "css" },
        },
        d = { cN: "string", b: "`", e: "`", c: [e.BE, c] };
      c.c = [e.ASM, e.QSM, o, l, d, s, e.RM];
      var u = c.c.concat([e.CBCM, e.CLCM]);
      return {
        aliases: ["js", "jsx", "mjs", "cjs"],
        k: i,
        c: [
          { cN: "meta", relevance: 10, b: /^\s*['"]use (strict|asm)['"]/ },
          { cN: "meta", b: /^#!/, e: /$/ },
          e.ASM,
          e.QSM,
          o,
          l,
          d,
          e.CLCM,
          e.C("/\\*\\*", "\\*/", {
            relevance: 0,
            c: [
              {
                cN: "doctag",
                b: "@[A-Za-z]+",
                c: [
                  { cN: "type", b: "\\{", e: "\\}", relevance: 0 },
                  {
                    cN: "variable",
                    b: a + "(?=\\s*(-)|$)",
                    endsParent: !0,
                    relevance: 0,
                  },
                  { b: /(?=[^\n])\s/, relevance: 0 },
                ],
              },
            ],
          }),
          e.CBCM,
          s,
          {
            b: /[{,\n]\s*/,
            relevance: 0,
            c: [
              {
                b: a + "\\s*:",
                rB: !0,
                relevance: 0,
                c: [{ cN: "attr", b: a, relevance: 0 }],
              },
            ],
          },
          {
            b: "(" + e.RSR + "|\\b(case|return|throw)\\b)\\s*",
            k: "return throw case",
            c: [
              e.CLCM,
              e.CBCM,
              e.RM,
              {
                cN: "function",
                b: "(\\(.*?\\)|" + a + ")\\s*=>",
                rB: !0,
                e: "\\s*=>",
                c: [
                  {
                    cN: "params",
                    v: [
                      { b: a },
                      { b: /\(\s*\)/ },
                      { b: /\(/, e: /\)/, eB: !0, eE: !0, k: i, c: u },
                    ],
                  },
                ],
              },
              { cN: "", b: /\s/, e: /\s*/, skip: !0 },
              {
                v: [
                  { b: t, e: r },
                  { b: n.b, e: n.e },
                ],
                sL: "xml",
                c: [{ b: n.b, e: n.e, skip: !0, c: ["self"] }],
              },
            ],
            relevance: 0,
          },
          {
            cN: "function",
            bK: "function",
            e: /\{/,
            eE: !0,
            c: [
              e.inherit(e.TM, { b: a }),
              { cN: "params", b: /\(/, e: /\)/, eB: !0, eE: !0, c: u },
            ],
            i: /\[|%/,
          },
          { b: /\$[(.]/ },
          e.METHOD_GUARD,
          {
            cN: "class",
            bK: "class",
            e: /[{;=]/,
            eE: !0,
            i: /[:"\[\]]/,
            c: [{ bK: "extends" }, e.UTM],
          },
          { bK: "constructor get set", e: /\{/, eE: !0 },
        ],
        i: /#(?!!)/,
      };
    }),
    a.registerLanguage("json", function (e) {
      var t = { literal: "true false null" },
        r = [e.CLCM, e.CBCM],
        n = [e.QSM, e.CNM],
        a = { e: ",", eW: !0, eE: !0, c: n, k: t },
        i = {
          b: "{",
          e: "}",
          c: [
            { cN: "attr", b: /"/, e: /"/, c: [e.BE], i: "\\n" },
            e.inherit(a, { b: /:/ }),
          ].concat(r),
          i: "\\S",
        },
        s = { b: "\\[", e: "\\]", c: [e.inherit(a)], i: "\\S" };
      return (
        n.push(i, s),
        r.forEach(function (e) {
          n.push(e);
        }),
        { c: n, k: t, i: "\\S" }
      );
    }),
    a.registerLanguage("kotlin", function (e) {
      var t = {
          keyword:
            "abstract as val var vararg get set class object open private protected public noinline crossinline dynamic final enum if else do while for when throw try catch finally import package is in fun override companion reified inline lateinit init interface annotation data sealed internal infix operator out by constructor super tailrec where const inner suspend typealias external expect actual trait volatile transient native default",
          built_in:
            "Byte Short Char Int Long Boolean Float Double Void Unit Nothing",
          literal: "true false null",
        },
        r = { cN: "symbol", b: e.UIR + "@" },
        n = { cN: "subst", b: "\\${", e: "}", c: [e.CNM] },
        a = { cN: "variable", b: "\\$" + e.UIR },
        i = {
          cN: "string",
          v: [
            { b: '"""', e: '"""(?=[^"])', c: [a, n] },
            { b: "'", e: "'", i: /\n/, c: [e.BE] },
            { b: '"', e: '"', i: /\n/, c: [e.BE, a, n] },
          ],
        };
      n.c.push(i);
      var s = {
          cN: "meta",
          b:
            "@(?:file|property|field|get|set|receiver|param|setparam|delegate)\\s*:(?:\\s*" +
            e.UIR +
            ")?",
        },
        c = {
          cN: "meta",
          b: "@" + e.UIR,
          c: [{ b: /\(/, e: /\)/, c: [e.inherit(i, { cN: "meta-string" })] }],
        },
        o = {
          cN: "number",
          b: "\\b(0[bB]([01]+[01_]+[01]+|[01]+)|0[xX]([a-fA-F0-9]+[a-fA-F0-9_]+[a-fA-F0-9]+|[a-fA-F0-9]+)|(([\\d]+[\\d_]+[\\d]+|[\\d]+)(\\.([\\d]+[\\d_]+[\\d]+|[\\d]+))?|\\.([\\d]+[\\d_]+[\\d]+|[\\d]+))([eE][-+]?\\d+)?)[lLfF]?",
          relevance: 0,
        },
        l = e.C("/\\*", "\\*/", { c: [e.CBCM] }),
        d = {
          v: [
            { cN: "type", b: e.UIR },
            { b: /\(/, e: /\)/, c: [] },
          ],
        },
        u = d;
      return (
        (u.v[1].c = [d]),
        (d.v[1].c = [u]),
        {
          aliases: ["kt"],
          k: t,
          c: [
            e.C("/\\*\\*", "\\*/", {
              relevance: 0,
              c: [{ cN: "doctag", b: "@[A-Za-z]+" }],
            }),
            e.CLCM,
            l,
            {
              cN: "keyword",
              b: /\b(break|continue|return|this)\b/,
              starts: { c: [{ cN: "symbol", b: /@\w+/ }] },
            },
            r,
            s,
            c,
            {
              cN: "function",
              bK: "fun",
              e: "[(]|$",
              rB: !0,
              eE: !0,
              k: t,
              i: /fun\s+(<.*>)?[^\s\(]+(\s+[^\s\(]+)\s*=/,
              relevance: 5,
              c: [
                { b: e.UIR + "\\s*\\(", rB: !0, relevance: 0, c: [e.UTM] },
                { cN: "type", b: /</, e: />/, k: "reified", relevance: 0 },
                {
                  cN: "params",
                  b: /\(/,
                  e: /\)/,
                  endsParent: !0,
                  k: t,
                  relevance: 0,
                  c: [
                    {
                      b: /:/,
                      e: /[=,\/]/,
                      eW: !0,
                      c: [d, e.CLCM, l],
                      relevance: 0,
                    },
                    e.CLCM,
                    l,
                    s,
                    c,
                    i,
                    e.CNM,
                  ],
                },
                l,
              ],
            },
            {
              cN: "class",
              bK: "class interface trait",
              e: /[:\{(]|$/,
              eE: !0,
              i: "extends implements",
              c: [
                { bK: "public protected internal private constructor" },
                e.UTM,
                { cN: "type", b: /</, e: />/, eB: !0, eE: !0, relevance: 0 },
                { cN: "type", b: /[,:]\s*/, e: /[<\(,]|$/, eB: !0, rE: !0 },
                s,
                c,
              ],
            },
            i,
            { cN: "meta", b: "^#!/usr/bin/env", e: "$", i: "\n" },
            o,
          ],
        }
      );
    }),
    a.registerLanguage("less", function (e) {
      function t(e) {
        return { cN: "string", b: "~?" + e + ".*?" + e };
      }
      function r(e, t, r) {
        return { cN: e, b: t, relevance: r };
      }
      var n = "[\\w-]+",
        a = "(" + n + "|@{" + n + "})",
        i = [],
        s = [],
        c = { b: "\\(", e: "\\)", c: s, relevance: 0 };
      s.push(
        e.CLCM,
        e.CBCM,
        t("'"),
        t('"'),
        e.CSSNM,
        {
          b: "(url|data-uri)\\(",
          starts: { cN: "string", e: "[\\)\\n]", eE: !0 },
        },
        r("number", "#[0-9A-Fa-f]+\\b"),
        c,
        r("variable", "@@?" + n, 10),
        r("variable", "@{" + n + "}"),
        r("built_in", "~?`[^`]*?`"),
        { cN: "attribute", b: n + "\\s*:", e: ":", rB: !0, eE: !0 },
        { cN: "meta", b: "!important" }
      );
      var o = s.concat({ b: "{", e: "}", c: i }),
        l = { bK: "when", eW: !0, c: [{ bK: "and not" }].concat(s) },
        d = {
          b: a + "\\s*:",
          rB: !0,
          e: "[;}]",
          relevance: 0,
          c: [
            {
              cN: "attribute",
              b: a,
              e: ":",
              eE: !0,
              starts: { eW: !0, i: "[<=$]", relevance: 0, c: s },
            },
          ],
        },
        u = {
          cN: "keyword",
          b: "@(import|media|charset|font-face|(-[a-z]+-)?keyframes|supports|document|namespace|page|viewport|host)\\b",
          starts: { e: "[;{}]", rE: !0, c: s, relevance: 0 },
        },
        b = {
          cN: "variable",
          v: [{ b: "@" + n + "\\s*:", relevance: 15 }, { b: "@" + n }],
          starts: { e: "[;}]", rE: !0, c: o },
        },
        p = {
          v: [
            { b: "[\\.#:&\\[>]", e: "[;{}]" },
            { b: a, e: "{" },
          ],
          rB: !0,
          rE: !0,
          i: "[<='$\"]",
          relevance: 0,
          c: [
            e.CLCM,
            e.CBCM,
            l,
            r("keyword", "all\\b"),
            r("variable", "@{" + n + "}"),
            r("selector-tag", a + "%?", 0),
            r("selector-id", "#" + a),
            r("selector-class", "\\." + a, 0),
            r("selector-tag", "&", 0),
            { cN: "selector-attr", b: "\\[", e: "\\]" },
            { cN: "selector-pseudo", b: /:(:)?[a-zA-Z0-9\_\-\+\(\)"'.]+/ },
            { b: "\\(", e: "\\)", c: o },
            { b: "!important" },
          ],
        };
      return (
        i.push(e.CLCM, e.CBCM, u, b, d, p), { cI: !0, i: "[=>'/<($\"]", c: i }
      );
    }),
    a.registerLanguage("lua", function (e) {
      var t = "\\[=*\\[",
        r = "\\]=*\\]",
        n = { b: t, e: r, c: ["self"] },
        a = [
          e.C("--(?!" + t + ")", "$"),
          e.C("--" + t, r, { c: [n], relevance: 10 }),
        ];
      return {
        l: e.UIR,
        k: {
          literal: "true false nil",
          keyword:
            "and break do else elseif end for goto if in local not or repeat return then until while",
          built_in:
            "_G _ENV _VERSION __index __newindex __mode __call __metatable __tostring __len __gc __add __sub __mul __div __mod __pow __concat __unm __eq __lt __le assert collectgarbage dofile error getfenv getmetatable ipairs load loadfile loadstringmodule next pairs pcall print rawequal rawget rawset require select setfenvsetmetatable tonumber tostring type unpack xpcall arg selfcoroutine resume yield status wrap create running debug getupvalue debug sethook getmetatable gethook setmetatable setlocal traceback setfenv getinfo setupvalue getlocal getregistry getfenv io lines write close flush open output type read stderr stdin input stdout popen tmpfile math log max acos huge ldexp pi cos tanh pow deg tan cosh sinh random randomseed frexp ceil floor rad abs sqrt modf asin min mod fmod log10 atan2 exp sin atan os exit setlocale date getenv difftime remove time clock tmpname rename execute package preload loadlib loaded loaders cpath config path seeall string sub upper len gfind rep find match char dump gmatch reverse byte format gsub lower table setn insert getn foreachi maxn foreach concat sort remove",
        },
        c: a.concat([
          {
            cN: "function",
            bK: "function",
            e: "\\)",
            c: [
              e.inherit(e.TM, {
                b: "([_a-zA-Z]\\w*\\.)*([_a-zA-Z]\\w*:)?[_a-zA-Z]\\w*",
              }),
              { cN: "params", b: "\\(", eW: !0, c: a },
            ].concat(a),
          },
          e.CNM,
          e.ASM,
          e.QSM,
          { cN: "string", b: t, e: r, c: [n], relevance: 5 },
        ]),
      };
    }),
    a.registerLanguage("makefile", function (e) {
      var t = {
          cN: "variable",
          v: [
            { b: "\\$\\(" + e.UIR + "\\)", c: [e.BE] },
            { b: /\$[@%<?\^\+\*]/ },
          ],
        },
        r = { cN: "string", b: /"/, e: /"/, c: [e.BE, t] },
        n = {
          cN: "variable",
          b: /\$\([\w-]+\s/,
          e: /\)/,
          k: {
            built_in:
              "subst patsubst strip findstring filter filter-out sort word wordlist firstword lastword dir notdir suffix basename addsuffix addprefix join wildcard realpath abspath error warning shell origin flavor foreach if or and call eval file value",
          },
          c: [t],
        },
        a = { b: "^" + e.UIR + "\\s*(?=[:+?]?=)" },
        i = { cN: "section", b: /^[^\s]+:/, e: /$/, c: [t] };
      return {
        aliases: ["mk", "mak"],
        k: "define endef undefine ifdef ifndef ifeq ifneq else endif include -include sinclude override export unexport private vpath",
        l: /[\w-]+/,
        c: [
          e.HCM,
          t,
          r,
          n,
          a,
          {
            cN: "meta",
            b: /^\.PHONY:/,
            e: /$/,
            k: { "meta-keyword": ".PHONY" },
            l: /[\.\w]+/,
          },
          i,
        ],
      };
    }),
    a.registerLanguage("xml", function (e) {
      var t = { cN: "symbol", b: "&[a-z]+;|&#[0-9]+;|&#x[a-f0-9]+;" },
        r = {
          b: "\\s",
          c: [{ cN: "meta-keyword", b: "#?[a-z_][a-z1-9_-]+", i: "\\n" }],
        },
        n = e.inherit(r, { b: "\\(", e: "\\)" }),
        a = e.inherit(e.ASM, { cN: "meta-string" }),
        i = e.inherit(e.QSM, { cN: "meta-string" }),
        s = {
          eW: !0,
          i: /</,
          relevance: 0,
          c: [
            { cN: "attr", b: "[A-Za-z0-9\\._:-]+", relevance: 0 },
            {
              b: /=\s*/,
              relevance: 0,
              c: [
                {
                  cN: "string",
                  endsParent: !0,
                  v: [
                    { b: /"/, e: /"/, c: [t] },
                    { b: /'/, e: /'/, c: [t] },
                    { b: /[^\s"'=<>`]+/ },
                  ],
                },
              ],
            },
          ],
        };
      return {
        aliases: [
          "html",
          "xhtml",
          "rss",
          "atom",
          "xjb",
          "xsd",
          "xsl",
          "plist",
          "wsf",
          "svg",
        ],
        cI: !0,
        c: [
          {
            cN: "meta",
            b: "<![a-z]",
            e: ">",
            relevance: 10,
            c: [
              r,
              i,
              a,
              n,
              {
                b: "\\[",
                e: "\\]",
                c: [{ cN: "meta", b: "<![a-z]", e: ">", c: [r, n, i, a] }],
              },
            ],
          },
          e.C("\x3c!--", "--\x3e", { relevance: 10 }),
          { b: "<\\!\\[CDATA\\[", e: "\\]\\]>", relevance: 10 },
          t,
          { cN: "meta", b: /<\?xml/, e: /\?>/, relevance: 10 },
          {
            b: /<\?(php)?/,
            e: /\?>/,
            sL: "php",
            c: [
              { b: "/\\*", e: "\\*/", skip: !0 },
              { b: 'b"', e: '"', skip: !0 },
              { b: "b'", e: "'", skip: !0 },
              e.inherit(e.ASM, { i: null, cN: null, c: null, skip: !0 }),
              e.inherit(e.QSM, { i: null, cN: null, c: null, skip: !0 }),
            ],
          },
          {
            cN: "tag",
            b: "<style(?=\\s|>)",
            e: ">",
            k: { name: "style" },
            c: [s],
            starts: { e: "</style>", rE: !0, sL: ["css", "xml"] },
          },
          {
            cN: "tag",
            b: "<script(?=\\s|>)",
            e: ">",
            k: { name: "script" },
            c: [s],
            starts: {
              e: "</script>",
              rE: !0,
              sL: ["actionscript", "javascript", "handlebars", "xml"],
            },
          },
          {
            cN: "tag",
            b: "</?",
            e: "/?>",
            c: [{ cN: "name", b: /[^\/><\s]+/, relevance: 0 }, s],
          },
        ],
      };
    }),
    a.registerLanguage("markdown", function (e) {
      return {
        aliases: ["md", "mkdown", "mkd"],
        c: [
          {
            cN: "section",
            v: [{ b: "^#{1,6}", e: "$" }, { b: "^.+?\\n[=-]{2,}$" }],
          },
          { b: "<", e: ">", sL: "xml", relevance: 0 },
          { cN: "bullet", b: "^\\s*([*+-]|(\\d+\\.))\\s+" },
          { cN: "strong", b: "[*_]{2}.+?[*_]{2}" },
          {
            cN: "emphasis",
            v: [{ b: "\\*.+?\\*" }, { b: "_.+?_", relevance: 0 }],
          },
          { cN: "quote", b: "^>\\s+", e: "$" },
          {
            cN: "code",
            v: [
              { b: "^```\\w*\\s*$", e: "^```[ ]*$" },
              { b: "`.+?`" },
              { b: "^( {4}|\\t)", e: "$", relevance: 0 },
            ],
          },
          { b: "^[-\\*]{3,}", e: "$" },
          {
            b: "\\[.+?\\][\\(\\[].*?[\\)\\]]",
            rB: !0,
            c: [
              {
                cN: "string",
                b: "\\[",
                e: "\\]",
                eB: !0,
                rE: !0,
                relevance: 0,
              },
              { cN: "link", b: "\\]\\(", e: "\\)", eB: !0, eE: !0 },
              { cN: "symbol", b: "\\]\\[", e: "\\]", eB: !0, eE: !0 },
            ],
            relevance: 10,
          },
          {
            b: /^\[[^\n]+\]:/,
            rB: !0,
            c: [
              { cN: "symbol", b: /\[/, e: /\]/, eB: !0, eE: !0 },
              { cN: "link", b: /:\s*/, e: /$/, eB: !0 },
            ],
          },
        ],
      };
    }),
    a.registerLanguage("nginx", function (e) {
      var t = {
          cN: "variable",
          v: [{ b: /\$\d+/ }, { b: /\$\{/, e: /}/ }, { b: "[\\$\\@]" + e.UIR }],
        },
        r = {
          eW: !0,
          l: "[a-z/_]+",
          k: {
            literal:
              "on off yes no true false none blocked debug info notice warn error crit select break last permanent redirect kqueue rtsig epoll poll /dev/poll",
          },
          relevance: 0,
          i: "=>",
          c: [
            e.HCM,
            {
              cN: "string",
              c: [e.BE, t],
              v: [
                { b: /"/, e: /"/ },
                { b: /'/, e: /'/ },
              ],
            },
            { b: "([a-z]+):/", e: "\\s", eW: !0, eE: !0, c: [t] },
            {
              cN: "regexp",
              c: [e.BE, t],
              v: [
                { b: "\\s\\^", e: "\\s|{|;", rE: !0 },
                { b: "~\\*?\\s+", e: "\\s|{|;", rE: !0 },
                { b: "\\*(\\.[a-z\\-]+)+" },
                { b: "([a-z\\-]+\\.)+\\*" },
              ],
            },
            {
              cN: "number",
              b: "\\b\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3}(:\\d{1,5})?\\b",
            },
            { cN: "number", b: "\\b\\d+[kKmMgGdshdwy]*\\b", relevance: 0 },
            t,
          ],
        };
      return {
        aliases: ["nginxconf"],
        c: [
          e.HCM,
          {
            b: e.UIR + "\\s+{",
            rB: !0,
            e: "{",
            c: [{ cN: "section", b: e.UIR }],
            relevance: 0,
          },
          {
            b: e.UIR + "\\s",
            e: ";|{",
            rB: !0,
            c: [{ cN: "attribute", b: e.UIR, starts: r }],
            relevance: 0,
          },
        ],
        i: "[^\\s\\}]",
      };
    }),
    a.registerLanguage("objectivec", function (e) {
      var t = /[a-zA-Z@][a-zA-Z0-9_]*/,
        r = "@interface @class @protocol @implementation";
      return {
        aliases: ["mm", "objc", "obj-c"],
        k: {
          keyword:
            "int float while char export sizeof typedef const struct for union unsigned long volatile static bool mutable if do return goto void enum else break extern asm case short default double register explicit signed typename this switch continue wchar_t inline readonly assign readwrite self @synchronized id typeof nonatomic super unichar IBOutlet IBAction strong weak copy in out inout bycopy byref oneway __strong __weak __block __autoreleasing @private @protected @public @try @property @end @throw @catch @finally @autoreleasepool @synthesize @dynamic @selector @optional @required @encode @package @import @defs @compatibility_alias __bridge __bridge_transfer __bridge_retained __bridge_retain __covariant __contravariant __kindof _Nonnull _Nullable _Null_unspecified __FUNCTION__ __PRETTY_FUNCTION__ __attribute__ getter setter retain unsafe_unretained nonnull nullable null_unspecified null_resettable class instancetype NS_DESIGNATED_INITIALIZER NS_UNAVAILABLE NS_REQUIRES_SUPER NS_RETURNS_INNER_POINTER NS_INLINE NS_AVAILABLE NS_DEPRECATED NS_ENUM NS_OPTIONS NS_SWIFT_UNAVAILABLE NS_ASSUME_NONNULL_BEGIN NS_ASSUME_NONNULL_END NS_REFINED_FOR_SWIFT NS_SWIFT_NAME NS_SWIFT_NOTHROW NS_DURING NS_HANDLER NS_ENDHANDLER NS_VALUERETURN NS_VOIDRETURN",
          literal: "false true FALSE TRUE nil YES NO NULL",
          built_in:
            "BOOL dispatch_once_t dispatch_queue_t dispatch_sync dispatch_async dispatch_once",
        },
        l: t,
        i: "</",
        c: [
          {
            cN: "built_in",
            b: "\\b(AV|CA|CF|CG|CI|CL|CM|CN|CT|MK|MP|MTK|MTL|NS|SCN|SK|UI|WK|XC)\\w+",
          },
          e.CLCM,
          e.CBCM,
          e.CNM,
          e.QSM,
          e.ASM,
          { cN: "string", v: [{ b: '@"', e: '"', i: "\\n", c: [e.BE] }] },
          {
            cN: "meta",
            b: /#\s*[a-z]+\b/,
            e: /$/,
            k: {
              "meta-keyword":
                "if else elif endif define undef warning error line pragma ifdef ifndef include",
            },
            c: [
              { b: /\\\n/, relevance: 0 },
              e.inherit(e.QSM, { cN: "meta-string" }),
              { cN: "meta-string", b: /<.*?>/, e: /$/, i: "\\n" },
              e.CLCM,
              e.CBCM,
            ],
          },
          {
            cN: "class",
            b: "(" + r.split(" ").join("|") + ")\\b",
            e: "({|$)",
            eE: !0,
            k: r,
            l: t,
            c: [e.UTM],
          },
          { b: "\\." + e.UIR, relevance: 0 },
        ],
      };
    }),
    a.registerLanguage("perl", function (e) {
      var t =
          "getpwent getservent quotemeta msgrcv scalar kill dbmclose undef lc ma syswrite tr send umask sysopen shmwrite vec qx utime local oct semctl localtime readpipe do return format read sprintf dbmopen pop getpgrp not getpwnam rewinddir qqfileno qw endprotoent wait sethostent bless s|0 opendir continue each sleep endgrent shutdown dump chomp connect getsockname die socketpair close flock exists index shmgetsub for endpwent redo lstat msgctl setpgrp abs exit select print ref gethostbyaddr unshift fcntl syscall goto getnetbyaddr join gmtime symlink semget splice x|0 getpeername recv log setsockopt cos last reverse gethostbyname getgrnam study formline endhostent times chop length gethostent getnetent pack getprotoent getservbyname rand mkdir pos chmod y|0 substr endnetent printf next open msgsnd readdir use unlink getsockopt getpriority rindex wantarray hex system getservbyport endservent int chr untie rmdir prototype tell listen fork shmread ucfirst setprotoent else sysseek link getgrgid shmctl waitpid unpack getnetbyname reset chdir grep split require caller lcfirst until warn while values shift telldir getpwuid my getprotobynumber delete and sort uc defined srand accept package seekdir getprotobyname semop our rename seek if q|0 chroot sysread setpwent no crypt getc chown sqrt write setnetent setpriority foreach tie sin msgget map stat getlogin unless elsif truncate exec keys glob tied closedirioctl socket readlink eval xor readline binmode setservent eof ord bind alarm pipe atan2 getgrent exp time push setgrent gt lt or ne m|0 break given say state when",
        r = { cN: "subst", b: "[$@]\\{", e: "\\}", k: t },
        n = { b: "->{", e: "}" },
        a = {
          v: [
            { b: /\$\d/ },
            { b: /[\$%@](\^\w\b|#\w+(::\w+)*|{\w+}|\w+(::\w*)*)/ },
            { b: /[\$%@][^\s\w{]/, relevance: 0 },
          ],
        },
        i = [e.BE, r, a],
        s = [
          a,
          e.HCM,
          e.C("^\\=\\w", "\\=cut", { eW: !0 }),
          n,
          {
            cN: "string",
            c: i,
            v: [
              { b: "q[qwxr]?\\s*\\(", e: "\\)", relevance: 5 },
              { b: "q[qwxr]?\\s*\\[", e: "\\]", relevance: 5 },
              { b: "q[qwxr]?\\s*\\{", e: "\\}", relevance: 5 },
              { b: "q[qwxr]?\\s*\\|", e: "\\|", relevance: 5 },
              { b: "q[qwxr]?\\s*\\<", e: "\\>", relevance: 5 },
              { b: "qw\\s+q", e: "q", relevance: 5 },
              { b: "'", e: "'", c: [e.BE] },
              { b: '"', e: '"' },
              { b: "`", e: "`", c: [e.BE] },
              { b: "{\\w+}", c: [], relevance: 0 },
              { b: "-?\\w+\\s*\\=\\>", c: [], relevance: 0 },
            ],
          },
          {
            cN: "number",
            b: "(\\b0[0-7_]+)|(\\b0x[0-9a-fA-F_]+)|(\\b[1-9][0-9_]*(\\.[0-9_]+)?)|[0_]\\b",
            relevance: 0,
          },
          {
            b:
              "(\\/\\/|" +
              e.RSR +
              "|\\b(split|return|print|reverse|grep)\\b)\\s*",
            k: "split return print reverse grep",
            relevance: 0,
            c: [
              e.HCM,
              {
                cN: "regexp",
                b: "(s|tr|y)/(\\\\.|[^/])*/(\\\\.|[^/])*/[a-z]*",
                relevance: 10,
              },
              {
                cN: "regexp",
                b: "(m|qr)?/",
                e: "/[a-z]*",
                c: [e.BE],
                relevance: 0,
              },
            ],
          },
          {
            cN: "function",
            bK: "sub",
            e: "(\\s*\\(.*?\\))?[;{]",
            eE: !0,
            relevance: 5,
            c: [e.TM],
          },
          { b: "-\\w\\b", relevance: 0 },
          {
            b: "^__DATA__$",
            e: "^__END__$",
            sL: "mojolicious",
            c: [{ b: "^@@.*", e: "$", cN: "comment" }],
          },
        ];
      return (
        (r.c = s), { aliases: ["pl", "pm"], l: /[\w\.]+/, k: t, c: (n.c = s) }
      );
    }),
    a.registerLanguage("php", function (e) {
      var t = { b: "\\$+[a-zA-Z_-ÿ][a-zA-Z0-9_-ÿ]*" },
        r = { cN: "meta", b: /<\?(php)?|\?>/ },
        n = {
          cN: "string",
          c: [e.BE, r],
          v: [
            { b: 'b"', e: '"' },
            { b: "b'", e: "'" },
            e.inherit(e.ASM, { i: null }),
            e.inherit(e.QSM, { i: null }),
          ],
        },
        a = { v: [e.BNM, e.CNM] };
      return {
        aliases: ["php", "php3", "php4", "php5", "php6", "php7"],
        cI: !0,
        k: "and include_once list abstract global private echo interface as static endswitch array null if endwhile or const for endforeach self var while isset public protected exit foreach throw elseif include __FILE__ empty require_once do xor return parent clone use __CLASS__ __LINE__ else break print eval new catch __METHOD__ case exception default die require __FUNCTION__ enddeclare final try switch continue endfor endif declare unset true false trait goto instanceof insteadof __DIR__ __NAMESPACE__ yield finally",
        c: [
          e.HCM,
          e.C("//", "$", { c: [r] }),
          e.C("/\\*", "\\*/", { c: [{ cN: "doctag", b: "@[A-Za-z]+" }] }),
          e.C("__halt_compiler.+?;", !1, {
            eW: !0,
            k: "__halt_compiler",
            l: e.UIR,
          }),
          {
            cN: "string",
            b: /<<<['"]?\w+['"]?$/,
            e: /^\w+;?$/,
            c: [
              e.BE,
              { cN: "subst", v: [{ b: /\$\w+/ }, { b: /\{\$/, e: /\}/ }] },
            ],
          },
          r,
          { cN: "keyword", b: /\$this\b/ },
          t,
          { b: /(::|->)+[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/ },
          {
            cN: "function",
            bK: "function",
            e: /[;{]/,
            eE: !0,
            i: "\\$|\\[|%",
            c: [
              e.UTM,
              {
                cN: "params",
                b: "\\(",
                e: "\\)",
                c: ["self", t, e.CBCM, n, a],
              },
            ],
          },
          {
            cN: "class",
            bK: "class interface",
            e: "{",
            eE: !0,
            i: /[:\(\$"]/,
            c: [{ bK: "extends implements" }, e.UTM],
          },
          { bK: "namespace", e: ";", i: /[\.']/, c: [e.UTM] },
          { bK: "use", e: ";", c: [e.UTM] },
          { b: "=>" },
          n,
          a,
        ],
      };
    }),
    a.registerLanguage("plaintext", function (e) {
      return { disableAutodetect: !0 };
    }),
    a.registerLanguage("properties", function (e) {
      var t = "[ \\t\\f]*",
        r = "(" + t + "[:=]" + t + "|[ \\t\\f]+)",
        n = "([^\\\\\\W:= \\t\\f\\n]|\\\\.)+",
        a = "([^\\\\:= \\t\\f\\n]|\\\\.)+",
        i = {
          e: r,
          relevance: 0,
          starts: { cN: "string", e: /$/, relevance: 0, c: [{ b: "\\\\\\n" }] },
        };
      return {
        cI: !0,
        i: /\S/,
        c: [
          e.C("^\\s*[!#]", "$"),
          {
            b: n + r,
            rB: !0,
            c: [{ cN: "attr", b: n, endsParent: !0, relevance: 0 }],
            starts: i,
          },
          {
            b: a + r,
            rB: !0,
            relevance: 0,
            c: [{ cN: "meta", b: a, endsParent: !0, relevance: 0 }],
            starts: i,
          },
          { cN: "attr", relevance: 0, b: a + t + "$" },
        ],
      };
    }),
    a.registerLanguage("python", function (e) {
      var t = {
          keyword:
            "and elif is global as in if from raise for except finally print import pass return exec else break not with class assert yield try while continue del or def lambda async await nonlocal|10",
          built_in: "Ellipsis NotImplemented",
          literal: "False None True",
        },
        r = { cN: "meta", b: /^(>>>|\.\.\.) / },
        n = { cN: "subst", b: /\{/, e: /\}/, k: t, i: /#/ },
        a = { b: /\{\{/, relevance: 0 },
        i = {
          cN: "string",
          c: [e.BE],
          v: [
            { b: /(u|b)?r?'''/, e: /'''/, c: [e.BE, r], relevance: 10 },
            { b: /(u|b)?r?"""/, e: /"""/, c: [e.BE, r], relevance: 10 },
            { b: /(fr|rf|f)'''/, e: /'''/, c: [e.BE, r, a, n] },
            { b: /(fr|rf|f)"""/, e: /"""/, c: [e.BE, r, a, n] },
            { b: /(u|r|ur)'/, e: /'/, relevance: 10 },
            { b: /(u|r|ur)"/, e: /"/, relevance: 10 },
            { b: /(b|br)'/, e: /'/ },
            { b: /(b|br)"/, e: /"/ },
            { b: /(fr|rf|f)'/, e: /'/, c: [e.BE, a, n] },
            { b: /(fr|rf|f)"/, e: /"/, c: [e.BE, a, n] },
            e.ASM,
            e.QSM,
          ],
        },
        s = {
          cN: "number",
          relevance: 0,
          v: [
            { b: e.BNR + "[lLjJ]?" },
            { b: "\\b(0o[0-7]+)[lLjJ]?" },
            { b: e.CNR + "[lLjJ]?" },
          ],
        },
        c = { cN: "params", b: /\(/, e: /\)/, c: ["self", r, s, i, e.HCM] };
      return (
        (n.c = [i, s, r]),
        {
          aliases: ["py", "gyp", "ipython"],
          k: t,
          i: /(<\/|->|\?)|=>/,
          c: [
            r,
            s,
            { bK: "if", relevance: 0 },
            i,
            e.HCM,
            {
              v: [
                { cN: "function", bK: "def" },
                { cN: "class", bK: "class" },
              ],
              e: /:/,
              i: /[${=;\n,]/,
              c: [e.UTM, c, { b: /->/, eW: !0, k: "None" }],
            },
            { cN: "meta", b: /^[\t ]*@/, e: /$/ },
            { b: /\b(print|exec)\(/ },
          ],
        }
      );
    }),
    a.registerLanguage("ruby", function (e) {
      var t =
          "[a-zA-Z_]\\w*[!?=]?|[-+~]\\@|<<|>>|=~|===?|<=>|[<>]=?|\\*\\*|[-/+%^&*~`|]|\\[\\]=?",
        r = {
          keyword:
            "and then defined module in return redo if BEGIN retry end for self when next until do begin unless END rescue else break undef not super class case require yield alias while ensure elsif or include attr_reader attr_writer attr_accessor",
          literal: "true false nil",
        },
        n = { cN: "doctag", b: "@[A-Za-z]+" },
        a = { b: "#<", e: ">" },
        i = [
          e.C("#", "$", { c: [n] }),
          e.C("^\\=begin", "^\\=end", { c: [n], relevance: 10 }),
          e.C("^__END__", "\\n$"),
        ],
        s = { cN: "subst", b: "#\\{", e: "}", k: r },
        c = {
          cN: "string",
          c: [e.BE, s],
          v: [
            { b: /'/, e: /'/ },
            { b: /"/, e: /"/ },
            { b: /`/, e: /`/ },
            { b: "%[qQwWx]?\\(", e: "\\)" },
            { b: "%[qQwWx]?\\[", e: "\\]" },
            { b: "%[qQwWx]?{", e: "}" },
            { b: "%[qQwWx]?<", e: ">" },
            { b: "%[qQwWx]?/", e: "/" },
            { b: "%[qQwWx]?%", e: "%" },
            { b: "%[qQwWx]?-", e: "-" },
            { b: "%[qQwWx]?\\|", e: "\\|" },
            {
              b: /\B\?(\\\d{1,3}|\\x[A-Fa-f0-9]{1,2}|\\u[A-Fa-f0-9]{4}|\\?\S)\b/,
            },
            {
              b: /<<[-~]?'?(\w+)(?:.|\n)*?\n\s*\1\b/,
              rB: !0,
              c: [
                { b: /<<[-~]?'?/ },
                { b: /\w+/, endSameAsBegin: !0, c: [e.BE, s] },
              ],
            },
          ],
        },
        o = { cN: "params", b: "\\(", e: "\\)", endsParent: !0, k: r },
        l = [
          c,
          a,
          {
            cN: "class",
            bK: "class module",
            e: "$|;",
            i: /=/,
            c: [
              e.inherit(e.TM, { b: "[A-Za-z_]\\w*(::\\w+)*(\\?|\\!)?" }),
              { b: "<\\s*", c: [{ b: "(" + e.IR + "::)?" + e.IR }] },
            ].concat(i),
          },
          {
            cN: "function",
            bK: "def",
            e: "$|;",
            c: [e.inherit(e.TM, { b: t }), o].concat(i),
          },
          { b: e.IR + "::" },
          { cN: "symbol", b: e.UIR + "(\\!|\\?)?:", relevance: 0 },
          { cN: "symbol", b: ":(?!\\s)", c: [c, { b: t }], relevance: 0 },
          {
            cN: "number",
            b: "(\\b0[0-7_]+)|(\\b0x[0-9a-fA-F_]+)|(\\b[1-9][0-9_]*(\\.[0-9_]+)?)|[0_]\\b",
            relevance: 0,
          },
          { b: "(\\$\\W)|((\\$|\\@\\@?)(\\w+))" },
          { cN: "params", b: /\|/, e: /\|/, k: r },
          {
            b: "(" + e.RSR + "|unless)\\s*",
            k: "unless",
            c: [
              a,
              {
                cN: "regexp",
                c: [e.BE, s],
                i: /\n/,
                v: [
                  { b: "/", e: "/[a-z]*" },
                  { b: "%r{", e: "}[a-z]*" },
                  { b: "%r\\(", e: "\\)[a-z]*" },
                  { b: "%r!", e: "![a-z]*" },
                  { b: "%r\\[", e: "\\][a-z]*" },
                ],
              },
            ].concat(i),
            relevance: 0,
          },
        ].concat(i);
      s.c = l;
      var d = [
        { b: /^\s*=>/, starts: { e: "$", c: (o.c = l) } },
        {
          cN: "meta",
          b: "^([>?]>|[\\w#]+\\(\\w+\\):\\d+:\\d+>|(\\w+-)?\\d+\\.\\d+\\.\\d(p\\d+)?[^>]+>)",
          starts: { e: "$", c: l },
        },
      ];
      return {
        aliases: ["rb", "gemspec", "podspec", "thor", "irb"],
        k: r,
        i: /\/\*/,
        c: i.concat(d).concat(l),
      };
    }),
    a.registerLanguage("rust", function (e) {
      var t = "([ui](8|16|32|64|128|size)|f(32|64))?",
        r =
          "drop i8 i16 i32 i64 i128 isize u8 u16 u32 u64 u128 usize f32 f64 str char bool Box Option Result String Vec Copy Send Sized Sync Drop Fn FnMut FnOnce ToOwned Clone Debug PartialEq PartialOrd Eq Ord AsRef AsMut Into From Default Iterator Extend IntoIterator DoubleEndedIterator ExactSizeIterator SliceConcatExt ToString assert! assert_eq! bitflags! bytes! cfg! col! concat! concat_idents! debug_assert! debug_assert_eq! env! panic! file! format! format_args! include_bin! include_str! line! local_data_key! module_path! option_env! print! println! select! stringify! try! unimplemented! unreachable! vec! write! writeln! macro_rules! assert_ne! debug_assert_ne!";
      return {
        aliases: ["rs"],
        k: {
          keyword:
            "abstract as async await become box break const continue crate do dyn else enum extern false final fn for if impl in let loop macro match mod move mut override priv pub ref return self Self static struct super trait true try type typeof unsafe unsized use virtual where while yield",
          literal: "true false Some None Ok Err",
          built_in: r,
        },
        l: e.IR + "!?",
        i: "</",
        c: [
          e.CLCM,
          e.C("/\\*", "\\*/", { c: ["self"] }),
          e.inherit(e.QSM, { b: /b?"/, i: null }),
          {
            cN: "string",
            v: [
              { b: /r(#*)"(.|\n)*?"\1(?!#)/ },
              { b: /b?'\\?(x\w{2}|u\w{4}|U\w{8}|.)'/ },
            ],
          },
          { cN: "symbol", b: /'[a-zA-Z_][a-zA-Z0-9_]*/ },
          {
            cN: "number",
            v: [
              { b: "\\b0b([01_]+)" + t },
              { b: "\\b0o([0-7_]+)" + t },
              { b: "\\b0x([A-Fa-f0-9_]+)" + t },
              { b: "\\b(\\d[\\d_]*(\\.[0-9_]+)?([eE][+-]?[0-9_]+)?)" + t },
            ],
            relevance: 0,
          },
          { cN: "function", bK: "fn", e: "(\\(|<)", eE: !0, c: [e.UTM] },
          {
            cN: "meta",
            b: "#\\!?\\[",
            e: "\\]",
            c: [{ cN: "meta-string", b: /"/, e: /"/ }],
          },
          {
            cN: "class",
            bK: "type",
            e: ";",
            c: [e.inherit(e.UTM, { endsParent: !0 })],
            i: "\\S",
          },
          {
            cN: "class",
            bK: "trait enum struct union",
            e: "{",
            c: [e.inherit(e.UTM, { endsParent: !0 })],
            i: "[\\w\\d]",
          },
          { b: e.IR + "::", k: { built_in: r } },
          { b: "->" },
        ],
      };
    }),
    a.registerLanguage("scss", function (e) {
      var t = "@[a-z-]+",
        r = { cN: "variable", b: "(\\$[a-zA-Z-][a-zA-Z0-9_-]*)\\b" },
        n = { cN: "number", b: "#[0-9A-Fa-f]+" };
      e.CSSNM, e.QSM, e.ASM, e.CBCM;
      return {
        cI: !0,
        i: "[=/|']",
        c: [
          e.CLCM,
          e.CBCM,
          { cN: "selector-id", b: "\\#[A-Za-z0-9_-]+", relevance: 0 },
          { cN: "selector-class", b: "\\.[A-Za-z0-9_-]+", relevance: 0 },
          { cN: "selector-attr", b: "\\[", e: "\\]", i: "$" },
          {
            cN: "selector-tag",
            b: "\\b(a|abbr|acronym|address|area|article|aside|audio|b|base|big|blockquote|body|br|button|canvas|caption|cite|code|col|colgroup|command|datalist|dd|del|details|dfn|div|dl|dt|em|embed|fieldset|figcaption|figure|footer|form|frame|frameset|(h[1-6])|head|header|hgroup|hr|html|i|iframe|img|input|ins|kbd|keygen|label|legend|li|link|map|mark|meta|meter|nav|noframes|noscript|object|ol|optgroup|option|output|p|param|pre|progress|q|rp|rt|ruby|samp|script|section|select|small|span|strike|strong|style|sub|sup|table|tbody|td|textarea|tfoot|th|thead|time|title|tr|tt|ul|var|video)\\b",
            relevance: 0,
          },
          {
            cN: "selector-pseudo",
            b: ":(visited|valid|root|right|required|read-write|read-only|out-range|optional|only-of-type|only-child|nth-of-type|nth-last-of-type|nth-last-child|nth-child|not|link|left|last-of-type|last-child|lang|invalid|indeterminate|in-range|hover|focus|first-of-type|first-line|first-letter|first-child|first|enabled|empty|disabled|default|checked|before|after|active)",
          },
          {
            cN: "selector-pseudo",
            b: "::(after|before|choices|first-letter|first-line|repeat-index|repeat-item|selection|value)",
          },
          r,
          {
            cN: "attribute",
            b: "\\b(src|z-index|word-wrap|word-spacing|word-break|width|widows|white-space|visibility|vertical-align|unicode-bidi|transition-timing-function|transition-property|transition-duration|transition-delay|transition|transform-style|transform-origin|transform|top|text-underline-position|text-transform|text-shadow|text-rendering|text-overflow|text-indent|text-decoration-style|text-decoration-line|text-decoration-color|text-decoration|text-align-last|text-align|tab-size|table-layout|right|resize|quotes|position|pointer-events|perspective-origin|perspective|page-break-inside|page-break-before|page-break-after|padding-top|padding-right|padding-left|padding-bottom|padding|overflow-y|overflow-x|overflow-wrap|overflow|outline-width|outline-style|outline-offset|outline-color|outline|orphans|order|opacity|object-position|object-fit|normal|none|nav-up|nav-right|nav-left|nav-index|nav-down|min-width|min-height|max-width|max-height|mask|marks|margin-top|margin-right|margin-left|margin-bottom|margin|list-style-type|list-style-position|list-style-image|list-style|line-height|letter-spacing|left|justify-content|initial|inherit|ime-mode|image-orientation|image-resolution|image-rendering|icon|hyphens|height|font-weight|font-variant-ligatures|font-variant|font-style|font-stretch|font-size-adjust|font-size|font-language-override|font-kerning|font-feature-settings|font-family|font|float|flex-wrap|flex-shrink|flex-grow|flex-flow|flex-direction|flex-basis|flex|filter|empty-cells|display|direction|cursor|counter-reset|counter-increment|content|column-width|column-span|column-rule-width|column-rule-style|column-rule-color|column-rule|column-gap|column-fill|column-count|columns|color|clip-path|clip|clear|caption-side|break-inside|break-before|break-after|box-sizing|box-shadow|box-decoration-break|bottom|border-width|border-top-width|border-top-style|border-top-right-radius|border-top-left-radius|border-top-color|border-top|border-style|border-spacing|border-right-width|border-right-style|border-right-color|border-right|border-radius|border-left-width|border-left-style|border-left-color|border-left|border-image-width|border-image-source|border-image-slice|border-image-repeat|border-image-outset|border-image|border-color|border-collapse|border-bottom-width|border-bottom-style|border-bottom-right-radius|border-bottom-left-radius|border-bottom-color|border-bottom|border|background-size|background-repeat|background-position|background-origin|background-image|background-color|background-clip|background-attachment|background-blend-mode|background|backface-visibility|auto|animation-timing-function|animation-play-state|animation-name|animation-iteration-count|animation-fill-mode|animation-duration|animation-direction|animation-delay|animation|align-self|align-items|align-content)\\b",
            i: "[^\\s]",
          },
          {
            b: "\\b(whitespace|wait|w-resize|visible|vertical-text|vertical-ideographic|uppercase|upper-roman|upper-alpha|underline|transparent|top|thin|thick|text|text-top|text-bottom|tb-rl|table-header-group|table-footer-group|sw-resize|super|strict|static|square|solid|small-caps|separate|se-resize|scroll|s-resize|rtl|row-resize|ridge|right|repeat|repeat-y|repeat-x|relative|progress|pointer|overline|outside|outset|oblique|nowrap|not-allowed|normal|none|nw-resize|no-repeat|no-drop|newspaper|ne-resize|n-resize|move|middle|medium|ltr|lr-tb|lowercase|lower-roman|lower-alpha|loose|list-item|line|line-through|line-edge|lighter|left|keep-all|justify|italic|inter-word|inter-ideograph|inside|inset|inline|inline-block|inherit|inactive|ideograph-space|ideograph-parenthesis|ideograph-numeric|ideograph-alpha|horizontal|hidden|help|hand|groove|fixed|ellipsis|e-resize|double|dotted|distribute|distribute-space|distribute-letter|distribute-all-lines|disc|disabled|default|decimal|dashed|crosshair|collapse|col-resize|circle|char|center|capitalize|break-word|break-all|bottom|both|bolder|bold|block|bidi-override|below|baseline|auto|always|all-scroll|absolute|table|table-cell)\\b",
          },
          {
            b: ":",
            e: ";",
            c: [r, n, e.CSSNM, e.QSM, e.ASM, { cN: "meta", b: "!important" }],
          },
          { b: "@(page|font-face)", l: t, k: "@page @font-face" },
          {
            b: "@",
            e: "[{;]",
            rB: !0,
            k: "and or not only",
            c: [{ b: t, cN: "keyword" }, r, e.QSM, e.ASM, n, e.CSSNM],
          },
        ],
      };
    }),
    a.registerLanguage("shell", function (e) {
      return {
        aliases: ["console"],
        c: [
          {
            cN: "meta",
            b: "^\\s{0,3}[/\\w\\d\\[\\]()@-]*[>%$#]",
            starts: { e: "$", sL: "bash" },
          },
        ],
      };
    }),
    a.registerLanguage("sql", function (e) {
      var t = e.C("--", "$");
      return {
        cI: !0,
        i: /[<>{}*]/,
        c: [
          {
            bK: "begin end start commit rollback savepoint lock alter create drop rename call delete do handler insert load replace select truncate update set show pragma grant merge describe use explain help declare prepare execute deallocate release unlock purge reset change stop analyze cache flush optimize repair kill install uninstall checksum restore check backup revoke comment values with",
            e: /;/,
            eW: !0,
            l: /[\w\.]+/,
            k: {
              keyword:
                "as abort abs absolute acc acce accep accept access accessed accessible account acos action activate add addtime admin administer advanced advise aes_decrypt aes_encrypt after agent aggregate ali alia alias all allocate allow alter always analyze ancillary and anti any anydata anydataset anyschema anytype apply archive archived archivelog are as asc ascii asin assembly assertion associate asynchronous at atan atn2 attr attri attrib attribu attribut attribute attributes audit authenticated authentication authid authors auto autoallocate autodblink autoextend automatic availability avg backup badfile basicfile before begin beginning benchmark between bfile bfile_base big bigfile bin binary_double binary_float binlog bit_and bit_count bit_length bit_or bit_xor bitmap blob_base block blocksize body both bound bucket buffer_cache buffer_pool build bulk by byte byteordermark bytes cache caching call calling cancel capacity cascade cascaded case cast catalog category ceil ceiling chain change changed char_base char_length character_length characters characterset charindex charset charsetform charsetid check checksum checksum_agg child choose chr chunk class cleanup clear client clob clob_base clone close cluster_id cluster_probability cluster_set clustering coalesce coercibility col collate collation collect colu colum column column_value columns columns_updated comment commit compact compatibility compiled complete composite_limit compound compress compute concat concat_ws concurrent confirm conn connec connect connect_by_iscycle connect_by_isleaf connect_by_root connect_time connection consider consistent constant constraint constraints constructor container content contents context contributors controlfile conv convert convert_tz corr corr_k corr_s corresponding corruption cos cost count count_big counted covar_pop covar_samp cpu_per_call cpu_per_session crc32 create creation critical cross cube cume_dist curdate current current_date current_time current_timestamp current_user cursor curtime customdatum cycle data database databases datafile datafiles datalength date_add date_cache date_format date_sub dateadd datediff datefromparts datename datepart datetime2fromparts day day_to_second dayname dayofmonth dayofweek dayofyear days db_role_change dbtimezone ddl deallocate declare decode decompose decrement decrypt deduplicate def defa defau defaul default defaults deferred defi defin define degrees delayed delegate delete delete_all delimited demand dense_rank depth dequeue des_decrypt des_encrypt des_key_file desc descr descri describ describe descriptor deterministic diagnostics difference dimension direct_load directory disable disable_all disallow disassociate discardfile disconnect diskgroup distinct distinctrow distribute distributed div do document domain dotnet double downgrade drop dumpfile duplicate duration each edition editionable editions element ellipsis else elsif elt empty enable enable_all enclosed encode encoding encrypt end end-exec endian enforced engine engines enqueue enterprise entityescaping eomonth error errors escaped evalname evaluate event eventdata events except exception exceptions exchange exclude excluding execu execut execute exempt exists exit exp expire explain explode export export_set extended extent external external_1 external_2 externally extract failed failed_login_attempts failover failure far fast feature_set feature_value fetch field fields file file_name_convert filesystem_like_logging final finish first first_value fixed flash_cache flashback floor flush following follows for forall force foreign form forma format found found_rows freelist freelists freepools fresh from from_base64 from_days ftp full function general generated get get_format get_lock getdate getutcdate global global_name globally go goto grant grants greatest group group_concat group_id grouping grouping_id groups gtid_subtract guarantee guard handler hash hashkeys having hea head headi headin heading heap help hex hierarchy high high_priority hosts hour hours http id ident_current ident_incr ident_seed identified identity idle_time if ifnull ignore iif ilike ilm immediate import in include including increment index indexes indexing indextype indicator indices inet6_aton inet6_ntoa inet_aton inet_ntoa infile initial initialized initially initrans inmemory inner innodb input insert install instance instantiable instr interface interleaved intersect into invalidate invisible is is_free_lock is_ipv4 is_ipv4_compat is_not is_not_null is_used_lock isdate isnull isolation iterate java join json json_exists keep keep_duplicates key keys kill language large last last_day last_insert_id last_value lateral lax lcase lead leading least leaves left len lenght length less level levels library like like2 like4 likec limit lines link list listagg little ln load load_file lob lobs local localtime localtimestamp locate locator lock locked log log10 log2 logfile logfiles logging logical logical_reads_per_call logoff logon logs long loop low low_priority lower lpad lrtrim ltrim main make_set makedate maketime managed management manual map mapping mask master master_pos_wait match matched materialized max maxextents maximize maxinstances maxlen maxlogfiles maxloghistory maxlogmembers maxsize maxtrans md5 measures median medium member memcompress memory merge microsecond mid migration min minextents minimum mining minus minute minutes minvalue missing mod mode model modification modify module monitoring month months mount move movement multiset mutex name name_const names nan national native natural nav nchar nclob nested never new newline next nextval no no_write_to_binlog noarchivelog noaudit nobadfile nocheck nocompress nocopy nocycle nodelay nodiscardfile noentityescaping noguarantee nokeep nologfile nomapping nomaxvalue nominimize nominvalue nomonitoring none noneditionable nonschema noorder nopr nopro noprom nopromp noprompt norely noresetlogs noreverse normal norowdependencies noschemacheck noswitch not nothing notice notnull notrim novalidate now nowait nth_value nullif nulls num numb numbe nvarchar nvarchar2 object ocicoll ocidate ocidatetime ociduration ociinterval ociloblocator ocinumber ociref ocirefcursor ocirowid ocistring ocitype oct octet_length of off offline offset oid oidindex old on online only opaque open operations operator optimal optimize option optionally or oracle oracle_date oradata ord ordaudio orddicom orddoc order ordimage ordinality ordvideo organization orlany orlvary out outer outfile outline output over overflow overriding package pad parallel parallel_enable parameters parent parse partial partition partitions pascal passing password password_grace_time password_lock_time password_reuse_max password_reuse_time password_verify_function patch path patindex pctincrease pctthreshold pctused pctversion percent percent_rank percentile_cont percentile_disc performance period period_add period_diff permanent physical pi pipe pipelined pivot pluggable plugin policy position post_transaction pow power pragma prebuilt precedes preceding precision prediction prediction_cost prediction_details prediction_probability prediction_set prepare present preserve prior priority private private_sga privileges procedural procedure procedure_analyze processlist profiles project prompt protection public publishingservername purge quarter query quick quiesce quota quotename radians raise rand range rank raw read reads readsize rebuild record records recover recovery recursive recycle redo reduced ref reference referenced references referencing refresh regexp_like register regr_avgx regr_avgy regr_count regr_intercept regr_r2 regr_slope regr_sxx regr_sxy reject rekey relational relative relaylog release release_lock relies_on relocate rely rem remainder rename repair repeat replace replicate replication required reset resetlogs resize resource respect restore restricted result result_cache resumable resume retention return returning returns reuse reverse revoke right rlike role roles rollback rolling rollup round row row_count rowdependencies rowid rownum rows rtrim rules safe salt sample save savepoint sb1 sb2 sb4 scan schema schemacheck scn scope scroll sdo_georaster sdo_topo_geometry search sec_to_time second seconds section securefile security seed segment select self semi sequence sequential serializable server servererror session session_user sessions_per_user set sets settings sha sha1 sha2 share shared shared_pool short show shrink shutdown si_averagecolor si_colorhistogram si_featurelist si_positionalcolor si_stillimage si_texture siblings sid sign sin size size_t sizes skip slave sleep smalldatetimefromparts smallfile snapshot some soname sort soundex source space sparse spfile split sql sql_big_result sql_buffer_result sql_cache sql_calc_found_rows sql_small_result sql_variant_property sqlcode sqldata sqlerror sqlname sqlstate sqrt square standalone standby start starting startup statement static statistics stats_binomial_test stats_crosstab stats_ks_test stats_mode stats_mw_test stats_one_way_anova stats_t_test_ stats_t_test_indep stats_t_test_one stats_t_test_paired stats_wsr_test status std stddev stddev_pop stddev_samp stdev stop storage store stored str str_to_date straight_join strcmp strict string struct stuff style subdate subpartition subpartitions substitutable substr substring subtime subtring_index subtype success sum suspend switch switchoffset switchover sync synchronous synonym sys sys_xmlagg sysasm sysaux sysdate sysdatetimeoffset sysdba sysoper system system_user sysutcdatetime table tables tablespace tablesample tan tdo template temporary terminated tertiary_weights test than then thread through tier ties time time_format time_zone timediff timefromparts timeout timestamp timestampadd timestampdiff timezone_abbr timezone_minute timezone_region to to_base64 to_date to_days to_seconds todatetimeoffset trace tracking transaction transactional translate translation treat trigger trigger_nestlevel triggers trim truncate try_cast try_convert try_parse type ub1 ub2 ub4 ucase unarchived unbounded uncompress under undo unhex unicode uniform uninstall union unique unix_timestamp unknown unlimited unlock unnest unpivot unrecoverable unsafe unsigned until untrusted unusable unused update updated upgrade upped upper upsert url urowid usable usage use use_stored_outlines user user_data user_resources users using utc_date utc_timestamp uuid uuid_short validate validate_password_strength validation valist value values var var_samp varcharc vari varia variab variabl variable variables variance varp varraw varrawc varray verify version versions view virtual visible void wait wallet warning warnings week weekday weekofyear wellformed when whene whenev wheneve whenever where while whitespace window with within without work wrapped xdb xml xmlagg xmlattributes xmlcast xmlcolattval xmlelement xmlexists xmlforest xmlindex xmlnamespaces xmlpi xmlquery xmlroot xmlschema xmlserialize xmltable xmltype xor year year_to_month years yearweek",
              literal: "true false null unknown",
              built_in:
                "array bigint binary bit blob bool boolean char character date dec decimal float int int8 integer interval number numeric real record serial serial8 smallint text time timestamp tinyint varchar varchar2 varying void",
            },
            c: [
              { cN: "string", b: "'", e: "'", c: [{ b: "''" }] },
              { cN: "string", b: '"', e: '"', c: [{ b: '""' }] },
              { cN: "string", b: "`", e: "`" },
              e.CNM,
              e.CBCM,
              t,
              e.HCM,
            ],
          },
          e.CBCM,
          t,
          e.HCM,
        ],
      };
    }),
    a.registerLanguage("swift", function (e) {
      var t = {
          keyword:
            "#available #colorLiteral #column #else #elseif #endif #file #fileLiteral #function #if #imageLiteral #line #selector #sourceLocation _ __COLUMN__ __FILE__ __FUNCTION__ __LINE__ Any as as! as? associatedtype associativity break case catch class continue convenience default defer deinit didSet do dynamic dynamicType else enum extension fallthrough false fileprivate final for func get guard if import in indirect infix init inout internal is lazy left let mutating nil none nonmutating open operator optional override postfix precedence prefix private protocol Protocol public repeat required rethrows return right self Self set static struct subscript super switch throw throws true try try! try? Type typealias unowned var weak where while willSet",
          literal: "true false nil",
          built_in:
            "abs advance alignof alignofValue anyGenerator assert assertionFailure bridgeFromObjectiveC bridgeFromObjectiveCUnconditional bridgeToObjectiveC bridgeToObjectiveCUnconditional c contains count countElements countLeadingZeros debugPrint debugPrintln distance dropFirst dropLast dump encodeBitsAsWords enumerate equal fatalError filter find getBridgedObjectiveCType getVaList indices insertionSort isBridgedToObjectiveC isBridgedVerbatimToObjectiveC isUniquelyReferenced isUniquelyReferencedNonObjC join lazy lexicographicalCompare map max maxElement min minElement numericCast overlaps partition posix precondition preconditionFailure print println quickSort readLine reduce reflect reinterpretCast reverse roundUpToAlignment sizeof sizeofValue sort split startsWith stride strideof strideofValue swap toString transcode underestimateCount unsafeAddressOf unsafeBitCast unsafeDowncast unsafeUnwrap unsafeReflect withExtendedLifetime withObjectAtPlusZero withUnsafePointer withUnsafePointerToObject withUnsafeMutablePointer withUnsafeMutablePointers withUnsafePointer withUnsafePointers withVaList zip",
        },
        r = e.C("/\\*", "\\*/", { c: ["self"] }),
        n = { cN: "subst", b: /\\\(/, e: "\\)", k: t, c: [] },
        a = {
          cN: "string",
          c: [e.BE, n],
          v: [
            { b: /"""/, e: /"""/ },
            { b: /"/, e: /"/ },
          ],
        },
        i = {
          cN: "number",
          b: "\\b([\\d_]+(\\.[\\deE_]+)?|0x[a-fA-F0-9_]+(\\.[a-fA-F0-9p_]+)?|0b[01_]+|0o[0-7_]+)\\b",
          relevance: 0,
        };
      return (
        (n.c = [i]),
        {
          k: t,
          c: [
            a,
            e.CLCM,
            r,
            { cN: "type", b: "\\b[A-Z][\\wÀ-ʸ']*[!?]" },
            { cN: "type", b: "\\b[A-Z][\\wÀ-ʸ']*", relevance: 0 },
            i,
            {
              cN: "function",
              bK: "func",
              e: "{",
              eE: !0,
              c: [
                e.inherit(e.TM, { b: /[A-Za-z$_][0-9A-Za-z$_]*/ }),
                { b: /</, e: />/ },
                {
                  cN: "params",
                  b: /\(/,
                  e: /\)/,
                  endsParent: !0,
                  k: t,
                  c: ["self", i, a, e.CBCM, { b: ":" }],
                  i: /["']/,
                },
              ],
              i: /\[|%/,
            },
            {
              cN: "class",
              bK: "struct protocol class extension enum",
              k: t,
              e: "\\{",
              eE: !0,
              c: [
                e.inherit(e.TM, { b: /[A-Za-z$_][\u00C0-\u02B80-9A-Za-z$_]*/ }),
              ],
            },
            {
              cN: "meta",
              b: "(@discardableResult|@warn_unused_result|@exported|@lazy|@noescape|@NSCopying|@NSManaged|@objc|@objcMembers|@convention|@required|@noreturn|@IBAction|@IBDesignable|@IBInspectable|@IBOutlet|@infix|@prefix|@postfix|@autoclosure|@testable|@available|@nonobjc|@NSApplicationMain|@UIApplicationMain|@dynamicMemberLookup|@propertyWrapper)",
            },
            { bK: "import", e: /$/, c: [e.CLCM, r] },
          ],
        }
      );
    }),
    a.registerLanguage("typescript", function (e) {
      var t = "[A-Za-z$_][0-9A-Za-z$_]*",
        r = {
          keyword:
            "in if for while finally var new function do return void else break catch instanceof with throw case default try this switch continue typeof delete let yield const class public private protected get set super static implements enum export import declare type namespace abstract as from extends async await",
          literal: "true false null undefined NaN Infinity",
          built_in:
            "eval isFinite isNaN parseFloat parseInt decodeURI decodeURIComponent encodeURI encodeURIComponent escape unescape Object Function Boolean Error EvalError InternalError RangeError ReferenceError StopIteration SyntaxError TypeError URIError Number Math Date String RegExp Array Float32Array Float64Array Int16Array Int32Array Int8Array Uint16Array Uint32Array Uint8Array Uint8ClampedArray ArrayBuffer DataView JSON Intl arguments require module console window document any number boolean string void Promise",
        },
        n = { cN: "meta", b: "@" + t },
        a = { b: "\\(", e: /\)/, k: r, c: ["self", e.QSM, e.ASM, e.NM] },
        i = {
          cN: "params",
          b: /\(/,
          e: /\)/,
          eB: !0,
          eE: !0,
          k: r,
          c: [e.CLCM, e.CBCM, n, a],
        },
        s = {
          cN: "number",
          v: [
            { b: "\\b(0[bB][01]+)n?" },
            { b: "\\b(0[oO][0-7]+)n?" },
            { b: e.CNR + "n?" },
          ],
          relevance: 0,
        },
        c = { cN: "subst", b: "\\$\\{", e: "\\}", k: r, c: [] },
        o = {
          b: "html`",
          e: "",
          starts: { e: "`", rE: !1, c: [e.BE, c], sL: "xml" },
        },
        l = {
          b: "css`",
          e: "",
          starts: { e: "`", rE: !1, c: [e.BE, c], sL: "css" },
        },
        d = { cN: "string", b: "`", e: "`", c: [e.BE, c] };
      return (
        (c.c = [e.ASM, e.QSM, o, l, d, s, e.RM]),
        {
          aliases: ["ts"],
          k: r,
          c: [
            { cN: "meta", b: /^\s*['"]use strict['"]/ },
            e.ASM,
            e.QSM,
            o,
            l,
            d,
            e.CLCM,
            e.CBCM,
            s,
            {
              b: "(" + e.RSR + "|\\b(case|return|throw)\\b)\\s*",
              k: "return throw case",
              c: [
                e.CLCM,
                e.CBCM,
                e.RM,
                {
                  cN: "function",
                  b: "(\\(.*?\\)|" + e.IR + ")\\s*=>",
                  rB: !0,
                  e: "\\s*=>",
                  c: [
                    {
                      cN: "params",
                      v: [
                        { b: e.IR },
                        { b: /\(\s*\)/ },
                        {
                          b: /\(/,
                          e: /\)/,
                          eB: !0,
                          eE: !0,
                          k: r,
                          c: ["self", e.CLCM, e.CBCM],
                        },
                      ],
                    },
                  ],
                },
              ],
              relevance: 0,
            },
            {
              cN: "function",
              bK: "function",
              e: /[\{;]/,
              eE: !0,
              k: r,
              c: ["self", e.inherit(e.TM, { b: t }), i],
              i: /%/,
              relevance: 0,
            },
            { bK: "constructor", e: /[\{;]/, eE: !0, c: ["self", i] },
            { b: /module\./, k: { built_in: "module" }, relevance: 0 },
            { bK: "module", e: /\{/, eE: !0 },
            { bK: "interface", e: /\{/, eE: !0, k: "interface extends" },
            { b: /\$[(.]/ },
            { b: "\\." + e.IR, relevance: 0 },
            n,
            a,
          ],
        }
      );
    }),
    a.registerLanguage("yaml", function (e) {
      var t = "true false yes no null",
        r = {
          cN: "string",
          relevance: 0,
          v: [{ b: /'/, e: /'/ }, { b: /"/, e: /"/ }, { b: /\S+/ }],
          c: [
            e.BE,
            {
              cN: "template-variable",
              v: [
                { b: "{{", e: "}}" },
                { b: "%{", e: "}" },
              ],
            },
          ],
        };
      return {
        cI: !0,
        aliases: ["yml", "YAML", "yaml"],
        c: [
          {
            cN: "attr",
            v: [
              { b: "\\w[\\w :\\/.-]*:(?=[ \t]|$)" },
              { b: '"\\w[\\w :\\/.-]*":(?=[ \t]|$)' },
              { b: "'\\w[\\w :\\/.-]*':(?=[ \t]|$)" },
            ],
          },
          { cN: "meta", b: "^---s*$", relevance: 10 },
          {
            cN: "string",
            b: "[\\|>]([0-9]?[+-])?[ ]*\\n( *)[\\S ]+\\n(\\2[\\S ]+\\n?)*",
          },
          {
            b: "<%[%=-]?",
            e: "[%-]?%>",
            sL: "ruby",
            eB: !0,
            eE: !0,
            relevance: 0,
          },
          { cN: "type", b: "!" + e.UIR },
          { cN: "type", b: "!!" + e.UIR },
          { cN: "meta", b: "&" + e.UIR + "$" },
          { cN: "meta", b: "\\*" + e.UIR + "$" },
          { cN: "bullet", b: "\\-(?=[ ]|$)", relevance: 0 },
          e.HCM,
          { bK: t, k: { literal: t } },
          { cN: "number", b: e.CNR + "\\b" },
          r,
        ],
      };
    }),
    a
  );
});
