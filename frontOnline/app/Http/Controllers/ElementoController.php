<?php

namespace App\Http\Controllers;

use App\Models\Elemento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ElementoController extends Controller
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
        $chaleco = $request->get('checkboxChaleco');
        $gorro = $request->get('checkboxGorro');
        $checkOtro = $request->get('checkboxOtro');
        $otro = $request->get('textoOtro');
        $movimiento_id = $request->get('movimiento_id');

        try {
            // Validar cada parámetro individualmente
            if ($chaleco == "true") {
                Elemento::create([
                    'nombre' => 'chaleco',
                    'estado' => 'A',
                    'movimiento_id' => $movimiento_id,
                ]);
            }

            if ($gorro == "true") {
                Elemento::create([
                    'nombre' => 'gorro',
                    'estado' => 'A',
                    'movimiento_id' => $movimiento_id,
                ]);        
            }

            if ($otro) {
                Elemento::create([
                    'nombre' => $otro,
                    'estado' => 'A',
                    'movimiento_id' => $movimiento_id,
                ]);
            }

            if ($checkOtro == "true") {
                Elemento::create([
                    'nombre' => 'otro',
                    'estado' => 'A',
                    'movimiento_id' => $movimiento_id,
                ]);
            }

            if (!isset($movimiento_id)) {
                return response()->json(['error' => 'El valor de movimiento_id no está presente en la solicitud'], 400);
            }

            return 'ok';

        } catch (\Throwable $th) {
            return $th;
        }
        
            
      
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Elemento  $elemento
     * @return \Illuminate\Http\Response
     */
    public function show(Elemento $elemento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Elemento  $elemento
     * @return \Illuminate\Http\Response
     */
    public function edit(Elemento $elemento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Elemento  $elemento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Elemento $elemento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Elemento  $elemento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Elemento $elemento)
    {
        //
    }
}
