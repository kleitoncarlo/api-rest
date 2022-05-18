<?php

namespace App\Http\Controllers;

use App\Interfaces\ProdutoRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;

class ProdutoController extends Controller
{
    protected $user;
    private ProdutoRepositoryInterface $produtoRepository;

    public function __construct(ProdutoRepositoryInterface $produtoRepository)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->produtoRepository = $produtoRepository;
    }

    /**
     * @OA\Get(
     *     path="/produtos",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="200", description="Display a listing of products.")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->produtoRepository->getAllProdutos(),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/produtos",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Store new product"
     *      ),
     *
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"descricao","dimensoes","codigo","referencia","saldo_estoque","preco","categoria_id"},
     *       @OA\Property(property="descricao", type="string"),
     *       @OA\Property(property="dimensoes", type="string"),
     *       @OA\Property(property="codigo", type="string"),
     *       @OA\Property(property="referencia", type="string"),
     *       @OA\Property(property="saldo_estoque", type="integer"),
     *       @OA\Property(property="preco", type="float"),
     *       @OA\Property(property="categoria_id", type="integer"),
     *    ),
     * ),
     *
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $produtoDetails = $request->only([
            'descricao',
            'dimensoes',
            'codigo',
            'referencia',
            'saldo_estoque',
            'preco',
            'categoria_id',
        ]);

        return response()->json(
            [
                'data' => $this->produtoRepository->createProduto($produtoDetails),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Get(
     *     path="/produtos/{id}",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Display a product by id."
     *      ),
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     * )
     */
    public function show(Request $request): JsonResponse
    {
        $produtoId = $request->route('id');

        return response()->json([
            'data' => $this->produtoRepository->getProdutoById($produtoId),
        ]);
    }

    /**
     * @OA\Put(
     *     path="/produtos/{id}",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Update a product by id."
     *      ),
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"descricao","dimensoes","codigo","referencia","saldo_estoque","preco","categoria_id"},
     *       @OA\Property(property="descricao", type="string"),
     *       @OA\Property(property="dimensoes", type="string"),
     *       @OA\Property(property="codigo", type="string"),
     *       @OA\Property(property="referencia", type="string"),
     *       @OA\Property(property="saldo_estoque", type="integer"),
     *       @OA\Property(property="preco", type="float"),
     *       @OA\Property(property="categoria_id", type="integer"),
     *    ),
     * ),     * )
     */
    public function update(Request $request): JsonResponse
    {
        $produtoId = $request->route('id');
        $produtoDetails = $request->only([
            'descricao',
            'dimensoes',
            'codigo',
            'referencia',
            'saldo_estoque',
            'preco',
            'categoria_id',
        ]);

        return response()->json([
            'data' => $this->produtoRepository->updateProduto($produtoId, $produtoDetails),
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/produtos/{id}",
     *     tags={"Products"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Delete a product by id."
     *      ),
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Product id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     * )
     */
    public function destroy(Request $request): JsonResponse
    {
        $produtoId = $request->route('id');
        $this->produtoRepository->deleteProduto($produtoId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
