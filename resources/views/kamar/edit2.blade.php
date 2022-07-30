@extends('adminlte::page')

@section('title', 'Data Kamar Santri')
@section('plugins.DatatablesPlugin', false)
@section('content_header')
<h1 class="m-0 text-dark">Data Santri dan Kamar </h1>
@stop

@section('content')
{{-- Setup data for datatables --}}
@php
$heads = [
'ID',
'Name',
['label' => 'Phone', 'width' => 40],
['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
    <i class="fa fa-lg fa-fw fa-pen"></i>
</button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
    <i class="fa fa-lg fa-fw fa-trash"></i>
</button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
    <i class="fa fa-lg fa-fw fa-eye"></i>
</button>';

$config = [
'data' => [
[22, 'John Bender', '+02 (123) 123456789', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
[19, 'Sophia Clemens', '+99 (987) 987654321', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
[3, 'Peter Sousa', '+69 (555) 12367345243', '<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'],
],
'order' => [[1, 'asc']],
'columns' => [null, null, null, ['orderable' => false]],
];
@endphp


{{-- With buttons --}}
<x-adminlte-datatable id="table5" :heads="$heads" :config="$config" theme="light" striped hoverable
    with-buttons />

@stop

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
                <a class="badge bg-secondary border-0" href="{{ route('detail.santri.edit',$item->id) }}">
                    EDIT
                </a>
                <a class="badge bg-info border-0" href="{{ route('datasantri.show',$item->santri->id) }}">
                    DETAIL
                </a>
                <form action="{{ route('detail.santri.delete',$item->id) }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    <button class="badge bg-danger border-0" onclick="return confirm('ARE YOU SURE ?')">
                        DELETE
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>


@push('js')
<script>
    $(function () {
    $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    });
    });
</script>
@endpush