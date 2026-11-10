<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>몽웹 MongWeb · 홈페이지 제작 · SEO · AEO · GEO</title>
<meta name="description" content="기업 홈페이지 제작부터 SEO · AEO · GEO 검색 대응, 직접 수정하는 관리자, 오픈 후 유지보수까지. 꿈을 웹으로 잇는 몽웹.">
<link rel="canonical" href="https://k1tnc.co.kr/">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/">
<link rel="alternate" hreflang="en" href="https://k1tnc.co.kr/en/">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/">
<meta property="og:type" content="website">
<meta property="og:site_name" content="몽웹 MongWeb">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="몽웹 MongWeb · 홈페이지 제작">
<meta property="og:description" content="기업 홈페이지 제작부터 SEO · AEO · GEO 검색 대응, 직접 수정하는 관리자, 오픈 후 유지보수까지. 꿈을 웹으로 잇는 몽웹.">
<meta property="og:url" content="https://k1tnc.co.kr/">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="몽웹 MongWeb · 홈페이지 제작">
<meta name="twitter:description" content="기업 홈페이지 제작부터 SEO · AEO · GEO 검색 대응, 직접 수정하는 관리자, 오픈 후 유지보수까지. 꿈을 웹으로 잇는 몽웹.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20261111b">
</head>
<body class="home">
<a class="skip" href="#top">본문 바로가기</a>

<!-- ============ HEADER (adaptive dark/light) ============ -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => '#top', 'alt_lang_url' => 'en/index.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => '고객문의']) ?>
<?= view('site/partials/header_ko') ?>

<main id="top">

<!-- ============ HERO ============ -->
<!--ed:index/hero-->
<section class="hero" id="hero" data-nav="dark">
  <div class="hero__media"><video src="assets/hero.mp4" poster="assets/hero-poster.jpg" autoplay muted loop playsinline preload="auto" aria-label="두 사람이 악수하는 모습"></video></div>
  <div class="hero__veil"></div>
  <div class="scrollcue">SCROLL</div>

  <div class="hero__top">
    <div class="wrap">
      <span class="hero__eyebrow">WEBSITE · SEO · AEO · GEO</span>
      <h1>
        <span class="mask"><span>당신의 <i>꿈</i>을,</span></span>
        <span class="mask"><span>웹사이트라는 가치로.</span></span>
      </h1>
      <p class="hero__sub">머릿속에 그리던 모습을 화면 위에 그대로.<br>작은 가게부터 기업까지, 꿈을 웹으로 잇는 <span class="nb">몽웹.</span></p>
      <div class="hero__act">
        <a class="btn btn--solid" href="contact.html#inquiry"><span>제작 문의하기</span>
          <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
      </div>
    </div>
  </div>

  <div class="dom">
    <div class="dom__lab">One Team · Two Strengths</div>
    <div class="dom__in">
      <div class="dom__b" data-k="k1">
        <div class="dom__mk"><i class="dot" aria-hidden="true"></i><b>Web Build</b><span>Design · Develop</span></div>
        <ul class="dom__f"><li>기업 홈페이지</li><li>브랜드 사이트</li><li>랜딩페이지</li></ul>
        <div class="dom__en"><b>기획부터 오픈까지 한 팀이 직접</b><span>Planning · Design · Development</span></div>
      </div>
      <div class="dom__b" data-k="ocean">
        <div class="dom__mk"><i class="dot" aria-hidden="true"></i><b>Search Ready</b><span>SEO · AEO · GEO</span></div>
        <ul class="dom__f"><li>검색 노출</li><li>AI 답변 대응</li><li>구조화 데이터</li></ul>
        <div class="dom__en"><b>사람과 검색엔진, AI가 함께 읽는 구조</b></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:index/hero-->

