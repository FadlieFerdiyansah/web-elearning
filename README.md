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
    <li>Buat database lalu tuliskan nama database pada file <b>.env</b> <code>DB_DATABASE=elearning</code></li>
    <li>Setelah sudah buat database ketikan <code>php artisan migrate</code> pada terminal lalu enter</li>
    <li>Lalu masukan <code>FILESYSTEM_DRIVER=public</code> pada file <b> .env </b> </li>
    <li>Setelah selesai, ketikan diterminal <code> php artisan storage:link </code> </li>
    <li>Lalu buat key app nya dengan care <code> php artisan key:generate </code> </li>
    <li>Setelah itu download semua package dengan cara <code> composer install </code> </li>
    <li>Terakhir jalankan server nya <code> php artisan serve </code></li>
    <li>dan buka url nya diweb browser <code>http://127.0.0.1:8000</code></li>
</ol>
