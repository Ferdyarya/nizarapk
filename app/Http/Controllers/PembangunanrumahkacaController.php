<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Masterpegawai;
use App\Models\Pembangunanrumahkaca;

class PembangunanrumahkacaController extends Controller
{
    public function index(Request $request)
{
    if($request->has('search')){
        $pembangunanrumahkaca = Pembangunanrumahkaca::where('namapenyewa', 'LIKE', '%' .$request->search.'%')->paginate(10);
    }else{
        $pembangunanrumahkaca = Pembangunanrumahkaca::paginate(10);
    }
    return view('pembangunanrumahkaca.index',[
        'pembangunanrumahkaca' => $pembangunanrumahkaca
    ]);
}


    public function create()
{
    $masterpegawai = Masterpegawai::all();

    return view('pembangunanrumahkaca.create', [
        'masterpegawai' => $masterpegawai,
    ]);
}

public function store(Request $request)
{
    // Validasi permintaan
    $request->validate([
        'id_masterpegawai' => 'required|string',
        'tanggal' => 'required|date',
        'deskripsi' => 'required|string',
        'namarumah' => 'required|string',
        'keperluandana' => 'required|numeric',
    ]);

    $data = $request->all();

    // dd($data);

    pembangunanrumahkaca::create($data);

    return redirect()->route('pembangunanrumahkaca.index')->with('success', 'Data telah ditambahkan');
}



    public function show($id)
    {

    }


    public function edit(pembangunanrumahkaca $pembangunanrumahkaca)
    {
        $masterpegawai = Masterpegawai::all();

        return view('pembangunanrumahkaca.edit', [
            'item' => $pembangunanrumahkaca,
            'masterpegawai' => $masterpegawai,
        ]);
    }


    public function update(Request $request, pembangunanrumahkaca $pembangunanrumahkaca)
    {
        $data = $request->all();

        $pembangunanrumahkaca->update($data);

        //dd($data);

        return redirect()->route('pembangunanrumahkaca.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(pembangunanrumahkaca $pembangunanrumahkaca)
    {
        $pembangunanrumahkaca->delete();
        return redirect()->route('pembangunanrumahkaca.index')->with('success', 'Data Telah dihapus');
    }

    //Approval Status
    public function updateStatus(Request $request, $id)
{
    // Validate the incoming request to ensure a valid status is selected
    $validated = $request->validate([
        'status' => 'required|in:Terverifikasi,Ditolak',
    ]);

    // Find the pembangunanrumahkaca entry by ID
    $pembangunanrumahkaca = pembangunanrumahkaca::findOrFail($id);

    // Update the status based on the form input
    $pembangunanrumahkaca->status = $validated['status'];
    $pembangunanrumahkaca->save();

    // Redirect back to the suratmasuk page with a success message
    return redirect()->route('pembangunanrumahkaca.index')->with('success', 'Status surat berhasil diperbarui.');


}













    //Report
    //  Laporan Buku pembangunanrumahkaca Filter
     public function cetakpembangunanpertanggal()
     {
         $pembangunanrumahkaca = pembangunanrumahkaca::Paginate(10);

         return view('laporannya.laporanpembangunanrumahkaca', ['laporanpembangunanrumahkaca' => $pembangunanrumahkaca]);
     }

     public function filterdatepembangunan(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporanpembangunanrumahkaca = pembangunanrumahkaca::paginate(10);
         } else {
             $laporanpembangunanrumahkaca = pembangunanrumahkaca::whereDate('tglterima','>=',$startDate)
                                         ->whereDate('tglterima','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporanpembangunanrumahkaca', compact('laporanpembangunanrumahkaca'));
     }


     public function laporanpembangunanrumahkacapdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporanpembangunanrumahkaca = pembangunanrumahkaca::all();
         } else {
             $laporanpembangunanrumahkaca = pembangunanrumahkaca::whereDate('tglterima', '>=', $startDate)
                                             ->whereDate('tglterima', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporanpembangunanrumahkacapdf', compact('laporanpembangunanrumahkaca'));
         return $pdf->download('laporan_laporanpembangunanrumahkaca.pdf');
     }
}
