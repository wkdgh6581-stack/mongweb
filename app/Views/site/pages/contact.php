<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>고객문의 · 몽웹 MongWeb</title>
<meta name="description" content="몽웹 고객문의 — 홈페이지 제작 · 리뉴얼 · 견적 · 유지보수 문의.">
<link rel="canonical" href="https://k1tnc.co.kr/contact.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/contact.html">
<link rel="alternate" hreflang="en" href="https://k1tnc.co.kr/en/contact.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/contact.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="몽웹 MongWeb">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="고객문의 · 몽웹 MongWeb">
<meta property="og:description" content="몽웹 고객문의 — 홈페이지 제작 · 리뉴얼 · 견적 · 유지보수 문의.">
<meta property="og:url" content="https://k1tnc.co.kr/contact.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="고객문의 · 몽웹 MongWeb">
<meta name="twitter:description" content="몽웹 고객문의 — 홈페이지 제작 · 리뉴얼 · 견적 · 유지보수 문의.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20261111h">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/contact.html', 'foot_cta_url' => 'mailto:{{site.email}}', 'foot_cta_label' => '이메일 문의']) ?>
<?= view('site/partials/header_ko') ?>

<!-- SUB HERO -->
<!--ed:contact/subhero-->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="index.html">홈</a> <b>›</b> 고객문의</div>
    <h1>고객문의</h1>
    <div class="en">Contact Us</div>
  </div>
</section>
<!--/ed:contact/subhero-->

<main id="main">

<!-- INQUIRY -->
<!--ed:contact/inquiry-->
<section class="sec sec--paper" id="inquiry" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 01</b>&nbsp; Inquiry</span>
      <h2 class="d2">문의하기</h2>
      <p class="lead">홈페이지 제작 · 리뉴얼 · 견적 · 유지보수 등 무엇이든 남겨 주세요. 자료가 없어도 괜찮습니다. 확인 후 빠르게 연락드립니다.</p>
    </div>

    <div class="cwrap rv">
      <div class="cinfo">
        <div class="cinfo__i"><i class="ic i-phone" aria-hidden="true"></i><div class="k">대표 전화</div><a class="v" href="tel:<?= esc($site['tel']) ?>"><?= esc($site['tel']) ?></a></div>
        <div class="cinfo__i"><i class="ic i-fax" aria-hidden="true"></i><div class="k">팩스</div><div class="v"><?= esc($site['fax']) ?></div></div>
        <div class="cinfo__i"><i class="ic i-mail" aria-hidden="true"></i><div class="k">이메일</div><a class="v" href="mailto:<?= esc($site['email']) ?>"><?= esc($site['email']) ?></a></div>
        <div class="cinfo__i"><i class="ic i-location" aria-hidden="true"></i><div class="k">주소</div><div class="v"><?= esc($site['hq_addr']) ?></div></div>
        <div class="cinfo__note">업무 시간 · 평일 09:00 – 18:00 (주말 · 공휴일 휴무)</div>
      </div>

      <form class="cform" id="contactForm" action="<?= base_url('api/contact') ?>" method="post" aria-label="문의 양식" novalidate>
        <?= csrf_field() ?>
        <div class="cform__row">
          <label class="cf">문의 목적 <span>*</span>
            <select name="purpose" required>
              <option value="" selected disabled>선택해 주세요</option>
              <option>신규 홈페이지 제작</option>
              <option>홈페이지 리뉴얼</option>
              <option>랜딩페이지</option>
              <option>SEO · AEO · GEO 검색 대응</option>
              <option>유지보수</option>
              <option>기타</option>
            </select></label>
          <label class="cf">회사 / 상호<input type="text" name="company" placeholder="예: 몽웹"></label>
        </div>
        <div class="cform__row">
          <label class="cf">이름 <span>*</span><input type="text" name="name" required></label>
          <label class="cf">연락처<input type="tel" name="phone"></label>
        </div>
        <label class="cf">이메일 <span>*</span><input type="email" name="email" required></label>
        <label class="cf">문의 내용 <span>*</span><textarea name="message" rows="6" required placeholder="업종, 원하시는 홈페이지 느낌, 참고 사이트, 희망 일정 등을 편하게 적어 주세요."></textarea></label>
        <label class="cf-agree">
          <input type="checkbox" name="privacy_agree" required>
          <span>개인정보 수집·이용에 동의합니다. <a href="privacy.html" target="_blank" rel="noopener">개인정보 처리방침</a> <b>*</b></span>
        </label>
        <div class="cf-trap" aria-hidden="true">
          <label>이 칸은 비워 두세요 <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
        </div>
        <p class="cform__msg" id="contactMsg" role="status" hidden></p>
        <button type="submit" class="btn btn--solid"><span>문의 보내기</span>
          <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        <p class="cform__hint">보내주신 내용은 담당자에게 바로 전달되며, 확인 후 <?= esc($site['email']) ?> 로 회신드립니다.</p>
      </form>
    </div>
  </div>
</section>
<!--/ed:contact/inquiry-->

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