<!-- ============ 숫자로 보는 기본 제공 ============ -->
<!--ed:index/figs-->
<section class="figs" data-nav="dark">
  <div class="wrap">
    <div class="figs__in rv">
      <div class="fig"><div class="fig__n"><span>5</span><em>단계</em></div><div class="fig__l">상담부터 오픈까지 제작 절차</div></div>
      <div class="fig"><div class="fig__n"><span>100</span><em>%</em></div><div class="fig__l">PC · 태블릿 · 휴대폰 반응형</div></div>
      <div class="fig"><div class="fig__n"><span>3</span><em>가지</em></div><div class="fig__l">SEO · AEO · GEO 기본 세팅</div></div>
      <div class="fig"><div class="fig__n"><span>24</span><em>시간</em></div><div class="fig__l">온라인 문의 접수</div></div>
    </div>
  </div>
</section>
<!--/ed:index/figs-->

<!-- ============ ABOUT ============ -->
<!--ed:index/about-->
<section class="sec sec--paper about" id="about" data-nav="light">
  <div class="wrap">
    <div class="about__grid">
      <div class="about__img about__img--photo about__img--cover rv">
        <img src="assets/about-web5.jpg" alt="몽웹 홈페이지가 열린 노트북 화면을 보며 생각하는 사람" width="1672" height="941" loading="lazy">
      </div>
      <div class="about__txt">
        <span class="eyebrow rv">／ 01 &nbsp;About Us</span>
        <h2 class="d2 rv">보기 좋은 화면을 넘어<br><em>문의로 이어지는 홈페이지</em></h2>
        <p class="lead rv">몽웹은 회사를 처음 보는 고객이 무엇을 먼저 궁금해하는지부터 생각합니다. 소개 · 서비스 · 신뢰 · 문의로 이어지는 흐름을 설계하고, 검색엔진과 AI도 그 내용을 정확히 읽을 수 있게 만듭니다.</p>
      </div>
    </div>
    <div class="vals stg rv">
      <div class="val"><i class="ic i-trust" aria-hidden="true"></i><h3>업종을 먼저 이해합니다<b>Understand · 이해</b></h3><p>업종마다 고객이 먼저 확인하는 정보가 다릅니다. 상담에서 사업과 고객을 이해한 뒤, 그 순서에 맞춰 메뉴와 화면을 구성합니다.</p></div>
      <div class="val"><i class="ic i-collab" aria-hidden="true"></i><h3>찾히는 구조로 만듭니다<b>Search · 검색</b></h3><p>제목 · 설명 · 구조화 데이터를 기획 단계부터 함께 설계해 네이버 · 구글 검색과 AI 답변에 회사 정보가 정확히 담기도록 합니다.</p></div>
      <div class="val"><i class="ic i-responsibility" aria-hidden="true"></i><h3>오픈 뒤에도 함께합니다<b>Care · 관리</b></h3><p>화면을 보면서 직접 고치는 관리자를 드리고, 오픈 후 수정 · 점검 · 기능 추가까지 계속 함께합니다.</p></div>
    </div>
  </div>
</section>
<!--/ed:index/about-->

