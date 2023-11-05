<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Izin</title>
</head>
<style>
    .kop {
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
        width: 130%;
        opacity: .7;
        position: absolute;
        top: -10%;
        left: -15%;
    }

    .container header span {
        position: absolute;
        top: 44px;
        left: 100px;
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

    label {
        margin-top: 10px;
    }

    ul li {
        font-size: 11px;
    }
</style>

<body class="body">
    <div class="header">
        <img class="kop" src="https://user-images.githubusercontent.com/80609220/280525127-936210f1-f163-4670-974b-6728a58a6cef.png" alt="">
    </div>
    <section class="container">
        <div class="body">
            <header>
                {{-- <img src="https://user-images.githubusercontent.com/80609220/280525127-936210f1-f163-4670-974b-6728a58a6cef.png" alt=""> --}}
                <span>SURAT IZIN</span>
            </header>
            <div class="main">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Nama </td>
                            <td>: {{ $data->santri->nama }}</td>
                        </tr>
                        <tr>
                            <td>Kelas</td>
                            <td>: {{ $data->santri->jenjang }} {{ $data->santri->kelas }}</td>
                        </tr>
                        <tr>
                            <td>Kamar</td>
                            <td>: G. {{ $data->santri->detail->kamar->gedung->gedung }} {{
                                $data->santri->detail->kamar->kamar }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $data->santri->alamat}}</td>
                        </tr>
                        <tr>
                            <td>Keperluan</td>
                            <td>:
                                @if($data->nama_perizinan == 'IZIN PULANG')
                                Pulang
                                @elseif($data->nama_perizinan == 'IZIN KELUAR')
                                Keluar
                                @endif
                                - {{ $data->keterangan }}
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Wali</td>
                            <td>: {{ $data->santri->nama_ortu }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>: {{ $data->santri->no_telp }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <table border="1" class="tabel2" cellspacing="0">
                    <tr>

                        <td width="30%"><b>Tanggal Izin</b> <br> {{ date('d F Y', strtotime($data->tanggal_perizinan)) }}</td>
                        <td><b>Tanda Tangan Kembali</b></td>
                        <td rowspan="2"><b><span style="color: red">Wajib</span> Kembali ke Pesantren <br>pada
                                tanggal</b>
                            <h3>{{ date('d F Y', strtotime($data->tanggal_kembali)) }}</h3><br>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            ( Kampus 1 )
                        </td>
                        <td>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            ( {{ $data->santri->detail->kamar->gedung->kampus }} )
                        </td>

                    </tr>
                </table>
                <label>Catatan :</label>
                <ul>
                    <li>Kartu Izin Dikeluarkan Resmi dari Pihak Pesantren.</li>
                    <li>Santri Diperbolehkan Izin Jika Dalam Kondisi Mendesak (Sesuai Peraturan Pesantren).</li>
                    <li>Durasi Santri Izin Sesuai Dari Pihak Pesantren,Bila Melampui Batas akan dikenai <b>Takziran</b>.
                    </li>
                    <li>Sebagai Bukti Resmi Izin Surat Ini tertanda Tangani dan Stempel Pada Kolom Diatas.</li>
                    <li>Telah Izin dan Kembali Wajib Lapor Kantor Kampus.</li>
                </ul>
            </div>
        </div>
    </section>
</body>

</html>