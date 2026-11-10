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
