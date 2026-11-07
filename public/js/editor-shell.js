/* 홈페이지 편집기 — 바깥 막대(관리자 화면).
 * 서버 요청은 모두 여기 EDAPI.post 를 거친다. CSRF 토큰이 요청마다 바뀌므로 한 곳에서 갈아 끼운다.
 */
(function () {
  'use strict';
  var S = window.SHELL;
  var $ = function (id) { return document.getElementById(id); };
  var frame = $('frame'), wrap = $('frameWrap');
  var hash = S.csrfHash;
  var dirty = 0, drafts = S.drafts, meta = null, busy = false;

  // ------------------------------------------------------------------
  // 화면 안 편집기(editor.js)가 부르는 통로
  // ------------------------------------------------------------------
  window.EDAPI = {
    post: function (url, body, isForm) {
      var h = { 'X-Requested-With': 'XMLHttpRequest' };
      h[S.csrfHeader] = hash;
      if (!isForm) { h['Content-Type'] = 'application/json'; body = JSON.stringify(body || {}); }
      return fetch(url, { method: 'POST', headers: h, body: body, credentials: 'same-origin' }).then(function (r) {
        return r.json().catch(function () { return {}; }).then(function (j) {
          if (j.csrf) hash = j.csrf;
          if (r.status === 403 && !j.csrf) throw new Error('보안 확인이 만료되었습니다. 화면을 새로 고친 뒤 다시 시도해 주세요.');
          if (!r.ok || !j.ok) throw new Error(j.message || '요청을 처리하지 못했습니다. (' + r.status + ')');
          if (typeof j.drafts === 'number') setDrafts(j.drafts);
          return j;
        });
      });
    },
    onReady: function (info) {
      meta = info.meta;
      $('metaTitle').value = meta.title || '';
      $('metaDesc').value = meta.desc || '';
      dirty = 0; metaDirty = false;
      // 펼침 상태를 새 화면에도 이어서
      [].slice.call(document.querySelectorAll('.sb__tg')).forEach(function (b) {
        if (b.getAttribute('aria-pressed') === 'true') ed() && ed().toggle(b.dataset.tg, true);
      });
      paint();
    },
    onDirty: function (n) { dirty = n; paint(); },
    saveAll: function () { return save(); },
    toast: function (m, err) { toast(m, err); }
  };

  function ed() { try { return frame.contentWindow.ED; } catch (e) { return null; } }

  // ------------------------------------------------------------------
  // 상태 표시
  // ------------------------------------------------------------------
  var metaDirty = false;
  function totalDirty() { return dirty + (metaDirty ? 1 : 0); }

  function paint() {
    var n = totalDirty();
    $('btnSave').disabled = n === 0 || busy;
    $('btnSave').textContent = n ? '저장 (' + n + ')' : '저장';
    var st = $('status');
    if (busy) { st.textContent = '처리 중…'; st.className = 'sb__st'; }
    else if (n) { st.textContent = '저장하지 않은 변경 ' + n + '곳'; st.className = 'sb__st is-dirty'; }
    else if (drafts) { st.textContent = '임시 저장됨 · 게시 대기 ' + drafts; st.className = 'sb__st is-draft'; }
    else { st.textContent = '홈페이지와 같음'; st.className = 'sb__st is-ok'; }
  }
  function setDrafts(n) {
    drafts = n;
    var b = $('draftBadge');
    b.textContent = n; b.hidden = !n;
    paint();
  }

  var toastT = null;
  function toast(msg, err) {
    var t = $('toast');
    t.textContent = msg; t.hidden = false;
    t.className = 'toast' + (err ? ' toast--err' : '');
    clearTimeout(toastT);
    toastT = setTimeout(function () { t.hidden = true; }, err ? 6000 : 3200);
  }

  // ------------------------------------------------------------------
  // 저장 · 게시
  // ------------------------------------------------------------------
  function save() {
    var e = ed();
    if (!e || busy) return Promise.resolve();
    if (!totalDirty()) { toast('저장할 변경이 없습니다.'); return Promise.resolve(); }
    busy = true; paint();
    var m = metaDirty ? {
      title: $('metaTitle').value, desc: $('metaDesc').value,
      original_title: meta.originalTitle, original_desc: meta.originalDesc
    } : null;
    return e.save(m).then(function () {
      if (m) { meta.title = m.title; meta.desc = m.desc; metaDirty = false; }
      busy = false; paint();
      toast('임시 저장했습니다. 홈페이지에 반영하려면 ‘홈페이지에 게시’를 누르세요.');
    }).catch(function (err) {
      busy = false; paint(); toast(err.message, true);
      throw err;
    });
  }

  function publish() {
    var go = function () {
      if (!drafts) { toast('게시할 내용이 없습니다. 먼저 고치고 저장해 주세요.'); return; }
      var note = window.prompt('이번 게시에 대한 메모 (선택 — 이력에 남습니다)', '');
      if (note === null) return;
      busy = true; paint();
      EDAPI.post(S.urls.publish, { note: note }).then(function (j) {
        busy = false; setDrafts(0);
        toast(j.published + '개 영역을 홈페이지에 게시했습니다.');
        if (!$('panel').hidden) loadStatus();
      }).catch(function (err) { busy = false; paint(); toast(err.message, true); });
    };
    if (totalDirty()) {
      if (!window.confirm('저장하지 않은 변경이 있습니다. 저장하고 게시할까요?')) return;
      save().then(go, function () {});
    } else go();
  }

  $('btnSave').addEventListener('click', function () { save().catch(function () {}); });
  $('btnPub').addEventListener('click', publish);
  $('pubNow').addEventListener('click', publish);

  $('btnPreview').addEventListener('click', function () {
    var o = $('pageSel').selectedOptions[0];
    if (totalDirty()) toast('저장하지 않은 변경은 미리보기에 나오지 않습니다.');
    window.open(o.dataset.url + '?preview=1', '_blank', 'noopener');
  });

  // ------------------------------------------------------------------
  // 화면 바꾸기 · 기기 크기 · 펼치기
  // ------------------------------------------------------------------
  $('pageSel').addEventListener('change', function () {
    var o = this.selectedOptions[0];
    if (totalDirty() && !window.confirm('저장하지 않은 변경이 있습니다. 버리고 다른 화면으로 갈까요?')) {
      this.value = S.page; return;
    }
    S.page = this.value;
    dirty = 0; metaDirty = false;
    $('status').textContent = '불러오는 중…';
    frame.src = o.dataset.url + '?edit=1';
    history.replaceState(null, '', S.urls.editor + '?page=' + encodeURIComponent(this.value));
  });

  [].slice.call(document.querySelectorAll('[data-dev]')).forEach(function (b) {
    if (b.tagName !== 'BUTTON') return;
    b.addEventListener('click', function () {
      [].slice.call(document.querySelectorAll('.sb__seg button')).forEach(function (x) { x.classList.toggle('on', x === b); });
      wrap.setAttribute('data-dev', b.dataset.dev);
    });
  });

  [].slice.call(document.querySelectorAll('.sb__tg')).forEach(function (b) {
    b.addEventListener('click', function () {
      var on = b.getAttribute('aria-pressed') !== 'true';
      b.setAttribute('aria-pressed', on ? 'true' : 'false');
      if (b.dataset.tg === 'drawer' && on && wrap.getAttribute('data-dev') === 'pc') {
        document.querySelector('.sb__seg [data-dev="mo"]').click();
      }
      var e = ed(); if (e) e.toggle(b.dataset.tg, on);
    });
  });

  // ------------------------------------------------------------------
  // 오른쪽 패널
  // ------------------------------------------------------------------
  function openPanel(tab) {
    $('panel').hidden = false;
    document.body.classList.add('with-panel');
    [].slice.call(document.querySelectorAll('[data-tab]')).forEach(function (t) { t.setAttribute('aria-selected', t.dataset.tab === tab ? 'true' : 'false'); });
    [].slice.call(document.querySelectorAll('[data-pane]')).forEach(function (p) { p.hidden = p.dataset.pane !== tab; });
    if (tab === 'pub') loadStatus();
  }
  $('btnInfo').addEventListener('click', function () { $('panel').hidden ? openPanel('info') : closePanel(); });
  $('draftBadge').addEventListener('click', function (e) { e.stopPropagation(); openPanel('pub'); });
  function closePanel() { $('panel').hidden = true; document.body.classList.remove('with-panel'); }
  $('panelClose').addEventListener('click', closePanel);
  [].slice.call(document.querySelectorAll('[data-tab]')).forEach(function (t) {
    t.addEventListener('click', function () { openPanel(t.dataset.tab); });
  });

  ['metaTitle', 'metaDesc'].forEach(function (id) {
    $(id).addEventListener('input', function () {
      metaDirty = meta && ($('metaTitle').value !== (meta.title || '') || $('metaDesc').value !== (meta.desc || ''));
      paint();
    });
  });
  $('metaReset').addEventListener('click', function () {
    if (!meta) return;
    $('metaTitle').value = meta.originalTitle; $('metaDesc').value = meta.originalDesc;
    $('metaTitle').dispatchEvent(new Event('input'));
  });

  $('pageReset').addEventListener('click', function () {
    if (!window.confirm('이 화면의 모든 영역을 처음 모습으로 되돌릴까요?\n(상단 메뉴·바닥글은 제외. 임시 저장되며 게시해야 반영됩니다)')) return;
    EDAPI.post(S.urls.reset, { page: S.page }).then(function () {
      dirty = 0; metaDirty = false;
      var e = ed(); if (e) e.reload();
      toast('되돌렸습니다. 확인 후 게시하세요.');
    }).catch(function (err) { toast(err.message, true); });
  });

  $('discard').addEventListener('click', function () {
    if (!window.confirm('임시 저장한 내용을 모두 버리고 지금 홈페이지 상태로 돌아갈까요?')) return;
    EDAPI.post(S.urls.discard, {}).then(function () {
      dirty = 0; metaDirty = false; setDrafts(0);
      var e = ed(); if (e) e.reload();
      loadStatus();
      toast('임시 저장을 버렸습니다.');
    }).catch(function (err) { toast(err.message, true); });
  });

  function esc(s) { return String(s == null ? '' : s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); }

  function loadStatus() {
    fetch(S.urls.status, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
      .then(function (r) { return r.json(); })
      .then(function (j) {
        setDrafts(j.drafts.length);
        $('draftList').innerHTML = j.drafts.length
          ? j.drafts.map(function (d) { return '<li>' + esc(d.label) + '</li>'; }).join('')
          : '<li class="empty">없음</li>';
        $('histList').innerHTML = j.history.length
          ? j.history.map(function (h) {
              return '<li><div><b>' + esc(h.note || '게시') + '</b><small>' + esc(h.created_at) + ' · ' + esc(h.admin_name || '') + '</small></div>' +
                '<button type="button" class="pbtn pbtn--sm" data-rev="' + h.id + '">이 상태 불러오기</button></li>';
            }).join('')
          : '<li class="empty">아직 게시한 적이 없습니다</li>';
      });
  }
  $('histList').addEventListener('click', function (e) {
    var b = e.target.closest('[data-rev]'); if (!b) return;
    if (!window.confirm('이 시점의 홈페이지 상태를 임시 저장으로 불러올까요?\n지금 임시 저장된 내용은 덮어써집니다.')) return;
    EDAPI.post(S.urls.restore + '/' + b.dataset.rev, {}).then(function () {
      dirty = 0; metaDirty = false;
      var ex = ed(); if (ex) ex.reload();
      loadStatus();
      toast('불러왔습니다. 화면을 확인한 뒤 게시하세요.');
    }).catch(function (err) { toast(err.message, true); });
  });

  window.addEventListener('beforeunload', function (e) {
    if (totalDirty()) { e.preventDefault(); e.returnValue = ''; }
  });

  frame.addEventListener('load', function () {
    // 편집기가 실리지 않은 화면(로그인 만료 등)
    setTimeout(function () { if (!ed()) { $('status').textContent = '편집기를 불러오지 못했습니다 — 다시 로그인해 주세요'; $('status').className = 'sb__st is-dirty'; } }, 400);
  });

  paint();
})();
