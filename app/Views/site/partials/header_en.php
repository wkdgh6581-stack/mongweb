<?php
/**
 * 공통 머리글(상단 메뉴 + 모바일 메뉴) — 모든 영문 화면이 함께 쓴다.
 * {{...}} 자리는 화면마다 다른 값으로 바뀐다 (App\Libraries\PageEditor 참고).
 */
?>
<!--ed:@en/head-->
<header class="head" id="head">
  <div class="head__in">
    <a class="brand" href="{{home_url}}" aria-label="MongWeb Home">
      <img class="brand--dark" src="../assets/logo-mongweb-dark.png" alt="MongWeb">
      <img class="brand--light" src="../assets/logo-mongweb.png" alt="MongWeb">
    </a>
    <div class="gnbwrap">
      <nav aria-label="Main menu"><ul class="gnb">
        <li><a href="about.html">About Us</a></li>
        <li><a href="business.html">Business Areas</a></li>
        <li><a href="projects.html">Track Record</a></li>
        <li><a href="recruit.html">Careers</a></li>
        <li><a href="news.html">News & Media</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul></nav>
      <div class="mega"><div class="mega__in">
        <div class="mega__col"><h5>About Us</h5><a href="about.html#ceo">CEO Message</a><a href="about.html#overview">Company Overview</a><a href="about.html#org">Organization</a></div>
        <div class="mega__col"><h5>Business Areas</h5><a href="business.html#commissioning">Commissioning</a><a href="business.html#support">Technical Support</a><a href="business.html#maintenance">Maintenance</a></div>
        <div class="mega__col"><h5>Track Record</h5><a href="projects.html#domestic">Domestic Projects</a><a href="projects.html#overseas">Overseas Projects</a><a href="projects.html#clients">Our Clients</a></div>
        <div class="mega__col"><h5>Careers</h5><a href="recruit.html">Recruitment Guide</a><a href="recruit.html#jobs">Open Positions</a></div>
        <div class="mega__col"><h5>News & Media</h5><a href="news.html">Notice Board</a><a href="news.html#gallery">Gallery</a><a href="news.html#ci">CI</a></div>
        <div class="mega__col"><h5>Contact</h5><a href="contact.html#inquiry">Inquiry</a></div>
      </div></div>
    </div>
    <div class="head__r">
      <div class="lang" role="group" aria-label="Language"><a class="lang__b" href="{{alt_lang_url}}">KR</a><a class="lang__b is-on" href="#" aria-current="true">EN</a></div>
      <a class="head__cta" href="contact.html">Contact</a>
      <button class="burger" id="burger" aria-label="Open menu" aria-expanded="false"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>
<!--/ed:@en/head-->

<!--ed:@en/drawer-->
<div class="drawer" id="drawer" aria-hidden="true">
  <div class="drawer__grp"><b><a href="about.html">About Us</a></b><div class="sub"><a href="about.html#ceo">CEO Message</a><a href="about.html#overview">Company Overview</a><a href="about.html#org">Organization</a></div></div>
  <div class="drawer__grp"><b><a href="business.html">Business Areas</a></b><div class="sub"><a href="business.html#commissioning">Commissioning</a><a href="business.html#support">Technical Support</a><a href="business.html#maintenance">Maintenance</a></div></div>
  <div class="drawer__grp"><b><a href="projects.html">Track Record</a></b><div class="sub"><a href="projects.html#domestic">Domestic</a><a href="projects.html#overseas">Overseas</a><a href="projects.html#clients">Our Clients</a></div></div>
  <div class="drawer__grp"><b><a href="recruit.html">Careers</a></b><div class="sub"><a href="recruit.html">Recruitment Guide</a><a href="recruit.html#jobs">Open Positions</a></div></div>
  <div class="drawer__grp"><b><a href="news.html">News & Media</a></b><div class="sub"><a href="news.html">Notice Board</a><a href="news.html#gallery">Gallery</a><a href="news.html#ci">CI</a></div></div>
  <div class="drawer__grp"><b><a href="contact.html">Contact</a></b><div class="sub"><a href="contact.html#inquiry">Inquiry</a></div></div>
      <div class="lang lang--drawer" role="group" aria-label="Language"><a class="lang__b" href="{{alt_lang_url}}">KR</a><a class="lang__b is-on" href="#" aria-current="true">EN</a></div>
  <a class="btn btn--solid drawer__cta" href="contact.html"><span>Contact</span>
    <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
</div>
<!--/ed:@en/drawer-->
