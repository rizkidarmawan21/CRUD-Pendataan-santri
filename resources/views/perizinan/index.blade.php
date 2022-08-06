@extends('adminlte::page')

@section('title', 'Perizinan Santri')
@section('content_header')
<h1 class="m-0 text-dark">
    Perizinan Santri
    {{ dataPerizinan(Auth::user()->is_admin) }}
</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <a href="{{route('datasantri.create')}}" class="btn btn-primary btn-sm mb-2">
                    Tambah Perizinan
                </a>
                <a href="" class="btn btn-sm mb-2 btn-secondary">All</a>
                <a href="" class="btn btn-warning btn-sm mb-2">
                    Masa Izin
                </a>
                <a href="" class="btn btn-success btn-sm mb-2">
                    Sudah Kembali
                </a>

                <div class="table-responsive">

                    <table class="table table-hover table-bordered table-stripped" id="example2" width="100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kamar</th>
                                <th>Kelas</th>
                                <th>Izin</th>
                                <th>Tanggal Izin</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($perizinan as $item)
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->santri->nama }}</td>
                            <td>{{ $item->santri->detail->kamar->gedung->kampus }} {{
                                $item->santri->detail->kamar->gedung->gedung }} {{ $item->santri->detail->kamar->kamar
                                }}</td>
                            <td>{{ $item->santri->jenjang }} {{ $item->santri->kelas }}</td>
                            <td>{{ $item->nama_perizinan }} {{ $item->keterangan }}</td>
                            <td>{{ date('d F Y', strtotime($item->tanggal_perizinan)) }}</td>
                            <td>{{ date('d F Y', strtotime($item->tanggal_kembali)) }}</td>
                            <td>

                                @if ($item->status == 0)
                                <span class="badge badge-pill badge-danger text-white">Not Verify</span>
                                @elseif ($item->status == 1)
                                @if ( date(('Y-m-d')) > $item->tanggal_kembali)
                                <span class="badge badge-pill badge-warning ">Verify -
                                    <span class="text-danger">Terlambat</span>
                                </span>
                                <br>
                                <a target="blank"
                                    href="https://api.whatsapp.com/send?phone={{$item->santri->no_telp}}&text=Assalamualaikum%20%0A%0AKami%20dari%20ponpes%20Askhabul%20Kahfi%20menginformasikan%20bahwa%20putra%20%2F%20putri%20bapak%20%2F%20ibu%20atas%20nama%20{{$item->santri->nama}}%20%2C%20telah%20terlambat%20kembali%20ke%20pondok%20pesantren%20%2C%20mohon%20kepada%20bapak%20%2F%20ibu%20wali%20santri%20untuk%20bisa%20mengantarkan%20putra%20%2F%20putri%20nya%20ke%20pesantren%20demi%20mentaati%20peraturan%20pondok%20pesantren%20Askhabul%20Kahfi%20%2C%20jika%20terlambat%20datang%20ke%20pesantren%20maka%20akan%20di%20kenai%20sanksi%20kecuali%20ada%20konfirmasi%20perpanjangan%20izin%20%2C%20yg%20bisa%20di%20kirimkan%20ke%20nomor%20kantor%20kampus%20masing2%20terima%20kasih%20%0A%0AWassalamualaikum"
                                    class="badge badge-pill badge-success">Kirim WA</a>
                                @else
                                <span class="badge badge-pill badge-warning ">Verify -
                                    Masa Izin
                                </span>
                                @endif
                                @else
                                <span class="badge badge-pill badge-success">Sudah Kembali</span>
                                @endif

                            </td>
                            <td>
                                @if($item->status == 0)
                                @if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 0)

                                <form method="POST" action="">
                                    @csrf
                                    <button type="submit" class="badge badge-pill badge-warning border-0">
                                        Verify
                                    </button>
                                </form>
                                @endif
                                <a href="" target="blank"
                                    class="badge badge-pill badge-success">
                                    Surat Pengantar
                                </a>
                                @elseif($item->status == 1)
                                <a href="" target="blank" class="badge badge-pill badge-warning">
                                    Surat Izin
                                </a>
                                <form action="" method="post">
                                    @csrf
                                    <button class="badge badge-success badge-pill border-0">
                                        Kembali
                                    </button>
                                </form>
                                @endif
                                <a class="badge badge-pill bg-info" href="">DETAIL</a>
                                <a class="badge badge-pill bg-danger" href="">DELETE</a>
                            </td>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.1
    </div>
    <strong>Application Created with ❤️ By <a target="blank" href="http://rizkidarmawan21.github.io">Darms</a>.</strong>
</footer>
@stop




@push('js')
<script>
    $(function () {
        $('#example2').DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
    });
</script>
@endpush