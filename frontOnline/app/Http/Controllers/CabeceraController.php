<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Cabecera;
use App\Models\Cargo;
use App\Models\Persona;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CabeceraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabeceras = Cabecera::where('estado','A')->get();
        $eventos = Evento::where('estado','A')->get();
        $personas = Persona::where('estado','A')->get();
        $cargos = Cargo::where('estado','A')->get();

        return view('cabeceras.index')->with([
            'cabeceras'  => $cabeceras,
            'eventos'  => $eventos,
            'personas'  => $personas,
            'cargos'  => $cargos,
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
        $persona_id = $request->input('persona_id');
        $evento_id = $request->input('evento_id');
        $zona_id = $request->input('zona_id');
        $cargo_id = $request->input('cargo_id');
        $tarifa_id = $request->input('tarifa_id');
        $hora_inicio = $request->input('hora_inicio');
        $hora_fin = $request->input('hora_fin');
        // Crea instancias de Carbon para las horas de inicio y fin
        $carbonInicio = Carbon::createFromFormat('H:i', $hora_inicio);
        $carbonFin = Carbon::createFromFormat('H:i', $hora_fin);
        // Calcula la diferencia en horas
        $diferenciaHoras = $carbonInicio->diffInHours($carbonFin);

        $cabecera = Cabecera::create([
            "persona_id" => $persona_id,
            "zona_id" => $zona_id,
            "tarifa_id" => $tarifa_id,
            "horario" => $hora_inicio."-".$hora_fin ,
            "cantidad_horas" => $diferenciaHoras,
            "estado" => "A",
        ]);

        $cabeceras = Cabecera::where('estado','A')->get();
        $eventos = Evento::where('estado','A')->get();
        $personas = Persona::where('estado','A')->get();
        $cargos = Cargo::where('estado','A')->get();

        return view('cabeceras.index')->with([
            'cabeceras'  => $cabeceras,
            'eventos'  => $eventos,
            'personas'  => $personas,
            'cargos'  => $cargos,
            'message'  => "Cabecera agregada correctamente",
            'error'  => "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cabecera  $cabecera
     * @return \Illuminate\Http\Response
     */
    public function show(Cabecera $cabecera)
    {
        
    }

    public function registrarMovimientoView($evento_id)
    {
        return view('movimientos.registrar')->with([
            'message'  => "",
            'error'  => "",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cabecera  $cabecera
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cabecera = Cabecera::find($id);
        $eventos = Evento::where('estado','A')->get();
        $personas = Persona::where('estado','A')->get();
        $cargos = Cargo::where('estado','A')->get();

        return view('cabeceras.update')->with([
            'cabecera'  => $cabecera,
            'eventos'  => $eventos,
            'personas'  => $personas,
            'cargos'  => $cargos,
            'message'  => "",
            'error'  => "",
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cabecera  $cabecera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $cabecera = Cabecera::find($id);

        $persona_id = $request->input('persona_id');
        $zona_id = $request->input('zona_id');
        $tarifa_id = $request->input('tarifa_id');
        $hora_inicio = $request->input('hora_inicio');
        $hora_fin = $request->input('hora_fin');
        // Crea instancias de Carbon para las horas de inicio y fin
        $carbonInicio = Carbon::createFromFormat('H:i', $hora_inicio);
        $carbonFin = Carbon::createFromFormat('H:i', $hora_fin);
        // Calcula la diferencia en horas
        $diferenciaHoras = $carbonInicio->diffInHours($carbonFin);

        $cabecera->persona_id = $persona_id;
        $cabecera->zona_id = $zona_id;
        $cabecera->tarifa_id = $tarifa_id;
        $cabecera->horario = $hora_inicio."-".$hora_fin;
        $cabecera->cantidad_horas = $diferenciaHoras;
        $cabecera->save();
        
        $cabeceras = Cabecera::where('estado','A')->get();
        $eventos = Evento::where('estado','A')->get();
        $personas = Persona::where('estado','A')->get();
        $cargos = Cargo::where('estado','A')->get();

        return view('cabeceras.index')->with([
            'cabeceras'  => $cabeceras,
            'eventos'  => $eventos,
            'personas'  => $personas,
            'cargos'  => $cargos,
            'message'  => "Cabecera editada correctamente",
            'error'  => "",
        ]);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cabecera  $cabecera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cabecera $cabecera)
    {
        //
    }

    public function agregarMovimiento(Request $request)
    {
        $cedula = $request->get('');
        $chaleco = $request->get('');
        $gorro = $request->get('');
        $otro = $request->get('');


        return "";
    }
}
