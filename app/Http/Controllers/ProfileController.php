<?php

namespace App\Http\Controllers;

use App\Actions\Profiles\UpdateMyProfile;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __invoke(ProfileRequest $request, UpdateMyProfile $updateMyProfile): JsonResponse
    {
        $updateMyProfile->handle($request->validated());
        return Response::json([
            'code' => '100',
            'message' => 'success updated',
            'request' => $request->hasFile('avatar'),
            're' => $request->validated()
        ]);
    }
}
