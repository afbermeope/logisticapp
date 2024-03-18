<?php

namespace App\Http\Controllers;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

use App\Models\Evento;
use App\Models\Cabecera;
use App\Models\Cargo;
use App\Models\Persona;
use App\Models\Zona;
use App\Models\DetalleTurno;
use App\Models\Movimiento;
use App\Models\Elemento;
use App\Models\Tarifa;
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

        $zona = Zona::find($zona_id);
        $tarifa = Tarifa::find($tarifa_id);

        $cabecera = Cabecera::create([
            "persona_id" => $persona_id,
            "zona_id" => $zona_id,
            "evento_id" => $zona->evento->id,
            "cargo_id" => $tarifa->cargo->id,
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
        $cabecera_id = $request->get('cabeceraId');
        try {

            $cabecera = Cabecera::find($cabecera_id);
            // if(!$cabecera){
            //     return view('cabeceras.elementoRespuesta')->with([
            //         'mensaje'  => "Usuario no tiene turnos asignados: ",
            //     ]);
            // }

            //no debe haber un detalleturno con el dia de hoy
            $fechaServidor = Carbon::now('America/Bogota')->toDateString(); // Obtén la fecha actual del servidor y ajusta la zona horaria
            // $fechaServidor = Carbon::parse("2024/03/16");
            $fechaServidor = Carbon::parse($fechaServidor);

            $fechaInicioEvento = Carbon::parse($cabecera->evento->fecha_inicio);
            $fechaFinEvento = Carbon::parse($cabecera->evento->fecha_fin);

            foreach($cabecera->detalleTurnos as $detalleTurno){
                if ($fechaInicioEvento->diffInDays($fechaServidor)+1 == $detalleTurno->numero_dia && $detalleTurno->estado != "A"){
                    return view('cabeceras.elementoRespuesta')->with([
                        'mensaje'  => "Turno del dia cumplido",
                    ]);
                }
            }

            $detalleTurnoSinChekout = $this->tieneCheckinHuerfano($cabecera->persona->id);

            if($detalleTurnoSinChekout != null){
                $movimiento = Movimiento::create([
                    "descripcion" => 'checkout',
                    "estado" => 'A',
                    "detalle_turno_id" => $detalleTurnoSinChekout->id,
                ]);

                $detalleTurnoSinChekout->estado = "I";
                $detalleTurnoSinChekout->save();

                return view('cabeceras.agregarElemento')->with([
                    'movimiento'  => $movimiento,
                    'persona'  => $cabecera->persona,
                    'elementos'  => $detalleTurnoSinChekout->movimientos[0]->elementos,
                    'message'  => "",
                    'error'  => "",
                ]);
            }


            $cabecera = Cabecera::where('zona_id', '=', $cabecera->zona->id)
            ->where('persona_id', '=', $cabecera->persona->id)
            ->where('estado', '=', 'A')
            ->first();

            if ($cabecera === null) {
                return view('cabeceras.elementoRespuesta')->with([
                    'mensaje'  => "Persona no encontrada en el evento: ".$cabecera->evento->nombre,
                ]);
            } else {
    
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
                            'persona'  => $cabecera->persona,
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

                                $findDetalleTurno->estado = "I";
                                $findDetalleTurno->save();
                                
                                $elementos = Elemento::where('movimiento_id',$findMovimiento->id)->get();
                                return view('cabeceras.agregarElemento')->with([
                                    'movimiento'  => $movimiento,
                                    'persona'  => $cabecera->persona,
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
    
    public function seleccionarEvento()
    {
        $eventos = Evento::where('estado','A')->get();

        return view('eventos.seleccionarEvento')->with([
            'eventos'  => $eventos,
            'message'  => "",
            'error'  => "",
        ]);

    }

    public function tieneCheckinHuerfano($personaId)
    {
        // Obtener el último DetalleTurno asociado a la persona actual sin checkout
        $detalleTurnoSinCheckout = Persona::find($personaId)
        ->cabeceras()
        ->latest()
        ->first()
        ->detalleTurnos()
        ->whereDoesntHave('movimientos', function ($query) {
            $query->where('descripcion', 'checkout');
        })
        ->latest()
        ->first();

        if ($detalleTurnoSinCheckout) {
            // $detalleTurnoSinCheckout contiene el DetalleTurno que no tiene checkout
            return $detalleTurnoSinCheckout;
        } else {
            return null;
        }
    }

    public function subirExcel(Request $request)
    {
        // Verifica si se ha enviado un archivo
        if ($request->hasFile('archivo_excel')) {
            $archivo = $request->file('archivo_excel');

            // Crea un lector de archivos Excel
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->open($archivo->getPathname());

            // Itera sobre las filas y crea objetos a partir de las columnas
            $objetos = [];
            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $fila) {
                    // Suponiendo que la primera fila del archivo Excel contiene los nombres de las columnas
                    $datos = $fila->toArray();

                    // Crea un objeto personalizado con los datos de la fila
                    $objeto = new \stdClass();
                    $objeto->cedula = str_pad($datos[0], 10, '0', STR_PAD_LEFT); // Cedula
                    $objeto->nombre = $datos[1]; // Nombre completo
                    $objeto->telefono = $datos[2]; // Teléfono
                    $objeto->evento = $datos[3]; // Evento
                    $objeto->fecha_inicio = $datos[4]; // Fecha inicio
                    $objeto->fecha_fin = $datos[5]; // Fecha fin
                    $objeto->zona = $datos[6]; // Zona
                    $objeto->turno = $datos[7]; // Turno
                    $objeto->horario = $datos[8]; // Horario
                    $objeto->cargo = $datos[9]; // Cargo
                    
                    // dd( $objeto->fecha_inicio);

                    //Crear evento
                    //Validamos si no existe ese evento

                    $evento = Evento::where('nombre', $objeto->evento)
                    ->where('fecha_inicio', $objeto->fecha_inicio)
                    ->where('fecha_fin', $objeto->fecha_fin)
                    ->first();

                    if (!$evento) {
                        $fechaInicioCarbon = Carbon::parse($objeto->fecha_inicio);
                        $fechaFinCarbon = Carbon::parse($objeto->fecha_fin);
                        $diferenciaEnDias = $fechaInicioCarbon->diffInDays($fechaFinCarbon) + 1;

                        // Crear nuevo evento
                        $nuevoEvento = Evento::create([
                            'nombre' => $objeto->evento,
                            'fecha_inicio' => $objeto->fecha_inicio,
                            'fecha_fin' => $objeto->fecha_fin,
                            'dias' => $diferenciaEnDias,
                            'estado' => 'A'
                        ]);

                        //Crear la zona
                        //Validamos si no existe esa zona con ese evento
                        $zona = Zona::where('nombre', $objeto->zona)
                        ->first();

                        if (!$zona) {
                            $nuevaZona = Zona::create([
                                'nombre' => $objeto->zona,
                                'evento_id' => $nuevoEvento->id,
                                'estado' => 'A'
                            ]);
                        }

                        $cargo = Cargo::where('nombre', $objeto->cargo)
                        ->where('evento_id', $nuevoEvento->id)
                        ->first();    

                        if (!$cargo) {
                            // Crear nuevo cargo
                            $nuevoCargo = Cargo::create([
                                'nombre' => $objeto->cargo,
                                'evento_id' => $nuevoEvento->id,
                                'estado' => 'A'
                            ]);
    
                            //Crear la tarifa
                            $nuevaTarifa = Tarifa::create([
                                'valor' => $objeto->turno,
                                'hora' => 1,
                                'cargo_id' => $nuevoCargo->id,
                                'estado' => 'A'
                            ]);    
                        }

                    }else{
                        //Crear la zona
                        //Validamos si no existe esa zona con ese evento
                        $zona = Zona::where('nombre', $objeto->zona)
                        ->first();

                        if (!$zona) {
                            $nuevaZona = Zona::create([
                                'nombre' => $objeto->zona,
                                'evento_id' => $evento->id,
                                'estado' => 'A'
                            ]);
    
                        }
                        
                        //Crear el cargo
                        //Validamos si no existe ese evento

                        $cargo = Cargo::where('nombre', $objeto->cargo)
                        ->where('evento_id', $evento->id)
                        ->first();    
                        
                        if (!$cargo) {
                            // Crear nuevo cargo
                            $nuevoCargo = Cargo::create([
                                'nombre' => $objeto->cargo,
                                'evento_id' => $evento->id,
                                'estado' => 'A'
                            ]);
    
                            //Crear la tarifa
                            $nuevaTarifa = Tarifa::create([
                                'valor' => $objeto->turno,
                                'hora' => 1,
                                'cargo_id' => $nuevoCargo->id,
                                'estado' => 'A'
                            ]);    
                        }
                    }

                    $persona = Persona::where('cedula', $objeto->cedula)
                    ->where('nombre', $objeto->nombre)
                    ->first();    

                    if (!$persona) {
                        $nuevaPersona = Persona::create([
                            'nombre' => $objeto->nombre,
                            'cedula' => $objeto->cedula,
                            'telefono' => $objeto->telefono,
                            'estado' => 'A'
                        ]);
                    }

                    //Crear cabecera
                    //Validar que no haya una cabecera exacta

                   // Ejecutar la consulta utilizando Eloquent
                    $primerResultado = Cabecera::select('cabeceras.*')
                        ->join('eventos as e', 'cabeceras.evento_id', '=', 'e.id')
                        ->join('zonas as z', 'cabeceras.zona_id', '=', 'z.id')
                        ->join('personas as p', 'cabeceras.persona_id', '=', 'p.id')
                        ->join('cargos as ca', 'cabeceras.cargo_id', '=', 'ca.id')
                        ->join('tarifas as t', 'cabeceras.tarifa_id', '=', 't.id')
                        ->where('e.nombre', $objeto->evento)
                        ->where('z.nombre', $objeto->zona)
                        ->where('p.nombre', $objeto->nombre)
                        ->where('p.cedula', $objeto->cedula)
                        ->where('ca.nombre', $objeto->cargo)
                        ->where('t.valor', $objeto->turno)
                        ->where('cabeceras.horario', $objeto->horario)
                        ->first(); // Obtener solo el primer registro
                    
                    // Verificar si se encontró un resultado
                    if (!$primerResultado) {
                        //TODO: esto puede hacerse mejor pero estoy mamao
                        $p= Persona::where('cedula', $objeto->cedula)
                        ->where('nombre', $objeto->nombre)
                        ->first();    

                        $z = Zona::where('nombre', $objeto->zona)
                        ->first();

                        $e = Evento::where('nombre', $objeto->evento)
                        ->where('fecha_inicio', $objeto->fecha_inicio)
                        ->where('fecha_fin', $objeto->fecha_fin)
                        ->first();

                        $c = Cargo::where('nombre', $objeto->cargo)
                        ->where('evento_id', $e->id)
                        ->first();  

                        $t = Tarifa::
                        where('cargo_id', $c->id)
                        ->first();  
                        
                        $cabecera = Cabecera::create([
                            "persona_id" => $p->id,
                            "zona_id" => $z->id,
                            "evento_id" => $e->id,
                            "cargo_id" => $c->id,
                            "tarifa_id" => $t->id,
                            "horario" => $objeto->horario ,
                            "cantidad_horas" => '1',
                            "estado" => "A",
                        ]);
                    } 
                    // Agrega el objeto al arreglo
                    $objetos[] = $objeto;
                }
            }

            // Cierra el lector de archivos Excel
            $reader->close();

            // Aquí puedes hacer lo que quieras con los objetos, como pasarlos a una vista
            // dd($objetos);

            $cabeceras = Cabecera::where('estado','A')->get();
            $eventos = Evento::where('estado','A')->get();
            $personas = Persona::where('estado','A')->get();
            $cargos = Cargo::where('estado','A')->get();
    
            return view('cabeceras.index')->with([
                'cabeceras'  => $cabeceras,
                'eventos'  => $eventos,
                'personas'  => $personas,
                'cargos'  => $cargos,
                'message'  => "Subido correctamente",
                'error'  => "",
            ]);

        } else {
            return redirect()->back()->with('error', 'No se ha seleccionado ningún archivo.');
        }
    }

    public function consultarCabeceras(Request $request)
    {
        $evento_id = $request->get('evento_id');
        $cedula = $request->input('codigoBarras');

        $cedula = substr($cedula, 0, 10);
        $persona = Persona::where('cedula', $cedula)->first();
        
        if(!$persona){
            return view('cabeceras.elementoRespuesta')->with([
                'mensaje'  => "Usuario no existe en la base de datos: ",
            ]);
        }

        $cabeceras = Cabecera::where('evento_id', '=', $evento_id)
        ->where('persona_id', '=', $persona->id)
        ->where('estado', '=', 'A')
        ->get();

        if($cabeceras->count() == 0){
            return view('cabeceras.elementoRespuesta')->with([
                'mensaje'  => "Persona no encontrada en el evento"
            ]);
        }

        if($cabeceras->count() >= 1){
            return view('cabeceras.seleccionCabeceras')->with([
                'cabeceras'  => $cabeceras,
                'persona'  => $persona,
                'message'  => "",
                'error'  => "",
            ]);
        }
        else {
            return $this->registrarMovimiento($cabeceras[0]);
        }
           

    }

    public function registrarMovimiento($cabecera)
    {
        try{
            //no debe haber un detalleturno con el dia de hoy

            $fechaServidor = Carbon::now('America/Bogota')->toDateString(); // Obtén la fecha actual del servidor y ajusta la zona horaria
            // $fechaServidor = Carbon::parse("2024/03/16");
            $fechaServidor = Carbon::parse($fechaServidor);

            $fechaInicioEvento = Carbon::parse($cabecera->evento->fecha_inicio);
            $fechaFinEvento = Carbon::parse($cabecera->evento->fecha_fin);

            foreach($cabecera->detalleTurnos as $detalleTurno){
                if ($fechaInicioEvento->diffInDays($fechaServidor)+1 == $detalleTurno->numero_dia && $detalleTurno->estado != "A"){
                    return view('cabeceras.elementoRespuesta')->with([
                        'mensaje'  => "Turno del dia cumplido",
                    ]);
                }
            }

            $detalleTurnoSinChekout = $this->tieneCheckinHuerfano($persona->id);

            if($detalleTurnoSinChekout != null){
                $movimiento = Movimiento::create([
                    "descripcion" => 'checkout',
                    "estado" => 'A',
                    "detalle_turno_id" => $detalleTurnoSinChekout->id,
                ]);

                $detalleTurnoSinChekout->estado = "I";
                $detalleTurnoSinChekout->save();

                return view('cabeceras.agregarElemento')->with([
                    'movimiento'  => $movimiento,
                    'persona'  => $persona,
                    'elementos'  => $detalleTurnoSinChekout->movimientos[0]->elementos,
                    'message'  => "",
                    'error'  => "",
                ]);
            }


            $cabecera = Cabecera::where('zona_id', '=', $cabecera->zona->id)
            ->where('persona_id', '=', $cabecera->persona->id)
            ->where('estado', '=', 'A')
            ->first();

            if ($cabecera === null) {
                return view('cabeceras.elementoRespuesta')->with([
                    'mensaje'  => "Persona no encontrada en el evento: ".$cabecera->evento->nombre,
                ]);
            } else {
    
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
                            'persona'  => $cabecera->persona,
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

                                $findDetalleTurno->estado = "I";
                                $findDetalleTurno->save();
                                
                                $elementos = Elemento::where('movimiento_id',$findMovimiento->id)->get();
                                return view('cabeceras.agregarElemento')->with([
                                    'movimiento'  => $movimiento,
                                    'persona'  => $cabecera->persona,
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
