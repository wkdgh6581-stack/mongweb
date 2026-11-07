<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>병원 홈페이지 제작 · 몽웹 MongWeb</title>
<meta name="description" content="몽웹 병원 홈페이지 제작 — 환자는 증상과 지역으로 병원을 찾고, 휴대폰으로 진료 시간과 위치를 확인합니다. 필요한 정보를 빠르게 찾고 예약 · 상담으로 이어지는 병원 홈페이지를 만듭니다.">
<link rel="canonical" href="https://k1tnc.co.kr/hospital.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/hospital.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/hospital.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="몽웹 MongWeb">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="병원 홈페이지 제작 · 몽웹 MongWeb">
<meta property="og:description" content="몽웹 병원 홈페이지 제작 — 환자는 증상과 지역으로 병원을 찾고, 휴대폰으로 진료 시간과 위치를 확인합니다. 필요한 정보를 빠르게 찾고 예약 · 상담으로 이어지는 병원 홈페이지를 만듭니다.">
<meta property="og:url" content="https://k1tnc.co.kr/hospital.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="병원 홈페이지 제작 · 몽웹 MongWeb">
<meta name="twitter:description" content="몽웹 병원 홈페이지 제작 — 환자는 증상과 지역으로 병원을 찾고, 휴대폰으로 진료 시간과 위치를 확인합니다. 필요한 정보를 빠르게 찾고 예약 · 상담으로 이어지는 병원 홈페이지를 만듭니다.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="css/v2.css?v=20261107c">
</head>
<body class="sub">
<a class="skip" href="#main">본문 바로가기</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => 'en/index.html', 'foot_cta_url' => 'contact.html', 'foot_cta_label' => '고객문의']) ?>
<?= view('site/partials/header_ko') ?>

<!-- SUB HERO -->
<!--ed:hospital/subhero-->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="index.html">홈</a> <b>›</b> <a href="business.html">홈페이지제작</a> <b>›</b> 병원 홈페이지</div>
    <h1>병원 홈페이지 제작</h1>
    <div class="en">Hospital · Clinic</div>
    <p class="dt-lead">환자는 증상과 지역으로 병원을 찾고, 휴대폰으로 진료 시간과 위치를 확인합니다. 필요한 정보를 빠르게 찾고 예약 · 상담으로 이어지는 병원 홈페이지를 만듭니다.</p>
    <div class="dt-cta">
      <a class="btn btn--solid" href="contact.html#inquiry"><span>제작 상담 신청</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
      <a class="btn btn--line" href="price.html"><span>비용 안내 보기</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </div>
  </div>
</section>
<!--/ed:hospital/subhero-->

<main id="main">
<!-- 고객이 찾는 검색어 -->
<!--ed:hospital/search-->
<section class="sec sec--paper dt-sec" id="search" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 01</b>&nbsp; How Customers Find You</span>
      <h2 class="d2">환자는 병원 이름보다<br><em>증상과 지역</em>으로 찾습니다</h2>
      <p class="lead">진료 과목과 지역 검색에 맞는 화면이 있어야 병원이 발견됩니다.</p>
    </div>
    <div class="dt-cards stg rv">
      <div class="dt-card"><span class="n">01</span><span class="lab">증상</span><p class="q">허리 통증 병원</p><p>진료 과목 · 치료 안내 화면</p></div>
      <div class="dt-card"><span class="n">02</span><span class="lab">지역</span><p class="q">강남역 피부과</p><p>위치 · 오시는 길 · 주차 안내</p></div>
      <div class="dt-card"><span class="n">03</span><span class="lab">시간</span><p class="q">토요일 진료 소아과</p><p>진료 시간 · 휴진일 안내</p></div>
      <div class="dt-card"><span class="n">04</span><span class="lab">의료진</span><p class="q">어깨 전문의</p><p>의료진 소개와 진료 분야</p></div>
    </div>
  </div>
</section>
<!--/ed:hospital/search-->