<!-- ============ 두 가지 제작 방식 ============ -->
<!--ed:index/services-->
<section class="sec sec--paper2 brands" id="services" data-nav="light">
  <div class="wrap">
    <div class="brands__head">
      <span class="eyebrow rv">／ Services</span>
      <h2 class="d2 rv">처음 만드는 홈페이지도,<br><em>다시 만드는 홈페이지도</em></h2>
      <p class="lead rv">새로 시작하는 회사와 오래된 홈페이지를 바꾸려는 회사, 상황이 달라도 같은 기준으로 만듭니다.</p>
    </div>
    <div class="brands__grid">
      <article class="brand-c rv">
        <div class="brand-c__id">
          <img class="brand-c__mk" src="assets/favicon.png" alt="" loading="lazy">
          <div class="brand-c__nm">
            <b>신규 제작 <span>New Build</span></b>
            <span class="brand-c__svc">Planning · Design · Development</span>
          </div>
        </div>
        <div class="brand-c__en">From the first conversation to launch</div>
        <p class="brand-c__tag">자료가 없어도 괜찮습니다.<br>상담 내용으로 기획부터 시작합니다</p>
        <p>회사 소개서나 정리된 자료가 없어도 시작할 수 있습니다. 상담에서 들은 내용으로 메뉴 구성과 첫 문구를 먼저 제안합니다.</p>
        <p>디자인 시안을 함께 다듬고, PC와 휴대폰에서 모두 보기 좋은 화면으로 만듭니다.</p>
        <p>도메인 · 호스팅 연결과 검색 등록까지 마친 뒤 오픈합니다.</p>
      </article>
      <article class="brand-c rv">
        <div class="brand-c__id">
          <img class="brand-c__mk" src="assets/favicon.png" alt="" loading="lazy">
          <div class="brand-c__nm">
            <b>리뉴얼 <span>Renewal</span></b>
            <span class="brand-c__svc">Restructure · Redesign · Migrate</span>
          </div>
        </div>
        <div class="brand-c__en">Keep the domain, rebuild the experience</div>
        <p class="brand-c__tag">오래된 홈페이지를<br>지금의 검색과 고객에 맞게</p>
        <p>예전 홈페이지는 사람이 읽는 것만 생각하고 만든 경우가 많습니다. 지금은 검색엔진과 AI가 먼저 읽고 고객에게 전달합니다.</p>
        <p>쓰던 도메인은 그대로 두고, 기존 글과 자료를 옮기면서 메뉴와 화면 구조를 새로 정리합니다.</p>
        <p>휴대폰에서 불편했던 화면, 직접 고칠 수 없던 관리 방식도 함께 바꿉니다.</p>
      </article>
    </div>
  </div>
</section>
<!--/ed:index/services-->

<!-- ============ 핵심 역량 ============ -->
<!--ed:index/capability-->
<section class="sec cap" id="capability" data-nav="dark">
  <div class="wrap">
    <div class="cap__grid">
      <div class="cap__aside">
        <span class="eyebrow rv">／ 02 &nbsp;Capability</span>
        <h2 class="d2 rv">기획부터 운영까지,<br>하나의 흐름으로</h2>
        <p class="lead rv">기획 · 디자인 · 개발 · 검색 대응을 따로 맡기지 않아도 됩니다. 몽웹이 <em>처음부터 끝까지 한 흐름</em>으로 진행합니다.</p>
        <span class="cap__badge rv"><i aria-hidden="true"></i>All-in-one Website Team</span>
      </div>
      <div class="cap__sys rv">
        <div class="cap__node" tabindex="0"><div class="no">01</div><h3>Planning</h3><p>업종과 고객에 맞춘 메뉴 구성 · 화면 설계 · 첫 문구 제안.</p></div>
        <div class="cap__node" tabindex="0"><div class="no">02</div><h3>Design</h3><p>브랜드 색과 분위기를 담은 디자인, 문의로 이어지는 화면 배치.</p></div>
        <div class="cap__node" tabindex="0"><div class="no">03</div><h3>Development</h3><p>PC · 태블릿 · 휴대폰 반응형, 빠르게 열리는 가벼운 화면.</p></div>
        <div class="cap__node" tabindex="0"><div class="no">04</div><h3>SEO · AEO · GEO</h3><p>검색 노출 · 질문에 대한 답 · AI가 이해하는 회사 정보까지 구조로 설계.</p></div>
        <div class="cap__node" tabindex="0"><div class="no">05</div><h3>Easy Admin</h3><p>홈페이지 화면을 보면서 글자 · 사진 · 메뉴를 직접 고치는 관리자.</p></div>
        <div class="cap__node" tabindex="0"><div class="no">06</div><h3>Care</h3><p>오픈 후 수정 · 점검 · 기능 추가, 필요한 만큼 이어지는 관리.</p></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:index/capability-->

