<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact · K1 Co., Ltd. K1 OCEAN</title>
<meta name="description" content="Contact K1 — project enquiries, contact details and directions to our head office and branches.">
<link rel="canonical" href="https://k1tnc.co.kr/en/contact.html">
<link rel="alternate" hreflang="ko" href="https://k1tnc.co.kr/contact.html">
<link rel="alternate" hreflang="en" href="https://k1tnc.co.kr/en/contact.html">
<link rel="alternate" hreflang="x-default" href="https://k1tnc.co.kr/contact.html">
<meta property="og:type" content="website">
<meta property="og:site_name" content="K1 Co., Ltd. · K1 OCEAN">
<meta property="og:locale" content="en_US">
<meta property="og:title" content="Contact · K1 Co., Ltd. K1 OCEAN">
<meta property="og:description" content="Contact K1 — project enquiries, contact details and directions to our head office and branches.">
<meta property="og:url" content="https://k1tnc.co.kr/en/contact.html">
<meta property="og:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Contact · K1 Co., Ltd. K1 OCEAN">
<meta name="twitter:description" content="Contact K1 — project enquiries, contact details and directions to our head office and branches.">
<meta name="twitter:image" content="https://k1tnc.co.kr/assets/og-image.jpg">
<link rel="icon" type="image/png" href="../assets/favicon.png">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="../css/v2.css?v=20261107h">
</head>
<body class="sub">
<a class="skip" href="#main">Skip to content</a>

<!-- HEADER -->
<?php \App\Libraries\PageEditor::tokens(['home_url' => 'index.html', 'alt_lang_url' => '../contact.html', 'foot_cta_url' => 'mailto:{{site.email}}', 'foot_cta_label' => 'Email us']) ?>
<?= view('site/partials/header_en') ?>

<!-- SUB HERO -->
<!--ed:en/contact/subhero-->
<section class="subhero" data-nav="dark">
  <div class="wrap">
    <div class="bc"><a href="index.html">Home</a> <b>›</b> Contact</div>
    <h1>Contact</h1>
    <div class="en">Contact Us</div>
  </div>
</section>
<!--/ed:en/contact/subhero-->

<!--ed:en/contact/pagenav-->
<nav class="pagenav" aria-label="Contact sections">
  <div class="pagenav__in">
    <a href="#inquiry" class="on">Inquiry</a>
    <a href="#map">Location</a>
  </div>
</nav>
<!--/ed:en/contact/pagenav-->

<main id="main">

<!-- INQUIRY -->
<!--ed:en/contact/inquiry-->
<section class="sec sec--paper" id="inquiry" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 01</b>&nbsp; Inquiry</span>
      <h2 class="d2">Inquiry</h2>
      <p class="lead">For project enquiries, partnership proposals, quotations or anything else, contact us through the channels below and our team will respond promptly.</p>
    </div>

    <div class="cwrap rv">
      <div class="cinfo">
        <div class="cinfo__i"><i class="ic i-phone" aria-hidden="true"></i><div class="k">Telephone</div><a class="v" href="tel:<?= esc($site['tel']) ?>"><?= esc($site['tel']) ?></a></div>
        <div class="cinfo__i"><i class="ic i-fax" aria-hidden="true"></i><div class="k">Fax</div><div class="v"><?= esc($site['fax']) ?></div></div>
        <div class="cinfo__i"><i class="ic i-mail" aria-hidden="true"></i><div class="k">Email</div><a class="v" href="mailto:<?= esc($site['email']) ?>"><?= esc($site['email']) ?></a></div>
        <div class="cinfo__i"><i class="ic i-location" aria-hidden="true"></i><div class="k">Head office</div><div class="v">59 Okpodaecheop-ro, 2F, Geoje-si, Gyeongsangnam-do, Korea</div></div>
        <div class="cinfo__note">Office hours · Weekdays 09:00 – 18:00 (closed weekends and public holidays)</div>
      </div>

      <form class="cform" id="contactForm" action="<?= base_url('api/contact') ?>" method="post" novalidate aria-label="Enquiry form">
        <?= csrf_field() ?>
        <div class="cform__row">
          <label class="cf">Purpose of enquiry <span>*</span>
            <select name="purpose" required>
              <option value="" selected disabled>Please select</option>
              <option>Turnkey</option>
              <option>Technical Service</option>
              <option>Project Manpower</option>
              <option>Partnership</option>
              <option>Recruitment</option>
              <option>etc</option>
            </select></label>
          <label class="cf">Company / Organisation
            <select name="company">
              <option value="" selected disabled>Please select</option>
              <option>K1</option>
              <option>K1 OCEAN</option>
            </select></label>
        </div>
        <div class="cform__row">
          <label class="cf">Name <span>*</span><input type="text" name="name" required></label>
          <label class="cf">Phone<input type="tel" name="phone"></label>
        </div>
        <label class="cf">Email <span>*</span><input type="email" name="email" required></label>
        <label class="cf">Message <span>*</span><textarea name="message" rows="6" required placeholder="Please write your enquiry here."></textarea></label>
        <label class="cf-agree">
          <input type="checkbox" name="privacy_agree" required>
          <span>I agree to the collection and use of my personal data. <a href="privacy.html" target="_blank" rel="noopener">Privacy Policy</a> <b>*</b></span>
        </label>
        <div class="cf-trap" aria-hidden="true">
          <label>Leave this field empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
        </div>
        <p class="cform__msg" id="contactMsg" role="status" hidden></p>
        <button type="submit" class="btn btn--solid"><span>Send enquiry</span>
          <svg viewBox="0 0 40 12" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path d="M0 6h37M32 1l6 5-6 5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
        <p class="cform__hint">Your message goes straight to our team, and we will reply to you by email.</p>
      </form>
    </div>
  </div>
