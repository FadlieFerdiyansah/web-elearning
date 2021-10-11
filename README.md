<h3>Cara install : </h3>

<p>Download file dengan cara zip/clone</p>
<h5> Zip </h5>
<p>Klik button Code disamping kanan atas, lalu klik <b>download zip</b></p>
<br>
<h5> Git Clone </h5>
<p>Paste code dibawah, buka terminal lalu paste dan enter</p>
<code>git clone https://github.com/FadlieFerdiyansah/web-elearning.git</code>

<p>Setelah berhasil meng install file nya</p>
<h4> Running program </h4>
<ol>
    <li>Copy file <b>.env.example</b> menjadi <b>.env</b></li>
    <li>Setelah dibuat copy <b>.env</b> paste code <b><code>FILESYSTEM_DRIVER=public</code></b> dibawah</li>
    <li>Buka terminal ketikan <b><code> php artisan key:generate </code></b> </li>
    <li>Setelah selesai generate key, ketikan lagi <b><code> php artisan storage:link </code></b> </li>
    <li>Setelah itu download semua package dengan cara <b><code> composer install </code></b> </li>
    <li>Terakhir jalankan server nya <b><code> php artisan serve </code></b> </li>
</ol>