<!-- ============ 제작 서비스 (패널) ============ -->
<!--ed:index/business-->
<section class="biz" id="business" data-nav="dark">
  <div class="wrap biz__intro">
    <span class="eyebrow rv">／ 03 &nbsp;What We Build</span>
    <h2 class="d2 rv">사람도, 검색도, AI도<br>이해하는 홈페이지</h2>
    <p class="lead rv">보기 좋은 디자인에 검색 대응과 쉬운 관리까지, 홈페이지에 필요한 것을 한 번에 갖춥니다.</p>
  </div>

  <!-- 01 기업 홈페이지 -->
  <article class="bizp rv" data-nav="dark">
    <div class="bizp__viz bizp__viz--photo"><img src="assets/biz-corporate-mw.jpg" alt="기업 홈페이지가 열린 노트북" width="1672" height="941" loading="lazy"></div>
    <div class="bizp__scrim"></div>
    <div class="bizp__body"><div class="bizp__c">
      <span class="bizp__no">01</span><span class="bizp__en">Corporate Website</span>
      <h3>기업 홈페이지</h3>
      <ul><li>회사소개 · 서비스 · 실적 · 문의까지 한 흐름으로</li><li>업종에 맞춘 메뉴와 화면 구성</li><li>브랜드 색과 분위기를 담은 디자인</li></ul>
    </div></div>
  </article>

  <!-- 02 반응형 · 모바일 -->
  <article class="bizp rv" data-nav="dark">
    <div class="bizp__viz bizp__viz--phone"><img src="assets/biz-mobile.gif" alt="휴대폰에 맞춰 보이는 몽웹 홈페이지 화면" width="508" height="508" loading="lazy"></div>
    <div class="bizp__scrim"></div>
    <div class="bizp__body"><div class="bizp__c">
      <span class="bizp__no">02</span><span class="bizp__en">Responsive</span>
      <h3>반응형 · 모바일</h3>
      <ul><li>PC · 태블릿 · 휴대폰 모두 기본</li><li>손가락으로 누르기 편한 버튼과 글자 크기</li><li>빠르게 열리는 가벼운 화면</li></ul>
    </div></div>
  </article>

  <!-- 03 SEO 검색 최적화 -->
  <article class="bizp rv" data-nav="dark">
    <div class="bizp__viz bizp__viz--photo bizp__viz--seo"><img src="assets/biz-seo.jpg" alt="구글 검색 결과 맨 위에 몽웹이 보이는 노트북 화면" width="1832" height="858" loading="lazy"></div>
    <div class="bizp__scrim"></div>
    <div class="bizp__body"><div class="bizp__c">
      <span class="bizp__no">03</span><span class="bizp__en">Search Engine Optimization</span>
      <h3>SEO 검색 최적화</h3>
      <ul><li>화면마다 제목 · 설명 · 주소 정리</li><li>네이버 서치어드바이저 · 구글 서치콘솔 등록</li><li>사이트맵 · 검색 수집 설정</li></ul>
    </div></div>
  </article>

  <!-- 04 AI 검색 대응 -->
  <article class="bizp rv" data-nav="dark">
    <div class="bizp__viz bizp__viz--fig"><img src="assets/biz-aeo.jpg" alt="네이버 검색 · 구글 AI 개요 · ChatGPT 답변에 몽웹이 나오는 휴대폰 세 대" width="1672" height="941" loading="lazy"></div>
    <div class="bizp__scrim"></div>
    <div class="bizp__body"><div class="bizp__c">
      <span class="bizp__no">04</span><span class="bizp__en">AEO · GEO</span>
      <h3>AI 검색 대응</h3>
      <ul><li>고객 질문에 답하는 자주 묻는 질문 구성</li><li>회사 · 서비스 정보를 구조화 데이터로 정리</li><li>AI 답변에 정확한 정보가 담기도록 설계</li></ul>
    </div></div>
  </article>

  <!-- 05 유지보수 · 운영 -->
  <article class="bizp rv" data-nav="dark">
    <div class="bizp__viz bizp__viz--photo bizp__viz--maint"><img src="assets/biz-maint.jpg" alt="몽웹 관리자 대시보드에서 사이트 운영 현황을 보여 주는 노트북" width="1965" height="800" loading="lazy"></div>
    <div class="bizp__scrim"></div>
    <div class="bizp__body"><div class="bizp__c">
      <span class="bizp__no">05</span><span class="bizp__en">Maintenance</span>
      <h3>유지보수 · 운영</h3>
      <ul><li>오픈 후 수정 · 기능 추가 요청</li><li>정기 점검 · 백업 · 보안 업데이트</li><li>도메인 · 호스팅 연장 관리</li></ul>
    </div></div>
  </article>

