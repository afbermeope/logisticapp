<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Cabecera;
use App\Models\Cargo;
use App\Models\Persona;
use App\Models\Zona;
use App\Models\DetalleTurno;
use App\Models\Movimiento;
use App\Models\Elemento;
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
            'evento_id'  => $evento_id,
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
        $cedula = $request->get('codigoBarras');
        $evento_id = $request->get('evento_id');        
        try {
            //remuevo el resto de la carreta
            $cedula = substr($cedula, 0, 10);
            $persona = Persona::where('cedula', $cedula)->first();
            $zona = Zona::where('evento_id', $evento_id)->first();
            
            $cabecera = Cabecera::where('zona_id', '=', $zona->id)
            ->where('persona_id', '=', $persona->id)
            ->where('estado', '=', 'A')
            ->first();
            
            if ($cabecera === null) {
                return view('cabeceras.elementoRespuesta')->with([
                    'mensaje'  => "Persona no encontrada en el evento: ".$zona->evento->nombre,
                ]);
            } else {

                $fechaServidor = Carbon::now('America/Bogota')->toDateString(); // Obtén la fecha actual del servidor y ajusta la zona horaria
                $fechaServidor = Carbon::parse($fechaServidor);
                $fechaInicioEvento = Carbon::parse($zona->evento->fecha_inicio);
                $fechaFinEvento = Carbon::parse($zona->evento->fecha_fin);
                // Verifica si la fecha del servidor está dentro del rango del evento
                if ($fechaServidor->between($fechaInicioEvento, $fechaFinEvento) || ($fechaInicioEvento->toDateString() == $fechaServidor->toDateString()) ) {
                    // Estamos dentro del evento
                    $diasTranscurridos = $fechaInicioEvento->diffInDays($fechaServidor)+1;
                    
                    //Validar si ya hay un detalle turno con este dia
                    $findDetalleTurno = DetalleTurno::where('estado','A')
                    ->where('cabecera_id', $cabecera->id)
                    ->where('numero_dia', $diasTranscurridos)
                    ->first();
                    
                    if($findDetalleTurno === null){
                        //si no crearlo
                        $detalleTurno = DetalleTurno::create([
                            'estado' => 'A',
                            'cabecera_id' => $cabecera->id,
                            'numero_dia' => $diasTranscurridos
                        ]);

                        //Crear primer movimiento
                        $movimiento = Movimiento::create([
                            "descripcion" => 'checkin',
                            "estado" => 'A',
                            "detalle_turno_id" => $detalleTurno->id,
                        ]);

                        return view('cabeceras.agregarElemento')->with([
                            'movimiento'  => $movimiento,
                            'persona'  => $persona,
                            'elementos'  => null,
                            'message'  => "",
                            'error'  => "",
                        ]);

                    }else{
                        //validar que exista checkin
                        $findMovimiento = Movimiento::where('descripcion', 'checkin')
                        ->where('estado', 'A')
                        ->where('detalle_turno_id', $findDetalleTurno->id)
                        ->first();

                        if($findMovimiento != null ){

                            //validar que exista checkout
                            $movimientoCheckout = Movimiento::where('descripcion', 'checkout')
                            ->where('estado', 'A')
                            ->where('detalle_turno_id', $findDetalleTurno->id)
                            ->first();

                            if($movimientoCheckout != null){
                                return view('cabeceras.elementoRespuesta')->with([
                                    'mensaje'  => "Esta persona ya realizó los movimientos del dia (checkin-checkout)"
                                ]);
                            }else{
                                $movimiento = Movimiento::create([
                                    "descripcion" => 'checkout',
                                    "estado" => 'A',
                                    "detalle_turno_id" => $findDetalleTurno->id,
                                ]);
                                $elementos = Elemento::where('movimiento_id',$findMovimiento->id)->get();
                                return view('cabeceras.agregarElemento')->with([
                                    'movimiento'  => $movimiento,
                                    'persona'  => $persona,
                                    'elementos'  => $elementos,
                                    'message'  => "",
                                    'error'  => "",
                                ]);
                            }
                        }
                    }
                    
                } else {
                    return view('cabeceras.elementoRespuesta')->with([
                        'mensaje'  => "No estamos dentro del evento. Hoy es " . $fechaServidor->toDateString(). " y el evento es hasta ".$fechaFinEvento->toDateString()
                    ]);
                }   
            }

        } catch (\Throwable $th) {
            return $th;
        }
       
    }
    
}
