/* 홈페이지 화면 편집기 — 편집 모드(?edit=1)에서만 실렸다.
 *
 * 하는 일
 *  - 표시된 영역([data-ed]) 안의 글자를 클릭하면 그 자리에서 고친다.
 *  - 사진을 클릭하면 바꾸고, 링크는 주소를 고친다.
 *  - 반복되는 항목(카드·목록·메뉴)은 복제·삭제·순서 바꾸기가 된다.
 *  - 영역 전체를 숨기거나 원래대로 되돌린다.
 *  - 저장할 때는 편집기가 붙인 표시를 모두 걷어내고 깨끗한 HTML 만 보낸다.
 *
 * 바깥 관리자 화면(admin/editor)과는 같은 출처라 함수를 직접 부른다.
 *   window.ED            ← 관리자 화면이 부르는 함수 (save, toggle, dirtyCount)
 *   window.parent.EDAPI  ← 이 화면이 부르는 함수 (post, onReady, onDirty, toast)
 */
(function () {
  'use strict';
  var C = window.ED_CONFIG;
  if (!C) return;

  // ------------------------------------------------------------------
  // 서버와 주고받기 — 관리자 화면이 있으면 그쪽 통로를 쓴다(보안 토큰을 한 곳에서 관리)
  // ------------------------------------------------------------------
  var host = null;
  try { if (window.parent !== window && window.parent.EDAPI) host = window.parent.EDAPI; } catch (e) { host = null; }

  var localHash = C.csrfHash;
  var api = host || {
    post: function (url, body, isForm) {
      var h = { 'X-Requested-With': 'XMLHttpRequest' };
      h[C.csrfHeader] = localHash;
      if (!isForm) { h['Content-Type'] = 'application/json'; body = JSON.stringify(body); }
      return fetch(url, { method: 'POST', headers: h, body: body, credentials: 'same-origin' })
        .then(function (r) {
          return r.json().catch(function () { return {}; }).then(function (j) {
            if (j.csrf) localHash = j.csrf;
            if (!r.ok || !j.ok) throw new Error(j.message || '요청을 처리하지 못했습니다. (' + r.status + ')');
            return j;
          });
        });
    },
    onReady: function () {}, onDirty: function () {}, saveAll: null,
    toast: function (m) { window.console && console.log(m); }
  };

  var INLINE = { B: 1, STRONG: 1, I: 1, EM: 1, SPAN: 1, BR: 1, SMALL: 1, U: 1, S: 1, MARK: 1, SUB: 1, SUP: 1, A: 1, CODE: 1, ABBR: 1, TIME: 1, LABEL: 1, WBR: 1 };
  var NON_TEXT = { IMG: 1, SVG: 1, INPUT: 1, TEXTAREA: 1, SELECT: 1, IFRAME: 1, VIDEO: 1, PICTURE: 1, CANVAS: 1 };
  var TOK = /\{\{([\w.]+)\}\}/g;

  var doc = document;
  var blocks = [].slice.call(doc.querySelectorAll('[data-ed]'));
  var initial = new Map();
  var sel = null;       // 지금 선택한 것 {type, el, blk}
  var editing = null;   // 글자를 고치고 있는 요소
  var savedRange = null;

  doc.documentElement.classList.add('ed-on');

  // ------------------------------------------------------------------
  // 준비
  // ------------------------------------------------------------------

  // 스크롤해야 나타나는 요소를 미리 보이게 (사이트 스크립트를 끈 상태이므로)
  [].slice.call(doc.querySelectorAll('.rv, .stg, .mask, .d2, #hero')).forEach(function (el) {
    if (!el.classList.contains('in')) { el.classList.add('in'); el.setAttribute('data-ed-in', ''); }
  });

  // 접힌 질문(details)은 편집 중에 펼쳐 두어 답변도 고칠 수 있게 (저장할 때 원래대로)
  [].slice.call(doc.querySelectorAll('[data-ed] details:not([open])')).forEach(function (d) {
    d.setAttribute('open', ''); d.setAttribute('data-ed-open', '');
  });

  blocks.forEach(function (b) {
    if (b.hasAttribute('data-block-hidden')) { b.style.display = ''; b.classList.add('ed-hidden'); }
    chipify(b);
    // 폼 입력칸은 편집 중에 글자가 들어가지 않게
    [].slice.call(b.querySelectorAll('input, textarea, select, button[type="submit"]')).forEach(function (f) {
      if (f.tagName !== 'BUTTON') { f.setAttribute('tabindex', '-1'); f.setAttribute('data-ed-tab', ''); }
    });
  });
  blocks.forEach(function (b) { initial.set(b, serialize(b)); });

  /** {{site.tel}} 같은 자리를 실제 값이 보이는 '고정 칩'으로 */
  function chipify(root) {
    var w = doc.createTreeWalker(root, NodeFilter.SHOW_TEXT, null), list = [];
    while (w.nextNode()) { if (w.currentNode.nodeValue.indexOf('{{') > -1) list.push(w.currentNode); }
    list.forEach(function (n) {
      var s = n.nodeValue, frag = doc.createDocumentFragment(), last = 0;
      s.replace(TOK, function (m, name, idx) {
        frag.appendChild(doc.createTextNode(s.slice(last, idx)));
        var sp = doc.createElement('span');
        sp.className = 'ed-token';
        sp.setAttribute('contenteditable', 'false');
        sp.setAttribute('data-ed-token', name);
        var v = Object.prototype.hasOwnProperty.call(C.tokens, name) ? C.tokens[name] : m;
        sp.textContent = v === '' ? '(비어 있음)' : v;
        sp.title = name.indexOf('site.') === 0
          ? '관리자 > 회사 정보에서 바꾸는 값입니다. 여기서 바꾸면 모든 화면에 함께 반영됩니다.'
          : '화면마다 자동으로 들어가는 값입니다.';
        frag.appendChild(sp);
        last = idx + m.length;
        return m;
      });
      frag.appendChild(doc.createTextNode(s.slice(last)));
      n.parentNode.replaceChild(frag, n);
    });
  }

  // ------------------------------------------------------------------
  // 저장 형식으로 정리 (편집기 흔적 제거)
  // ------------------------------------------------------------------
  function serialize(b) {
    var c = b.cloneNode(true);
    var all = [c].concat([].slice.call(c.querySelectorAll('*')));

    all.forEach(function (el) {
      if (el.hasAttribute('data-ed-in')) el.classList.remove('in');
      var add = el.getAttribute('data-ed-addcls');
      if (add) add.split(' ').forEach(function (k) { if (k) el.classList.remove(k); });
      if (el.hasAttribute('data-ed-tab')) el.removeAttribute('tabindex');
      if (el.hasAttribute('data-ed-open')) el.removeAttribute('open');
    });

    if (c.classList.contains('ed-hidden')) { c.setAttribute('data-block-hidden', ''); c.style.display = 'none'; }

    [].slice.call(c.querySelectorAll('.ed-token')).forEach(function (t) {
      t.parentNode.replaceChild(doc.createTextNode('{{' + t.getAttribute('data-ed-token') + '}}'), t);
    });
    [].slice.call(c.querySelectorAll('.ed-ui')).forEach(function (u) { u.parentNode.removeChild(u); });

    [c].concat([].slice.call(c.querySelectorAll('*'))).forEach(function (el) {
      el.removeAttribute('contenteditable');
      el.removeAttribute('spellcheck');
      [].slice.call(el.attributes).forEach(function (a) { if (a.name.indexOf('data-ed') === 0) el.removeAttribute(a.name); });
      [].slice.call(el.classList).forEach(function (k) { if (k.indexOf('ed-') === 0) el.classList.remove(k); });
      if (el.getAttribute('class') === '') el.removeAttribute('class');
      if (el.getAttribute('style') === '') el.removeAttribute('style');
    });

    // 보안 토큰 입력칸은 그릴 때마다 새로 들어가므로 자리만 남긴다
    [].slice.call(c.querySelectorAll('input[type="hidden"][name="' + C.csrfName + '"]')).forEach(function (i) {
      i.parentNode.replaceChild(doc.createTextNode('{{csrf}}'), i);
    });

    return c.outerHTML.split(C.base).join('{{base}}');
  }

  // ------------------------------------------------------------------
  // 무엇을 가리키는지 판단
  // ------------------------------------------------------------------
  function inlineDeep(el) {
    for (var i = 0; i < el.children.length; i++) {
      var n = el.children[i];
      if (n.classList.contains('ed-token')) continue;
      if (!INLINE[n.tagName] || !inlineDeep(n)) return false;
    }
    return true;
  }

  function isTextEl(el) {
    if (!el || el.nodeType !== 1 || NON_TEXT[el.tagName] || (el.closest && el.closest('svg'))) return false;
    if (el.classList.contains('ed-token')) return false;
    var has = false;
    for (var i = 0; i < el.childNodes.length; i++) {
      var n = el.childNodes[i];
      if (n.nodeType === 3) { if (n.nodeValue.trim()) has = true; }
      else if (n.nodeType === 1) {
        if (n.classList.contains('ed-token')) { has = true; continue; }
        if (!INLINE[n.tagName] || !inlineDeep(n)) return false;
        if (n.textContent.trim()) has = true;
      }
    }
    return has;
  }

  function findTarget(t) {
    if (!t || !t.closest || t.closest('.ed-ui')) return null;
    var blk = t.closest('[data-ed]');
    if (!blk) return null;
    if (t.tagName === 'IMG') return { type: 'img', el: t, blk: blk };
    if (t.closest('svg')) t = t.closest('svg').parentElement;
    if (t.classList && t.classList.contains('ed-token')) t = t.parentElement;
    if (/^(INPUT|TEXTAREA|SELECT)$/.test(t.tagName)) return { type: 'field', el: t, blk: blk };
    if (t.tagName === 'IFRAME') return { type: 'embed', el: t, blk: blk };

    var el = t, best = null;
    while (el && el !== blk.parentElement) {
      if (isTextEl(el)) best = el; else if (best) break;
      el = el.parentElement;
    }
    if (best) return { type: 'text', el: best, blk: blk };
    if (t === blk) return null;
    return { type: 'box', el: itemOf(t, blk) || t, blk: blk };
  }

  /** 같은 모양의 형제가 2개 이상인 가장 가까운 조상 = 복제·삭제할 '항목' */
  function itemOf(el, blk) {
    var x = el;
    while (x && x !== blk) {
      var p = x.parentElement;
      if (!p) break;
      var k = (x.className && typeof x.className === 'string') ? x.className.split(' ')[0] : '';
      var n = 0;
      for (var i = 0; i < p.children.length; i++) {
        var c = p.children[i];
        var ck = (c.className && typeof c.className === 'string') ? c.className.split(' ')[0] : '';
        if (c.tagName === x.tagName && ck === k) n++;
      }
      if (n >= 2 && x.tagName !== 'BR') return x;
      x = p;
    }
    return null;
  }

  var TYPE_LABEL = { text: '글자', img: '사진', field: '입력칸', embed: '지도·영상', box: '묶음' };

  // ------------------------------------------------------------------
  // 화면 위에 띄우는 것들 (편집기 UI) — 모두 .ed-ui, 저장 대상 영역 밖에 둔다
  // ------------------------------------------------------------------
  function ui(tag, cls, html) {
    var e = doc.createElement(tag);
    e.className = 'ed-ui ' + cls;
    if (html != null) e.innerHTML = html;
    return e;
  }
  var hov = ui('div', 'ed-hov'); hov.appendChild(ui('span', 'ed-hov__tag'));
  var box = ui('div', 'ed-sel');
  var bar = ui('div', 'ed-bar');
  var bbar = ui('div', 'ed-bbar');
  var fileIn = doc.createElement('input');
  fileIn.type = 'file'; fileIn.accept = 'image/*'; fileIn.className = 'ed-ui'; fileIn.style.display = 'none';
  [hov, box, bar, bbar, fileIn].forEach(function (e) { doc.body.appendChild(e); });

  function place(el, r) {
    el.style.top = r.top + 'px'; el.style.left = r.left + 'px';
    el.style.width = r.width + 'px'; el.style.height = r.height + 'px';
  }

  function blockLabel(b) {
    var key = b.getAttribute('data-ed');
    var name = key.slice(key.lastIndexOf('/') + 1);
    var named = { head: '상단 메뉴 (모든 화면 공통)', drawer: '모바일 메뉴 (모든 화면 공통)', foot: '바닥글 (모든 화면 공통)', subhero: '상단 제목', pagenav: '화면 안 메뉴', hero: '첫 화면' };
    if (named[name]) return named[name];
    var h = b.querySelector('h1, h2, h3');
    var t = h ? h.textContent.replace(/\s+/g, ' ').trim() : '';
    return (t ? t.slice(0, 28) : name) + ' 영역';
  }

  // 마우스 올림
  var hovBlk = null;
  doc.addEventListener('mousemove', function (e) {
    if (e.target.closest && e.target.closest('.ed-ui')) return;
    var t = findTarget(e.target);
    if (!t || (sel && t.el === sel.el)) { hov.style.display = 'none'; }
    else {
      hov.style.display = 'block';
      place(hov, t.el.getBoundingClientRect());
      var lb = TYPE_LABEL[t.type];
      if (t.type === 'text' && t.el.closest('a')) lb = '링크 글자';
      hov.firstChild.textContent = lb;
    }
    var b = e.target.closest && e.target.closest('[data-ed]');
    if (b && b !== hovBlk) { hovBlk = b; drawBlockBar(); }
  }, { passive: true });

  doc.addEventListener('mouseleave', function () { hov.style.display = 'none'; });

  // 영역 막대 (숨기기 · 원래대로)
  function drawBlockBar() {
    var b = hovBlk;
    if (!b) { bbar.style.display = 'none'; return; }
    var st = C.state[b.getAttribute('data-ed')] || {};
    var dirty = serialize(b) !== initial.get(b);
    var tag = dirty ? '<i class="ed-dot ed-dot--dirty"></i>저장 안 됨' : (st.draft ? '<i class="ed-dot ed-dot--draft"></i>게시 대기' : (st.changed ? '<i class="ed-dot ed-dot--live"></i>수정됨' : ''));
    bbar.innerHTML = '<b>' + esc(blockLabel(b)) + '</b>' + (tag ? '<span class="ed-bbar__st">' + tag + '</span>' : '') +
      '<button type="button" data-act="hide">' + (b.classList.contains('ed-hidden') ? '다시 보이기' : '영역 숨기기') + '</button>' +
      ((st.changed || dirty) ? '<button type="button" data-act="reset">원래대로</button>' : '');
    bbar.style.display = 'flex';
    posBlockBar();
  }
  function posBlockBar() {
    if (!hovBlk) return;
    var r = hovBlk.getBoundingClientRect();
    // 고정된 상단 메뉴 아래로 내려 놓는다 (메뉴 자체를 가리킬 때는 제외)
    var hd = doc.getElementById('head'), minTop = 0;
    if (hd && hovBlk !== hd && getComputedStyle(hd).position === 'fixed') minTop = hd.getBoundingClientRect().bottom;
    var top = Math.max(r.top, minTop) + 8;
    if (top > r.bottom - 30) top = r.bottom - 30;
    bbar.style.top = top + 'px';
    bbar.style.left = Math.max(8, r.left + 8) + 'px';
    bbar.style.display = (r.bottom < 40 || r.top > window.innerHeight - 20) ? 'none' : 'flex';
  }
  bbar.addEventListener('mousedown', function (e) { e.preventDefault(); });
  bbar.addEventListener('click', function (e) {
    var a = e.target.closest('button'); if (!a || !hovBlk) return;
    if (a.dataset.act === 'hide') {
      hovBlk.classList.toggle('ed-hidden');
      changed(); drawBlockBar();
    } else if (a.dataset.act === 'reset') {
      var others = dirtyCount() - (serialize(hovBlk) !== initial.get(hovBlk) ? 1 : 0);
      var msg = '이 영역을 처음 만든 모습으로 되돌릴까요?\n(임시 저장되며, 게시해야 홈페이지에 반영됩니다)';
      if (others > 0) msg += '\n\n※ 저장하지 않은 다른 영역의 변경은 먼저 저장됩니다.';
      if (!window.confirm(msg)) return;
      var key = hovBlk.getAttribute('data-ed');
      var go = function () { return api.post(C.urls.reset, { key: key }); };
      (others > 0 ? ED.save().then(go) : go()).then(function () { reloadKeepScroll(); })
        .catch(function (err) { api.toast(err.message, true); });
    }
  });

  // ------------------------------------------------------------------
  // 선택 · 글자 고치기
  // ------------------------------------------------------------------
  doc.addEventListener('pointerdown', function (e) {
    if (e.target.closest && e.target.closest('.ed-ui')) return;
    var t = findTarget(e.target);
    if (!t) { deselect(); return; }
    if (t.type === 'field' || t.type === 'embed') e.preventDefault();
    select(t);
  }, true);

  // 링크 이동·폼 전송·라벨 클릭 막기
  doc.addEventListener('click', function (e) {
    if (e.target.closest && e.target.closest('.ed-ui')) return;
    var a = e.target.closest && e.target.closest('a, label, button, summary');
    if (a) e.preventDefault();
  }, true);
  doc.addEventListener('submit', function (e) { e.preventDefault(); }, true);

  function select(t) {
    if (editing && editing !== t.el) stopEditing();
    sel = t;
    if (t.type === 'text') startEditing(t.el);
    hov.style.display = 'none';
    box.style.display = 'block';
    box.setAttribute('data-type', t.type);
    drawBar();
    posUI();
  }
  function deselect() {
    stopEditing();
    sel = null;
    box.style.display = 'none';
    bar.style.display = 'none';
  }

  function startEditing(el) {
    if (editing === el) return;
    editing = el;
    el.setAttribute('contenteditable', 'true');
    el.setAttribute('spellcheck', 'false');
    el.setAttribute('data-ed-editing', '');
  }
  function stopEditing() {
    if (!editing) return;
    var el = editing;
    editing = null;
    el.removeAttribute('contenteditable');
    el.removeAttribute('spellcheck');
    el.removeAttribute('data-ed-editing');
    // 브라우저가 남기는 빈 꼬리표 정리
    [].slice.call(el.querySelectorAll('span:not([class]):not([style])')).forEach(function (s) {
      if (!s.attributes.length) { while (s.firstChild) s.parentNode.insertBefore(s.firstChild, s); s.parentNode.removeChild(s); }
    });
    [].slice.call(el.querySelectorAll('[style]')).forEach(function (s) {
      if (!s.closest('svg') && !s.classList.contains('fz') && /font-size|line-height|background-color|color: rgb/.test(s.getAttribute('style')) && !s.hasAttribute('data-keep-style')) s.removeAttribute('style');
    });
    changed();
  }

  doc.addEventListener('keydown', function (e) {
    if ((e.ctrlKey || e.metaKey) && (e.key === 's' || e.key === 'S')) {
      e.preventDefault();
      if (host && host.saveAll) host.saveAll(); else ED.save();
      return;
    }
    if (!editing) return;
    if (e.key === 'Enter') { e.preventDefault(); doc.execCommand('insertLineBreak'); }
    else if (e.key === 'Escape') { e.preventDefault(); deselect(); }
  });

  // 붙여넣기는 글자만 (다른 사이트의 글꼴·색이 따라오지 않게)
  doc.addEventListener('paste', function (e) {
    if (!editing) return;
    e.preventDefault();
    var text = (e.clipboardData || window.clipboardData).getData('text/plain');
    doc.execCommand('insertText', false, text.replace(/\r\n?/g, '\n'));
  });

  doc.addEventListener('input', function () { changed(); posUI(); });

  // ------------------------------------------------------------------
  // 도구 막대
  // ------------------------------------------------------------------
  var ICON = {
    bold: '<svg viewBox="0 0 24 24"><path d="M7 5h6a3.5 3.5 0 010 7H7zM7 12h7a3.5 3.5 0 010 7H7z"/></svg>',
    em: '<svg viewBox="0 0 24 24"><path d="M4 20h16"/><path d="M8 16l4-11 4 11M9.5 12h5"/></svg>',
    link: '<svg viewBox="0 0 24 24"><path d="M10 14a4 4 0 005.66 0l3-3a4 4 0 00-5.66-5.66l-1 1"/><path d="M14 10a4 4 0 00-5.66 0l-3 3a4 4 0 005.66 5.66l1-1"/></svg>',
    unlink: '<svg viewBox="0 0 24 24"><path d="M9 15l6-6"/><path d="M5 5l14 14"/></svg>',
    dup: '<svg viewBox="0 0 24 24"><rect x="8" y="8" width="12" height="12" rx="2"/><path d="M16 8V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2"/></svg>',
    del: '<svg viewBox="0 0 24 24"><path d="M4 7h16M10 11v6M14 11v6M6 7l1 12a2 2 0 002 2h6a2 2 0 002-2l1-12M9 7V4h6v3"/></svg>',
    prev: '<svg viewBox="0 0 24 24"><path d="M15 6l-6 6 6 6"/></svg>',
    next: '<svg viewBox="0 0 24 24"><path d="M9 6l6 6-6 6"/></svg>',
    up: '<svg viewBox="0 0 24 24"><path d="M12 19V5M6 11l6-6 6 6"/></svg>',
    fzdn: '<svg viewBox="0 0 24 24"><path d="M3 18l4-11 4 11M4.5 14h5"/><path d="M15 12h6"/></svg>',
    fzup: '<svg viewBox="0 0 24 24"><path d="M3 18l4-11 4 11M4.5 14h5"/><path d="M15 12h6M18 9v6"/></svg>',
    fzreset: '<svg viewBox="0 0 24 24"><path d="M4 12a8 8 0 108-8 8.5 8.5 0 00-6 2.5L4 8"/><path d="M4 4v4h4"/></svg>',
    img: '<svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="M21 16l-5-5-6 6-3-3-4 4"/></svg>'
  };

  function btn(act, label, icon, cls) {
    return '<button type="button" class="' + (cls || '') + '" data-act="' + act + '" title="' + label + '">' + (icon ? ICON[icon] : '') + '<span>' + label + '</span></button>';
  }

  function drawBar() {
    if (!sel) return;
    var h = '', t = sel.type, el = sel.el;
    var link = el.closest('a') || (t === 'text' ? el.querySelector('a') : null);
    if (t === 'box' && el.tagName === 'A') link = el;

    if (t === 'text') {
      h += '<div class="ed-bar__grp">' + btn('bold', '굵게', 'bold', 'ic') + btn('em', '강조색', 'em', 'ic') +
        (link ? btn('unlink', '링크 해제', 'unlink', 'ic') : btn('link', '링크 걸기', 'link', 'ic')) + '</div>' +
        '<div class="ed-bar__grp ed-bar__fz"><em>글자 크기</em>' + btn('fzdn', '작게', 'fzdn', 'ic') +
        '<b class="ed-bar__fzv" title="원래 크기 대비">' + fzCur(el) + '%</b>' + btn('fzup', '크게', 'fzup', 'ic') +
        btn('fzreset', '크기 원래대로', 'fzreset', 'ic') + '</div>';
    }
    if (t === 'img') {
      h += '<div class="ed-bar__grp">' + btn('img', '사진 바꾸기', 'img', 'pri') + '</div>' +
        '<label class="ed-bar__fld"><span>사진 설명</span><input data-fld="alt" value="' + escA(el.getAttribute('alt') || '') + '" placeholder="눈이 불편한 분께 읽어 주는 설명"></label>';
    }
    if (t === 'field') {
      h += '<label class="ed-bar__fld"><span>안내 문구</span><input data-fld="placeholder" value="' + escA(el.getAttribute('placeholder') || '') + '"></label>';
    }
    if (t === 'embed') {
      h += '<label class="ed-bar__fld ed-bar__fld--wide"><span>지도·영상 주소</span><input data-fld="src" value="' + escA(el.getAttribute('src') || '') + '"></label>';
    }
    if (link) {
      h += '<label class="ed-bar__fld ed-bar__fld--wide"><span>링크 주소</span><input data-fld="href" value="' + escA(link.getAttribute('href') || '') + '" placeholder="about.html, https://…, tel:…"></label>' +
        '<label class="ed-bar__chk"><input type="checkbox" data-fld="blank"' + (link.getAttribute('target') === '_blank' ? ' checked' : '') + '> 새 창</label>';
    }

    var item = itemOf(el, sel.blk);
    if (item) {
      h += '<div class="ed-bar__grp ed-bar__grp--item"><em>항목</em>' + btn('prev', '앞으로', 'prev', 'ic') + btn('next', '뒤로', 'next', 'ic') +
        btn('dup', '복제', 'dup', 'ic') + btn('del', '삭제', 'del', 'ic danger') + '</div>';
    }
    if (el.parentElement && el.parentElement !== sel.blk.parentElement && el !== sel.blk) {
      h += btn('parent', '바깥 묶음 선택', 'up', 'ic');
    }
    bar.innerHTML = h || '<span class="ed-bar__note">이 부분은 고칠 내용이 없습니다</span>';
    bar.style.display = 'flex';
  }

  // 막대를 누를 때 글자 선택이 풀리지 않도록
  bar.addEventListener('mousedown', function (e) {
    if (e.target.tagName !== 'INPUT') e.preventDefault();
    var s = window.getSelection();
    if (s.rangeCount && editing && editing.contains(s.anchorNode)) savedRange = s.getRangeAt(0).cloneRange();
  });

  bar.addEventListener('click', function (e) {
    var b = e.target.closest('button'); if (!b || !sel) return;
    var act = b.dataset.act, el = sel.el;
    var item = itemOf(el, sel.blk);

    if (act === 'bold') { doc.execCommand('bold'); }
    else if (act === 'em') { toggleEm(); }
    else if (act === 'link') { addLink(); }
    else if (act === 'unlink') {
      var a = el.closest('a') || el.querySelector('a');
      if (a) { while (a.firstChild) a.parentNode.insertBefore(a.firstChild, a); a.parentNode.removeChild(a); }
    }
    else if (act === 'img') { fileIn.click(); return; }
    else if (act === 'fzup' || act === 'fzdn' || act === 'fzreset') { fzStep(el, act); }
    else if (act === 'dup' && item) {
      var cp = item.cloneNode(true);
      [].slice.call(cp.querySelectorAll('[contenteditable]')).concat([cp]).forEach(function (x) { x.removeAttribute('contenteditable'); x.removeAttribute('data-ed-editing'); });
      item.parentNode.insertBefore(cp, item.nextSibling);
      stopEditing();
      var nt = findTarget(cp.querySelector('img') || cp) || { type: 'box', el: cp, blk: sel.blk };
      select(nt.type === 'text' ? nt : { type: 'box', el: cp, blk: sel.blk });
      flash(cp);
    }
    else if (act === 'del' && item) {
      var same = [].slice.call(item.parentNode.children).filter(function (c) { return c.tagName === item.tagName; });
      if (same.length <= 1 && !window.confirm('마지막 남은 항목입니다. 지울까요?')) return;
      item.parentNode.removeChild(item);
      deselect();
    }
    else if ((act === 'prev' || act === 'next') && item) {
      var sib = act === 'prev' ? item.previousElementSibling : item.nextElementSibling;
      if (sib) {
        if (act === 'prev') item.parentNode.insertBefore(item, sib);
        else item.parentNode.insertBefore(sib, item);
        flash(item);
      }
    }
    else if (act === 'parent') {
      stopEditing();
      var p = el.parentElement;
      select({ type: 'box', el: p, blk: sel.blk });
      return;
    }
    changed(); drawBar(); posUI();
  });

  bar.addEventListener('input', function (e) {
    var f = e.target.getAttribute('data-fld'); if (!f || !sel) return;
    var el = sel.el;
    var link = el.closest('a') || (sel.type === 'text' ? el.querySelector('a') : null) || (el.tagName === 'A' ? el : null);
    if (f === 'href' && link) link.setAttribute('href', e.target.value.trim());
    else if (f === 'blank' && link) {
      if (e.target.checked) { link.setAttribute('target', '_blank'); link.setAttribute('rel', 'noopener'); }
      else { link.removeAttribute('target'); link.removeAttribute('rel'); }
    }
    else if (f === 'alt' || f === 'placeholder' || f === 'src') el.setAttribute(f, e.target.value);
    changed();
  });
  bar.addEventListener('change', function (e) { if (e.target.type === 'checkbox') bar.dispatchEvent(new Event('input', { bubbles: true })); });

  // ------------------------------------------------------------------
  // 글자 크기 — <span class="fz" style="font-size:1.2em"> 로 감싼다.
  // em 이라서 PC·휴대폰 어디서나 '원래 크기의 몇 %' 로 같은 비율이 유지된다.
  // 글자를 끌어서 고르면 그 부분만, 안 고르면 이 글자 묶음 전체가 바뀐다.
  // ------------------------------------------------------------------
  var FZ_MIN = 50, FZ_MAX = 300, FZ_STEP = 10;
  function fzWhole(el) {
    var kids = [].filter.call(el.childNodes, function (n) { return !(n.nodeType === 3 && !n.nodeValue.trim()); });
    return (kids.length === 1 && kids[0].nodeType === 1 && kids[0].classList.contains('fz')) ? kids[0] : null;
  }
  function fzPct(span) { return span ? (Math.round(parseFloat(span.style.fontSize) * 100) || 100) : 100; }
  function fzCur(el) { return fzPct(fzWhole(el)); }
  function fzUnwrap(sp) { while (sp.firstChild) sp.parentNode.insertBefore(sp.firstChild, sp); sp.parentNode.removeChild(sp); }
  function fzApply(sp, pct) {
    if (pct === 100) { fzUnwrap(sp); return null; }
    sp.style.fontSize = (pct / 100) + 'em';
    return sp;
  }
  function fzNext(cur, act) {
    if (act === 'fzreset') return 100;
    var n = cur + (act === 'fzup' ? FZ_STEP : -FZ_STEP);
    return Math.max(FZ_MIN, Math.min(FZ_MAX, n));
  }
  function fzStep(el, act) {
    var s = window.getSelection();
    var r = (savedRange && !savedRange.collapsed && el.contains(savedRange.commonAncestorContainer)) ? savedRange : null;
    if (r && r.toString().trim() && r.toString().trim() !== el.textContent.trim()) {
      // 고른 부분만
      var anc = r.commonAncestorContainer; anc = anc.nodeType === 1 ? anc : anc.parentElement;
      var sp = anc.closest('.fz');
      if (!(sp && el.contains(sp) && sp !== fzWhole(el) && sp.textContent.trim() === r.toString().trim())) {
        if (act === 'fzreset') return;
        sp = doc.createElement('span'); sp.className = 'fz';
        sp.appendChild(r.extractContents());
        r.insertNode(sp);
        [].slice.call(sp.querySelectorAll('.fz')).forEach(fzUnwrap);
      }
      var kept = fzApply(sp, fzNext(fzPct(sp), act));
      if (kept) {
        var nr = doc.createRange(); nr.selectNodeContents(kept);
        s.removeAllRanges(); s.addRange(nr); savedRange = nr.cloneRange();
      } else { savedRange = null; }
      return;
    }
    // 묶음 전체
    var w = fzWhole(el);
    var next = fzNext(fzPct(w), act);
    if (act === 'fzreset') [].slice.call(el.querySelectorAll('.fz')).forEach(fzUnwrap);
    if (next === 100) { if (w && w.parentNode) fzUnwrap(w); return; }
    if (!w) { w = doc.createElement('span'); w.className = 'fz'; while (el.firstChild) w.appendChild(el.firstChild); el.appendChild(w); }
    fzApply(w, next);
  }

  function restoreRange() {
    if (!savedRange) return false;
    var s = window.getSelection(); s.removeAllRanges(); s.addRange(savedRange);
    return true;
  }

  function toggleEm() {
    restoreRange();
    var s = window.getSelection();
    if (!s.rangeCount || !editing) return;
    var node = s.anchorNode && (s.anchorNode.nodeType === 1 ? s.anchorNode : s.anchorNode.parentElement);
    var em = node && node.closest('em');
    if (em && editing.contains(em)) {
      while (em.firstChild) em.parentNode.insertBefore(em.firstChild, em);
      em.parentNode.removeChild(em);
      return;
    }
    var txt = s.toString();
    if (!txt) { api.toast('강조할 글자를 먼저 끌어서 선택해 주세요.'); return; }
    doc.execCommand('insertHTML', false, '<em>' + esc(txt) + '</em>');
  }

  function addLink() {
    restoreRange();
    var s = window.getSelection();
    if (!s.rangeCount || !s.toString()) { api.toast('링크를 걸 글자를 먼저 끌어서 선택해 주세요.'); return; }
    var r = s.getRangeAt(0).cloneRange();
    var url = window.prompt('링크 주소를 입력하세요 (예: about.html, https://…)', 'https://');
    if (!url) return;
    s.removeAllRanges(); s.addRange(r);
    doc.execCommand('createLink', false, url.trim());
  }

  fileIn.addEventListener('change', function () {
    var f = fileIn.files && fileIn.files[0];
    if (!f || !sel || sel.type !== 'img') return;
    var img = sel.el;
    var fd = new FormData();
    fd.append('image', f);
    img.classList.add('ed-loading');
    api.post(C.urls.upload, fd, true).then(function (j) {
      img.setAttribute('src', j.url);
      img.removeAttribute('srcset');
      img.removeAttribute('loading');
      img.classList.remove('ed-loading');
      img.onload = function () { posUI(); };
      changed();
    }).catch(function (err) {
      img.classList.remove('ed-loading');
      api.toast(err.message, true);
    });
    fileIn.value = '';
  });

  function flash(el) {
    el.classList.add('ed-flash');
    setTimeout(function () { el.classList.remove('ed-flash'); }, 700);
  }

  // 상단 메뉴 색 맞추기 — 사이트 스크립트(v2.js)가 하던 일을 편집기에서 대신한다.
  // 붙이는 클래스는 임시 표시라 저장할 때 빠진다.
  var headEl = doc.getElementById('head');
  var navSecs = [].slice.call(doc.querySelectorAll('[data-nav]'));
  function syncHead() {
    if (!headEl) return;
    addTempClass(headEl, 'stuck', window.scrollY > 40);
    var line = (headEl.offsetHeight || 80) * 0.5, theme = 'dark';
    for (var i = 0; i < navSecs.length; i++) {
      var r = navSecs[i].getBoundingClientRect();
      if (r.top <= line && r.bottom > line) { theme = navSecs[i].getAttribute('data-nav'); break; }
    }
    addTempClass(headEl, 'light', theme === 'light');
  }

  // ------------------------------------------------------------------
  // 위치 다시 잡기
  // ------------------------------------------------------------------
  function posUI() {
    syncHead();
    if (sel && sel.el.isConnected) {
      var r = sel.el.getBoundingClientRect();
      place(box, r);
      var bh = bar.offsetHeight || 44, bw = bar.offsetWidth || 300;
      var top = r.top - bh - 10;
      if (top < 8) top = r.bottom + 10;
      if (top > window.innerHeight - bh - 8) top = Math.max(8, window.innerHeight - bh - 8);
      var left = Math.min(Math.max(8, r.left), window.innerWidth - bw - 8);
      bar.style.top = top + 'px'; bar.style.left = Math.max(8, left) + 'px';
    } else if (sel) { deselect(); }
    posBlockBar();
  }
  window.addEventListener('scroll', posUI, { passive: true });
  window.addEventListener('resize', posUI);

  // ------------------------------------------------------------------
  // 변경 감지
  // ------------------------------------------------------------------
  var dirtyTimer = null;
  function changed() {
    clearTimeout(dirtyTimer);
    dirtyTimer = setTimeout(function () { api.onDirty(dirtyCount()); if (hovBlk) drawBlockBar(); }, 250);
  }
  function dirtyCount() {
    var n = 0;
    blocks.forEach(function (b) { if (serialize(b) !== initial.get(b)) n++; });
    return n;
  }

  function reloadKeepScroll() {
    try { sessionStorage.setItem('ed-scroll', String(window.scrollY)); } catch (e) { /* 저장 못 해도 괜찮다 */ }
    location.reload();
  }
  try {
    var sy = sessionStorage.getItem('ed-scroll');
    if (sy) { sessionStorage.removeItem('ed-scroll'); window.scrollTo(0, +sy); }
  } catch (e) { /* 무시 */ }

  function addTempClass(el, cls, on) {
    if (!el) return;
    var list = (el.getAttribute('data-ed-addcls') || '').split(' ').filter(Boolean);
    if (on) {
      if (el.classList.contains(cls) && list.indexOf(cls) < 0) return; // 원래 붙어 있던 것
      el.classList.add(cls);
      if (list.indexOf(cls) < 0) list.push(cls);
    } else {
      el.classList.remove(cls);
      list = list.filter(function (k) { return k !== cls; });
    }
    if (list.length) el.setAttribute('data-ed-addcls', list.join(' ')); else el.removeAttribute('data-ed-addcls');
  }

  function esc(s) { return String(s).replace(/[&<>]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;' }[c]; }); }
  function escA(s) { return esc(s).replace(/"/g, '&quot;'); }

  // ------------------------------------------------------------------
  // 바깥(관리자 화면)에서 부르는 함수
  // ------------------------------------------------------------------
  window.ED = {
    page: C.page,
    meta: C.meta,
    dirtyCount: dirtyCount,
    save: function (meta) {
      stopEditing();
      var payload = { page: C.page, blocks: {} };
      if (meta) payload.meta = meta;
      var touched = [];
      blocks.forEach(function (b) {
        var s = serialize(b);
        if (s !== initial.get(b)) { payload.blocks[b.getAttribute('data-ed')] = s; touched.push([b, s]); }
      });
      if (!touched.length && !meta) return Promise.resolve({ ok: true, saved: 0 });
      return api.post(C.urls.save, payload).then(function (j) {
        touched.forEach(function (p) {
          initial.set(p[0], p[1]);
          var k = p[0].getAttribute('data-ed');
          C.state[k] = { changed: true, draft: true };
        });
        api.onDirty(dirtyCount());
        if (hovBlk) drawBlockBar();
        return j;
      });
    },
    toggle: function (what, on) {
      if (what === 'mega') addTempClass(doc.getElementById('head'), 'mega-open', on);
      if (what === 'drawer') addTempClass(doc.getElementById('drawer'), 'open', on);
      if (what === 'outline') doc.documentElement.classList.toggle('ed-outline', on);
      posUI();
    },
    reload: reloadKeepScroll
  };

  syncHead();
  api.onReady({ page: C.page, meta: C.meta, blocks: blocks.length });
})();
