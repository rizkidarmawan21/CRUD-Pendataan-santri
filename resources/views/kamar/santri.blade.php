@extends('adminlte::page')

@section('title', 'Data Kamar Santri')
@section('plugins.Select2', true)
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="d-flex">
                    <div class="mr-auto">
                        <button type="submit" data-toggle="modal" data-target="#exampleModal"
                            class="btn btn-success">Ploting Kamar Santri</button>
                    </div>
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
                        <div class="dropdown-menu" style="overflow-y: scroll ; height: 20rem;">

                            @foreach($gedungKampus as $gedung)
                            <h6 class="dropdown-header">G. {{ $gedung->gedung }}</h6>
                            {{-- {{ dd($gedung) }} --}}
                            @forelse($gedung->kamar as $kamar)
                            <a class="dropdown-item"
                                href="{{ route('kamar.santri',['kampus'=>$gedung->kampus,'kamar'=>$kamar->kamar,'gedung'=>$gedung->gedung]) }}">
                                {{$kamar->kamar }}
                            </a>
                            @empty
                            <a class="dropdown-item disabled text-sm">Kamar Kosong</a>
                            @endforelse
                            @endforeach
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex">

                    <div class="card h- d-lg-block d-none mr-4" style="width: 15rem; border-radius: 0% ; height: 25rem; overflow-y: scroll">
                        @foreach($gedungKampus as $gedung)
                        <div class="p-2 bg-secondary">
                            G. {{ $gedung->gedung }}
                        </div>
                        <ul class="list-group list-group-flush">
                            @forelse($gedung->kamar as $kamar)
                            <a
                                href="{{ route('kamar.santri',['kampus'=>$gedung->kampus,'kamar'=>$kamar->kamar,'gedung'=>$gedung->gedung]) }}">
                                <li class="list-group-item">
                                    {{$kamar->kamar }}
                                </li>
                            </a>
                            @empty
                            <li class="list-group-item">
                                <h6 class="text-center text-sm">Belum ada kamar</h6>
                            </li>
                            @endforelse
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
                            @foreach($dataSantri as $item)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->santri->nama}}</td>
                                <td>{{ $item->santri->jenjang}} {{ $item->santri->kelas}}</td>
                                <td>{{ $item->kamar->gedung->kampus}}</td>
                                <td>{{ $item->kamar->gedung->gedung}}</td>
                                <td>{{ $item->kamar->kamar}}</td>
                                <td>
                                    <a class="badge bg-secondary border-0" href="/datasantri/edit">
                                        EDIT
                                    </a>
                                    <a class="badge bg-info border-0" href="{{ route('detail.santri.delete',$item->id) }}">
                                        DETAIL
                                    </a>
                                    <form action="{{ route('detail.santri.delete',$item->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('ARE YOU SURE ?')">
                                            DELETE
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ploting Kamar Santri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('detail.santri') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Santri</label>
                                <select class="form-control select2" style="width: 100%;" name="id_santri">
                                    <option value="" selected>Pilih Santri</option>
                                    @foreach($masterSantri as $mSantri)
                                    <option value="{{ $mSantri->id }}">{{ $mSantri->nama }} - {{ $mSantri->jenjang }} {{
                                        $mSantri->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Kamar</label>
                                <select class="form-control select2" style="width: 100%;" name="id_kamar">
                                    <option value="" selected>Pilih Kamar</option>
                                    @foreach($masterKamar as $gedung)
                                    <option disabled>G. {{ $gedung->gedung }}</option>
                                    {{-- {{ dd($gedung) }} --}}
                                    @foreach($gedung->kamar as $kamar)
                                    <option value="{{ $kamar->id }}">
                                       {{ $gedung->kampus }} - {{ $gedung->gedung }} - {{$kamar->kamar }} 
                                    </option>
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </form>
    </div>
</div>
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
<script>
    //Initialize Select2 Elements
    $('.select2').select2()
    
</script>
@endpush