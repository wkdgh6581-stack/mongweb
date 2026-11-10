/* 업종 상세 "이런 곳에 필요합니다" — 목록에 마우스를 올리면 오른쪽 사진·문구가 바뀐다 */
(function () {
  [].forEach.call(document.querySelectorAll('.dt-fit'), function (box) {
    var items = [].slice.call(box.querySelectorAll('.dt-fit__i'));
    var view = box.querySelector('.dt-fit__view'), img = view.querySelector('.dt-fit__img'), cap = view.querySelector('.dt-fit__cap');
    var no = cap.querySelector('.no'), t = cap.querySelector('b'), d = cap.querySelector('p');
    // 미리 불러 두기
    items.forEach(function (li) { var im = new Image(); im.src = li.getAttribute('data-img'); });
    var cur = 0, timer;
    function show(i) {
      if (i === cur) return; cur = i;
      var li = items[i];
      items.forEach(function (x, k) { x.classList.toggle('on', k === i); });
      view.classList.add('swap');
      clearTimeout(timer);
      timer = setTimeout(function () {
        img.src = li.getAttribute('data-img');
        no.textContent = li.querySelector('.no').textContent;
        t.textContent = li.querySelector(':scope > div > b').textContent;
        d.textContent = li.querySelector(':scope > div > span').textContent;
        view.classList.remove('swap');
      }, 220);
    }
    items.forEach(function (li, i) {
      li.addEventListener('mouseenter', function () { show(i); });
      li.addEventListener('focus', function () { show(i); });
      li.addEventListener('click', function () { show(i); });
    });
  });
})();
/* 업종 상세 "검색에서 문의까지" — 단계에 마우스를 올리면 그 단계 화면이 빛나고 진행선이 따라간다 */
(function () {
  [].forEach.call(document.querySelectorAll('.dt-jr'), function (sec) {
    var steps = [].slice.call(sec.querySelectorAll('.dt-step'));
    var hls = [].slice.call(sec.querySelectorAll('.dt-jr__art .hl'));
    var bar = sec.querySelector('.dt-steps__bar b');
    var cur = 0, hover = false, auto;
    function show(i) {
      cur = i;
      steps.forEach(function (s, k) { s.classList.toggle('on', k === i); s.classList.toggle('done', k < i); });
      hls.forEach(function (h, k) { h.classList.toggle('on', k === i); });
      [].forEach.call(sec.querySelectorAll('.dt-jr2__s'), function (f, k) { f.classList.toggle('on', k === i); });
      sec.classList.add('lit');
      if (bar && steps[i]) {
        var dot = steps[i].querySelector('i'), wrap = bar.parentNode;
        var x = dot.getBoundingClientRect().left + dot.offsetWidth / 2 - wrap.getBoundingClientRect().left;
        bar.style.width = Math.max(0, x) + 'px';
      }
    }
    steps.forEach(function (s, i) {
      s.addEventListener('mouseenter', function () { hover = true; show(i); });
      s.addEventListener('focus', function () { show(i); });
      s.addEventListener('click', function () { show(i); });
      s.addEventListener('mouseleave', function () { hover = false; });
    });
    // 보고 있을 때 천천히 자동으로 한 단계씩
    function tick() { if (!hover) show((cur + 1) % steps.length); }
    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function (es) {
        es.forEach(function (e) {
          clearInterval(auto);
          if (e.isIntersecting) { show(cur); auto = setInterval(tick, sec.classList.contains('dt-jr2') ? 4200 : 2600); }
        });
      }, { threshold: .3 }).observe(sec);
    }
    window.addEventListener('resize', function () { show(cur); });
    show(0);
  });
})();
