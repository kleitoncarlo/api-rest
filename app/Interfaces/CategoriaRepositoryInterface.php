<?php

namespace App\Interfaces;

interface CategoriaRepositoryInterface
{
    public function getAllCategorias();
    public function getCategoriaById($categoriaId);
    public function deleteCategoria($categoriaId);
    public function createCategoria(array $categoriaDetails);
    public function updateCategoria($categoriaId, array $newDetails);
    public function getFulfilledCategorias();
}