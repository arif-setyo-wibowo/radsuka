@extends('template.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pasien</h1>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data Pasien</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th>Tgl Lahir</th>
                                            <th>Alamat</th>
                                            <th>Jenis Kelamin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ Session::get('pasien.idpasien') }}</td>
                                            <td>{{ Session::get('pasien.nama') }}</td>
                                            <td>{{ Session::get('pasien.tgl_lahir') }}</td>
                                            <td>{{ Session::get('pasien.alamat') }}</td>
                                            <td>{{ Session::get('pasien.jenis_k') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Hasil Pemeriksaan</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No MR</th>
                                            <th>Tanggal Pemeriksaan</th>
                                            <th>Jenis Pemeriksaan</th>
                                            <th>Detail Pemeriksaan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hasil as $item)
                                            <tr>
                                                <td>{{$item->idpemeriksaan}}</td>
                                                <td>{{ strftime('%d %B %Y', strtotime($item->tgl_pemeriksaan)) }}</td>
                                                <td>{{$item->jenis_pemeriksaan}}</td>
                                                <td>{{$item->detail_pemeriksaan}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm">
                                                        <a href="<?= route('detail.pemeriksaan', ['id' => $item->idpemeriksaan]) ?>">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
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
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
