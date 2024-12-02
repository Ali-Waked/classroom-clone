<?php

namespace App\Http\Controllers;

use App\Mail\JoinClassroom;
use App\Models\Classroom;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class SendInvidationLinkController extends Controller
{
    public function __invoke(Request $request, Classroom $classroom): RedirectResponse
    {
        Gate::authorize('add.pepoles.to.classroom',['classroom' => $classroom]);
        Mail::to($request->to_email)->send(new JoinClassroom($classroom));
        return back()->with('success', 'send invitation email successflly');
    }
}
