<?php
/**
 * 홈페이지 화면 편집기 (전체 화면).
 * 가운데에 실제 홈페이지를 띄우고(iframe, ?edit=1), 위쪽 막대에서 저장·게시한다.
 * 화면 안에서의 편집은 public/js/editor.js, 이 막대의 동작은 public/js/editor-shell.js.
 */
$ver = '?v=' . (@filemtime(FCPATH . 'js/editor-shell.js') ?: '1');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>홈페이지 편집 · 관리자</title>
<link rel="icon" href="<?= base_url('images/favicon.png') ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<link rel="stylesheet" href="<?= base_url('css/editor-shell.css') . $ver ?>">
</head>
<body>

<header class="sb" role="toolbar" aria-label="편집 도구">
  <a class="sb__back" href="<?= base_url('admin/dashboard') ?>" title="관리자 홈으로">
    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 6l-6 6 6 6"/></svg>
    <img src="<?= base_url('images/mark-k1.png') ?>" alt="">
    <span>관리자</span>
  </a>

  <label class="sb__page">
    <span class="sr">편집할 화면</span>
    <select id="pageSel">
      <?php $grp = null; foreach ($pages as $key => [$label, $url]):
        $g = str_starts_with($key, 'en/') ? 'English' : '국문';
        if ($g !== $grp): if ($grp !== null): ?></optgroup><?php endif; $grp = $g; ?><optgroup label="<?= esc($g) ?>"><?php endif ?>
        <option value="<?= esc($key) ?>" data-url="<?= esc(base_url($url)) ?>" <?= $key === $page ? 'selected' : '' ?>><?= esc($label) ?></option>
      <?php endforeach ?></optgroup>
    </select>
  </label>

  <div class="sb__seg" role="group" aria-label="화면 크기">
    <button type="button" data-dev="pc" class="on" title="PC">
      <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="12" rx="1.5"/><path d="M8 20h8M12 16v4"/></svg><span>PC</span></button>
    <button type="button" data-dev="tab" title="태블릿">
      <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="5" y="3" width="14" height="18" rx="2"/><path d="M11 18h2"/></svg><span>태블릿</span></button>
    <button type="button" data-dev="mo" title="휴대폰">
      <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="7" y="3" width="10" height="18" rx="2"/><path d="M11 18h2"/></svg><span>휴대폰</span></button>
  </div>

  <div class="sb__tools">
    <button type="button" class="sb__tg" data-tg="mega" aria-pressed="false">전체 메뉴 펼치기</button>
    <button type="button" class="sb__tg" data-tg="drawer" aria-pressed="false">모바일 메뉴 열기</button>
    <button type="button" class="sb__tg" data-tg="outline" aria-pressed="false">영역 테두리</button>
  </div>

  <div class="sb__right">
    <span class="sb__st" id="status" aria-live="polite">불러오는 중…</span>
    <button type="button" class="sb__btn" id="btnInfo">화면 정보</button>
    <button type="button" class="sb__btn" id="btnPreview" title="임시 저장한 내용으로 새 창에서 보기">미리보기</button>
    <button type="button" class="sb__btn sb__btn--save" id="btnSave" disabled>저장</button>
    <button type="button" class="sb__btn sb__btn--pub" id="btnPub">홈페이지에 게시<b id="draftBadge"<?= $draft_count ? '' : ' hidden' ?>><?= esc((string) $draft_count) ?></b></button>
  </div>
</header>

<main class="stage" id="stage">
  <div class="frame" id="frameWrap" data-dev="pc">
    <iframe id="frame" title="편집 중인 홈페이지" src="<?= esc(base_url(\App\Libraries\PageEditor::PAGES[$page][1]) . '?edit=1') ?>"></iframe>
  </div>
</main>

