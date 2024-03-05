<?php

namespace App\Http\Controllers;
use App\Models\Tarifa;
use App\Models\Cargo;
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
        // Obtener todos los cargos
        $cargos = Cargo::all();
        
        // Retornar la vista index de cargos con los datos
        return view('cargos.index', compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retornar la vista para crear un nuevo cargo
        return view('cargos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            
        ]);
        
        // Crear un nuevo cargo con los datos recibidos
        $cargo = Cargo::create([
            'nombre' => $request->nombre,
            'estado' => 'A',
        ]);
        
        // Redirigir a la lista de cargos con un mensaje de éxito
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
        $hora = $request->input('hora');
        $valor = $request->input('valor');

        $cargo = Cargo::find($request->input('cargo_id'));
        
        $tarifa =  Tarifa::create([
            'hora'  => $hora,
            'valor'  => $valor,
            'cargo_id'  => $cargo->id,
            'estado' => "A",
        ]);

        $cargo->tarifas()->save($tarifa);
        $cargo->load('tarifas');    

        dd(
            "ee"
        );
        // return view('cargos.tarifas')->with([
        //     'cargo'  => $cargo
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Cargo $cargo)
    {
        // Retornar la vista para editar un cargo específico
        return view('cargos.edit', compact('cargo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cargo $cargo)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);
        
        // Actualizar el cargo con los datos recibidos
        $cargo->update([
            'nombre' => $request->nombre,
        ]);
        
        // Redirigir a la lista de cargos con un mensaje de éxito
        return redirect()->route('cargos.index')->with('success', 'Cargo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cargo  $cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cargo $cargo)
    {
        // Eliminar el cargo
        $cargo->delete();
        
        // Redirigir a la lista de cargos con un mensaje de éxito
        return redirect()->route('cargos.index')->with('success', 'Cargo eliminado correctamente.');
    }
}
