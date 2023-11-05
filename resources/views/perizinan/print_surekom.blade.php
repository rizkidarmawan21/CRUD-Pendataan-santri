<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Pengantar</title>
</head>
<style>
    img {
        background-size: 97%;
        width: 384px;
        /* display: block; */
        position: absolute;
        top: -40px;
        left: -40px;
    }

    .body {
        font-family: Times New Roman;
    }


    .container header img {
        width: 80%;
        opacity: .3;
        position: absolute;
        top: 30%;
        left: 10%;
    }

    .container header span {
        position: absolute;
        top: 44px;
        left: 80px;
    }

    .container .main {
        top: 70px;
        font-size: 13px;
        position: absolute;
        z-index: 9999;
    }

    .tabel2 {
        font-size: 11px;
        text-align: center;
    }
</style>

<body class="body">
    <div class="header">
        {{-- Kop surat pesantren --}}
        <img src="https://user-images.githubusercontent.com/80609220/280525127-936210f1-f163-4670-974b-6728a58a6cef.png" alt="">
        <br>
    </div>
    <section class="container">
        <div class="body">
            <header>
                <img src="https://www.logoku.com/image/c/data/items/1695353615_logokucom_letter-a-book-and-mosque-logo.jpg" alt="">
                <span>SURAT PENGANTAR</span>
            </header>
            <div class="main">
                <p>Assalamualaikum Warahmatullahi Wabarakaatuh <br> Dengan ini saya selaku pengurus dari :</p>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama </td>
                            <td>: {{ $data->santri->nama }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: {{ $data->santri->jenjang }} - {{ $data->santri->kelas }} </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $data->santri->alamat }}</td>
                        </tr>
                        <tr>
                            <td>Keperluan</td>
                            <td>: {{ $data->nama_perizinan }}</td>
                        </tr>
                    </tbody>
                </table>
                <p class="ket">Memberitahukan bahwa hari ini yang bersangkutan telah dipersilahkan untuk meminta ijin
                     ke kantor pusat dikarenakan <b>{{ $data->keterangan }}</b>
                </p>
                <p class="ket"> Demikian kami sampaikan surat ini untuk dipergunakan sebagaimana mestinya.
                    <br><br>Wassalamualaikum Warahmatullahi Wabarakaatuh
                </p>
                <table border="0" class="tabel2" cellspacing="0">


                    <tr>
                        <td style="color:white;">
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            localhost:8080/sistemperizin
                        </td>

                        <td>
                            Semarang, {{ date('d F Y') }}

                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            ...............................

                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</body>

</html>