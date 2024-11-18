@extends('layout.admin')

@section('content')

<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

<!-- Select2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

<title>Sewa Data Rumah Kaca</title>

<body>
    <div class="container-fluid">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body">
                <h1 class="text-center mb-4">Tambah Data Sewa Rumah Kaca</h1>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <div class="card" style="border-radius: 10px;">
                                <div class="card-body">
                                    <form method="POST" action="{{ route('sewarumahkaca.store') }}" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Kategori Rumah Kaca (Select2 Dropdown) -->
                                        <div class="form-group">
                                            <label for="rumahkaca">Pilih Rumah Kaca</label>
                                            <select class="form-select" name="id_masterrumahkaca" id="rumahkaca" style="border-radius: 8px;" required>
                                                <option value="">Pilih Rumah Kaca</option>
                                                @foreach ($masterrumahkaca as $kategori)
                                                    <option value="{{ $kategori->id }}" @if(old('id_masterrumahkaca') == $kategori->id) selected @endif>
                                                        {{ $kategori->rmhkaca }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('id_masterrumahkaca')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Nama Penyewa -->
                                        <div class="form-group">
                                            <label for="namapenyewa">Nama Penyewa</label>
                                            <input type="text" name="namapenyewa" class="form-control @error('namapenyewa') is-invalid @enderror" id="namapenyewa" placeholder="Masukkan Nama Penyewa" value="{{ old('namapenyewa') }}" required>
                                            @error('namapenyewa')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Keperluan -->
                                        <div class="form-group">
                                            <label for="keperluan">Keperluan</label>
                                            <input type="text" name="keperluan" class="form-control @error('keperluan') is-invalid @enderror" id="keperluan" placeholder="Masukkan Keperluan" value="{{ old('keperluan') }}" required>
                                            @error('keperluan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tanggal Sewa (Range) -->
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal Sewa (Range)</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input type="date" name="tanggal_start" class="form-control @error('tanggal_start') is-invalid @enderror" id="tanggal_start" value="{{ old('tanggal_start') }}" required>
                                                    @error('tanggal_start')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="date" name="tanggal_end" class="form-control @error('tanggal_end') is-invalid @enderror" id="tanggal_end" value="{{ old('tanggal_end') }}" required>
                                                    @error('tanggal_end')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bukti Pembayaran (File Upload) -->
                                        <div class="form-group">
                                            <label for="buktibayar">Bukti Pembayaran</label>
                                            <input type="file" name="buktibayar" class="form-control @error('buktibayar') is-invalid @enderror" id="buktibayar">
                                            @error('buktibayar')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#rumahkaca').select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: 'Pilih Rumah Kaca'
        });
    });
</script>

@endsection
