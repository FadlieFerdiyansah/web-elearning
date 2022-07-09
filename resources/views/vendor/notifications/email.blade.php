<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 10px !important;
        }

        .greeting {
            font-size: 20px;
            font-weight: bold;
        }

        p {
            font-size: 14px;
        }

        .link {
            background-color: #495C83;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 15px !important;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">
    <title>Permintaan Riset Password</title>
</head>

<body>
    <p class="greeting">{{ $greeting }}</p>
    <p>Kamu meminta untuk melakukan riset password</p>
    <p><b>Jika benar </b>itu <b>kamu</b> yang melakukan Permintaan riset password</p>
    <p>Silahkan klik button dibawah ini untuk melakukan riset password, Jika itu bukan kamu, bisa kamu <b>Abaikan</b>
    </p>
    <p>
        <a href="{{ $actionUrl }}" class="link">
            Riset Password
        </a>
    </p>
    <br><br>

    <code>Note : Jika tombol diatas tidak berfungsi kamu bisa langsung klik link dibawah</code>
    <p>
        <a href="{{ $actionUrl }}">
            {{ $actionUrl }}
        </a>
    </p>

    <br>
    <hr>
    <p><b>Github</b> : <a href="https://github.com/fadlieFerdiyansah">github.com/fadlieFerdiyansah</a> <br>
        <b>Email</b> : <a href="mailto:fadlieferdiyansah26@gmail.com">fadlieferdiyansah26@gmail.com</a> <br>
        <b>Whatsapp</b> : <a href="https://wa.me/85717648925">085717648925</a></p>
    <hr>
</body>

</html>