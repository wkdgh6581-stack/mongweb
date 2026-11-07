<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>비용안내 · MongWeb</title>
<meta name="description" content="MongWeb 홈페이지 제작 비용 안내 — 요금, 제작 절차, 자주 묻는 질문.">
<link rel="canonical" href="https://k1tnc.co.kr/price.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/price.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/price.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="몽웹 MongWeb">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="비용안내 · MongWeb">
<meta property="og:description" content="MongWeb 홈페이지 제작 비용 안내 — 요금, 제작 절차, 자주 묻는 질문.">
<meta property="og:url" content="https://k1tnc.co.kr/price.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="비용안내 · MongWeb">
<meta name="twitter:description" content="MongWeb 홈페이지 제작 비용 안내 — 요금, 제작 절차, 자주 묻는 질문.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20261107f">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/index.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => '고객문의']) ?>
<?= view('site/partials/header_ko') ?>

<!-- SUB HERO -->
<!--ed:price/subhero-->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="index.html">홈</a> <b>›</b> 비용안내</div>
    <h1>비용안내</h1>
    <div class="en">Pricing</div>
  </div>
</section>
<!--/ed:price/subhero-->

<!--ed:price/pagenav-->
<nav class="pagenav" aria-label="비용안내 섹션">
  <div class="pagenav__in">
    <a href="#plans" class="on">요금 안내</a>
    <a href="#process">제작 절차</a>
    <a href="#faq">자주 묻는 질문</a>
  </div>
</nav>
<!--/ed:price/pagenav-->

<main id="main">
<!-- 요금 안내 -->
<!--ed:price/plans-->
<section class="sec sec--paper" id="plans" data-nav="light">
  <div class="wrap">
    <div class="bizd rv">
      <div class="bizd__head">
        <div><div class="en">Plans</div><h2>요금 안내</h2></div>
        <p>필요한 화면 수와 기능에 따라 금액이 달라집니다. 원하시는 방향을 알려 주시면 상담 후 정확한 견적을 안내해 드립니다.</p>
      </div>
      <div class="bizd__grid stg">
        <div class="bizd__i"><div class="n">01</div><h3>원페이지</h3><div class="en2">One Page</div><p class="plan__p">상담 후 안내</p><ul><li>한 화면으로 구성된 소개 페이지</li><li>반응형(PC · 태블릿 · 휴대폰)</li><li>문의 양식 연결</li></ul></div>
        <div class="bizd__i"><div class="n">02</div><h3>기업형 홈페이지</h3><div class="en2">Corporate</div><p class="plan__p">상담 후 안내</p><ul><li>회사소개 · 사업안내 등 여러 화면</li><li>관리자에서 직접 글 · 사진 수정</li><li>게시판 · 갤러리 · 문의 관리</li></ul></div>
        <div class="bizd__i"><div class="n">03</div><h3>맞춤 제작</h3><div class="en2">Custom</div><p class="plan__p">상담 후 안내</p><ul><li>예약 · 회원 · 결제 등 필요한 기능</li><li>기존 사이트 개편</li><li>기획부터 함께 설계</li></ul></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:price/plans-->

<!-- 제작 절차 -->
<!--ed:price/process-->
<section class="sec sec--paper2" id="process" data-nav="light">
  <div class="wrap">
    <div class="bizd rv">
      <div class="bizd__head">
        <div><div class="en">Process</div><h2>제작 절차</h2></div>
        <p>상담부터 오픈 후 관리까지, 단계마다 확인을 받으며 진행합니다.</p>
      </div>
      <div class="bizd__grid stg">
        <div class="bizd__i"><div class="n">01</div><h3>상담</h3><div class="en2">Consulting</div><ul><li>목적 · 참고 사이트 · 예산 확인</li><li>견적 안내</li></ul></div>
        <div class="bizd__i"><div class="n">02</div><h3>기획</h3><div class="en2">Planning</div><ul><li>메뉴 구성과 화면 설계</li><li>필요한 기능 정리</li></ul></div>
        <div class="bizd__i"><div class="n">03</div><h3>디자인</h3><div class="en2">Design</div><ul><li>메인 · 하위 화면 시안</li><li>수정 요청 반영</li></ul></div>
        <div class="bizd__i"><div class="n">04</div><h3>개발</h3><div class="en2">Development</div><ul><li>화면 제작과 관리자 연결</li><li>PC · 휴대폰 화면 점검</li></ul></div>
        <div class="bizd__i"><div class="n">05</div><h3>오픈</h3><div class="en2">Launch</div><ul><li>도메인 · 호스팅 연결</li><li>최종 확인 후 공개</li></ul></div>
        <div class="bizd__i"><div class="n">06</div><h3>유지보수</h3><div class="en2">Maintenance</div><ul><li>오픈 후 수정 · 관리 지원</li><li>관리자 사용법 안내</li></ul></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:price/process-->

<!-- 자주 묻는 질문 -->
<!--ed:price/faq-->
<section class="sec sec--paper" id="faq" data-nav="light">
  <div class="wrap">
    <div class="bizd rv">
      <div class="bizd__head">
        <div><div class="en">FAQ</div><h2>자주 묻는 질문</h2></div>
        <p>더 궁금하신 점은 고객문의로 남겨 주세요.</p>
      </div>
      <div class="bizd__grid stg">
        <div class="bizd__i"><div class="n">Q</div><h3>제작 기간은 얼마나 걸리나요?</h3><p class="faq__a">화면 수와 기능에 따라 달라집니다. 상담 때 일정을 함께 정해 드립니다.</p></div>
        <div class="bizd__i"><div class="n">Q</div><h3>완성 후 내용을 직접 바꿀 수 있나요?</h3><p class="faq__a">네. 관리자 화면에서 홈페이지를 보면서 글자 · 사진 · 메뉴를 직접 고칠 수 있습니다.</p></div>
        <div class="bizd__i"><div class="n">Q</div><h3>도메인과 호스팅도 도와주시나요?</h3><p class="faq__a">신청부터 연결까지 안내해 드립니다.</p></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:price/faq-->
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
