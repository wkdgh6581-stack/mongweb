<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>쇼핑몰 홈페이지 제작 · 몽웹 MongWeb</title>
<meta name="description" content="몽웹 쇼핑몰 홈페이지 제작 — 쇼핑몰은 상품을 보고, 믿고, 사는 과정이 막힘없이 이어져야 합니다. 브랜드 분위기를 살린 상품 화면과 결제까지 이어지는 쇼핑몰을 만듭니다.">
<link rel="canonical" href="https://k1tnc.co.kr/shop.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/shop.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/shop.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="몽웹 MongWeb">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="쇼핑몰 홈페이지 제작 · 몽웹 MongWeb">
<meta property="og:description" content="몽웹 쇼핑몰 홈페이지 제작 — 쇼핑몰은 상품을 보고, 믿고, 사는 과정이 막힘없이 이어져야 합니다. 브랜드 분위기를 살린 상품 화면과 결제까지 이어지는 쇼핑몰을 만듭니다.">
<meta property="og:url" content="https://k1tnc.co.kr/shop.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="쇼핑몰 홈페이지 제작 · 몽웹 MongWeb">
<meta name="twitter:description" content="몽웹 쇼핑몰 홈페이지 제작 — 쇼핑몰은 상품을 보고, 믿고, 사는 과정이 막힘없이 이어져야 합니다. 브랜드 분위기를 살린 상품 화면과 결제까지 이어지는 쇼핑몰을 만듭니다.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20261111b">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/index.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => '고객문의']) ?>
<?= view('site/partials/header_ko') ?>

<!-- SUB HERO -->
<!--ed:shop/subhero-->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="index.html">홈</a> <b>›</b> <a href="business.html">홈페이지제작</a> <b>›</b> 쇼핑몰 홈페이지</div>
    <h1>쇼핑몰 홈페이지 제작</h1>
    <div class="en">Online Store</div>
    <p class="dt-lead">쇼핑몰은 상품을 보고, 믿고, 사는 과정이 막힘없이 이어져야 합니다. 브랜드 분위기를 살린 상품 화면과 결제까지 이어지는 쇼핑몰을 만듭니다.</p>
    <div class="dt-cta">
      <a class="btn btn--solid" href="contact.html#inquiry"><span>제작 상담 신청</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
      <a class="btn btn--line" href="price.html"><span>비용 안내 보기</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </div>
  </div>
</section>
<!--/ed:shop/subhero-->

<main id="main">
<!-- 고객이 찾는 검색어 -->
<!--ed:shop/search-->
<section class="sec sec--paper dt-sec" id="search" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 01</b>&nbsp; How Customers Find You</span>
      <h2 class="d2">손님은 브랜드보다<br><em>상품</em>으로 찾아옵니다</h2>
      <p class="lead">상품명과 쓰임새 검색에 맞는 화면이 있어야 매출로 이어집니다.</p>
    </div>
    <div class="dt-cards stg rv">
      <div class="dt-card"><span class="n">01</span><span class="lab">상품</span><p class="q">천연 원목 도마</p><p>상품 상세 화면 · 상품 정보</p></div>
      <div class="dt-card"><span class="n">02</span><span class="lab">쓰임</span><p class="q">선물용 수제 향초</p><p>용도별 기획전 화면</p></div>
      <div class="dt-card"><span class="n">03</span><span class="lab">비교</span><p class="q">유기농 세안제 추천</p><p>상품 비교 · 후기</p></div>
      <div class="dt-card"><span class="n">04</span><span class="lab">구매</span><p class="q">○○ 무료배송</p><p>배송 · 교환 안내</p></div>
    </div>
  </div>
</section>
<!--/ed:shop/search-->

