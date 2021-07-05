<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{
    protected $model;

    public function index(Request $request)
    {

        return $this->model::paginate($request->per_page);

        /* funciona
        $offset = ($request->page -1) * $request->per_page;
        return $this->model::query()
            ->offset($offset)
            ->limit($request->per_page)
            ->get();
        */
    }

    public function store(Request $request)
    {
        $dados = $this->model::create($request->all());

        return response()
            ->json
            (
                $dados, 201
            );
    }

    public function show(int $id)
    {
        $serie = $this->model::find($id);

        if (is_null($serie)) {
            return response()->json(null, 204);
        }

        return response()->json($serie);
    }

    public function update(int $id, Request $request)
    {
        $serie = $this->model::find($id);

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
        $qtdRecursosRemovidos = $this->model::destroy($id);

        if ($qtdRecursosRemovidos === 0) {
            return response()->json([
                'erro' => 'Recurso não encontrado.'
            ], 404);
        }

        return response()->json([], 204);
    }
}
