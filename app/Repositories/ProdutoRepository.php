<?php

namespace App\Repositories;

use App\Interfaces\ProdutoRepositoryInterface;
use App\Models\Produto;

class ProdutoRepository implements ProdutoRepositoryInterface
{
    public function getAllProdutos() 
    {
        return Produto::paginate(5);
    }

    public function getProdutoById($produtoId) 
    {
        return Produto::findOrFail($produtoId);
    }

    public function deleteProduto($produtoId) 
    {
        Produto::destroy($produtoId);
    }

    public function createProduto(array $produtoDetails) 
    {
        return Produto::create($produtoDetails);
    }

    public function updateProduto($produtoId, array $newDetails) 
    {
        return Produto::whereId($produtoId)->update($newDetails);
    }

    public function getFulfilledProdutos() 
    {
        return Produto::where('is_fulfilled', true);
    }
}
