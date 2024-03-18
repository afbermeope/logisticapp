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
use App\Models\Tarifa;
use App\Models\Alimento;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Carbon\Carbon;


class DatabaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('BasesDeDatos.index')->with([
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
        //
    }

    public function bajarInformacion(){
        // Realiza una solicitud GET a la API
        $response = Http::get('https://miarmadillo.com/public/api/db/subirInformacion');

        if ($response->successful()) {
            try {
                //code...
           
                //Eventos
                $eventosRemotos = $response->json()['eventos'];
                foreach ($eventosRemotos as $eventoRemoto) {
                    // Buscar un evento local que coincida exactamente con el evento remoto
                    $eventoLocal = Evento::where('nombre', $eventoRemoto['nombre'])
                                        ->where('fecha_inicio', $eventoRemoto['fecha_inicio'])
                                        ->where('fecha_fin', $eventoRemoto['fecha_fin'])
                                        ->first();
                    
                    if ($eventoLocal) {
                        // Actualizar el ID del evento local con el ID del evento remoto
                        $eventoLocal->update(['id' => $eventoRemoto['id']]);
                    } else {
                        // Si no se encuentra un evento coincidente, agregar el evento remoto a la base de datos local
                        Evento::create($eventoRemoto);
                    }
                }

                //Zonas
                $zonasRemotas = $response->json()['zonas'];
                foreach ($zonasRemotas as $zonaRemota) {
                    // Buscar una zona local que coincida exactamente con la zona remota
                    $zonaLocal = Zona::where('nombre', $zonaRemota['nombre'])
                                    ->where('evento_id', $zonaRemota['evento_id'])
                                    ->where('estado', $zonaRemota['estado'])
                                    ->first();
                    
                    if ($zonaLocal) {
                        // Actualizar los IDs de las relaciones de la zona local con los IDs de las relaciones de la zona remota
                        $zonaLocal->update(array_except($zonaRemota, ['id']));
                    } else {
                        // Si no se encuentra una zona coincidente, agregar la zona remota a la base de datos local
                        Zona::create($zonaRemota);
                    }
                }

                //Personas
                $personasRemotas = $response->json()['personas'];
                foreach ($personasRemotas as $personaRemota) {
                    // Buscar una persona local que coincida exactamente con la persona remota, excepto por la cedula
                    $personaLocal = Persona::where('nombre', $personaRemota['nombre'])
                                            ->where('telefono', $personaRemota['telefono'])
                                            ->where('correo', $personaRemota['correo'])
                                            ->where('direccion', $personaRemota['direccion'])
                                            ->first();
                    
                    if ($personaLocal) {
                        // Actualizar el ID de la persona local con el ID de la persona remota
                        $personaLocal->update(['id' => $personaRemota['id']]);
                    } else {
                        // Si no se encuentra una persona coincidente, agregar la persona remota a la base de datos local
                        Persona::create($personaRemota);
                    }
                }

                //Cargos
                $cargosRemotos = $response->json()['cargos'];
                foreach ($cargosRemotos as $cargoRemoto) {
                    // Buscar un cargo local que coincida exactamente con el cargo remoto
                    $cargoLocal = Cargo::where('nombre', $cargoRemoto['nombre'])
                                        ->where('evento_id', $cargoRemoto['evento_id'])
                                        ->where('estado', $cargoRemoto['estado'])
                                        ->first();
                    
                    if ($cargoLocal) {
                        // Actualizar los IDs de las relaciones del cargo local con los IDs de las relaciones del cargo remoto
                        $cargoLocal->update(array_except($cargoRemoto, ['id']));
                    } else {
                        // Si no se encuentra un cargo coincidente, agregar el cargo remoto a la base de datos local
                        Cargo::create($cargoRemoto);
                    }
                }

                //Tarifas
                $tarifasRemotas = $response->json()['tarifas'];
                foreach ($tarifasRemotas as $tarifaRemota) {
                    // Buscar una tarifa local que coincida exactamente con la tarifa remota
                    $tarifaLocal = Tarifa::where('hora', $tarifaRemota['hora'])
                                        ->where('valor', $tarifaRemota['valor'])
                                        ->where('cargo_id', $tarifaRemota['cargo_id'])
                                        ->where('estado', $tarifaRemota['estado'])
                                        ->first();
                    
                    if ($tarifaLocal) {
                        // Actualizar los IDs de las relaciones de la tarifa local con los IDs de las relaciones de la tarifa remota
                        $tarifaLocal->update(array_except($tarifaRemota, ['id']));
                    } else {
                        // Si no se encuentra una tarifa coincidente, agregar la tarifa remota a la base de datos local
                        Tarifa::create($tarifaRemota);
                    }
                }

                //Cabeceras
                $cabecerasRemotas = $response->json()['cabeceras'];
                foreach ($cabecerasRemotas as $cabeceraRemota) {
                    // Buscar una cabecera local que coincida exactamente con la cabecera remota
                    $cabeceraLocal = Cabecera::where('horario', $cabeceraRemota['horario'])
                                            ->where('zona_id', $cabeceraRemota['zona_id'])
                                            ->where('persona_id', $cabeceraRemota['persona_id'])
                                            ->where('cantidad_horas', $cabeceraRemota['cantidad_horas'])
                                            ->where('tarifa_id', $cabeceraRemota['tarifa_id'])
                                            ->where('estado', $cabeceraRemota['estado'])
                                            ->first();
                    
                    if ($cabeceraLocal) {
                        // Actualizar los IDs de las relaciones de la cabecera local con los IDs de las relaciones de la cabecera remota
                        $cabeceraLocal->update(array_except($cabeceraRemota, ['id']));
                    } else {
                        // Si no se encuentra una cabecera coincidente, agregar la cabecera remota a la base de datos local
                        Cabecera::create($cabeceraRemota);
                    }
                }

                //DetalleTurno
                $detallesTurnoRemotos = $response->json()['detalles_turno'];
                foreach ($detallesTurnoRemotos as $detalleTurnoRemoto) {
                    // Buscar un detalle de turno local que coincida exactamente con el detalle de turno remoto
                    $detalleTurnoLocal = DetalleTurno::where('numero_dia', $detalleTurnoRemoto['numero_dia'])
                                                        ->where('cabecera_id', $detalleTurnoRemoto['cabecera_id'])
                                                        ->where('estado', $detalleTurnoRemoto['estado'])
                                                        ->first();
                    
                    if ($detalleTurnoLocal) {
                        // Actualizar el ID del detalle de turno local con el ID del detalle de turno remoto
                        $detalleTurnoLocal->update(['id' => $detalleTurnoRemoto['id']]);
                    } else {
                        // Si no se encuentra un detalle de turno coincidente, agregar el detalle de turno remoto a la base de datos local
                        DetalleTurno::create($detalleTurnoRemoto);
                    }
                }
                
                //Movimientos
                $movimientosRemotos = $response->json()['movimientos'];            
                foreach ($movimientosRemotos as $movimientoRemoto) {
                    // Buscar un movimiento local que coincida exactamente con el movimiento remoto
                    $movimientoLocal = Movimiento::where('descripcion', $movimientoRemoto['descripcion'])
                                                ->where('detalle_turno_id', $movimientoRemoto['detalle_turno_id'])
                                                ->where('estado', $movimientoRemoto['estado'])
                                                ->first();
                    
                    if ($movimientoLocal) {
                        // Actualizar los IDs de las relaciones del movimiento local con los IDs de las relaciones del movimiento remoto
                        $movimientoLocal->update(array_except($movimientoRemoto, ['id']));
                    } else {
                        // Si no se encuentra un movimiento coincidente, agregar el movimiento remoto a la base de datos local
                        Movimiento::create($movimientoRemoto);
                    }
                }

                //Elementos
                $elementosRemotos = $response->json()['elementos'];
                foreach ($elementosRemotos as $elementoRemoto) {
                    // Buscar un elemento local que coincida exactamente con el elemento remoto
                    $elementoLocal = Elemento::where('descripcion', $elementoRemoto['descripcion'])
                                            ->where('movimiento_id', $elementoRemoto['movimiento_id'])
                                            ->where('estado', $elementoRemoto['estado'])
                                            ->first();
                    
                    if ($elementoLocal) {
                        // Actualizar los IDs de las relaciones del elemento local con los IDs de las relaciones del elemento remoto
                        $elementoLocal->update(array_except($elementoRemoto, ['id']));
                    } else {
                        // Si no se encuentra un elemento coincidente, agregar el elemento remoto a la base de datos local
                        Elemento::create($elementoRemoto);
                    }
                }

                return response()->json(['message' => 'Sincronizado correctamente'], Response::HTTP_OK);

            } catch (\Exception $e) {
                return response()->json(['error' => $e], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

        } else {
            return response()->json(['error' => "No se pudo conectar"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
   }

    public function subirInformacion(){
        
        $eventos = Evento::all();
        $zonas = Zona::all();
        $personas = Persona::all();
        $cargos = Cargo::all();
        $tarifas = Tarifa::all();
        $cabeceras = Cabecera::all();
        $detalleTurnos = DetalleTurno::all();
        $movimientos = Movimiento::all();
        $elementos = Elemento::all();
        $alimentos = Alimento::all();

        $data = [
            'eventos' => $eventos,
            'zonas' => $zonas,
            'personas' => $personas,
            'cargos' => $cargos,
            'tarifas' => $tarifas,
            'cabeceras' => $cabeceras,
            'detalleTurnos' => $detalleTurnos,
            'movimientos' => $movimientos,
            'elementos' => $elementos,
            'alimentos' => $alimentos
        ];

        return response()->json($data);
    }

    

}
