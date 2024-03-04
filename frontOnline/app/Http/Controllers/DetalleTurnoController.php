<?php

namespace App\Http\Controllers;

use App\Models\DetalleTurno;
use App\Models\Persona;
use App\Models\Movimiento;
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
        $cedula = $request->input("cedula");
        $elementos = $request->input("elementos");
        $alimento = $request->input("alimento");
        $persona = Persona::where('cedula', $cedula)->first();
        
        // dd($persona);
        //TODO el usuario va ligado a un detallecabecera
        if($persona){

            //validar si existe un movimiento previo
            $movimientoPrevio = Movimiento::where('descripcion', 'checkin')
                ->where('estado', 'A')
                ->first();
            if($movimientoPrevio){
                Movimiento::create([
                    'descripcion' => 'checkout',
                    'detalle_turno_id' => 1,
                    'estado' => 'A'
                ]);
    
            }else{
                Movimiento::create([
                    'descripcion' => 'checkin',
                    'detalle_turno_id' => 1,
                    'estado' => 'A'
                ]);
            }
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
