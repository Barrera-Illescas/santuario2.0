<?php

namespace App\Http\Controllers\Soporte;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
}
