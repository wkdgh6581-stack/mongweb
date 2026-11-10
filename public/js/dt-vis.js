/*
 * 업종 상세 화면 "검색 결과에 보이기 / AI 답변에 담기기" 휴대폰 연출.
 * 템플릿의 .dt-mock 안 글자(.bar/.res, .ask/.ans)를 읽어 휴대폰 화면으로 바꾸고,
 * 화면에 보이면 검색어 입력 → 결과 등장 / 질문 → AI 답변 타이핑을 반복한다.
 * 글자는 관리자 편집기에서 .dt-mock 안 문구를 고치면 그대로 반영된다.
 */
(function () {
  var mocks = [].slice.call(document.querySelectorAll('.dt-mock'));
  if (!mocks.length) return;
  var reduce = window.matchMedia && matchMedia('(prefers-reduced-motion: reduce)').matches;

  var ICON_SEARCH = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><circle cx="10.5" cy="10.5" r="6.5"/><path d="m16 16 4.5 4.5"/></svg>';
  var ICON_SEND = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M6 11l6-6 6 6"/></svg>';
  var STATUS = '<div class="ph__st"><span>9:41</span><i class="ph__sig"><b></b><b></b><b></b><b></b></i></div>';

  function esc(s) { return String(s).replace(/[&<>"]/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;' }[c]; }); }
  function wait(ms, run) { return new Promise(function (res) { var t = setTimeout(function () { res(run.alive); }, ms); run.timers.push(t); }); }
  function typeText(el, text, speed, run) {
    el.textContent = '';
    var i = 0;
    return new Promise(function (res) {
      (function tick() {
        if (!run.alive) return res(false);
        el.textContent = text.slice(0, ++i);
        if (i >= text.length) return res(true);
        run.timers.push(setTimeout(tick, speed + Math.random() * speed * .6));
      })();
    });
  }
  // <b> 가 섞인 답변을 글자 단위로 타이핑
  function typeRich(el, segs, speed, run) {
    el.innerHTML = '';
    var si = 0, ci = 0, node = null;
    return new Promise(function (res) {
      (function tick() {
        if (!run.alive) return res(false);
        if (si >= segs.length) return res(true);
        var sg = segs[si];
        if (!node) { node = sg.b ? document.createElement('b') : document.createTextNode(''); el.appendChild(node); }
        ci += 2; // 두 글자씩: 한국어 답변이 너무 느리지 않게
        node.textContent = sg.t.slice(0, ci);
        if (ci >= sg.t.length) { si++; ci = 0; node = null; }
        run.timers.push(setTimeout(tick, speed));
      })();
    });
  }
  function segsOf(el) {
    var out = [];
    [].forEach.call(el.childNodes, function (n) {
      var t = n.textContent; if (!t) return;
      out.push({ t: t, b: n.nodeType === 1 && /^(B|STRONG|EM)$/.test(n.tagName) });
    });
    return out;
  }

  function buildSeo(m) {
    var q = (m.querySelector('.bar') || {}).textContent || '';
    var res = m.querySelector('.res') || m;
    var title = (res.querySelector('b') || {}).textContent || q;
    var desc = (res.querySelector('span') || {}).textContent || '';
    var brand = (title.split('|')[1] || '우리 회사').trim();
    var url = res.getAttribute('data-url') || 'www.example.co.kr';
    var rel = (m.querySelector('.bar').getAttribute('data-rel') || '').split(',').filter(Boolean);
    var fav = (brand.replace(/[○△□\s]/g, '').charAt(0)) || 'M';
    m.innerHTML =
      '<div class="ph ph--seo"><div class="ph__scr">' + STATUS +
      '<div class="ph__q">' + ICON_SEARCH + '<span class="ph__qt"></span><i class="ph__caret"></i></div>' +
      '<div class="ph__tabs"><b>통합</b><span>이미지</span><span>지도</span><span>뉴스</span><span>쇼핑</span></div>' +
      '<p class="ph__meta ph-s">검색결과 약 1,240개 <span>(0.38초)</span></p>' +
      '<div class="ph__hit ph__hit--top ph-s"><div class="ph__site"><i class="ph__fav">' + esc(fav) + '</i><span><b>' + esc(brand) + '</b><small>' + esc(url) + '</small></span></div>' +
      '<p class="ph__t">' + esc(title) + '</p><p class="ph__d">' + esc(desc) + '</p>' +
      '<p class="ph__links"><span>회사소개</span><span>제품 · 서비스</span><span>문의하기</span></p></div>' +
      '<div class="ph__hit ph__ghost ph-s"><i></i><i></i><i></i></div>' +
      (rel.length ? '<div class="ph__rel ph-s"><p>관련 검색</p><div>' + rel.map(function (r) { return '<span>' + ICON_SEARCH + esc(r.trim()) + '</span>'; }).join('') + '</div></div>' : '') +
      '</div></div>';
    var ph = m.firstChild, qt = ph.querySelector('.ph__qt'), steps = [].slice.call(ph.querySelectorAll('.ph-s'));
    return {
      el: ph,
      final: function () { qt.textContent = q; steps.forEach(function (s) { s.classList.add('on'); }); ph.classList.add('done'); },
      reset: function () { qt.textContent = ''; steps.forEach(function (s) { s.classList.remove('on'); }); ph.classList.remove('done', 'typing', 'loading'); },
      play: function (run) {
        var self = this; self.reset();
        return wait(500, run)
          .then(function (ok) { if (!ok) return false; ph.classList.add('typing'); return typeText(qt, q, 90, run); })
          .then(function (ok) { if (!ok) return false; ph.classList.remove('typing'); ph.classList.add('loading'); return wait(700, run); })
          .then(function (ok) {
            if (!ok) return false; ph.classList.remove('loading');
            var p = Promise.resolve(true);
            steps.forEach(function (s, i) { p = p.then(function (ok2) { if (!ok2) return false; s.classList.add('on'); return wait(i === 1 ? 650 : 380, run); }); });
            return p;
          })
          .then(function (ok) { if (!ok) return false; ph.classList.add('done'); return wait(4200, run); });
      }
    };
  }

  function buildAeo(m) {
    var askEl = m.querySelector('.ask'), ansEl = m.querySelector('.ans');
    var ask = askEl ? askEl.textContent : '';
    var segs = ansEl ? segsOf(ansEl) : [];
    var src = (ansEl && ansEl.getAttribute('data-src') || '회사 홈페이지,자주 묻는 질문').split(',').filter(Boolean);
    m.innerHTML =
      '<div class="ph ph--aeo"><div class="ph__scr">' + STATUS +
      '<p class="ph__head"><i>✦</i>AI 답변</p>' +
      '<div class="ph__chat"><p class="ph__me"></p>' +
      '<div class="ph__ai"><i class="ph__ava">✦</i><div class="ph__aib"><p class="ph__dots"><i></i><i></i><i></i></p><p class="ph__ans"></p>' +
      '<p class="ph__src">' + src.map(function (s) { return '<span>' + esc(s.trim()) + '</span>'; }).join('') + '</p></div></div></div>' +
      '<div class="ph__in"><span class="ph__it"></span><i class="ph__caret"></i><b class="ph__send">' + ICON_SEND + '</b></div>' +
      '</div></div>';
    var ph = m.firstChild, me = ph.querySelector('.ph__me'), it = ph.querySelector('.ph__it'),
        ai = ph.querySelector('.ph__ai'), ans = ph.querySelector('.ph__ans'), srcEl = ph.querySelector('.ph__src');
    return {
      el: ph,
      final: function () { me.textContent = ask; me.classList.add('on'); ai.classList.add('on', 'ready'); ans.innerHTML = segs.map(function (s) { return s.b ? '<b>' + esc(s.t) + '</b>' : esc(s.t); }).join(''); srcEl.classList.add('on'); ph.classList.add('done'); },
      reset: function () { me.textContent = ''; me.classList.remove('on'); it.textContent = ''; ai.classList.remove('on', 'ready'); ans.innerHTML = ''; srcEl.classList.remove('on'); ph.classList.remove('done', 'typing', 'sent'); },
      play: function (run) {
        var self = this; self.reset();
        return wait(500, run)
          .then(function (ok) { if (!ok) return false; ph.classList.add('typing'); return typeText(it, ask, 75, run); })
          .then(function (ok) { if (!ok) return false; ph.classList.add('sent'); return wait(260, run); })
          .then(function (ok) { if (!ok) return false; ph.classList.remove('typing', 'sent'); it.textContent = ''; me.textContent = ask; me.classList.add('on'); return wait(500, run); })
          .then(function (ok) { if (!ok) return false; ai.classList.add('on'); return wait(1100, run); })
          .then(function (ok) { if (!ok) return false; ai.classList.add('ready'); return typeRich(ans, segs, 34, run); })
          .then(function (ok) { if (!ok) return false; srcEl.classList.add('on'); ph.classList.add('done'); return wait(4200, run); });
      }
    };
  }

  mocks.forEach(function (m) {
    var isSeo = !!m.querySelector('.bar');
    var vis = isSeo ? buildSeo(m) : buildAeo(m);
    m.classList.add('dt-mock--ph');
    if (reduce || !('IntersectionObserver' in window)) { vis.final(); return; }
    vis.final(); // 처음엔 완성된 화면을 보여 두고, 보이기 시작하면 연출
    var run = null;
    function start() {
      if (run) return;
      run = { alive: true, timers: [] };
      var r = run;
      (function loop() { vis.play(r).then(function (ok) { if (ok && r.alive) loop(); }); })();
    }
    function stop() {
      if (!run) return;
      run.alive = false; run.timers.forEach(clearTimeout); run = null; vis.final();
    }
    new IntersectionObserver(function (es) {
      es.forEach(function (e) { if (e.isIntersecting) start(); else stop(); });
    }, { threshold: .35 }).observe(m);
  });
})();