<!-- 오른쪽 패널 -->
<aside class="panel" id="panel" hidden aria-label="편집 패널">
  <div class="panel__head">
    <div class="panel__tabs" role="tablist">
      <button type="button" role="tab" data-tab="info" aria-selected="true">화면 정보</button>
      <button type="button" role="tab" data-tab="pub" aria-selected="false">게시 · 이력</button>
      <button type="button" role="tab" data-tab="help" aria-selected="false">사용법</button>
    </div>
    <button type="button" class="panel__x" id="panelClose" aria-label="닫기">×</button>
  </div>

  <section class="panel__body" data-pane="info">
    <p class="hint">검색 결과(네이버·구글)와 브라우저 탭에 보이는 문구입니다. 저장 버튼을 누르면 함께 저장됩니다.</p>
    <label class="fld"><span>화면 제목</span><input id="metaTitle" maxlength="120"></label>
    <label class="fld"><span>화면 설명</span><textarea id="metaDesc" rows="4" maxlength="300"></textarea></label>
    <button type="button" class="lnk" id="metaReset">원래 문구로 되돌리기</button>
    <hr>
    <p class="hint">이 화면 전체를 처음 만든 모습으로 되돌립니다. (임시 저장되며 게시 전에는 홈페이지에 나가지 않습니다)</p>
    <button type="button" class="pbtn pbtn--danger" id="pageReset">이 화면 전체 원래대로</button>
    <hr>
    <p class="hint">상호·메뉴 이름처럼 여러 화면에 나오는 글자는 한 번에 바꿀 수 있습니다.</p>
    <a class="pbtn" href="<?= base_url('admin/editor/replace') ?>">문구 일괄 바꾸기 →</a>
    <p class="hint">전화번호·이메일·주소는 <a href="<?= base_url('admin/setting') ?>">회사 정보</a>에서 바꾸면 모든 화면에 반영됩니다.</p>
  </section>

  <section class="panel__body" data-pane="pub" hidden>
    <h3>게시 대기 중</h3>
    <p class="hint">저장한 내용은 아직 방문자에게 보이지 않습니다. '홈페이지에 게시'를 눌러야 반영됩니다.</p>
    <ul class="list" id="draftList"><li class="empty">없음</li></ul>
    <div class="row">
      <button type="button" class="pbtn pbtn--pri" id="pubNow">지금 게시하기</button>
      <button type="button" class="pbtn pbtn--danger" id="discard">임시 저장 모두 버리기</button>
    </div>
    <h3>게시 이력</h3>
    <p class="hint">예전 상태를 불러오면 임시 저장으로 들어옵니다. 확인한 뒤 게시하세요.</p>
    <ul class="list" id="histList"><li class="empty">없음</li></ul>
  </section>

  <section class="panel__body" data-pane="help" hidden>
    <ol class="help">
      <li><b>글자</b> — 고치고 싶은 글자를 클릭하면 바로 입력할 수 있습니다. 줄바꿈은 Enter.</li>
      <li><b>사진</b> — 사진을 클릭하고 위에 뜬 막대에서 ‘사진 바꾸기’.</li>
      <li><b>링크·메뉴</b> — 메뉴 글자를 클릭하면 막대에 링크 주소 칸이 나옵니다. 위의 ‘전체 메뉴 펼치기’로 하위 메뉴도 고칠 수 있습니다.</li>
      <li><b>항목 추가·삭제</b> — 카드·목록·메뉴처럼 반복되는 것은 ‘복제 / 삭제 / 앞으로 / 뒤로’가 나옵니다. 큰 묶음(카드 전체)은 ‘바깥 묶음 선택’으로 고르세요.</li>
      <li><b>영역 숨기기</b> — 영역 위에 마우스를 올리면 왼쪽 위에 ‘영역 숨기기 / 원래대로’가 나옵니다.</li>
      <li><b>파란 밑줄 글자</b> — 회사 정보(전화·주소 등)에서 자동으로 들어오는 값입니다. 회사 정보 메뉴에서 바꾸세요.</li>
      <li><b>저장 → 게시</b> — ‘저장’(Ctrl+S)은 임시 저장입니다. ‘홈페이지에 게시’를 눌러야 방문자에게 보입니다.</li>
      <li><b>상단 메뉴·바닥글</b>은 모든 화면이 함께 씁니다. 한 화면에서 고치면 전 화면에 반영됩니다.</li>
    </ol>
  </section>
</aside>

<div class="toast" id="toast" role="status" aria-live="polite" hidden></div>

<script>
window.SHELL = {
  page: <?= json_encode($page) ?>,
  csrfHeader: <?= json_encode(config('Security')->headerName) ?>,
  csrfHash: <?= json_encode(csrf_hash()) ?>,
  drafts: <?= (int) $draft_count ?>,
  urls: {
    editor:  <?= json_encode(base_url('admin/editor')) ?>,
    publish: <?= json_encode(base_url('admin/editor/publish')) ?>,
    discard: <?= json_encode(base_url('admin/editor/discard')) ?>,
    status:  <?= json_encode(base_url('admin/editor/status')) ?>,
    restore: <?= json_encode(base_url('admin/editor/restore')) ?>,
    reset:   <?= json_encode(base_url('admin/editor/reset')) ?>
  }
};
</script>
<script src="<?= base_url('js/editor-shell.js') . $ver ?>"></script>
</body>
</html>
