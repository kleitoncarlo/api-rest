<?php

namespace App\Repositories;

use App\Interfaces\CategoriaRepositoryInterface;
use App\Models\Categoria;

class CategoriaRepository implements CategoriaRepositoryInterface
{
    public function getAllCategorias()
    {
        return Categoria::paginate(5);
    }

    public function getCategoriaById($categoriaId)
    {
        return Categoria::findOrFail($categoriaId);
    }

    public function deleteCategoria($categoriaId)
    {
        Categoria::destroy($categoriaId);
    }

    public function createCategoria(array $categoriaDetails)
    {
        return Categoria::create($categoriaDetails);
    }

    public function updateCategoria($categoriaId, array $newDetails)
    {
        return Categoria::whereId($categoriaId)->update($newDetails);
    }

    public function getFulfilledCategorias()
    {
        return Categoria::where('is_fulfilled', true);
    }
}
