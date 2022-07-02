@extends('adminlte::page')

@section('title', 'Import Excel')

@section('content_header')
    <h1 class="m-0 text-dark"><a href="/datasantri">DataSantri</a> &raquo; Import Excel</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                        <div class="card ">
                            <!-- form start -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="{{ route('import') }}" method="post" enctype="multipart/form-data">
                                      @csrf
                                        <div class="card-body">
                                          <div class="form-group">
                                            <label for="exampleInputFile">Input File Excel</label>
                                            <div class="input-group">
                                              <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="excel" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile" name="excel">Choose file</label>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- /.card-body -->
                        
                                        <div class="card-footer">
                                          <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                      </form>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mt-3 ml-3">
                                        <h3 class="text-bold">CATATAN PENTING !</h3>
                                        <ol type="number">
                                            <li>Download Template Excel <a href="/download">disini</a> </li>
                                            <li>Isikan pada kolom <b>KAMPUS</b>
                                            dengan format 
                                            <ul> 
                                              <li>Kampus 1</li>
                                              <li>Kampus 2</li>
                                              <li>Kampus 3</li>
                                              <li>Kampus 4</li>
                                            </ul>
                                           <span class="text-danger">Sesuaikan dengan kebutuhan dan perhatikan besar kecil huruf.</span>
                                          </li>
                                          <li>Isikan pada kolom <b>GEDUNG</b> dengan format yang benar (sesuai pada menu input gedung.)</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            
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
       $('.custom-file-input').on('change',function(){
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
  </script>
@endpush