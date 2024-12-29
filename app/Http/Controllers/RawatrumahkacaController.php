<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rawatrumahkaca;
use App\Models\Masterrumahkaca;

class RawatrumahkacaController extends Controller
{
    public function index(Request $request)
{
    if ($request->has('search')) {
        $rawatrumahkaca = Rawatrumahkaca::whereHas('masterrumahkaca', function($query) use ($request) {
            $query->where('rmhkaca', 'LIKE', '%' . $request->search . '%');
        })->paginate(10);
    } else {
        $rawatrumahkaca = Rawatrumahkaca::paginate(10);
    }

    return view('rawatrumahkaca.index', [
        'rawatrumahkaca' => $rawatrumahkaca
    ]);
}


    public function create()
{
    $masterrumahkaca = Masterrumahkaca::all();

    return view('rawatrumahkaca.create', [
        'masterrumahkaca' => $masterrumahkaca,
    ]);
}

public function store(Request $request)
{
    // Validasi permintaan
    $request->validate([
        'id_masterrumahkaca' => 'required|string',
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string',
        'keperluandana' => 'required|numeric',
    ]);

    $data = $request->all();

    // dd($data);

    Rawatrumahkaca::create($data);

    return redirect()->route('rawatrumahkaca.index')->with('success', 'Data telah ditambahkan');
}



    public function show($id)
    {

    }


    public function edit(Rawatrumahkaca $rawatrumahkaca)
    {
        $masterrumahkaca = Masterrumahkaca::all();

        return view('rawatrumahkaca.edit', [
            'item' => $rawatrumahkaca,
            'masterrumahkaca' => $masterrumahkaca,
        ]);
    }


    public function update(Request $request, Rawatrumahkaca $rawatrumahkaca)
    {
        $data = $request->all();

        $rawatrumahkaca->update($data);

        //dd($data);

        return redirect()->route('rawatrumahkaca.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Rawatrumahkaca $rawatrumahkaca)
    {
        $rawatrumahkaca->delete();
        return redirect()->route('rawatrumahkaca.index')->with('success', 'Data Telah dihapus');
    }

    //Approval Status
    public function updateStatus(Request $request, $id)
{
    // Validate the incoming request to ensure a valid status is selected
    $validated = $request->validate([
        'status' => 'required|in:Terverifikasi,Ditolak',
    ]);

    // Find the rawatrumahkaca entry by ID
    $rawatrumahkaca = Rawatrumahkaca::findOrFail($id);

    // Update the status based on the form input
    $rawatrumahkaca->status = $validated['status'];
    $rawatrumahkaca->save();

    // Redirect back to the suratmasuk page with a success message
    return redirect()->route('rawatrumahkaca.index')->with('success', 'Status surat berhasil diperbarui.');


}













    //Report
    //  Laporan Buku rawatrumahkaca Filter
     public function cetakbarangpertanggal()
     {
         $rawatrumahkaca = rawatrumahkaca::Paginate(10);

         return view('laporannya.laporanrawatrumahkaca', ['laporanrawatrumahkaca' => $rawatrumahkaca]);
     }

     public function filterdatebarang(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporanrawatrumahkaca = rawatrumahkaca::paginate(10);
         } else {
             $laporanrawatrumahkaca = rawatrumahkaca::whereDate('tglterima','>=',$startDate)
                                         ->whereDate('tglterima','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporanrawatrumahkaca', compact('laporanrawatrumahkaca'));
     }


     public function laporanrawatrumahkacapdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporanrawatrumahkaca = rawatrumahkaca::all();
         } else {
             $laporanrawatrumahkaca = rawatrumahkaca::whereDate('tglterima', '>=', $startDate)
                                             ->whereDate('tglterima', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporanrawatrumahkacapdf', compact('laporanrawatrumahkaca'));
         return $pdf->download('laporan_laporanrawatrumahkaca.pdf');
     }
}
