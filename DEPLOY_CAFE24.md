# 카페24 배포 안내

이 홈페이지는 **PHP 8.2 이상 + MySQL(MariaDB)** 이면 돌아갑니다. 카페24 웹호스팅(PHP 8.x 지원 상품)에 그대로 올릴 수 있습니다.

작업 흐름은 이렇습니다.

```
① 관리자 > 홈페이지 편집 에서 화면을 보며 고친다 (임시 저장)
② '홈페이지에 게시' — 방문자 화면에 반영
③ (로컬에서 고쳤다면) 문구 일괄 바꾸기 화면 아래 '내보내기' → 카페24 관리자에서 '가져오기' → 게시
```

카페24 서버에 올린 뒤에는 **카페24 관리자 화면에서 바로 고치면** 되므로 ③은 처음 한 번(또는 로컬에서 미리 작업했을 때)만 필요합니다.

---

## 0. 준비물

| 항목 | 확인할 것 |
| --- | --- |
| 호스팅 | 카페24 웹호스팅, **PHP 8.2 이상** 선택 (호스팅 관리 > PHP 버전 변경) |
| PHP 확장 | intl · mbstring · mysqli · gd (카페24 기본 제공) |
| DB | 호스팅 관리 > DB 정보에서 DB 이름·아이디·비밀번호 확인 (호스트는 `localhost`) |
| 내 PC | PHP 8.2+, Composer, FTP 프로그램(FileZilla 등) |

## 1. 내 PC 에서 올릴 파일 만들기

```bash
composer install --no-dev --optimize-autoloader   # vendor/ 폴더가 생긴다 (카페24에는 composer가 없을 수 있음)
cp env .env                                        # 아래 2번 내용으로 고친다
```

## 2. `.env` (서버용)

```ini
CI_ENVIRONMENT = production

app.baseURL = 'https://도메인/'
app.forceGlobalSecureRequests = true

database.default.hostname = localhost
database.default.database = 카페24DB이름
database.default.username = 카페24DB아이디
database.default.password = 카페24DB비밀번호
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.charset  = utf8mb4
database.default.DBCollat = utf8mb4_general_ci

# 최초 관리자 비밀번호 (계정 생성 후 지우고, 관리자 화면에서 다시 바꿀 것)
admin.initialPassword = '임시비밀번호'

# 문의 메일 발송 (카페24 메일 또는 회사 메일 SMTP)
email.protocol   = smtp
email.SMTPHost   = smtp.도메인
email.SMTPUser   = 보내는주소@도메인
email.SMTPPass   = 메일비밀번호
email.SMTPPort   = 587
email.SMTPCrypto = tls
```

## 3. 올리기 — 둘 중 하나

### 방법 A (권장) — 프로그램은 www 밖에, 공개 파일만 www 안에

카페24 FTP 에 접속하면 맨 위(홈 폴더)에 `www` 가 보입니다. `www` 밖의 파일은 주소로 열 수 없어서 더 안전합니다.

```
/ (홈)
├── k1/            ← 프로젝트 전체 (app, vendor, writable, .env …)  ※ public 폴더는 빼도 됨
└── www/           ← 프로젝트의 public/ 폴더 '안의 내용'을 그대로
    ├── index.php
    ├── .htaccess
    ├── assets/ css/ js/ images/ uploads/
```

`www/index.php` 한 줄을 고칩니다.

```php
// 원래
require FCPATH . '../app/Config/Paths.php';
// 바꾼 뒤
require FCPATH . '../k1/app/Config/Paths.php';
```

### 방법 B — 전부 www 안에

프로젝트 폴더 전체를 `www/` 에 올립니다. 맨 위에 있는 `.htaccess` 가 모든 요청을 `public/` 으로 넘기므로
`app/` `.env` 등은 주소로 열리지 않습니다. 방법 A 가 안 될 때만 쓰세요.

## 4. 쓰기 권한

FTP 프로그램에서 아래 폴더 권한을 **707** (카페24 권장값, 안 되면 775) 로 바꿉니다.

- `writable/` 과 그 안의 모든 폴더
- `public/uploads/` (방법 A 라면 `www/uploads/`) — 게시판·갤러리·**편집기 사진**이 여기에 저장됩니다

## 5. DB 표 만들기

카페24에 SSH 가 있다면:

```bash
cd ~/k1            # 방법 B 라면 cd ~/www
php spark migrate
php spark db:seed SettingSeeder
php spark db:seed AdminUserSeeder
```

SSH 가 없다면 내 PC 에서 `.env` 의 DB 를 카페24 DB 로 잠시 바꾸고(카페24 DB 외부 접속 허용 필요) 위 명령을 실행하거나,
내 PC 의 MySQL 에서 만든 표를 내보내기(dump) 해서 카페24 phpMyAdmin 으로 가져옵니다.

## 6. 확인

1. `https://도메인/` — 메인 화면
2. `https://도메인/admin/login` — 관리자 로그인 → **비밀번호 바로 변경**
3. 관리자 > 회사 정보 — 전화·이메일·주소 입력
4. 관리자 > **홈페이지 편집** — 글자 하나 고치고 저장 → 게시 → 새 창에서 확인
5. 고객문의 폼 전송 → 관리자 > 문의 내역 에 들어오는지
6. `.env` 에서 `admin.initialPassword` 줄 지우기

## 7. 로컬에서 고친 내용 옮기기

1. 로컬 관리자 > 문구 일괄 바꾸기 > 아래 **내보내기** → `.json` 파일 저장 (고친 글자·올린 사진이 모두 들어 있음)
2. 카페24 관리자 > 문구 일괄 바꾸기 > **가져오기**
3. 홈페이지 편집 에서 확인 → **홈페이지에 게시**

## 자주 막히는 곳

| 증상 | 원인 · 해결 |
| --- | --- |
| 흰 화면 / 500 | `writable/` 권한, `.env` DB 정보, PHP 버전(8.2+) 확인. `writable/logs/` 에 로그가 남는다 |
| CSS·사진이 안 나옴 | `app.baseURL` 끝에 `/` 가 있는지, https/http 가 맞는지 |
| 편집기 저장 시 "보안 확인이 만료" | 로그인 후 오래 두었을 때. 화면을 새로 고치고 다시 저장 |
| 편집기 사진 업로드 실패 | `uploads/` 쓰기 권한(707), 8MB 이하 jpg·png·webp·gif·svg |
| 관리자 오른쪽 아래 불꽃 아이콘 | 개발용 도구 막대. `CI_ENVIRONMENT = production` 으로 바꾸면 사라진다 |
