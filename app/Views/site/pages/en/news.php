<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>News &amp; Media · K1 Co., Ltd. K1 OCEAN</title>
<meta name="description" content="K1 news and media — notice board, gallery and corporate identity (symbol mark and mascots).">
<link rel="canonical" href="https://k1tnc.co.kr/en/news.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/news.html">
<link rel="alternate" hreflang="en" href="https://k1tnc.co.kr/en/news.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/news.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="K1 Co., Ltd. · K1 OCEAN">
<meta property="og:locale" content="en_US">
<meta property="og:title" content="News &amp; Media · K1 Co., Ltd. K1 OCEAN">
<meta property="og:description" content="K1 news and media — notice board, gallery and corporate identity (symbol mark and mascots).">
<meta property="og:url" content="https://k1tnc.co.kr/en/news.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="News &amp; Media · K1 Co., Ltd. K1 OCEAN">
<meta name="twitter:description" content="K1 news and media — notice board, gallery and corporate identity (symbol mark and mascots).">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="../assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="../css/v2.css?v=20261111e">
</head>
<body class="sub">
<a class="skip" href="#main">Skip to content</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => '../news.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => 'Contact']) ?>
<?= view('site/partials/header_en') ?>

<!-- SUB HERO -->
<!--ed:en/news/subhero-->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="index.html">Home</a> <b>›</b> News & Media</div>
    <h1>News & Media</h1>
    <div class="en">News &amp; Media</div>
  </div>
</section>
<!--/ed:en/news/subhero-->

<!--ed:en/news/pagenav-->
<nav class="pagenav" aria-label="News &amp; Media sections">
  <div class="pagenav__in">
    <a href="#board" class="on">Notice Board</a>
    <a href="#gallery">Gallery</a>
    <a href="#ci">CI</a>
  </div>
</nav>
<!--/ed:en/news/pagenav-->

<main id="main">

<!-- 게시판 -->
<!--ed:en/news/board-->
<section class="sec sec--paper" id="board" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 01</b>&nbsp; Notice Board</span>
      <h2 class="d2">Notice Board</h2>
      <p class="lead">Notices and news from K1 and K1 OCEAN.</p>
    </div>
    <div class="board rv">
      <div class="board__bar">
        <span>Total <b>0</b></span>
        <span class="eyebrow">Notice Board</span>
      </div>
      <div class="board__head"><span>No.</span><span>Title</span><span>Date</span></div>

      <!-- 게시글이 등록되면 아래 형태의 행을 반복합니다:
      <a class="board__row" href="#"><span class="no">1</span>
        <span class="ti">Title<svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
        <span class="dt">2026.07.09</span></a>
      -->

      <div class="board__empty">
        <div class="empty__ic" aria-hidden="true">
          <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M12 10h18l6 6v22H12z" stroke-linejoin="round"/><path d="M30 10v6h6M17 24h14M17 30h14" stroke-linecap="round"/></svg>
        </div>
        <h3>No posts have been published yet</h3>
        <p>New notices and news will appear here.</p>
      </div>
    </div>
  </div>
</section>
<!--/ed:en/news/board-->

<!-- GALLERY -->
<!--ed:en/news/gallery-->
<section class="sec sec--paper2" id="gallery" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 02</b>&nbsp; Gallery</span>
      <h2 class="d2">Gallery</h2>
      <p class="lead">Images from our sites, equipment and project work.</p>
    </div>
    <div class="gall stg rv">
      <div class="viz"></div>
      <div class="viz"></div>
      <div class="viz"></div>
      <div class="viz"></div>
      <div class="viz"></div>
      <div class="viz"></div>
    </div>
  </div>
</section>
<!--/ed:en/news/gallery-->

<!-- CI -->
<!--ed:en/news/ci-->
<section class="sec sec--paper" id="ci" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 03</b>&nbsp; Corporate Identity</span>
      <h2 class="d2">FROM KOREA No.1<br><em>TO KOREA ONLY ONE</em></h2>
    </div>

    <!-- 케이원 마크 -->
    <div class="ci rv">
      <div class="ci__mk"><img src="../assets/ci/ci-mark-k1.png" alt="K1 symbol mark" loading="lazy"></div>
      <div class="ci__b">
        <h3>The K1 Mark</h3>
        <p class="ci__lead">Technology that began at sea — a symbol of K1 moving beyond the site toward the future.</p>
        <div class="ci__pt">
          <h4>Deepening blue</h4>
          <p>It represents the way K1's experience and expertise have accumulated, and the depth of trust built with our clients.</p>
        </div>
        <div class="ci__pt">
          <h4>The open door and rising plane</h4>
          <p>An openness toward possibility — K1's will and vision to reach a wider world through technical innovation and growth that never stops.</p>
        </div>
      </div>
    </div>

    <!-- 마스코트 · 키오 -->
    <div class="masc rv">
      <div class="masc__b">
        <span class="masc__tag">K1 Mascot</span>
        <h3>KIO <em>KIO</em></h3>
        <p class="masc__sub">KIO : K1 + ONE &amp; ON</p>
        <p>KIO stands for K1's vision of “KOREA ONLY ONE” and for the essence of commissioning — that “K1 completes the system in the ON state.” Like the orca that leads the sea with outstanding intelligence and strength, K1's mascot KIO embodies the expertise built on offshore sites, strong collaboration, dependable leadership, and the power of execution that carries a project to success.</p>
      </div>
      <div class="masc__imgs stg">
        <div class="masc__i"><img src="../assets/ci/kio-01.png" alt="K1 mascot KIO wearing a safety helmet and holding a radio" loading="lazy"></div>
        <div class="masc__i"><img src="../assets/ci/kio-02.png" alt="K1 mascot KIO holding a light bulb" loading="lazy"></div>
        <div class="masc__i"><img src="../assets/ci/kio-03.png" alt="K1 mascot KIO beside a safety sign" loading="lazy"></div>
      </div>
    </div>

    <!-- 마스코트 · 케이랑이 -->
    <div class="masc masc--rev rv">
      <div class="masc__b">
        <span class="masc__tag">K1 OCEAN Mascot</span>
        <h3>Kirangi</h3>
        <p>Kirangi is K1 OCEAN's mascot, bright and friendly in energy with a strong spirit of challenge. It stands for warm connection, an innovative vision for the future of the marine industry, and the drive to open up new seas.</p>
      </div>
      <div class="masc__imgs stg">
        <div class="masc__i"><img src="../assets/ci/kirang-01.png" alt="K1 OCEAN mascot Kirangi waving" loading="lazy"></div>
        <div class="masc__i"><img src="../assets/ci/kirang-02.png" alt="K1 OCEAN mascot Kirangi holding a checklist" loading="lazy"></div>
        <div class="masc__i"><img src="../assets/ci/kirang-03.png" alt="K1 OCEAN mascot Kirangi holding a sign" loading="lazy"></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:en/news/ci-->

</main>

<!-- FOOTER -->
<?= view('site/partials/footer_en') ?>

<script src="../js/v2.js?v=20260902"></script>
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
