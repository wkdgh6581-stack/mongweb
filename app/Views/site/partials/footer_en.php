<?php
/**
 * 공통 바닥글 — 모든 영문 화면이 함께 쓴다.
 */
?>
<!--ed:@en/foot-->
<footer class="foot" id="contact" data-nav="dark">
  <div class="foot__cta">
    <div class="wrap">
      <h2>At the final stage of your project,<br><em>K1 stands with you</em></h2>
      <a class="btn btn--solid" href="{{foot_cta_url}}"><span>{{foot_cta_label}}</span>
        <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </div>
  </div>
  <div class="wrap foot__top">
    <div class="foot__brand">
      <div class="foot__logo">
        <img src="../assets/logo-mongweb-dark.png" alt="MongWeb">
      </div>
      <p>A turnkey specialist delivering the entire commissioning process for the shipbuilding, offshore and energy industries under a single line of responsibility.</p>
    </div>
    <div class="foot__map">
      <div class="foot__col"><h4>About Us</h4><a href="about.html#ceo">CEO Message</a><a href="about.html#overview">Company Overview</a><a href="about.html#org">Organization</a></div>
      <div class="foot__col"><h4>Business Areas</h4><a href="business.html#commissioning">Commissioning</a><a href="business.html#support">Technical Support</a><a href="business.html#maintenance">Maintenance</a></div>
      <div class="foot__col"><h4>Track Record</h4><a href="projects.html#domestic">Domestic Projects</a><a href="projects.html#overseas">Overseas Projects</a><a href="projects.html#clients">Our Clients</a></div>
      <div class="foot__col"><h4>Careers</h4><a href="recruit.html">Recruitment Guide</a><a href="recruit.html#jobs">Open Positions</a></div>
      <div class="foot__col"><h4>News & Media</h4><a href="news.html">Notice Board</a><a href="news.html#gallery">Gallery</a><a href="news.html#ci">CI</a></div>
      <div class="foot__col"><h4>Contact</h4><a href="contact.html#inquiry">Inquiry</a><a href="contact.html#map">Location</a></div>
    </div>
  </div>
  <div class="wrap foot__info">
    <span><b>K1</b> 59 Okpodaecheop-ro, 2F, Geoje-si, Gyeongsangnam-do · 400 Bangeojin Sunhwan-doro, Dong-gu, Ulsan</span>
    <span><b>K1 OCEAN</b> 93 Daebul-ro, Samho-eup, Yeongam-gun, Jeollanam-do</span>
    <span><b>TEL</b> <?= esc($site['tel']) ?> · <b>FAX</b> <?= esc($site['fax']) ?></span>
    <span><b>E-mail</b> <?= esc($site['email']) ?></span>
  </div>
  <div class="wrap foot__bot"><a class="foot__pp" href="privacy.html">Privacy Policy</a><span>© 2026 K1 Co., Ltd. · K1 OCEAN — All rights reserved.</span></div>
</footer>
<!--/ed:@en/foot-->
