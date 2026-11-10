<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= esc($article['title']) ?> · (주)케이원</title>
<meta name="description" content="<?= esc(mb_substr(strip_tags($article['content']), 0, 120), 'attr') ?>\">
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
<link rel="icon" type="image/png" href="<?= base_url('assets/favicon.png') ?>">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="<?= base_url('css/v2.css?v=20261110z') ?>">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/news.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => '고객문의']) ?>
<?= view('site/partials/header_ko') ?>

<!-- SUB HERO -->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="<?= base_url() ?>">홈</a> <b>›</b> <a href="<?= base_url('news.html') ?>">홍보센터</a> <b>›</b> 게시판</div>
    <h1>게시판</h1>
    <div class="en">Notice Board</div>
  </div>
</section>

<main id="main">

<section class="sec sec--paper" data-nav="light">
  <div class="wrap">
    <article class="post rv">

      <header class="post__head">
        <?php if ($article['is_notice']): ?>
          <span class="post__badge">공지</span>
        <?php endif ?>
        <h2><?= esc($article['title']) ?></h2>
        <p class="post__meta">
          <time datetime="<?= esc(date('Y-m-d', strtotime($article['created_at'])), 'attr') ?>">
            <?= esc(date('Y. m. d.', strtotime($article['created_at']))) ?>
          </time>
        </p>
      </header>

      <div class="post__body" style="word-break: break-word;"><?= $article['content'] ?></div>

      <?php
        $attachments = $article['attachments'] ? json_decode($article['attachments'], true) : [];
        if (! empty($attachments)):
      ?>
        <div class="post__attachments" style="margin-top: 32px; padding-top: 24px; border-top: 1px solid #eee;">
          <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 12px;">📎 첨부파일</h3>
          <ul style="list-style: none; padding: 0;">
            <?php foreach ($attachments as $att): ?>
              <li style="margin-bottom: 8px;">
                <a href="<?= base_url(esc($att['path'])) ?>" download style="color: #0066cc; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                  📄 <?= esc($att['name']) ?>
                  <span style="color: #999; font-size: 12px;">(<?= number_format($att['size'] / 1024, 1) ?> KB)</span>
                </a>
              </li>
            <?php endforeach ?>
          </ul>
        </div>
      <?php endif ?>

      <nav class="post__nav" aria-label="다른 글">
        <?php if ($prev !== null): ?>
          <a class="post__link" href="<?= base_url('news/view/' . $prev['id']) ?>">
            <span>이전 글</span>
            <b><?= esc($prev['title']) ?></b>
          </a>
        <?php endif ?>
        <?php if ($next !== null): ?>
          <a class="post__link post__link--next" href="<?= base_url('news/view/' . $next['id']) ?>">
            <span>다음 글</span>
            <b><?= esc($next['title']) ?></b>
          </a>
        <?php endif ?>
      </nav>

      <p class="post__back">
        <a class="btn btn--solid" href="<?= base_url('news.html') ?>"><span>목록으로</span>
          <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
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
