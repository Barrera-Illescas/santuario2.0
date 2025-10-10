<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SoporteController extends Controller
{

    protected $today;
    public function __construct()
    {
        $this->today = Carbon::now('America/Guatemala');
    }
    //
    public function getEspecies()
    {
        $especies = DB::table('especie')
            ->where('estado', 1)
            ->get();

        return response()->json([
            'especies' => $especies,
        ]);
    }

    public function guardarEspecie(Request $request)
    {
        try {
            $newEspecie = DB::table('especie')
                ->insertGetId([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'estado' => 1,
                    'created_at' => $this->today->format('Y-m-d H:i:s'),
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);
            return response()->json([
                'status' => 'ok',
                'newEspecie' => $newEspecie
            ]);
        } catch (\Exception $e) {
            return 'Error al guardar especie ' . $e;
        }
    }
    public function editarEspecie(Request $request)
    {
        try {
            DB::table('especie')
                ->where('id', $request->id)
                ->update([
                    'nombre' => $request->nombre,
                    'descripcion' => $request->descripcion,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al editar especie ' . $e;
        }
    }

    public function eliminarEspecie(Request $request)
    {
        try {
            DB::table('especie')
                ->where('id', $request->id)
                ->update([
                    'estado' => 0,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al editar especie ' . $e;
        }
    }
    public function getDonantes()
    {
        $donantes = DB::table('donantes')
            ->where('estado', 1)
            ->get();

        return response()->json([
            'donantes' => $donantes,
        ]);
    }
    public function guardarDonante(Request $request)
    {
        try {
            $newDonante = DB::table('donantes')
                ->insertGetId([
                    'nombre' => $request->data['nombre'],
                    'correo' => $request->data['correo'],
                    'telefono' => $request->data['telefono'],
                    'estado' => 1,
                    'created_at' => $this->today->format('Y-m-d H:i:s'),
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);
            return response()->json([
                'status' => 'ok',
                'newDonante' => $newDonante
            ]);
        } catch (\Exception $e) {
            return 'Error al guardar donante ' . $e;
        }
    }
    public function editarDonante(Request $request)
    {
        try {
            DB::table('donantes')
                ->where('id', $request->id)
                ->update([
                    'nombre' => $request->data['nombre'],
                    'correo' => $request->data['correo'],
                    'telefono' => $request->data['telefono'],
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al editar donante ' . $e;
        }
    }
    public function eliminarDonante(Request $request)
    {
        try {
            DB::table('donantes')
                ->where('id', $request->id)
                ->update([
                    'estado' => 0,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al eliminar donante ' . $e;
        }
    }
    public function getCategoriaGastos()
    {
        $catGastos = DB::table('gastos_categorias')
            ->where('estado', 1)
            ->get();

        return response()->json([
            'catGastos' => $catGastos,
        ]);
    }
    public function guardarCatGastos(Request $request)
    {
        try {
            $newCatGasto = DB::table('gastos_categorias')
                ->insertGetId([
                    'nombre' => $request->data['nombre'],
                    'descripcion' => $request->data['descripcion'],
                    'estado' => 1,
                    'created_at' => $this->today->format('Y-m-d H:i:s'),
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);
            return response()->json([
                'status' => 'ok',
                'newCatGasto' => $newCatGasto
            ]);
        } catch (\Exception $e) {
            return 'Error al guardar categorias - gastos ' . $e;
        }
    }
    public function editarCatGastos(Request $request)
    {
        try {
            DB::table('gastos_categorias')
                ->where('id', $request->id)
                ->update([
                    'nombre' => $request->data['nombre'],
                    'descripcion' => $request->data['descripcion'],
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al editar categoria - gastos ' . $e;
        }
    }
    public function eliminarCatGasto(Request $request)
    {
        try {
            DB::table('gastos_categorias')
                ->where('id', $request->id)
                ->update([
                    'estado' => 0,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al eliminar categoría - gastos ' . $e;
        }
    }
    public function getDonaciones()
    {
        $donaciones = DB::table('donaciones')
            ->where('donaciones.estado', 1)
            ->join('donantes', 'donaciones.donante_id', '=', 'donantes.id')
            ->join('metodos_pagos', 'donaciones.metodo_pago_id', '=', 'metodos_pagos.id')
            ->join('users', 'donaciones.usuario_id', '=', 'users.id')
            ->select([
                'donaciones.id',
                'donantes.id as idDonante',
                'donantes.nombre as nombreDonante',
                'donaciones.monto',
                'donaciones.fecha',
                'metodos_pagos.id as metodoPagoId',
                'metodos_pagos.nombre as metodoPago',
                'donaciones.comentario',
                'users.name as nombreUsuario',
            ])
            ->get();

        $metodosPago = DB::table('metodos_pagos')
            ->where('estado', 1)
            ->get();

        $donantes = $this->getDonantes();

        return response()->json([
            'donaciones' => $donaciones,
            'donantes' => $donantes,
            'metodosPago' => $metodosPago,

        ]);
    }
    public function guardarDonaciones(Request $request)
    {
        try {
            $user = Auth::user();
            $fechaDonacion = Carbon::parse($request->data['fecha'])->toDateString();
            $newDonacion = DB::table('donaciones')
                ->insertGetId([
                    'donante_id' => $request->data['donante'],
                    'monto' => $request->data['monto'],
                    'fecha' => $fechaDonacion,
                    'metodo_pago_id' => $request->data['metodoPago'],
                    'comentario' => $request->data['comentario'],
                    'usuario_id' => $user->id,
                    'estado' => 1,
                    'created_at' => $this->today->format('Y-m-d H:i:s'),
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);
            return response()->json([
                'status' => 'ok',
                'newDonacion' => $newDonacion
            ]);
        } catch (\Exception $e) {
            return 'Error al guardar donacion ' . $e;
        }
    }
    public function editarDonaciones(Request $request)
    {
        try {
            $user = Auth::user();
            $fechaDonacion = Carbon::parse($request->data['fecha'])->toDateString();

            DB::table('donaciones')
                ->where('id', $request->id)
                ->update([
                    'donante_id' => $request->data['donante'],
                    'monto' => $request->data['monto'],
                    'fecha' => $fechaDonacion,
                    'metodo_pago_id' => $request->data['metodoPago'],
                    'comentario' => $request->data['comentario'],
                    'usuario_id' => $user->id,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al editar donaciones ' . $e;
        }
    }
    public function eliminarDonacion(Request $request)
    {
        try {
            DB::table('donaciones')
                ->where('id', $request->id)
                ->update([
                    'estado' => 0,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al eliminar donaciones ' . $e;
        }
    }
    public function getGastos()
    {
        $gastos = DB::table('gastos')
            ->where('gastos.estado', 1)
            ->join('gastos_categorias', 'gastos.categoria_id', '=', 'gastos_categorias.id')
            ->join('users as responsable', 'gastos.responsable_id', '=', 'responsable.id')
            ->join('users as usr', 'gastos.usuario_id', '=', 'usr.id')
            ->select([
                'gastos.id',
                'gastos.concepto',
                'gastos.monto',
                'gastos.fecha',
                'gastos_categorias.id as gastosCategoriaId',
                'gastos_categorias.nombre as categoria',
                'responsable.id as responsableId',
                'responsable.name as nombreResponsable',
                'usr.name as nombreUsuario',
            ])
            ->get();

        $responsable = DB::table('users')
            ->where('estado', 1)
            ->get();

        $categorias = $this->getCategoriaGastos();

        return response()->json([
            'gastos' => $gastos,
            'categorias' => $categorias,
            'responsable' => $responsable,

        ]);
    }
    public function guardarGastos(Request $request)
    {
        try {
            $user = Auth::user();
            $fechaGasto = Carbon::parse($request->data['fecha'])->toDateString();
            $newGasto = DB::table('gastos')
                ->insertGetId([
                    'concepto' => $request->data['concepto'],
                    'monto' => $request->data['monto'],
                    'fecha' => $fechaGasto,
                    'categoria_id' => $request->data['categoria'],
                    'responsable_id' => $request->data['responsable'],
                    'usuario_id' => $user->id,
                    'estado' => 1,
                    'created_at' => $this->today->format('Y-m-d H:i:s'),
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);
            return response()->json([
                'status' => 'ok',
                'newGasto' => $newGasto
            ]);
        } catch (\Exception $e) {
            return 'Error al guardar gasto ' . $e;
        }
    }
    public function editarGastos(Request $request)
    {
        try {
            $user = Auth::user();
            $fechaGasto = Carbon::parse($request->data['fecha'])->toDateString();

            DB::table('gastos')
                ->where('id', $request->id)
                ->update([
                    'concepto' => $request->data['concepto'],
                    'monto' => $request->data['monto'],
                    'fecha' => $fechaGasto,
                    'categoria_id' => $request->data['categoria'],
                    'responsable_id' => $request->data['responsable'],
                    'usuario_id' => $user->id,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al editar gasto ' . $e;
        }
    }
    public function eliminarGastos(Request $request)
    {
        try {
            DB::table('gastos')
                ->where('id', $request->id)
                ->update([
                    'estado' => 0,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al eliminar gastos ' . $e;
        }
    }
    public function getCorrales()
    {
        $corrales = DB::table('corrales')
            ->where('corrales.estado', 1)
            ->join('especie', 'corrales.especie_id', '=', 'especie.id')
            ->select([
                'corrales.id',
                'corrales.nombre',
                'corrales.capacidad',
                'corrales.ubicacion',
                'especie.id as especieId',
                'especie.nombre as especie',
            ])
            ->get();

        $especies = $this->getEspecies();

        return response()->json([
            'corrales' => $corrales,
            'especies' => $especies,

        ]);
    }
    public function guardarCorrales(Request $request)
    {
        try {
            $user = Auth::user();

            $newGasto = DB::table('corrales')
                ->insertGetId([
                    'nombre' => $request->data['nombre'],
                    'capacidad' => $request->data['capacidad'],
                    'ubicacion' => $request->data['ubicacion'],
                    'especie_id' => $request->data['especie'],
                    'estado' => 1,
                    'created_at' => $this->today->format('Y-m-d H:i:s'),
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);
            return response()->json([
                'status' => 'ok',
                'newGasto' => $newGasto
            ]);
        } catch (\Exception $e) {
            return 'Error al guardar corral ' . $e;
        }
    }
    public function editarCorrales(Request $request)
    {
        try {

            DB::table('corrales')
                ->where('id', $request->id)
                ->update([
                    'nombre' => $request->data['nombre'],
                    'capacidad' => $request->data['capacidad'],
                    'ubicacion' => $request->data['ubicacion'],
                    'especie_id' => $request->data['especie'],
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al editar gasto ' . $e;
        }
    }
    public function eliminarCorral(Request $request)
    {
        try {
            DB::table('corrales')
                ->where('id', $request->id)
                ->update([
                    'estado' => 0,
                    'updated_at' => $this->today->format('Y-m-d H:i:s'),
                ]);

            return response()->json([
                'status' => 'ok',
            ]);
        } catch (\Exception $e) {
            return 'Error al eliminar corral ' . $e;
        }
    }
}
