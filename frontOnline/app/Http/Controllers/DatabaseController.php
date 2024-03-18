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
use Illuminate\Http\Request;
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
        $response = Http::get('https://api.example.com/data');

        // Verifica si la solicitud fue exitosa (código de estado 200)
        if ($response->successful()) {
            // Obtén los datos de la respuesta en formato JSON
            $datos = $response->json();

            // Procesa los datos obtenidos de la API
            // Por ejemplo, puedes almacenarlos en una variable y pasarlos a una vista
            return view('vista', ['datos' => $datos]);
        } else {
            // Si la solicitud no fue exitosa, maneja el error adecuadamente
            // Por ejemplo, puedes mostrar un mensaje de error
            return response()->json(['error' => 'No se pudo obtener los datos de la API'], $response->status());
        }
   }

    public function subirInformacion(){
    
        $eventos = Evento::all();
        return response()->json($eventos);
    }

}
