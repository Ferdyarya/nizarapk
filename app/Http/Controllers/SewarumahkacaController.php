<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\Sewarumahkaca;
use App\Models\Masterrumahkaca;
use Illuminate\Support\Facades\DB;

class SewarumahkacaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $sewarumahkaca = Sewarumahkaca::where('namapenyewa', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $sewarumahkaca = Sewarumahkaca::paginate(10);
        }
        return view('sewarumahkaca.index',[
            'sewarumahkaca' => $sewarumahkaca
        ]);
    }


    public function create()
    {
        $masterrumahkaca = Masterrumahkaca::all();

        return view('sewarumahkaca.create', [
            'masterrumahkaca' => $masterrumahkaca,
        ]);
        return view('Sewarumahkaca.create')->with('success', 'Data Telah ditambahkan');
    }


    // return($request->all());
    public function store(Request $request)
{
    $data = $request->only([
        'id_masterrumahkaca',
        'namapenyewa',
        'keperluan',
        'tanggal_start',
        'tanggal_end'
    ]);


   if ($request->hasFile('buktibayar')) {
        $file = $request->file('buktibayar');

        if ($file->isValid()) {

            $fileName = time() . '_' . $file->getClientOriginalName();

            $filePath = $file->storeAs('public/buktibayar', $fileName);

            $data['buktibayar'] = 'buktibayar/' . $fileName;
        } else {
            return back()->withErrors(['buktibayar' => 'File tidak valid.']);
        }
    }


    Sewarumahkaca::create($data);


    return redirect()->route('sewarumahkaca.index')->with('success', 'Data Sewa Rumah Kaca berhasil ditambahkan');
}




    public function show($id)
    {

    }


    public function edit(Sewarumahkaca $sewarumahkaca)
    {
        $masterrumahkaca = Masterrumahkaca::all();

        return view('sewarumahkaca.edit', [
            'item' => $sewarumahkaca,
            'masterrumahkaca' => $masterrumahkaca,
        ]);
    }


    public function update(Request $request, Sewarumahkaca $sewarumahkaca)
    {
        $data = $request->all();

        $sewarumahkaca->update($data);

        //dd($data);

        return redirect()->route('sewarumahkaca.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Sewarumahkaca $sewarumahkaca)
    {
        $sewarumahkaca->delete();
        return redirect()->route('sewarumahkaca.index')->with('success', 'Data Telah dihapus');
    }

    public function sewarumahkacapdf() {
        $data = Sewarumahkaca::all();

        $pdf = PDF::loadview('sewarumahkaca/sewarumahkacapdf', ['sewarumahkaca' => $data]);
        return $pdf->download('laporan_sewarumahkaca.pdf');
    }

    // Laporan Buku Sewarumahkaca Filter
    public function cetakrumahkacapertanggal()
    {
        $Sewarumahkaca = Sewarumahkaca::Paginate(10);

        return view('laporannya.laporansewarumahkaca', ['laporansewarumahkaca' => $Sewarumahkaca]);
    }

    public function filterdaterumahkaca(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporansewarumahkaca = Sewarumahkaca::paginate(10);
        } else {
            $laporansewarumahkaca = Sewarumahkaca::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporannya.laporansewarumahkaca', compact('laporansewarumahkaca'));
    }


    public function laporansewarumahkacapdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporansewarumahkaca = Sewarumahkaca::all();
        } else {
            $laporansewarumahkaca = Sewarumahkaca::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporannya.laporansewarumahkacapdf', compact('laporansewarumahkaca'));
        return $pdf->download('laporan_laporansewarumahkaca.pdf');
    }

    // Report Pernama
    public function pernama(Request $request)
{
    $filter = $request->query('filter', 'all');

    $query = Sewarumahkaca::query();

    if ($filter && $filter !== 'all') {
        $query->where('namapenyewa', $filter);
    }

    $sewarumahkaca = $query->paginate(10);

    $namapenyewaCounts = Sewarumahkaca::select('namapenyewa', DB::raw('count(*) as count'))
        ->groupBy('namapenyewa')
        ->orderBy('namapenyewa')
        ->get();

    return view('laporannya.pernama', [
        'sewarumahkaca' => $sewarumahkaca,
        'namapenyewaCounts' => $namapenyewaCounts,
        'filter' => $filter,
    ]);
}




    // Fungsi untuk mencetak PDF
    public function cetakPernamaPdf(Request $request)
{
    $filter = $request->query('filter', 'all');

    $query = Sewarumahkaca::query();

    if ($filter && $filter !== 'all') {
        $query->where('namapenyewa', $filter);
    }

    $sewarumahkaca = $query->get();

    $namapenyewaCounts = Sewarumahkaca::select('namapenyewa', DB::raw('count(*) as count'))
        ->groupBy('namapenyewa')
        ->orderBy('namapenyewa')
        ->get();

    $pdf = PDF::loadView('laporannya.pernamapdf', [
        'sewarumahkaca' => $sewarumahkaca,
        'namapenyewaCounts' => $namapenyewaCounts,
        'filter' => $filter,
    ]);

    return $pdf->download('laporan_pernama.pdf');
}


// Perkategori rumah kaca
public function perkategori(Request $request)
{
    $filter = $request->query('filter', 'all');

    $query = DB::table('sewarumahkacas')
        ->join('masterrumahkacas', 'sewarumahkacas.id_masterrumahkaca', '=', 'masterrumahkacas.id')
        ->select('sewarumahkacas.*', 'masterrumahkacas.rmhkaca','masterrumahkacas.hargasewa');

    if ($filter !== 'all') {
        $query->where('masterrumahkacas.rmhkaca', $filter);
    }

    $sewarumahkaca = $query->paginate(10);

    // return($sewarumahkaca);

    // Query untuk mendapatkan jumlah per kategori
    $rmhkacaCounts = DB::table('sewarumahkacas')
        ->join('masterrumahkacas', 'sewarumahkacas.id_masterrumahkaca', '=', 'masterrumahkacas.id')
        ->select('masterrumahkacas.rmhkaca', DB::raw('COUNT(sewarumahkacas.id) as count'))
        ->groupBy('masterrumahkacas.rmhkaca')
        ->orderBy('masterrumahkacas.rmhkaca')
        ->get();

    return view('laporannya.perkategori', [
        'sewarumahkaca' => $sewarumahkaca,
        'rmhkacaCounts' => $rmhkacaCounts,
        'filter' => $filter,
    ]);
}


// Fungsi untuk mencetak PDF berdasarkan kategori
public function cetakPerkategoriPdf(Request $request)
{
    $filter = $request->query('filter', 'all');

    // Query untuk mengambil data berdasarkan filter
//    $query = Sewarumahkaca::query();

    $query = DB::table('sewarumahkacas')
    ->join('masterrumahkacas', 'sewarumahkacas.id_masterrumahkaca', '=', 'masterrumahkacas.id')
    ->select('sewarumahkacas.*', 'masterrumahkacas.rmhkaca','masterrumahkacas.hargasewa');

    if ($filter !== 'all') {
    $query->where('masterrumahkacas.rmhkaca', $filter);
    }

    // Ambil data tanpa paginasi untuk PDF
    $sewarumahkaca = $query->paginate(10);

    // Menghitung jumlah berdasarkan kategori (rmhkaca) dengan join
    $rmhkacaCounts = DB::table('sewarumahkacas')
        ->join('masterrumahkacas', 'sewarumahkacas.id_masterrumahkaca', '=', 'masterrumahkacas.id')
        ->select('masterrumahkacas.rmhkaca', DB::raw('COUNT(sewarumahkacas.id) as count'))
        ->groupBy('masterrumahkacas.rmhkaca')
        ->orderBy('masterrumahkacas.rmhkaca')
        ->get();

    // Generate PDF dengan data yang ada
    $pdf = PDF::loadView('laporannya.perkategoripdf', [
        'sewarumahkaca' => $sewarumahkaca,
        'rmhkacaCounts' => $rmhkacaCounts,
        'filter' => $filter,
    ]);

    // Mengunduh file PDF
    return $pdf->download('laporan_KategoriRumahkaca.pdf');
}








}