<!-- 검색 · AI -->
<!--ed:shop/visible-->
<section class="sec sec--paper2 dt-sec" id="visible" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 02</b>&nbsp; SEO · AEO · GEO</span>
      <h2 class="d2">검색 결과에도,<br><em>AI 답변</em>에도 보이도록</h2>
      <p class="lead">검색엔진과 AI가 쇼핑몰 홈페이지의 정보를 정확히 읽을 수 있게 처음부터 구조를 잡습니다. 순위를 약속하기보다 잘 읽히는 기본기를 갖춥니다.</p>
    </div>
    <div class="dt-split rv">
      <div class="dt-panel">
        <span class="tag">SEO</span><h3>검색 결과에 보이기</h3>
        <div class="dt-mock" aria-hidden="true"><div class="bar" data-rel="원목 도마 관리법,호두나무 도마,도마 선물 세트">천연 원목 도마</div><div class="res" data-url="www.oowood.co.kr"><b>천연 원목 도마 | ○○우드</b><span>원목 종류 · 크기 · 관리 방법을 비교하고 바로 구매하세요.</span></div></div>
        <ul><li>화면마다 검색 제목 · 설명 정리</li><li>네이버 · 구글 검색 등록과 사이트맵</li><li>빠르게 열리는 가벼운 화면</li></ul>
      </div>
      <div class="dt-panel">
        <span class="tag">AEO · GEO</span><h3>AI 답변에 담기기</h3>
        <div class="dt-mock" aria-hidden="true"><span class="ask">오래 쓰는 원목 도마 어디서 사?</span><div class="ans" data-src="○○우드 쇼핑몰,구매 후기">원목 종류와 크기, 관리 방법을 상품마다 자세히 적어 둔 곳이 고르기 쉽습니다. <b>○○우드</b>는 소재 설명과 구매 후기, 배송 · 교환 안내가 정리되어 있습니다.</div></div>
        <ul><li>고객 질문에 답하는 자주 묻는 질문</li><li>회사 · 서비스 정보 구조화 데이터</li><li>어디서나 같은 회사 설명</li></ul>
      </div>
    </div>
    <div class="dt-flow rv"><span>검색 노출</span><i>+</i><span>AI 답변</span><i>→</i><b>방문 · 문의</b></div>
  </div>
</section>
<!--/ed:shop/visible-->

<!-- 이런 곳에 필요합니다 -->
<!--ed:shop/fit-->
<section class="sec sec--paper dt-sec" id="fit" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 03</b>&nbsp; Who It's For</span>
      <h2 class="d2">이런 곳에<br><em>필요합니다</em></h2>
    </div>
    <ol class="dt-check rv">
      <li><div><b>처음 온라인 판매를 시작하는 곳</b><span>오프라인 상품을 온라인으로 팔고 싶을 때</span></div></li>
      <li><div><b>오픈마켓만 쓰던 브랜드</b><span>수수료 없는 자사몰이 필요할 때</span></div></li>
      <li><div><b>브랜드 분위기가 중요한 곳</b><span>틀에 박힌 화면 대신 브랜드다운 화면이 필요할 때</span></div></li>
      <li><div><b>상품이 많은 곳</b><span>분류 · 검색 · 기획전으로 찾기 쉽게 해야 할 때</span></div></li>
      <li><div><b>단골을 늘리고 싶은 곳</b><span>회원 · 적립금 · 쿠폰으로 재구매를 늘리고 싶을 때</span></div></li>
      <li><div><b>쇼핑몰이 오래된 곳</b><span>휴대폰에서 주문이 불편할 때</span></div></li>
    </ol>
  </div>
</section>
<!--/ed:shop/fit-->

