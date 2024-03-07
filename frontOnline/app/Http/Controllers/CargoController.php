<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cargos = Cargo::all();

        return view('cargos.index')->with([
            'cargos'  => $cargos,
            'message' => '',
            'error' => '',
        ]);
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
        $nombre = $request->input('nombre');

        $cargo = Cargo::create(
            [
                'nombre' => $request->input('nombre'),
                'estado' => 'A'
            ]
        );

        return redirect("/cargos/".$cargo->id."/agregarTarifa")->with(['message' => 'Cargo agregado correctamente, ahora ingresa las tarifas']);
    }

    public function agregarTarifaView($id)
    {
        $cargo = Cargo::find($id);

        return view('cargos.agregarTarifa')->with([
            'cargo'  => $cargo,
            'message' => '',
            'error' => '',
        ]);
    }

    public function agregarTarifa(Request $request)
    {
        $cargo = Cargo::find($request->input('cargo_id'));
        
        $tarifa = Tarifa::create([
            'cargo_id' => $cargo->id,
            'valor' => $request->input('valor'),
            'hora' => $request->input('hora'),
            'estado' => "A"
        ]);
        $cargo->tarifas()->save($tarifa);
        $cargo->load('tarifas');    

        return view('cargos.tarifas')->with([
            'cargo'  => $cargo
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cargo = Cargo::find($id);

        return view('cargos.update')->with([
            'message'  => "",
            'error'  => "",
            'cargo'  => $cargo,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $cargo = Cargo::find($id);
        
        $cargo->nombre = $request->input('nombre_cargo');
        $cargo->save();
        
        $cargos = Cargo::all();

        return view('cargos.index')->with([
            'cargos'  => $cargos,
            'message' => 'Cargo editado correctamente',
            'error' => '',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        //
    }
}
