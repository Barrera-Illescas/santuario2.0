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
                'donantes.nombre as nombreDonante',
                'donaciones.monto',
                'donaciones.fecha',
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
}
