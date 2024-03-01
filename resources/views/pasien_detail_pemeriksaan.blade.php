@extends('template.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Pemeriksaan</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 ">
                        <?php if (session()->has('msg')) :?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" id="autoDismissAlert">
                            {{ session('msg') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif ?>
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tab-kategori" data-toggle="pill"
                                            href="#tab-kategori" role="tab" aria-controls="tab-kategori"
                                            aria-selected="true">Data detail Pemeriksaan Rontgen</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="tab-kategori" role="tabpanel"
                                        aria-labelledby="custom-tab-kategori">
                                        <table  class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 10px;">#</th>
                                                    <th>Data</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>No MR</td>
                                                    <td>{{ $rontgen[0]->idpemeriksaan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Id Pasien</td>
                                                    <td>{{ $rontgen[0]->idpasien }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Pasien</td>
                                                    <td>{{ $rontgen[0]->pasien->nama_pasien }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Pemeriksaan</td>
                                                    <td>{{ strftime('%d %B %Y', strtotime($rontgen[0]->tgl_pemeriksaan)) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jenis Pemeriksaan</td>
                                                    <td>{{ $rontgen[0]->jenis_pemeriksaan }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hasil Rontgen</td>
                                                    <td>
                                                        @foreach (explode(',', $rontgen[0]->foto_rontgen) as $image)
                                                        <a href="{{ asset('storage/images/' . trim($image)) }}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
                                                            <img width="150px "src="{{ asset('storage/images/' . trim($image)) }}" class="img-fluid mb-2" alt="white sample" />
                                                        </a>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                        </table>

                                        <a href="{{ route('pasien')}}">
                                            <button type="button" class="btn btn-success">Kembali</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
<script src="{{ asset('assets/admin') }}/assets/js/custom/kategori.js"></script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection