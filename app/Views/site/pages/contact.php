<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>고객문의 · (주)케이원 K1 OCEAN</title>
<meta name="description" content="(주)케이원 고객문의 — 프로젝트 문의, 연락처, 본사·지사 오시는 길.">
<link rel="canonical" href="https://k1tnc.co.kr/contact.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/contact.html">
<link rel="alternate" hreflang="en" href="https://k1tnc.co.kr/en/contact.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/contact.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="(주)케이원 · K1 OCEAN">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="고객문의 · (주)케이원 K1 OCEAN">
<meta property="og:description" content="(주)케이원 고객문의 — 프로젝트 문의, 연락처, 본사·지사 오시는 길.">
<meta property="og:url" content="https://k1tnc.co.kr/contact.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="고객문의 · (주)케이원 K1 OCEAN">
<meta name="twitter:description" content="(주)케이원 고객문의 — 프로젝트 문의, 연락처, 본사·지사 오시는 길.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20260902">
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

<!--ed:contact/pagenav-->
<nav class="pagenav" aria-label="고객문의 섹션">
  <div class="pagenav__in">
    <a href="#inquiry" class="on">문의하기</a>
    <a href="#map">오시는 길</a>
  </div>
</nav>
<!--/ed:contact/pagenav-->

<main id="main">

<!-- INQUIRY -->
<!--ed:contact/inquiry-->
<section class="sec sec--paper" id="inquiry" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 01</b>&nbsp; Inquiry</span>
      <h2 class="d2">문의하기</h2>
      <p class="lead">프로젝트 문의, 협업 제안, 견적 요청 등 무엇이든 아래 채널로 연락 주시면 담당자가 신속히 답변드리겠습니다.</p>
    </div>

    <div class="cwrap rv">
      <div class="cinfo">
        <div class="cinfo__i"><i class="ic i-phone" aria-hidden="true"></i><div class="k">대표 전화</div><a class="v" href="tel:<?= esc($site['tel']) ?>"><?= esc($site['tel']) ?></a></div>
        <div class="cinfo__i"><i class="ic i-fax" aria-hidden="true"></i><div class="k">팩스</div><div class="v"><?= esc($site['fax']) ?></div></div>
        <div class="cinfo__i"><i class="ic i-mail" aria-hidden="true"></i><div class="k">이메일</div><a class="v" href="mailto:<?= esc($site['email']) ?>"><?= esc($site['email']) ?></a></div>
        <div class="cinfo__i"><i class="ic i-location" aria-hidden="true"></i><div class="k">본사</div><div class="v"><?= esc($site['hq_addr']) ?></div></div>
        <div class="cinfo__note">업무 시간 · 평일 09:00 – 18:00 (주말 · 공휴일 휴무)</div>
      </div>

      <form class="cform" id="contactForm" action="<?= base_url('api/contact') ?>" method="post" aria-label="문의 양식" novalidate>
        <?= csrf_field() ?>
        <div class="cform__row">
          <label class="cf">문의 목적 <span>*</span>
            <select name="purpose" required>
              <option value="" selected disabled>선택해 주세요</option>
              <option>Turnkey</option>
              <option>Technical Service</option>
              <option>Project Manpower</option>
              <option>Partnership</option>
              <option>Recruitment</option>
              <option>etc</option>
            </select></label>
          <label class="cf">회사 / 기관
            <select name="company">
              <option value="" selected disabled>선택해 주세요</option>
              <option>케이원</option>
              <option>케이원오션</option>
            </select></label>
        </div>
        <div class="cform__row">
          <label class="cf">이름 <span>*</span><input type="text" name="name" required></label>
          <label class="cf">연락처<input type="tel" name="phone"></label>
        </div>
        <label class="cf">이메일 <span>*</span><input type="email" name="email" required></label>
        <label class="cf">문의 내용 <span>*</span><textarea name="message" rows="6" required placeholder="문의하실 내용을 입력해 주세요."></textarea></label>
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

<!-- MAP / LOCATIONS -->
<!--ed:contact/map-->
<section class="sec sec--paper2" id="map" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 02</b>&nbsp; Location</span>
      <h2 class="d2">오시는 길</h2>
      <p class="lead">거제 본사와 영암 · 울산 지사에서 현장 가까이 서비스를 제공합니다.</p>
    </div>
    <div class="loc rv">
      <div class="loc__i">
        <div class="loc__map">
          <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=128.6900418%2C34.8918086%2C128.6980418%2C34.8968086&layer=mapnik&marker=34.8943086%2C128.6940418"
            title="거제 본사 위치 지도 — 경남 거제시 옥포대첩로 59" loading="lazy"></iframe>
        </div>
        <div class="loc__b"><div class="tag">K1 · HQ</div><h3>거제 본사</h3><p><?= esc($site['hq_addr']) ?></p><div class="loc__c"><span>TEL <?= esc($site['tel']) ?></span><span>FAX <?= esc($site['fax']) ?></span></div></div>
      </div>
      <div class="loc__i">
        <div class="loc__map">
          <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=126.3805798%2C34.7506621%2C126.4005798%2C34.7631621&layer=mapnik&marker=34.7569121%2C126.3905798"
            title="영암 지사 위치 지도 — <?= esc($site['yeongam_addr']) ?>" loading="lazy"></iframe>
        </div>
        <div class="loc__b"><div class="tag">K1 OCEAN · Branch</div><h3>영암 지사</h3><p><?= esc($site['yeongam_addr']) ?></p><div class="loc__c"><span>TEL <?= esc($site['yeongam_tel']) ?></span><span>FAX <?= esc($site['yeongam_fax']) ?></span></div></div>
      </div>
      <div class="loc__i">
        <div class="loc__map">
          <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=129.4031875%2C35.4767992%2C129.4111875%2C35.4817992&layer=mapnik&marker=35.4792992%2C129.4071875"
            title="울산 지사 위치 지도 — <?= esc($site['ulsan_addr']) ?>" loading="lazy"></iframe>
        </div>
        <div class="loc__b"><div class="tag">K1 · Branch</div><h3>울산 지사</h3><p><?= esc($site['ulsan_addr']) ?></p><?php if ($site['ulsan_tel'] || $site['ulsan_fax']): ?><div class="loc__c"><?php if ($site['ulsan_tel']): ?><span>TEL <?= esc($site['ulsan_tel']) ?></span><?php endif ?><?php if ($site['ulsan_fax']): ?><span>FAX <?= esc($site['ulsan_fax']) ?></span><?php endif ?></div><?php endif ?></div>
      </div>
    </div>
    <p class="loc__attr">지도 데이터 © <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a> 기여자</p>
  </div>
</section>
<!--/ed:contact/map-->

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
