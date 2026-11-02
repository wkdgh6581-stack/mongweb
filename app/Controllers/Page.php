<?php

namespace App\Controllers;

use App\Libraries\PageEditor;
use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * 내용이 고정된 페이지(메인·회사소개·사업분야·프로젝트 실적·고객문의·처리방침).
 *
 * 글·사진처럼 자주 바뀌는 내용은 없지만, 연락처만은 관리자에서 고칠 수 있어야 한다.
 * 그래서 정적 HTML 대신 화면(뷰)으로 두고 회사 정보를 넣어 준다.
 */
class Page extends BaseController
{
    /** 열어 줄 페이지 — 여기 없는 이름은 404 로 보낸다 */
    private const ALLOWED = [
        'index', 'about', 'business', 'price', 'maintenance', 'corporate', 'hospital', 'franchise', 'shop', 'lawyer', 'tax', 'projects', 'contact', 'privacy',
    ];

    public function show(string $name = 'index')
    {
        if (! in_array($name, self::ALLOWED, true)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->output(PageEditor::render('site/pages/' . $name, [], $name));
    }

    /**
     * 영문 페이지. 게시판·갤러리·채용공고는 영문으로 만들지 않기로 해
     * 영문 쪽은 전부 고정 화면이다.
     */
    public function english(string $name = 'index')
    {
        $allowed = array_diff(array_merge(self::ALLOWED, ['news', 'recruit']), ['price', 'maintenance', 'corporate', 'hospital', 'franchise', 'shop', 'lawyer', 'tax']);

        if (! in_array($name, $allowed, true)) {
            throw PageNotFoundException::forPageNotFound();
        }

        return $this->output(PageEditor::render('site/pages/en/' . $name, [], 'en/' . $name));
    }

    /**
     * 없는 주소로 들어왔을 때.
     */
    public function notFound()
    {
        // 어느 깊이의 주소에서 열려도 경로가 맞도록 deep 으로 그린다
        return $this->response->setStatusCode(404)->setBody(PageEditor::render('site/pages/404', [], '', true));
    }

    /** 편집기·미리보기 화면은 브라우저가 저장해 두지 않게 한다 */
    private function output(string $html)
    {
        if (PageEditor::mode() !== 'public') {
            $this->response->setHeader('Cache-Control', 'no-store');
        }

        return $this->response->setBody($html);
    }
}
