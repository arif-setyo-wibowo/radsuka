@extends('template.admin')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Rontgen</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Rontgen</li>
                        </ol>
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
                                            aria-selected="true">Data Rontgen</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tab-tambah-edit" data-toggle="pill"
                                            href="#tab-tambah-edit" role="tab" aria-controls="tab-tambah-edit"
                                            aria-selected="false">Tambah & Edit Rontgen</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade show active" id="tab-kategori" role="tabpanel"
                                        aria-labelledby="custom-tab-kategori">
                                        <table id="example1" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID Pasien</th>
                                                    <th>Pasien</th>
                                                    <th>Tanggal Pemeriksaan</th>
                                                    <th>Jenis Pemeriksaan</th>
                                                    <th>Barcode</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($rontgen as $item)
                                                    <tr>
                                                        <td>{{ $item->idpasien }}</td>
                                                        <td>{{ $item->idpasien }}</td>
                                                        <td>{{ strftime('%d %B %Y', strtotime($item->tgl_pemeriksaan)) }}</td>
                                                        <td>{{ $item->jenis_pemeriksaan }}</td>
                                                        <td><?= '<img src="data:image/png;base64,' .
                                                        DNS2D::getBarcodePNG('4', 'QRCODE', 5, 5) . '" alt="barcode" />' ?>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm">
                                                                <a href="<?= route('admin.rontgen.detail', ['id' => $item->idpemeriksaan]) ?>">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </button>
                                                            <?= $item ?>
                                                            <button type="button" class="btn btn-info btn-sm">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                Edit
                                                            </button>
                                                                <a class="btn btn-danger btn-sm"
                                                                        onclick="return confirm('Apakah Anda Yakin Ingin Check Out dengan biaya parkir sebesar R Kendaraan Ini?')"
                                                                        href="{{ route('admin.rontgen.detail', ['id' => $item->idpemeriksaan]) }}">
                                                                        Delete
                                                            </a>
                                                        </td>
                                                @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tab-tambah-edit" role="tabpanel"
                                        aria-labelledby="custom-tab-tambah-edit">
                                        <form action="{{ route('admin.rontgen.storeupdate') }}" method="POST">
                                            @csrf
                                            <div class="form-group">
                                                <label>ID Pasien</label>
                                                <select class="form-control select2" style="width: 100%;" name="idpasien"
                                                    id="idpasien">
                                                    <option value="" selected disabled>Pilih Pasien</option>
                                                    @foreach ($pasien as $item)
                                                        <option value="{{ $item->idpasien }}">
                                                            {{ $item->idpasien . ' - ' . $item->nama_pasien }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tanggal Pemeriksaan</label>
                                                <input type="date" class="form-control" id="tgl_pemeriksaan"
                                                    name="tgl_pemeriksaan" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Jenis Pemeriksaan</label>
                                                <input type="text" class="form-control" id="jenis_pemeriksaan"
                                                    name="jenis_pemeriksaan" placeholder="Masukkan Jenis Pemeriksaan"
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Detail Rontgen</label>
                                                <textarea name="detail_pemeriksaan" class="form-control" id="detail_pemeriksaan" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="proses" id="proses" value="Tambah"
                                                    class="btn btn-primary">
                                            </div>
                                        </form>
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
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
