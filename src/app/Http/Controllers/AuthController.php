<?php

namespace App\Http\Controllers;

use App\Enums\Messages;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * @OA\Info(
 *     title="API Documentation for Tasks backaend",
 *     version="0.1"
 * )
 */

class AuthController
{

    /**
     * @OA\Post(
     *      path="/api/auth",
     *      operationId="auth_user",
     *      tags={"Auth"},
     *      summary="User Auth",
     *      description="User Auth",
     *
     *    @OA\Parameter(
     *         in="query",
     *         name="email",
     *         required=true,
     *         description="User's email. You can use `test@test.test` or another user `test2@test.test`",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="password",
     *         required=true,
     *         description="User's email. You can use `password`",
     *         @OA\Schema(type="string")
     *     ),
     *
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TaskResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function auth(AuthRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => Messages::WRONG_CREDENTIALS->value
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token' => $request->user()->createToken('token')->plainTextToken,
            'message' => 'Success'
        ], Response::HTTP_OK);
    }
}
