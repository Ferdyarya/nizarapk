<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masterderetkursi;

class MasterderetController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $masterderetkursikursi = Masterderetkursi::where('deret', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $masterderetkursi = Masterderetkursi::paginate(10);
        }
        return view('masterderetkursi.index',[
            'masterderetkursi' => $masterderetkursi
        ]);
    }


    public function create()
    {
        return view('masterderetkursi.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Masterderetkursi::create($data);

        return redirect()->route('masterderetkursi.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Masterderetkursi $masterderetkursi)
    {
        return view('masterderetkursi.edit', [
            'item' => $masterderetkursi
        ]);
    }


    public function update(Request $request, Masterderetkursi $masterderetkursi)
    {
        $data = $request->all();

        $masterderetkursi->update($data);

        //dd($data);

        return redirect()->route('masterderetkursi.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Masterderetkursi $masterderetkursi)
    {
        $masterderetkursi->delete();
        return redirect()->route('masterderetkursi.index')->with('success', 'Data Telah dihapus');
    }
}
