<?php
/**
 * 공통 바닥글 — 모든 국문 화면이 함께 쓴다.
 */
?>
<!--ed:@ko/foot-->
<footer class="foot" id="contact" data-nav="dark">
  <div class="foot__cta">
    <div class="wrap">
      <h2>꿈을 웹으로,<br><em>몽웹이 함께하겠습니다</em></h2>
      <a class="btn btn--solid" href="{{foot_cta_url}}"><span>{{foot_cta_label}}</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </div>
  </div>
  <div class="wrap foot__top">
    <div class="foot__brand">
      <div class="foot__logo">
        <img src="assets/logo-mongweb-dark.png" alt="MongWeb">
      </div>
      <p>기획부터 디자인 · 개발 · 검색 대응 · 오픈 후 관리까지, 꿈을 웹으로 잇는 홈페이지 제작 파트너.</p>
    </div>
    <div class="foot__map">
      <div class="foot__col"><h4>회사소개</h4><a href="about.html">몽웹 소개</a></div>
      <div class="foot__col"><h4>홈페이지제작</h4><a href="business.html#corporate">기업 홈페이지</a><a href="business.html#hospital">병원 홈페이지</a><a href="business.html#franchise">프랜차이즈 홈페이지</a><a href="business.html#shop">쇼핑몰 홈페이지</a><a href="business.html#lawyer">변호사 홈페이지</a><a href="business.html#tax">세무 · 법무 · 노무 · 회계 홈페이지</a></div>
      <div class="foot__col"><h4>비용안내</h4><a href="price.html#plans">요금 안내</a><a href="price.html#process">제작 절차</a><a href="price.html#faq">자주 묻는 질문</a></div>
      <div class="foot__col"><h4>유지보수</h4><a href="maintenance.html#service">유지보수 서비스</a><a href="maintenance.html#plans">관리 요금</a><a href="maintenance.html#request">요청 방법</a></div>
      <div class="foot__col"><h4>고객문의</h4><a href="contact.html#inquiry">문의하기</a><a href="contact.html#map">오시는 길</a></div>
    </div>
  </div>
  <div class="wrap foot__info">
    <span><b>몽웹 MongWeb</b> <?= esc($site['hq_addr']) ?></span>
    <span><b>TEL</b> <?= esc($site['tel']) ?><?php if ($site['fax']): ?> · <b>FAX</b> <?= esc($site['fax']) ?><?php endif ?></span>
    <span><b>E-mail</b> <?= esc($site['email']) ?></span>
  </div>
  <div class="wrap foot__bot"><a class="foot__pp" href="privacy.html">개인정보 처리방침</a><span>© 2026 몽웹 MongWeb — All rights reserved.</span></div>
</footer>
<!--/ed:@ko/foot-->
