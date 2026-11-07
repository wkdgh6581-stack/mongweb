<?= $this->extend('admin/layout') ?>

<?= $this->section('actions') ?>
  <a class="btn btn--primary" href="<?= base_url('admin/editor') ?>">홈페이지 편집기 열기</a>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form class="form" method="post" action="<?= base_url('admin/editor/replace') ?>" style="max-width:720px">
  <?= csrf_field() ?>
  <div style="display:grid;grid-template-columns:1fr 1fr;gap:var(--s4)">
    <div class="field">
      <label for="find">찾을 글자 <span class="req">*</span></label>
      <input class="inp" id="find" name="find" value="<?= esc($find) ?>" placeholder="예: 케이원" required>
    </div>
    <div class="field">
      <label for="repl">바꿀 글자</label>
      <input class="inp" id="repl" name="repl" value="<?= esc($repl) ?>" placeholder="예: 새 상호">
    </div>
  </div>
  <div class="field">
    <span class="field__label">범위</span>
    <label style="margin-right:16px"><input type="radio" name="scope" value="all" <?= $scope === 'all' ? 'checked' : '' ?>> 국문 + 영문</label>
    <label style="margin-right:16px"><input type="radio" name="scope" value="ko" <?= $scope === 'ko' ? 'checked' : '' ?>> 국문만</label>
    <label><input type="radio" name="scope" value="en" <?= $scope === 'en' ? 'checked' : '' ?>> 영문만</label>
    <p class="help">화면에 보이는 글자와 사진 설명(alt)만 바꿉니다. 링크 주소·파일 이름은 건드리지 않습니다.
      대소문자와 띄어쓰기까지 똑같아야 찾습니다.</p>
  </div>
  <div class="form__act">
    <button type="submit" class="btn btn--ghost" name="apply" value="0">어디가 바뀌는지 먼저 보기</button>
    <?php if ($result): ?>
      <button type="submit" class="btn btn--primary" name="apply" value="1">이대로 <?= esc($total) ?>곳 바꾸기</button>
    <?php endif ?>
  </div>
</form>

<?php if ($result !== null): ?>
  <section class="panel" style="max-width:720px;margin-top:var(--s5)">
    <div class="panel__head">
      <h2>'<?= esc($find) ?>' 찾은 결과</h2>
      <span class="cnt"><?= esc((string) ($total ?? 0)) ?>곳</span>
    </div>
    <?php if ($result): ?>
      <div class="tbl-wrap"><table class="tbl">
        <thead><tr><th>영역</th><th style="width:90px;text-align:right">개수</th></tr></thead>
        <tbody>
        <?php foreach ($result as $r): ?>
          <tr><td><?= esc($r['label']) ?></td><td style="text-align:right"><?= esc((string) $r['count']) ?></td></tr>
        <?php endforeach ?>
        </tbody>
      </table></div>
    <?php else: ?>
      <div class="empty"><b>찾은 곳이 없습니다</b><p>글자를 다시 확인해 주세요. (회사 연락처·주소는 '회사 정보' 메뉴에서 바꿉니다)</p></div>
    <?php endif ?>
  </section>
<?php endif ?>

<section class="panel" style="max-width:720px;margin-top:var(--s6)">
  <div class="panel__head"><h2>편집 내용 옮기기</h2></div>
  <div style="padding:var(--s4) var(--s5) var(--s5);font-size:14px;color:var(--ink-2)">
    <p style="margin:0 0 var(--s4)">로컬(내 PC)에서 고친 홈페이지 내용을 카페24 서버로 옮길 때 씁니다.
      내보낸 파일에는 고친 글자·사진이 모두 들어 있습니다. 가져온 내용은 임시 저장되며, 편집기에서 확인 후 게시합니다.</p>
    <div style="display:flex;gap:var(--s3);flex-wrap:wrap;align-items:center">
      <a class="btn btn--ghost" href="<?= base_url('admin/editor/export') ?>">내보내기 (.json 받기)</a>
      <form method="post" action="<?= base_url('admin/editor/import') ?>" enctype="multipart/form-data" style="display:flex;gap:var(--s2);align-items:center">
        <?= csrf_field() ?>
        <input type="file" name="package" accept=".json,application/json" required>
        <button type="submit" class="btn btn--ghost">가져오기</button>
      </form>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