</section>
<!--/ed:index/business-->

<!-- ============ 제작 절차 · 차별점 ============ -->
<!--ed:index/process-->
<section class="sec exe" id="process" data-nav="dark">
  <div class="wrap">
    <div class="exe__head">
      <span class="eyebrow rv">／ 04 &nbsp;How We Work</span>
      <h2 class="d2 rv">상담부터 오픈까지<br><em>5단계로 진행합니다</em></h2>
      <p class="lead rv">단계마다 무엇을 하고 무엇을 확인하는지 미리 알려 드립니다. 확인을 받은 뒤 다음 단계로 넘어갑니다.</p>
    </div>
    <div class="kes2 rv">
      <div class="kes2__core">
        <div class="kesd__meta">
          <div class="kes2__vow"><span>LISTEN</span><span>PLAN</span><span>DESIGN</span><span>LAUNCH</span></div>
          <p class="kes2__cap">이야기를 듣는 것에서 시작해, 오픈 뒤까지 이어집니다<em>From your story to a working website.</em></p>
        </div>
        <div class="kesd__hub">
          <b>MW</b>
          <span>MongWeb Process</span>
          <em>DREAM TO WEB</em>
        </div>
      </div>
      <div class="kes2__grid stg">
        <article class="kp"><i class="kp__node" aria-hidden="true"></i><span class="kp__n">01</span><h3>상담</h3>
          <ul><li>회사 · 고객 이야기</li><li>참고 사이트</li><li>예산 · 일정</li><li>견적 안내</li></ul></article>
        <article class="kp"><i class="kp__node" aria-hidden="true"></i><span class="kp__n">02</span><h3>기획</h3>
          <ul><li>메뉴 구성</li><li>화면 설계</li><li>첫 문구 제안</li><li>검색 키워드 정리</li></ul></article>
        <article class="kp"><i class="kp__node" aria-hidden="true"></i><span class="kp__n">03</span><h3>디자인</h3>
          <ul><li>메인 시안</li><li>하위 화면 시안</li><li>휴대폰 화면</li><li>수정 반영</li></ul></article>
        <article class="kp"><i class="kp__node" aria-hidden="true"></i><span class="kp__n">04</span><h3>개발</h3>
          <ul><li>반응형 화면 제작</li><li>관리자 연결</li><li>SEO · AEO · GEO 세팅</li><li>기기별 점검</li></ul></article>
        <article class="kp"><i class="kp__node" aria-hidden="true"></i><span class="kp__n">05</span><h3>오픈</h3>
          <ul><li>도메인 · 호스팅 연결</li><li>검색 등록</li><li>관리자 사용법 안내</li><li>오픈 후 관리</li></ul></article>
      </div>
      <div class="kes2__val rv"><span>반응형 기본</span><span>검색 대응</span><span>AI 대응</span><span>직접 수정</span><span>빠른 화면</span><span>오픈 후 관리</span></div>
      <div class="kes2__band rv">
        <span>기업 · 제조</span>
        <span>병원 · 의원</span>
        <span>학원 · 교육</span>
        <span>매장 · 프랜차이즈</span>
        <span>쇼핑몰 · 브랜드</span>
        <b>Website Total Solution</b>
      </div>
    </div>

    <div class="diff rv">
      <h3 class="diff__t">몽웹이 <em>다른 점</em></h3>
      <p class="lc__kes"><b>MW</b><span>MongWeb</span>디자인만 예쁜 홈페이지가 아니라, 고객이 이해하고 문의하는 홈페이지를 만듭니다.</p>
      <div class="diff__grid stg">
        <div class="diff__i">
          <i class="ic diff__ic i-control" aria-hidden="true"></i>
          <h4>자료 없이도 시작</h4><p>상담 내용으로 메뉴와 첫 문구를 먼저 제안합니다.</p>
        </div>
        <div class="diff__i">
          <i class="ic diff__ic i-integration" aria-hidden="true"></i>
          <h4>업종에 맞춘 구조</h4><p>고객이 먼저 찾는 정보부터 보이게 구성합니다.</p>
        </div>
        <div class="diff__i">
          <i class="ic diff__ic i-procedure" aria-hidden="true"></i>
          <h4>검색 · AI가 읽는 설계</h4><p>SEO · AEO · GEO를 기획 단계부터 함께 잡습니다.</p>
        </div>
        <div class="diff__i">
          <i class="ic diff__ic i-handover" aria-hidden="true"></i>
          <h4>직접 고치는 관리자</h4><p>화면을 보면서 글자 · 사진 · 메뉴를 바로 바꿉니다.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/ed:index/process-->

