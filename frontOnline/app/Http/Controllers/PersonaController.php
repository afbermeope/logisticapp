<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::all();

        return view('personas.index')->with([
            'personas'  => $personas,
            'message'  => "",
            'error'  => "",
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
        $nombre = $request->input('nombre');
        $cedula = $request->input('cedula');
        $telefono = $request->input('telefono');
        $email = $request->input('email');

        $persona = Persona::create(
            [
                'nombre' => $nombre,
                'cedula' => $cedula,
                'telefono' => $telefono,
                'email' => $email,
                'estado' => 'A'
            ]
        );

        $personas = Persona::all();

        return view('personas.index')->with([
            'personas'  => $personas,
            'message'  => "Persona agregada correctamente",
            'error'  => "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);
        
        return view('personas.update')->with([
            'message'  => "",
            'error'  => "",
            'persona'  => $persona,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,  $id)
    {

        $persona = Persona::find($id);

        $nombre = $request->input('nombre');
        $cedula = $request->input('cedula');
        $telefono = $request->input('telefono');
        $correo = $request->input('correo');

        $persona->nombre = $nombre;
        $persona->cedula = $cedula;
        $persona->telefono = $telefono;
        $persona->correo = $correo;
        $persona->save();
        
        $personas = Persona::all();

        return view('personas.index')->with([
            'personas'  => $personas,
            'message' => 'Persona editada correctamente',
            'error' => '',
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
