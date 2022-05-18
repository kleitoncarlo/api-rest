<?php

namespace App\Interfaces;

interface ProdutoRepositoryInterface
{
    public function getAllProdutos();
    public function getProdutoById($produtoId);
    public function deleteProduto($produtoId);
    public function createProduto(array $produtoDetails);
    public function updateProduto($produtoId, array $newDetails);
    public function getFulfilledProdutos();
}