<b>職訓局期間製作的Laravel作品，功能-網頁模板<br>
排版為套用其他人的成品，並非自己製作的

# 安裝教學
1.將專案下載下來解壓縮，且放置路徑不可有中文

2.終端機去laravel專案位置，並執行【composer i】<br>
注意: 需下載composer才能使用
![螢幕擷取畫面 (247)](https://github.com/hsd325/laravel01/assets/100175482/169956bd-338b-4ed2-b8dd-483867f0dbef)

3.執行【npm i】<br>
注意: 需下載node.js才能使用
![螢幕擷取畫面 (249)](https://github.com/hsd325/laravel01/assets/100175482/1923d210-ee41-4f0d-a614-190cda2721e8)

4.將【.env.example】複製並改名成【.evn】<br>
終端機指令 : cp .env.example .env
![螢幕擷取畫面 (248)](https://github.com/hsd325/laravel01/assets/100175482/3453c318-5b34-42af-b7b1-424ed50ce8cb)

5.資料庫在SQL資料夾裡面，解壓縮後，去phpmyadmin進行匯入

6.執行laravel<br>
 php artisan serve<br>
![螢幕擷取畫面 (250)](https://github.com/hsd325/laravel01/assets/100175482/26b2e1f7-e9c8-4331-a4ad-8230d03a72c5)

# 前端畫面
## 首頁
語系有中文和英文，彼此內容是獨立的，內容可到後臺管理系統進行更改<br><br>
中文<br>
![螢幕擷取畫面 (251)](https://github.com/hsd325/laravel01/assets/100175482/7da267e3-1379-4b7d-9848-14cc7a48640e)

英文
![螢幕擷取畫面 (252)](https://github.com/hsd325/laravel01/assets/100175482/61fe1b65-2003-4f56-9147-957695dd4792)

# 後臺管理系統
網址為本機網址後面加【/admin】<br>
帳號:111<br>
密碼:111<br>
注意: 放置路徑不可有中文，不然驗證碼圖片會顯示不了<br>
![螢幕擷取畫面 2024-06-12 080738](https://github.com/hsd325/laravel01/assets/100175482/4f1332fe-c6a8-494c-9223-b441d1075671)

<br>

前端的瀏覽次數
![螢幕擷取畫面 2024-06-11 175241](https://github.com/hsd325/laravel01/assets/100175482/3ef85a96-e3ce-42d7-a3a1-b6b984cb4a29)

更換語言，對應前端的語系，每個語系的內容都是獨立的
![螢幕擷取畫面 2024-06-11 175407](https://github.com/hsd325/laravel01/assets/100175482/999092f8-cc75-4bfd-8fab-94b7cfdf7f8e)

# 作品技術
- Laravel 8
- Composer V2.7.6
- Bootstrap v4.6.1
- jQuery v1.5.1
- sweetalert2.js
- CKEditor 5
- Captcha 驗證碼
- PHPWord
- TCpdf
- Laravel Excel
- html2canvas.min.js 截圖
