<h3>Cara install : </h3>

<p>Download file dengan cara zip/clone</p>
<h5> Zip </h5>
<p>Klik button Code disamping kanan atas, lalu klik <b>download zip</b></p>

<h5> Git Clone </h5>
<p>Paste code dibawah, buka terminal lalu paste dan enter</p>
<code>git clone https://github.com/FadlieFerdiyansah/web-elearning.git</code>

<br>
<p>Setelah berhasil meng install file nya</p>
<h4> Running program </h4>
<ol>
    <li>Copy file <b>.env.example</b> rename menjadi <b>.env</b></li>
    <li>Setelah di copy menjadi <b>.env</b> paste code didalam file <b> .env </b> <b><code>FILESYSTEM_DRIVER=public</code></b></li>
    <li>Setelah selesai, ketikan diterminal <b><code> php artisan storage:link </code></b> </li>
    <li>Lalu buat key app nya dengan care <b><code> php artisan key:generate </code></b> </li>
    <li>Setelah itu download semua package dengan cara <b><code> composer install </code></b> </li>
    <li>Terakhir jalankan server nya <b><code> php artisan serve </code></b></li>
    <li>dan buka url nya diweb browser default bawaan laravel, <b><code>http://127.0.0.1:8000</code></b></li>
    <li>Atau kalau menggunakan valet/laragon <b><code>e-learning.test</code></b></li>
</ol>
