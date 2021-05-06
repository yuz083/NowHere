NowHere 소스코드 디렉토리 구조 설명

1. 웹어플리케이션 소스

/web/html/*.php      => PC버전 PHP 소스 파일
/web/html/css/*.*   => PC버전 CSS 파일
/web/html/js/*.*	=> PC버전 자바스크립트 파일
/web/html/bootstrap  => bootstrap 라이브러리 소스

/web/html/app/*.php      => 앱의 Webview용  PHP 소스 파일
/web/html/app/css/*.*   => 앱의 Webview용 CSS 파일
/web/html/app/js/*.*	=> 앱의 Webview용 자바스크립트 파일
/web/html/app/bootstrap  => 앱의 Webview용 라이브러리 소스

2. Android Native App 소스 코드

/Android/Src  => java 소스 코드
/Android/Install => 버전별 설치용 apk 파일

3. Database 소스코드

/Database/DB_Create.sql =>스키마 생성용 쿼리 스크립트
/Database/LocalAD_ERD.mwb  => MySQL workbench 8용 ERD 모델링 파일
