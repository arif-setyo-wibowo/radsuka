@extends('template.template')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-image: url({{asset('assets/')}}/img/bghs1.jpg);   background-size: cover;
background-repeat: no-repeat;
background-position: center;
background-attachment: fixed;
height: 100%;" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class=" mb-0 text-white" style="text-shadow: 3px 2px 1px grey;
            font-size: 40px;">Kirim testimoni dari pelayanan di RSUD Arosuka</h1>
            {{-- <p class="lead fs-lg lh-sm mb-7 pe-xl-10 text-white" style="text-shadow: 3px 2px 1px grey;
            font-size: 24px;">Pelayanan hasil pemeriksaan dari RSUD Arosuka</p> --}}
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
                <?php if (session()->has('msg')) :?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="autoDismissAlert">
                    {{ session('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif ?>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="autoDismissAlert">
                        @foreach ($errors->all() as $error)
                        {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @endforeach
                    </div>
                @endif
                
              <form action="{{ route('testimoni.kirim')}}" method="POST">
                @csrf
                  <div class="form-group">
                      <label for="exampleInputEmail" class="text-white" style="text-shadow: 3px 2px 1px grey;
                      font-size: 15px;">Nama</label>
                      <input type="text" class="form-control" name="nama" id="exampleInputEmail" placeholder="Masukkan Nama" required>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1" class="text-white" style="text-shadow: 3px 2px 1px grey;
                    font-size: 15px;">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Masukkan Email" required>
                </div>
                  <div class="form-group">
                      <label for="exampleInputPassword1" class="text-white" style="text-shadow: 3px 2px 1px grey;
                      font-size: 15px;">Pesan</label>
                      <textarea class="form-control" name="pesan" id="" cols="30" rows="10" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              </div>
          </div>
          
          </div>
          <!-- /.col-md-6 -->
          {{-- <div class="col-lg-6">
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
          </div> --}}
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

