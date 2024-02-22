@extends('template.template')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-image: url({{asset('assets/')}}/img/bghs.jpg)">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class=" mb-0 text-white">Lihat Hasil Rontgen dengan Lebih Mudah</h1>
            <p class="lead fs-lg lh-sm mb-7 pe-xl-10">Pelayanan hasil pemeriksaan dari RSUD Arosuka</p>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="card" style="background: rgba(255, 255, 255, 0.1); ">
              <div class="card-body">
                  <h5 class="card-title">Silahkan Masuk Pasien Radsuka</h5><br><br>
          
                  <div class="form-group">
                      <label for="exampleInputEmail1" class="text-white">Id Pasien</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Masukkan ID">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1" class="text-white">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </div>
          
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card" style="background: rgba(255, 255, 255, 0.1); ">
              <div class="card-header">
                <h5 class="card-title m-0">Scan Qr</h5>
              </div>
              <div class="card-body" >
                <h6 class="card-title">Special title treatment</h6>

                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

