<h3>How to install : </h3>
<p>Download file dengan cara zip/clone</p>
<h4> Zip </h4>
<p>Klik button Code disamping kanan atas, lalu klik <b>download zip</b></p>
<h4> Git Clone </h4>
<p>Copy code dibawah, buka terminal lalu paste dan enter</p>

```
git clone https://github.com/FadlieFerdiyansah/web-elearning.git
```

<br>
<p>Setelah berhasil meng install file nya</p>
<h4> Running program </h4>
<ol>
    <li>Copy file <b>.env.example</b> rename menjadi <b>.env</b></li>
    <li>Buat nama database pada file <b>.env</b> <code> DB_DATABASE=elearning </code></li>
    <li>Setelah membuat database ketikan <code> php artisan migrate </code> pada terminal lalu enter</li>
    <li>Setelah berhasil, masukan data-data nya dengan cara <code> php artisan db:seed </code> pada terminal lalu enter</li>
    <li>Lalu masukan <code> FILESYSTEM_DRIVER=public </code> pada file <b> .env </b> </li>
    <li>Setelah selesai, ketikan diterminal <code>  php artisan storage:link  </code> </li>
    <li>Lalu buat key app nya dengan care <code>  php artisan key:generate  </code> </li>
    <li>Setelah itu download semua package dengan cara <code>  composer install  </code> </li>
    <li>Terakhir jalankan server nya <code>  php artisan serve  </code></li>
    <li>dan buka url nya diweb browser <code> http://127.0.0.1:8000 </code></li>
</ol>

<h3>Login</h3>

``` 
http://127.0.0.1:8000/login 
```
    
</ul>
<table border="1px" cellspacing="0" cellpadding="5px">
    <tr>
        <th>Email</th>
        <th>Password</th>
        <th>Level</th>
    </tr>
    <tr>
        <td>admin@gmail.com</td>
        <td>password</td>
        <td>Admin</td>
    </tr>
    <tr>
        <td>dosen@gmail.com</td>
        <td>password</td>
        <td>Dosen</td>
    </tr>
    <tr>
        <td>mahasiswa@gmail.com</td>
        <td>password</td>
        <td>Mahasiswa</td>
    </tr>
</table>