<!-- 검색 · AI -->
<!--ed:hospital/visible-->
<section class="sec sec--paper2 dt-sec" id="visible" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 02</b>&nbsp; SEO · AEO · GEO</span>
      <h2 class="d2">검색 결과에도,<br><em>AI 답변</em>에도 보이도록</h2>
      <p class="lead">검색엔진과 AI가 병원 홈페이지의 정보를 정확히 읽을 수 있게 처음부터 구조를 잡습니다. 순위를 약속하기보다 잘 읽히는 기본기를 갖춥니다.</p>
    </div>
    <div class="dt-split rv">
      <div class="dt-panel">
        <span class="tag">SEO</span><h3>검색 결과에 보이기</h3>
        <div class="dt-mock" aria-hidden="true"><div class="bar">허리 통증 병원</div><div class="res"><b>허리 통증 병원 | 우리 회사</b><span>화면마다 정리된 제목과 설명이 검색 결과에 그대로 나옵니다.</span></div></div>
        <ul><li>화면마다 검색 제목 · 설명 정리</li><li>네이버 · 구글 검색 등록과 사이트맵</li><li>빠르게 열리는 가벼운 화면</li></ul>
      </div>
      <div class="dt-panel">
        <span class="tag">AEO · GEO</span><h3>AI 답변에 담기기</h3>
        <div class="dt-mock" aria-hidden="true"><span class="ask">허리 통증 병원, 어디가 좋을까?</span><div class="ans"><b>우리 회사</b>는 … 정리된 회사 정보와 자주 묻는 질문을 바탕으로 소개됩니다.</div></div>
        <ul><li>고객 질문에 답하는 자주 묻는 질문</li><li>회사 · 서비스 정보 구조화 데이터</li><li>어디서나 같은 회사 설명</li></ul>
      </div>
    </div>
    <div class="dt-flow rv"><span>검색 노출</span><i>+</i><span>AI 답변</span><i>→</i><b>방문 · 문의</b></div>
  </div>
</section>
<!--/ed:hospital/visible-->

<!-- 이런 곳에 필요합니다 -->
<!--ed:hospital/fit-->
<section class="sec sec--paper dt-sec" id="fit" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 03</b>&nbsp; Who It's For</span>
      <h2 class="d2">이런 곳에<br><em>필요합니다</em></h2>
    </div>
    <ol class="dt-check rv">
      <li><div><b>새로 개원한 병원</b><span>지역에 병원을 알리고 첫 환자를 맞을 때</span></div></li>
      <li><div><b>홈페이지가 오래된 병원</b><span>휴대폰에서 보기 불편하고 정보가 바뀌지 않을 때</span></div></li>
      <li><div><b>진료 과목이 많은 병원</b><span>과목별로 찾기 쉽게 나눠야 할 때</span></div></li>
      <li><div><b>예약 전화가 많은 병원</b><span>온라인 예약 · 상담 신청으로 전화를 줄이고 싶을 때</span></div></li>
      <li><div><b>의료진을 알리고 싶은 병원</b><span>의료진의 진료 분야와 경력을 보여 주고 싶을 때</span></div></li>
      <li><div><b>여러 지점이 있는 병원</b><span>지점별 위치 · 진료 시간을 나눠 안내해야 할 때</span></div></li>
    </ol>
  </div>
</section>
<!--/ed:hospital/fit-->

<!-- 고객 이동 경로 -->
<!--ed:hospital/journey-->
<section class="sec cap dt-sec" id="journey" data-nav="dark">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 04</b>&nbsp; Customer Journey</span>
      <h2 class="d2">검색에서 문의까지,<br><em>막힘없는 흐름</em></h2>
      <p class="lead">방문자가 단계마다 찾는 정보를 미리 준비해, 중간에 떠나지 않고 문의까지 이어지게 합니다.</p>
    </div>
    <div class="dt-steps stg rv">
      <div class="dt-step"><i>01</i><h4>검색</h4><p>증상 · 지역으로 찾아옵니다</p></div>
      <div class="dt-step"><i>02</i><h4>확인</h4><p>진료 과목과 위치를 봅니다</p></div>
      <div class="dt-step"><i>03</i><h4>비교</h4><p>의료진과 진료 안내를 살펴봅니다</p></div>
      <div class="dt-step"><i>04</i><h4>신뢰</h4><p>병원 소개와 공지를 확인합니다</p></div>
      <div class="dt-step"><i>05</i><h4>예약</h4><p>예약 · 상담을 신청합니다</p></div>
    </div>
  </div>
</section>
<!--/ed:hospital/journey-->

