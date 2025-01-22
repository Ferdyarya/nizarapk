@extends('layout.admin')

@section('content')
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
      data-sidebar-position="fixed" data-header-position="fixed">

      <div class="container-fluid">
        <!-- Row 1: Dashboard Cards -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="card-title"><b>Laporan Hari Ini</b></h3>
                        {{-- {{ $dateNow->format('d F Y') }} --}}
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6 col-md-3">
                                <h4 class="text-black"><b>Jumlah Penyewa</b></h4>
                                <h3>{{$penyewacount}}</h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <h4 class="text-black"><b>Jumlah Rumah Kaca</b></h4>
                                <h3>{{$totalrumahcount}}</h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <h4 class="text-black"><b>Jumlah Pembangunan</b></h4>
                                <h3>{{$pembangunancount}}</h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <h4 class="text-black"><b>Jumlah Perawatan Rumah</b></h4>
                                <h3>{{$perawatancount}}</h3>
                            </div>
                        </div>
                        {{-- <div class="row text-center mt-4">

                            <div class="col-6 col-md-3">
                                <h4 class="text-dark"><b>Permohonan Surat</b></h4>
                                <h3>/</h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <h4 class="text-primary"><b>Surat Ditolak</b></h4>
                                <h3>/</h3>
                            </div>
                            <div class="col-6 col-md-3">
                                <h4 class="text-secondary"><b>Surat Terverifikasi</b></h4>
                                <h3>/</h3>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Row 2: Images of Rumah Kaca, Kasa, and Kawat -->
        <div class="row mt-4">
            <!-- Rumah Kaca -->
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card">
                    <img src="assets/rumahkaca.jpg" class="card-img-top" width="140px" alt="Rumah Kaca">
                    <div class="card-body text-center">
                        <h4>Rumah Kaca</h4>
                    </div>
                </div>
            </div>

            <!-- Rumah Kasa -->
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card">
                    <img src="assets/rumahkaca.jpg" class="card-img-top" alt="Rumah Kasa">
                    <div class="card-body text-center">
                        <h4>Rumah Kasa</h4>
                    </div>
                </div>
            </div>
            <!-- Rumah Kawat -->
            <div class="col-lg-4 col-sm-12 mb-4">
                <div class="card">
                    <img src="assets/rumahkaca.jpg" class="card-img-top" alt="Rumah Kawat">
                    <div class="card-body text-center">
                        <h4>Rumah Kawat</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
