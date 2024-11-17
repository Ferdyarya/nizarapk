@extends('layout.admin')
@push('css')
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <h1 class="m-0">Data Surat Pusat</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                <li class="breadcrumb-item active">Data Surat Pusat</li>
                            </ol>
                        </div>
                    </div>
            </div>

            <div class="container">
                {{-- search --}}
                <div class="row g-3 align-items-center mb-4">
                    <div class="col-auto">
                        <form action="suratpusat" method="GET">
                            <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                        </form>
                    </div>
                    {{-- Button Export PDF --}}
                    <div class="col-auto">
                        <a href="{{ route('suratpusat.create')}}" class="btn btn-success">
                            Tambah Data
                        </a>
                    </div>
                </div>
                <div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="px-6 py-2">No</th>
                                <th class="px-6 py-2">Kode Surat</th>
                                <th class="px-6 py-2">Asal Surat</th>
                                <th class="px-6 py-2">Tujuan Surat</th>
                                <th class="px-6 py-2">Tentang Surat</th>
                                <th class="px-6 py-2">Klasifikasi</th>
                                <th class="px-6 py-2">File Surat</th>
                                <th class="px-6 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no=1;
                            @endphp
                            @foreach ($suratpusat as $index => $item)
                            <tr>
                                <th class="px-6 py-2">{{ $index + $suratpusat->firstItem() }}</th>
                                <td class="px-6 py-2">
                                    {{ $item->kodesurat }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $item->asalsurat }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $item->tujuan_surat }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $item->tentangsurat }}
                                </td>
                                <td class="px-6 py-2">
                                    {{ $item->klasifikasi }}
                                </td>
                                <td class="border textmid">
                                    @if($item->filesurat) <!-- Periksa nama kolom yang sesuai -->
                                        <a href="{{ asset('filesurat/' . $item->filesurat) }}" class="btn btn-primary" download>
                                            Download
                                        </a>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('suratpusat.edit', $item->id)}}" class="btn btn-primary">
                                        Edit
                                    </a>
                                    <form action="{{ route('suratpusat.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $suratpusat->links() }}
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>




@endsection

@push('scripts')
<!-- Optional JavaScript -->
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
    @if(Session::has('success'))
toastr.success("{{ Session::get('success')}}")
@endif
</script>
@endpush
