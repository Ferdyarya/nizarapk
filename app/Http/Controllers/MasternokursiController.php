<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masternokursi;

class MasternokursiController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $masternokursi = Masternokursi::where('nokursi', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $masternokursi = Masternokursi::paginate(10);
        }
        return view('masternokursi.index',[
            'masternokursi' => $masternokursi
        ]);
    }


    public function create()
    {
        return view('masternokursi.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Masternokursi::create($data);

        return redirect()->route('masternokursi.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Masternokursi $masternokursi)
    {
        return view('masternokursi.edit', [
            'item' => $masternokursi
        ]);
    }


    public function update(Request $request, Masternokursi $masternokursi)
    {
        $data = $request->all();

        $masternokursi->update($data);

        //dd($data);

        return redirect()->route('masternokursi.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Masternokursi $masternokursi)
    {
        $masternokursi->delete();
        return redirect()->route('masternokursi.index')->with('success', 'Data Telah dihapus');
    }
}
