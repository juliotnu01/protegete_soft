<?php

namespace App\Http\Controllers;

use App\Models\{Proyecto, History, Candidato, Requisito};
use Illuminate\Http\Request;
use Inertia\Inertia;
use DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $proyecto = Proyecto::with(['hasHistory', 'hasSupervisor', 'hasSupervisor.hasRequisitos'])->get();
            return response($proyecto);
        }catch (Exception $e) {
            throw new Exception($e, 1);
        }
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
    public function store(Request $request, Proyecto $proyecto )
    {
        try {
            return DB::transaction(function () use ($request, $proyecto) {
                $proyecto->proyecto_nombre = $request['proyecto_nombre'];
                $proyecto->save();
            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        try {
            return DB::transaction(function () use ($request, $proyecto) {
                $proyecto->find($request['id'])->update([
                    'proyecto_nombre' => $request['proyecto_nombre']
                ]);
            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function updateEstadoProyecto(Request $request, Proyecto $proyecto, History $history)
    {
        try {
            return DB::transaction(function () use ($request, $proyecto , $history) {

                $proyecto->find($request['proyecto']['id'])->update([
                    'estado_proyecto' => 'Proyecto iniciado'
                ]);

                $history->descripcion_history = $request['model']['var_inicio_proyecto'];
                $history->proyecto_id = $request['proyecto']['id'];
                $history->save();
            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto)
    {
        //
    }

    public function storeCandidatoSupervisor(Request $request, Proyecto $proyecto, Candidato $candidato, Requisito $requisito , History $history )
    {

        

        try {
            return DB::transaction(function () use ($request, $candidato,$requisito, $history ) {

                $candidato->user_id = $request['model']['candidato']['id'];
                $candidato->proyecto_id = $request['model']['proyecto']['id'];
                $candidato->tipo_cantidato = "Supervisor";
                $candidato->estado_cantidato = "Pre-seleccionado";
                $candidato->descripcion = $request['model']['descripcion'];
                $candidato->fecha_inicio = $request['model']['f_inicio'];
                $candidato->fecha_limite = $request['model']['f_final'];
                $candidato->save();

                for ($i=0; $i < count($request['model']['requisitos']); $i++) { 
                    $requisito->documento = $request['model']['requisitos'][$i]['documento']  ."--". $request['model']['requisitos'][$i]['descripcion'] ;
                    $requisito->cantidato_id = $candidato->id;
                    $requisito->save();
                }

                $history->descripcion_history = "Pre-Seleccion del supervisor";
                $history->proyecto_id = $request['model']['proyecto']['id'];
                $history->save();


            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function storeCandidatoInterventor(Request $request, Proyecto $proyecto, Candidato $candidato, Requisito $requisito , History $history )
    {

        

        try {
            return DB::transaction(function () use ($request, $candidato,$requisito, $history ) {

                $candidato->user_id = $request['model']['candidato']['id'];
                $candidato->proyecto_id = $request['model']['proyecto']['id'];
                $candidato->tipo_cantidato = "Interventor";
                $candidato->estado_cantidato = "Pre-seleccionado";
                $candidato->descripcion = $request['model']['descripcion'];
                $candidato->fecha_inicio = $request['model']['f_inicio'];
                $candidato->fecha_limite = $request['model']['f_final'];
                $candidato->save();

                for ($i=0; $i < count($request['model']['requisitos']); $i++) { 
                    $requisito->documento = $request['model']['requisitos'][$i]['documento']  ."--". $request['model']['requisitos'][$i]['descripcion'] ;
                    $requisito->cantidato_id = $candidato->id;
                    $requisito->save();
                }

                $history->descripcion_history = "Pre-Seleccion del Interventor";
                $history->proyecto_id = $request['model']['proyecto']['id'];
                $history->save();


            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function storeCandidatoContratista(Request $request, Proyecto $proyecto, Candidato $candidato, Requisito $requisito , History $history )
    {
        try {
            return DB::transaction(function () use ($request, $candidato,$requisito, $history ) {

                $candidato->user_id = $request['model']['candidato']['id'];
                $candidato->proyecto_id = $request['model']['proyecto']['id'];
                $candidato->tipo_cantidato = "Contratista";
                $candidato->estado_cantidato = "Pre-seleccionado";
                $candidato->descripcion = $request['model']['descripcion'];
                $candidato->fecha_inicio = $request['model']['f_inicio'];
                $candidato->fecha_limite = $request['model']['f_final'];
                $candidato->save();

                for ($i=0; $i < count($request['model']['requisitos']); $i++) { 
                    $requisito->documento = $request['model']['requisitos'][$i]['documento']  ."--". $request['model']['requisitos'][$i]['descripcion'] ;
                    $requisito->cantidato_id = $candidato->id;
                    $requisito->save();
                }

                $history->descripcion_history = "Pre-Seleccion del Contratista";
                $history->proyecto_id = $request['model']['proyecto']['id'];
                $history->save();


            });
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
