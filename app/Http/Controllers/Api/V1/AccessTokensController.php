<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TokenRequest;
use App\Http\Resources\AccessToken;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AccessTokensController extends Controller
{
    public function index()
    {
        return Auth::guard('sanctum')->user()->tokens()->select(['id', 'name', 'last_used_at'])->get();
    }
    public function store(TokenRequest $request): JsonResponse
    {
        $validated_data = $request->validated();
        $user = User::whereEmail($validated_data['email'])->first();
        if ($user && Hash::check($validated_data['password'], $user->password)) {
            $name = $validated_data['device_name'] ?? $request->userAgent();
            $abilities = $request->post('abilities', ['*']);
            $token = $user->createToken($name, $abilities, now()->addMonths(3));
            return Response::json([
                'token' => $token->plainTextToken,
                'user' => $user->only(['id', 'name', 'email']),
            ], 201);
        }
        return Response::json([
            'message' =>  __('Invalid credentials'),
        ], 401);
    }
    public function destroy(string $token = ''): JsonResponse
    {
        $user = Auth::guard('sanctum')->user();
        // $user->currentAccessToken()->delete();
        if ($token) {
            $user->tokens()->destroy($token);
            $message = 'remove token success';
        } else {
            $user->tokens()->delete();
            $message = 'remove all tokens success';
        }
        return Response::json([
            'message' => $message,
        ]);
    }
}
/*
  'data' => $this->collection->map(function ($model) {
                return [
                    'id' => $model->id,
                    'name' => $model->name,
                    'code' => $model->code,
                    'cover_image' => $model->cover_image_url,
                    'meta' => [
                        'sectiuon' => $model->section,
                        'room' => $model->room,
                        'subject' => $model->subject,
                        'students_count' => $model->students_count,
                        'theme' => $model->theme,
                    ],
                    'user' => [
                        'name' => $model->user?->name
                    ],
                ];
            }),
*/