<!-- ============ 업종별 맞춤 ============ -->
<!--ed:index/industries-->
<section class="sec sec--paper" id="industries" data-nav="light">
  <div class="wrap">
    <div class="pj__intro">
      <span class="eyebrow rv">／ 05 &nbsp;Industries</span>
      <h2 class="d2 rv">업종마다<br>먼저 보여야 할 것이 다릅니다</h2>
      <p class="lead rv">병원은 진료 정보, 학원은 커리큘럼, 매장은 위치와 메뉴. 고객이 가장 먼저 찾는 정보부터 보이도록 구조를 잡습니다.</p>
    </div>
    <div class="pj-feat stg rv">
      <article class="pj-card"><div class="pj-card__ph"><img src="assets/ind-corporate.jpg" alt="정밀가공 제조기업 홈페이지가 열린 노트북" width="884" height="552" loading="lazy"></div>
        <div class="yr">회사 소개부터</div><h3>기업 · 제조</h3><p>회사소개 · 제품 · 인증 · 실적을 한눈에, 견적 문의로 이어지게.</p></article>
      <article class="pj-card"><div class="pj-card__ph"><img src="assets/ind-hospital.jpg" alt="병원 홈페이지가 열린 노트북" width="884" height="552" loading="lazy"></div>
        <div class="yr">진료 정보부터</div><h3>병원 · 의원</h3><p>진료 과목 · 의료진 · 진료 시간 · 오시는 길을 먼저 보이게.</p></article>
      <article class="pj-card"><div class="pj-card__ph"><img src="assets/ind-academy.jpg" alt="학원 홈페이지가 열린 노트북" width="884" height="552" loading="lazy"></div>
        <div class="yr">커리큘럼부터</div><h3>학원 · 교육</h3><p>과정 · 강사 · 시간표 · 상담 신청을 휴대폰에서도 쉽게.</p></article>
      <article class="pj-card"><div class="pj-card__ph"><img src="assets/ind-cafe.jpg" alt="카페 홈페이지가 열린 노트북" width="884" height="552" loading="lazy"></div>
        <div class="yr">메뉴와 위치부터</div><h3>음식점 · 카페</h3><p>메뉴 · 영업시간 · 위치 · 예약을 한 화면에서.</p></article>
      <article class="pj-card"><div class="pj-card__ph"><img src="assets/ind-shop.jpg" alt="쇼핑몰 홈페이지가 열린 노트북" width="884" height="552" loading="lazy"></div>
        <div class="yr">브랜드 이야기부터</div><h3>쇼핑몰 · 브랜드</h3><p>브랜드 소개와 상품 안내, 구매 · 문의로 이어지는 흐름.</p></article>
      <article class="pj-card"><div class="pj-card__ph"><img src="assets/ind-law.jpg" alt="법률사무소 홈페이지가 열린 노트북" width="884" height="552" loading="lazy"></div>
        <div class="yr">전문 분야부터</div><h3>법률 · 전문직</h3><p>업무 분야 · 사례 · 자주 묻는 질문으로 신뢰를 먼저.</p></article>
    </div>
    <div class="rv">
      <a class="btn" href="price.html" style="color:var(--ink)"><span>비용 안내 보기</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </div>
  </div>
