<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>페이지를 찾을 수 없습니다 · (주)케이원 K1 OCEAN</title>
<meta name="description" content="요청하신 페이지를 찾을 수 없습니다.">
<meta name="robots" content="noindex">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20261110c">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/index.html', 'foot_cta_url' => 'mailto:{{site.email}}', 'foot_cta_label' => '이메일 문의']) ?>
<?= view('site/partials/header_ko') ?>

<main id="main">

<section class="sec e404" data-nav="dark">
  <div class="wrap">
    <span class="eyebrow">Error 404</span>
    <h1 class="e404__t">페이지를 찾을 수 없습니다</h1>
    <p class="e404__d">주소가 바뀌었거나 삭제된 페이지입니다.<br>아래 버튼으로 홈으로 이동해 주세요.</p>
    <div class="e404__act">
      <a class="btn btn--solid" href="index.html"><span>홈으로</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </div>
    <nav class="e404__nav" aria-label="주요 페이지">
      <a href="about.html">회사소개</a><a href="business.html">사업분야</a><a href="projects.html">프로젝트 실적</a><a href="recruit.html">인재채용</a><a href="news.html">홍보센터</a><a href="contact.html">고객문의</a>
    </nav>
  </div>
</section>

</main>

<!-- FOOTER -->
<?= view('site/partials/footer_ko') ?>

<script src="js/v2.js?v=20260902"></script>
<script>
(function(){
  var links=[].slice.call(document.querySelectorAll('.pagenav a'));
  var secs=links.map(function(a){return document.querySelector(a.getAttribute('href'));});
  var onScroll=function(){var y=window.scrollY+170;var idx=0;secs.forEach(function(s,i){if(s&&s.offsetTop<=y)idx=i;});links.forEach(function(a,i){a.classList.toggle('on',i===idx);});};
  window.addEventListener('scroll',onScroll,{passive:true});onScroll();
})();
</script>
</body>
</html>
