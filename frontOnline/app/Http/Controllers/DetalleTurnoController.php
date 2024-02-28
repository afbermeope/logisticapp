<?php

namespace App\Http\Controllers;

use App\Models\DetalleTurno;
use App\Models\Persona;
use Illuminate\Http\Request;

class DetalleTurnoController extends Controller
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
         //
         $id_usuario = $request->input("id_usuario");
         $persona = Persona::where('cedula', $id_usuario)->first();
         if($persona){
             return "bienvenido ".$persona->nombre;
         }else{
             return "no encontrado";
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DetalleTurno  $detalleTurno
     * @return \Illuminate\Http\Response
     */
    public function show(DetalleTurno $detalleTurno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DetalleTurno  $detalleTurno
     * @return \Illuminate\Http\Response
     */
    public function edit(DetalleTurno $detalleTurno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DetalleTurno  $detalleTurno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DetalleTurno $detalleTurno)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DetalleTurno  $detalleTurno
     * @return \Illuminate\Http\Response
     */
    public function destroy(DetalleTurno $detalleTurno)
    {
        //
    }
}
