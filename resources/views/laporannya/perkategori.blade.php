@extends('layout.admin')
@push('css')
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h3 class="m-0">Data Lap Kategori Rumah Kaca</h3>
                            </div><!-- /.col -->
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Data Lap Kategori Rumah Kaca</li>
                                </ol>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div>

                    {{-- CRUD --}}
                    <!-- Required meta tags -->
                    {{--
              <meta charset="utf-8" />
              <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" /> --}}



              <div class="container">
                <form action="{{ route('perkategori') }}" method="GET" class="row align-items-center">
                    <div class="col-md-8 mb-2">
                        <div class="form-group">
                            <label for="filter" class="sr-only">Filter</label>
                            <select name="filter" id="filter" class="form-control">
                                <option value="all" {{ $filter === 'all' ? 'selected' : '' }}>SHOW ALL</option>
                                @forelse ($rmhkacaCounts as $item)
                                    <option value="{{ $item->rmhkaca }}" {{ $item->rmhkaca == $filter ? 'selected' : '' }}>
                                        {{ strtoupper($item->rmhkaca) }}
                                    </option>
                                @empty
                                    <option value="" disabled>Data Tidak Tersedia</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </div>

                    <div class="col-md-2 mb-2">
                        <a href="{{ route('perkategoripdf', ['filter' => $filter ?: 'all']) }}" class="btn btn-danger btn-block">
                            Export PDF
                        </a>
                    </div>
                </form>
            </div>


                    <div>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th class="px-6 py-2">No</th>
                                <th class="px-6 py-2">Kategori Rumah</th>
                                <th class="px-6 py-2">Harga Seminggu Sewa</th>
                                <th class="px-6 py-2">Nama Penyewa</th>
                                <th class="px-6 py-2">Keperluan</th>
                                <th class="px-6 py-2">Tanggal Mulai</th>
                                <th class="px-6 py-2">Tanggal Berakhir</th>
                                <th class="px-6 py-2">Bukti Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @php
                              $no=1;
                              @endphp --}}
                                @foreach ($sewarumahkaca as $index => $item)
                                    <tr>
                                        <td class="px-6 py-6">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-2">{{ $item->rmhkaca }}</td>
                                        <td class="px-6 py-2">Rp. {{ number_format($item->hargasewa) }}</td>
                                        <td class="px-6 py-2">{{ $item->namapenyewa }}</td>
                                        <td class="px-6 py-2">{{ $item->keperluan }}</td>
                                        <td class="px-6 py-2" name="tanggal_start">
                                            @if($item->tanggal_start && $item->tanggal_end)
                                                {{ \Carbon\Carbon::parse($item->tanggal_start)->format('d-m-Y') }}
                                            @else
                                                <span class="badge badge-warning">Tanggal tidak valid</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-2" name="tanggal_end">
                                            @if($item->tanggal_start && $item->tanggal_end)
                                                {{ \Carbon\Carbon::parse($item->tanggal_end)->format('d-m-Y') }}
                                            @else
                                                <span class="badge badge-warning">Tanggal tidak valid</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-2">
                                            @if ($item->buktibayar)
                                                <a href="{{ asset('storage/'.$item->buktibayar) }}" target="_blank" class="btn btn-warning btn-sm">Lihat Bukti</a>
                                            @else
                                                <span class="badge badge-warning">Tidak ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $sewarumahkaca->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <!-- Optional JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif
    </script>
@endpush
