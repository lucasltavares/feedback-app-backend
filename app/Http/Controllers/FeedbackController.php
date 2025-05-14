<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Feedback;

class FeedbackController extends Controller
{
        /**
     * @OA\Get(
     *     path="/api/feedbacks",
     *     summary="Lista todos os feedbacks do negócio autenticado",
     *     description="Retorna uma lista de todos os feedbacks associados ao negócio do usuário autenticado.",
     *     operationId="listFeedbacks",
     *     tags={"Feedback"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Lista de feedbacks retornada com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="feedbacks",
     *                 type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="id", type="string", format="uuid", example="c1234567-89ab-4cde-8f01-23456789abcd"),
     *                     @OA\Property(property="name", type="string", example="Maria Oliveira"),
     *                     @OA\Property(property="email", type="string", format="email", example="maria@example.com"),
     *                     @OA\Property(property="message", type="string", example="Ambiente limpo e organizado."),
     *                     @OA\Property(property="rating", type="integer", format="int32", example=4),
     *                     @OA\Property(property="business_id", type="string", format="uuid"),
     *                     @OA\Property(property="customer_id", type="string", format="uuid"),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time")
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Não autenticado"
     *     )
     * )
     */

    public function index(Request $request)
    {
        $feedbacks = Feedback::where('business_id', $request->user()->business_id)->get();
        return Response::json(['feedbacks' => $feedbacks], 200);
    }

        /**
     * @OA\Get(
     *     path="/api/feedbacks/{id}",
     *     summary="Exibe um feedback específico",
     *     description="Retorna os detalhes de um feedback pertencente ao negócio autenticado.",
     *     operationId="showFeedback",
     *     tags={"Feedback"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do feedback a ser exibido",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Feedback encontrado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="feedback",
     *                 type="object",
     *                 @OA\Property(property="id", type="string", format="uuid", example="c1234567-89ab-4cde-8f01-23456789abcd"),
     *                 @OA\Property(property="name", type="string", example="João da Silva"),
     *                 @OA\Property(property="email", type="string", format="email", example="joao@example.com"),
     *                 @OA\Property(property="message", type="string", example="Ótimo serviço."),
     *                 @OA\Property(property="rating", type="integer", format="int32", example=5),
     *                 @OA\Property(property="business_id", type="string", format="uuid"),
     *                 @OA\Property(property="customer_id", type="string", format="uuid"),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Feedback não encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Feedback not found")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Não autenticado"
     *     )
     * )
     */

    public function show(Request $request, $id)
    {
        $feedback = Feedback::where('id', $id)->where('business_id', $request->user()->business_id)->first();

        if (!$feedback) {
            return Response::json(['message' => 'Feedback not found'], 404);
        }

        return Response::json(['feedback' => $feedback], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/feedbacks",
     *     summary="Cria um novo feedback",
     *     description="Cria um novo feedback pertencente ao negócio autenticado.",
     *     operationId="storeFeedback",
     *     tags={"Feedback"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="João da Silva"),
     *             @OA\Property(property="email", type="string", format="email", example="joao@example.com"),
     *             @OA\Property(property="message", type="string", example="Ótimo serviço."),
     *             @OA\Property(property="rating", type="integer", format="int32", example=5),
     *             @OA\Property(property="business_id", type="string", format="uuid"),
     *             @OA\Property(property="customer_id", type="string", format="uuid"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Feedback criado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="feedback", ref="/app/Models/Feedback.php"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Não autenticado"
     *     )
     * )
     */

    public function store(Request $request)
    {
        $feedback = Feedback::create($request->all());

        return Response::json(['feedback' => $feedback], 201);
    }


    /**
     * @OA\Delete(
     *     path="/api/feedbacks/{id}",
     *     summary="Exclui um feedback",
     *     description="Exclui um feedback pertencente ao negócio autenticado.",
     *     operationId="destroyFeedback",
     *     tags={"Feedback"},
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do feedback a ser excluído",
     *         required=true,
     *         @OA\Schema(type="string", format="uuid")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Feedback excluído com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="feedback", ref="/app/Models/Feedback.php"),
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Feedback não encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Feedback not found")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Não autenticado"
     *     )
     * )
     */

    public function update(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->update($request->all());
        return Response::json(['feedback' => $feedback], 200);
    }
}
