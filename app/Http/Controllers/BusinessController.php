<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Business;

class BusinessController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/businesses",
     *     summary="List all businesses",
     *     description="Returns a list of all businesses",
     *     tags={"business"},
     *     security={{"auth:sanctum":{}}},
     *     @OA\Response(response="200", description="Successful operation")
     * )
     */
    public function index()
    {
        $businesses = Business::all();
        return Response::json(['businesses' => $businesses], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/businesses/{id}",
     *     summary="Get business by ID",
     *     description="Returns the business with the specified ID",
     *     tags={"business"},
     *     security={{"auth:sanctum":{}}},
     *     @OA\Parameter(
     *         description="ID of the business",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Business not found"
     *     )
     * )
     */
    public function show($id)
    {
        $business = Business::find($id);
        return Response::json(['business' => $business], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/businesses",
     *     summary="Create a new business",
     *     description="Creates a new business",
     *     tags={"business"},
     *     security={{"auth:sanctum":{}}},
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Name of the business"
     *             ),
     *             @OA\Property(
     *                 property="address",
     *                 type="string",
     *                 description="Address of the business"
     *             ),
     *             @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 description="Phone number of the business"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Validation errors"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $business = Business::create($request->all());
        return Response::json(['business' => $business], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/businesses/{id}",
     *     summary="Update business by ID",
     *     description="Updates the business with the specified ID",
     *     tags={"business"},
     *     security={{"auth:sanctum":{}}},
     *     @OA\Parameter(
     *         description="ID of the business",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Name of the business"
     *             ),
     *             @OA\Property(
     *                 property="address",
     *                 type="string",
     *                 description="Address of the business"
     *             ),
     *             @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 description="Phone number of the business"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Business not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $business = Business::find($id);
        $business->update($request->all());
        return Response::json(['business' => $business], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/businesses/{id}",
     *     summary="Delete business by ID",
     *     description="Deletes the business with the specified ID",
     *     tags={"business"},
     *     security={{"auth:sanctum":{}}},
     *     @OA\Parameter(
     *         description="ID of the business",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="Business not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $business = Business::find($id);
        $business->delete();
        return Response::json(['business' => $business], 200);
    }
}

