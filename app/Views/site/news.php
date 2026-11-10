<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>홍보센터 · (주)케이원 K1 OCEAN</title>
<meta name="description" content="(주)케이원 홍보센터 — 게시판, 갤러리, CI(심볼 마크·마스코트).">
<link rel="canonical" href="https://k1tnc.co.kr/news.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/news.html">
<link rel="alternate" hreflang="en" href="https://k1tnc.co.kr/en/news.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/news.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="몽웹 MongWeb">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="홍보센터 · (주)케이원 K1 OCEAN">
<meta property="og:description" content="(주)케이원 홍보센터 — 게시판, 갤러리, CI(심볼 마크·마스코트).">
<meta property="og:url" content="https://k1tnc.co.kr/news.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="홍보센터 · (주)케이원 K1 OCEAN">
<meta name="twitter:description" content="(주)케이원 홍보센터 — 게시판, 갤러리, CI(심볼 마크·마스코트).">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20261110u">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/news.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => '고객문의']) ?>
<?= view('site/partials/header_ko') ?>

<!-- SUB HERO -->
<!--ed:news/subhero-->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="index.html">홈</a> <b>›</b> 홍보센터</div>
    <h1>홍보센터</h1>
    <div class="en">News &amp; Media</div>
  </div>
</section>
<!--/ed:news/subhero-->

<!--ed:news/pagenav-->
<nav class="pagenav" aria-label="홍보센터 섹션">
  <div class="pagenav__in">
    <a href="#board" class="on">게시판</a>
    <a href="#gallery">갤러리</a>
    <a href="#ci">CI</a>
  </div>
</nav>
<!--/ed:news/pagenav-->

<main id="main">

<!-- 게시판 -->
<section class="sec sec--paper" id="board" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 01</b>&nbsp; Notice Board</span>
      <h2 class="d2">게시판</h2>
      <p class="lead">K1 · K1 OCEAN의 공지사항과 주요 소식을 전합니다.</p>
    </div>
    <div class="board rv">
      <div class="board__bar">
        <span>전체 <b><?= esc($article_total) ?></b>건</span>
        <span class="eyebrow">Notice Board</span>
      </div>
      <div class="board__head"><span>번호</span><span>제목</span><span>작성일</span></div>

<?php if ($article_list === []): ?>
      <div class="board__empty">
        <div class="empty__ic" aria-hidden="true">
          <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="1.4"><path d="M12 10h18l6 6v22H12z" stroke-linejoin="round"/><path d="M30 10v6h6M17 24h14M17 30h14" stroke-linecap="round"/></svg>
        </div>
        <h3>등록된 게시글이 없습니다</h3>
        <p>새로운 공지·소식이 등록되면 이곳에서 안내해 드립니다.</p>
      </div>
      <?php else: ?>
      <?php $seq = $article_total - ($current_page - 1) * $per_page; ?>
      <?php foreach ($article_list as $row): ?>
      <?php $seq--; ?>
      <?php
        $images = $row['images'] ? json_decode($row['images'], true) : [];
        $thumbnail = !empty($images) ? $images[0]['path'] : null;
      ?>
      <a class="board__row" href="<?= base_url('news/view/' . $row['id']) ?>" style="display: flex; gap: 16px; align-items: flex-start;">
        <?php if ($thumbnail): ?>
          <div style="flex: 0 0 120px; overflow: hidden; border-radius: 6px; background: #f0f0f0;">
            <img src="<?= base_url(esc($thumbnail)) ?>" alt="<?= esc($row['title']) ?>"
                 style="width: 100%; height: 120px; object-fit: cover; display: block;">
          </div>
        <?php endif ?>
        <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between; min-height: 120px;">
          <span class="no" style="margin-bottom: 8px;"><?= $row['is_notice'] ? '공지' : esc($seq + 1) ?></span>
          <span class="ti" style="flex: 1; display: flex; align-items: center;"><?= esc($row['title']) ?><svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true" style="margin-left: 8px;"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
          <span class="dt"><?= esc(date('Y.m.d', strtotime($row['created_at']))) ?></span>
        </div>
      </a>
      <?php endforeach ?>
      <?php endif ?>
      <?php if ($pager->getPageCount() > 1): ?>
      <nav class="board__pager" aria-label="페이지 이동"><?= $pager->links('default', 'site_pager') ?></nav>
      <?php endif ?>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section class="sec sec--paper2" id="gallery" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 02</b>&nbsp; Gallery</span>
      <h2 class="d2">갤러리</h2>
      <p class="lead">현장·설비·프로젝트 수행 이미지를 소개합니다.</p>
    </div>
    <div class="gall stg rv">
      <?php if ($gallery_list === []): ?>
        <?php for ($i = 0; $i < 6; $i++): ?>
        <div class="viz"></div>
        <?php endfor ?>
      <?php else: ?>
        <?php foreach ($gallery_list as $photo): ?>
        <a class="viz" href="<?= base_url($photo['image_path']) ?>" target="_blank" rel="noopener"
           aria-label="<?= esc($photo['title']) ?> — 원본 크기로 보기">
          <img src="<?= base_url($photo['thumb_path'] ?: $photo['image_path']) ?>"
               alt="<?= esc($photo['title']) ?>" loading="lazy">
        </a>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </div>
