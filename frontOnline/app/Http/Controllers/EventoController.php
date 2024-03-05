<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Zona;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $eventos = Evento::all();

        return view('eventos.index')->with([
            'eventos'  => $eventos,
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
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        $fechaInicioCarbon = Carbon::parse($fechaInicio);
        $fechaFinCanbon = Carbon::parse($fechaFin);
        $diferenciaEnDias = $fechaInicioCarbon->diffInDays($fechaFinCanbon)+1;

        $evento = Evento::create(
            [
                'nombre' => $request->input('nombre'),
                'fecha_inicio' => $fechaInicio,
                'fecha_fin' => $fechaFin,
                'dias' => $diferenciaEnDias,
                'estado' => 'A'
            ]
        );

        return redirect("/eventos/".$evento->id."/agregarZona")->with(['message' => 'Evento agregado correctamente, ahora ingresa las zonas']);
    }
    public function agregarZonaView($id)
    {
        $evento = Evento::find($id);

        return view('eventos.agregarZona')->with([
            'evento'  => $evento,
            'message' => '',
            'error' => '',
        ]);
    }

    public function agregarZona(Request $request)
    {
        $evento = Evento::find($request->input('evento_id'));
        
        // dd($evento);name="evento_id"
        $zona =  Zona::create([
            'evento_id' => $evento->id,
            'nombre' => $request->input('nombre'),
            'estado' => "A"
        ]);

        $evento->zonas->add($zona);

        $evento->save();
        return "ok";
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
