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

use Illuminate\Support\Facades\Http;
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
                                        ->first();
                    
                    if ($eventoLocal) {
                        // Actualizar el ID del evento local con el ID del evento remoto
                        $eventoLocal->update(['id' => $eventoRemoto['id']]);
                        $eventoLocal->update(['fecha_inicio' => $eventoRemoto['fecha_inicio']]);
                        $eventoLocal->update(['fecha_fin' => $eventoRemoto['fecha_fin']]);
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
                        $zonaLocal->update(collect($zonaRemota)->except('id')->toArray());
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
                        $cargoLocal->update(collect($cargoLocal)->except('id')->toArray());
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
                        $tarifaLocal->update(collect($tarifaLocal)->except('id')->toArray());

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
                        $cabeceraLocal->update(collect($cabeceraLocal)->except('id')->toArray());

                    } else {
                        // Si no se encuentra una cabecera coincidente, agregar la cabecera remota a la base de datos local
                        Cabecera::create($cabeceraRemota);
                    }
                }

                //DetalleTurno
                $detallesTurnoRemotos = $response->json()['detalleTurnos'];
                foreach ($detallesTurnoRemotos as $detalleTurnoRemoto) {
                    // Buscar un detalle de turno local que coincida exactamente con el detalle de turno remoto
                    $detalleTurnoLocal = DetalleTurno::where('numero_dia', $detalleTurnoRemoto['numero_dia'])
                                                        ->where('cabecera_id', $detalleTurnoRemoto['cabecera_id'])
                                                        ->where('estado', $detalleTurnoRemoto['estado'])
                                                        ->first();
                    
                    if ($detalleTurnoLocal) {
                        // Actualizar el ID del detalle de turno local con el ID del detalle de turno remoto
                        $detalleTurnoLocal->update(collect($detalleTurnoLocal)->except('id')->toArray());

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
                        $movimientoLocal->update(collect($movimientoLocal)->except('id')->toArray());

                    } else {
                        // Si no se encuentra un movimiento coincidente, agregar el movimiento remoto a la base de datos local
                        Movimiento::create($movimientoRemoto);
                    }
                }

                //Elementos
                $elementosRemotos = $response->json()['elementos'];
                foreach ($elementosRemotos as $elementoRemoto) {
                    // Buscar un elemento local que coincida exactamente con el elemento remoto
                    $elementoLocal = Elemento::where('nombre', $elementoRemoto['nombre'])
                                            ->where('movimiento_id', $elementoRemoto['movimiento_id'])
                                            ->where('estado', $elementoRemoto['estado'])
                                            ->first();
                    
                    if ($elementoLocal) {
                        // Actualizar los IDs de las relaciones del elemento local con los IDs de las relaciones del elemento remoto
                        $elementoLocal->update(collect($elementoLocal)->except('id')->toArray());

                    } else {
                        // Si no se encuentra un elemento coincidente, agregar el elemento remoto a la base de datos local
                        Elemento::create($elementoRemoto);
                    }
                }

                return response()->json(['message' => 'Sincronizado correctamente']);

            } catch (\Throwable $th) {
                return response()->json(['errors' => $th]);
            }

        } else {
            return response()->json(['error' => "No se pudo conectar"]);
        }
   }

    public function obtenerInformacion(){
        
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


    public function enviarInformacionServer(){

        
        $datos = $this->obtenerInformacion()->getContent(); // getContent() obtiene el contenido de la respuesta

        // Encabezados personalizados que deseas enviar en la solicitud POST
        $encabezados = [
            'Content-Type' => 'application/json',
            'Accept' => '*/*'
        ];

        // Enviar la solicitud POST al servidor remoto con los datos y encabezados
        $response = Http::withHeaders($encabezados)->post('https://miarmadillo.com/public/api/db/alimentarServidor/', [
            'data' => $datos
        ]);
        
        if ($response->successful()) {
            // El request fue exitoso (código de respuesta 2xx)
            $data = $response->json(); // Obtener los datos de la respuesta como un array JSON
            // Procesar los datos de la respuesta...
        } else {
            // El request no fue exitoso, manejar el error...
            $statusCode = $response->status(); // Obtener el código de estado de la respuesta
            $error = $response->body(); // Obtener el cuerpo de la respuesta en caso de error
            // Manejar el error...
        }
    
    }


    public function alimentarServidor(Request $request){

        $data = $request->all()['data'];
        if ($data) {
            try {
                //code...
           
                //Eventos
                $eventosRemotos = $data['eventos'];
                foreach ($eventosRemotos as $eventoRemoto) {
                    // Buscar un evento local que coincida exactamente con el evento remoto
                    $eventoLocal = Evento::where('nombre', $eventoRemoto['nombre'])
                                        ->first();
                    
                    if ($eventoLocal) {
                        // Actualizar el ID del evento local con el ID del evento remoto
                        $eventoLocal->update(['id' => $eventoRemoto['id']]);
                        $eventoLocal->update(['fecha_inicio' => $eventoRemoto['fecha_inicio']]);
                        $eventoLocal->update(['fecha_fin' => $eventoRemoto['fecha_fin']]);
                    } else {
                        // Si no se encuentra un evento coincidente, agregar el evento remoto a la base de datos local
                        Evento::create($eventoRemoto);
                    }
                }

                //Zonas
                $zonasRemotas = $data['zonas'];
                foreach ($zonasRemotas as $zonaRemota) {
                    // Buscar una zona local que coincida exactamente con la zona remota
                    $zonaLocal = Zona::where('nombre', $zonaRemota['nombre'])
                                    ->where('evento_id', $zonaRemota['evento_id'])
                                    ->where('estado', $zonaRemota['estado'])
                                    ->first();
                    
                    if ($zonaLocal) {
                        // Actualizar los IDs de las relaciones de la zona local con los IDs de las relaciones de la zona remota
                        $zonaLocal->update(collect($zonaRemota)->except('id')->toArray());
                    } else {
                        // Si no se encuentra una zona coincidente, agregar la zona remota a la base de datos local
                        Zona::create($zonaRemota);
                    }
                }

                //Personas
                $personasRemotas = $data['personas'];
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
                $cargosRemotos = $data['cargos'];
                foreach ($cargosRemotos as $cargoRemoto) {
                    // Buscar un cargo local que coincida exactamente con el cargo remoto
                    $cargoLocal = Cargo::where('nombre', $cargoRemoto['nombre'])
                                        ->where('evento_id', $cargoRemoto['evento_id'])
                                        ->where('estado', $cargoRemoto['estado'])
                                        ->first();
                    
                    if ($cargoLocal) {
                        // Actualizar los IDs de las relaciones del cargo local con los IDs de las relaciones del cargo remoto
                        $cargoLocal->update(collect($cargoLocal)->except('id')->toArray());
                    } else {
                        // Si no se encuentra un cargo coincidente, agregar el cargo remoto a la base de datos local
                        Cargo::create($cargoRemoto);
                    }
                }

                //Tarifas
                $tarifasRemotas = $data['tarifas'];
                foreach ($tarifasRemotas as $tarifaRemota) {
                    // Buscar una tarifa local que coincida exactamente con la tarifa remota
                    $tarifaLocal = Tarifa::where('hora', $tarifaRemota['hora'])
                                        ->where('valor', $tarifaRemota['valor'])
                                        ->where('cargo_id', $tarifaRemota['cargo_id'])
                                        ->where('estado', $tarifaRemota['estado'])
                                        ->first();
                    
                    if ($tarifaLocal) {
                        // Actualizar los IDs de las relaciones de la tarifa local con los IDs de las relaciones de la tarifa remota
                        $tarifaLocal->update(collect($tarifaLocal)->except('id')->toArray());

                    } else {
                        // Si no se encuentra una tarifa coincidente, agregar la tarifa remota a la base de datos local
                        Tarifa::create($tarifaRemota);
                    }
                }

                //Cabeceras
                $cabecerasRemotas = $data['cabeceras'];
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
                        $cabeceraLocal->update(collect($cabeceraLocal)->except('id')->toArray());

                    } else {
                        // Si no se encuentra una cabecera coincidente, agregar la cabecera remota a la base de datos local
                        Cabecera::create($cabeceraRemota);
                    }
                }

                //DetalleTurno
                $detallesTurnoRemotos = $data['detalleTurnos'];
                foreach ($detallesTurnoRemotos as $detalleTurnoRemoto) {
                    // Buscar un detalle de turno local que coincida exactamente con el detalle de turno remoto
                    $detalleTurnoLocal = DetalleTurno::where('numero_dia', $detalleTurnoRemoto['numero_dia'])
                                                        ->where('cabecera_id', $detalleTurnoRemoto['cabecera_id'])
                                                        ->where('estado', $detalleTurnoRemoto['estado'])
                                                        ->first();
                    
                    if ($detalleTurnoLocal) {
                        // Actualizar el ID del detalle de turno local con el ID del detalle de turno remoto
                        $detalleTurnoLocal->update(collect($detalleTurnoLocal)->except('id')->toArray());

                    } else {
                        // Si no se encuentra un detalle de turno coincidente, agregar el detalle de turno remoto a la base de datos local
                        DetalleTurno::create($detalleTurnoRemoto);
                    }
                }
                
                //Movimientos
                $movimientosRemotos = $data['movimientos'];        
                foreach ($movimientosRemotos as $movimientoRemoto) {
                    // Buscar un movimiento local que coincida exactamente con el movimiento remoto
                    $movimientoLocal = Movimiento::where('descripcion', $movimientoRemoto['descripcion'])
                                                ->where('detalle_turno_id', $movimientoRemoto['detalle_turno_id'])
                                                ->where('estado', $movimientoRemoto['estado'])
                                                ->first();
                    
                    if ($movimientoLocal) {
                        // Actualizar los IDs de las relaciones del movimiento local con los IDs de las relaciones del movimiento remoto
                        $movimientoLocal->update(collect($movimientoLocal)->except('id')->toArray());

                    } else {
                        // Si no se encuentra un movimiento coincidente, agregar el movimiento remoto a la base de datos local
                        Movimiento::create($movimientoRemoto);
                    }
                }

                //Elementos
                $elementosRemotos = $data['elementos'];    
                foreach ($elementosRemotos as $elementoRemoto) {
                    // Buscar un elemento local que coincida exactamente con el elemento remoto
                    $elementoLocal = Elemento::where('nombre', $elementoRemoto['nombre'])
                                            ->where('movimiento_id', $elementoRemoto['movimiento_id'])
                                            ->where('estado', $elementoRemoto['estado'])
                                            ->first();
                    
                    if ($elementoLocal) {
                        // Actualizar los IDs de las relaciones del elemento local con los IDs de las relaciones del elemento remoto
                        $elementoLocal->update(collect($elementoLocal)->except('id')->toArray());

                    } else {
                        // Si no se encuentra un elemento coincidente, agregar el elemento remoto a la base de datos local
                        Elemento::create($elementoRemoto);
                    }
                }

                return response()->json(['message' => 'Sincronizado correctamente']);

            } catch (\Throwable $th) {
                return response()->json(['errors' => $th]);
            }

        } else {
            return response()->json(['error' => "No se pudo conectar"]);
        }
   }


    

}
