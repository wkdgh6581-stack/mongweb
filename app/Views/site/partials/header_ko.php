<?php
/**
 * 공통 머리글(상단 메뉴 + 모바일 메뉴) — 모든 국문 화면이 함께 쓴다.
 * {{...}} 자리는 화면마다 다른 값으로 바뀐다 (App\Libraries\PageEditor 참고).
 */
?>
<!--ed:@ko/head-->
<header class="head" id="head">
  <div class="head__in">
    <a class="brand" href="{{home_url}}" aria-label="MongWeb 홈">
      <img class="brand--dark" src="assets/logo-mongweb-dark.png" alt="MongWeb">
      <img class="brand--light" src="assets/logo-mongweb.png" alt="MongWeb">
    </a>
    <div class="gnbwrap">
      <nav aria-label="주 메뉴"><ul class="gnb">
        <li><a href="about.html">회사소개</a></li>
        <li><a href="business.html">홈페이지제작</a></li>
        <li><a href="price.html">비용안내</a></li>
        <li><a href="maintenance.html">유지보수</a></li>
        <li><a href="contact.html">고객문의</a></li>
      </ul></nav>
      <div class="mega"><div class="mega__in">
        <div class="mega__col"><h5>회사소개</h5><a href="about.html#ceo">CEO 인사말</a><a href="about.html#overview">회사개요</a><a href="about.html#org">조직도</a></div>
        <div class="mega__col"><h5>홈페이지제작</h5><a href="business.html#commissioning">시운전</a><a href="business.html#support">기술지원</a><a href="business.html#maintenance">유지보수</a></div>
        <div class="mega__col"><h5>비용안내</h5><a href="price.html#plans">요금 안내</a><a href="price.html#process">제작 절차</a><a href="price.html#faq">자주 묻는 질문</a></div>
        <div class="mega__col"><h5>유지보수</h5><a href="maintenance.html#service">유지보수 서비스</a><a href="maintenance.html#plans">관리 요금</a><a href="maintenance.html#request">요청 방법</a></div>
        <div class="mega__col"><h5>고객문의</h5><a href="contact.html#inquiry">문의하기</a><a href="contact.html#map">오시는 길</a></div>
      </div></div>
    </div>
    <div class="head__r">
      <div class="lang" role="group" aria-label="Language"><a class="lang__b is-on" href="#" aria-current="true">KR</a><a class="lang__b" href="{{alt_lang_url}}">EN</a></div>
      <a class="head__cta" href="contact.html">고객문의</a>
      <button class="burger" id="burger" aria-label="메뉴 열기" aria-expanded="false"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>
<!--/ed:@ko/head-->

<!--ed:@ko/drawer-->
<div class="drawer" id="drawer" aria-hidden="true">
  <div class="drawer__grp"><b><a href="about.html">회사소개</a></b><div class="sub"><a href="about.html#ceo">CEO 인사말</a><a href="about.html#overview">회사개요</a><a href="about.html#org">조직도</a></div></div>
  <div class="drawer__grp"><b><a href="business.html">홈페이지제작</a></b><div class="sub"><a href="business.html#commissioning">시운전</a><a href="business.html#support">기술지원</a><a href="business.html#maintenance">유지보수</a></div></div>
  <div class="drawer__grp"><b><a href="price.html">비용안내</a></b><div class="sub"><a href="price.html#plans">요금 안내</a><a href="price.html#process">제작 절차</a><a href="price.html#faq">자주 묻는 질문</a></div></div>
  <div class="drawer__grp"><b><a href="maintenance.html">유지보수</a></b><div class="sub"><a href="maintenance.html#service">유지보수 서비스</a><a href="maintenance.html#plans">관리 요금</a><a href="maintenance.html#request">요청 방법</a></div></div>
  <div class="drawer__grp"><b><a href="contact.html">고객문의</a></b><div class="sub"><a href="contact.html#inquiry">문의하기</a><a href="contact.html#map">오시는 길</a></div></div>
      <div class="lang lang--drawer" role="group" aria-label="Language"><a class="lang__b is-on" href="#" aria-current="true">KR</a><a class="lang__b" href="{{alt_lang_url}}">EN</a></div>
  <a class="btn btn--solid drawer__cta" href="contact.html"><span>고객문의</span>
    <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
</div>
<!--/ed:@ko/drawer-->
