<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masterrumahkaca;

class MasterrumahkacaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $masterrumahkaca = Masterrumahkaca::where('rmhkaca', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $masterrumahkaca = Masterrumahkaca::paginate(10);
        }
        return view('masterrumahkaca.index',[
            'masterrumahkaca' => $masterrumahkaca
        ]);
    }


    public function create()
    {
        return view('masterrumahkaca.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Masterrumahkaca::create($data);

        return redirect()->route('masterrumahkaca.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Masterrumahkaca $masterrumahkaca)
    {
        return view('masterrumahkaca.edit', [
            'item' => $masterrumahkaca
        ]);
    }


    public function update(Request $request, Masterrumahkaca $masterrumahkaca)
    {
        $data = $request->all();

        $masterrumahkaca->update($data);

        //dd($data);

        return redirect()->route('masterrumahkaca.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Masterrumahkaca $masterrumahkaca)
    {
        $masterrumahkaca->delete();
        return redirect()->route('masterrumahkaca.index')->with('success', 'Data Telah dihapus');
    }

    // public function masterrumahkacapdf() {
    //     $data = Masterrumahkaca::all();

    //     $pdf = PDF::loadview('masterrumahkaca/masterrumahkacapdf', ['masterrumahkaca' => $data]);
    //     return $pdf->download('laporan_masterrumahkaca.pdf');
    // }
}
