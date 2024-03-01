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
                                                    <th>No MR</th>
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
                                                        <td>{{ $item->idpemeriksaan }}</td>
                                                        <td><?= $item->pasien->idpasien . ' - <b>' . $item->pasien->nama_pasien . '</b>' ?>
                                                        </td>
                                                        <td>{{ strftime('%d %B %Y', strtotime($item->tgl_pemeriksaan)) }}
                                                        </td>
                                                        <td>{{ $item->jenis_pemeriksaan }}</td>
                                                        <td class="text-center"><?= '<img id="barcodeImg' .
                                                            $item->idpemeriksaan .
                                                            '"
                                                            src="data:image/png;base64,' .
                                                            DNS2D::getBarcodePNG(strval(route('detail.pemeriksaan', ['id' => $item->idpemeriksaan, 'token' => $item->pasien->token])), 'QRCODE', 3, 3) .
                                                            '"
                                                            alt="barcode" />' ?><br>
                                                            <button class="mt-1" onclick="copyLink('{{ route('detail.pemeriksaan', ['id' => $item->idpemeriksaan]) }}')">Copy Link</button>
                                                            <button class="mt-2" onclick="downloadBarcode({{$item->idpemeriksaan}})">Download</button>
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-warning btn-sm">
                                                                <a
                                                                    href="<?= route('admin.rontgen.detail', ['id' => $item->idpemeriksaan]) ?>">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </button>
                                                            <button type="button" class="btn btn-info btn-sm"
                                                                onclick="editRontgen('{{ $item->idpemeriksaan }}','{{ $item->idpasien }}','{{ $item->tgl_pemeriksaan }}','{{ $item->jenis_pemeriksaan }}','{{ $item->detail_pemeriksaan }}','{{ $item->pasien->nama_pasien }}')">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                Edit
                                                            </button>
                                                            <a class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ini?')"
                                                                href="{{ route('admin.rontgen.delete', ['id' => $item->idpemeriksaan]) }}">
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
                                        <form action="{{ route('admin.rontgen.storeupdate') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">No MR</label>
                                                <input type="number" class="form-control" id="idpemeriksaan"
                                                    name="idpemeriksaan" placeholder="Masukkan No MR" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" id="text-pasien"
                                                    style="display: none;">Pasien</label>
                                                <input type="hidden" class="form-control" id="pasien" name="pasien"
                                                    required>
                                            </div>
                                            <div class="form-group" id="idpasienselect" style="display: none">
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
                                                <label for="exampleInputEmail1">Foto Rontgen</label>
                                                <input type="file" name="images[]" id="foto_rontgen"
                                                    class="form-control" multiple required>
                                                <span class="text-danger" id="notifPassword"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">File Pdf</label>
                                                <input type="file" name="images[]" id="foto_rontgen"
                                                    class="form-control" multiple required>
                                                <span class="text-danger" id="notifPassword"></span>
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

        function downloadBarcode(id) {
            var barcodeImg = document.getElementById('barcodeImg' + id);
            var imageUrl = barcodeImg.src;
            var fileName = 'barcode.png';
            var anchor = document.createElement('a');
            anchor.href = imageUrl;
            anchor.download = fileName;
            anchor.setAttribute('type', 'image/png');
            anchor.click();
        }

        function copyLink(link) {
            navigator.clipboard.writeText(link)
                .then(() => alert('Link berhasil disalin'))
        }
    </script>
@endsection
