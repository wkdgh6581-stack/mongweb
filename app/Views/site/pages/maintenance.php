<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>유지보수 · MongWeb</title>
<meta name="description" content="MongWeb 홈페이지 유지보수 — 수정·관리 서비스, 관리 요금, 요청 방법.">
<link rel="canonical" href="https://k1tnc.co.kr/maintenance.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/maintenance.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/maintenance.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="몽웹 MongWeb">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="유지보수 · MongWeb">
<meta property="og:description" content="MongWeb 홈페이지 유지보수 — 수정·관리 서비스, 관리 요금, 요청 방법.">
<meta property="og:url" content="https://k1tnc.co.kr/maintenance.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="유지보수 · MongWeb">
<meta name="twitter:description" content="MongWeb 홈페이지 유지보수 — 수정·관리 서비스, 관리 요금, 요청 방법.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20261110i">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/index.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => '고객문의']) ?>
<?= view('site/partials/header_ko') ?>

<!-- SUB HERO -->
<!--ed:maintenance/subhero-->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="index.html">홈</a> <b>›</b> 유지보수</div>
    <h1>유지보수</h1>
    <div class="en">Maintenance</div>
  </div>
</section>
<!--/ed:maintenance/subhero-->

<!--ed:maintenance/pagenav-->
<nav class="pagenav" aria-label="유지보수 섹션">
  <div class="pagenav__in">
    <a href="#service" class="on">유지보수 서비스</a>
    <a href="#plans">관리 요금</a>
    <a href="#request">요청 방법</a>
  </div>
</nav>
<!--/ed:maintenance/pagenav-->

<main id="main">
<!--ed:maintenance/service-->
<section class="sec sec--paper" id="service" data-nav="light">
  <div class="wrap">
    <div class="bizd rv">
      <div class="bizd__head">
        <div><div class="en">Service</div><h2>유지보수 서비스</h2></div>
        <p>오픈한 뒤에도 홈페이지가 늘 최신 상태로 안전하게 운영되도록 관리합니다.</p>
      </div>
      <div class="bizd__grid stg">
        <div class="bizd__i"><div class="n">01</div><h3>내용 수정</h3><div class="en2">Content Update</div><ul><li>글 · 사진 · 메뉴 수정</li><li>새 소식 · 공지 게시 지원</li></ul></div>
        <div class="bizd__i"><div class="n">02</div><h3>기능 추가</h3><div class="en2">Feature Update</div><ul><li>새 화면 · 게시판 추가</li><li>문의 양식 · 지도 등 기능 연결</li></ul></div>
        <div class="bizd__i"><div class="n">03</div><h3>점검 · 보안</h3><div class="en2">Check &amp; Security</div><ul><li>정기 점검과 오류 확인</li><li>백업과 보안 업데이트</li></ul></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:maintenance/service-->
<!--ed:maintenance/plans-->
<section class="sec sec--paper2" id="plans" data-nav="light">
  <div class="wrap">
    <div class="bizd rv">
      <div class="bizd__head">
        <div><div class="en">Plans</div><h2>관리 요금</h2></div>
        <p>필요한 만큼 고를 수 있습니다. 홈페이지 규모와 요청 빈도에 맞춰 상담 후 안내해 드립니다.</p>
      </div>
      <div class="bizd__grid stg">
        <div class="bizd__i"><div class="n">01</div><h3>건별 요청</h3><div class="en2">Per Request</div><p class="plan__p">상담 후 안내</p><ul><li>필요할 때마다 요청</li><li>작업 전 비용 안내</li></ul></div>
        <div class="bizd__i"><div class="n">02</div><h3>월 관리</h3><div class="en2">Monthly</div><p class="plan__p">상담 후 안내</p><ul><li>정해진 범위 안에서 수시 수정</li><li>정기 점검 포함</li></ul></div>
        <div class="bizd__i"><div class="n">03</div><h3>연 관리</h3><div class="en2">Yearly</div><p class="plan__p">상담 후 안내</p><ul><li>월 관리 내용 + 우선 처리</li><li>도메인 · 호스팅 연장 관리</li></ul></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:maintenance/plans-->
<!--ed:maintenance/request-->
<section class="sec sec--paper" id="request" data-nav="light">
  <div class="wrap">
    <div class="bizd rv">
      <div class="bizd__head">
        <div><div class="en">Request</div><h2>요청 방법</h2></div>
        <p>고객문의 화면이나 전화 · 이메일로 요청해 주세요.</p>
      </div>
      <div class="bizd__grid stg">
        <div class="bizd__i"><div class="n">01</div><h3>요청 접수</h3><div class="en2">Request</div><ul><li>고칠 화면과 내용 전달</li><li>참고 자료 첨부</li></ul></div>
        <div class="bizd__i"><div class="n">02</div><h3>확인 · 안내</h3><div class="en2">Review</div><ul><li>작업 범위와 일정 안내</li><li>필요 시 비용 안내</li></ul></div>
        <div class="bizd__i"><div class="n">03</div><h3>작업 · 완료</h3><div class="en2">Done</div><ul><li>작업 후 결과 확인 요청</li><li>수정 사항 반영</li></ul></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:maintenance/request-->
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
