<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    //
    public function listar()
{
    $portafolios = DB::table('portafolios')
        ->where('estado', 1)
        ->orderBy('fecha_publicacion', 'desc')
        ->get()
        ->map(function ($item) {
            return [
                'title' => $item->titulo,
                'subtitle' => $item->subtitulo,
                'description' => $item->descripcion,
                'image' => asset('portafolio/' . $item->imagen_url),
            ];
        });

    return response()->json($portafolios);
}
}
