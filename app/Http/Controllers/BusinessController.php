<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BusinessController extends Controller
{
/**
 * @OA\Get(
 *     path="/api/businesses",
 *     summary="List all Businesses",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     )
 * )
 */
    public function index()
    {
        $businesses = Business::all();
        return Response::json(['businesses' => $businesses], 200);
    }

    public function show($id)
    {
        $business = Business::find($id);
        return Response::json(['business' => $business], 200);
    }

    public function store(Request $request)
    {
        $business = Business::create($request->all());
        return Response::json(['business' => $business], 200);
    }

    public function update(Request $request, $id)
    {
        $business = Business::find($id);
        $business->update($request->all());
        return Response::json(['business' => $business], 200);
    }

    public function destroy($id)
    {
        $business = Business::find($id);
        $business->delete();
        return Response::json(['business' => $business], 200);
    }
}
