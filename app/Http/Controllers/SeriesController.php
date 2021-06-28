<?php

namespace App\Http\Controllers;

use App\Serie;
use http\Env\Response;
use Illuminate\Http\Request;


class SeriesController
{
    public function index()
    {
        return Serie::all();
    }

    public function store(Request $request)
    {
        $dados = Serie::create($request->all());

        return response()
            ->json
            (
                $dados, 201
            );
    }

    public function show(int $id)
    {
        $serie = Serie::find($id);

        if (is_null($serie)) {
            return response()->json(null, 204);
        }

        return response()->json($serie);
    }

    public function update(int $id, Request $request)
    {
        $serie = Serie::find($id);

        if (is_null($serie)) {
            return response()->json([
                'success' => false,
                'mensagem' => 'Série não encontrada.'
            ], 404);
        }

        $serie->fill($request->all());
        $serie->save();

        return $serie;
    }

    public function destroy(int $id)
    {
        $qtdRecursosRemovidos = Serie::destroy($id);

        if ($qtdRecursosRemovidos === 0) {
            return response()->json([
                'erro' => 'Recurso não encontrado.'
            ], 404);
        }

        return response()->json([], 204);
    }
}