</section>
<!--/ed:en/contact/inquiry-->

<!-- MAP / LOCATIONS -->
<!--ed:en/contact/map-->
<section class="sec sec--paper2" id="map" data-nav="light">
  <div class="wrap">
    <div class="sec-head rv">
      <span class="eyebrow"><b>／ 02</b>&nbsp; Location</span>
      <h2 class="d2">Location</h2>
      <p class="lead">We serve our clients close to the field from our Geoje head office and our Yeongam and Ulsan branches.</p>
    </div>
    <div class="loc rv">
      <div class="loc__i">
        <div class="loc__map">
          <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=128.6900418%2C34.8918086%2C128.6980418%2C34.8968086&layer=mapnik&marker=34.8943086%2C128.6940418"
            title="Map of the Geoje head office — 59 Okpodaecheop-ro, Geoje-si" loading="lazy"></iframe>
        </div>
        <div class="loc__b"><div class="tag">K1 · HQ</div><h3>Geoje Head Office</h3><p>59 Okpodaecheop-ro, 2F, Geoje-si, Gyeongsangnam-do, Korea</p><div class="loc__c"><span>TEL <?= esc($site['tel']) ?></span><span>FAX <?= esc($site['fax']) ?></span></div></div>
      </div>
      <div class="loc__i">
        <div class="loc__map">
          <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=126.3805798%2C34.7506621%2C126.4005798%2C34.7631621&layer=mapnik&marker=34.7569121%2C126.3905798"
            title="Map of the Yeongam branch — 93 Daebul-ro, Samho-eup, Yeongam-gun" loading="lazy"></iframe>
        </div>
        <div class="loc__b"><div class="tag">K1 OCEAN · Branch</div><h3>Yeongam Branch</h3><p>93 Daebul-ro, Samho-eup, Yeongam-gun, Jeollanam-do</p><div class="loc__c"><span>TEL <?= esc($site['yeongam_tel']) ?></span><span>FAX <?= esc($site['yeongam_fax']) ?></span></div></div>
      </div>
      <div class="loc__i">
        <div class="loc__map">
          <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=129.4031875%2C35.4767992%2C129.4111875%2C35.4817992&layer=mapnik&marker=35.4792992%2C129.4071875"
            title="Map of the Ulsan branch — 400 Bangeojin Sunhwan-doro, Dong-gu, Ulsan" loading="lazy"></iframe>
        </div>
        <div class="loc__b"><div class="tag">K1 · Branch</div><h3>Ulsan Branch</h3><p>400 Bangeojin Sunhwan-doro, Dong-gu, Ulsan, Korea</p><?php if ($site['ulsan_tel'] || $site['ulsan_fax']): ?><div class="loc__c"><?php if ($site['ulsan_tel']): ?><span>TEL <?= esc($site['ulsan_tel']) ?></span><?php endif ?><?php if ($site['ulsan_fax']): ?><span>FAX <?= esc($site['ulsan_fax']) ?></span><?php endif ?></div><?php endif ?></div>
      </div>
    </div>
    <p class="loc__attr">Map data © <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a> contributors</p>
  </div>
</section>
<!--/ed:en/contact/map-->

</main>

<!-- FOOTER -->
<?= view('site/partials/footer_en') ?>

<script src="../js/v2.js?v=20260902"></script>
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