</section>

<!-- CI -->
<!--ed:news/ci-->
<section class="sec sec--paper" id="ci" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 03</b>&nbsp; Corporate Identity</span>
      <h2 class="d2">FROM KOREA No.1<br><em>TO KOREA ONLY ONE</em></h2>
    </div>

    <!-- 케이원 마크 -->
    <div class="ci rv">
      <div class="ci__mk"><img src="assets/ci/ci-mark-k1.png" alt="케이원 K1 심볼 마크" loading="lazy"></div>
      <div class="ci__b">
        <h3>케이원 마크</h3>
        <p class="ci__lead">바다에서 시작된 기술, 현장을 넘어 미래로 향하는 K1의 상징.</p>
        <div class="ci__pt">
          <h4>깊어지는 푸른색</h4>
          <p>K1의 경험과 기술이 축적된 과정을 나타내며, 고객과 쌓아온 신뢰의 깊이를 표현합니다.</p>
        </div>
        <div class="ci__pt">
          <h4>열린 문과 상승면</h4>
          <p>가능성을 향한 개방성으로, 기술혁신과 멈추지 않는 성장을 통해 더 넓은 세계로 나아가는 K1의 의지와 비전을 의미합니다.</p>
        </div>
      </div>
    </div>

    <!-- 마스코트 · 키오 -->
    <div class="masc rv">
      <div class="masc__b">
        <span class="masc__tag">케이원 마스코트</span>
        <h3>키오 <em>KIO</em></h3>
        <p class="masc__sub">KIO : K1 + ONE &amp; ON</p>
        <p>KIO는 K1의 비전인 “KOREA ONLY ONE”과 “K1이 시스템을 ON 상태로 완성한다”는 Commissioning의 핵심 역할을 상징합니다. 탁월한 지능과 강인함으로 바다를 이끄는 범고래처럼, K1의 마스코트 키오(K1O)는 해양 현장에서 축적한 전문성과 강한 협업 능력, 신뢰할 수 있는 리더십, 그리고 프로젝트를 성공으로 이끄는 강력한 수행 역량을 상징합니다.</p>
      </div>
      <div class="masc__imgs stg">
        <div class="masc__i"><img src="assets/ci/kio-01.png" alt="케이원 마스코트 키오 — 안전모와 무전기를 든 모습" loading="lazy"></div>
        <div class="masc__i"><img src="assets/ci/kio-02.png" alt="케이원 마스코트 키오 — 전구를 들고 있는 모습" loading="lazy"></div>
        <div class="masc__i"><img src="assets/ci/kio-03.png" alt="케이원 마스코트 키오 — 안전 표지판과 함께 있는 모습" loading="lazy"></div>
      </div>
    </div>

    <!-- 마스코트 · 케이랑이 -->
    <div class="masc masc--rev rv">
      <div class="masc__b">
        <span class="masc__tag">케이원오션 마스코트</span>
        <h3>케이랑이</h3>
        <p>밝고 친근한 에너지와 강인한 도전정신을 지닌 케이원오션의 마스코트, ‘케이랑이’입니다. 따뜻한 유대감, 미래 해양산업을 향한 혁신적인 비전, 그리고 새로운 바다를 활기차게 개척해 나가는 진취적인 역량을 상징합니다.</p>
      </div>
      <div class="masc__imgs stg">
        <div class="masc__i"><img src="assets/ci/kirang-01.png" alt="케이원오션 마스코트 케이랑이 — 손을 흔드는 모습" loading="lazy"></div>
        <div class="masc__i"><img src="assets/ci/kirang-02.png" alt="케이원오션 마스코트 케이랑이 — 체크리스트를 든 모습" loading="lazy"></div>
        <div class="masc__i"><img src="assets/ci/kirang-03.png" alt="케이원오션 마스코트 케이랑이 — 안내판을 든 모습" loading="lazy"></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:news/ci-->

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