<!-- 화면 구조 · 핵심 기능 -->
<!--ed:hospital/structure-->
<section class="sec sec--paper dt-sec" id="structure" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 05</b>&nbsp; Structure &amp; Features</span>
      <h2 class="d2">화면 구조와<br><em>핵심 기능</em></h2>
      <p class="lead">가지고 계신 자료를 그대로 옮기지 않고, 홈페이지에서 읽기 쉬운 구조로 다시 정리합니다.</p>
    </div>
    <div class="dt-struct rv">
      <div class="dt-tree">
        <span class="root">병원 홈페이지</span>
        <ul>
          <li>병원 소개<small>인사말 · 둘러보기</small></li>
          <li>의료진<small>의료진별 진료 분야</small></li>
          <li>진료 과목<small>과목별 진료 안내</small></li>
          <li>진료 안내<small>진료 시간 · 휴진일</small></li>
          <li>오시는 길<small>지도 · 주차 · 대중교통</small></li>
          <li>공지 · 건강 정보<small>공지 · 칼럼</small></li>
          <li>예약 · 상담<small>온라인 신청</small></li>
        </ul>
      </div>
      <ul class="dt-feat">
        <li><div><b>온라인 예약 · 상담</b><span>원하는 날짜와 진료 과목을 남기면 알림으로 받습니다.</span></div></li>
        <li><div><b>전화 · 카카오톡 연결</b><span>휴대폰에서 버튼 한 번으로 전화 · 상담 연결.</span></div></li>
        <li><div><b>진료 시간 직접 수정</b><span>휴진 · 진료 시간 변경을 관리자에서 바로 바꿉니다.</span></div></li>
        <li><div><b>의료광고 표현 점검</b><span>과장 · 비교 표현이 없는지 문구를 함께 살펴봅니다.</span></div></li>
        <li><div><b>휴대폰 우선 설계</b><span>대부분의 환자가 휴대폰으로 보는 것을 기준으로 만듭니다.</span></div></li>
      </ul>
    </div>
  </div>
</section>
<!--/ed:hospital/structure-->

<!-- 기본 포함 -->
<!--ed:hospital/included-->
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
<!--/ed:hospital/included-->

<!-- 비용 기준 -->
<!--ed:hospital/cost-->
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
<!--/ed:hospital/cost-->

<!-- 자주 묻는 질문 -->
<!--ed:hospital/faq-->
<section class="sec sec--paper2 dt-sec" id="faq" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 08</b>&nbsp; FAQ</span>
      <h2 class="d2">자주 묻는 질문</h2>
    </div>
    <div class="dt-faq rv">
      <details><summary>의료광고 규정에 맞게 만들어 주시나요?</summary><p>과장 · 비교 · 치료 효과 보장 같은 표현이 들어가지 않도록 문구를 함께 점검합니다. 심의가 필요한 내용은 미리 알려 드립니다.</p></details>
      <details><summary>예약 기능을 넣을 수 있나요?</summary><p>네. 날짜 · 진료 과목 · 연락처를 받는 예약 신청 양식을 넣고, 접수되면 알림을 보내 드립니다.</p></details>
      <details><summary>지점이 여러 곳이면 어떻게 하나요?</summary><p>지점별로 위치 · 진료 시간 · 의료진을 나눠 보여 주고, 지점 선택 후 예약하도록 구성합니다.</p></details>
      <details><summary>자료가 거의 없는데 시작할 수 있나요?</summary><p>네. 상담에서 들은 내용으로 메뉴 구성과 첫 문구를 먼저 제안해 드립니다. 사진이 없으면 촬영 방법이나 대체 이미지도 함께 정합니다.</p></details>
      <details><summary>오픈 후에 직접 고칠 수 있나요?</summary><p>네. 홈페이지 화면을 보면서 글자 · 사진 · 메뉴를 바로 고치는 관리자를 드립니다. 저장한 내용은 확인 후 게시하고, 이전 상태로 되돌릴 수도 있습니다.</p></details>
      <details><summary>비용은 어떻게 정해지나요?</summary><p>화면 수, 내용 준비 범위, 필요한 기능에 따라 정해집니다. 상담 후 범위를 정리해 견적을 안내해 드립니다.</p></details>
    </div>
  </div>
</section>
<!--/ed:hospital/faq-->
</main>

<!-- FOOTER -->
<?= view('site/partials/footer_ko') ?>

<script src="js/v2.js?v=20260902"></script>
</body>
</html>