<!-- 고객 이동 경로 -->
<!--ed:shop/journey-->
<section class="sec cap dt-sec" id="journey" data-nav="dark">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 04</b>&nbsp; Customer Journey</span>
      <h2 class="d2">검색에서 문의까지,<br><em>막힘없는 흐름</em></h2>
      <p class="lead">방문자가 단계마다 찾는 정보를 미리 준비해, 중간에 떠나지 않고 문의까지 이어지게 합니다.</p>
    </div>
    <div class="dt-steps stg rv">
      <div class="dt-step"><i>01</i><h4>검색</h4><p>상품명 · 용도로 찾아옵니다</p></div>
      <div class="dt-step"><i>02</i><h4>구경</h4><p>기획전과 상품 목록을 봅니다</p></div>
      <div class="dt-step"><i>03</i><h4>비교</h4><p>상세 정보와 후기를 살펴봅니다</p></div>
      <div class="dt-step"><i>04</i><h4>신뢰</h4><p>브랜드 · 배송 · 교환을 확인합니다</p></div>
      <div class="dt-step"><i>05</i><h4>구매</h4><p>장바구니에 담고 결제합니다</p></div>
    </div>
  </div>
</section>
<!--/ed:shop/journey-->

<!-- 화면 구조 · 핵심 기능 -->
<!--ed:shop/structure-->
<section class="sec sec--paper dt-sec" id="structure" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 05</b>&nbsp; Structure &amp; Features</span>
      <h2 class="d2">화면 구조와<br><em>핵심 기능</em></h2>
      <p class="lead">가지고 계신 자료를 그대로 옮기지 않고, 홈페이지에서 읽기 쉬운 구조로 다시 정리합니다.</p>
    </div>
    <div class="dt-struct rv">
      <div class="dt-tree">
        <span class="root">쇼핑몰 홈페이지</span>
        <ul>
          <li>메인 · 기획전<small>추천 · 신상품</small></li>
          <li>상품 목록<small>분류별 목록</small></li>
          <li>상품 상세<small>사진 · 정보 · 후기</small></li>
          <li>장바구니 · 주문<small>결제 · 배송지</small></li>
          <li>회원<small>가입 · 적립금 · 쿠폰</small></li>
          <li>브랜드 소개<small>이야기 · 철학</small></li>
          <li>고객센터<small>배송 · 교환 · 문의</small></li>
        </ul>
      </div>
      <ul class="dt-feat">
        <li><div><b>결제 연결</b><span>카드 · 계좌이체 · 간편결제 등 결제를 연결합니다.</span></div></li>
        <li><div><b>상품 · 주문 관리</b><span>상품 등록과 주문 · 배송 처리를 관리자에서 합니다.</span></div></li>
        <li><div><b>회원 · 적립금</b><span>회원 가입, 적립금, 쿠폰으로 재구매를 돕습니다.</span></div></li>
        <li><div><b>후기 · 문의</b><span>상품 후기와 문의를 받고 답변합니다.</span></div></li>
        <li><div><b>모바일 쇼핑 화면</b><span>휴대폰에서 고르고 결제하기 편하게 만듭니다.</span></div></li>
      </ul>
    </div>
  </div>
</section>
<!--/ed:shop/structure-->

<!-- 기본 포함 -->
<!--ed:shop/included-->
<section class="sec sec--paper2 dt-sec" id="included" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 06</b>&nbsp; Included</span>
      <h2 class="d2">기본으로<br><em>함께 드립니다</em></h2>
      <p class="lead">따로 요청하지 않으셔도 모든 홈페이지에 들어가는 항목입니다.</p>
    </div>
    <div class="dt-incl rv">
      <div><b>반응형 화면</b><span>PC · 태블릿 · 휴대폰 어디서든 보기 좋게 맞춥니다.</span></div>
      <div><b>보안 접속(SSL)</b><span>주소창 자물쇠 표시로 방문자가 안심하고 볼 수 있습니다.</span></div>
      <div><b>검색 등록</b><span>네이버 서치어드바이저 · 구글 서치콘솔 등록과 사이트맵 제출.</span></div>
      <div><b>방문 통계 연결</b><span>어떤 검색어로 몇 명이 들어오는지 확인할 수 있게 연결합니다.</span></div>
      <div><b>화면 보며 고치는 관리자</b><span>글자 · 사진 · 메뉴를 홈페이지 화면에서 바로 수정합니다.</span></div>
      <div><b>문의 알림</b><span>문의가 들어오면 이메일로 바로 알려 드립니다.</span></div>
      <div><b>AI가 읽는 구조</b><span>자주 묻는 질문과 구조화 데이터로 회사 정보를 정리합니다.</span></div>
      <div><b>게시판 · 공지</b><span>소식 · 공지 · 자료를 직접 올릴 수 있습니다.</span></div>
      <div><b>오픈 후 안내</b><span>관리자 사용법과 운영 방법을 정리해 전달합니다.</span></div>
    </div>
  </div>
