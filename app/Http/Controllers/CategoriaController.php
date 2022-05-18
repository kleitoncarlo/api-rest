<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoriaRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{
    private CategoriaRepositoryInterface $categoriaRepository;

    public function __construct(CategoriaRepositoryInterface $categoriaRepository)
    {
        $this->CategoriaRepository = $categoriaRepository;
    }

    /**
     * @OA\Get(
     *     path="/categorias",
     *     tags={"Categories"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(response="200", description="Display a listing of categories.")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->CategoriaRepository->getAllCategorias(),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/categorias",
     *     tags={"Categories"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Store new category"
     *      ),
     *
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"descricao"},
     *       @OA\Property(property="descricao", type="string"),
     *    ),
     * ),
     *
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $categoriaDetails = $request->only([
            'descricao',
        ]);

        return response()->json(
            [
                'data' => $this->CategoriaRepository->createCategoria($categoriaDetails),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Get(
     *     path="/categorias/{id}",
     *     tags={"Categories"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Display a category by id."
     *      ),
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="category id",
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
        $categoriaId = $request->route('id');

        return response()->json([
            'data' => $this->CategoriaRepository->getCategoriaById($categoriaId),
        ]);
    }

    /**
     * @OA\Put(
     *     path="/categorias/{id}",
     *     tags={"Categories"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Update a category by id."
     *      ),
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * @OA\RequestBody(
     *    required=true,
     *    @OA\JsonContent(
     *       required={"descricao"},
     *       @OA\Property(property="descricao", type="string"),
     *    ),
     * ),     * )
     */
    public function update(Request $request): JsonResponse
    {
        $categoriaId = $request->route('id');
        $categoriaDetails = $request->only([
            'descricao',
            'dimensoes',
            'codigo',
            'referencia',
            'saldo_estoque',
            'preco',
            'categoria_id',
        ]);

        return response()->json([
            'data' => $this->CategoriaRepository->updateCategoria($categoriaId, $categoriaDetails),
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/categorias/{id}",
     *     tags={"Categories"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *          response="200",
     *          description="Delete a category by id."
     *      ),
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
        $categoriaId = $request->route('id');
        $this->CategoriaRepository->deleteCategoria($categoriaId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