</section>
<!--/ed:index/industries-->

<!-- ============ SEO · AEO · GEO ============ -->
<!--ed:index/search-->
<section class="sec sec--paper2" id="search" data-nav="light">
  <div class="wrap">
    <div class="bizd rv">
      <div class="bizd__head">
        <div><div class="en">SEO · AEO · GEO</div><h2>검색에서 찾히고,<br>AI가 정확히 소개하도록</h2></div>
        <p>요즘 고객은 검색창에 묻고, AI에게도 묻습니다. 어느 쪽에서든 회사 정보가 정확히 나오도록 세 가지를 함께 설계합니다. 검색 순위나 AI 답변 노출을 약속하기보다, 잘 읽히는 기본기를 탄탄히 갖춥니다.</p>
      </div>
      <div class="bizd__grid stg">
        <div class="bizd__i"><div class="n">SEO</div><h3>검색엔진 최적화</h3><div class="en2">Search Engine Optimization</div><ul><li>화면마다 제목 · 설명 정리</li><li>네이버 · 구글 검색 등록</li><li>사이트맵 · 빠른 화면</li></ul></div>
        <div class="bizd__i"><div class="n">AEO</div><h3>답변 엔진 최적화</h3><div class="en2">Answer Engine Optimization</div><ul><li>고객 질문을 미리 정리</li><li>질문 · 답 형식의 자주 묻는 질문</li><li>짧고 정확한 답변 문구</li></ul></div>
        <div class="bizd__i"><div class="n">GEO</div><h3>생성형 AI 최적화</h3><div class="en2">Generative Engine Optimization</div><ul><li>회사 · 서비스 · 지역 정보 정리</li><li>구조화 데이터 적용</li><li>AI가 이해하는 일관된 설명</li></ul></div>
      </div>
    </div>
  </div>
</section>
<!--/ed:index/search-->

<!-- ============ 몽웹의 약속 ============ -->
<!--ed:index/promise-->
<section class="sec cap" id="promise" data-nav="dark">
  <div class="wrap">
    <div class="cert__lead">
      <span class="eyebrow rv">／ 06 &nbsp;Our Promise</span>
      <h2 class="d2 rv">모든 홈페이지에<br><em>기본으로 담습니다</em></h2>
      <p class="lead rv">요금제와 상관없이, 몽웹이 만드는 홈페이지에는 이 네 가지가 기본으로 들어갑니다.</p>
    </div>
    <div class="certrow rv">
      <div class="certc"><i class="ic i-quality" aria-hidden="true"></i><h3>반응형</h3><div class="k">PC · 태블릿 · 휴대폰</div><div class="en">Responsive Design</div></div>
      <div class="certc"><i class="ic i-eco" aria-hidden="true"></i><h3>검색 기본 세팅</h3><div class="k">SEO · AEO · GEO</div><div class="en">Search Ready</div></div>
      <div class="certc"><i class="ic i-safety" aria-hidden="true"></i><h3>관리자 제공</h3><div class="k">화면 보며 직접 수정</div><div class="en">Easy Admin</div></div>
      <div class="certc"><i class="ic i-license" aria-hidden="true"></i><h3>오픈 후 지원</h3><div class="k">수정 · 점검 · 안내</div><div class="en">After Launch Care</div></div>
    </div>
  </div>
</section>
<!--/ed:index/promise-->

</main>

<!-- ============ FOOTER ============ -->
<?= view('site/partials/footer_ko') ?>

<script src="js/v2.js?v=20260902"></script>
</body>
</html>
