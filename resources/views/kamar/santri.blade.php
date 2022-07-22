@extends('adminlte::page')

@section('title', 'Data Kamar Santri')
@section('content_header')
<h1 class="m-0 text-dark">Data Santri dan Kamar {!! $kampus ? "&raquo; {$kampus}" : ''!!}{!! $gedung ? "&raquo;
    {$gedung}" : '' !!} {!! $kamar ? "&raquo; {$kamar}" : '' !!}</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <!-- Default dropright button -->
                {{-- menu section --}}
                <div class="d-flex">
                    <div class="btn-group dropright mb-3">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                            Pilih Kampus
                        </button>
                        <div class="dropdown-menu">
                            <!-- Dropdown menu links -->
                            <a class="dropdown-item active" href="{{ route('kamar.santri') }}">All</a>
                            <a class="dropdown-item " href="{{ route('kamar.santri','kampus=Kampus 1') }}">Kampus 1</a>
                            <a class="dropdown-item" href="{{ route('kamar.santri','kampus=Kampus 2') }}">Kampus 2</a>
                            <a class="dropdown-item" href="{{ route('kamar.santri','kampus=Kampus 3') }}">Kampus 3</a>
                            <a class="dropdown-item" href="{{ route('kamar.santri','kampus=Kampus 4') }}">Kampus 4</a>

                        </div>
                    </div>
                    <div class="mx-1"></div>
                    <div class="dropdown d-block d-lg-none">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false">
                            Kamar
                        </button>
                        <div class="dropdown-menu">

                            @foreach($gedungKampus as $gedung)
                            <h6 class="dropdown-header">{{ $gedung->gedung }}</h6>
                            {{-- {{ dd($gedung) }} --}}
                            @foreach($gedung->kamar as $kamar)
                            <a class="dropdown-item"
                                href="{{ route('kamar.santri',['kampus'=>$gedung->kampus,'kamar'=>$kamar->kamar,'gedung'=>$kamar->id_gedung]) }}">
                                {{$kamar->kamar }}
                            </a>
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex">

                    <div class="card d-lg-block d-none mr-4" style="width: 12rem;">
                        @foreach($gedungKampus as $gedung)
                        <div class="card-header bg-secondary">
                            {{ $gedung->gedung }}
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($gedung->kamar as $kamar)
                            <a
                                href="{{ route('kamar.santri',['kampus'=>$gedung->kampus,'kamar'=>$kamar->kamar,'gedung'=>$kamar->id_gedung]) }}">
                                <li class="list-group-item">
                                    {{$kamar->kamar }}
                                </li>
                            </a>
                            @endforeach
                        </ul>
                        @endforeach

                    </div>
                    {{-- end menu section --}}

                    {{-- table section --}}
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered table-stripped" id="example2" width="100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Kampus</th>
                                    <th>Gedung</th>
                                    <th>Kamar</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a class="badge bg-secondary border-0" href="/datasantri//edit">
                                        EDIT
                                    </a>
                                    <a class="badge bg-info border-0" href="/datasantri//edit">
                                        DETAIL
                                    </a>
                                    <form action="/datasantri/" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('ARE YOU SURE ?')">
                                            DELETE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- end table section --}}
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