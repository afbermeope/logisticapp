<?php

namespace App\Http\Controllers;

use App\Models\Tarifa;
use App\Models\Cargo;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarifa $tarifa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarifa $tarifa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarifa $tarifa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarifa  $tarifa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $cargo_id = $request->get("cargo_id");  
        $tarifa = Tarifa::find($id);
        $tarifa->delete();
        $cargo = Cargo::find($cargo_id);
        
        return view('cargos.tarifas')->with([
            'cargo'  => $cargo
        ]);
    }
}
