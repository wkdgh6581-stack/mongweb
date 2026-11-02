<?php
/**
 * 공통 바닥글 — 모든 국문 화면이 함께 쓴다.
 */
?>
<!--ed:@ko/foot-->
<footer class="foot" id="contact" data-nav="dark">
  <div class="foot__cta">
    <div class="wrap">
      <h2>프로젝트의 마지막 순간,<br><em>케이원이 함께하겠습니다</em></h2>
      <a class="btn btn--solid" href="{{foot_cta_url}}"><span>{{foot_cta_label}}</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </div>
  </div>
  <div class="wrap foot__top">
    <div class="foot__brand">
      <div class="foot__logo">
        <img src="assets/logo-mongweb-dark.png" alt="MongWeb">
      </div>
      <p>조선 · 해양 · 에너지 산업의 Commissioning 전 과정을 하나의 책임체계로 수행하는 Turnkey 전문기업.</p>
    </div>
    <div class="foot__map">
      <div class="foot__col"><h4>회사소개</h4><a href="about.html#ceo">CEO 인사말</a><a href="about.html#overview">회사개요</a><a href="about.html#org">조직도</a></div>
      <div class="foot__col"><h4>홈페이지제작</h4><a href="business.html#commissioning">시운전</a><a href="business.html#support">기술지원</a><a href="business.html#maintenance">유지보수</a></div>
      <div class="foot__col"><h4>비용안내</h4><a href="price.html#plans">요금 안내</a><a href="price.html#process">제작 절차</a><a href="price.html#faq">자주 묻는 질문</a></div>
      <div class="foot__col"><h4>유지보수</h4><a href="maintenance.html#service">유지보수 서비스</a><a href="maintenance.html#plans">관리 요금</a><a href="maintenance.html#request">요청 방법</a></div>
      <div class="foot__col"><h4>고객문의</h4><a href="contact.html#inquiry">문의하기</a><a href="contact.html#map">오시는 길</a></div>
    </div>
  </div>
  <div class="wrap foot__info">
    <span><b>K1</b> <?= esc($site['hq_addr']) ?> · <?= esc($site['ulsan_addr']) ?></span>
    <span><b>K1 OCEAN</b> <?= esc($site['yeongam_addr']) ?></span>
    <span><b>TEL</b> <?= esc($site['tel']) ?> · <b>FAX</b> <?= esc($site['fax']) ?></span>
    <span><b>E-mail</b> <?= esc($site['email']) ?></span>
  </div>
  <div class="wrap foot__bot"><a class="foot__pp" href="privacy.html">개인정보 처리방침</a><span>© 2026 (주)케이원 (K1 Co., Ltd.) · K1 OCEAN — All rights reserved.</span></div>
</footer>
<!--/ed:@ko/foot-->
