<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
 * @OA\Get(
 *     path="/api/posts",
 *     summary="List all posts",
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation"
 *     )
 * )
 */
    public function index(Request $request)
    {
        $feedbacks = Feedback::where('business_id', $request->user()->business_id)->get();
        return Response::json(['feedbacks' => $feedbacks], 200);
    }

    public function show(Request $request, $id)
    {
        $feedback = Feedback::where('id', $id)->where('business_id', $request->user()->business_id)->first();

        if (!$feedback) {
            return Response::json(['message' => 'Feedback not found'], 404);
        }

        return Response::json(['feedback' => $feedback], 200);
    }

    public function store(Request $request)
    {
        $feedback = Feedback::create([
            'business_id' => $request->user()->business_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return Response::json(['feedback' => $feedback], 201);
    }

    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        $feedback->delete();
        return Response::json(['feedback' => $feedback], 200);
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::find($id);
        $feedback->update($request->all());
        return Response::json(['feedback' => $feedback], 200);
    }
}