</section>
<!--/ed:shop/included-->

<!-- 비용 기준 -->
<!--ed:shop/cost-->
<section class="sec sec--paper dt-sec" id="cost" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 07</b>&nbsp; Pricing</span>
      <h2 class="d2">비용은 이렇게<br><em>정해집니다</em></h2>
      <p class="lead">견적을 드리기 전에 무엇에 따라 비용이 달라지는지 먼저 설명드립니다.</p>
    </div>
    <div class="dt-cost rv">
      <div><span class="n">01</span><h4>화면 수</h4><p>메인 외에 몇 개의 화면이 필요한지가 가장 큰 기준입니다.</p></div>
      <div><span class="n">02</span><h4>내용 준비 범위</h4><p>문구 작성 · 사진 정리 · 자료 옮기기를 어디까지 맡기시는지에 따라 달라집니다.</p></div>
      <div><span class="n">03</span><h4>기능과 언어</h4><p>예약 · 결제 · 회원 같은 기능이나 외국어 화면이 필요하면 범위가 늘어납니다.</p></div>
    </div>
    <div class="dt-more rv"><a class="btn" href="price.html" style="color:var(--ink)"><span>비용 안내 자세히 보기</span>
      <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a></div>
  </div>
</section>
<!--/ed:shop/cost-->

<!-- 자주 묻는 질문 -->
<!--ed:shop/faq-->
<section class="sec sec--paper2 dt-sec" id="faq" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 08</b>&nbsp; FAQ</span>
      <h2 class="d2">자주 묻는 질문</h2>
    </div>
    <div class="dt-faq rv">
      <details><summary>어떤 방식으로 쇼핑몰을 만드나요?</summary><p>상품 수와 운영 방식에 맞춰 쇼핑몰 솔루션 활용 또는 맞춤 제작 중에서 함께 정합니다. 운영 비용과 관리 편의를 비교해 안내합니다.</p></details>
      <details><summary>결제는 어떻게 연결하나요?</summary><p>결제 대행사(PG) 가입을 안내해 드리고, 가입이 끝나면 쇼핑몰에 결제를 연결합니다.</p></details>
      <details><summary>오픈마켓 상품을 옮길 수 있나요?</summary><p>상품 정보와 사진을 정리해 옮길 수 있습니다. 상품 수가 많으면 옮기는 방법을 상담 때 정합니다.</p></details>
      <details><summary>자료가 거의 없는데 시작할 수 있나요?</summary><p>네. 상담에서 들은 내용으로 메뉴 구성과 첫 문구를 먼저 제안해 드립니다. 사진이 없으면 촬영 방법이나 대체 이미지도 함께 정합니다.</p></details>
      <details><summary>오픈 후에 직접 고칠 수 있나요?</summary><p>네. 홈페이지 화면을 보면서 글자 · 사진 · 메뉴를 바로 고치는 관리자를 드립니다. 저장한 내용은 확인 후 게시하고, 이전 상태로 되돌릴 수도 있습니다.</p></details>
      <details><summary>비용은 어떻게 정해지나요?</summary><p>화면 수, 내용 준비 범위, 필요한 기능에 따라 정해집니다. 상담 후 범위를 정리해 견적을 안내해 드립니다.</p></details>
    </div>
  </div>
</section>
<!--/ed:shop/faq-->
</main>

<!-- FOOTER -->
<?= view('site/partials/footer_ko') ?>

<script src="js/v2.js?v=20260902"></script>
<script src="js/dt-vis.js?v=20261110b"></script>
</body>
</html>
