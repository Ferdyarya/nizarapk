<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sewarumahkaca;
use App\Models\Masterrumahkaca;
use PDF;

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
    public function cetakbarangpertanggal()
    {
        $Sewarumahkaca = Sewarumahkaca::Paginate(10);

        return view('laporannya.laporansewarumahkaca', ['laporansewarumahkaca' => $Sewarumahkaca]);
    }

    public function filterdatebarang(Request $request)
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
}
