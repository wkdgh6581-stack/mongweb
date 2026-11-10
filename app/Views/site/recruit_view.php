<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= esc($recruit['title']) ?> · (주)케이원 인재채용</title>
<meta name="description" content="<?= esc(mb_substr(strip_tags($recruit['content']), 0, 120), 'attr') ?>\">
<link rel="canonical" href="https://k1tnc.co.kr/recruit.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/recruit.html">
<link rel="alternate" hreflang="en" href="https://k1tnc.co.kr/en/recruit.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/recruit.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="몽웹 MongWeb">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="인재채용 · (주)케이원 K1 OCEAN">
<meta property="og:description" content="(주)케이원 인재채용 — 채용안내, 채용공고. 통합 시운전 전문 기업과 함께 성장할 인재를 기다립니다.">
<meta property="og:url" content="https://k1tnc.co.kr/recruit.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="인재채용 · (주)케이원 K1 OCEAN">
<meta name="twitter:description" content="(주)케이원 인재채용 — 채용안내, 채용공고. 통합 시운전 전문 기업과 함께 성장할 인재를 기다립니다.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="<?= base_url('assets/favicon.png') ?>">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="<?= base_url('css/v2.css?v=20261110k') ?>">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/recruit.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => '고객문의']) ?>
<?= view('site/partials/header_ko') ?>

<!-- SUB HERO -->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="<?= base_url() ?>">홈</a> <b>›</b> <a href="<?= base_url('recruit.html') ?>">인재채용</a> <b>›</b> 채용공고</div>
    <h1>채용공고</h1>
    <div class="en">Open Positions</div>
  </div>
</section>

<main id="main">

<section class="sec sec--paper" data-nav="light">
  <div class="wrap">
    <article class="post rv">

      <header class="post__head">
        <span class="post__badge"><?= esc($recruit['employment_type']) ?></span>
        <h2><?= esc($recruit['title']) ?></h2>
        <p class="post__meta">
          <?php if ($recruit['starts_at'] || $recruit['ends_at']): ?>
            모집 기간 <?= esc($recruit['starts_at'] ?: '') ?> ~ <?= esc($recruit['ends_at'] ?: '상시') ?>
            <?php if ($is_expired): ?><b> · 마감</b><?php endif ?>
          <?php else: ?>
            상시 모집
          <?php endif ?>
        </p>
      </header>

      <div class="post__body"><?= nl2br(esc($recruit['content'])) ?></div>

      <p class="post__back">
        <a class="btn btn--solid" href="mailto:<?= esc($site['email']) ?>?subject=[인재채용] <?= esc($recruit['title'], 'attr') ?> 지원"><span>지원하기</span>
          <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
        <a class="btn" href="<?= base_url('recruit.html') ?>" style="margin-left:10px"><span>목록으로</span></a>
      </p>

    </article>
  </div>
</section>
</main>

<!-- FOOTER -->
<?= view('site/partials/footer_ko') ?>

<script src="<?= base_url('js/v2.js?v=20260902') ?>"></script>
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
